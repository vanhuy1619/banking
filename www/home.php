<?php
    // session_set_cookie_params(0);
    session_start();
    require('config.php');
    
    if(!isset($_SESSION['username']))
    {
        header('Location:login.php');
    }
    if($_SESSION['loginfirst']=='true')
    {
        header('Location:changepassfirst.php');
    }
    // if (isset($_SESSION['CREATE_URI']) && $_SESSION['CREATE_URI'] !== $_SERVER['REQUEST_URI']) {
    //     unset($_SESSION['CREATE_URI']);
    //  }

    //CHUYỂN SESSION STATUS
    if(isset($_SESSION['username']))
    {
        $username=$_SESSION['username'];
        $sql = "select * from users where username='$username'";
        $result = $con->query($sql);
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc()) 
            {
                $_SESSION['status']=$row['status'];
                $phone=$row['phone'];
                $moneyhave=$row['money'];
            }
        } 
        else 
        {
        }
    }
    if(isset($_POST['thanhtoan']))
    {
        $idcardnumber='';
        $pricecard='';
        $soluong=0;
        $nhamang='';
        $listidcard=array();

        function rand_string($type,$length)
        {
            $str = '';
            $chars = "0123456789";
            $size = strlen($chars);
            for ($i = 0; $i < $length; $i++) 
            {
                $str .= $chars[rand(0, $size - 1)];
            }
            if($type=='viettel')
                return '11111'.$str;
            if($type=='mobifone')
                return '22222'.$str;
            if($type=='vinaphone')
                return '33333'.$str;
        }
        if(empty($_POST['pricecard']))
        {
            header('location:home.php');
        }
        if(!empty($_POST['pricecard'])) 
        {
            $pricecard = $_POST['pricecard'];
            if($pricecard=='10000')
            {
                $pricecard='10000';
            }
            if($pricecard=='20000')
            {
                $pricecard='20000';
            }
            if($pricecard=='50000')
            {
                $pricecard='50000';
            }
            if($pricecard=='100000')
            {
                $pricecard='100000';
            }
        }
        if(!empty($_POST['nhamang'])) 
        {
            $nhamang = $_POST['nhamang'];
            if($nhamang=='viettel')
            {
                $nhamang='viettel';
            }
            if($nhamang=='mobifone')
            {
                $nhamang='mobifone';
            }
            if($nhamang=='vinaphone')
            {
                $nhamang='vinaphone';
            }
        }
        if(!empty($_POST['soluong'])) 
        {
            $soluong = $_POST['soluong'];
            if($soluong=='1')
            {
                $soluong='1';
            }
            if($soluong=='2')
            {
                $soluong='2';
            }
            if($soluong=='3')
            {
                $soluong='3';
            }
            if($soluong=='4')
            {
                $soluong='4';
            }
            if($soluong=='5')
            {
                $soluong='5';
            }
        }
        if($soluong*$pricecard>$moneyhave)
        {
            echo "<script>alert('Số dư tài khoản không đủ để giao dịch');</script>";
        }
        if(!empty($pricecard) && !empty($nhamang) && !empty($soluong) && $soluong*$pricecard<=$moneyhave)
        {
            for($i=0;$i<$soluong;$i++)
            {
                $_SESSION[$i]=$listidcard[$i]=rand_string($nhamang,5);

            }

            $sql="insert into buycard(username,phone,nhamang,moneycard,soluong,phigiaodich,idcard) values ('$username','$phone','$nhamang','$pricecard','$soluong','0','$listidcard[0]-$listidcard[1]-$listidcard[2]-$listidcard[3]-$listidcard[4]')";
            if ($con->query($sql) === TRUE) 
            {
                $_SESSION['nhamang']=$nhamang;
                $_SESSION['pricecard']=$pricecard;
                $_SESSION['soluong']=$soluong;
                $_SESSION['listidcard']=$listidcard;

                $sql1="update users set money=money-'$pricecard'*$soluong where phone='$phone'";
                if ($con->query($sql1) === TRUE )
                {
                    header('location:resultbuycard.php');
                    $_SESSION['bought']=true;
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
    <title>BIG PAY</title>


    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"
        integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    
    <link href="assets/fonts/fontawesome/fontawesome-free-6.0.0-web/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link href="assets/fonts/fontawesome/fontawesome-free-6.0.0-web/css/all.min.css" rel="stylesheet">
    <link
    href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
    rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
    integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- <link rel="stylesheet" href="lightslider.css"> -->
    <!-- <script type="text/javascript" src="JQuery3.3.1.js"></script> -->
    <!-- <script type="text/javascript" src="lightslider.js"></script> -->
    <!-- <script src="main.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />


    <link rel="stylesheet" href="/style.css">
</head>

<body>
    <div class="app">
        <?php
            require('header.php');
        ?>
        <section class="home" id="home">
            <div class="content">
            </div>
        </section>

        <section class="features" id="features">
            <h1 class="heading"><span class="">DỊCH VỤ</span></h1>
            <div class="box-container">
                <a class="box" href="account.php">
                    <img class="box-img" src="assets/img/breadcrumb-2.png" alt="">
                    <h3 class="box-title">Quản lý tài khoản</h3>
                </a>
                <a class="box" href="naptien.php">
                    <img class="box-img"
                        src="assets/img/box-home-2.svg"
                        alt="">
                    <h3 class="box-title">Nạp tiền</h3>

                </a>
                <a class="box" href="ruttien.php">
                    <img class="box-img" src="assets/img/box-home-3.svg"
                        alt="">
                    <h3 class="box-title">Rút tiền</h3>

                </a>
                <a class="box" href="chuyentien.php">
                    <img class="box-img"
                        src="assets/img/box-home-4.svg"
                        alt="">
                    <h3 class="box-title">Chuyển tiền</h3>
                </a>
                <a class="box" onclick="buycard()">
                    <img class="box-img"
                        src="https://simg.zalopay.com.vn/zlp-website/assets/icon_dienthoai_4043b21b86.svg" alt="">
                    <h3 class="box-title">Mua thẻ</h3>
                </a>
                <a class="box" href="lsgd.php">
                    <img class="box-img" src="assets/img/feature-img-3.png" alt="">
                    <h3 class="box-title">Lịch sử giao dịch</h3>
                </a>
            </div>
        </section>

        <!-- FOOTER -->
        <div class="why-back">
        <div class="we-are">
            <img src="assets/img/Home_analytic.webp" class="we-are-img-1 col-sm-12 col-md-6" alt="">
            <div class="we-are-content col-sm-12 col-md-6">
                <h1>Trở thành một người tiết kiệm thành công hơn</h1>
                <div class="security-content-item">
                    <div class="check-icon">
                        <img src="assets/img/tick-icon.svg" alt="">
                    </div>
                    <div class="btnh-content">Quản lý chi tiêu giúp bạn tiết kiệm.</div>
                </div>
                <div class="security-content-item">
                    <div class="check-icon">
                        <img src="assets/img/tick-icon.svg"
                            alt="">
                    </div>
                    <div class="btnh-content">Kết nối tài khoản của bạn từ hơn 140 tổ chức tài chính để xem tất cả trong một ứng dụng.</div>
                </div>
                <div class="security-content-item">
                    <div class="check-icon">
                        <img src="assets/img/tick-icon.svg"
                            alt="">
                    </div>
                    <div class="btnh-content">Tiêu tiền theo cách của bạn, ngay lập tức. Thiết lập ví kỹ thuật số của bạn với Apple Pay, Google Pay ™, Samsung Pay, Fitbit Pay và Garmin Pay.</div>
                </div>
            </div>
        </div>
        <div class="we-are" style="flex-wrap:wrap-reverse">
            <div class="we-are-content col-sm-12 col-md-6">
                <h1>Tốt cho tất cả tài khoản thanh toán của bạn</h1>
                <div class="security-content-item">
                    <div class="check-icon">
                        <img src="assets/img/tick-icon.svg" alt="">
                    </div>
                    <div class="btnh-content" style="line-height:2">BigPay của bạn cũng có thể được sử dụng ở mọi nơi trên thế giới, trực tuyến hoặc ngoại tuyến. Nhưng đó không phải là tất cả. Thực hiện chuyển khoản ngân hàng trong nước hoặc quốc tế từ điện thoại của bạn. Gửi tiền cho bạn bè của bạn hoặc chia hóa đơn trong một vài thao tác. Nó siêu dễ dàng.</div>
                </div>
            </div>
            <img src="assets/img/Home_payment mock.webp" class="we-are-img-1 col-sm-12 col-md-6" alt="">
        </div>
        </div>
        <div class="why">
            
        </div>

        <div class="security">
            <h1 class="heading"><span class="">AN TOÀN BẢO MẬT</span></h1>
            <div class="security-header security-header-list tab">
                <div class=" tablinks" onclick="openItem(event,'BCNH')" id="defaultOpen">Bảo chứng ngân hàng</div>
                <div class=" tablinks" onclick="openItem(event,'BMDT')">Bảo mật đa tầng</div>
                <div class=" tablinks" onclick="openItem(event,'DCQT')">Đạt chuẩn quốc tế</div>
            </div>

            <div class="security-box tabcontent" id="BCNH">
                <div class="sc-left">
                    <div class="security-content-item">
                        <div class="check-icon">
                            <img src="assets/img/tick-icon.svg" alt="">
                        </div>
                        <div class="btnh-content">Được Ngân hàng Nhà nước cấp phép hoạt động trong lĩnh vực trung gian
                            thanh toán.</div>
                    </div>
                    <div class="security-content-item">
                        <div class="check-icon">
                            <img src="assets/img/tick-icon.svg" alt="">
                        </div>
                        <div class="btnh-content">Liên kết với 39 ngân hàng, tổ chức chuyển mạch tài chính & 3 tổ chức
                            thẻ quốc tế.</div>
                    </div>
                    <div class="security-content-item">
                        <div class="check-icon">
                            <img src="assets/img/tick-icon.svg" alt="">
                        </div>
                        <div class="btnh-content">Nạp/rút tiền từ ngân hàng vào ví hoặc từ ví về ngân hàng liên kết mọi
                            lúc, mọi nơi.</div>
                    </div>
                </div>
                <div class="bcnh-right">
                    <div class="bcnh-item-img">
                        <img src="assets/img/bcnh.svg" alt="" class="bcnh-img">
                    </div>
                </div>
            </div>
            <div class="security-box tabcontent" id="BMDT">
                <div class="sc-left">
                    <div class="security-content-item">
                        <div class="check-icon">
                            <img src="assets/img/tick-icon.svg" alt="">
                        </div>
                        <div class="btnh-content">Cơ chế bảo mật kép gồm mật khẩu thanh toán và OTP, ứng dụng công nghệ
                            bảo mật sinh trắc học trong hoạt động cung ứng dịch vụ như xác thực vân tay, FaceID.</div>
                    </div>
                    <div class="security-content-item">
                        <div class="check-icon">
                            <img src="assets/img/tick-icon.svg" alt="">
                        </div>
                        <div class="btnh-content">Hệ thống nhận diện và phát hiện giao dịch bất thường.</div>
                    </div>
                    <div class="security-content-item">
                        <div class="check-icon">
                            <img src="assets/img/tick-icon.svg" alt="">
                        </div>
                        <div class="btnh-content">Hệ thống chăm sóc khách hàng 24/7 đáp ứng như mọi nhu cầu thắc mắc,
                            khiếu nại, hỗ trợ... trong mọi trường hợp.</div>
                    </div>
                </div>
                <div class="bcnh-right">
                    <div class="bcnh-item-img">
                        <img src="assets/img/bmdt.svg" alt="" class="bcnh-img">
                    </div>
                </div>
            </div>
            <div class="security-box tabcontent" id="DCQT">
                <div class="sc-left">
                    <div class="security-content-item">
                        <div class="check-icon">
                            <img src="assets/img/tick-icon.svg" alt="">
                        </div>
                        <div class="btnh-content">Toàn bộ thông tin của bạn được bảo mật theo tiêu chuẩn bảo mật quốc tế
                            PCI DSS level 1 - đây là cấp độ cao nhất thường chỉ dành cho các ngân hàng và các đơn vị
                            phát hành thẻ.</div>
                    </div>
                    <div class="security-content-item">
                        <div class="check-icon">
                            <img src="assets/img/tick-icon.svg" alt="">
                        </div>
                        <div class="btnh-content"> Đã được cấp chứng chỉ quốc tế về hệ thống bảo mật & quản lý an ninh
                            thông tin ISO 27001.</div>
                    </div>
                    <div class="security-content-item">
                        <div class="check-icon">
                            <img src="assets/img/tick-icon.svg" alt="">
                        </div>
                        <div class="btnh-content"> Đã được cấp chứng chỉ quốc tế về hệ thống bảo mật & quản lý an ninh
                            thông tin ISO 27001.</div>
                    </div>
                </div>
                <div class="bcnh-right">
                    <div class="bcnh-item-img">
                        <img src="assets/img/03.png" alt="" class="bcnh-img">
                    </div>
                </div>
            </div>
        </div>

        <!-- MUA THẺ -->
        <?php
            require('buycard.php');
        ?>
    </div>

    <?php
        require('footer.php');
    ?>


    <!-- <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script> -->

    <script>
        function openItem(evt, item) 
        {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(item).style.display = "flex";
            evt.currentTarget.className += " active";
        }
        document.getElementById("defaultOpen").click();

        function buycard() {
            let buycardbox = document.getElementById('modalo');
            buycardbox.style.display = 'flex';
        }
        function clickclose() {
            let buycardbox = document.getElementById('modalo');
            buycardbox.style.display = 'none';
        }




        //Số lượng + giá
        let divTotal = document.getElementById('total')
        jQuery(document).ready(function ($) {
            var $value = $('.value');
            $value.on('input', function (e) {
                var total = 1;
                var sum;
                $value.each(function (index, elem) {
                    if ($(elem).is("input[type='radio']") && (!$(elem).is(":checked")))
                        return;
                    if (!Number.isNaN(parseInt(this.value, 10)))
                        total = total * parseInt(this.value, 10);
                    let dollarUSLocale = Intl.NumberFormat('en-US');
                    let totalMoneyFormat = dollarUSLocale.format(total);
                    sum = "Tổng cộng: " + totalMoneyFormat + " đồng";
                });

                divTotal.style.display = 'block'
                $('#total').val(sum);

            });
        });

        divNotiResult.innerHTML = document.getElementById('total').innerText;


        $.ajax({
            url: "logout.php",
            method: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {
                alert("session destroyed");
            }
        });





    </script>
</body>

</html>