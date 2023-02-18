<?php
    session_start();
    require('config.php');
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
    require 'vendor/phpmailer/phpmailer/src/Exception.php';
    require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require 'vendor/phpmailer/phpmailer/src/SMTP.php';
    require 'vendor/autoload.php';

    

    if(!isset($_SESSION['phone']))
    {
        header('Location:login.php');
    }
    
    function sendActivationEmail($email,$otp)
    {
        $mail=new PHPMailer();
        try
        {
            $mail->isSMTP();                      
            $mail->CharSet='UTF-8';                                            
            $mail->Host   = 'smtp.gmail.com';                     
            $mail->SMTPAuth   = true;                                  
            $mail->Username   = 'khoanguyen30lb@gmail.com';                     
            // $mail->Password   = 'vswbeityyoqckiph';  
            $mail->Password   = 'henrynguyen';                            
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
            $mail->Port       =465;  

            $mail->setFrom('khoanguyen30lb@gmail.com', 'Admin');
            $mail->addAddress($email, 'Người nhận');     

            $mail->isHTML(true);    
            $mail->setFrom('khoanguyen30lb@gmail.com');                              
            $mail->Subject = 'Mật khẩu đăng nhập của bạn';
            $mail->Body    = "Mã OTP có hiệu lực trong 1 phút: <h3>$otp</h3>";

            $mail->send();
            return true;
        }
        catch(Exception $e)
        {
            return false;
        }
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

    //OTP
    function checkOtp($db,$phone)
    {
        $mydate=time();
        $sql = "SELECT * FROM otp where phone='$phone' and $mydate-dateotp<=60" ;
        if ($result=mysqli_query($db,$sql)) 
        {
            $rowcount=mysqli_num_rows($result);
        }
        return $rowcount; 
    }

    unset($thongbaootp);
    
    $thongbaootp='';

    $phone=$_SESSION['phone'];
    $email=$_SESSION['email'];

    if(isset($_POST['login']))
    {
        $otp=$_POST['otp'];
        if(empty($otp))
        {
            $thongbaootp="Nhập mã OTP";
        }
        else
        {
            $sql="select * from otp where phone='$phone' and otp='$otp'";
            $query=mysqli_query($con,$sql);
            $num=mysqli_num_rows($query); //kiểm tra dòng chưa otp
            if($num!=0 && checkOtp($con,$phone)!=0) //hợp lệ
            {
                $_SESSION['otp']='true';
                header('location:passafterotp.php'); 
            }
            else
            {
                $thongbaootp="Mã OTP sai hoặc đã hết hiệu lực";
            }
        }
    }

    //MÃ MỚI
    if(isset($_POST['newotp']))
    {
        $otpnew=rand_string(6);
        $timeotp=time();
        $sql = "select * from users where phone='$phone'";
        $result = $con->query($sql);
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc()) 
            {
                $username=$row['username'];
                $email=$row['email'];
            }
        } 
        else 
        {
        }
        $sql = "insert into otp(username,phone,email,otp,dateotp) values('$username','$phone','$email','$otpnew','$timeotp')";
        $them = mysqli_query($con, $sql);  
        if ($them) 
        {
            sendActivationEmail($email,$otpnew);
        }
        else 
        {
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">

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

    <script src="main.js"></script>
    <link rel="stylesheet" href="assets/css/responsive.css">
    <title>QUÊN MẬT KHẨU</title>
</head>

<body style="font-size: 15px;font-family: Nunito,sans-serif;">
    <div class="bank-app-log">
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
        <div class="main-log">
            <div class="container-form-log">
                <form action="" method="POST" enctype="multipart/form-data" class="form-content-log">
                    <div>
                        <h2 style="text-align: center;">Xác nhận mã OTP</h2>
                    </div>
                    <div class="phonebox input__form-log" style="position: relative;">
                        <div style="display:flex;height: 100%;margin-bottom: 10px;align-items: center;justify-content: space-between;">
                            <div style="font-size: 20px;">Mã OTP</div>
                            
                            <!-- <a style="color: #ee4d2d;">Tạo mã mới</a> -->
                        </div>
                        <!-- INPUT OTP -->
                        <input type="number" name="otp" id="otp" require>
                        <i class="fa-solid fa-phone" style="position: absolute;right: 5%;top: 45px;"></i>
                    </div>
                    
                    
                    <div class="btnbox">
                        <button class="btndk-log input__form-log submit" type="submit" id="login" name="login" style="width: 100%;border-radius:15px;padding:10px 0px">Xác nhận</button>
                    </div>
                    <div class="btnbox">
                        <button class="btndk-log input__form-log submit" onclick="newotp()" id="newotp" type="submit" name="newotp" style="width: 100%;border-radius:15px;padding:10px 0px;display:none">Tạo mã mới</button>
                    </div>
                   
                    <div class="form-footer-log" style="font-size: 18px;">
                        <p style="color: #ee4d2d;" id="messotp"><?=$thongbaootp?></p>
                        <p>Mã có hiệu lực trong: <span id="timer" style="color: #2d3aee;"></span></p>
                        <p>Quay lại trang <a href="login.php" style="color: #f65e39;">Đăng nhập</a></p>
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
    
    <script>
    

        //ĐẾM NGƯỢC
        let timerOn = true;
        function timer(remaining) 
        {
            var m = Math.floor(remaining / 60);
            var s = remaining % 60;
            
            m = m < 10 ? '0' + m : m;
            s = s < 10 ? '0' + s : s;
            document.getElementById('timer').innerHTML = m + ':' + s;
            remaining -= 1;
            
            if(remaining >= 0 && timerOn) {
                setTimeout(function() {
                    timer(remaining);
                }, 1000);
                return ;
            }
            if(!timerOn) 
            {
                return ;
            }
        }
        timer(60)

        //VÔ HIỆU INPUT OTP
        const otpInput = document.getElementById("otp")
        otpInput.disabled = false;
        setTimeout(()=>
        {
            otpInput.disabled = true;
            document.getElementById('login').style.display='none'
            document.getElementById('newotp').style.display='block'
        }, 60000)

        function newotp()
        {
            document.getElementById('login').style.display='block'
            document.getElementById('newotp').style.display='none'
        }
    </script>
</body>

</html>