<?php
include 'config.php';

$sql = "SELECT * FROM brands";
$result = $conn->query($sql);

$brands = array();

// if ($result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//         $brands[] = $row;
//     }
// }

if ($result->num_rows > 0) {
    $data = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode(['success' => true, 'brand_Data' => $data]);
} else {
    echo json_encode(['success' => false]);
}


// echo json_encode(array("brands" => $brands));

$conn->close();
?>