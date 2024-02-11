<!DOCTYPE html>
<html lang="en">

<head>
    <title>Qr code</title>
</head>
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600&display=swap" rel="stylesheet" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        flex-direction: column;
        background-color: #367cdf;
        font-family: Poppins;
    }

    img {
        height: 50%;
        width: 30%;
    }

    a {
        text-decoration: none;
        padding: 5px 10px 5px 10px;
        background-color:#367cdf;
        color:#C1E8FF;
        border-radius: 5px;
        margin: 10px;
    }
    .card{
        background-color: #C1E8FF;
        flex-direction: column;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 40%;
        padding: 20px;
        border-radius: 10px;
        /* height: 80vh; */
    }
    img{
        width: 60%;
    }
    h2{
        color: #C1E8FF;

    }
</style>

<body>
    <h2>Scan and pay the amount in below QR and wait for confirmation</h2>
    <div class="card">
        <img src="qr.jpeg">
        <a href="homenew.php">Payment Done</a>
    </div>
</body>

</html>