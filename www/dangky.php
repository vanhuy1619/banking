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
    <title>ĐĂNG KÝ</title>
</head>

<body>
    <!-- <div>
        <?php
        unset($thongbaodk);
        $thongbaodk='';
        $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";  
        function rand_string($length)
        {
            $str = '';
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $size = strlen($chars);
            for ($i = 0; $i < $length; $i++) {
                $str .= $chars[rand(0, $size - 1)];
            }
            
            return $str;
        }

        //EMAIL
        function sendActivationEmail($email,$pass)
        {
            $mail=new PHPMailer();
            try{
                $mail->isSMTP();                      
                $mail->CharSet='UTF-8';                                            
                $mail->Host       = 'smtp.gmail.com';                     
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
                $mail->Body    = "Mật khẩu đăng nhập của bạn là: <h3>$pass</h3>";

                $mail->send();
                return true;
            }
            catch(Exception $e)
            {
                return false;
            }
        }
        //CMND_T
        $filename = $_FILES["image1"]["name"];
        $tempname = $_FILES["image1"]["tmp_name"];    
        $folder = "uploads/".$filename;
        $imgFileType = pathinfo($folder, PATHINFO_EXTENSION);
        $valid_extensions = array("jpg", "jpeg", "png");
        if (in_array(strtolower($imgFileType), $valid_extensions)) 
        {
            move_uploaded_file($tempname, $folder);
        }

        //CMND_S
        $filename2 = $_FILES["image2"]["name"];
        $tempname2 = $_FILES["image2"]["tmp_name"];    
        $folder = "uploads/".$filename2;
        $imgFileType2 = pathinfo($folder, PATHINFO_EXTENSION);
        $valid_extensions2 = array("jpg", "jpeg", "png");
        
        

        if (isset($_POST['submit'])) 
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
            else if(empty($filename)||empty($filename2))
            {
                $thongbaodk='Chọn ảnh chứng minh nhân dân';
            }
            //Ảnh
            
            //thỏa mãn đầy đủ yêu cầu
            else 
            {
               
                $password=rand_string(6);
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                $nameInput=$_POST['name'];
                $address=$_POST['address'];
                
                $sqlphone = "select *from users where phone='$phone'";
                $sqlemail = "select *from users where email='$email'";
                // $sqlname= "select *from users where name='$hoten'";
                // $sqladdress="select *from users where address='$diachi'";

                $query1 = mysqli_query($con, $sqlphone);
                $query2 = mysqli_query($con, $sqlemail);
                // $query3 = mysqli_query($con, $sqlname);
                // $query4 = mysqli_query($con, $sqladdress);

                $num1 = mysqli_num_rows($query1);
                $num2 = mysqli_num_rows($query2);

                
                
                if ($num1 == 0 and $num2 == 0) //nếu cả 2 chưa có
                {
                    $username = mt_rand(1000000000, 9999999999);
                    $sql2 = "INSERT INTO users (phone, email, name, address, cmndT, cmndS, username, password, status, loginfirst)
                     VALUES ('$phone','$email','$nameInput','$address','$filename','$filename2','$username','$password','Chờ xác minh','true')";
                    // $them = mysqli_query($con, $sql);
                    if (in_array(strtolower($imgFileType2), $valid_extensions2)) 
                    {
                        move_uploaded_file($tempname2, $folder);
                    }
                    if ($con->query($sql2) == TRUE) 
                    {
                        if(sendActivationEmail($email,$password)==true)
                            $thongbaodk='Đăng ký tài khoản thành công';
                        else
                            $thongbaodk='Email fail';
                        // sendActivationEmail($email);
                    }
                    else 
                    {
                    }
                }
                else //đã có rồi
                {
                    $thongbaodk='Thông tin tài khoản đã tổn tại. Vui lòng kiểm tra lại';
                }
                // sendActivationEmail($email);
            }
            // echo  $alert;
        }
        ?>
    </div> -->
    <div class="bank-app-log" style="font-size: 15px">
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
                        <h2 style="text-align: center;">Đăng ký thành viên</h2>
                    </div>
                    <div class="thongbao-log" style="color: #ee4d2d;"><?= $thongbaodk?></div>
                    <div class="phonebox input__form-log" style="position: relative;">
                        <div class="label-log">Số điện thoại</div>
                        <input type="text" name="phone" require>
                        <i class="fa-solid fa-phone" style="position: absolute;right: 5%;top: 40px;"></i>
                    </div>
                    <div class="mailbox input__form-log" style="position: relative;">
                        <div class="label-log">Địa chỉ email</div>
                        <input type="email" name="email" require>
                        <i class="fas fa-envelope" style="position: absolute;
                            right: 5%;top:40px; color: #222;"></i>
                    </div>
                    <div class="input__form-log namebox">
                        <div class="label-log">Họ và tên</div>
                        <input type="text" name="name" id="name" require>

                    </div>
                    <div class="addressbox input__form-log">
                        <div class="label-log">Địa chỉ liên lạc</div>
                        <input type="text" name="address" id="address" class="address">
                    </div>
                    <div class="cmndt input__form-log">
                        <div class="label-log">Hình chứng minh nhân dân mặt trước</div>
                        <input type="file" name="image1" id="fileSelect"
                            style="height: 30px;border: 0px; border-radius: 0px;">
                    </div>
                    <div class="cmnds input__form-log">
                        <div class="label-log">Hình chứng minh nhân dân mặt sau</div>
                        <input type="file" name="image2" id="fileSelect"
                            style="height: 30px;border: 0px; border-radius: 0px;">
                    </div>
                    <div class="btnbox">
                        <button class="btndk-log input__form-log submit" type="submit" name="submit" style="width: 100%;border-radius:15px;padding:10px 0px">Đăng ký</button>
                    </div>

                    <div class="form-footer-log">
                        <p style="font-size:18px">Bạn đã có tài khoản BigPay? <a href="login.php" style="color: #f65e39;font-size:18px"> Đăng nhập</a></p>
                        <p style="font-size: 20px;"><i class="fa fa-check" aria-hidden="true"></i>Tôi đồng ý với <span style="font-weight: 700;">Bảo mật</span> và <span
                                style="font-weight: 700;">Điều khoản hoạt động</span> của BigPay.</p>
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
                <p>Copyright @ BIGPAY Bank. All rights reserved.</p>
            </div>

        </footer>
    </div>

    <script>
        
    </script>
</body>

</html>