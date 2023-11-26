<?php
include "../user/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"]) && isset($_POST["action"])) {
    $id = mysqli_real_escape_string($link, $_POST["id"]);
    $action = $_POST["action"];

    // Fetch the current quantity from the database
    $result = mysqli_query($link, "SELECT quantity_sold FROM rice_products WHERE id='$id'");
    $row = mysqli_fetch_assoc($result);
    $currentQuantity = $row["quantity_sold"];

    // Update the quantity based on the action
    if ($action === 'increase') {
        $newQuantity = $currentQuantity + 1;
    } elseif ($action === 'decrease' && $currentQuantity > 0) {
        $newQuantity = $currentQuantity - 1;
    } else {
        // Invalid action or trying to decrease when quantity is already 0
        echo $currentQuantity;
        exit();
    }

    // Update the quantity in the database
    mysqli_query($link, "UPDATE rice_products SET quantity_sold='$newQuantity' WHERE id='$id'");

    // Return the updated quantity
    echo $newQuantity;
} else {
    // Invalid request
    echo "Invalid request";
}
?>
