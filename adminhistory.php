<?php include("config.php");  ?>

<?php
include('smtp/PHPMailerAutoload.php');
function smtp_mailer($to)
{
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $emailContent = "Dear Account holder, <br><br>
    We hope this message finds you well. We wanted to send you a quick reminder that your monthly deposit payment is due.<br><br>
    Please take a moment to make your payment to ensure your account remains in good standing.<br><br>
    Thank you for your prompt attention to this matter. We value your continued partnership, and we look forward to serving you in the coming months.<br><br>

    Sincerely,<br>
    Admin of Banking<br>
    URL<br>";
    $mail->Body = $emailContent;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->IsHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Subject = 'Monthly Deposit Payment Due';
    //$mail->SMTPDebug = 2; 
    $mail->Username = "shivamvlad3@gmail.com";
    $mail->Password = "mkmdhgczxuulipig";
    $mail->SetFrom("leviislub@gmail.com");
    $mail->AddAddress($to);
   
    if (!$mail->Send()) {
        echo $mail->ErrorInfo;
    } else {
        return 'Sent';
    }
}
?>

<?php
$date = gmdate("Y-n-j");
$date2 = new DateTime($date);
$newDay = date('t');
$date2->setDate($date2->format('Y'), $date2->format('n'), $newDay);
$result1 = mysqli_query($con, "SELECT * FROM `register` WHERE stat=1");
$totalamt = 0;
$sent = 0;
class Person
{
    public $id;
    public $name;
    public $num;
    public function __construct($name, $id, $num)
    {
        $this->name = $name;
        $this->id = $id;
        $this->num = $num;
    }
}
$paiduser = [];
$unpaiduser = [];
$unpaidemail = ["shivamvlad3@gmail.com"];
while ($row = mysqli_fetch_array($result1)) {
    $date3 = new DateTime($row["lastdepo"]);
    $interval = $date2->diff($date3);
    if ($interval->m >= 1 || $interval->y >= 1) {
        $totalamt += 100;
        $person1 = new Person($row["name"], $row["id"], $row["phone"]);
        array_push($unpaiduser, $person1);
        array_push($unpaidemail, $row["email"]);
    } else {
        $person1 = new Person($row["name"], $row["id"], $row["phone"]);
        array_push($paiduser, $person1);
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

<title>Money Magnet</title>

<head>
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

        .sidebar .depostat {
            font-size: 15px;
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

        table {
            width: 100%;
            border-collapse: collapse;
        }
        th,
        td {
            padding: 10px;
            text-align: center;
            font-size: 16px;
            /* Increase the font size */
            font-family: Arial, sans-serif;
            /* Change the font style */
            border: 1px solid #000;
            color: #052659;
        }

        tr:hover {
            color: #d2d7dd;
            background-color: #367cdf;
        }
        .mai{
            display: flex;
            justify-content:center;
            width:100%
        }
        .btn {
            background-color: #d2d7dd;
            padding: 10px 20px;
            width: fit-content;
            box-shadow: 0px 0px 10px #444;
            border: 0;
            border-radius: 10px;
            color: #052659;
            cursor: pointer;
            margin-top: 20px;
            font-size: 16px;
            position: fixed;
            bottom: 20px;
            left: 280px;
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
        <h1>Payment History</h1>
        <h2 style="font-size:x-large;color:#d2d7dd;"> User which have paid monthly despoit </h2>
        <?php
        if (isset($_POST["sentmail"])) {
            $sent = 1;
            $_SESSION["mail"] = true;
            foreach ($unpaidemail as $email) {
                smtp_mailer($email);
            }
        }
        ?>
        <div style="background-color: #d2d7dd;width:80%;">
                <table>
                    <tr class="no">
                        <th style="width:20%">ID</th>
                        <th>Name</th>
                        <th style="width:30%">Phone Number</th>
                    </tr>
                    <?php
                    foreach ($paiduser as $per) { ?>
                        <tr>
                            <td><?= $per->id ?></td>
                            <td><?= $per->name ?></td>
                            <td><?= $per->num ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
        </div>

        <h2 style="font-size:x-large;color:#d2d7dd;"> User which hava not yet paid monthly deposit </h2>
            <div style="background-color: #d2d7dd;width:80%;">
                <table style="border: 1px solid black;">
                    <tr class="no">
                        <th style="width:20%">ID</th>
                        <th>Name</th>
                        <th style="width:30%">Phone Number</th>
                    </tr>
                    <?php
                    foreach ($unpaiduser as $per) { ?>
                        <tr>
                            <td><?= $per->id ?></td>
                            <td><?= $per->name ?></td>
                            <td><?= $per->num ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
            <?php
            if ((count($unpaidemail) > 0) && ($sent == 0) && ($_SESSION["mail"]==false)) { ?>
                <form action="" method="post" class="mai">
                    <input type="submit" name="sentmail" value="Sent Email to unpaid users" class="btn" id="mail">
                </form>
            <?php } ?>
    </div>
</body>

</html>