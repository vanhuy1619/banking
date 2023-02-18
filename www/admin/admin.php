<?php
    session_start();
    require('../config.php');
    if(!isset($_SESSION['admin']))
    {
        header('Location: ../home.php');
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
                        <li class="active"><a data-toggle="pill" href="#chokichhoat">Chờ kích hoạt</a></li>
                        <li><a data-toggle="pill" href="#dakichhoat">Đã kích hoạt</a></li>
                        <li><a data-toggle="pill" href="#vohieuhoa">Đã bị vô hiệu hóa</a></li>
                        <li><a data-toggle="pill" href="#khoa">Đã bị khóa vô thời hạn</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade in active " id="chokichhoat">
                            <table class="table table-striped text-center">
                                <thead class="table-primary">
                                    <tr>
                                        <th class="text-center">Tên</th>
                                        <th class="text-center">Số điện thoại</th>
                                        <th class="text-center">Trạng thái tài khoản</th>
                                        <th class="text-center">Thời gian tạo</th>
                                        <th class="text-center">Chi tiết tài khoản</th>
                                        <th class="text-center" colspan="3"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $results = $con->query("SELECT * FROM users where (status='Chờ cập nhật' or status='Chờ xác minh') order by datecreate DESC");
                                        while ($data = $results->fetch_assoc()):?>

                                    <tr>
                                        <td>
                                            <?php echo $data['name'] ?>
                                        </td>
                                        <td>
                                            <?php echo $data['phone'] ?>
                                        </td>
                                        <td>
                                            <?php echo $data['status'] ?>
                                        </td>
                                        <td>
                                            <?php echo $data['datecreate'] ?>
                                        </td>
                                        <td class="light">
                                            <button id="<?php echo $data['phone']; ?>" class="btn btn-primary chitiet"></i> Xem</button>
                                        </td>
                                        <td class="light">
                                            <button id="<?php echo $data['phone']; ?>" class="btn btn-success dongykichhoat"></i> Đồng ý</button>
                                        </td>
                                        <td class="light">
                                            <button id="<?php echo $data['phone'];
                                                        ?>" class="btn btn-danger yeucauthemthongtin"></i>Yêu cầu thêm thông tin</button>
                                            </form>
                                        </td>
                                        <td class="light">
                                            <button id="<?php echo $data['phone'];
                                                        ?>" class="btn btn-danger tuchoikichhoat"></i>Từ chối</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endwhile ?>
                                </tbody>
                            </table>
                        </div>
                        <div id="dakichhoat" class="tab-pane fade">
                            <table class="table table-striped text-center">
                                <thead class="table-primary">
                                    <tr>
                                        <th class="text-center">Tên</th>
                                        <th class="text-center">Số điện thoại</th>
                                        <th class="text-center">Trạng thái tài khoản</th>
                                        <th class="text-center">Thời gian tạo</th>
                                        <th class="text-center">Chi tiết tài khoản </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $results = $con->query("SELECT * FROM users where (status='Đã duyệt') order by datecreate DESC");
                                        while ($data = $results->fetch_assoc()):?>

                                    <tr>
                                        <td>
                                            <?php echo $data['name'] ?>
                                        </td>
                                        <td>
                                            <?php echo $data['phone'] ?>
                                        </td>
                                        <td>
                                            <?php echo $data['status'] ?>
                                        </td>
                                        <td>
                                            <?php echo $data['datecreate'] ?>
                                        </td>
                                        <td class="light">
                                            <button id="<?php echo $data['phone']; ?>" class="btn btn-primary chitiet"></i> Xem</button>
                                        </td>
                                    </tr>
                                    <?php endwhile ?>
                                </tbody>
                            </table>
                        </div>
                        <div id="vohieuhoa" class="tab-pane fade">
                            <table class="table table-striped text-center">
                                <thead class="table-primary">
                                    <tr>
                                        <th class="text-center">Tên</th>
                                        <th class="text-center">Số điện thoại</th>
                                        <th class="text-center">Trạng thái tài khoản</th>
                                        <th class="text-center">Thời gian tạo</th>
                                        <th class="text-center">Chi tiết tài khoản</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $results = $con->query("SELECT * FROM users where (status='Đã vô hiệu hóa') order by datecreate DESC");
                                        while ($data = $results->fetch_assoc()):?>

                                    <tr>
                                        <td>
                                            <?php echo $data['name'] ?>
                                        </td>
                                        <td>
                                            <?php echo $data['phone'] ?>
                                        </td>
                                        <td>
                                            <?php echo $data['status'] ?>
                                        </td>
                                        <td>
                                            <?php echo $data['datecreate'] ?>
                                        </td>
                                        <td class="light">
                                            <button id="<?php echo $data['phone']; ?>" class="btn btn-primary chitiet"></i> Xem</button>
                                        </td>
                                    </tr>
                                    <?php endwhile ?>
                                </tbody>
                            </table>
                        </div>
                        <div id="khoa" class="tab-pane fade">
                            <table class="table table-striped text-center">
                                <thead class="table-primary">
                                    <tr>
                                        <th class="text-center">Tên</th>
                                        <th class="text-center">Số điện thoại</th>
                                        <th class="text-center">Trạng thái tài khoản</th>
                                        <th class="text-center">Trạng thái đăng nhập</th>
                                        <th class="text-center">Thời gian tạo</th>
                                        <th class="text-center">Chi tiết tài khoản</th>
                                        <th class="text-center" colspan="1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $results = $con->query("SELECT * FROM users where (block='Tài khoản bị khóa') order by datecreate DESC");
                                        while ($data = $results->fetch_assoc()):?>

                                    <tr>
                                        <td>
                                            <?php echo $data['name'] ?>
                                        </td>
                                        <td>
                                            <?php echo $data['phone'] ?>
                                        </td>
                                        <td>
                                            <?php echo $data['status'] ?>
                                        </td>
                                        <td>
                                            <?php echo $data['statuslogin'] ?>
                                        </td>
                                        <td>
                                            <?php echo $data['datecreate'] ?>
                                        </td>
                                        <td class="light">
                                            <button id="<?php echo $data['phone']; ?>" class="btn btn-primary chitiet"></i> Xem</button>
                                        </td>
                                        <td class="light">
                                            <button id="<?php echo $data['phone']; ?>" class="btn btn-success mokhoa"></i> Mở khóa</button>
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
            $(document).on('click', '.dongykichhoat', function () {
                let phone = $(this).attr("id");
                
                swal({
                    title: "Xác nhận",
                    text: "Xác nhận 1 lần nữa, bạn có chắc là đồng ý kích hoạt tài khoản này hay không?",
                    icon: "info",
                    buttons: true,
                    dangerMode: false,
                }).then((value) => {
                    if (value) {
                        $.ajax({
                            type: "POST",
                            url: "handle.php",
                            data: {dongykichhoat: phone },
                            success: function (response) {
                                
                                if (response == "Success") {
                                    swal("Kích hoạt thành công", {
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
                                        title: "Kích hoạt không thành công!",
                                        icon: "error",
                                        buttons: true,
                                        // value:true
                                    })/* .then((value) => {
                                    location.reload();
                                    }); */console.log(phone);

                                }
                            }
                        });
                    }
                    
                });
            });

            $(document).on('click', '.yeucauthemthongtin', function () {
                let phone = $(this).attr("id");
                
                swal({
                    title: "Xác nhận",
                    text: "Xác nhận 1 lần nữa, bạn có chắc là yêu cầu tài khoản này bổ sung thêm thông tin không?",
                    icon: "info",
                    buttons: true,
                    dangerMode: false,
                }).then((value) => {
                    if (value) {
                        $.ajax({
                            type: "POST",
                            url: "handle.php",
                            data: {yeucauthemthongtin: phone },
                            success: function (response) {
                                
                                if (response == "Success") {
                                    swal("Yêu cầu thêm thông tin thành công", {
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
                                        title: "Yêu cầu thêm thông tin không thành công!",
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

            $(document).on('click', '.tuchoikichhoat', function () {
                let phone = $(this).attr("id");
                
                swal({
                    title: "Xác nhận",
                    text: "Xác nhận 1 lần nữa, bạn có chắc là từ chối kích hoạt tài khoản này hay không?",
                    icon: "info",
                    buttons: true,
                    dangerMode: false,
                }).then((value) => {
                    if (value) {
                        $.ajax({
                            type: "POST",
                            url: "handle.php",
                            data: {tuchoikichhoat: phone },
                            success: function (response) {
                                
                                if (response == "Success") {
                                    swal("Từ chối kích hoạt tài khoản thành công", {
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
                                        title: "Từ chối kích hoạt tài khoản không thành công!",
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

            $(document).on('click', '.mokhoa', function () {
                let phone = $(this).attr("id");
                
                swal({
                    title: "Xác nhận",
                    text: "Xác nhận 1 lần nữa, bạn có chắc mở khóa tài khoản này hay không?",
                    icon: "info",
                    buttons: true,
                    dangerMode: false,
                }).then((value) => {
                    if (value) {
                        $.ajax({
                            type: "POST",
                            url: "handle.php",
                            data: {mokhoa: phone },
                            success: function (response) {
                                
                                if (response == "Success") {
                                    swal("Mở khóa tài khoản thành công", {
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
                                        title: "Mở khóa tài khoản không thành công!",
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

            $(document).on('click', '.chitiet', function (){
                
            });
        });
    </script>
</body>
</html>