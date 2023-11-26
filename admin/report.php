<?php
include "header.php";
include "../user/connection.php";

// Fetch data from the database
$query = "SELECT productname, price FROM rice_products";
$result = mysqli_query($link, $query);

$productNames = [];
$productPrices = [];

while ($row = mysqli_fetch_assoc($result)) {
    $productNames[] = $row['productname'];
    $productPrices[] = $row['price'];
}
?>

<!-- Main Content -->
<div id="content">
    <!-- Your existing content goes here -->

    <!-- Statistical Report -->
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                        <h5>Statistical Report</h5>
                    </div>
                    <div class="widget-content">
                        <?php
                        // Fetch and display statistical information
                        $result = mysqli_query($link, "SELECT SUM(quantity_sold) as total_quantity, AVG(price) as average_price FROM rice_products");
                        $row = mysqli_fetch_assoc($result);

                        echo "<p>Total Quantity Sold: " . $row['total_quantity'] . "</p>";
                        echo "<p>Average Price: ₱" . number_format($row['average_price'], 2) . "</p>"; // Adjusted for Philippine Peso
                        ?>
                        <canvas id="priceChart" width="100px" height="50px"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Price Chart -->


<script>
    var ctx = document.getElementById('priceChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($productNames); ?>,
            datasets: [{
                label: 'Price (₱)', // Adjusted for Philippine Peso
                data: <?php echo json_encode($productPrices); ?>,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<!-- Your existing scripts go here -->

<?php include "footer.php"; ?>
