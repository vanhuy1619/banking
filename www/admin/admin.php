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
                        <li class="active"><a data-toggle="pill" href="#chokichhoat">Ch??? k??ch ho???t</a></li>
                        <li><a data-toggle="pill" href="#dakichhoat">???? k??ch ho???t</a></li>
                        <li><a data-toggle="pill" href="#vohieuhoa">???? b??? v?? hi???u h??a</a></li>
                        <li><a data-toggle="pill" href="#khoa">???? b??? kh??a v?? th???i h???n</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade in active " id="chokichhoat">
                            <table class="table table-striped text-center">
                                <thead class="table-primary">
                                    <tr>
                                        <th class="text-center">T??n</th>
                                        <th class="text-center">S??? ??i???n tho???i</th>
                                        <th class="text-center">Tr???ng th??i t??i kho???n</th>
                                        <th class="text-center">Th???i gian t???o</th>
                                        <th class="text-center">Chi ti???t t??i kho???n</th>
                                        <th class="text-center" colspan="3"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $results = $con->query("SELECT * FROM users where (status='Ch??? c???p nh???t' or status='Ch??? x??c minh') order by datecreate DESC");
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
                                            <button id="<?php echo $data['phone']; ?>" class="btn btn-success dongykichhoat"></i> ?????ng ??</button>
                                        </td>
                                        <td class="light">
                                            <button id="<?php echo $data['phone'];
                                                        ?>" class="btn btn-danger yeucauthemthongtin"></i>Y??u c???u th??m th??ng tin</button>
                                            </form>
                                        </td>
                                        <td class="light">
                                            <button id="<?php echo $data['phone'];
                                                        ?>" class="btn btn-danger tuchoikichhoat"></i>T??? ch???i</button>
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
                                        <th class="text-center">T??n</th>
                                        <th class="text-center">S??? ??i???n tho???i</th>
                                        <th class="text-center">Tr???ng th??i t??i kho???n</th>
                                        <th class="text-center">Th???i gian t???o</th>
                                        <th class="text-center">Chi ti???t t??i kho???n </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $results = $con->query("SELECT * FROM users where (status='???? duy???t') order by datecreate DESC");
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
                                        <th class="text-center">T??n</th>
                                        <th class="text-center">S??? ??i???n tho???i</th>
                                        <th class="text-center">Tr???ng th??i t??i kho???n</th>
                                        <th class="text-center">Th???i gian t???o</th>
                                        <th class="text-center">Chi ti???t t??i kho???n</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $results = $con->query("SELECT * FROM users where (status='???? v?? hi???u h??a') order by datecreate DESC");
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
                                        <th class="text-center">T??n</th>
                                        <th class="text-center">S??? ??i???n tho???i</th>
                                        <th class="text-center">Tr???ng th??i t??i kho???n</th>
                                        <th class="text-center">Tr???ng th??i ????ng nh???p</th>
                                        <th class="text-center">Th???i gian t???o</th>
                                        <th class="text-center">Chi ti???t t??i kho???n</th>
                                        <th class="text-center" colspan="1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $results = $con->query("SELECT * FROM users where (block='T??i kho???n b??? kh??a') order by datecreate DESC");
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
                                            <button id="<?php echo $data['phone']; ?>" class="btn btn-success mokhoa"></i> M??? kh??a</button>
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
                    title: "X??c nh???n",
                    text: "X??c nh???n 1 l???n n???a, b???n c?? ch???c l?? ?????ng ?? k??ch ho???t t??i kho???n n??y hay kh??ng?",
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
                                    swal("K??ch ho???t th??nh c??ng", {
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
                                        title: "K??ch ho???t kh??ng th??nh c??ng!",
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
                    title: "X??c nh???n",
                    text: "X??c nh???n 1 l???n n???a, b???n c?? ch???c l?? y??u c???u t??i kho???n n??y b??? sung th??m th??ng tin kh??ng?",
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
                                    swal("Y??u c???u th??m th??ng tin th??nh c??ng", {
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
                                        title: "Y??u c???u th??m th??ng tin kh??ng th??nh c??ng!",
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
                    title: "X??c nh???n",
                    text: "X??c nh???n 1 l???n n???a, b???n c?? ch???c l?? t??? ch???i k??ch ho???t t??i kho???n n??y hay kh??ng?",
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
                                    swal("T??? ch???i k??ch ho???t t??i kho???n th??nh c??ng", {
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
                                        title: "T??? ch???i k??ch ho???t t??i kho???n kh??ng th??nh c??ng!",
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
                    title: "X??c nh???n",
                    text: "X??c nh???n 1 l???n n???a, b???n c?? ch???c m??? kh??a t??i kho???n n??y hay kh??ng?",
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
                                    swal("M??? kh??a t??i kho???n th??nh c??ng", {
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
                                        title: "M??? kh??a t??i kho???n kh??ng th??nh c??ng!",
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