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

    $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";  
    
    $_SESSION['thongbaophone']='';
    $_SESSION['thongbaoemail']='';

    

    function sendActivationEmail($email,$otp)
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
            $mail->Subject = 'MÃ OTP KHÔI PHỤC MẠT KHẨU';
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

    if(isset($_POST['login']))
    {
        
        $phone=$_POST['phone'];
        $email=$_POST['email'];
        $timeotp=time();
        
        //LẤY USERNAME
        $sql = "select * from users where phone='$phone'";
        $result = $con->query($sql);
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc()) 
            {
                $username=$row['username'];
            }
        } 
        else 
        {
        }

        if(empty($phone))
        {
            $_SESSION['thongbaophone']="Nhập số điện thoại";
        }
        else if (is_numeric($_POST['phone'])!=1||strlen($_POST['phone'])!=10||substr($_POST['phone'],0,1)!=0)
        { 
            $_SESSION["thongbaophone"]='Số điện thoại không hợp lệ';
        }
        else if(empty($email))
        {
            $_SESSION['thongbaoemail']="Nhập địa chỉ email";
        }
        else if (!preg_match($pattern, $email))
        {
             $_SESSION["thongbaodk"]='Địa chỉ email không hợp lệ';
        }
       else
        {
            $sql="select * from users where phone='$phone' and email='$email'";
            $query=mysqli_query($con,$sql);
            $num=mysqli_num_rows($query);
            if($num!=0) //hợp lệ
            {
                $_SESSION['phone']=$phone;
                $_SESSION['email']=$email;
                $otp=rand_string(6);
                
                $sql2 = "insert into otp(username,phone,email,otp,dateotp) values('$username','$phone','$email','$otp','$timeotp')";
                $them = mysqli_query($con, $sql2);  
                if ($them) 
                {
                    sendActivationEmail($email,$otp);
                    header('location:otpinput.php');
                }
                else 
                {
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

<body style="font-size: 15px">
    <div class="bank-app-log">
        <div class="header-log">
            <div class="headerhead-log">
                <div class="logo-log">
                    <img src="assets/img/BHK BANK.png" alt="" class="logo-img-log">
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
            <div class="container-form-log" style="font-size:15px">
                <form action="" method="POST" enctype="multipart/form-data" class="form-content-log">
                    <div>
                        <h2 style="text-align: center;">Quên mật khẩu</h2>
                    </div>
                    <div class="phonebox input__form-log" style="position: relative;">
                        <div class="label-log">Số điện thoại</div>
                        <input type="number" name="phone" require value="<?=$_POST['phone']?>">
                        <i class="fa-solid fa-phone" style="position: absolute;right: 5%;top: 40px;"></i>
                    </div>
                    <p style="color: #ee4d2d;"><?= $_SESSION['thongbaophone']?></p>
                    <div class="mailbox input__form-log" style="position: relative;">
                        <div class="label-log">Địa chỉ email</div>
                        <input type="email" name="email" require>
                        <i class="fas fa-envelope" style="position: absolute;
                            right: 5%;top:40px; color: #222;"></i>
                    </div>
                    <p style="color: #ee4d2d;"><?= $_SESSION['thongbaoemail']?></p>
                    <div class="btnbox">
                        <button class="btndk-log input__form-log submit" type="submit" name="login" style="width: 100%;border-radius:15px;padding:10px 0px">Xác nhận</button>
                    </div>

                    <div class="form-footer-log" style="font-size: 18px;">
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

</body>

</html>