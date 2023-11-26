<?php
include "header.php";
include "../user/connection.php";

$id = $_GET["id"];
$productname = "";
$ricetype = "";
$ricecode = "";
$rice_grain = "";
$quantity_sold = "";
$price = "";

$res = mysqli_query($link, "SELECT * FROM rice_products WHERE id=$id");
while ($row = mysqli_fetch_array($res)) {
  $productname = $row["productname"];
  $ricetype = $row["ricetype"];
  $ricecode = $row["ricecode"];
  $rice_grain = $row["rice_grain"];
  $quantity_sold = $row["quantity_sold"];
  $price = $row["price"];
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
    <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Edit Rice</h5>
          </div>
          <div class="widget-content nopadding">
            <form action="" method="post" class="form-horizontal" name="form1" enctype="multipart/form-data">
              <div class="control-group">
                <label class="control-label">Product Image:</label>
                <div class="controls">
                  <!-- Input field for file upload -->
                  <input type="file" name="product_image" accept="image/*">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Product Name :</label>
                <div class="controls">
                  <input type="text" class="span11" placeholder="Product Name" name="productname"
                    value="<?php echo $productname; ?>" />
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Rice Type :</label>
                <div class="controls">
                  <input type="text" class="span11" placeholder="Rice Type" name="ricetype"
                    value="<?php echo $ricetype; ?>" />
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Rice Code :</label>
                <div class="controls">
                  <input type="text" class="span11" placeholder="Rice Code" name="ricecode"
                    value="<?php echo $ricecode; ?>" />
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Select Grain :</label>
                <div class="controls">
                  <select name="rice_grain" class="span11">
                    <option <?php if ($rice_grain == "short grain") {
                      echo "selected";
                    } ?>>short grain</option>
                    <option <?php if ($rice_grain == "medium grain") {
                      echo "selected";
                    } ?>>medium grain</option>
                    <option <?php if ($rice_grain == "long grain") {
                      echo "selected";
                    } ?>>long grain</option>
                  </select>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Quantity Sold :</label>
                <div class="controls">
                  <select name="quantity_sold" class="span11">
                    <?php
                    for ($i = 1; $i <= 10; $i++) {
                      echo "<option value='$i' ";
                      if ($quantity_sold == $i)
                        echo "selected";
                      echo ">$i</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Price :</label>
                <div class="controls">
                  <input type="text" class="span11" placeholder="Price" name="price" value="<?php echo $price; ?>" />
                </div>
              </div>

              <div class="form-actions">
                <button type="submit" name="submit1" class="btn btn-success">Update</button>
              </div>

              <div class="alert alert-success" id="success" style="display:none">
                Product updated successfully!
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
if (isset($_POST["submit1"])) {
  $productname = mysqli_real_escape_string($link, $_POST["productname"]);
  $ricetype = mysqli_real_escape_string($link, $_POST["ricetype"]);
  $ricecode = mysqli_real_escape_string($link, $_POST["ricecode"]);
  $rice_grain = mysqli_real_escape_string($link, $_POST["rice_grain"]);
  $quantity_sold = mysqli_real_escape_string($link, $_POST["quantity_sold"]);
  $price = mysqli_real_escape_string($link, $_POST["price"]);

  // Handle file upload
  if ($_FILES['product_image']['error'] == UPLOAD_ERR_OK) {
    $uploadDir = "path/to/upload/directory/";
    $uploadFile = $uploadDir . basename($_FILES['product_image']['name']);

    move_uploaded_file($_FILES['product_image']['tmp_name'], $uploadFile);

    // Update the database with the file path
    mysqli_query($link, "UPDATE rice_products SET product_image='$uploadFile' WHERE id=$id") or die(mysqli_error($link));
  }

  mysqli_query($link, "UPDATE rice_products SET productname='$productname', ricetype='$ricetype', ricecode='$ricecode', rice_grain='$rice_grain', quantity_sold='$quantity_sold', price='$price' WHERE id=$id") or die(mysqli_error($link));
  ?>
  <script type="text/javascript">
    document.getElementById("success").style.display = "block";
    setTimeout(function () {
      window.location = "add_rice.php";
    }, 3000);
  </script>
  <?php
}
?>

<!--end-main-container-part-->
<?php
include "footer.php";
?>