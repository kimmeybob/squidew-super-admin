<?php

require('../../pdf/fpdf.php');
require '../../Database Settings/database_access_credentials.php';

//Add Cashier ID --> Here.

$pdf = new FPDF();

$pdf->AddPage();
$pdf->SetFont("Arial","",14);

//---------------------Credits Transaction----------------->
$credit_total_transactions = 0;
$credit_revenue = 0; "1% on others";

$query_total_credits_receipt = "select transaction_amount from transaction where transaction_type = '5' and transaction_status = '1'";
$run_query_total_credits = mysqli_query($connection, $query_total_credits_receipt);

while($credit_row = mysqli_fetch_array($run_query_total_credits)){
    //echo $credit_row['transaction_amount']."<br>";
    $credit_total_transactions = bcadd($credit_total_transactions, $credit_row['transaction_amount'],2);

    //Revenue
    $credit_revenue_holder = $credit_row['transaction_amount'] * 0.01;//bcsub($credit_row['transaction_amount'], $credit_row['transaction_amount'] * 0.01,2);
    $credit_revenue = bcadd($credit_revenue, $credit_revenue_holder,2);
}
//echo "CASH IN (GCASH): ".$credit_total_transactions."<br>";


//---------------------Bills Transaction----------------->
$bills_total_transactions = 0;
$bills_revenue = 0; //15% cut for each payment (PHP 15.00 For SQUIEW and 3% on others)

//BILLS SQUIDEW
$query_total_bills_receipt = "select transaction_amount from transaction where transaction_type = '4' and transaction_status = '1'";
$run_query_total_bills = mysqli_query($connection, $query_total_bills_receipt);

while($bills_one_row = mysqli_fetch_array($run_query_total_bills)){
   // echo $bills_one_row['transaction_amount']."<br>";
    $bills_total_transactions = bcadd($bills_total_transactions, $bills_one_row['transaction_amount'],2);

    //Revenue
    $bills_revenue_holder = bcsub($bills_one_row['transaction_amount'], 15,2);
    $bills_revenue = bcadd($bills_revenue, $bills_revenue_holder,2);
}

//BILLS GCASH
$query_total_bills_receipt_two = "select transaction_amount from transaction where transaction_type = '1' and transaction_status = '1'";
$run_query_total_bills_two = mysqli_query($connection, $query_total_bills_receipt_two);

while($bills_two_row = mysqli_fetch_array($run_query_total_bills_two)){
    //echo $bills_two_row['transaction_amount']."<br>";
    $bills_total_transactions = bcadd($bills_total_transactions, $bills_two_row['transaction_amount'],2);

    //Revenue
    $bills_revenue_holder = bcsub($bills_two_row['transaction_amount'],$bills_two_row['transaction_amount'] * 0.03,2);
    $bills_revenue = bcadd($bills_revenue, $bills_revenue_holder,2);
}


//echo "BILLS (GCASH + SQUIDEW PAY): ".$bills_total_transactions."<br>";

//---------------------CASH IN Transaction----------------->
$cash_in_total_transactions = 0;

//CASH IN CAMPUS
$query_total_cash_in_receipt_one = "select transaction_amount from transaction where transaction_type = '2' and transaction_status = '1'";
$run_query_total_cash_in_one = mysqli_query($connection, $query_total_cash_in_receipt_one);

while($cash_in_one_row = mysqli_fetch_array($run_query_total_cash_in_one)){
    //echo $cash_in_one_row['transaction_amount']."<br>";
    $cash_in_total_transactions = bcadd($cash_in_total_transactions, $cash_in_one_row['transaction_amount'],2);
}

//echo "CASH IN: ".$cash_in_total_transactions."<br>";

//---------------------CASH OUT Transaction----------------->
$cash_out_total_transactions = 0;
$cash_out_revenue = 0;

//CASH Out Campus
$query_total_cash_out_receipt_one = "select transaction_amount from transaction where transaction_type = '3' and transaction_status = '1'";
$run_query_total_cash_out_one = mysqli_query($connection, $query_total_cash_out_receipt_one);

while($cash_out_one_row = mysqli_fetch_array($run_query_total_cash_out_one)){
    //echo $cash_out_one_row['transaction_amount']."<br>";
    $cash_out_total_transactions = bcadd($cash_out_total_transactions, $cash_out_one_row['transaction_amount'],2);

    //Revenue
    $cash_out_revenue_holder = bcsub($cash_out_one_row['transaction_amount'], 15,2);
    $cash_out_revenue = bcadd($cash_out_revenue, $cash_out_revenue_holder,2);
}

//echo "CASH OUT: ".$cash_out_total_transactions."<br>";
 

// Fixed -- > temporary lang sa unya rang details 
 //Tables
 $pdf->Cell(50,10,"Receipt No.",1,0);
 $pdf->Cell(140,10,"1",1,1);

 //Bills Payment
 $pdf->Cell(100,10,"Bills Payment Gross Amount: ",1,0);
 $pdf->Cell(90,10,"PHP ".$bills_total_transactions,1,1);

  //Bills Revenue
  $pdf->Cell(100,10,"Bills Payment Revenue Amount: ",1,0);
  $pdf->Cell(90,10,"PHP ".$bills_revenue,1,1);

 //Cash In
 $pdf->Cell(100,10,"Cash In Payment Gross Amount: ",1,0);
 $pdf->Cell(90,10,"PHP ".$cash_in_total_transactions,1,1);

  //Cash In
  $pdf->Cell(100,10,"Cash In Revenue Amount: ",1,0);
  $pdf->Cell(90,10,"PHP 0.00",1,1);

   //Cash In via Online
 $pdf->Cell(100,10,"Cash In Payment Gross Amount (Online): ",1,0);
 $pdf->Cell(90,10,"PHP ".$credit_total_transactions,1,1);

  //Cash In
  $pdf->Cell(100,10,"Cash In Revenue Amount (Online): ",1,0);
  $pdf->Cell(90,10,"PHP ".$credit_revenue,1,1);

 //Cash Out
 $pdf->Cell(100,10,"Cash Out Payment Gross Amount: ",1,0);
 $pdf->Cell(90,10,"PHP ".$cash_out_total_transactions,1,1);

  //Cash Out
  $pdf->Cell(100,10,"Cash Out Revenue Amount: ",1,0);
  $pdf->Cell(90,10,"PHP ".$cash_out_revenue,1,1);

$total_revenue_for_all = $cash_out_revenue+$credit_revenue+$bills_revenue;

 $pdf->Cell(100,10,"Total Revenue Amount",1,0);
 $pdf->Cell(90,10,"PHP ".$total_revenue_for_all,1,1);


 $pdf->Output();

?>