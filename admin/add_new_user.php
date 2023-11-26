<?php
include "header.php";
include "../user/connection.php";
?>
<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"><a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
            Add new User</a></div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">

        <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
        <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Add User</h5>
        </div>
        <div class="widget-content nopadding">
          <form action="" method="post" class="form-horizontal" name="form1">
            <div class="control-group">
              <label class="control-label">First Name :</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="First name" name="firstname" />
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label">Last Name :</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="Last name" name="lastname" />
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Username :</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="Username" name="username" required/>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Password :</label>
              <div class="controls">
                <input type="password"  class="span11" placeholder="Password" name="password" required/>
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label">Select Role :</label>
              <div class="controls">
                <select name="role" class="span11">
                    <option>user</option>
                    <option>admin</option>
                </select>             
              </div>
            </div>

            <div class="alert alert-danger" id="error"  style="display:none">
                This username already exists!
            </div>

            <div class="form-actions">
              <button type="submit" name="submit1" class="btn btn-success">Save</button>
            </div>

            <div class="alert alert-success" id="success"  style="display:none">
                User created successfully!
            </div>


          </form>
        </div>
    </div>

    <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Firstname</th>
                  <th>Lastname</th>
                  <th>Username</th>
                  <th>Role</th>
                  <th>Status</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                
                <?php

                    $res = mysqli_query($link, "SELECT * FROM user_reg");
                    while ($row = mysqli_fetch_array($res))
                    {
                        ?>
                        <tr>
                        <td><?php echo $row["firstname"];?></td>
                        <td><?php echo $row["lastname"];?></td>
                        <td><?php echo $row["username"];?></td>
                        <td><?php echo $row["role"];?></td>
                        <td><?php echo $row["status"];?></td>
                        <td><a href="edit_user.php?id=<?php echo $row["id"];?>">Edit</a></td>
                        <td><a href="#" onclick="confirmDelete(<?php echo $row["id"]; ?>)">Delete</a></td>
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
        xhr.open("GET", "delete_user.php?id=" + id, true);
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
                window.location = "add_new_user.php";
            }
        };
        xhr.send();
    }
</script>

<?php

    if (isset($_POST["submit1"])){

        $count=0;
        $res = mysqli_query($link, "SELECT * FROM user_reg WHERE username=$username'$_POST[username]'");
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
            mysqli_query($link, "INSERT INTO user_reg VALUES(NULL,'$_POST[firstname]','$_POST[lastname]','$_POST[username]','$_POST[password]','$_POST[role]','active')");

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
