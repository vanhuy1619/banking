<?php
    require('config.php');
    session_start();
    if(!isset($_SESSION['username'])){
        header('Location:login.php');
    }
    if($_SESSION['status']!='Đã duyệt')
    {
        echo "<script>alert('Tài khoản đang chờ xác minh nên bạn không thể sử dụng dịch vụ'); window.location = 'home.php';</script>";
    }
    $username=$_SESSION['username'];
    function currency_format($number, $suffix = 'đ')
     {
        if (!empty($number)) {
            return number_format($number, 0, ',', ',') . "{$suffix}";
        }
    }

    // $phone=$_SESSION['phone'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử giao dịch</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"
        integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="assets/fonts/fontawesome/fontawesome-free-6.0.0-web/css/all.min.css" rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">    
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<body>
    <div class="app">
        <?php
      include_once('header.php');
    ?>
        <div class="main" style="min-height: 1200px">
            <div class="grid">
                <div class="container" style="font-size:15px;margin-top:40px">
                    <ul class="nav nav-pills d-flex justify-content-center mb-5">
                        <li class="active"><a data-toggle="pill" href="#chuyentien">Chuyển tiền</a></li>
                        <li><a data-toggle="pill" href="#menu1">Nhận tiền</a></li>
                        <li><a data-toggle="pill" href="#menu2">Nạp tiền</a></li>
                        <li><a data-toggle="pill" href="#menu3">Rút tiền</a></li>
                        <li><a data-toggle="pill" href="#menu4">Mua thẻ</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade in active " id="chuyentien">
                            <table class="table table-striped text-center">
                                <thead class="bg-success">
                                    <tr>
                                        <th class="text-center">Số điện người nhận</th>
                                        <th class="text-center">Tên người nhận</th>
                                        <th class="text-center">Số tiền chuyển</th>
                                        <th class="text-center">Người chịu phí</th>
                                        <th class="text-center">Ghi chú</th>
                                        <th class="text-center">Trạng thái chuyển</th>
                                        <th class="text-center">Thời gian chuyển</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $results = $con->query("SELECT * FROM chuyentien where username='$username' order by datechuyen DESC");
                                    while ($data = $results->fetch_assoc()):?>

                                    <tr>
                                        <td>
                                            <?php echo $data['phonereceive'] ?>
                                        </td>
                                        <td>
                                            <?php echo $data['namereceive'] ?>
                                        </td>
                                        <td id="money-lsgd">
                                            <?php
                                                $money=$data['money'] ;
                                                $moneyformat='';
                                                echo currency_format($money);
                                             ?>
                                        </td>
                                        <td>
                                            <?php echo $data['fee'] ?>
                                        </td>
                                        <td>
                                            <?php echo $data['note'] ?>
                                        </td>
                                        <td>
                                            <?php echo $data['trangthaichuyen'] ?>
                                        </td>
                                        <td>
                                            <?php echo $data['datechuyen'] ?>
                                        </td>
                                    </tr>
                                    <?php endwhile ?>
                                </tbody>

                            </table>
                        </div>
                        <div id="menu2" class="tab-pane fade container">
                            <table class="table table-striped text-center w-50" style="margin:0 auto">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-center">Mã thẻ</th>
                                        <th class="text-center">Số tiền nạp</th>
                                        <th class="text-center">Ngày nạp</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $results = $con->query("SELECT * FROM naptien where username='$username' order by datenap DESC");
                                    while ($data = $results->fetch_assoc()):?>

                                    <tr>
                                        <td>
                                            <?php echo $data['idcard'] ?>
                                        </td>
                                        <td>
                                            <?php echo currency_format($data['money']) ?>
                                        </td>
                                        <td>
                                            <?php echo $data['datenap'] ?>
                                        </td>
                                    </tr>
                                    <?php endwhile ?>
                                </tbody>
                            </table>
                        </div>
                        <div id="menu1" class="tab-pane fade">
                            <table class="table table-striped text-center">
                                <thead class="table-primary">
                                    <tr>
                                        <th class="text-center">Người gửi</th>
                                        <th class="text-center">Số điện thoại gửi</th>
                                        <th class="text-center">Số tiền nhận</th>
                                        <th class="text-center">Ghi chú</th>
                                        <th class="text-center">Thời gian nhận</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $results = $con->query("SELECT * FROM nhantien where usernamereceive='$username' order by datenhan DESC");
                                        while ($data = $results->fetch_assoc()):?>

                                    <tr>
                                        <td>
                                            <?php echo $data['namesend'] ?>
                                        </td>
                                        <td>
                                            <?php echo $data['phonesend'] ?>
                                        </td>
                                        <td>
                                            <?php echo currency_format($data['money'])?>
                                        </td>
                                        <td>
                                            <?php echo $data['note'] ?>
                                        </td>
                                        <td>
                                            <?php echo $data['datenhan'] ?>
                                        </td>
                                    </tr>
                                    <?php endwhile ?>
                                </tbody>
                            </table>
                        </div>
                        <div id="menu3" class="tab-pane fade">
                            <table class="table table-striped text-center">
                                <thead style="background-color:#F084A1">
                                    <tr>
                                        <th class="text-center">Mã thẻ rút</th>
                                        <th class="text-center">Số tiền rút</th>
                                        <th class="text-center">Ghi chú</th>
                                        <th class="text-center">Trạng thái rút</th>
                                        <th class="text-center">Thời gian rút</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $results = $con->query("SELECT * FROM ruttien where username='$username' order by daterut DESC");
                                        while ($data = $results->fetch_assoc()):?>

                                    <tr>
                                        <td>
                                            <?php echo $data['idcard'] ?>
                                        </td>
                                        <td>
                                            <?php echo currency_format($data['money'])?>
                                        </td>
                                        <td>
                                            <?php echo $data['note'] ?>
                                        </td>
                                        <td>
                                            <?php echo $data['trangthairut'] ?>
                                        </td>
                                        <td>
                                            <?php echo $data['daterut'] ?>
                                        </td>
                                    </tr>
                                    <?php endwhile ?>
                                </tbody>
                            </table>
                        </div>
                        <div id="menu4" class="tab-pane fade">
                            <table class="table table-striped text-center">
                                <thead style="background-color:#FEEE08">
                                    <tr>
                                        <th class="text-center">Nhà mạng</th>
                                        <th class="text-center">Mệnh giá</th>
                                        <th class="text-center">Số lượng</th>
                                        <th class="text-center">Mã thẻ</th>
                                        <th class="text-center">Ngày mua</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $results = $con->query("SELECT * FROM buycard where username='$username' order by datebuycard DESC");
                                        while ($data = $results->fetch_assoc()):?>

                                    <tr>
                                        <td>
                                            <?php echo strtoupper($data['nhamang']) ?>
                                        </td>
                                        <td>
                                            <?php echo currency_format($data['moneycard'])?>
                                        </td>
                                        <td>
                                            <?php echo $data['soluong'] ?>
                                        </td>
                                        <td>
                                            <?php
                                            $id=str_replace('-',' ',$data['idcard']);
                                            echo(str_replace(' ','<br>',trim($id))) ?>
                                        </td>
                                        <td>
                                            <?php echo $data['datebuycard'] ?>
                                        </td>
                                    </tr>
                                    <?php endwhile ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
      include('footer.php');
    ?>
    </div>



    <script src="./main.js"></script>
    <script>

    </script>
</body>

</html>