<?php
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://g.payx.ph/payment_request',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array(
	'x-public-key' => 'pk_0a8b907482bcd7c96cd6b721ccc5e977',
	'amount' => '1',
	'description' => 'School Fees',
    'fee' => '1',
    'merchantname' => 'SQUIDEW',
    'customername' => 'Judyl Mendoza',
    'customeremail' => 'judylmendoza@gmail.com',
    'customermobile' => '09566583893',
    'merchantlogurl' => 'http://localhost/SQUIDEW/Dumps/success.php',
    'redirectsuccessurl' => 'https://localhost/SQUIDEW/Dumps/success.php',
    'redirectfailurl' => 'http://localhost/SQUIDEW/Dumps/failed.php',
    "checkouturl" => "https://getpaid.gcash.com/checkout/247d025e78852022936d0b59e6d96d7f",
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

$data = json_decode($response, true);

print_r('<br> Link: '.$data['data']['checkouturl']);

//header("Location: ".$data['data']['checkouturl']);

?>