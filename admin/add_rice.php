<?php
include "header.php";
include "../user/connection.php";
?>

<!--main-container-part-->
<div id="content">
  <!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"><a href="demo.php" title="Go to Dashboard" class="tip-bottom"><i class="icon-home"></i>
        Dashboard</a></div>
  </div>
  <!--End-breadcrumbs-->

  <!--Action boxes-->
  <div class="container-fluid">
    <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Add Rice</h5>
          </div>
          <div class="widget-content nopadding">
            <form action="" method="post" class="form-horizontal" name="form1" enctype="multipart/form-data">

              <div class="control-group">
                <label class="control-label">Product Name :</label>
                <div class="controls">
                  <input type="text" class="span11" placeholder="Product name" name="productname" />
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Product Image:</label>
                <div class="controls">
                  <input type="file" name="product_image" class="span11" />
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Rice Type :</label>
                <div class="controls">
                  <input type="text" class="span11" placeholder="Rice Type" name="ricetype" />
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Rice Code</label>
                <div class="controls">
                  <input type="text" class="span11" placeholder="Rice Code" name="ricecode" required />
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Select Rice Grain :</label>
                <div class="controls">
                  <select name="rice_grain" class="span11">
                    <option>short grain</option>
                    <option>medium grain</option>
                    <option>long grain</option>
                  </select>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Quantity Sold :</label>
                <div class="controls">
                  <select name="quantity_sold" class="span11">
                    <?php
                    for ($i = 1; $i <= 10; $i++) {
                      echo "<option>$i</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Price :</label>
                <div class="controls">
                  <input type="text" class="span11" placeholder="Price" name="price" />
                </div>
              </div>

              <div class="alert alert-danger" id="error" style="display:none">
                This product already exists!
              </div>

              <div class="form-actions">
                <button type="submit" name="submit1" class="btn btn-success">Save</button>
              </div>

              <div class="alert alert-success" id="success" style="display:none">
                Product created successfully!
              </div>

            </form>
          </div>
        </div>

        <div class="widget-content nopadding">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Product Image</th>
                <th>Product name</th>
                <th>Rice Type</th>
                <th>Rice Code</th>
                <th>Rice Grain</th>
                <th>Quantity Sold</th>
                <th>Price</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>

              <?php

              $res = mysqli_query($link, "SELECT * FROM rice_products");
              while ($row = mysqli_fetch_array($res)) {
              ?>
                <tr>
                  <td>
                    <?php
                    if ($row["product_image"] !== null && $row["product_image"] !== '') {
                      $imagePath = 'img/products/' . $row["product_image"];
                      echo '<img src="' . $imagePath . '" alt="Product Image" style="max-width: 100px; max-height: 100px;" />';
                    } else {
                      echo 'No Image';
                    }
                    ?>
                  </td>
                  <td>
                    <?php echo $row["productname"]; ?>
                  </td>
                  <td>
                    <?php echo $row["ricetype"]; ?>
                  </td>
                  <td>
                    <?php echo $row["ricecode"]; ?>
                  </td>
                  <td>
                    <?php echo $row["rice_grain"]; ?>
                  </td>
                  <td>
                    <span id="quantity_<?php echo $row["id"]; ?>">
                      <?php echo $row["quantity_sold"]; ?>
                    </span>
                    <button onclick="updateQuantity(<?php echo $row["id"]; ?>, 'increase')">+</button>
                    <button onclick="updateQuantity(<?php echo $row["id"]; ?>, 'decrease')">-</button>
                  </td>
                  <td>
                    <?php echo $row["price"]; ?>
                  </td>
                  <td><a href="edit_rice.php?id=<?php echo $row["id"]; ?>">Edit</a></td>
                  <td><a href="#" onclick="confirmDelete('<?php echo $row["productname"]; ?>')">Delete</a></td>
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
<script type="text/javascript">
  function confirmDelete(productName) {
    // Display a confirmation dialog
    var result = confirm("Are you sure you want to delete the product '" + productName + "'?");

    // Check the user's response
    if (result) {
      // User clicked "OK", proceed with deletion
      deleteData(productName);
    } else {
      // User clicked "Cancel" or closed the dialog, do nothing
      return;
    }
  }

  function updateQuantity(id, action) {
    var quantityElement = document.getElementById('quantity_' + id);
    var currentQuantity = parseInt(quantityElement.textContent);

    if (action === 'increase') {
      currentQuantity++;
    } else if (action === 'decrease' && currentQuantity > 0) {
      currentQuantity--;
    }

    // Update the quantity in the UI
    quantityElement.textContent = currentQuantity;

    // Send an AJAX request to update the quantity in the database
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "update_quantity.php?id=" + id + "&quantity=" + currentQuantity, true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        // Handle the response if necessary
        if (xhr.status !== 200) {
          // Request failed, show error message if needed
          console.error("Error updating quantity");
        }
      }
    };
    xhr.send();
  }

  function deleteData(productName) {
    // Send an AJAX request to delete_rice.php with the productName parameter
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "delete_rice.php?productname=" + encodeURIComponent(productName), true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        // Handle the response if necessary
        if (xhr.status === 200) {
          // Request successful, show deletion confirmation
          alert("Data deleted successfully!");
          // Insert into deletion history
          insertDeletionHistory(productName);
          // Refresh the page after deletion
          window.location = "add_rice.php";
        } else {
          // Request failed, show error message if needed
          alert("Error deleting data");
        }
      }
    };
    xhr.send();
  }

  function insertDeletionHistory(productName) {
    // Send an AJAX request to insert into deletion history
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "insert_deletion_history.php?productname=" + encodeURIComponent(productName), true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        // Handle the response if necessary
        if (xhr.status !== 200) {
          // Request failed, show error message if needed
          console.error("Error inserting into deletion history");
        }
      }
    };
    xhr.send();
  }
</script>

<?php
if (isset($_POST["submit1"])) {
  $count = 0;
  $productname = mysqli_real_escape_string($link, $_POST["productname"]);

  $res = mysqli_query($link, "SELECT * FROM rice_products WHERE productname='$productname'");
  $count = mysqli_num_rows($res);

  if ($count > 0) {
?>
    <script type="text/javascript">
      document.getElementById("success").style.display = "none";
      document.getElementById("error").style.display = "block";
    </script>
  <?php
  } else {
    $productname = mysqli_real_escape_string($link, $_POST["productname"]);
    $ricetype = mysqli_real_escape_string($link, $_POST["ricetype"]);
    $ricecode = mysqli_real_escape_string($link, $_POST["ricecode"]);
    $ricegrain = mysqli_real_escape_string($link, $_POST["rice_grain"]);
    $quantity_sold = mysqli_real_escape_string($link, $_POST["quantity_sold"]);
    $price = mysqli_real_escape_string($link, $_POST["price"]);

    $product_image = '';

    if (!empty($_FILES["product_image"]["name"])) {
      $target_file = "img/products/";
      $move_to_target_file = $image_directory . basename($_FILES["product_image"]["name"]);
      if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $move_to_target_file)) {
        $product_image = mysqli_real_escape_string($link, $_FILES["product_image"]["name"]);
      } else {
        echo "Error moving to file";
        exit;
      }
    }

    $query = "INSERT INTO rice_products (productname, ricetype, ricecode, rice_grain, quantity_sold, price, product_image) 
          VALUES ('$productname', '$ricetype', '$ricecode', '$ricegrain', '$quantity_sold', '$price', '$product_image')";

    mysqli_query($link, $query);

  ?>
    <script type="text/javascript">
      document.getElementById("error").style.display = "none";
      document.getElementById("success").style.display = "block";
      setTimeout(function() {
        window.location.href = window.location.href;
      }, 3000);
    </script>
<?php
  }
  // Handle file upload (move the uploaded file to a directory)
  $target_dir = "your_upload_directory/";
  $target_file = $target_dir . basename($_FILES["product_image"]["name"]);
  move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file);

  // Check if image file is a actual image or fake image
  if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["product_image"]["tmp_name"]);
    if ($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }
  }

  // Check file size
  if ($_FILES["product_image"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }

  // Allow certain file formats
  if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
  ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFile)) {
      echo "The file " . basename($_FILES["product_image"]["name"]) . " has been uploaded.";
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }
}
?>

<!--end-main-container-part-->
<?php
include "footer.php";
?>