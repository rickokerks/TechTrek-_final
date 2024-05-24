<?php
    include 'config.php';

    // $data = json_decode(file_get_contents('php://input'), true);
    // $oldData = $data['oldData'];
    // $newData = $data['newData'];
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    $data = $_POST;
    $oldData = json_decode($data['oldData']);
    $newData = json_decode($data['newData']);
    $image = $_FILES['file'];

    // echo json_encode(['oldData' => $oldData, 'newData' => $newData, 'img' => $image]);

    $imageSrc = $image['tmp_name'];
    $originalFileName = $image['name'];
    $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);
    $imageDest = './Images/';
    $randomIMGName = 'productIMG_' . uniqid() . '_' . rand(1000, 9999) . '.' . $extension;
    $imageFullDest = $imageDest . $randomIMGName;


    $sqlEdit = "UPDATE products SET image = '$randomIMGName', name = '$newData[0]', brand_id = '$newData[1]', type = '$newData[2]', quantity = '$newData[3]', price = '$newData[4]' 
    WHERE name = '$oldData[1]' AND type = '$oldData[3]' AND quantity = '$oldData[4]' AND price = '$oldData[5]'";
    
    if ($conn->query($sqlEdit) === TRUE) {
        move_uploaded_file($imageSrc, $imageFullDest);
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }

?>