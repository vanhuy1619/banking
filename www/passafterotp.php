<?php
    session_set_cookie_params(0);   
    session_start();
    require('config.php');

    if(!isset($_SESSION['otp']))
    {
        header('Location:login.php');
    }
    
    unset($mess);
    $mess='';


    if (isset($_POST['login'])) 
    {
        $phone=$_SESSION['phone'];
        
        $passnew=$_POST['passnew'];
        $passrepeat=$_POST['passrepeat'];

        if(strlen($passnew)<=6)
        $mess='Mật khẩu phải dài hơn 6 ký tự';
        else
        {
            if(strcmp($passnew,$passrepeat)!=0)
            $mess='Mật khẩu không trùng khớp';
            else
            {
                $sql="update users set password='$passnew',loginfirst='false' where phone='$phone'";
                if ($con->query($sql) === TRUE) 
                {
                    echo "<script>alert('Thay đổi mật khẩu thành công. Vui lòng quay trở lại đăng nhập'); window.location = 'login.php';</script>";
                    session_destroy();
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

    <link rel="stylesheet" href="assets/css/log.css">

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
    <title>BIG PAY</title>
</head>

<body>
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
                <h1> Đăng ký thành viên BHK Bank - Tích điểm thưởng và nhận ưu đãi</h1>
                <p>Nhanh chóng, tiện lợi và an toàn. Đăng ký liền tay, rinh ngay quyền lợi.</p>
            </div>
        </div>
        <div class="main-log">
            <div class="container-form-log">
                <form action="" method="POST" enctype="multipart/form-data" class="form-content-log">
                    <div>
                        <h2 style="text-align: center;">Tạo mới mật khẩu</h2>
                    </div>
                    <!-- PASS MỚI -->
                    <div class="mailbox input__form-log"-log style="position: relative;">
                        <div class="label-log">Mật khẩu mới</div>
                        <input type="password" name="passnew" require>
                        <i class="fa-solid fa-key" style="position: absolute;
                            right: 5%;top:40px; color: #222;"></i>
                    </div>
                    <!-- XÁC NHẬN PASS MỚI -->
                    <div class="mailbox input__form-log" style="position: relative;">
                        <div class="label-log">Xác nhận mật khẩu</div>
                        <input type="password" name="passrepeat" require>
                        <i class="fa-solid fa-key" style="position: absolute;
                            right: 5%;top:40px; color: #222;"></i>
                    </div>
                    <div class="btnbox">
                        <button class="btndk-log input__form-log submit" type="submit" name="login" style="width: 100%;border-radius:15px;padding:10px 0px">Xác nhận</button>
                    </div>
                    <p style="color: #ee4d2d;text-align:center"><?= $mess?></p>
                    <div class="form-footer-log" style="font-size: 18px;">
                        <p>Quay lại trang <a href="login.php" style="color: #f65e39;">Đăng nhập</a></p>
                        <p>Bạn chưa có tài khoản BHK Bank? <a href="dangky.php" style="color: #f65e39;">Đăng ký</a></p>
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