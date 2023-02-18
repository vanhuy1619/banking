<?php
    require('../config.php');
    // Verify / Verify Account Code

    if (isset($_POST['dongyrut'])) {
        $id = $_POST['dongyrut'];

        $results = $con->query("SELECT * FROM ruttien where  id='$id'");
        $data = $results->fetch_assoc();
        $phone = $data['phone'];
        $moneyrut = $data['money'];

        $results = $con->query("SELECT * FROM users where phone='$phone'");
        $data = $results->fetch_assoc();
        $moneyco = $data['money'];

        if ($moneyrut*1.05>$moneyco) {
            $con->query("update ruttien set trangthairut='Thất bại do không đủ tiền' where id='$id'");
            echo "Success";
        } 
        else {
            $con->query("update ruttien set trangthairut='Thành công' where id='$id'");
            $con->query("update users set money=money-'$moneyrut'*1.05 where phone='$phone'");
            echo "Success";
        }
       
    }
    if (isset($_POST['tuchoirut'])) {
        $id = $_POST['tuchoirut'];
        $con->query("update ruttien set trangthairut='Thất bại do admin từ chối duyệt' where id='$id'");
        echo "Success";
    }

    if (isset($_POST['dongykichhoat'])) {
        $phone = $_POST['dongykichhoat'];
        $con->query("update users set status='Đã duyệt' where phone='$phone'");
        echo "Success";
    }

    if (isset($_POST['yeucauthemthongtin'])) {
        $phone = $_POST['yeucauthemthongtin'];
        $con->query("update users set status='Chờ cập nhật' where phone='$phone'");
        echo "Success";
    }

    if (isset($_POST['tuchoikichhoat'])) {
        $phone = $_POST['tuchoikichhoat'];
        $con->query("update users set status='Đã vô hiệu hóa' where phone='$phone'");
        echo "Success";
    }

    if (isset($_POST['mokhoa'])) {
        $phone = $_POST['mokhoa'];
        $con->query("update users set block='NULL', timeblock=0, statuslogin='NULL' where phone='$phone'");
        echo "Success";
    }

    if (isset($_POST['dongychuyen'])) {
        $id = $_POST['dongychuyen'];
        
        $results = $con->query("SELECT * FROM chuyentien where  id='$id'");
        $data = $results->fetch_assoc();
        $phonesend = $data['phonesend'];
        $phonereceive = $data['phonereceive'];
        $moneyreceive = $data['money'];
        $fee = $data['fee'];

        if ($fee == "Người gửi") {
            $sql1="update users set money=money-'$moneyreceive'*1.05 where phone='$phonesend'";
            if ($con->query($sql1) === TRUE) {
                $sql2="update users set money=money+'$moneyreceive' where phone='$phonereceive'";
                if ($con->query($sql2) === TRUE) {
                    $sqlnhantien="insert into nhantien(usernamereceive,namesend,phonesend,note,money) values ('$usernamereceive','$namesend','$phonesend','$notereceive','$moneyreceive')";
                    if ($con->query($sqlnhantien)) {
                        $con->query("update chuyentien set trangthaichuyen='Thành công' where id='$id'");
                        $sql3 = "select * from users where phone='$phonereceive'";
                        $result = $con->query($sql3);
                        if ($result->num_rows > 0) 
                        {
                            while($row = $result->fetch_assoc()) 
                            {
                                $summoney=$row['money'];
                            }
                        }
                        sendActivationEmail($emailreceive,"Bạn đã nhận được $moneyreceive từ số điện thoại $phonesend.<br> Số dư của bạn là: $summoney");
                        echo "Success";
                    }
                }
            }
            
        }

        else {
            $sql1="update users set money=money+'$moneyreceive'-'$moneyreceive'*0.05 where phone='$phonereceive'";
            if ($con->query($sql1) === TRUE) {
                $sql2="update users set money=money-'$moneyreceive' where phone='$phonesend'";
                if ($con->query($sql2) === TRUE) {
                    $sqlnhantien="insert into nhantien(usernamereceive,namesend,phonesend,note,money) values ('$usernamereceive','$namesend','$phonesend','$notereceive','$moneyreceive')";
                    if ($con->query($sqlnhantien)) {
                        $con->query("update chuyentien set trangthaichuyen='Thành công' where id='$id'");
                        $sql3 = "select * from users where phone='$phonereceive'";
                        $result = $con->query($sql3);
                        if ($result->num_rows > 0) 
                        {
                            while($row = $result->fetch_assoc()) 
                            {
                                $summoney=$row['money'];
                            }
                        }
                        sendActivationEmail($emailreceive,"Bạn đã nhận được $moneyreceive từ số điện thoại $phonesend.<br> Số dư của bạn là: $summoney");
                        echo "Success";
                    }
                }
            }
            
        }
    }
    
    if (isset($_POST['tuchoichuyen'])) {
        $id = $_POST['tuchoichuyen'];
        $con->query("update chuyentien set trangthaichuyen='Thất bại do admin từ chối' where id='$id'");
        echo "Success";
    }
    
?>