<?php include("config.php");  ?>
<?php
$totalamt = 0;
$result1 = mysqli_query($con, " SELECT `amount` FROM `data` WHERE 1 ");
while ($row = mysqli_fetch_array($result1)) {
    $totalamt = $row["amount"];
}
if (isset($_POST['approve'])) {
    $lid = $_POST['loanid'];
    $loanamt = $_POST['loanamt'];
    $id = $_POST['id'];
    if ($loanamt > $totalamt) {
?>
        <div class="alert">
            <img src="error.png" width="60px" alt="">
            <h1>Not enough funds !!</h1>
            <form action="" method="post">
                <input type="submit" value="Cancel" class="can" name="cancel">
            </form>
        </div>
<?php
    } else {
        $select = "UPDATE `loanreq` SET `status`='pending' WHERE loanid='$lid' ";
        $resut = mysqli_query($con, $select);
        $date = gmdate("Y-n-j");
        $totalamt = $totalamt - $loanamt;
        $result1 = mysqli_query($con, "UPDATE `data` SET `amount`='$totalamt' WHERE 1");
        $result1 = mysqli_query($con, "INSERT INTO `expenditure`(`id`, `loanid`, `amount`, `date`, `type`) VALUES ('$id','$lid','$loanamt','$date','loan')");
        header("location:adminloannew.php");
    }
}
if (isset($_POST['cancel'])) {
    header("location:adminloannew.php");
}
if (isset($_POST['delete'])) {

    $lid = $_POST['loanid'];
    $select = "UPDATE `loanreq` SET `status`='rejected' WHERE loanid='$lid' ";
    $resut = mysqli_query($con, $select);
    header("location:adminloannew.php");
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
            font-size: 72%;
            /* box-sizing: border-box; */
        }

        body {
            font-family: 'Poppins', sans-serif;
            font-weight: 300;
            color: #444;
            line-height: 1.9;
            background-color: #C1E8FF;
        }

        .alert {
            display: flex;
            background-color: #d2d7dd;
            position: fixed;
            top: 7px;
            left: 30%;
            width: 40%;
            color: #367cdf;
            justify-content: space-around;
            z-index: 2;
            border-radius: 20px;
            padding: 30px;
            align-items: center;
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

        .sidebar .loan {
            font-size: 18px;
            background-color: #d2d7dd;
            color: #367cdf;
            transform: scale(1.2);
            box-shadow: 0px 0px 7px #444;
        }

        .prof img {
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

        .prof {
            position: fixed;
            top: 30px;
            right: 0;
            display: flex;
            gap: 10px;
            background-color: #367cdf;
            border-radius: 500px 0 0 500px;
            padding: 10px 10px;
            align-items: center;
            justify-content: start;
            width: fit-content;
            color: #d2d7dd;
            font-size: 18px;
        }

        .prof img {
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

        .content {
            margin: 128px 10px 0px 270px;
            background-color: #367cdf;
            min-height: 70vh;
            padding: 20px;
            border-radius: 20px;
            color: #d2d7dd;
            display: flex;
            gap: 10px;
            /* justify-content:start; */
            align-items: center;
            flex-direction: column;
            gap: 30px;

        }

        .content h1 {
            font-size: 28px;
            width: 100%;
            text-align: center;
            height: fit-content;
        }

        .container {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            /* justify-content: center; */
        }

        .card {
            border-radius: 10px;
            padding: 10px;
            color: #444;
            background-color: #d2d7dd;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: fit-content;
            width: 46%;
        }

        .but {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 50px;
        }

        #acc {
            padding: 7px 20px;
            border: 0;
            border-radius: 10px;
            background-color: #49e556;
            cursor: pointer;
            color: #052659;
            font-size: 15px;

        }

        #rej {
            padding: 7px 20px;
            border: 0;
            border-radius: 10px;
            background-color: #f16666;
            cursor: pointer;
            color: #052659;
            font-size: 15px;

        }

        .can {
            padding: 7px 20px;
            border: 0;
            border-radius: 10px;
            background-color: #f16666;
            cursor: pointer;
            color: #052659;
        }

        @property --num {
            syntax: '<integer>';
            inherits: true;
            initial-value: 0;
        }

        @keyframes count {
            to {
                --num: <?= $totalamt ?>;
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

        .info {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .info div {
            display: flex;
            flex-direction: column;
            padding: 5px;
            border-radius: 10px;
            border: 1px solid #444;
            font-size: 16px;
            font-weight: 700;
        }

        p {
            text-align: center;
        }

        .sml {
            text-align: center;
            font-size: 10px;
            font-weight: 500;
        }

        .done{
            display: flex;
            width: 100%;
            justify-content: space-around;
            align-items: center;
        }
        .cnt{
            display: flex;
            justify-content: center;
            gap: 30px;
            align-items: center;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
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
    <div class="moneycount">
        <h1 style="display: flex;align-items: center;"> <img src="fund.png" height="25px" alt=""> &nbsp; <span class="bal">Total Fund: &nbsp;</span> <span class="sign">₹</span><span class="counter"></span></h1>
    </div>

    <!-- Page content -->
    <div class="content">

        <h1>List of Loan to Approve</h1>
        <div class="container">
            <?php
            $un = "unapproved";
            $result = mysqli_query($con, "SELECT * FROM `loanreq` WHERE status IN ('unapproved')");
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) { 
                    ?>
                    <div class="card">
                        <div class="info">
                            <div style="min-width: 15%;">
                                <p><?= $row["id"] ?></p>
                                <p class="sml"> User ID </p>
                            </div>
                            <div style="min-width: 15%;">
                                <p><?= $row['loanid'] ?></p>
                                <p class="sml">Loan Id</p>
                            </div>
                            <div style="min-width: 50%;">
                                <p>₹ <?= $row['amount'] ?></p>
                                <p class="sml">Amount</p>
                            </div>
                            <div style="min-width: 43%;">
                                <p><?= $row['duration'] ?></p>
                                <p class="sml">Duration</p>
                            </div>
                            <div style="min-width: 43%;">
                                <p><?= $row['issuedate'] ?></p>
                                <p class="sml">Issue Date</p>
                            </div>
                        </div>
                        <form action="" method="POST" class="but">
                            <input type="hidden" name="loanid" value="<?= $row['loanid']; ?>" />
                            <input type="hidden" name="loanamt" value="<?= $row['amount']; ?>" />
                            <input type="hidden" name="id" value="<?= $row['id']; ?>" />
                            <input type="submit" name="approve" class="button" id="acc" value="Approve">
                            <input type="submit" name="delete" class="button" id="rej" value="Reject">
                        </form>
                    </div>
                <?php }
            } else { ?>
                <div class="done">
                    <div class="cnt">
                        <img src="greentick.png" width="70px" alt="">
                        <h1>No loan to approve</h1>
                    </div>
                </div>
            <?php } ?>


        </div>
    </div>
</body>

</html>