<?php
    include 'config.php';

    $sqlGetData = "SELECT products.name, products.type, products.quantity, products.price, products.image, brands.brand_name FROM products
                    LEFT JOIN brands ON products.brand_id = brands.brand_id";
    $dataSQL = $conn->query($sqlGetData);
    if ($dataSQL->num_rows > 0) {
        $data = $dataSQL->fetch_all(MYSQLI_ASSOC);
        echo json_encode(['success' => true, 'productData' => $data]);
    } else {
        echo json_encode(['success' => false]);
    }
?>