<?php include("config.php");
if ((isset($_SESSION["id"]))) {
    $id = $_SESSION["id"];
    $result = mysqli_query($con, "SELECT * FROM `register` WHERE id = '$id';");
    $row = mysqli_fetch_assoc($result);
    $name = $row["name"];
    $email = $row["email"];
    $phone = $row["phone"];
    $address = $row["address"];
    $age = $row["age"];
    $balance = $row["balance"];
    $lastdepo = $row["lastdepo"];
    $regdate = $row["regdate"];
    $amt = $balance;
    $total = 0;
    $result1 = mysqli_query($con, " SELECT `amount` FROM `data` WHERE 1 ");
    while ($row = mysqli_fetch_array($result1)) {
        $total = $row["amount"];
    }
    $totalstr = "₹ " . $total;
}
else{
	header("Location: userlogin.php");
}

if((isset($_POST['logout']))){
    setcookie("email", "", time() - 3600, "/");
    setcookie("password", "", time() - 3600, "/");
    setcookie("id", "", time() - 3600, "/");
	header("Location: userlogin.php");

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
        @media (max-width:820px) {
            .bg{
                display: none;
            }
            .page{
                margin-top: 150px;
            }
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

        .home {
            border-bottom: 15px solid #367cdf;
        }

        .deposit,
        .loan,.history {
            border-bottom: 15px solid #d2d7dd;
        }

        .box:hover {
            background-color: #367cdf;
            cursor: pointer;
            border-bottom: 15px solid #367cdf;

        }

        .imghvr,
        .imghvr1,.imghvr2 {
            display: none;
        }

        .home {
            background-color: #367cdf;
        }

        .box img {
            height: 35px;
        }

        .deposit,
        .loan,.history {
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
            flex-wrap: wrap;
            justify-content: space-around;
            /* align-items: center; */
        }

        .info {
            margin-top: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 300px;
            background-color: #d2d7dd;
            border-radius: 15px;
            height: fit-content;
        }

        .details {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-size: 15px;
            color: #052659;
            text-align: center;
            padding-bottom: 20px;
            position: relative;
            top: -30px;
        }

        .pic img {
            border-radius: 15px;
            position: relative;
            top: -50px;
            box-shadow: 0px 0px 20px #021024;
        }

        .border {
            width: 80%;
            height: 1.5px;
            background-color: #214c87;
        }

        .namefont {
            color: #052659;
            font-size: 26px;
            font-weight: 700;
            font-family: Poppins;
        }

        .other {
            display: flex;
            justify-content: left;
            /* align-items: center; */
            flex-direction: column;
        }

        .details tr {
            display: flex;
            align-items: center;
            justify-content: left;
        }

        .balance {
            display: flex;
            flex-direction: column;
            margin-top: 50px;
            width: 50%;

        }

        .amt {
            display: flex;
            background-color: #d2d7dd;
            box-shadow: 0px 0px 10px #052b61;
            /* margin-top: 20px; */
            padding: 20px;
            border-radius: 15px;
            font-size: 18px;
            width: 60%;
            align-items: center;
        }
        .amt p{
            font-size: 30px;
            color: #008000;
            font-weight: 700;
        }
        .add {
            background-color: #d2d7dd;
            box-shadow: 0px 0px 10px #052b61;
            margin-top: 20px;
            padding: 20px;
            border-radius: 15px;
            font-size: 18px;
            width: 60%;
        }

        .add h2,.amt h2 {
            color: #052659;
            display: flex;
            align-items: center;
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
        .btn{
            padding: 10px 20px;
            color: white;
            background-color: #d85454;
            border: 0;
            border-radius: 10px;
            margin-top: 10px;
            cursor: pointer;
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
        <a class="home box" href="userhomenew.php"> <img src="home-white.png" alt=""> </a>
        <a class="deposit box" href="userdepo.php"><img class="orgimg" src="depo-black.png" alt=""><img class="imghvr" src="depo-white.png" alt=""> </a>
        <a class="loan box" href="userloannew.php"><img class="orgimg1" src="loan-black.png" alt=""> <img class="imghvr1" src="loan-white.png" alt=""></a>
        <a class="history box" href="userhistory.php"><img class="orgimg2" src="history-black.png" alt=""> <img class="imghvr2" src="history-white.png" alt=""></a>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const triggerDiv = document.querySelector('.deposit');
            const triggerDiv2 = document.querySelector('.loan');
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
        <h1 style="display: flex;align-items: center;">  <img src="fund.png" height="25px" alt=""> &nbsp; <span class="bal">Total Fund: &nbsp;</span> <span class="sign">₹</span><span class="counter"></span></h1>
    </div>

    <div class="page">
        <div class="info">
            <div class="pic">
                <img src="profile2.jpg" alt="" height="250px">
            </div>
            <div class="details">
                <div class="namefont">
                    <?= $name ?>, <?= $age ?>
                </div>
                <table style="text-align: left;">
                    <tr>
                        <td style="display: contents;align-items: center ;">
                            <img src="mail.png" height="20px" alt="">
                        </td>
                        <td>&nbsp;<?= $email ?></td>
                    </tr>

                    <tr>
                        <td style="display: contents;align-items: center ;"><img src="phone.png" height="20px" alt=""> </td>
                        <td>&nbsp;<?= $phone ?></td>
                    </tr>
                </table>
                <form action="" method="post">
                <button name="logout" class="btn"> Logout </button>
                </form>
            </div>
        </div>

        <div class="balance">
            <div class="amt">
                <h2><img src="money.png" alt=" " height="30px"> &nbsp;Balance</h2> <p>&nbsp;&nbsp;₹ <?= $amt ?></p>
                
            </div>
            <div class="add">
                <h2><img src="location.png" alt=" " height="30px"> &nbsp; Address</h2>
                <?= $address ?>
            </div>
            <div class="add">
                <h2><img src="date.png" alt=" " height="30px"> &nbsp; Registration Date</h2>
                <?= $regdate ?>
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
</body>

</html>