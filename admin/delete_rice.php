<?php
include "../user/connection.php";

if (isset($_GET['productname'])) {
    $productName = mysqli_real_escape_string($link, $_GET['productname']);

    // Fetch details of the deleted record
    $selectQuery = "SELECT * FROM rice_products WHERE productname = '$productName'";
    $result = mysqli_query($link, $selectQuery);

    if ($row = mysqli_fetch_assoc($result)) {
        // Delete the product from the rice_products table
        $deleteQuery = "DELETE FROM rice_products WHERE productname = '$productName'";
        mysqli_query($link, $deleteQuery);

        // Insert the record into the deletion history table
        $insertQuery = "INSERT INTO deletion_history (productname) VALUES ('$productName')";
        mysqli_query($link, $insertQuery);

        // Send a response (you can handle it better based on your needs)
        echo "Deletion successful!";
    } else {
        echo "Record not found!";
    }
} else {
    echo "Invalid request!";
}
?>
