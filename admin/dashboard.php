<?php
include "header.php";
include "../user/connection.php";

// Query to get the number of rice products
$result = mysqli_query($link, "SELECT COUNT(*) AS totalProducts FROM rice_products");
$row = mysqli_fetch_assoc($result);
$totalProducts = $row['totalProducts'];

// Query to get other statistics, you can modify this based on your needs
$result = mysqli_query($link, "SELECT COUNT(*) AS totalShortGrain FROM rice_products WHERE rice_grain = 'short grain'");
$row = mysqli_fetch_assoc($result);
$totalShortGrain = $row['totalShortGrain'];

// Fetch the total medium grain count from the database
$resultMediumGrain = mysqli_query($link, "SELECT COUNT(*) as total FROM rice_products WHERE rice_grain = 'medium grain'");
$rowMediumGrain = mysqli_fetch_assoc($resultMediumGrain);
$totalMediumGrain = $rowMediumGrain['total'];

// Fetch the total long grain count from the database
$resultLongGrain = mysqli_query($link, "SELECT COUNT(*) as total FROM rice_products WHERE rice_grain = 'long grain'");
$rowLongGrain = mysqli_fetch_assoc($resultLongGrain);
$totalLongGrain = $rowLongGrain['total'];

// Query to get the top 5 rice products
$resultTopProducts = mysqli_query($link, "SELECT id, productname, rice_grain FROM rice_products ORDER BY id LIMIT 5");
// Extract data for the chart
$productNames = [];
$riceGrains = [];

while ($row = mysqli_fetch_assoc($resultTopProducts)) {
    $productNames[] = $row['productname'];
    $riceGrains[] = $row['rice_grain'];
}

// Query to get the sales record for the month
$resultSales = mysqli_query($link, "SELECT DAY(date) as day, WEEK(date) as week, SUM(quantity_sold) as total_sold FROM sales WHERE MONTH(date) = MONTH(CURRENT_DATE()) GROUP BY day, week ORDER BY day, week");
// Extract data for the chart
$salesDays = [];
$salesWeeks = [];
$salesData = [];

while ($row = mysqli_fetch_assoc($resultSales)) {
    $salesDays[] = $row['day'];
    $salesWeeks[] = $row['week'];
    $salesData[] = $row['total_sold'];
}
?>

<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb">
            <a href="dashboard.php" title="Go to Dashboard" class="tip-bottom"><i class="icon-home"></i> Dashboard</a>
        </div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">
        <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon"><i class="icon-align-justify"></i></span>
                        <h5>Rice Product Statistics</h5>
                    </div>
                    <div class="widget-content nopadding">

                        <div class="row-fluid">

                            <!-- Total Products Card -->
                            <div class="span3">
                                <div class="widget-box">
                                    <div class="widget-title bg_lg"><span class="icon"><i class="icon-th"></i></span>
                                        <h5>Total Products</h5>
                                    </div>
                                    <div class="widget-content">
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <h2><?= $totalProducts ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Short Grain Card -->
                            <div class="span3">
                                <div class="widget-box">
                                    <div class="widget-title bg_ly"><span class="icon"><i class="icon-th"></i></span>
                                        <h5>Total Short Grain</h5>
                                    </div>
                                    <div class="widget-content">
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <h2><?= $totalShortGrain ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Medium Grain Card -->
                            <div class="span3">
                                <div class="widget-box">
                                    <div class="widget-title bg_ly"><span class="icon"><i class="icon-th"></i></span>
                                        <h5>Total Medium Grain</h5>
                                    </div>
                                    <div class="widget-content">
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <h2><?= $totalMediumGrain ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Long Grain Card -->
                            <div class="span3">
                                <div class="widget-box">
                                    <div class="widget-title bg_ly"><span class="icon"><i class="icon-th"></i></span>
                                        <h5>Total Long Grain</h5>
                                    </div>
                                    <div class="widget-content">
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <h2><?= $totalLongGrain ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bar Chart -->
            <div class="span6">
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon"><i class="icon-signal"></i></span>
                        <h5>Rice Grains of Top 5 Products</h5>
                    </div>
                    <div class="widget-content">
                        <canvas id="bar-chart" width="100px" height="50px"></canvas>
                    </div>

                    <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon"><i class="icon-signal"></i></span>
                        <h5>Sales Record for the Month</h5>
                    </div>
                    <div class="widget-content">
                        <canvas id="sales-chart" width="100px" height="50p"></canvas>
                    </div>
                </div>

                </div>
            </div>
        </div>
    </div>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Chart.js script for creating a bar chart
    var ctx = document.getElementById('bar-chart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($productNames) ?>,
            datasets: [{
                label: 'Rice Grains',
                data: <?= json_encode($riceGrains) ?>,
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

     // Chart.js script for creating a bar chart for sales
     var ctxSales = document.getElementById('sales-chart').getContext('2d');
    var myChartSales = new Chart(ctxSales, {
        type: 'bar',
        data: {
            labels: <?= json_encode($salesDays) ?>, // Days of the month
            datasets: [{
                label: 'Total Sold',
                data: <?= json_encode($salesData) ?>, // Sales data for each day
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


<!--end-main-container-part-->
<?php
include "footer.php";
?>
