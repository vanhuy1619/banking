<?php
    
    session_start();
    require('config.php');
    unset($_SESSION['thongbaodk']);
    $thongbaodk='';
    $password=$money='';
    $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";  
    if(!isset($_SESSION['username']))
    {
        header('Location:login.php');
    }
    if($_SESSION['loginfirst']=='true')
    {
        header('Location:changepassfirst.php');

    }
    else
    {
        $username=$_SESSION['username'];
        
        //LẤY THÔNG TIN BAN ĐẦU
        $sql = "select * from users where username='$username'";
        $result = $con->query($sql);
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc()) 
            {
                $name=$row['name'];
                $phone=$row['phone'];
                $address=$row['address'];
                $email=$row['email'];
                $money=$row['money'];
                $status=$row['status'];
                $cmndt=$row['cmndT'];
                $cmnds=$row['cmndS'];
                $password=$row['password'];
            }
        } 
        else 
        {
        }
    }
    function checkPhone($db,$phone,$username)
    {
        $sql = "SELECT * FROM users where phone='$phone' and username!= $username" ;
        $result = $db->query($sql);
        if ($result->num_rows > 0) 
        {
            return false;
        } 
        return true;
    }
    function checkEmail($db,$email,$username)
    {
        $sql = "SELECT * FROM users where email='$email' and username!=$username" ;
        $result = $db->query($sql);
        if ($result->num_rows > 0) 
        {
            return false;
        } 
        return true;
    }

    //UPDATE
    if(isset($_POST['save']))
    {
            //Số điên thoại
            if (empty($_POST['phone']))
            { 
                $thongbaodk='Vui lòng nhập số điện thoại';
            }
            else if (is_numeric($_POST['phone'])!=1||strlen($_POST['phone'])!=10||substr($_POST['phone'],0,1)!=0)
            { 
                $thongbaodk='Số điện thoại đăng ký không hợp lệ';
            }
            else if(checkPhone($con,$_POST['phone'],$_SESSION['username'])==false)
            {
                $thongbaodk='Số điện thoại đã được đăng ký';
            }
            //tên
            else if (empty($_POST['name']))
            {
                $thongbaodk='Vui lòng nhập họ và tên';
            }
            else if(!preg_match("/^[a-z A-Z_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ]+$/", $_POST['name']))
            {
                $thongbaodk='Họ và tên không hợp lệ';
            }
    
            //email
            else if (empty($_POST['email']))
            {
                $thongbaodk='Vui lòng nhập email';
            }
            
            else if (!preg_match($pattern, $_POST['email']))
            {
                $thongbaodk='Địa chỉ email không hợp lệ';
            }
            else if(checkEmail($con,$_POST['email'],$_SESSION['username'])==false)
            {
                $thongbaodk='Địa chỉ email đã được đăng ký';
            }
            else
            {
                //THÕA HẾT ĐIỀU KIỆN
                $phoneup= $_POST['phone'];
                $emailup= $_POST['email'];
                $nameup=$_POST['name'];
                $addressup=$_POST['address'];
                
                //CMND_T
                $cmndtup = $_FILES["image1"]["name"];
                $tempname = $_FILES["image1"]["tmp_name"];    
                $folder = "uploads/".$cmndtup;
                $imgFileType = pathinfo($folder, PATHINFO_EXTENSION);
                $valid_extensions = array("jpg", "jpeg", "png");
                if (in_array(strtolower($imgFileType), $valid_extensions)) 
                {
                    move_uploaded_file($tempname, $folder);
                }

                //CMND_S
                $cmndsup = $_FILES["image2"]["name"];
                $tempname2 = $_FILES["image2"]["tmp_name"];    
                $folder = "uploads/".$cmndsup;
                $imgFileType2 = pathinfo($folder, PATHINFO_EXTENSION);
                $valid_extensions2 = array("jpg", "jpeg", "png");
                if (in_array(strtolower($imgFileType2), $valid_extensions2)) 
                {
                    move_uploaded_file($tempname2, $folder);
                }

                //KHÔNG UP ẢNH MỚI
                if(empty($cmndtup))
                    $cmndtup=$cmndt;
                if(empty($cmndsup))
                    $cmndsup=$cmnds;
                $sql2 = "update users set name='$nameup',phone='$phoneup',email='$emailup',address='$addressup',status='Chờ cập nhật',cmndT='$cmndtup',cmndS='$cmndsup' where username='$username'";
                $them = mysqli_query($con, $sql2);  
                if ($them) 
                {
                    $thongbaodk='Cập nhật tài khoản thành công. Vui lòng chờ duyệt';
                    // Hiện lại thông tin sau khi update
                    $sql = "select * from users where username='$username'";
                    $result = $con->query($sql);
                    if ($result->num_rows > 0) 
                    {
                        while($row = $result->fetch_assoc()) 
                        {
                            $name=$row['name'];
                            $phone=$row['phone'];
                            $address=$row['address'];
                            $email=$row['email'];
                            $status=$row['status'];
                            $cmndt=$row['cmndT'];
                            $cmnds=$row['cmndS'];
                        }
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TÀI KHOẢN</title>
    <link rel="stylesheet" href="assets/css/base.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"
        integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
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
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Outlined" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Two+Tone" rel="stylesheet">
    <script src="jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- <link rel="stylesheet" href="assets/css/profile.css"> -->
    <link rel="stylesheet" href="assets/css/responsive.css">
    
</head>

<body>
    <div class="app">
    <?php
      include_once('header.php');
    ?>
        <div class="main">
            <div class="grid">
                    <div class="profile">
                        <div class="menu col-md-2 col-sm-12">
                            <div class="menu-header">
                                <div style="color:blue">
                                    <i class="fas fa-edit"></i> 
                                    Chỉnh sửa hồ sơ
                                </div>
                                
                                <a style="margin-left: 25px;text-decoration: none;list-style: none;color:black" href="changepass.php">Đổi mật khẩu</a>
                            </div>
                        </div>
                        <div class="mainbox col-md-10 col-sm-12" style="padding: 25px;">
                            <div class="mainbox-header">
                                <div class="status-header">
                                    <div class="mainbox-header__title" style="font-size: 20px;">
                                        Hồ sơ của tôi
                                    </div>
                                    <div class="status" id="status">
                                        <?=$status?>
                                    </div>
                                </div>
                                <p class="mainbox-header__main" style="text-transform: none;">Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
                            </div>
                            <div class="mainbox-content">
                                <div class="mainbox-content__form">
                                    <form action="" class="row content-account" method="post" enctype="multipart/form-data">
                                        <div class="profile-security col-sm-12 col-lg-8">
                                            <div class="table__form-item row">
                                                <div class="table__form-item-title col-md-12 col-xl-3">
                                                    Tên chủ tài khoản
                                                </div>
                                                <div class="table__form-item-content col-xl-9">
                                                    <input type="text" id="name" class="inputaccount" value="<?=$name?>" name="name">
                                                </div>
                                            </div>
                                            <div class="table__form-item row">
                                                <div class="table__form-item-title col-md-12 col-xl-3">
                                                    Số dư
                                                </div>
                                                <div class="table__form-item-content col-xl-9 container" >
                                                    <input type="text" class="inputaccount money" value="********" disabled id="moneynone" >
                                                    <a class="fa fa-eye eye" data-toggle="modal" data-target="#myModal" onclick="showMoney()"></a>
                                                    <div class="modal fade" id="myModal" role="dialog">
                                                    
                                                    <div class="modal-dialog modal-dialog-centered" id="dialogeye">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Mật khẩu</label>
                                                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="passwordeye">
                                                            </div>
                                                            <div type="submit" class="btn btn-primary" onclick="btneye()">Submit</div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="table__form-item row">
                                                <div class="table__form-item-title col-md-12 col-xl-3">
                                                    Số điện thoại
                                                </div>
                                                <div class="table__form-item-content col-xl-9" >
                                                    <input type="text" class="inputaccount" value="<?=$phone?>" name="phone">
                                                </div>
                                            </div>
                                            <div class="table__form-item row">
                                                <div class="table__form-item-title col-md-12 col-xl-3">
                                                    Email
                                                </div>
                                                <div class="table__form-item-content col-xl-9">
                                                    <input type="text" class="inputaccount" value="<?=$email?>" name="email">
                                                </div>
                                            </div>
                                            <div class="table__form-item row">
                                                <div class="table__form-item-title col-md-12 col-xl-3">
                                                    Địa chỉ
                                                </div>
                                                <div class="table__form-item-content col-xl-9">
                                                    <input type="text" id="address" class="inputaccount name-address" value="<?=$address?>" name="address">
                                                </div>
                                            </div>
                                            <div class="save">
                                                <button type="submit" name='save' class="savebtn">Lưu</button>
                                            </div>
                                            <p class="thongbao" style="color: #ee4d2d;margin-top:10px;text-align:center"><?php echo($thongbaodk)?></p>
                                        </div>
                                        <div class="profile-img col-lg-4">
                                            <div class="cmndT cmnd">
                                                <img src="uploads/<?=$cmndt?>" alt="" class="cmnd-img cmndt-img" id="imagePreview">
                                                <div class="change-img">
                                                    <input name="image1" type='file' id="imageUpload" accept=".png, .jpg, .jpeg"/>
                                                </div>
                                            </div>
                                            <div class="cmndS cmnd">
                                                <img src="uploads/<?=$cmnds?>" alt="" class="cmnd-img cmnds-img" id="imagePreview2">
                                                <div class="change-img">
                                                    <input name="image2" type='file' id="imageUpload2" accept=".png, .jpg, .jpeg" />
                                                </div>
                                            </div>
                                        </div>
                                       
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <?php
            require('footer.php');
        ?>
        
    </div>
    
    <script src="main.js"></script>
    <script>

        let st=document.getElementById('status');
        let contentStatus=st.innerText;
        if(contentStatus==='Đã duyệt')
            st.style.background='rgb(54, 88, 241)';
        else if(contentStatus==='Chờ xác minh')
            st.style.background='#ee4d2d';
        else if(contentStatus==='Chờ cập nhật')
        {
            st.style.background='rgb(255,221,0)';
            st.style.color='black';
        }

        
        
        
        //MẶT TRƯỚC
        $(document).ready(function(){
        $("#imageUpload").change(function(data){
        var imageFile = data.target.files[0];
        var reader = new FileReader();
        reader.readAsDataURL(imageFile);
        reader.onload = function(evt){
            $('#imagePreview').attr('src', evt.target.result);
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        });
        });

        //MẶT SAU
        $(document).ready(function(){
        $("#imageUpload2").change(function(data){
        var imageFile = data.target.files[0];
        var reader = new FileReader();
        reader.readAsDataURL(imageFile);
        reader.onload = function(evt){
            $('#imagePreview2').attr('src', evt.target.result); 
            $('#imagePreview2').hide();
            $('#imagePreview2').fadeIn(650);
        }
        });
        });

        function btneye()
        {
            if(document.getElementById('exampleInputPassword1').value==<?=$password?>)
            {
                document.getElementById('moneynone').value=<?=$money?>;
                //FORMAT TIỀN
                let dollarUSLocale = Intl.NumberFormat('en-US');
                let totalMoneyFormat=dollarUSLocale.format(<?=$money?>);
                document.getElementById('moneynone').value=totalMoneyFormat;
                document.getElementById('dialogeye').style.display='none'
            }
        }

        function buycard()
            {
                let buycardbox=document.getElementById('modalo');
                buycardbox.style.display='flex';
            }
        function clickclose()
            {
                let buycardbox=document.getElementById('modalo');
                buycardbox.style.display='none';
            }
    </script>
</body>

</html>