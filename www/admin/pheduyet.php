<?php
    session_start();
    require('../config.php');
    if(!isset($_SESSION['admin']))
    {
        header('Location: ../home.php');
    }
    function currency_format($number, $suffix = 'đ')
     {
        if (!empty($number)) {
            return number_format($number, 0, ',', ',') . "{$suffix}";
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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link
    href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
    rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
    integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <?php
        require('../admin/header.php');
    ?>
    
    <div class="main" style="min-height: 1000px">
            <div class="grid">
                <div class="container" style="font-size:15px;margin-top:40px">
                    <ul class="nav nav-pills d-flex justify-content-center mb-5">
                        <li class="active"><a data-toggle="pill" href="#ruttien">Rút tiền</a></li>
                        <li><a data-toggle="pill" href="#chuyentien">Chuyển tiền</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade in active " id="ruttien">
                            <table class="table table-striped text-center">
                                <thead class="table-primary">
                                    <tr>
                                        <th class="text-center">Mã thẻ rút</th>
                                        <th class="text-center">Username</th>
                                        <th class="text-center">Số điện thoại</th>
                                        <th class="text-center">Số tiền rút</th>
                                        <th class="text-center">Ghi chú</th>
                                        <th class="text-center">Trạng thái rút</th>
                                        <th class="text-center">Thời gian rút</th>
                                        <th class="text-center" colspan="2"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $results = $con->query("SELECT * FROM ruttien where  money >= 5000000 and trangthairut = 'Đang chờ' order by daterut DESC");
                                        while ($data = $results->fetch_assoc()):?>

                                    <tr>
                                        <td>
                                            <?php echo $data['idcard'] ?>
                                        </td>
                                        <td>
                                            <?php echo $data['username'] ?>
                                        </td>
                                        <td>
                                            <?php echo $data['phone'] ?>
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
                                        <td class="light">
                                            <button id="<?php echo $data['id']; ?>" class="btn btn-success dongyrut"></i> Đồng ý</button>
                                        </td>
                                        <td class="light">
                                            <button id="<?php echo $data['id'];
                                                        ?>" class="btn btn-danger tuchoirut"></i>Từ chối</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endwhile ?>
                                </tbody>
                            </table>
                        </div>
                        <div id="chuyentien" class="tab-pane fade">
                            <table class="table table-striped text-center">
                                <thead class="table-primary">
                                    <tr>
                                        
                                        <th class="text-center">Số điện thoại gửi</th>
                                        <th class="text-center">Số điện thoại nhận</th>
                                        <th class="text-center">Số tiền</th>
                                        <th class="text-center">Bên trả phí</th>
                                        <th class="text-center">Trạng thái</th>
                                        <th class="text-center">Thời gian chuyển</th>
                                        <th class="text-center" colspan="2"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $results = $con->query("SELECT * FROM chuyentien where trangthaichuyen='Chờ duyệt' order by datechuyen DESC");
                                        while ($data = $results->fetch_assoc()):?>

                                    <tr>

                                        <td>
                                            <?php echo $data['phonesend'] ?>
                                        </td>
                                        <td>
                                            <?php echo $data['phonereceive'] ?>
                                        </td>
                                        <td>
                                            <?php echo currency_format($data['money'])?>
                                        </td>
                                        <td>
                                            <?php echo$data['fee']?>
                                        </td>
                                        <td>
                                            <?php echo$data['trangthaichuyen']?>
                                        </td>
                                        <td>
                                            <?php echo $data['datechuyen'] ?>
                                        </td>
                                        <td class="light">
                                            <button id="<?php echo $data['id']; ?>" class="btn btn-success dongychuyen"></i> Đồng ý</button>
                                        </td>
                                        <td class="light">
                                            <button id="<?php echo $data['id']; ?>" class="btn btn-danger tuchoichuyen"></i>Từ chối</button>
                                            </form>
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

    
    <?php
        require('../footer.php');
    ?>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="../main.js"></script>
    <script>
        $(document).ready(function(){
            $(document).on('click', '.dongyrut', function () {
                let id = $(this).attr("id");
                
                swal({
                    title: "Xác nhận",
                    text: "Xác nhận 1 lần nữa, bạn có chắc là đồng ý yêu cầu rút tiền này hay không?",
                    icon: "info",
                    buttons: true,
                    dangerMode: false,
                }).then((value) => {
                    if (value) {
                        $.ajax({
                            type: "POST",
                            url: "handle.php",
                            data: {dongyrut: id },
                            success: function (response) {
                                
                                if (response == "Success") {
                                    swal("Duyệt rút thành công", {
                                        icon: "success",
                                        buttons: [false]
                                    });
                                    setTimeout(function () {

                                        location.reload();

                                    }, 1000);
                                    console.log(response);
                                }
                                else {
                                    swal({
                                        title: "Duyệt rút không thành công!",
                                        icon: "error",
                                        buttons: true,
                                        // value:true
                                    }).then((value) => {
                                    location.reload();
                                    });

                                }
                            }
                        });
                    }
                    
                });
            });

            $(document).on('click', '.tuchoirut', function () {
                let id = $(this).attr("id");
                
                swal({
                    title: "Xác nhận",
                    text: "Xác nhận 1 lần nữa, bạn có chắc là từ chối yêu cầu rút tiền này hay không?",
                    icon: "info",
                    buttons: true,
                    dangerMode: false,
                }).then((value) => {
                    if (value) {
                        $.ajax({
                            type: "POST",
                            url: "handle.php",
                            data: {tuchoirut: id },
                            success: function (response) {
                                
                                if (response == "Success") {
                                    swal("Từ chối rút thành công", {
                                        icon: "success",
                                        buttons: [false]
                                    });
                                    setTimeout(function () {

                                        location.reload();

                                    }, 1000);
                                    console.log(response);
                                }
                                else {
                                    swal({
                                        title: "Từ chối rút không thành công!",
                                        icon: "error",
                                        buttons: true,
                                        // value:true
                                    }).then((value) => {
                                    location.reload();
                                    });
                                }
                            }
                        });
                    }
                    
                });
            });

            $(document).on('click', '.dongychuyen', function () {
                let id = $(this).attr("id");
                
                swal({
                    title: "Xác nhận",
                    text: "Xác nhận 1 lần nữa, bạn có chắc là duyệt yêu cầu chuyển tiền này hay không?",
                    icon: "info",
                    buttons: true,
                    dangerMode: false,
                }).then((value) => {
                    if (value) {
                        $.ajax({
                            type: "POST",
                            url: "handle.php",
                            data: {dongychuyen: id },
                            success: function (response) {
                                
                                if (response == "Success") {
                                    swal("Duyệt yêu cầu chuyển thành công", {
                                        icon: "success",
                                        buttons: [false]
                                    });
                                    setTimeout(function () {

                                        location.reload();

                                    }, 1000);
                                    console.log(response);
                                }
                                else {
                                    swal({
                                        title: "Duyệt yêu cầu chuyển không thành công!",
                                        icon: "error",
                                        buttons: true,
                                        // value:true
                                    }).then((value) => {
                                    location.reload();
                                    });
                                }
                            }
                        });
                    }
                    
                });
            });
            
            $(document).on('click', '.tuchoichuyen', function () {
                let id = $(this).attr("id");
                
                swal({
                    title: "Xác nhận",
                    text: "Xác nhận 1 lần nữa, bạn có chắc là từ chối yêu cầu chuyển tiền này hay không?",
                    icon: "info",
                    buttons: true,
                    dangerMode: false,
                }).then((value) => {
                    if (value) {
                        $.ajax({
                            type: "POST",
                            url: "handle.php",
                            data: {tuchoichuyen: id },
                            success: function (response) {
                                
                                if (response == "Success") {
                                    swal("Từ chối chuyển thành công", {
                                        icon: "success",
                                        buttons: [false]
                                    });
                                    setTimeout(function () {

                                        location.reload();

                                    }, 1000);
                                    console.log(response);
                                }
                                else {
                                    swal({
                                        title: "Từ chối rút không thành công!",
                                        icon: "error",
                                        buttons: true,
                                        // value:true
                                    })/* .then((value) => {
                                    location.reload();
                                    }); */console.log(response);
                                }
                            }
                        });
                    }
                    
                });
            });
        });
    </script>                                        
    
</body>
</html>