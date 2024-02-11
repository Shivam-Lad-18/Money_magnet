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

<?php
$total = 0;
$result1 = mysqli_query($con, " SELECT `amount` FROM `data` WHERE 1 ");
while ($row = mysqli_fetch_array($result1)) {
    $total = $row["amount"];
}
$totalstr = "₹ " . $total;


$result = mysqli_query($con, "SELECT * FROM `register` WHERE id = '$id';");
$row = mysqli_fetch_assoc($result);
$balance = $row["balance"];

$penal=0;
$totalemi=0;
$result = mysqli_query($con, "SELECT * FROM `deposits` WHERE id = '$id';");
while ($row = mysqli_fetch_array($result)) {
    if($row["type"]=="penalty"){
    $penal+=$row["amount"];
    }
    if($row["type"]=="emidepo"){
    $totalemi+=$row["amount"];
    }
}

$loanamt=0;
$result = mysqli_query($con, "SELECT * FROM `loanreq` WHERE id = '$id'");
while ($row = mysqli_fetch_array($result)) {
    if($row["status"]=="completed" || $row["status"]=="pending"){
    $loanamt+=$row["amount"];
    }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Preahvihear&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--GOOGLE FONTS-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Play&display=swap" rel="stylesheet">

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
            background-color: #C1E8FF;
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

        .history {
            border-bottom: 15px solid #367cdf;
        }

        .deposit,
        .loan,
        .home {
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

        .history {
            background-color: #367cdf;
        }

        .box img {
            height: 35px;
        }

        .deposit,
        .loan,
        .home {
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
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .form {
            width: 30%;
            padding: 20px;
            border-radius: 10px;
            background-color: #d2d7dd;
            display: block;
            margin: auto;
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

        .form form {
            display: flex;
            justify-content: center;
            flex-direction: column;
            width: 100%;
            gap: 10px;
        }

        form select {
            width: 50%;
            background-color: #d2d7dd;
            border-radius: 10px;
            padding: 5px;
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

        .records {
            background-color: #d2d7dd;
            padding: 20px;
            border-radius: 10px;
            width: 75%;
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .records h1 {
            text-align: center;
            font-size: 24px;
            width: 100%;
        }

        .depomon,
        .credits {
            width: 43%;
            background-color: #d2d7dd;
            padding: 20px;
            border-radius: 10px;
            border: 1px solid #444;
            height: fit-content;
        }

        .depomon h1,
        .credits h1 {
            text-align: center;
            font-size: 20px;
        }

        .records h2 {
            text-align: center;
        }

        table,
        tr,
        td,
        th {
            border-collapse: collapse;
            border: 1px solid #444;
            padding: 5px;
            text-align: center;
            font-size: 11px;

        }

        th {
            background-color: #367cdf;
            color: #d2d7dd;
            font-size: 15px;
        }

        .tr {
            background-color: #d2d7dd;
        }

        tr:not(.no):nth-child(2n+1) {
            background-color: #367cdf;
            color: #d2d7dd;
        }

        tr:not(.no):hover {
            transform: scale(1.1, 1.1);
            overflow: hidden;
        }

        .cont {
            padding: 10px;
            border-radius: 10px;
            border: 1px solid #444;
            display: flex;
            flex-direction: column;
            font-size: 10px;
            font-weight: 400;
            width: 40%;
            align-items: center;
            text-align: center;
            height: fit-content;
        }

        .gree {
            font-size: 17px;
            color: #008000;
            font-weight: 900;
        }

        .red {
            font-size: 17px;
            color: #d13434;
            font-weight: 900;
        }

        .info {
            width: 60%;
            display: flex;
            padding: 20px;
            border-radius: 10px;
            /* border: 1px solid #444; */
            background-color: #d2d7dd;
            gap: 10px;
            flex-wrap: wrap;
        }

        .info h1 {
            width: 100%;
            text-align: center;
            height: fit-content;
            font-size: 25px;
        }

        .cont1 {
            width: 44%;
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
            border: 1px solid #444;
            padding: 15px;
            border-radius: 10px;
            justify-content:center;
            align-items: flex-start;
        }

        .cont1 h1 {
            width: 100%;
            text-align: center;
            font-size: 20px;
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
        <a class="home box" href="userhomenew.php"> <img src="home-black.png" class="orgimg2" alt=""> <img src="home-white.png" class="imghvr2" alt=""> </a>
        <a class="deposit box" href="userdepo.php"><img class="orgimg" src="depo-black.png" alt=""><img class="imghvr" src="depo-white.png" alt=""> </a>
        <a class="loan box" href="userloannew.php"><img class="orgimg1" src="loan-black.png" alt=""> <img class="imghvr1" src="loan-white.png" alt=""></a>
        <a class="history box" href="userhistory.php"><img src="history-white.png" alt=""></a>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const triggerDiv = document.querySelector('.deposit');
            const triggerDiv2 = document.querySelector('.loan');
            const triggerDiv3 = document.querySelector('.home');
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

            triggerDiv2.addEventListener('mouseover', function() {
                targetDiv11.style.display = 'block';
                targetDiv22.style.display = 'none';
            });

            triggerDiv2.addEventListener('mouseout', function() {
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

        <div class="form">
            <form action="" method="post">
                <div style="display: flex;gap: 10px;justify-content: space-between;">
                    <h1>Select a Month:</h1>
                    <select id="months" name="mon" required>
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                </div>
                <div style="display: flex;gap: 10px;justify-content: space-between;">
                    <h1>Select a Year:</h1>
                    <select id="year1" name="year" required>
                        <option value="">-- Select Year --</option>
                    </select>
                </div>
                <div style="display: block;margin: auto;">

                    <input type="submit" value="View Records" name="rec" class="btn">
                </div>
            </form>
        </div>

        <div class="info">
            <h1>Account Overview</h1>
            <div class="cont1">
                <h1>Deposit</h1>
                <div class="cont">
                    <div class="red">₹ <?= $balance ?></div>Monthly deposit
                </div>
                <div class="cont">
                    <div class="red">₹ <?= $totalemi ?></div>EMI Deposit
                </div>
                <div class="cont">
                    <div class="red">₹ <?= $penal ?></div>Penalties
                </div>
            </div>
            <div class="cont1">
                <h1>Credit</h1>                
                <div class="cont">
                    <div class="gree">₹ <?= $loanamt ?></div>Loan received
                </div>
            </div>

        </div>
        <?php
        if (isset($_POST['rec'])) {
            $mon = $_POST["mon"];
            $monthName = date("F", mktime(0, 0, 0, $mon, 1));
            $yr = $_POST["year"];
            $daterec = new DateTime();
            $daterec->setDate($yr, $mon, 1);
        ?>

            <div class="records">
                <h1>Records of <?= $monthName ?> / <?= $yr ?></h1>
                <div class="depomon">
                <h1>Deposists</h1>
                <?php
                // echo $formattedDate."<br>";
                $result1 = mysqli_query($con, "SELECT * FROM `deposits` WHERE id=$id AND MONTH(date) =  $mon");
                if (mysqli_num_rows($result1) > 0) {
                ?>


                        <table width="100%">
                            <tr class="no">
                                <th width="33%">Amount</th>
                                <th width="33%">Date</th>
                                <th width="33%">Type</th>
                            </tr>
                            <?php
                            while ($row = mysqli_fetch_array($result1)) {
                                // echo $row['amount']."<br>";
                                $type;
                                if ($row['type'] == "monthlydepo") {
                                    $type = "Monthly Deposit";
                                } else if ($row['type'] == "emidepo") {
                                    $type = "EMI Deposit";
                                } else {
                                    $type = "Penalty";
                                }

                            ?>

                                <tr>
                                    <td>₹ <?= $row['amount'] ?></td>
                                    <td><?= $row['date'] ?></td>
                                    <td><?= $type ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                    <?php
                } else {
                    ?>
                        <h2>No record found of Deposist !!</h2>
                    <?php
                }
                    ?>

                    </div>

                    <div class="credits">
                        <h1>Credits</h1>

                        <?php
                        // echo $formattedDate."<br>";
                        $result1 = mysqli_query($con, "SELECT * FROM `expenditure` WHERE id=$id AND MONTH(date) =  $mon");
                        if (mysqli_num_rows($result1) > 0) {
                        ?>
                            <table width="100%">
                                <tr class="no">
                                    <th width="25%">Loan ID</th>
                                    <th width="25%">Amount</th>
                                    <th width="25%">Date</th>
                                    <th width="25%">Type</th>
                                </tr>
                                <?php
                                while ($row = mysqli_fetch_array($result1)) {
                                    // echo $row['amount']."<br>";
                                ?>
                                    <tr>
                                        <td><?= $row['loanid'] ?></td>
                                        <td>₹ <?= $row['amount'] ?></td>
                                        <td><?= $row['date'] ?></td>
                                        <td>Loan</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </table>
                        <?php
                        } else {
                        ?>
                            <h2>No record found of Credits!!</h2>
                    <?php
                        }
                    }
                    ?>
                    </div>
            </div>


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
        var yearDropdown = document.getElementById("year1");
        var currentYear = new Date().getFullYear();
        var startYear = 2023;
        for (var year = startYear; year <= currentYear; year++) {
            var option = document.createElement("option");
            option.value = year;
            option.text = year;
            yearDropdown.appendChild(option);
        }
    </script>


</body>


</html>