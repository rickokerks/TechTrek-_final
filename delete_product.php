<?php
    include 'config.php';

    $data = json_decode(file_get_contents('php://input'), true);
    $dataRow = $data['data'];
    // echo json_encode($dataRow);

    //we will receive array of array of cells
    //we will iterate over the array to delete them one by one
    //We will have a voolean to at contain the status of true if at least one row has been deleted

    $success = false;
    $path = './Images/';

    foreach ($dataRow as $value) {
        $sqlgetProduct = "SELECT image FROM products WHERE name = '{$value[1]}'  AND type = '{$value[3]}' AND quantity = '{$value[4]}' AND price = '{$value[5]}'";
        $result = $conn->query($sqlgetProduct);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $pathx = $path . $row['image'];
            if(file_exists($pathx)) {
                unlink($pathx);
            } 
            $sql = "DELETE FROM products WHERE name = '{$value[1]}' AND type = '{$value[3]}' AND quantity = '{$value[4]}' AND price = '{$value[5]}'";
            if ($conn->query($sql)) {
                $success = true;
            } 
        } 
    }

    echo json_encode(['success' => $success]);
?>