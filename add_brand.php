<?php
include 'config.php';

// Add Brand
if (isset($_POST['addBrand'])) {
    $brandName = $_POST['brandName'];
    $sql = "INSERT INTO brands (name) VALUES ('$brandName')";
    if ($conn->query($sql) === TRUE) {
        echo "Brand added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch Brands
$sql = "SELECT * FROM brands";
$result = $conn->query($sql);
$brands = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $brands[] = $row;
    }
}

// Delete Brand
if (isset($_POST['deleteBrand'])) {
    $brandId = $_POST['brandId'];
    $sql = "DELETE FROM brands WHERE id = $brandId";
    if ($conn->query($sql) === TRUE) {
        echo "Brand deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>