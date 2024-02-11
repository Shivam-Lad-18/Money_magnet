<?php
 $key="rzp_test_ik9Qb1rSMiwW7k";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    
    <form action="http://localhost/MoneyMagnet/userlogin.php" method="POST">
    <script
        src="https://checkout.razorpay.com/v1/checkout.js"
        data-key= <?=$key?>
        data-amount="100" 
        data-currency="INR"
        data-order_id="order_CgmcjRh9ti2lP7"
        data-buttontext="Pay"
        data-name="Money Magnet"
        data-description="Pay monthly deposit"
        data-image="https://img.freepik.com/premium-vector/money-magnet-logo-icon-vector-design-illustration_612390-692.jpg?w=740"
        data-prefill.name="Shivam Lad"
        data-prefill.email="shivamvlad3@gmail.com"
        data-theme.color="#F37254"
    ></script>
    <input type="hidden" id="myButton"  custom="Hidden Element" name="hidden"/>
    
    
    
    </form>
</body>
</html>