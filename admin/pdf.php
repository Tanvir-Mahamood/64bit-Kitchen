<?php
define('FPDF_FONTPATH', __DIR__ . '/fpdf/font/');
require('fpdf/fpdf.php');

// require('fpdf/fpdf.php');
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
    exit();
}

// Initialize an array to store user inputs
$conditions = [];
$params = [];

// Collect form inputs and add to conditions if not empty
if (!empty($_GET['user_id'])) {
    $conditions[] = "user_id = :user_id";
    $params[':user_id'] = $_GET['user_id'];
}
if (!empty($_GET['name'])) {
    $conditions[] = "name LIKE :name";
    $params[':name'] = "%" . $_GET['name'] . "%";
}
if (!empty($_GET['email'])) {
    $conditions[] = "email LIKE :email";
    $params[':email'] = "%" . $_GET['email'] . "%";
}
if (!empty($_GET['number'])) {
    $conditions[] = "number = :number";
    $params[':number'] = $_GET['number'];
}
if (!empty($_GET['method'])) {
    $conditions[] = "method = :method";
    $params[':method'] = $_GET['method'];
}
if (!empty($_GET['payment_status'])) {
    $conditions[] = "payment_status = :payment_status";
    $params[':payment_status'] = $_GET['payment_status'];
}
if (!empty($_GET['price_min']) && !empty($_GET['price_max'])) {
    $conditions[] = "total_price BETWEEN :price_min AND :price_max";
    $params[':price_min'] = $_GET['price_min'];
    $params[':price_max'] = $_GET['price_max'];
}
if (!empty($_GET['order_date_start']) && !empty($_GET['order_date_end'])) {
    $conditions[] = "placed_on BETWEEN :order_date_start AND :order_date_end";
    $params[':order_date_start'] = $_GET['order_date_start'];
    $params[':order_date_end'] = $_GET['order_date_end'];
}

// Build the SQL query dynamically
$query = "SELECT * FROM orders";
if (!empty($conditions)) {
    $query .= " WHERE " . implode(" AND ", $conditions);
}

// Execute the query
$stmt = $conn->prepare($query);
$stmt->execute($params);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Generate PDF using FPDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 8);

// Introduction
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, '64bit Kitchen', 0, 1, 'C'); // Centered company name
$pdf->Ln(5); // Line break
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Order Query Report', 0, 1, 'C'); // Centered heading
$pdf->Ln(10); // Line break

// Add Query Operation Time
$pdf->SetFont('Arial', '', 10);
$currentDateTime = date('Y-m-d H:i:s'); // Current time
$pdf->Cell(0, 10, 'Generated on: ' . $currentDateTime, 0, 1, 'L'); // Align left
$pdf->Ln(5); // Line break

// Add table headers
$pdf->Cell(15, 10, 'Order ID', 1);
$pdf->Cell(15, 10, 'User ID', 1);
$pdf->Cell(20, 10, 'Name', 1);
$pdf->Cell(25, 10, 'Phone', 1);
$pdf->Cell(40, 10, 'Email', 1);
$pdf->Cell(15, 10, 'Price', 1);
$pdf->Cell(40, 10, 'Order Date', 1);
$pdf->Cell(20, 10, 'Status', 1);
$pdf->Ln();

$total_sum = 0;

// Add table data
if ($results) {
    foreach ($results as $row) {
        $pdf->Cell(15, 10, $row['id'], 1);
        $pdf->Cell(15, 10, $row['user_id'], 1);
        $pdf->Cell(20, 10, $row['name'], 1);
        $pdf->Cell(25, 10, $row['number'], 1);
        $pdf->Cell(40, 10, $row['email'], 1);
        $pdf->Cell(15, 10, $row['total_price'], 1);
        $pdf->Cell(40, 10, $row['placed_on'], 1);
        $pdf->Cell(20, 10, $row['payment_status'], 1);

        if($row['payment_status'] == 'completed') $total_sum += $row['total_price'];

        $pdf->Ln();
    }
} else {
    $pdf->Cell(0, 10, 'No results found', 1, 1, 'C');
}

// In total
$pdf->Ln(10); // Space after the table
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 10, 'Total Price: '.$total_sum, 0, 1, 'L'); // Total Cost

// signature box
$pdf->Ln(10); // Space after the table
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 10, 'Authorized Signature:', 0, 1, 'L'); // Label for signature
$pdf->Ln(5); // Line break for spacing
$pdf->Rect(10, $pdf->GetY(), 60, 20); // Draw a rectangle for the signature box


// Output the PDF to download
$pdf->Output('D', 'order_results.pdf');
exit();
