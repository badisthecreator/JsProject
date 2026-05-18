<?php

require 'config.php';
include_once('TCPDF/tcpdf.php');

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   die('Unauthorized access');
}

$order_query = mysqli_query($conn, "SELECT * FROM orders WHERE user_id = '$user_id' ORDER BY id DESC LIMIT 1");

if(mysqli_num_rows($order_query) > 0){

   $fetch_orders = mysqli_fetch_assoc($order_query);

   $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

   $pdf->SetCreator(PDF_CREATOR);
   $pdf->setPrintHeader(false);
   $pdf->setPrintFooter(false);
   $pdf->SetMargins(10, 10, 10);
   $pdf->SetAutoPageBreak(TRUE, 10);
   $pdf->SetFont('helvetica', '', 12);
   $pdf->AddPage();

   $content = '';

   $content .= '
   <style>
      body {
         font-size: 12px;
         font-family: Helvetica, Arial, sans-serif;
         color: #000;
      }
      table {
         width: 100%;
         border: 1px solid #ccc;
         padding: 10px;
      }
      h2 {
         text-align: center;
      }
   </style>

   <h2>BookFair Invoice</h2>

   <table>
      <tr>
         <td><strong>Placed On:</strong> ' . date("d-m-Y", strtotime($fetch_orders['placed_on'])) . '</td>
      </tr>

      <tr>
         <td><strong>Name:</strong> ' . $fetch_orders['name'] . '</td>
      </tr>

      <tr>
         <td><strong>Email:</strong> ' . $fetch_orders['email'] . '</td>
      </tr>

      <tr>
         <td><strong>Address:</strong> ' . $fetch_orders['address'] . '</td>
      </tr>

      <tr>
         <td><strong>Payment Method:</strong> ' . $fetch_orders['method'] . '</td>
      </tr>

      <tr>
         <td><strong>Products:</strong> ' . $fetch_orders['total_products'] . '</td>
      </tr>

      <tr>
         <td><strong>Total Price:</strong> $' . $fetch_orders['total_price'] . '</td>
      </tr>

      <tr>
         <td><strong>Payment Status:</strong> ' . $fetch_orders['payment_status'] . '</td>
      </tr>
   </table>
   ';

   $pdf->writeHTML($content, true, false, true, false, '');

   ob_end_clean();
   $pdf->Output('bookfair_invoice.pdf', 'D');

}else{
   echo 'No order found for invoice generation.';
}

?>