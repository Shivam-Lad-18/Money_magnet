<?php

use function PHPSTORM_META\type;

 include("config.php");  ?>
<?php
$date = gmdate("Y-n-j");
$date2 = new DateTime($date);
$newDay = date('t');
$date2->setDate($date2->format('Y'), $date2->format('n'), $newDay);
$result1 = mysqli_query($con, "SELECT * FROM `register` WHERE stat=1");
$totalamt = 0;
class Person
{
    public $id;
    public $name;
    public function __construct($name, $id)
    {
        $this->name = $name;
        $this->id = $id;
    }
}
$paiduser = [];
$unpaiduser = [];
while ($row = mysqli_fetch_array($result1)) {
    $date3 = new DateTime($row["lastdepo"]);
    $interval = $date2->diff($date3);
    if ($interval->m >= 1 || $interval->y >= 1) {
        $totalamt += 100;
        $person1 = new Person($row["name"], $row["id"]);
        array_push($unpaiduser, $person1);
    } else {
        $person1 = new Person($row["name"], $row["id"]);
        array_push($paiduser, $person1);
    }
}
$depomon = $totalamt;
// echo $totalamt;
echo "<br>";
$emimon = 0;
$result1 = mysqli_query($con, "SELECT * FROM `loanreq` WHERE status IN ('pending')");
while ($row = mysqli_fetch_array($result1)) {
    $date3 = new DateTime($row["lastemi"]);
    $interval = $date2->diff($date3);
    $days = $interval->d;
    $days += $interval->m * 30;
    $days += $interval->y * 365;
    if ($days >= 45) {
        $pel = $days / 30 * 100;
        $pel = round($pel);
        $totalamt += $pel;
        $lid = $row["loanid"];
        $result2 = mysqli_query($con, "UPDATE `loanreq` SET `penalties`='$pel' WHERE 
                loanid=$lid");
    }

    if ($interval->m >= 1 || $interval->y >= 1) {
        $a = $row["amount"] / 10;
        // echo $a;
        $emimon = $a;
    }
}
$loanpen = $totalamt - $depomon;
$totalamt += $emimon;

$total = 0;
$result1 = mysqli_query($con, " SELECT `amount` FROM `data` WHERE 1 ");
while ($row = mysqli_fetch_array($result1)) {
    $total = $row["amount"];
}
$totalstr = "₹ " . $total;


$mon = (int) date('n');
$yr = (int) date('Y');
$totalloan = 0;

$query = "SELECT * FROM expenditure WHERE YEAR(date) = ? AND MONTH(date) = ?";
$stmt = mysqli_prepare($con, $query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ii", $yr, $mon);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_array($res)) {
        $totalloan += $row["amount"];
    }
    mysqli_stmt_close($stmt);
}

$totalexp = 0;

$query = "SELECT * FROM otherexp WHERE YEAR(date) = ? AND MONTH(date) = ?";
$stmt = mysqli_prepare($con, $query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ii", $yr, $mon);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_array($res)) {
        $totalexp += $row["amount"];
    }
    mysqli_stmt_close($stmt);
}

?>
<!DOCTYPE html>
<html>
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600&display=swap" rel="stylesheet" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Preahvihear&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="icon" href="favicon.png" type="image/x-icon">
<link rel="shortcut icon" href="favicon.png" type="image/x-icon">
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

        .sidebar {
            height: 100%;
            width: 200px;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            align-items: start;
            margin-top: 135px;
            gap: 15px;

        }

        .sidebar a {
            padding: 10px 15px;
            background-color: #367cdf;
            border-radius: 0px 10px 10px 0px;
            text-decoration: none;
            display: flex;
            justify-content: end;
            font-size: 16px;
            color: #fff;
            width: 100%;
        }

        .sidebar a:hover {
            background-color: #d2d7dd;
            color: #367cdf;
        }

        .sidebar .home {
            font-size: 18px;
            background-color: #d2d7dd;
            color: #367cdf;
            transform: scale(1.2);
            box-shadow: 0px 0px 7px #444;
        }

        .content {
            margin: 110px 10px 0px 270px;
            background-color: #367cdf;
            height: 70vh;
            padding: 20px;
            border-radius: 20px;
            color: #d2d7dd;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 30px;
        }

        .content h1 {
            font-size: 26px;
        }

        .deposit {
            display: flex;
            flex-direction: column;
            padding: 10px 20px;
            /* border: 1px solid #444; */
            border-radius: 10px;
            font-size: 12px;
            justify-content: center;
            align-items: center;
            background-color: #d2d7dd;
            color: #052659;
            width: 30%;
            box-shadow: 0px 0px 5px #444;
        }

        .amt {
            font-size: 22px;
            color: #00c000;
            font-weight: 900;
        }

        .amt1 {
            font-size: 24px;
            color: #00c000;
            font-weight: 900;
        }

        .amt2 {
            font-size: 27px;
            color: #00c000;
            font-weight: 900;
        }

        .details {
            display: flex;
            gap: 11px;
            width: 100%;
            justify-content: center;
        }

        .total {
            font-size: 24px;
            font-weight: 900;
            background-color: #d2d7dd;
            color: #367cdf;
            padding: 10px;
            border-radius: 10px;
            width: 96%;
            text-align: center;
            box-shadow: 0px 0px 5px #444;
        }

        .currbal {
            background-color: #d2d7dd;
            color: #367cdf;
            padding: 10px 20px;
            width: 46%;
            border-radius: 10px;
            text-align: center;
        }

        .bal h1 {
            font-size: 27px;

        }
        .tile{
            display: flex;
            width: 100%;
            justify-content: center;
            align-items: center;
            gap: 50px;
        }
        .expe,.loanpage{
            width: 45%;
            gap: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .loanpage .deposit{
            display: flex;
            flex-direction: column;
            padding: 10px 20px;
            /* border: 1px solid #444; */
            border-radius: 10px;
            font-size: 12px;
            justify-content: center;
            align-items: center;
            background-color: #d2d7dd;
            color: #052659;
            width: 46%;
            box-shadow: 0px 0px 5px #444;
        }
        .loanpage .amt{
            font-size: 22px;
            color: #ca4848;
            font-weight: 900;
        }
        .loanpage .amt1{
            font-size: 24px;
            color: #ca4848;
            font-weight: 900;
        }
        .prof{
            position: fixed;
            top: 30px;
            right: 0;
            display: flex;
            gap: 10px;
            background-color: #367cdf;
            border-radius: 500px 0 0 500px;
            padding:10px 10px;
            align-items: center;
            justify-content: start;
            width: fit-content;
            color: #d2d7dd;
            font-size: 18px;
        }
        .prof img{
            border-radius: 50px;
            border: 2px solid #d2d7dd;
        }
        .admin {
            background-color: #367cdf;
            width: fit-content;
            font-size: 23px;
            border-radius: 0px 0px 40px 40px;
            padding: 4px 30px;
            position: fixed;
            top: 0;
            left: 39%;
            box-shadow: 0px 0px 10px #444;
            width: 24%;
            color: #d2d7dd;
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
            if (currentScrollPos > 30) {
                document.getElementById("navbar").style.opacity = 0;
                document.getElementById("sidebar").style.marginTop = "20px";
                document.getElementById("prof").style.opacity = 0;
                document.getElementById("admin").style.opacity = 0;
            } else {
                document.getElementById("navbar").style.opacity = 1; /* Adjust the height of your navbar */
                document.getElementById("sidebar").style.marginTop = "135px";
                document.getElementById("prof").style.opacity = 1;
                document.getElementById("admin").style.opacity = 1;
            }
            prevScrollPos = currentScrollPos;
        };
    </script>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <a class="home" href="adminhomenew.php">Home</a>
        <a class="vali" href="adminuservalinew.php">Validate User</a>
        <a class="loan" href="adminloannew.php">Manage Loans</a>
        <a class="pastrec" href="adminpastrecord.php">Past Records</a>
        <a class="pastdepo" href="adminpastdepo.php">Past Deposit</a>
        <a class="depostat" href="adminhistory.php">Current Deposit Status</a>
        <a class="exep" href="adminexpense.php">Manage Expenses</a>
    </div>

    <div class="prof" id="prof">
        <img src="profile.jpg" width="40px" alt="">
        <h4><?= $_SESSION["adminname"] ?></h4>
    </div>

    <div class="admin" id="admin">
        <h1>Admin Panel</h1>
    </div>
    <!-- Page content -->
    <div class="content">

        <div class="currbal">
            <h1>Current Balance : <span class="amt2">₹ <?= $total ?></span> </h1>
        </div>
        <div class="tile">
            <div class="expe">
                <h1> Expected amount of month </h1>
                <div class="details">
                    <div class="deposit"><span class="amt">₹ <?= $depomon ?></span>Via Deposit</div>
                    <div class="deposit"><span class="amt">₹ <?= $loanpen ?></span>Via Penalties </div>
                    <div class="deposit"> <span class="amt">₹ <?= $emimon ?></span>Via EMI of Loans </div>
                </div>
                <h2 class="total">Expected Amount : <span class="amt1">₹ <?= $totalamt ?></span></h2>
            </div>

            <div class="loanpage">
            <h1> Expenses of month </h1>
                <div class="details">
                    <div class="deposit"><span class="amt">₹ <?= $totalloan ?></span>Via Loan</div>
                    <div class="deposit"><span class="amt">₹ <?= $totalexp ?></span>Other </div>
                </div>
                <h2 class="total">Expense Amount : <span class="amt1">₹ <?= $totalloan+$totalexp ?></span></h2>
            </div>
        </div>

    </div>
    
</body>

</html>