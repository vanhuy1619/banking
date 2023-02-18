<?php
  require('config.php');
  session_start();
    if(!isset($_SESSION['username']))
    {
        header('Location:login.php');
    }
    if($_SESSION['loginfirst']=='true')
    {
        header('Location:changepassfirst.php');
    }
    if($_SESSION['bought']!=true)
    {
        header('Location:home.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mua thẻ</title>
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
  <script src="main.js"></script>
  <link rel="stylesheet" href="assets/css/responsive.css">
</head>

<body>
  <div class="app">
    <?php
      include_once('header.php');
    ?>
    <img src="assets/img/Banner_Telco_1920x480_c9abc69929.jpg" alt="" style="width:100%">
    <div class="main" style="margin-top:100px">
      <div style="text-align:center;">
        <h2 style="font-weight:700;font-family: Nunito,sans-serif;">ĐA DẠNG NHÀ MẠNG</h2>
        <p style="font-size:17px;text-align:center;width:60%;margin:0 auto;color:#697c8e;margin-top:20px">
          LINH HOẠT, TIỆN DỤNG khi sử dụng Ví BigPay mua mã thẻ điện thoại, nhận ngay ưu đãi sau mỗi giao dịch thành
          công.</p>
        <div class="nha-mang">
          <img src="assets/img/viettel.png" alt="" class="nha-mang-item">
          <img src="assets/img/vina.png" alt="" class="nha-mang-item">
          <img src="assets/img/mobil.png" alt="" class="nha-mang-item">
        </div>
      </div>
      <div style="border:1px solid #eee;margin-top:100px"></div>

      <div class="reason">
        <h2 style="font-weight:700;font-family: Nunito,sans-serif;text-align:center;margin-bottom:50px">VÌ SAO NÊN NẠP
          TIỀN ĐIỆN THOẠI QUA BigPay</h2>
        <div class="col-md-12 col-lg-6 col-sm-12 reason-img" id="left-form-rt">
          <div class="in-phone">
            <div class="in-phone-img in-phone-img-buycard" alt=""></div>
          </div>
          <div class="border-phone">
            <img src="assets/img/phone-border.svg" class="border-phone-img" alt="">
          </div>
        </div>
        <div class="col-md-12 col-lg-6 col-sm-12 reason-nap">
          <div class="reason-nap-item">
            <img src="assets/img/nap1.svg" alt="">
            <div>
              <div class="nap-reason-title">Nạp tiền điện thoại trực tiếp</div>
              <div>Hỗ trợ nạp tiền nhiều nhà mạng, thao tác dễ dàng, mọi lúc mọi nơi.</div>
            </div>
          </div>
          <div class="reason-nap-item">
            <img src="assets/img/nap2.svg" alt="">
            <div>
              <div class="nap-reason-title">Nạp tiền điện thoại cho bạn bè dễ dàng</div>
              <div>Nạp trực tiếp vào số điện thoại của bạn bè.</div>
            </div>
          </div>
          <div class="reason-nap-item">
            <img src="assets/img/nap3.svg" alt="">
            <div>
              <div class="nap-reason-title">Thao tác dễ dàng và nhanh chóng</div>
              <div>Không cần cào thẻ và đọc từng mã số dài dòng, tự động nhận biết số điện thoại, hỗ trợ nạp tiền tức
                thì chỉ với vài thao tác.</div>
            </div>
          </div>
          <div class="reason-nap-item">
            <img src="assets/img/nap4.svg" alt="">
            <div>
              <div class="nap-reason-title">Ưu đãi hoàn tiền, chiết khấu hấp dẫn</div>
              <div>Hoàn tiền về ví đến 5%. Hỗ trợ chọn lựa nhiều mệnh giá, số lượng thẻ và xem lịch sử mua.</div>
            </div>
          </div>
        </div>
      </div>

      <section class="d-flex flex-column justify-content-center">
        <div
          style=" background-color:#ee4d2d;padding: 35px 0px;margin:0 auto;text-align:center; font-size:30px; color:white;font-weight:600;border-top-left-radius:15px;border-top-right-radius:15px;"
          class="col-md-8 col-sm-12">
          <img src="assets/img/tick-icon.svg" alt="" style="width:50px">
          Giao dịch thành công
        </div>
        <form action="" method="POST" style="font-size:15px; margin: 0 auto; padding:0" class="col-md-8 col-sm-12 border"
          id="myForm">
          <div class="px-3">
            <div class="form-group">
              <label for="menhgia">Mệnh giá</label>
              <input name="nhamang" class="form-control" value="<?=$_SESSION['pricecard']?>"
                style="height:50px;border-radius:15px;" disabled>
            </div>
            <div class="form-group">
              <label for="nhamang">Nhà mạng</label>
              <input class="form-control" value="<?=strtoupper($_SESSION['nhamang'])?>"
                style="height:50px;border-radius:15px;" disabled>
            </div>
            <div class="form-group">
              <label for="soluong">Số lượng</label>
              <input class="form-control" value=" <?=$_SESSION['soluong']?>" style="height:50px;border-radius:15px;"
                disabled>
            </div>
            <div class="form-group">
              <label for="mathe">Mã thẻ</label>
              <?php
                      $listidcard=$_SESSION['listidcard'];
                      for($i=0;$i<count($listidcard);$i++)
                      {
                        $idcard=$listidcard[$i];
                        echo
                          "
                          <input class=\"form-control\" value=\"$idcard\"
                          style=\"height:50px;border-radius:15px;margin-bottom:10px\" disabled>
                          ";
                      }
                  ?>
            </div>
          </div>
          <div style="background-color: #fffefb;padding-bottom:15px">
            <div style=" border-top: 1px dashed rgba(0, 0, 0, 0.09); margin-bottom: 20px;">
            </div>
            <div style="text-align:center;width: fit-content;margin: 0 auto;">
              <input id="total" placeholder="Thanh toán"
                style="text-align: center;background-color: #ee4d2d;color: white;border-radius: 3px;margin-bottom: 20px;padding: 10px;font-size: 15px;display:none" />
            </div>

            <div style="display: flex;justify-content: center;">
              <a class="btn btn-primary px-5" type="reset" style="font-size: 15px;"
                 href="home.php" <?php $_SESSION['bought']=false?>>Quay lại trang chủ</a>
            </div>
          </div>
        </form>
      </section>


    </div>


    <?php
      include('footer.php');
    ?>
  </div>
</body>

</html>