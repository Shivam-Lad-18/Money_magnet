<?php

use function PHPSTORM_META\type;

include("config.php");
$totalamt = 0;
$result1 = mysqli_query($con, " SELECT `amount` FROM `data` WHERE 1 ");
while ($row = mysqli_fetch_array($result1)) {
    $totalamt = $row["amount"];
}
if (isset($_POST['addexp'])) {

    $name = $_POST['expname'];
    $amt = $_POST['expamt'];
    $date = $_POST['expdate'];
    $descr = $_POST['expdesc'];

    if ($amt > $totalamt) {
?>
        <div class="alert">
            <img src="error.png" width="70px" alt="">
            <h1>Not enough Balance!!</h1>
            <form action="adminexpense.php">
                <input type="submit" value="cancel" class="cancelbtn">
            </form>
        </div>
<?php
    } else {
        $result1 = mysqli_query($con, " INSERT INTO `otherexp`(`name`, `amount`, `date`, `description`) VALUES ('$name','$amt','$date','$descr');");
        $upamt = $totalamt - $amt;
        $result2 = mysqli_query($con, " UPDATE `data` SET `amount`='$upamt' WHERE 1");
        header("Location: adminexpense.php");
    }
}
if (isset($_POST['rec'])) {
    $mon = $_POST["mon"];
    $monthName = date("F", mktime(0, 0, 0, $mon, 1));
    $yr = $_POST["year"];
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

        .sidebar .exep {
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
            flex-wrap: wrap;
            gap: 30px;
            justify-content: space-evenly;
        }

        .content h1 {
            font-size: 28px;
            width: 100%;
            text-align: center;
            height: fit-content;
        }

        .btn {
            background-color: #367cdf;
            padding: 10px 20px;
            width: 30%;
            border: 0;
            border-radius: 10px;
            color: #d2d7dd;
            cursor: pointer;
            margin-top: 20px;
        }

        .cancelbtn {
            background-color: #e23030;
            padding: 10px 20px;
            width: fit-content;
            border: 0;
            border-radius: 10px;
            color: #d2d7dd;
            cursor: pointer;
        }

        .form {
            display: flex;
            flex-direction: column;
            background-color: #d2d7dd;
            color: #052659;
            gap: 10px;
            padding: 20px;
            border-radius: 10px;
            width: 100%;
            align-items: center;
        }

        .input {
            display: flex;
            justify-content: space-between;
            width: 100%;
            font-size: 16px;
            font-weight: 600;
        }

        .input input {
            width: 40%;
            padding: 5px;
            border-radius: 10px;
            border: 0;
            color: #052659;
            font-size: 16px;

        }

        textarea {
            border-radius: 10px;
            width: 40%;
            padding: 5px;
            resize: none;
            border: 0;
            color: #052659;
            font-size: 16px;
        }

        .drop {
            width: 100%;
            background-color: #d2d7dd;
            color: #052659;
            padding: 20px;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            align-items: center;
        }

        .card {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 45%;
        }

        .dem {
            justify-content: space-between;
            font-size: 18px;
            width: 100%;
            font-weight: 900;
        }

        .dem select {
            background-color: #d2d7dd;
            border: 1 solid #052659;
            border-radius: 10px;
            padding: 5px 10px;
            width: 40%;
            font-size: 15px;
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
            animation: count 2s ease-in-out forwards;
        }

        .counter,
        .sign,
        .counter2 {
            color: #008000;
            font-weight: 700;
            font-size: 21px;
        }

        .counter {
            min-width: 100px;
        }

        .moneycount {
            display: block;
            position: fixed;
            min-width: 230px;
            top: 82%;
            left: 71%;
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

        .res {
            width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #000;
            background-color: #367cdf;
            color: #d2d7dd;
        }

        th {
            background-color: #d2d7dd;
            color: #052659;

        }

        th,
        td {
            padding: 10px;
            text-align: center;
            font-size: 16px;
            /* Increase the font size */
            font-family: Arial, sans-serif;
            /* Change the font style */
        }

        tr:not(.no):hover {
            background-color: #d2d7dd;
            color: #f5f5f5;
        }

        .btn1 {
            background-color: #d2d7dd;
            padding: 10px 20px;
            width: fit-content;
            border: 0;
            border-radius: 10px;
            color: #052659;
            cursor: pointer;
            font-size: 30px;
            position: fixed;
            top: 84%;
            right: 10px;
            box-shadow: 0px 0px 10px 0.5px black;

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

    <div class="moneycount" id="mc">
        <h1 style="display: flex;align-items: center;"> <img src="fund.png" height="25px" alt=""> &nbsp; <span class="bal">Total Fund: &nbsp;</span> <span class="sign">₹</span><span class="counter"></span></h1>

    </div>
    <button class="btn1" id="bt" onclick="hide()">></button>
    <script>
        function hide() {

            var ele = document.getElementById("mc");
            var btn = document.getElementById("bt");
            if (ele.style.display == "block") {
                btn.textContent = "<";
                ele.style.display = "none";
            } else {
                btn.textContent = ">";
                ele.style.display = "block";
            }
        }
    </script>

    <!-- Page content -->
    <div class="content">
        <div class="card">

            <h1>Add Expense</h1>
            <form action="" method="post" class="form">
                <div class="input">
                    <label for="name">Name of Expense : </label>
                    <input type="text" placeholder="Add name of expense" name="expname" required>
                </div>
                <div class="input">
                    <label for="amt">Amount Used : </label>
                    <input type="number" placeholder="Add amount of expense" name="expamt" required>
                </div>
                <div class="input">
                    <label for="date">Date of Expense : </label>
                    <input type="date" name="expdate" required>
                </div>
                <div class="input">
                    <label for="date">Description : </label>
                    <textarea name="expdesc" cols="24" rows="4" placeholder="Describe the expense" required></textarea>
                </div>
                <input type="submit" value="ADD" class="btn" name="addexp">
            </form>
        </div>
        <div class="card">
            <h1>Check past expense</h1>
            <form action="" method="post" class="drop">
                <div style="display: flex;gap: 20px;" class="dem">
                    <label for="months">Select a Month:</label>
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
                <div style="display: flex;gap: 20px;" class="dem">
                    <label for="year">Select a Year:</label>
                    <select id="year" name="year" required>
                        <option value="">-- Select Year --</option>
                    </select>
                </div>
                <input type="submit" value="View Records" name="rec" class="btn">
            </form>
        </div>
        <div class="res">

            <?php
            if (isset($_POST['rec'])) {
                $mon = $_POST["mon"];
                $monthName = date("F", mktime(0, 0, 0, $mon, 1));
                $yr = $_POST["year"];

                $query = "SELECT * FROM otherexp WHERE YEAR(date) = ? AND MONTH(date) = ?";
                $stmt = mysqli_prepare($con, $query);

                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "ii", $yr, $mon);
                    mysqli_stmt_execute($stmt);
                    $res = mysqli_stmt_get_result($stmt);
                    while ($row = mysqli_fetch_array($res)) {
                        // $totalexp += $row["amount"];
            ?>
                        <h1> Expenses of <?= $monthName ?>,<?= $yr ?></h1>
                        <table>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Description</th>
                            </tr>
                            <tr>
                                <td><?= $row["id"] ?></td>
                                <td><?= $row["name"] ?></td>
                                <td><?= $row["amount"] ?></td>
                                <td><?= $row["date"] ?></td>
                                <td><?= $row["description"] ?></td>
                            </tr>
                        </table>
            <?php
                    }
                    mysqli_stmt_close($stmt);
                }
            } ?>
        </div>
    </div>
    <script>
        var startYear = new Date("2023-01-01").getFullYear();
        var endYear = new Date().getFullYear();
        var yearDropdown = document.getElementById("year");
        for (var year = startYear; year <= endYear; year++) {
            var option = document.createElement("option");
            option.value = year;
            option.text = year;
            yearDropdown.appendChild(option);
        }
    </script>
</body>

</html>