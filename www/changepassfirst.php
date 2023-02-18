<?php
require('config.php');
	session_start();
    if(!isset($_SESSION['username'])){
        header('Location:login.php');
    }

$key='';
    $keyuser='';
    unset($_SESSION["thongbaopass"]);
    if (isset($_SESSION['username']) && $_SESSION['username'])
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
                $status=$row['status'];
                $pass=$row['password'];
                $loginfirst=$row['loginfirst'];
                if($loginfirst=='false')
                    header('home.php');
            }
        } 
        else 
        {
        }
    }
    if($loginfirst=='false')
        header('home.php');
    if (isset($_POST['changepass'])) 
    {
        $passnew=$_POST['passnew'];
        $passrepeat=$_POST['passrepeat'];
        if(strlen($passnew)<=6)
        $_SESSION["thongbaopass"]='Mật khẩu phải dài hơn 6 ký tự';
        else
        {
            if(strcmp($passnew,$passrepeat)!=0)
            $_SESSION["thongbaopass"]='Mật khẩu không trùng khớp';
            else
            {
                $sql="update users set password='$passnew',loginfirst='false' where username='$username'";
                if ($con->query($sql) === TRUE) 
                {
                    $_SESSION["thongbaopass"]='Thay đổi mật khẩu thành công';
                    $_SESSION['loginfirst']='false';
                    header('location:home.php');
                    session_unset($_SESSION['loginfirst']);
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
    <title>ĐỔI MẬT KHẨU KHI ĐĂNG NHẬP LẦN ĐẦU TIÊN</title>
    
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
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="app">
        <?php
            include('header.php');
        ?>
        <div class="main">
            <div class="grid">
                <div class="profile">
                    <div class="menu col-md-2 col-sm-12">
                        <div class="menu-header">
                            <a href="account.php" style="color:black">
                                <i class="fas fa-edit"></i> 
                                    Chỉnh sửa hồ sơ
                            </a>
                                <a style="margin-left: 25px;text-decoration: none;list-style: none;color:blue">Đổi mật khẩu</a>
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
                                <p class="mainbox-header__main" style="text-transform: none;">Thay đổi mật khẩu khi đăng nhập lần đầu</p>
                        </div>
                        <div class="mainbox-content">
                            <div class="mainbox-content__form">
                                <form action="" method="post" class="row" >
                                    <table class="table__form">
                                        <div class="profile-security col-sm-8" >
                                            <div class="table__form-item row">
                                                    <div class="table__form-item-title col-md-12 col-xl-3">
                                                        Tên chủ tài khoản
                                                    </div>
                                                    <div class="table__form-item-content col-md-9">
                                                        <input class="inputaccount" type="text" name="passold" value="<?= $name?>" disabled style="background-color: RGB(240, 232, 223)">
                                                    </div>
                                            </div>
                                            <div class="table__form-item row">
                                                <div class="table__form-item-title col-md-12 col-xl-3">
                                                    Mật khẩu mới
                                                </div>
                                                <div class="table__form-item-content col-md-9">
                                                    <input class="inputaccount" type="password" name="passnew">
                                                </div>
                                            </div>
                                            <div class="table__form-item row">
                                                <div class="table__form-item-title col-md-12 col-xl-3">
                                                    Nhập lại mật khẩu
                                                </div>
                                                <div class="table__form-item-content col-md-9">
                                                    <input class="inputaccount" type="password" name="passrepeat">
                                                </div>
                                            </div>
                                            <div class="row" >
                                                <button type="submit" class="btn-update" style="margin:0 auto" name="changepass" >Lưu</button>
                                            </div>
                                            <div class="thongbaopass" style="color: #ee4d2d; text-align:center;margin-top: 5px;">
                                                <?php
                                                
                                                    if(isset($_SESSION["thongbaopass"]))
                                                    {
                                                        echo $_SESSION["thongbaopass"];
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </table>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <script src="main.js"></script>

</body>

</html>