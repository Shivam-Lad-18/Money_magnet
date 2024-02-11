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
    <link rel="icon" href="favicon.png" type="image/x-icon">
    <title>Document</title>
</head>
<style>
    *{
        margin: 0;
        padding: 0;
        
    }
    body{
        font-family: 'Poppins', sans-serif;
        width: 100vw;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        gap: 20px;
    }
    a{
        background-color: #367cdf;
        color: white;
        padding: 20px 40px;
        border: 0;
        border-radius: 20px;
        width: 10%;
        text-align: center;
        text-decoration: none;
        box-shadow: 0px 0px 10px #564b4b;
    }
    a:hover{
        background-color:#f0f0f0;
        color: #367cdf;
        animation: scaleBox 1s ease-in-out 1;
        animation-fill-mode: forwards;
    }
    @keyframes scaleBox {
      0% {
        transform: scale(1); /* Initial scale */
      }
      100% {
        transform: scale(1.1); /* Scaled to 1.5 times the original size */
      }
    }
</style>
<body>
    <a href="userlogin.php">User login</a>
    <a href="adminloginnew.php">Admin login</a>
</body>

</html>