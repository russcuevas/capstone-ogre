<?php
include "../user/connection.php";

if (isset($_GET["id"])) {
    $id = mysqli_real_escape_string($link, $_GET["id"]);
    
    // Insert into deletion history
    mysqli_query($link, "INSERT INTO rice_deletion_history (product_id) VALUES ($id)");
}
