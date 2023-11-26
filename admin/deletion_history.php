<?php
include "header.php";
include "../user/connection.php";

// Restore action
if (isset($_GET['action']) && $_GET['action'] === 'restore' && isset($_GET['id'])) {
    $id = mysqli_real_escape_string($link, $_GET['id']);

    // Fetch data from deletion_history
    $historyQuery = "SELECT * FROM deletion_history WHERE id = $id";
    $historyResult = mysqli_query($link, $historyQuery);

    if ($historyResult && $row = mysqli_fetch_assoc($historyResult)) {
        // Insert the data back into rice_products
        $insertQuery = "INSERT INTO rice_products (productname, ricetype, ricecode, rice_grain, quantity_sold, price) 
                        VALUES ('{$row['productname']}', '{$row['ricetype']}', '{$row['ricecode']}', '{$row['rice_grain']}', 
                                '{$row['quantity_sold']}', '{$row['price']}')";
        mysqli_query($link, $insertQuery);

        // Delete the record from deletion_history after restoration
        $deleteQuery = "DELETE FROM deletion_history WHERE id = $id";
        mysqli_query($link, $deleteQuery);
    }
}

// Delete action
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = mysqli_real_escape_string($link, $_GET['id']);

    // Delete the record from deletion history
    $deleteQuery = "DELETE FROM deletion_history WHERE id = '$id'";
    mysqli_query($link, $deleteQuery);

    // Redirect back to deletion history
    header("Location: deletion_history.php");
    exit();
}
?>

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"><a href="demo.php" title="Go to Dashboard" class="tip-bottom"><i class="icon-home"></i>
                Dashboard</a></div>
    </div>

    <div class="container-fluid">
        <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Deletion History</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Deleted At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $res = mysqli_query($link, "SELECT * FROM deletion_history");
                                while ($row = mysqli_fetch_array($res)) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $row["productname"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $row["deleted_at"]; ?>
                                        </td>
                                        <td>
                                            <a
                                                href="deletion_history.php?action=restore&id=<?php echo $row['id']; ?>">Restore</a>
                                            <a
                                                href="deletion_history.php?action=delete&id=<?php echo $row['id']; ?>">Delete</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include "footer.php";
?>