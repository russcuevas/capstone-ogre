<?php
include "../user/connection.php";

if (isset($_GET["id"])) {
    $product_id = $_GET["id"];

    // Delete the entry from the deletion history table
    mysqli_query($link, "DELETE FROM rice_deletion_history WHERE product_id=$product_id");

    // Provide some feedback or log the deletion if needed
    echo "Data deleted from history successfully!";
}
?>
