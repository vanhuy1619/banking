<?php
require('config.php');
    session_start();
    unset($thongbaophone);
    unset($thongbaopass);
    unset($phone);
    
    $thongbaophone='';
    $thongbaopass='';
    if(isset($_POST['login']))
    {
        $phone=$_POST['phone'];
        $pass=$_POST['pass'];
        
        if(empty($phone))
        {
            $thongbaophone="Nhập số điện thoại";
        }
        // admin role
        else if ($phone==="admin")
        {
            $sql="select * from users where phone='$phone' and password='$pass'";
            $query=mysqli_query($con,$sql);
            $num=mysqli_num_rows($query);
            if ($num != 0){
                $_SESSION['admin'] = 1;
                header('Location: ./admin/admin.php');
            }
            else {
                $thongbaophone='Số điện thoại không hợp lệ';
            }
        } 
        else if (is_numeric($_POST['phone'])!=1||strlen($_POST['phone'])!=10||substr($_POST['phone'],0,1)!=0)
        { 
            $thongbaophone='Số điện thoại không hợp lệ';
        }
        else if(empty($pass))
        {
            $thongbaopass="Nhập mật khẩu";
        }
        else
        {
           //LẤY DỮ LIỆU LOGIN
            $sqllogin="select * from users where phone='$phone'";
            $query=mysqli_query($con,$sqllogin);
            if(mysqli_num_rows($query)!=0)
            {
                while($row=mysqli_fetch_assoc($query))
                {
                    $countfail=$row["countfail"];
                    $statuslogin=$row['statuslogin'];
                    $checktimeblock=$row['timeblock'];
                    $checkblock=$row['block'];
                }
                $sql="select * from users where phone='$phone' and password='$pass'";
                $query=mysqli_query($con,$sql);
                $num=mysqli_num_rows($query);
                if($num!=0)
                {
                    if($checkblock!='NULL')
                    {
                        echo "<script>alert('Tài khoản đã bị khóa vì đăng nhập sai nhiều lần. Vui lòng liên hệ quản trị viên để giải quyết');</script>";
                    }
                    if(time()-$checktimeblock<60 && $checkblock=='NULL')
                    {
                        echo "<script>alert('Tài khoản đã bị khóa trong 1 phút');</script>";
                    }
                    if($checkblock=='NULL' && time()-$checktimeblock>60)
                    {
                        
                        $sql="select * from users where phone='$phone' and password='$pass'";
                        $query=mysqli_query($con,$sql);
                        if(mysqli_num_rows($query)>0)
                        {
                            while($row=mysqli_fetch_assoc($query))
                            {
                                $sql = "UPDATE users SET countfail=0,block='NULL',statuslogin='NULL',timeblock=0 WHERE phone = '$phone'";
                                if ($con->query($sql) === TRUE) 
                                {
                                    $_SESSION['username'] = $row['username'];
                                    $_SESSION['loginfirst'] = $row['loginfirst'];
                                    $_SESSION['status']=$row['status'];
                                    header('Location:home.php');
                                } 
                            }
                        }
                    }
                }
                
                if($num==0)
                {
                    if(time()-$checktimeblock>60 && $checkblock=='NULL')
                    {
                        $sql1 = "UPDATE users SET countfail=countfail+1 WHERE phone=$phone";
                        if ($con->query($sql1) === TRUE) 
                        {
                        }
                        if($countfail==3)
                        {
                            $timeblock=time();
                            $sql2 = "UPDATE users SET statuslogin='Đăng nhập bất thường',timeblock=$timeblock WHERE phone=$phone";
                            if ($con->query($sql2) === TRUE) 
                            {
                                echo "<script>alert('Tài khoản đã bị khóa trong 1 phút');</script>";
                            }
                        }
                        if($countfail==6 && $statuslogin=='Đăng nhập bất thường')
                        {
                            $sql1 = "UPDATE users SET block='Tài khoản bị khóa' WHERE phone=$phone";
                            if ($con->query($sql1) === TRUE) 
                            {    
                            }
                        }
                    }
                    else if(time()-$checktimeblock<=60 && $checkblock=='NULL')
                    {
                        echo "<script>alert('Tài khoản đã bị khóa trong 1 phút');</script>";
                    }
                    else if($checkblock!='NULL')
                    {
                        echo "<script>alert('Tài khoản đã bị khóa vì đăng nhập sai nhiều lần. Vui lòng liên hệ quản trị viên để giải quyết');</script>";
                    }
                }   
            } 
            else
            {
                $thongbaophone='Số điện thoại không hợp lệ';
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

    

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"
        integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link href="assets/fonts/fontawesome/fontawesome-free-6.0.0-web/css/all.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
    <script src="jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>ĐĂNG NHẬP</title>
    <link rel="stylesheet" href="/style.css">
</head>

<body style="font-size:15px">
    <div class="bank-app-log" >
        <div class="header-log">
            <div class="headerhead-log">
                <div class="logo-log">
                    <img src="assets/img/Logo_signature.webp" alt="" class="logo-img-log">
                </div>
                <div class="header-content-log">
                    <img src="assets/img/ic_support.svg" alt="" class="headphone">
                    <p>19008198</p>
                </div>
            </div>

        </div>
        <div class="banner-log">
            <div class="banner-content-log" id="banner-content-log">
                <h1 style="font-size: 25px;"> Đăng ký thành viên BigPay - Tích điểm thưởng và nhận ưu đãi</h1>
                <p>Nhanh chóng, tiện lợi và an toàn. Đăng ký liền tay, rinh ngay quyền lợi.</p>
            </div>
        </div>
        <div class="main-log" id="main-login">
            <div class="container-form-log" id="login-form-log">
                <form action="" method="POST" enctype="multipart/form-data" class="form-content-log">
                    <div>
                        <h2 style="text-align: center;">Đăng nhập</h2>
                    </div>
                    <div class="phonebox input__form-log" style="position: relative;">
                        <div class="label-log">Số điện thoại</div>
                        <input type="text" name="phone" require value="<?=$_POST['phone']?>">
                        <i class="fa-solid fa-phone" style="position: absolute;right: 5%;top: 40px;"></i>
                    </div>
                    <p style="color: #ee4d2d;" id="mess"><?= $thongbaophone?></p>
                    <div class="mailbox input__form-log" style="position: relative;">
                        <div class="label-log">Mật khẩu</div>
                        <input type="password" name="pass" require>
                        <i class="fa-solid fa-key" style="position: absolute;
                            right: 5%;top:40px; color: #222;"></i>
                    </div>
                    <p style="color: #ee4d2d;" id="mess"><?=$thongbaopass?></p>
                    <div class="btnbox">
                        <button class="btndk-log input__form-log submit" type="submit" name="login" style="width: 100%;border-radius:15px;padding:10px 0px">Đăng nhập</button>
                    </div>

                    <div class="form-footer-log" style="font-size: 18px;">
                        <p>Quên mật khẩu? <a href="forgotpass.php" style="color: #f65e39;">Nhấn vào đây</a></p>
                        <p>Bạn chưa có tài khoản BigPay? <a href="dangky.php" style="color: #f65e39;">Đăng ký</a></p>
                    </div>
                </form>
                <div class="showinfo">
                    <p id="showmess"></p>
                </div>
            </div>
            <div class="box-content-log">
                <div class="box-content_list-log">
                    <div class="box-content-item-log">
                        <img class="box-content-item-img-log" src="assets/img/coins@2x.png" alt="">
                        <h3 class="box-content-item-title-log">Giao dịch nhanh chóng và tiện lợi</h3>
                        <p class="box-content-item-main-log">Giao dịch 24/7 mọi lúc mọi nơi. Phương thức thanh toán tiện
                            lợi, an toàn. </p>
                    </div>
                    <div class="box-content-item-log">
                        <img class="box-content-item-img-log" src="assets/img/backpack@2x.png" alt="">
                        <h3 class="box-content-item-title-log-log">Đầu tư tài chính</h3>
                        <p class="box-content-item-main">An toàn tuyệt đối, hạn chế rủi ro, lãi suất hấp dẫn</p>
                    </div>

                    <div class="box-content-item-log">
                        <img class="box-content-item-img-log" src="assets/img/top-sales@2x.png" alt="">
                        <h3 class="box-content-item-title-log">Dịch vụ thông minh</h3>
                        <p class="box-content-item-main-log">Mua sắm trực tuyến, thanh toán hóa đơn, đặt vé máy bay, book
                            phòng khách sạn... Tất cả chỉ cần có BigPay</p>
                    </div>

                    <div class="box-content-item-log">
                        <img class="box-content-item-img-log" src="assets/img/wallet@2x.png" alt="">
                        <h3 class="box-content-item-title-log">Ưu đãi mỗi ngày</h3>
                        <p class="box-content-item-main-log">Quà tặng cho khách hàng mới. Giao dịch miễn phí voucher liền
                            tay.</p>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="footer-header">
            </div>
            <div class="footer-list">
                <p>Copyright @ 2022 BHK Bank. All rights reserved.</p>
            </div>

        </footer>
    </div>
    <script src="../bank/script.js"></script>
</body>

</html>