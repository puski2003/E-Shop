<?php

// Include the main TCPDF library (search for installation path).
session_start();
require_once('TCPDF/tcpdf.php');
$order_id=$_GET['id'];
require "connection.php";

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Pasidu Rajapaksha');
$pdf->SetTitle('PDF file using TCPDF');

// set default header data
$headerLogo = 'logo.svg'; // Path to your logo image
$headerLogoWidth = 14; // Width of the logo in the header
$headerTitle =' New Tech'; // Your company name
$headerString = "by Pasidu Rajapaksha -newtech.com\nwww.newtech.com"; // Additional header string (e.g., invoice date)

$pdf->SetHeaderData($headerLogo, $headerLogoWidth, $headerTitle, $headerString);

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(20, 20, 20);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// add a page

$pdf->AddPage();
$companyname = 'New Tech';
$total=0;
$rs = Database::search("SELECT * FROM `order` INNER JOIN order_product ON`order`.id =order_product.order_id INNER JOIN product ON product.id =order_product.product_id WHERE order.user_email='" . $_SESSION['email'] . "' AND order.id='".$order_id."' ;");
$d2 = $rs->fetch_assoc();
$html = <<<EOD
    <style>
        .invoice-container {
            width: 100%;
            padding: 20px;
            font-family: Arial, sans-serif;
        }
        .header {
            display: flex;
            align-items: center;
        }
        .header img {
            width: 100px;
            height: auto;
        }
        .header .company-name {
            margin-left: 20px;
            font-size: 24px;
            font-weight: bold;
        }
        .invoice-details, .customer-details {
            margin-top: 20px;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .invoice-table th, .invoice-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .invoice-table th {
            background-color: #f2f2f2;
            text-align: left;
        }
        .total {
            font-weight: bold;
            text-align: right;
        }
    </style>
    
    <div class="invoice-container">
        <div class="header">
            <div class="company-name">Invoice</div>
        </div>
    
        <div class="invoice-details">
            <p><strong>Invoice Date:</strong> {$d2['date']}</p>
            <p><strong>Invoice Number:</strong>$order_id</p>
            <p><strong>User Email:</strong>{$_SESSION['email']}</p>
        </div>

    
    
    
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
EOD;

$rs = Database::search("SELECT * FROM `order` INNER JOIN order_product ON`order`.id =order_product.order_id INNER JOIN product ON product.id =order_product.product_id WHERE order.user_email='" . $_SESSION['email'] . "' AND order.id='".$order_id."' ;");
$num = $rs->num_rows;
if ($num >= "1") {
    for ($x = 0; $x < $num; $x++) {
        $d = $rs->fetch_assoc();
        $subtotal=$d['price'] * $d['quantity'];
        $total+=$subtotal;
        $html .= <<<EOD
            <tr>
                <td>{$d['title']} </td>
                <td>{$d['quantity']}</td>
                <td> LKR {$d['price']}</td>
               <td> LKR  $subtotal</td>

            </tr>
EOD;
$total+=$subtotal;
    }
}

$html .= <<<EOD
        
            <tr>
                <td colspan="3" class="total">Total</td>
                <td>LKR $total</td>
            </tr>
            </tbody>
        </table>
    </div>
EOD;


$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();
//Close and output PDF document
$pdf->Output('invoice.pdf', 'I');
