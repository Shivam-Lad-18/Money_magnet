<?php
include("config.php");
$apiKey = '099eb0cd-02cf-4e2a-8aca-3e6c6aff0399';
$merchantId = 'PGTESTPAYUAT';
$keyIndex = 1;


$id = $_SESSION["id"];
$date = gmdate("Y-n-j");
$amt;

if($_POST["type"]=="emidepo"){
    $lid = $_POST['loanid'];
    $emirem = $_POST['emirem'] - 1;
    $emiamt = $_POST['emiamount'];
    $amt=$emiamt;
    if ($emirem == 0) {
        $result = mysqli_query($con, "UPDATE `loanreq` SET `emi_rem`='0', `status`='completed' ,`lastemi`='$date' WHERE loanid=$lid");
    } else {
        $result = mysqli_query($con, "UPDATE `loanreq` SET `emi_rem`='$emirem',`lastemi`='$date' WHERE loanid=$lid");
        $total = 0;
        $result1 = mysqli_query($con, " SELECT `amount` FROM `data` WHERE 1 ");
        while ($row = mysqli_fetch_array($result1)) {
            $total = $row["amount"];
        }
        $total+=$emiamt;
        $result = mysqli_query($con, " UPDATE `data` SET `amount`='$total' WHERE 1");
        $result = mysqli_query($con, "INSERT INTO `deposits`(`id`, `amount`, `date`, `type`) VALUES ('$id','$emiamt','$date','emidepo')");
    }
}
else if($_POST["type"]=="penal"){
    $lid = $_POST["loanid1"];
    $pen = $_POST["pel"];
    $amt=$pen;
    $dateemi = new DateTime($date);
    $dateemi->modify('-1 month');
    $dd = $dateemi->format('Y-m-d');
    $result = mysqli_query($con, " UPDATE `loanreq` SET `lastemi`='$dd',`penalties`='0' WHERE loanid=$lid ");
    $total = 0;
    $result1 = mysqli_query($con, " SELECT `amount` FROM `data` WHERE 1 ");
    while ($row = mysqli_fetch_array($result1)) {
        $total = $row["amount"];
    }
    // echo $total;
    $total += $pen;
    $result = mysqli_query($con, " UPDATE `data` SET `amount`='$total' WHERE 1");
    $result = mysqli_query($con, "INSERT INTO `deposits`(`id`, `amount`, `date`, `type`) VALUES ('$id','$pen','$date','penalty')");
}



// echo $amt;
$paymentData = array(
    'merchantId' => $merchantId,
    'merchantTransactionId' => "MT7850590068188104", // customer id
    "merchantUserId" => "MUID123",
    'amount' => ($amt*100), // Amount in paisa (10 INR)
    'redirectUrl' => "http://localhost/MoneyMagnet/userhomenew.php", // success url
    'redirectMode' => "POST",
    'callbackUrl' => "http://localhost/MoneyMagnet/userhomenew.php",
    "merchantOrderId" => "12345",
    "mobileNumber" => "9999999999",
    "message" => "Monthly deposit",
    "email" => "shivamvlad3@gmail.com",
    "shortName" => "Shivam Lad",
    "paymentInstrument" => array(
        "type" => "PAY_PAGE",
    )
);

$jsonencode = json_encode($paymentData);
$payloadMain = base64_encode($jsonencode);

$payload = $payloadMain . "/pg/v1/pay" . $apiKey;
$sha256 = hash("sha256", $payload);
$final_x_header = $sha256 . '###' . $keyIndex;
$request = json_encode(array('request' => $payloadMain));

$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => "https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $request,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
        "X-VERIFY: " . $final_x_header,
        "accept: application/json"
    ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $res = json_decode($response);

    if (isset($res->success) && $res->success == '1') {
        $paymentCode = $res->code;
        $paymentMsg = $res->message;
        $payUrl = $res->data->instrumentResponse->redirectInfo->url;

        

        header('Location:' . $payUrl);
    }
}
