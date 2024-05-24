<?php
include 'config.php';

$productId = $_GET['id'];

$sql = "SELECT * FROM products WHERE id = $productId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo json_encode(['error' => 'Product not found']);
}

$conn->close();
?>