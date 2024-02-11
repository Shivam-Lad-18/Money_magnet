<?php include("config.php");  ?>
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

        .sidebar .pastdepo {
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

        .card {
            width: 100%;
            display: flex;
            gap: 20px;
            justify-content: center;
        }

        .card form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            align-items: center;
            width: 40%;
            background-color: #d2d7dd;
            color: #052659;
            padding: 20px;
            border-radius: 10px;
            height: fit-content;
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

        .btn {
            background-color: #367cdf;
            padding: 10px 20px;
            width: 40%;
            border: 0;
            border-radius: 10px;
            color: #d2d7dd;
            cursor: pointer;
            margin-top: 20px;
        }


        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #000;
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
            background-color: #367cdf;
            color: #f5f5f5;
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


    <!-- Page content -->
    <div class="content">

        <h1 id="h">Check Past Deposits</h1>
        <div class="card">
            <form action="" method="post">
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
                    <input type="submit" value="View Records" name="rec" class="btn" >
            </form>
        </div>
        <?php
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
        $eleuser = [];
        $paiduser = [];
        $unpaiduser = [];
        if (isset($_POST['rec'])) {
            $mon = $_POST["mon"];
            $monthName = date("F", mktime(0, 0, 0, $mon, 1));
            $yr = $_POST["year"];
            $daterec = new DateTime();
            $daterec->setDate($yr, $mon, 1);
            // echo $formattedDate."<br>";
            $result1 = mysqli_query($con, "SELECT * FROM `register` WHERE stat='1'");
            while ($row = mysqli_fetch_array($result1)) {
                $date3 = new DateTime($row["regdate"]);
                if ($date3 < $daterec) {
                    $interval = $daterec->diff($date3);
                    if ($interval->m >= "1") {
                        $person1 = new Person($row["name"], $row["id"]);
                        array_push($eleuser, $person1);
                    }
                }
            }
            foreach ($eleuser as $per) {
                // echo $per->id . "   " . $per->name . "<br>";
                $result1 = mysqli_query($con, "SELECT * FROM `deposits` WHERE id='$per->id' AND type='monthdepo'");
                if (mysqli_num_rows($result1) > 0) {
                    array_push($paiduser, $per);
                } else {
                    array_push($unpaiduser, $per);
                }
            }
            $monthName = date("F", mktime(0, 0, 0, $mon, 1));
        ?>

            <h2 style="font-size:x-large;"> User which have paid monthly despoit in <?= $monthName ?>/<?=$yr?> </h2>
            <div style="background-color: #d2d7dd;width:80%;display:flex;justify-content:center;">

                    <table>
                        <tr class="no">
                            <th style="width:20%">ID</th>
                            <th>Name</th>
                        </tr>
                        <?php
                        foreach ($paiduser as $per) { ?>
                            <tr>
                                <td><?= $per->id ?></td>
                                <td><?= $per->name ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
            </div>

            <h2 style="font-size:x-large;"> User which have not paid monthly despoit in <?= $monthName ?>/<?=$yr?></h2>
            <div style="background-color: #d2d7dd;width:80%;display:flex;justify-content:center;">

                    <table>
                        <tr class="no">
                            <th style="width:20%">ID</th>
                            <th>Name</th>
                        </tr>
                        <?php
                        foreach ($unpaiduser as $per) { ?>
                            <tr>
                                <td><?= $per->id ?></td>
                                <td><?= $per->name ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
            </div>
        <?php
        }
        ?>

    </div>
    <script>
        var startYear = new Date("2023-01-01").getFullYear();
        var currentDate = new Date();
        var endYear = currentDate.getFullYear();
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