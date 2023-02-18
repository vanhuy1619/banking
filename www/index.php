<?PHP
    // session_start();
    require('config.php');
    // session_start();
    if(!isset($_SESSION['username']))
    {
        header('Location:login.php');
    }
    if(empty($_SESSION['username']))
    {
        header('Location:login.php');
    }
    if($_SESSION['loginfirst']=='true')
    {
        header('Location:changepassfirst.php');
    }
    if($_SESSION['status']!='Đã duyệt')
    {
        echo "<script>alert('Tài khoản đang chờ xác minh nên bạn không thể sử dụng dịch vụ'); window.location = 'home.php';</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style.css">
    <!-- custom css file link  -->
    <style>
        

*{
    /* font-family: 'Poppins', sans-serif; */
    margin:0; 
    padding:0;
    box-sizing: border-box;
    outline: none;
    border: none;
    text-decoration: none;
    /* text-transform: uppercase; */
   
}
.gridcard{
    background-color: #eee;
    padding-top: 30px;
    padding-bottom: 13rem;
}
.container{
    min-height: 100vh;
    /* background: rgb(240, 232, 232); */
    display: flex;
    align-items: center;
    justify-content: center;
    flex-flow: column;
    padding-bottom: 60px;
    width: 100%;
}

.container form{
    background: #fff;
    border-radius: 5px;
    box-shadow: 0 10px 15px rgba(0,0,0,.1);
    padding: 20px;
    width: 600px;
    padding-top: 160px;
}

.container form .inputBox{
    margin-top: 20px;
}

.container form .inputBox span{
    display: block;
    color:#999;
    padding-bottom: 5px;
}

.container form .inputBox input,
.container form .inputBox select{
    width: 100%;
    padding: 10px;
    border-radius: 10px;
    border:1px solid rgba(0,0,0,.3);
    color:#444;
}

.container form .flexbox{
    display: flex;
    /* flex-direction: column; */
    gap:15px;
}

.container form .flexbox .inputBox{
    flex:1 1 150px;
}

.container form .submit-btn{
    width: 100%;
    background:linear-gradient(45deg, blueviolet, deeppink);
    margin-top: 20px;
    padding: 10px;
    font-size: 20px;
    color:#fff;
    border-radius: 10px;
    cursor: pointer;
    transition: .2s linear;
}

.container form .submit-btn:hover{
    letter-spacing: 2px;
    opacity: .8;
}

.container .card-container{
    margin-bottom: -150px;
    position: relative;
    height: 260px;
    width: 400px;
    
}

.container .card-container .front{
    position: absolute;
    height: 100%;
    width: 100%;
    top: 0; left: 0;
    background:linear-gradient(45deg, blueviolet, deeppink);
    border-radius: 5px;
    backface-visibility: hidden;
    box-shadow: 0 15px 25px rgba(0,0,0,.2);
    padding:20px;
    transform:perspective(1000px) rotateY(0deg);
    transition:transform .4s ease-out;
}

.container .card-container .front .image{
    display: flex;
    align-items:center;
    justify-content: space-between;
    padding-top: 10px;
}

.container .card-container .front .image img{
    height: 50px;
}

.container .card-container .front .card-number-box {
    padding:30px 0;
    font-size: 22px;
    color:#fff;
}
.card-money-name{
    font-size: 22px;
    color:#fff;
}

.container .card-container .front .flexbox{
    display: flex;
}

.container .card-container .front .flexbox .box:nth-child(1){
    margin-right: auto;
}

.container .card-container .front .flexbox .boxx{
    font-size: 15px;
    color:#fff;
}

.container .card-container .back{
    position: absolute;
    top:0; left: 0;
    height: 100%;
    width: 100%;
    background:linear-gradient(45deg, blueviolet, deeppink);
    border-radius: 5px;
    padding: 20px 0;
    text-align: right;
    backface-visibility: hidden;
    box-shadow: 0 15px 25px rgba(0,0,0,.2);
    transform:perspective(1000px) rotateY(180deg);
    transition:transform .4s ease-out;
}

.container .card-container .back .stripe{
    background: #000;
    width: 100%;
    margin: 10px 0;
    height: 50px;
}

.container .card-container .back .boxx{
    padding: 0 20px;
}

.container .card-container .back .boxx span{
    color:#fff;
    font-size: 15px;
}

.container .card-container .back .boxx .cvv-box{
    height: 50px;
    padding: 10px;
    margin-top: 5px;
    color:#333;
    background: #fff;
    border-radius: 5px;
    width: 100%;
    font-size: 20px;
}

.container .card-container .back .boxx img{
    margin-top: 30px;
    height: 30px;
}
    </style>

</head>
<body>

<div class="container">

    <div class="card-container">
        <div class="front">
            <div class="image">
                <img src="assets/img/chip-1-logo-svg-vector.svg" alt="">
                <img src="assets/img/visa.png" alt="">
            </div>
            <div class="card-number-box">################</div>
            <div class="flexbox">
                <div class="boxx" style="margin-right: 50px;">
                    <span>CARD HOLDER</span>
                    <div class="card-holder-name"><?=$name?></div>
                </div>
                <!-- <div class="boxx">
                    <span>expires</span>
                    <div class="expiration">
                        <span class="exp-day">dd</span>
                        <span class="exp-month">mm</span>
                        <span class="exp-year">yy</span>
                    </div>
                </div> -->
                <div class="boxx" style="margin-right: 50px;">
                    <span>VALID THRU</span>
                    <div class="card-date-name">YY/MM/DD</div>
                </div>
            </div>
            <div class="card-money-name"></div>
        </div>

        <div class="back">
            <div class="stripe"></div>
            <div class="boxx">
                <span>CVV</span>
                <div class="cvv-box"></div>
                <img src="assets/img/visa.png" alt="">
            </div>
        </div>

    </div>

    <form action="" method="POST" id="formnaptien" style="font-size:15px">
        <div class="inputBox">
            <span>CARD NUMBER</span>
            <input type="text" maxlength="16" class="card-number-input" id="idcard" onchange="checkid()" name="idcard">
        </div>
        <div class="inputBox">
            <span>NAME CARD</span>
            <input type="text" class="card-holder-input" value="<?=$name?>" disabled>
        </div>
        <div class="flexbox">
            <div class="inputBox">
                <span>EXPIRES</span>
                <input type="date" class="card-date-input" name="datecard">
            </div>
            <div class="inputBox">
                <span>CVV</span>
                <input type="text" maxlength="4" class="cvv-input" name="cvv" id="cvv">
            </div>
        </div>
        <div class="inputBox">
            <span>MONEY</span>
            <input type="text" class="card-money-input" name="money" id="currency-field" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" disabled data-type="currency">
        </div>
        <input type="submit" class="submit-btn" value="Nạp tiền" name="okmoney" id="okmoney" onkeyup="typeMoney()">
        <div class="thongbaocard" style="color: #ee4d2d;text-align:center;font-size:15px;margin-top:15px">
            <?php
                echo $thongbao;
            ?>
        </div>
    </form>

</div>    
    





<script>

document.querySelector('.card-number-input').oninput = () =>{
    document.querySelector('.card-number-box').innerText = document.querySelector('.card-number-input').value;
}

document.querySelector('.card-holder-input').oninput = () =>{
    document.querySelector('.card-holder-name').innerText = document.querySelector('.card-holder-input').value;
}

document.querySelector('.card-money-input').oninput = () =>{
    document.querySelector('.card-money-name').innerText = document.querySelector('.card-money-input').value;
}

//date
document.querySelector('.card-date-input').oninput = () =>{
    document.querySelector('.card-date-name').innerText = document.querySelector('.card-date-input').value;
}

document.querySelector('.day-input').oninput = () =>{
    document.querySelector('.exp-day').innerText = document.querySelector('.day-input').value;
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







</body>
</html>