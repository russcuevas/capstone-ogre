<?php
include "../user/connection.php";

if (isset($_GET["id"])) {
    $product_id = $_GET["id"];

    // Fetch data from deletion history
    $result = mysqli_query($link, "SELECT * FROM rice_deletion_history WHERE product_id=$product_id");
    $row = mysqli_fetch_assoc($result);

    // Insert data back into the rice_products table
    mysqli_query($link, "INSERT INTO rice_products SELECT * FROM rice_deletion_history WHERE product_id=$product_id");

    // Delete the entry from the deletion history table
    mysqli_query($link, "DELETE FROM rice_deletion_history WHERE product_id=$product_id");

    // Provide some feedback or log the restoration if needed
    echo "Data restored successfully!";
}
?>
