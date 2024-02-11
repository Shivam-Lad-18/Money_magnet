<?php
include("config.php");
$apiKey = '099eb0cd-02cf-4e2a-8aca-3e6c6aff0399';
$merchantId = 'PGTESTPAYUAT';
$keyIndex = 1;


$id = $_SESSION["id"];
$date = gmdate("Y-n-j");
$result = mysqli_query($con, "SELECT * FROM `register` WHERE id = '$id';");
$row = mysqli_fetch_assoc($result);
$name = $row["name"];
$email = $row["email"];
$phone = $row["phone"];
$address = $row["address"];
$age = $row["age"];
$balance = $row["balance"];
$lastdepo = $row["lastdepo"];
$amt = "₹ " . $balance;
$total = 0;
$result1 = mysqli_query($con, " SELECT `amount` FROM `data` WHERE 1 ");
while ($row = mysqli_fetch_array($result1)) {
    $total = $row["amount"];
}
$totalstr = "₹ " . $total;
$date = gmdate("Y-n-j");

$paymentData = array(
    'merchantId' => $merchantId,
    'merchantTransactionId' => "MT7850590068188104", // customer id
    "merchantUserId" => "MUID123",
    'amount' => 10000, // Amount in paisa (10 INR)
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

        if (isset($_POST['deposit'])) {
            $balance += 100;
            $result = mysqli_query($con, "UPDATE `register` SET `balance`='$balance',`lastdepo`='$date' WHERE id=$id");
            mysqli_query($con, "INSERT INTO `deposits`(id, amount, date) VALUES ('$id','100','$date')");
            $result = mysqli_query($con, "SELECT * FROM `data` WHERE 1");
            $row1 = mysqli_fetch_assoc($result);
            $t2 = $row1["amount"];
            $t3 = $t2 + 100;
            $result = mysqli_query($con, "UPDATE `data` SET `amount`='$t3' WHERE 1");
        }

        header('Location:' . $payUrl);
    }
}
