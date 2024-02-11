<?php
require 'config.php';
if ((isset($_SESSION["id"]))) {
    $id = $_SESSION["id"];
    $date = gmdate("Y-n-j");
}
else{
	header("Location: userlogin.php");

}
?>

<!-- Initialize Data  -->
<?php
$result1 = mysqli_query($con, "SELECT * FROM `loanreq` WHERE id=$id AND status NOT IN ('completed', 'rejected') ");
$totalloan = 0;
$np = 0;
while ($row = mysqli_fetch_array($result1)) {
    $totalloan += $row["amount"];
}

// <!-- Balance -->
// echo $np;
$result1 = mysqli_query($con, "SELECT * FROM `register` WHERE id=$id");
$bal = 0;
while ($row = mysqli_fetch_array($result1)) {
    $bal = $row["balance"];
}


$sta = 0;
if (($bal * 5) > $totalloan) {
    $sta = 1;
}


$loanavail = ($bal * 5) - $totalloan;
$total = 0;
$result1 = mysqli_query($con, " SELECT `amount` FROM `data` WHERE 1 ");
while ($row = mysqli_fetch_array($result1)) {
    $total = $row["amount"];
}
$totalstr = "₹ " . $total;
?>
<?php
if (isset($_POST['del'])) {
    $lid = $_POST['loanid'];
    $result = mysqli_query($con, "DELETE FROM `loanreq` WHERE loanid=$lid");
    header("Location: userloannew.php");
}
?>
<?php
if (isset($_POST['loanreq'])) {
    $loanamt = $_POST["lamount"];
    // echo $totalloan,$bal;
    if (($bal * 5) >= ($loanamt + $totalloan)) {
        $result = mysqli_query($con, "INSERT INTO `loanreq`(`id`, `amount`, `duration`, `emi_rem`, `status`, `issuedate`, `lastemi`, `penalties`) VALUES ('$id','$loanamt','10','10','unapproved','$date','$date','0')");
        header("Location: userloannew.php");
    } else {
?>
        <script>
            alert("Please Check the Available Amount!!");
        </script>
<?php
    }
}
?>


<!DOCTYPE html>
<html>
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600&display=swap" rel="stylesheet" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Preahvihear&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!--GOOGLE FONTS-->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Play&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Special+Elite&display=swap" rel="stylesheet">

<head>
<title>Money Magnet</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            /* box-sizing: inherit; */
        }

        html {
            font-size: 62%;
            /* box-sizing: border-box; */
        }

        body {
            font-family: 'Poppins', sans-serif;
            font-weight: 300;
            color: #444;
            line-height: 1.9;
            background-color: #f3f3f3;
        }

        .name {
            background-color: #367cdf;
            position: fixed;
            top: 0;
            padding: 15px 20px 20px 10px;
            border-radius: 0px 0px 50px 0px;
            box-shadow: 0px 0px 10px black;
            font-family: Preahvihear;
        }

        .sty {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .sty h1 {
            font-size: xx-large;
            color: white;

        }

        .bgimg {
            height: 100vh;
            width: 100vw;
        }

        .bg {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-left: 390px;
            margin-top: 30px;
            margin-right: 50px;
            gap: 30px;

        }

        .bg .box {
            width: 100%;
            display: flex;
            justify-content: center;
            padding: 20px;
            border-radius: 30px 30px 0px 0px;
            /* height: 20px; */
            /* box-shadow: 0px 0px 10px black; */
            box-shadow: 0 -10px 10px -15px rgba(0, 0, 0, 1), -10px 0 10px -10px rgba(0, 0, 0, 0.5), 10px 0 10px -10px rgba(0, 0, 0, 0.5);

        }

        .loan {
            border-bottom: 15px solid #367cdf;
        }

        .deposit,
        .home,
        .history {
            border-bottom: 15px solid #d2d7dd;
        }

        .box:hover {
            background-color: #367cdf;
            cursor: pointer;
            border-bottom: 15px solid #367cdf;

        }

        .imghvr,
        .imghvr1,
        .imghvr2 {
            display: none;
        }

        .loan {
            background-color: #367cdf;
        }

        .box img {
            height: 35px;
        }

        .deposit,
        .home,
        .history {
            background-color: #d2d7dd;
        }

        @property --num {
            syntax: '<integer>';
            inherits: true;
            initial-value: 0;
        }

        @keyframes count {
            to {
                --num: <?= $total ?>;
            }
        }

        .counter::before {
            counter-reset: my-counter var(--num);
            content: counter(my-counter);
            animation: count 5s ease-in-out forwards;
        }

        .counter,
        .sign,
        .counter2 {
            color: #008000;
            font-weight: 700;
            font-size: 21px;
        }

        .moneycount {
            display: block;
            position: fixed;
            min-width: 230px;
            top: 82%;
            left: 78%;
            padding: 20px;
            border-radius: 10PX;
            box-shadow: 0px 0px 10px 0.5px black;
            background-color: #d2d7dd;
        }

        .bal {
            font-size: 19px;
            font-weight: 500;
            color: #052659;
        }

        .page {
            width: 94%;
            height: fit-content;
            background-color: #367cdf;
            margin: 0px 30px 0px 10px;
            border-radius: 30px;
            box-shadow: 0px 0px 10px black;
            padding: 30px;
            display: flex;
            justify-content: space-evenly;
            /* flex-direction: column; */
            flex-wrap: wrap;
            /* align-items: center; */
        }

        .fot {
            padding-left: 10px;
            padding-right: 10px;
        }

        .footer {
            background: #367cdf;
            padding: 30px 0px;
            font-family: 'Play', sans-serif;
            text-align: center;
            font-size: 15px;
            width: 100%;
            margin-top: 50px;
            border-radius: 30px 30px 0px 0px;
            box-shadow: 0px 0px 10px black;
        }

        .footer .row {
            width: 100%;
            margin: 1% 0%;
            padding: 0.6% 0%;
            color: white;
            font-size: 0.8em;
        }

        .footer .row a {
            text-decoration: none;
            color: white;
            transition: 0.5s;
        }

        .footer .row a:hover {
            color: #052659;
            letter-spacing: 1px;
        }

        .footer .row ul {
            width: 100%;
        }

        .footer .row ul li {
            display: inline-block;
            margin: 0px 30px;
        }

        .footer .row a i {
            font-size: 2em;
            margin: 0% 1%;
        }

        @media (max-width:720px) {
            .footer {
                text-align: left;
                padding: 5%;
            }

            .footer .row ul li {
                display: block;
                margin: 10px 0px;
                text-align: left;
            }

            .footer .row a i {
                margin: 0% 3%;
            }
        }

        .penal {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
        }

        .container1 {
            background-color: #d2d7dd;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px #444;
        }

        .container1 form {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 5px;
            width: 280px;
        }

        .id {
            border: 1px solid #052659;
            border-radius: 5px;
            width: 24%;
            padding: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-size: 14px;
        }

        .RemainingEMI,
        .issue {
            border: 1px solid #052659;
            border-radius: 5px;
            width: 46%;
            padding: 2px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-size: 12px;
        }

        .pena {
            border: 1px solid #052659;
            border-radius: 5px;
            width: 96%;
            padding: 2px;
            display: flex;
            justify-content: center;
            align-items: center;
            /* flex-direction: column; */
            gap: 10px;
            font-size: 15px;
        }

        .pena div {
            font-size: 20px;
            color: red;
            font-weight: 900;
        }

        .amount {
            border: 1px solid #052659;
            border-radius: 5px;
            width: 66%;
            padding: 2px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-size: 15px;
        }

        .error {
            display: flex;
            width: 100%;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin: 20px 10px;
            color: #d2d7dd;
            font-size: 17px;
        }

        .btn {
            padding: 10px 20px;
            background-color: #367cdf;
            border: 0;
            border-radius: 5px;
            color: #d2d7dd;
            box-shadow: 0px 0px 4px #444;
            margin-top: 20px;
            cursor: pointer;
        }

        .loanreq {
            width: 30%;
            background-color: #d2d7dd;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            height: fit-content;

        }

        .loanreq .cont h1 {
            font-size: 25px;
        }

        .loanreq .cont form {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-size: 15px;
            gap: 10px;
            margin-top: 20px;
        }

        .loanreq .cont form input {
            width: 30%;
            float: right;
            border-radius: 7px;
            border: 1px solid #444;
            padding: 5px;
        }

        .avail {
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 18px;
            border: 1px solid #444;
            /* width: fit-content; */
            padding: 5px;
            border-radius: 5px;
        }

        .exced {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 20px;
            font-size: 20px;
        }

        .appliedloan {
            background-color: #d2d7dd;
            width: 60%;
            padding: 20px;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            flex-direction: column;
            gap: 20px;
        }

        .appliedloan h2 {
            font-size: 25px;
            text-align: center;
        }

        .loancont {
            display: flex;
            justify-content: space-evenly;
            /* gap: 20px; */
            border: 1px solid #052659;
            padding: 10px;
            border-radius: 10px;
            height: 170px;
        }

        .loandet {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            width: 80%;
            max-width: 59%;
            flex: 1;
        }

        .loandet h4 {
            padding: 5px;
            border: 1px solid #444;
            border-radius: 3px;
            width: 40%;
            font-size: 12px;
        }

        .loandel {
            display: flex;
            flex-direction: column;
            gap: 5px;
            width: 35%;
            justify-content: center;
            align-items: center;
        }

        .loandel h1 {
            text-align: center;
            font-size: 15px;
        }

        .loandepo {
            width: 35%;
        }

        .loandepo form {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .loandepo h3 {
            font-size: 17px;
            text-align: center;
        }

        .delbtn {
            padding: 8px 10px;
            background-color: #ff3434;
            border: 0;
            border-radius: 5px;
            color: #d2d7dd;
            box-shadow: 0px 0px 2px #444;
            margin-top: 10px;
            cursor: pointer;
        }

        .emibtn {
            padding: 8px 10px;
            background-color: #008000;
            border: 0;
            border-radius: 5px;
            color: #d2d7dd;
            box-shadow: 0px 0px 2px #444;
            margin-top: 10px;
            cursor: pointer;
        }

        .emiinfo {
            display: flex;
            flex-wrap: wrap;
            font-size: 12px;
            gap: 10px;
        }

        .emiamt {
            text-align: center;
            width: 100%;
            border: 1px solid #444;
            padding: 5px;
            font-size: 14px;
        }

        .emirem {
            text-align: center;
            width: 43%;
            border: 1px solid #444;
            padding: 5px;

        }

        .emidate {
            text-align: center;
            width: 43%;
            border: 1px solid #444;
            padding: 5px;
        }

        .loancomp,
        .loanrem {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
            width: 35%;

            font-size: 15px;
        }

        .unapp {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
            width: 35%;
        }

        .unapp h2 {
            font-size: 17px;

        }
    </style>
</head>

<body>


    <div class="name" id="navbar">
        <div class="sty">
            <img src="logo1.png" alt="logo" height="50px">
            <h1>Money<span style="color:#8CF088;"> Magnet</span></h2>
                <h1></h1>
        </div>
    </div>

    <script>
        let prevScrollPos = window.pageYOffset;
        window.onscroll = function() {
            const currentScrollPos = window.pageYOffset;
            console.log("curr" + currentScrollPos);
            console.log("prev" + prevScrollPos);
            if (currentScrollPos > 20) {
                document.getElementById("navbar").style.opacity = 0;
            } else {
                document.getElementById("navbar").style.opacity = 1; /* Adjust the height of your navbar */
            }
            prevScrollPos = currentScrollPos;
        };
    </script>

    <div class="bg">


        <a class="home box" href="userhomenew.php"> <img class="orgimg" src="home-black.png" alt=""> <img class="imghvr" src="home-white.png" alt=""> </a>


        <a class="deposit box" href="userdepo.php"><img class="orgimg1" src="depo-black.png" alt=""> <img class="imghvr1" src="depo-white.png" alt=""></a>


        <a class="loan box" href="userloannew.php"><img src="loan-white.png" alt=""></a>

        <a class="history box" href="userhistory.php"><img class="orgimg2" src="history-black.png" alt=""> <img class="imghvr2" src="history-white.png" alt=""></a>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const triggerDiv = document.querySelector('.home');
            const triggerDiv12 = document.querySelector('.deposit');
            const triggerDiv3 = document.querySelector('.history');
            const targetDiv1 = document.querySelector('.imghvr');
            const targetDiv2 = document.querySelector('.orgimg');
            const targetDiv11 = document.querySelector('.imghvr1');
            const targetDiv22 = document.querySelector('.orgimg1');
            const targetDiv111 = document.querySelector('.imghvr2');
            const targetDiv222 = document.querySelector('.orgimg2');

            triggerDiv.addEventListener('mouseover', function() {
                targetDiv1.style.display = 'block';
                targetDiv2.style.display = 'none';
            });

            triggerDiv.addEventListener('mouseout', function() {
                targetDiv1.style.display = 'none';
                targetDiv2.style.display = 'block';
            });

            triggerDiv12.addEventListener('mouseover', function() {
                targetDiv11.style.display = 'block';
                targetDiv22.style.display = 'none';
            });

            triggerDiv12.addEventListener('mouseout', function() {
                targetDiv11.style.display = 'none';
                targetDiv22.style.display = 'block';
            });
            triggerDiv3.addEventListener('mouseover', function() {
                targetDiv111.style.display = 'block';
                targetDiv222.style.display = 'none';
            });

            triggerDiv3.addEventListener('mouseout', function() {
                targetDiv111.style.display = 'none';
                targetDiv222.style.display = 'block';
            });
        });
    </script>
    <div class="moneycount">
        <h1 style="display: flex;align-items: center;"> <img src="fund.png" height="25px" alt=""> &nbsp; <span class="bal">Total Fund: &nbsp;</span> <span class="sign">₹</span><span class="counter"></span></h1>
    </div>

    <div class="page">

<!-- ---------------------------Penalties-------------------------- -->
        <div class="penal">
            <?php
            $result1 = mysqli_query($con, "SELECT * FROM `loanreq` WHERE id=$id AND status NOT IN ('completed', 'rejected')");
            while ($row = mysqli_fetch_array($result1)) {
                $date2 = new DateTime($date);
                $date3 = new DateTime($row["lastemi"]);
                $interval = $date2->diff($date3);
                // echo($interval->d . " " . $interval->m . " " . $interval->y ."<br>");
                $days = $interval->d;
                $days += $interval->m * 30;
                $days += $interval->y * 365;
                // echo($days."<br>");
                $lid = $row["loanid"];
                $h = 0;
                if ($days >= 45) {
                    $pel = $days / 30 * 100;
                    $pel = round($pel);
                    $result2 = mysqli_query($con, "UPDATE `loanreq` SET `penalties`='$pel' WHERE 
                loanid=$lid");
                    $np = 1;
                    if ($h == 0) {
                        $h = 1;
            ?>
                        <div class="error">
                            <img src="error.png" alt="" width="50px">
                            <h1>Penalties</h1>
                        </div>

                    <?php
                    }
                    ?>
                    <div class="container1">
                        <form action="paymentdyna.php" method="POST">

                            <div class="id">
                                <h3>Loan ID</h3>
                                <div><?= $row["loanid"] ?></div>
                            </div>
                            <div class="amount">
                                <h2>Amount</h2>
                                <div>₹ <?= $row["amount"] ?></div>
                            </div>
                            <div class="RemainingEMI">
                                <h3>Remaining EMI</h3>
                                <div><?= $row["emi_rem"] ?></div>
                            </div>
                            <div class="issue">
                                <h3>Issue Date</h3>
                                <div><?= $row["issuedate"] ?></div>
                            </div>
                            <div class="pena">
                                <h2>Penalty : </h2>
                                <div>₹ <?= $pel ?></div>
                            </div>

                            <input type="hidden" value="penal" name="type">
                            <input type="hidden" value="<?= $pel ?>" name="pel">
                            <input type="number" value="<?= $row["loanid"] ?>" name="loanid1" style="display:none">
                            <input type="submit" name="penal" class="btn" value="Pay Penalties">

                        </form>
                    </div>
            <?php }
            }
            ?>
        </div>



        <?php
        if ($np == 0) {?>

            <div class="loanreq">
            <?php
            if ($sta == 1) { ?>
                    <div class="cont">
                        <h1>Request Loan</h1>
                        <div class="avail"> Available Amount : &nbsp; <span style="color: #008000;font-weight: 900;">₹ <?= $loanavail ?></span> </div>
                        <form method="POST" class="font" action="">
                            <div style="display: flex;gap: 10px;justify-content: space-between;width: 100%;">

                                <label for="lamount">Request Amount : </label>
                                <input type="number" name="lamount" placeholder="Add amount">
                            </div>
                            <div style="display: flex;gap: 10px;justify-content: space-between;width: 100%;">

                                <label for="dur">Duration (months) : </label>
                                <input type="number" value="10" disabled>
                            </div>
                            <div style="display: flex;gap: 10px;justify-content: space-between;width: 100%;">

                                <label for="amount"> Date : </label>
                                <input type="date" name="date" class="date1" disabled>
                            </div>

                            <input type="submit" name="loanreq" class="btn" value="Request">
                        </form>
                    </div>
                <?php
            } else { ?>
                    <div class="exced">
                        <img src="error.png" width="100px" alt="">
                        <h3>You have excedded the loan Request Limit!!</h3>
                    </div>
                <?php
            } ?>
                </div>
            <?php
        }
            ?>


            <?php
            if ($np == 0) { ?>
                <div class="appliedloan">
                    <h2>Applied Loan</h2>
                    <?php
                    $result = mysqli_query($con, "SELECT `id`,`loanid`, `amount`, `duration`, `emi_rem`, `status`, `issuedate`, `lastemi`, `penalties` FROM `loanreq` WHERE id=$id");
                    while ($row = mysqli_fetch_array($result)) { ?>
                        <div class="loancont">
                            <div class="loandet">

                                <h4>Loan ID : <?php echo $row["loanid"]; ?></h4>
                                <h4>Amount : ₹ <?php echo $row["amount"]; ?></h4>
                                <h4>Duration : <?php echo $row["duration"]; ?></h4>
                                <h4>Emi Remaining : <?php echo ($row["emi_rem"]); ?></h4>
                                <h4>Status : <?php echo $row["status"]; ?></h4>
                                <h4>Issue Date : <?php echo $row["issuedate"]; ?></h4>
                                <h4>Last EMI date : <?php echo $row["lastemi"]; ?></h4>
                                <h4>Penalties : <?php echo $row["penalties"]; ?></h4>

                            </div>

                            <!-- delete -->
                            <?php
                            if ($row["status"] == "rejected") {
                            ?>
                                <div class="loandel">
                                    <h1>This Loan is rejected by admin!</h1>
                                    <img src="reject.png" width="50px" alt="">
                                    <form action="" method="POST" class="font">
                                        <input value="<?= $row["loanid"] ?>" type="hidden" name="loanid">
                                        <input type="submit" name="del" class="delbtn" value="Delete">
                                    </form>
                                </div>
                            <?php } ?>


                            <!-- deposit emi -->
                            <?php
                            $date2 = new DateTime($date);
                            $date3 = new DateTime($row["lastemi"]);
                            $interval = $date2->diff($date3);
                            if (($row["status"] == "pending") && ($interval->m >= "1" || $interval->y >= "1") && ($row["emi_rem"] > 0) && $np == 0) {

                                $emiamt=$row["amount"];
                                $emiamt+=$emiamt * 0.05;
                                $emiamt=$emiamt/10;
                            ?>
                                <div class="loandepo">
                                    <h3>Pay EMI</h3>
                                    <div class="emiinfo">
                                        <div class="emiamt"> EMI amount : ₹ <?= $emiamt ?></div>
                                        <div class="emirem">EMI remaining : <?= $row["emi_rem"] ?></div>
                                        <div class="emidate">Date: <span id="currentDate"></span></div>

                                        <script>
                                            // JavaScript code to get and display the current date
                                            var currentDateElement = document.getElementById("currentDate");
                                            var currentDate = new Date();
                                            var year = currentDate.getFullYear();
                                            var month = currentDate.getMonth() + 1; // Month is zero-indexed, so we add 1
                                            var day = currentDate.getDate();

                                            // Format the date as YYYY-MM-DD
                                            var formattedDate = (day < 10 ? "0" : "") + day + "/" + (month < 10 ? "0" : "") + month + "/" + year;

                                            // Display the formatted date
                                            currentDateElement.textContent = formattedDate;
                                        </script>
                                    </div>
                                    <form action="paymentdyna.php" method="POST" class="font">
                                        <input type="hidden" value="emidepo" name="type">
                                        <input value="<?= $row["loanid"] ?>" type="number" style="display: none;" name="loanid">
                                        <input value="<?= $row["emi_rem"] ?>" type="number" style="display: none;" name="emirem" style="display:none">
                                        <input value="<?= $emiamt ?>" type="number" style="display: none;" name="emiamount">
                                        <input type="date" name="date" class="date1" style="display: none;" disabled>
                                        <input type="submit" class="emibtn" name="emipay" value="Pay Emi">
                                    </form>
                                </div>

                                <?php
                                if (isset($_POST['emipay'])) {
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
                                        $total += $emiamt;
                                        $result = mysqli_query($con, " UPDATE `data` SET `amount`='$total' WHERE 1");
                                        $result = mysqli_query($con, "INSERT INTO `deposits`(`id`, `amount`, `date`, `type`) VALUES ('$id','$emiamt','$date','emidepo')");
                                    }
                                    header("Location: userloannew.php");
                                }
                                ?>
                            <?php } else if ($row["status"] == "completed") {
                            ?>
                                <div class="loancomp">
                                    <h2>You have paid all EMI's</h2>
                                    <img src="greentick.png" width="50px" alt="">
                                </div>
                            <?php } else if ($row["status"] == "unapproved") {
                            ?>
                                <div class="unapp">
                                    <h2>Wait for the approval of loan</h2>
                                    <img src="waitnew.png" width="50px" alt="">
                                </div>
                            <?php
                            } else if ($row["status"] != "rejected") {

                                $date3->add(new DateInterval('P1M'));

                                // Format and display the result
                                $nextemi = $date3->format('Y-m-d');
                            ?>
                                <div class="loanrem">
                                    <h3>You have paid recent EMI</h3>
                                    <img src="greentick.png" width="30px" alt="">
                                    <h3>EMI remaining : <?= $row["emi_rem"] ?></h3>
                                    <h3 style="color: #367cdf;">Next EMI date : <?= $nextemi ?> </h3>
                                </div>
                            <?php
                            }
                            ?>

                        </div>


                    <?php } ?>

                </div>
            <?php } ?>


    </div>

    <div class="fot">
        <footer>
            <div class="footer">
                <div class="row">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                    <a href="#"><i class="fa fa-youtube"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                </div>

                <div class="row">
                    <ul>
                        <li><a href="#">Contact us</a></li>
                        <li><a href="#">Our Services</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms & Conditions</a></li>
                        <li><a href="#">Career</a></li>
                    </ul>
                </div>

                <div class="row">
                    MoneyMagnet Copyright © 2023 MM - All rights reserved || Designed By: Shivam
                </div>
            </div>
        </footer>
    </div>


    <script>
        var ele = document.querySelectorAll('.date1');
        ele.forEach(element => {
            element.valueAsDate = new Date();
        });
    </script>

    </div>

</body>

</html>