<?php

$curl = curl_init();

$merchant_key = base64_encode("sk_test_RwDwnKPEeGEpvGgu4wFaXJyQ");

//echo $merchant_key;
curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.paymongo.com/v1/links",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\"data\":{\"attributes\":{\"amount\":30000,\"description\":\"Test Case\",\"remarks\":\"test case\"}}}",
  CURLOPT_HTTPHEADER => [
    "Accept: application/json",
    "Authorization: Basic ".$merchant_key."",
    "Content-Type: application/json"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  //echo $response;

  $json_response = json_decode($response, true);
  echo $json_response['data']['attributes']['checkout_url'];
}

?>

<html>

<head>
</head>

<script>

</script>
</html>