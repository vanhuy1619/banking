<?php
    require('config.php');
    session_start();
    if(!isset($_SESSION['username'])){
        header('Location:login.php');
    }
    if($_SESSION['status']!='Đã duyệt')
    {
        echo "<script>alert('Tài khoản đang chờ xác minh nên bạn không thể sử dụng dịch vụ'); window.location = 'home.php';</script>";
    }
    

    $idcardhave='';
    $flagrut='';
    $moneyhave='';
    $phone='';

    unset($mess);

    if (isset($_SESSION['username']) && $_SESSION['username'])
    {
        $username=$_SESSION['username'];
        $sql="select * from users where username='$username'";
        $query=mysqli_query($con,$sql);
        if(mysqli_num_rows($query)>0)
        {
            while($row=mysqli_fetch_assoc($query))
            {
                $name=$row['name'];
                $moneyhave=$row['money'];
                $phone=$row['phone'];
                $flagrut=$row['flagrut'];
            }
        }
    }
    
    function test_input($data) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //Đếm số lần rút tiền trong ngày
    function countrut($db,$username)
    {
        $mydate=getdate();
        $day=$mydate['mday'];
        $month=$mydate['mon'];
        $year=$mydate['year'];
        $sql = "SELECT * FROM ruttien where username='$username' and day(daterut)=$day and month(daterut)=$month and year(daterut)=$year";
        if ($result=mysqli_query($db,$sql)) 
        {
          $rowcount=mysqli_num_rows($result);
         
        }
        return $rowcount; 
    }

    //Lấy idcard của user đã sử dụng để nạp tiền
    if (isset($_POST['okmoney'])) 
    {
      // $sql="select * from ruttien where username='$username'"; 
      // if ($con->query($sql) === TRUE) 
      // {
      //     $mess="Giao dịch đã được ghi nhận. Vui lòng chờ duyệt";
      // }
      // else 
      // {
      // }  

        if (isset($_SESSION['username']) && $_SESSION['username'])
        {
            $username=$_SESSION['username']; //Lấy session username

            $sql="select idcard from naptien where username='$username'";
            $query=mysqli_query($con,$sql);
            if(mysqli_num_rows($query)>0)
            {
                while($row=mysqli_fetch_assoc($query))
                {
                    $idcardhave=$row['idcard'];
                }
            }
            else
            {
            }  
        }

        $idcard=$_POST['idcard'];
        $datecard=$_POST['datecard'];
        $statusrut="Thành công";
        $cvv=$_POST['cvv'];
        $note='';
        $note=$_POST['note'];
        
            
        //Kiểm tra loại thẻ được hỗ trợ trong table card
        $sql = "SELECT idcard FROM card WHERE idcard = '$idcard'";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $count = mysqli_num_rows($result); //lấy dòng
        if($count !=1 && strlen($idcard)==6) 
        {
            $mess="Thẻ này không được hỗ trợ";
        }
        else if(strlen($idcard)<6 || is_numeric($idcard)!=1) 
        {
            $mess="Định dạng thẻ có 6 chữ số. Vui lòng nhập lại";
        }
        else
        {
             //idcard hợp lệ thì kiểm tra ngày
            $sql = "SELECT * FROM card WHERE datecard='$datecard' and idcard='$idcard'";
            $result = mysqli_query($con,$sql);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $count = mysqli_num_rows($result);
            if($count!=1)
                $mess="Vui lòng kiểm tra lại ngày hết hạn của thẻ";
            else
            {
                //ngày hợp lệ thì kiểm tra mã cvv
                $sql = "SELECT cvv FROM card WHERE cvv='$cvv' and idcard='$idcard'";
                $result = mysqli_query($con,$sql);
                $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                $count = mysqli_num_rows($result);
                if($count!=1)
                    $mess="Vui lòng kiểm tra lại mã CVV";
                else
                {
                    //THỎA HẾT MỌI ĐIỀU KIỆN
                    $moneyinput=$_POST['money'];
                    $money=substr($moneyinput,1);
                    $moneyecho=substr($moneyinput,1);
                    $money=str_replace(',','',$money);
                        
                    //thẻ 333333
                    if($idcard=='333333')
                    {
                        $mess="Thẻ không khả dụng";
                        // die();
                    }
                    
                    else if(strcmp($idcard,$idcardhave)!=0)
                    {
                        $mess='Thẻ chưa được sử dụng';
                    }
                    else
                    {
                        if(countrut($con,$username)>=2)
                        {
                            $mess="Đã vượt quá số lần giao dịch trong ngày";
                        }
                        else if($money+$money*0.05>$moneyhave)
                        {
                            $mess="Số tiền trong tài khoản không đủ để giao dịch";
                        }
                        else if($money%50000!=0)
                        {
                            $mess="Số tiền giao dịch là bội của 50,000 đồng";
                        }
                        else
                        {
                            if($money>5000000)
                            {
                                $sql="insert into ruttien(username,phone,idcard,cvv,money,note,trangthairut) values ('$username','$phone','$idcard','$cvv','$money','$note','Đang chờ')"; 
                                if ($con->query($sql) === TRUE) 
                                {
                                    $mess="Giao dịch đã được ghi nhận. Vui lòng chờ duyệt";
                                    $sql="update users set flagrut=flagrut+1 where username='$username'";
                                    $con->query($sql)
                                }
                                else 
                                {
                                }  
                            }
                            else
                            {   
                                $note=$_POST['note']; 
                                $sql="insert into ruttien(username,phone,idcard,cvv,money,note,trangthairut) values ('$username','$phone','$idcard','$cvv','$money','$note','Thành công')"; 
                                if ($con->query($sql) === TRUE) 
                                {
                                    $sql="update users set money=money-'$money'-'$money'*0.05,flagrut=flagrut+1 where username='$username'"; 
                                    if ($con->query($sql) === TRUE) 
                                    {
                                        $mess="Rút thành công $moneyecho đồng về tài khoản";
                                    }
                                    else 
                                    {
                                    }
                                }
                                else 
                                {
                                }
                            }
                        }
                    }
                }
            }
        } 
    } 
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rút tiền</title>
  <link rel="stylesheet" href="assets/css/base.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"
    integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <!-- <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet"> -->
  <link href="assets/fonts/fontawesome/fontawesome-free-6.0.0-web/css/all.min.css" rel="stylesheet">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <!-- <link rel="stylesheet" href="lightslider.css"> -->
  <!-- <script type="text/javascript" src="JQuery3.3.1.js"></script> -->
  <!-- <script type="text/javascript" src="lightslider.js"></script> -->
  <!-- <script src="main.js"></script> -->
  <link
    href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
    rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
    integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
      integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
      crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
      integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
      crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
      integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
      crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <link
      href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
      rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
      integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous"> -->
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
  <!-- <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet"> -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <!-- <script src="main.js"></script> -->
  <link rel="stylesheet" href="assets/css/responsive.css">
 
</head>

<body>
  <div class="app">
    <?php
      include_once('header.php');
    ?>
    <img src="assets/img/rtbannẻ.jpg" alt="" style="width:100%">
    <div class="main" style="margin-top:100px">
      <div style="text-align:center">
        <h2 style="font-weight:700">TRẢI NGHIỆM NHIỀU TIỆN ÍCH</h2>
        <p style="font-size:17px;text-align:center;width:60%;margin:0 auto;color:#697c8e;margin-top:20px">Xu hướng thanh
          toán điện tử ngày càng trở nên phổ biến với người
          Việt Nam. Rút tiền miễn phí từ 1 (một) đồng và nhiều những tiện ích khác đang chờ bạn khám phá.</p>
      </div>
      <div class="security-box tabcontent rt1" id="BCNH" style="width:80%;margin:0 auto; margin-top:20px">
        <div class="sc-left">
          <div class="security-content-item">
            <div class="check-icon">
              <img src="assets/img/rt1.svg" alt="">
            </div>
            <div class="btnh-content">Thao tác đơn giản nhanh chóng.</div>
          </div>
          <div class="security-content-item">
            <div class="check-icon">
              <img src="assets/img/rt2.svg" alt="">
            </div>
            <div class="btnh-content">Đa dạng nhà mạng, chiết khấu cạnh tranh.</div>
          </div>
          <div class="security-content-item">
            <div class="check-icon">
              <img src="assets/img/rt3.svg" alt="">
            </div>
            <div class="btnh-content">Chi phí ưu đãi, giao dịch 24/7.</div>
          </div>
        </div>
        <div class="bcnh-right">
          <div class="bcnh-item-img">
            <img src="assets/img/phone-carbon-footprint-app.png" alt="" class="bcnh-img">
          </div>
        </div>
      </div>
      <div class="grid" style="flex-direction:column">
        <h2 style="font-weight:700;margin-top:100px;text-align:center">RÚT TIỀN NGAY TẠI NHÀ VỚI NHIỀU ƯU ĐÃI</h2>
        <div class="group-box-rt">
          <div class="group-box-rt-item">
            <img src="assets/img/123.jpg" alt="">
            <p style="text-align:center">Mọi nơi</p>
          </div>
          <div class="group-box-rt-item">
            <img src="assets/img/momo-file-211110095109.svg" alt="">
            <p style="text-align:center">Đơn giản</p>
          </div>
          <div class="group-box-rt-item">
            <img src="assets/img/momo-file-220111134140.svg" alt="">
            <p style="text-align:center">Quà tặng</p>
          </div>
          <div class="group-box-rt-item">
            <img src="assets/img/momo-file-220111134217.svg" alt="">
            <p style="text-align:center">Trải nghiệm</p>
          </div>
        </div>
        <div class="_rt-img">
          <img src="assets/img/cq5dam.web.1280.1280 (1).jpeg" alt="" class="rt-co-img-1 rt-img">
          <img src="assets/img/cq5dam.web.1280.1280 (2).jpeg" alt="" class="rt-co-img-2 rt-img">
        </div>
        <div style="width:100%" id="_form-end">
          <div class="_111">
          <div class=" col-sm-12 col-lg-6 col-md-12" id="left-form-rt" >
            <div class="in-phone">
              <div class="in-phone-img" alt=""></div>
            </div>
            <div class="border-phone">
              <img src="assets/img/phone-border.svg" class="border-phone-img" alt="">
            </div>
            
          </div>
          <div class="container-form-rt col-sm-12 col-lg-6 col-md-12">
            <form action="" method="post" id="formnaptien">
              <div class="form-group">
                <label for="name">Tên chủ tải khoản</label>
                <input type="text" value="<?=$name?>" class="form-control" style="height:50px;border-radius:15px ;" disabled>
              </div>
              <div class="form-group">
                <label for="id">Mã thẻ</label>
                <input type="text" name="idcard" placeholder="Số thẻ" id="idcard" class="form-control" style="height:50px;border-radius:15px ;"
                  onchange="checkid()">
              </div>
              <div class="form-group">
                <label for="date">Hạn thẻ</label>
                <input type="date" name="datecard" id="datecard" class="form-control" style="height:50px;border-radius:15px ;" placeholder="Ngày hết hạn">
              </div>
              <div class="form-group">
                <label for="cvv">Mã CVV</label>
                <input type="text" name="cvv" id="cvv" class="form-control" style="height:50px;border-radius:15px ;" placeholder="Mã CVV">
              </div>
              <div class="form-group">
                <label for="money">Số tiền rút</label>
                <input type="text" name="money" id="currency-field" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" disabled
                  data-type="currency" placeholder="1,000,000" class="form-control" style="height:50px;border-radius:15px ;">
              </div>
              <div class="form-group">
                <label for="note">Ghi chú</label>
                <textarea name="note" id="" cols="30" rows="10" placeholder="Ghi chú" class="form-control"  style="border: 1px solid black;"></textarea>
              </div>
              <!-- <button type="submit" class="btn-update" name="okmoney" id="okmoney" onkeyup="typeMoney()">Xác nhận</button> -->
              <div style="display:flex;justify-content:center">
                <button class="btn btn-success" type="reset" style="font-size: 15px;margin-right:30px">Làm mới</button>
                <button class="btn btn-update" type="submit" name="okmoney" id="okmoney">Xác nhận</button>
              </div>
              <div class="thongbaocard" style="color: #ee4d2d;font-weight:700;text-align:center;margin-top:15px;font-size:18px">
                <?php
                if(isset($mess))
                {
                  echo $mess;
                }
              ?>
              </div>
            </form>
          </div>
          </div>
        </div>
      </div>


    </div>

    <?php
      include('footer.php');
    ?>
  </div>

</body>
  <script src="main.js"></script>
</html>