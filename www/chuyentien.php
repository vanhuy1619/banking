<?php

    require('config.php');
    session_start();

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
    require 'vendor/phpmailer/phpmailer/src/Exception.php';
    require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require 'vendor/phpmailer/phpmailer/src/SMTP.php';
    require 'vendor/autoload.php';

    if(!isset($_SESSION['username'])){
        header('Location:login.php');
    }
    if($_SESSION['status']!='Đã duyệt')
    {
        echo "<script>alert('Tài khoản đang chờ xác minh nên bạn không thể sử dụng dịch vụ'); window.location = 'home.php';</script>";
    }
    
    $username=$_SESSION['username'];
    unset($mess);
    // unset($_SESSION['arrayInfoReceive']);

    function sendActivationEmail($email,$content)
    {
        $mail=new PHPMailer();
        try
        {
            $mail->isSMTP();                      
            $mail->CharSet='UTF-8';                                            
            $mail->Host       = 'smtp.gmail.com';                     
            $mail->SMTPAuth   = true;                                  
            $mail->Username   = 'khoanguyen30lb@gmail.com';                     
                //$mail->Password   = 'vswbeityyoqckiph';  
            $mail->Password   = 'henrynguyen';                            
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
            $mail->Port       =465;   

            $mail->setFrom('khoanguyen30lb@gmail.com', 'Admin');
            $mail->addAddress($email, 'Người nhận');     

            $mail->isHTML(true);    
            $mail->setFrom('khoanguyen30lb@gmail.com');                              
            $mail->Subject = "MÃ OTP CHUYỂN TIỀN";
            $mail->Body    = $content;

            $mail->send();
                return true;
        }
        catch(Exception $e)
        {
            return false;
        }
    }


    //Lấy thông tin người nhận
    function infoReceive($db,$phonereceive)
    {
        $arrayInfo=[];
        $sql = "select * from users where phone='$phonereceive'";
        $result = $db->query($sql);
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc()) 
            {
                $arrayInfo=array(
                    'emailreceive' => $row['email'],
                    'phonereceive' => $row['phone'],
                    'usernamereceive' => $row['username'],
                    'sodu'=> $row['money'],
                    'namereceive'=> $row['name']
                );
            }
        }
        return $arrayInfo;
    }

    function rand_string($length)
    {
        $str = '';
        $chars = "0123456789";
        $size = strlen($chars);
        for ($i = 0; $i < $length; $i++) 
        {
            $str .= $chars[rand(0, $size - 1)];
        }
        return $str;
    }
   
    if(!empty($_POST['phonereceive']))
    {
      $_SESSION['arrayreceive']=infoReceive($con,$_POST['phonereceive']);
    }
    
    if (isset($_POST['okmoney'])) 
    {
        $phonereceive=$_POST['phonereceive'];
        $note=$_POST['note'];
        $note="";
        $fee='0';    

        // $_SESSION['arrayInfoReceive']=infoReceive($con,$_POST['phonereceive']);
         

        //Lấy số điện thoại và tiền của người gửi
        $sql = "select * from users where username='$username'";
        $result = $con->query($sql);
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc()) 
            {
                $emailsend=$_SESSION['emailsend']=$row['email'];
                $_SESSION['namesend']=$row['name'];
                $phonesend=$_SESSION['phonesend']=$row['phone'];
                $moneyhave=$row['money'];
            }
        } 

        //Kiểm tra số điện thoại người nhận có tồn tại hay không
        $sql = "SELECT phone FROM users WHERE phone = '$phonereceive' and phone!='$phonesend'";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $count = mysqli_num_rows($result); //lấy dòng

        //VALID SỐ ĐIỆN THOẠI
        if (empty($phonereceive))
        { 
            $mess='Vui lòng nhập số điện thoại';
        }
        else if (is_numeric($phonereceive)!=1||strlen($phonereceive)!=10||substr($phonereceive,0,1)!=0)
        { 
            $mess='Số điện thoại không hợp lệ';
        }
        else if($count !=1) 
        {
            $mess="Số điện thoại chưa được đăng ký";
        }

        //NGƯỜI CHỊU PHÍ
        else if(empty($_POST['fee'])) 
        {
            $mess='Chọn người chịu phí giao dịch';
        }
        
        else
        {
            //THỎA HẾT MỌI ĐIỀU KIỆN
            $moneyinput=$_POST['money'];
            $money=substr($moneyinput,1);
            // $moneyecho=substr($moneyinput,1);
            $money=str_replace(',','',$money);
            $selected = $_POST['fee'];
            
            if(!empty($_POST['fee'])) 
            {
                $fee = $_POST['fee'];
                if($fee=='Người gửi')
                {
                    $fee='Người gửi';
                }
                if($fee=='Người nhận')
                {
                    $fee='Người nhận';
                }
            }
            
                  
            if (($money+$money*0.05>$moneyhave && $fee=='Người gửi') ||($money>$moneyhave && $fee=='Người nhận'))
            {
                $mess="Số tiền trong tài khoản không đủ để giao dịch";
            }

            else
            {   $note=$_POST['note'];
                $_SESSION['note']=$_POST['note'];
                $_SESSION['namereceive']=infoReceive($con,$_POST['phonereceive'])['namereceive'];
                $_SESSION['usernamereceive']=infoReceive($con,$_POST['phonereceive'])['usernamereceive'];
                $_SESSION['phonereceive']=$phonereceive;
                $_SESSION['moneyreceive']=$moneyinput;
                $_SESSION['notereceive']=$note;
                $_SESSION['fee']=$fee;
                $_SESSION['emailreceive']=infoReceive($con,$_POST['phonereceive'])['emailreceive'];
                      //Gửi otp
                $otp=rand_string(6);
                $timeotp=time();
                $sql2 = "insert into otp(username,phone,email,otp,dateotp) values('$username','$phonesend','$emailsend','$otp','$timeotp')";
                if ($con->query($sql2) === TRUE) 
                {

                  sendActivationEmail($emailsend,"Mã otp chuyển tiền của bạn có hiệu lực trong 1 phút: <h3>$otp</h3>");
                  header('location:confirmchuyentien.php');
                  $_SESSION['chuyentien']='true';
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
  <title>Chuyển tiền</title>
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
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"> -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script> -->

  <link
    href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
    rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
    integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
  <!-- <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'> -->
  <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
      integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
      crossorigin="anonymous"></script> -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
      integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
      crossorigin="anonymous"></script> -->
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
      integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
      crossorigin="anonymous"></script> -->
  <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
  <link
    href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
    rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
    integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/css/bootstrap.min.css" rel="stylesheet"
         type="text/css" /> -->
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/> -->
  <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.7.1/modernizr.min.js" type="text/javascript"></script> -->
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="assets/css/responsive.css">
  
</head>

<body>
  <div class="app">
    <?php
      include_once('header.php');
    ?>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>

        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
          <div class="item active">
            <img src="assets/img/ct3.jpg" alt="hinh1" style="width:100%;height:500px">
          </div>

          <div class="item">
            <img src="assets/img/ct2.jpg" alt="hinh2" style="width:100%;height:500px">
          </div>
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
      <div style="padding:2rem 9%;margin-bottom:80px">
        <div style="text-align:center;margin-bottom:15px">
          <h2 style="font-weight:700">Ngân hàng liên kết</h2>
          <p style="font-size:20px">Tiện lợi khi liên kết nhiều ngân hàng trên cùng một tài khoản</p>
        </div>
        <div class="slider multiple-items">
          <div>
            <img src="assets/img/vcb.svg" style="width:80%" alt="">
          </div>
          <div>
          <img src="assets/img/ocb.svg" style="width:80%" alt="">
          </div>
          <div>
          <img src="assets/img/agb.svg" style="width:80%" alt="">
          </div>
          <div>
          <img src="assets/img/bidv.svg"style="width:80%"  alt="">
          </div>
          <div>
          <img src="assets/img/tcb.svg" style="width:80%" alt="">
          </div>
          <div>
          <img src="assets/img/vib.svg" style="width:80%" alt="">
          </div>
          <div>
          <img src="assets/img/shb.svg" style="width:80%" alt="">
          </div>
          <div>
          <img src="assets/img/exb.svg" style="width:80%" alt="">
          </div>
          <div>
          <img src="assets/img/hdb.svg" style="width:80%" alt="">
          </div>
        </div>
      </div>
    <div class="main" style="margin-bottom: 100px">
      <div class="_123" style="display:flex;flex-wrap:wrap;margin-top:30px;padding:2rem 3%;height:100%">
        <div class="col-md-8 col-sm-12">
          <h2 style="text-align:center;font-weight:700">Khám phá ưu điểm chuyển tiền của BigPay</h2>
          <div class="col-lg-4 col-md-12 col-12" style="margin-top:40px;" >
            <div id="ctl">
              <p>1</p>
              <div>Hoàn toàn miễn phí</div>
            </div>
            <div id="ctl">
              <p>2</p>
              <div>Chỉ cần số điện thoại</div>
            </div>
            <div id="ctl">
              <p>3</p>
              <div>Chuyển tiền nhanh chóng</div>
            </div>
            <div id="ctl">
              <p>4</p>
              <div>An toàn-bảo mật tuyệt đối</div>
            </div>
            <div id="ctl">
              <p>5</p>
              <div>Chuyển tiền mọi lúc mọi nơi</div>
            </div>
          </div>
          <img src="assets/img/emoji_df7627e1d5.png" class="ctc col-md-12 col-lg-8 col-12" alt="">
        </div>
        <div class="col-md-4 col-sm-12" style="border-left: 2px dashed rgba(0, 0, 0, 0.09);">
       
          <form action="" method="post" id="formnaptien">
            <div class="form-group">
              <label for="phonereceive">Số điện thoại người nhận</label>
              <input style="height:50px;border-radius:15px ;" type="text" class="form-control" name="phonereceive" placeholder="Số điện thoại người nhận"
                onchange="checkid()" id="phonereceive">
            </div>
            <div class="form-group">
              <label for="money">Số tiền chuyển</label>
              <input style="height:50px;border-radius:15px;" class="form-control" name="money" id="currency-field"
                pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" placeholder="1,000,000" onkeypress="inputmoneyct()">
            </div>
            <div class="form-group choosecc">
              <label for="money">Người chịu phí</label>
              <select name="fee" class="custom-select value" style="font-size:15px;height:fit-content;height:50px;border-radius:15px" id="fee">
                <option value="" disabled selected>Choose option</option>
                <option value="Người gửi">Người gửi</option>
                <option value="Người nhận">người nhận</option>
              </select>
            </div>
            <div class="form-group">
              <label for="note">Ghi chú</label>
              <textarea name="note" id="" cols="30" class="form-control" rows="10" placeholder="Ghi chú"
                style="border: 1px solid black;"></textarea>
            </div>
            <div style="display:flex;justify-content:center">
              <button class="btn btn-success" type="reset" style="font-size: 15px;margin-right:30px">Làm mới</button>
              <button class="btn btn-update" type="submit" name="okmoney" id="okmoney">Xác nhận</button>
            </div>

            <div class="thongbaocard" style="color: #ee4d2d;text-align:center;margin-top:15px">
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




    <?php
      include('footer.php');
    ?>
  </div>



  <script src="main.js"></script>
  

</body>
 
</html>