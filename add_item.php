<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_name = mysqli_real_escape_string($conn, $_POST['item_name']);

    $query = "INSERT INTO items (name) VALUES ('$item_name')";
    if (mysqli_query($conn, $query)) {
        $item_id = mysqli_insert_id($conn);
        echo json_encode(["success" => true, "id" => $item_id, "name" => $item_name]);
    } else {
        echo json_encode(["success" => false]);
    }
}
?>
