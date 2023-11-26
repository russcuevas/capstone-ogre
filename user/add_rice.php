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
          <form action="" method="post" class="form-horizontal" name="form1">
            <div class="control-group">
              <label class="control-label">Product Name :</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="Product name" name="productname" />
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
                <input type="text" class="span11" placeholder="Rice Code" name="ricecode" required/>
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

            <div class="alert alert-danger" id="error"  style="display:none">
                This product already exists!
            </div>

            <div class="form-actions">
              <button type="submit" name="submit1" class="btn btn-success">Save</button>
            </div>

            <div class="alert alert-success" id="success"  style="display:none">
                Product created successfully!
            </div>


          </form>
        </div>
    </div>

</div>
    </div>
</div>
</div>

<script type="text/javascript">
    function confirmDelete(id) {
        // Display a confirmation dialog
        var result = confirm("Are you sure you want to delete this data?");

        // Check the user's response
        if (result) {
            // User clicked "OK", proceed with deletion
            deleteData(id);
        } else {
            // User clicked "Cancel" or closed the dialog, do nothing
            return;
        }
    }

    function deleteData(id) {
        // Send an AJAX request to delete_user.php with the id parameter
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "delete_rice.php?id=" + id, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                // Handle the response if necessary
                if (xhr.status === 200) {
                    // Request successful, show deletion confirmation
                    alert("Data deleted successfully!");
                } else {
                    // Request failed, show error message if needed
                    alert("Error deleting data");
                }
                // Refresh the page after deletion
                window.location = "add_rice.php";
            }
        };
        xhr.send();
    }
</script>

<?php

    if (isset($_POST["submit1"])){

        $count=0;
        $res = mysqli_query($link, "SELECT * FROM rice_products WHERE product_name=$productname'$_POST[product_name]'");
        $count = mysqli_num_rows($res);

        if($count > 0){

            ?>
            <script type="text/javascript">
                document.getElementById("success").style.display="none";
                document.getElementById("error").style.display="block";
            </script>
            <?php
        }
        else{
            mysqli_query($link, "INSERT INTO rice_products VALUES(NULL,'$_POST[product_name]','$_POST[rice_type]','$_POST[rice_code]','$_POST[rice_grain]')");

            ?>
            <script type="text/javascript">
                document.getElementById("error").style.display="none";
                document.getElementById("success").style.display="block";
                setTimeout(function () {
                    window.location.href = window.location.href;
                },3000);
            </script>
            <?php
        }



    }



?>

<!--end-main-container-part-->
<?php
include "footer.php";
?>
