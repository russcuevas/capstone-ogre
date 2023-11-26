<?php
include "header.php";
$link=mysqli_connect("localhost", "root", "");
mysqli_select_db($link,"chart_db");

$test=array();
$count=0;

$res=mysqli_query($link,"SELECT * FROM chart01");
while($row=mysqli_fetch_array($res)){
    $test[$count]["label"]=$row["Label"];
    $test[$count]["y"]=$row["Amount"];
    $count=$count+1;
}


?>
<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"><a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
            Home</a></div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">

    <!DOCTYPE HTML>
<html>
<head>  
<div class="charts">


<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "dark1", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Top 5 Best selling rice"
	},
	axisY:{
		includeZero: true
	},
	data: [{
		type: "column", //change type to bar, line, area, pie, etc
		//indexLabel: "{y}", //Shows y value on all Data Points
		indexLabelFontColor: "#5A5757",
		indexLabelPlacement: "outside",   
		dataPoints: <?php echo json_encode($test, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html>    


    </div>
</div>

<!--end-main-container-part-->
<?php
include "footer.php";
?>
