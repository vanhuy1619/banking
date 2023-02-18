<?php
    require('config.php');
    session_start();
    
    if(!isset($_SESSION['username']))
    {
        header('Location:login.php');
    }
    if($_SESSION['status']!='Đã duyệt')
    {
        echo "<script>alert('Tài khoản đang chờ xác minh nên bạn không thể sử dụng dịch vụ'); window.location = 'home.php';</script>";
    }
    if($_SESSION['loginfirst']=='true')
    {
        header('Location:changepassfirst.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nạp tiền</title>
    <link rel="stylesheet" href="assets/css/base.css">
    <link rel="stylesheet" href="style.css">
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
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="assets/css/responsive.css">
</head>

<body>
    <?php    
    $thongbao='';
    unset($thongbaomoney);

    //LẤY DỮ LIỆU
    if (isset($_SESSION['username']) && $_SESSION['username'])
    {
        $username=$_SESSION['username'];
        $sql="select * from users where username='$username'";
            $query=mysqli_query($con,$sql);
            if(!$query)
            {
                echo 'Lỗi';
            }
            if(mysqli_num_rows($query)>0)
            {
                while($row=mysqli_fetch_assoc($query))
                {
                    $name= $row['name'];
                    $phone=$row['phone'];
                }
            }
    }

    //NẠP TIỀN
    if (isset($_POST['okmoney'])) 
        {
            $idcard=$_POST['idcard'];
            $datecard=$_POST['datecard'];
            $cvv=$_POST['cvv'];
           

            $sql = "SELECT idcard FROM card WHERE idcard = '$idcard'";
            $result = mysqli_query($con,$sql);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $count = mysqli_num_rows($result);
            if($count !=1 && strlen($idcard)==6) 
            {
                $thongbao="Thẻ này không được hỗ trợ";
            }
            else if(strlen($idcard)<6 || is_numeric($idcard)!=1) 
            {
                $thongbao="Định dạng thẻ có 6 chữ số. Vui lòng nhập lại";
            }
            else
            {
                $sql = "SELECT * FROM card WHERE datecard='$datecard' and idcard='$idcard'";
                $result = mysqli_query($con,$sql);
                $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                $count = mysqli_num_rows($result);
                if($count!=1)
                    $thongbao="Vui lòng kiểm tra lại ngày hết hạn của thẻ";
                else
                {
                    $sql = "SELECT cvv FROM card WHERE cvv='$cvv' and idcard='$idcard'";
                    $result = mysqli_query($con,$sql);
                    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                    $count = mysqli_num_rows($result);
                    if($count!=1)
                        $thongbao="Vui lòng kiểm tra lại mã CVV";
                    else
                    {
                        $moneyinput=$_POST['money'];
                        $money=substr($moneyinput,1);
                        $money=str_replace(',','',$money);
                        //THỎA HẾT MỌI ĐIỀU KIỆN
                        //thẻ 333333
                        if($idcard=='333333')
                        {
                            $thongbao="Thẻ hết tiền";
                            // die();
                        }
                        //22222
                        if($idcard=='222222')
                        {
                            if($money>1000000)
                            {
                                $thongbao="Số tiền được nạp không vượt quá 1,000,000 đồng";
                            }   
                            else
                            {
                                $sql="update users set money=money+'$money' where username='$username'";
                                if ($con->query($sql) === TRUE) 
                                {
                                    $thongbao="Nạp thành công ". substr($moneyinput,1). " đồng vào tài khoản";
                                }
                                else 
                                {
                                }
                                //bảng naptien
                                $sql="insert into naptien(username,phone,idcard,money) values ('$username','$phone','$idcard','$money')";
                                if ($con->query($sql) === TRUE) 
                                {
                                }
                                else 
                                {
                                }
                            }
                        }

                        //111111
                        if($idcard=='111111')
                        {
                                $sql="update users set money=money+'$money' where username='$username'";
                                if ($con->query($sql) === TRUE) 
                                {
                                    $thongbao="Nạp thành công ". substr($moneyinput,1). " đồng vào tài khoản";
                                }
                                else 
                                {
                                }
                                //bảng naptien
                                $sql="insert into naptien(username,phone,idcard,money) values ('$username','$phone','$idcard','$money')";
                                if ($con->query($sql) === TRUE) 
                                {
                                   
                                }
                                else 
                                {
                                }
                        }
                        if($idcard=='333333')
                        {
                            $thongbao='Thẻ đã hết tiền. Vui lòng chọn thẻ khác';
                        }
                        }
                }
            } 
        }
    
    
        
    ?>
    <div class="app">
        <?php
            include('header.php');
        ?>
        <div class="main">
            <div class="grid gridcard">
                <!-- <form action="" method="post" id="formnaptien">
                    <input type="text" value="<?=$name?>" disabled>
                    <input type="text" name="idcard" placeholder="Số thẻ" id="idcard" onchange="checkid()">
                    <input type="date" name="datecard" id="datecard" placeholder="Ngày hết hạn">
                    <input type="text" name="cvv" id="cvv" placeholder="Mã CVV">
                   
                   
                    <input type="text" name="money" id="currency-field" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" disabled data-type="currency" placeholder="1,000,000">
                    <button type="submit" class="btn-update" name="okmoney" id="okmoney" onkeyup="typeMoney()">Xác nhập</button>
                    <div class="thongbaocard" style="color: #ee4d2d">
                        <?php
                             echo $thongbao;
                        ?>
                    </div>
                </form> -->
                <?php
                    include('index.php');
                ?>
            </div>
            
        </div>
        <?php
            include_once('footer.php');
        ?>

    </div>

    <!-- <script src="main.js"></script> -->
    <script>
        function checkid() {
            let idcard = document.getElementById('idcard');
            let money = document.getElementById('currency-field');
            if (idcard.value == '111111' || idcard.value == '222222' || idcard.value == '333333')
                money.disabled = false;
            else
                money.disabled = true;
        }

        // Jquery Dependency

        $("input[data-type='currency']").on({
            keyup: function () {
                formatCurrency($(this));
            },
            blur: function () {
                formatCurrency($(this), "blur");
            }
        });


        function formatNumber(n) {
            // format number 1000000 to 1,234,567
            return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        }


        function formatCurrency(input, blur) {
            // appends $ to value, validates decimal side
            // and puts cursor back in right position.

            // get input value
            var input_val = input.val();

            // don't validate empty input
            if (input_val === "") { return; }

            // original length
            var original_len = input_val.length;

            // initial caret position 
            var caret_pos = input.prop("selectionStart");

            // check for decimal
            if (input_val.indexOf(".") >= 0)
            {

                // get position of first decimal
                // this prevents multiple decimals from
                // being entered
                var decimal_pos = input_val.indexOf(".");

                // split number by decimal point
                var left_side = input_val.substring(0, decimal_pos);
                var right_side = input_val.substring(decimal_pos);

                // add commas to left side of number
                left_side = formatNumber(left_side);

                // validate right side
                right_side = formatNumber(right_side);

                // On blur make sure 2 numbers after decimal
                if (blur === "blur") {
                    right_side += "00";
                }

                // Limit decimal to only 2 digits
                right_side = right_side.substring(0, 2);

                // join number by .
                input_val = left_side + "." + right_side;

            } else {
                // no decimal entered
                // add commas to number
                // remove all non-digits
                input_val = formatNumber(input_val);
                input_val = "$" + input_val;


            }

            // send updated string to input
            input.val(input_val);

            // put caret back in the right position
            var updated_len = input_val.length;
            caret_pos = updated_len - original_len + caret_pos;
            input[0].setSelectionRange(caret_pos, caret_pos);
        }


        //CARD
                
        document.querySelector('.card-number-input').oninput = () =>{
            document.querySelector('.card-number-box').innerText = document.querySelector('.card-number-input').value;
        }
        document.querySelector('.card-money-input').oninput = () =>{
    document.querySelector('.card-money-name').innerText = document.querySelector('.card-money-input').value;
}


        document.querySelector('.card-holder-input').oninput = () =>{
            document.querySelector('.card-holder-name').innerText = document.querySelector('.card-holder-input').value;
        }

        document.querySelector('.month-input').oninput = () =>{
            document.querySelector('.exp-month').innerText = document.querySelector('.month-input').value;
        }

        document.querySelector('.year-input').oninput = () =>{
            document.querySelector('.exp-year').innerText = document.querySelector('.year-input').value;
        }

        document.querySelector('.cvv-input').onmouseenter = () =>{
            document.querySelector('.front').style.transform = 'perspective(1000px) rotateY(-180deg)';
            document.querySelector('.back').style.transform = 'perspective(1000px) rotateY(0deg)';
        }

        document.querySelector('.cvv-input').onmouseleave = () =>{
            document.querySelector('.front').style.transform = 'perspective(1000px) rotateY(0deg)';
            document.querySelector('.back').style.transform = 'perspective(1000px) rotateY(180deg)';
        }

        document.querySelector('.cvv-input').oninput = () =>{
            document.querySelector('.cvv-box').innerText = document.querySelector('.cvv-input').value;
        }
    </script>

</html>