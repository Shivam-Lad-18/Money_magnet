<?php
require 'config.php';
if ((isset($_SESSION["id"]))) {
    $id = $_SESSION["id"];
    $date = gmdate("Y-n-j");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Qr code</title>
</head>
<?php
        $type=$_POST["type"];
        // echo $type;
        if($_POST["type"]=="emidepo"){
            $lid = $_POST['loanid'];
            $emirem = $_POST['emirem'] - 1;
            $emiamt = $_POST['emiamount'];
            if ($emirem == 0) {
                $result = mysqli_query($con, "UPDATE `loanreq` SET `emi_rem`='0', `status`='completed' ,`lastemi`='$date' WHERE loanid=$lid");
            } else {
                $result = mysqli_query($con, "UPDATE `loanreq` SET `emi_rem`='$emirem',`lastemi`='$date' WHERE loanid=$lid");
                $total = 0;
                $result1 = mysqli_query($con, " SELECT `amount` FROM `data` WHERE 1 ");
                while ($row = mysqli_fetch_array($result1)) {
                    $total = $row["amount"];
                }
                $total+=$emiamt;
                $result = mysqli_query($con, " UPDATE `data` SET `amount`='$total' WHERE 1");
                $result = mysqli_query($con, "INSERT INTO `deposits`(`id`, `amount`, `date`, `type`) VALUES ('$id','$emiamt','$date','emidepo')");
            }
        }
        else if($_POST["type"]=="penal"){
            $lid = $_POST["loanid1"];
            $pen = $_POST["pel"];
            $dateemi = new DateTime($date);
            $dateemi->modify('-1 month');
            $dd = $dateemi->format('Y-m-d');
            $result = mysqli_query($con, " UPDATE `loanreq` SET `lastemi`='$dd',`penalties`='0' WHERE loanid=$lid ");
            $total = 0;
            $result1 = mysqli_query($con, " SELECT `amount` FROM `data` WHERE 1 ");
            while ($row = mysqli_fetch_array($result1)) {
                $total = $row["amount"];
            }
            // echo $total;
            $total += $pen;
            $result = mysqli_query($con, " UPDATE `data` SET `amount`='$total' WHERE 1");
            $result = mysqli_query($con, "INSERT INTO `deposits`(`id`, `amount`, `date`, `type`) VALUES ('$id','$pen','$date','penalty')");
        }
    
?>
<style>
    body{
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        flex-direction: column;
        background-color: #367cdf;


    }
    img{
        height: 50%;
        width: 30%;
    }
    a{
    text-decoration: none;
    padding: 5px 10px 5px 10px;
    background-color: white;
    color: rgb(37, 81, 126);
    border-radius: 5px;
    margin:10px;
}
</style>
<body>
    <img src="qr.jpeg">
    <a href="userloannew.php">Payment Done</a>
</body>
</html>