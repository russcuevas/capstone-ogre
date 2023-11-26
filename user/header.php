<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dimasupil's Rice Inventory System</title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css"/>
    <link rel="stylesheet" href="css/fullcalendar.css"/>
    <link rel="stylesheet" href="css/matrix-style.css"/>
    <link rel="stylesheet" href="css/matrix-media.css"/>
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet"/>
    <link rel="stylesheet" href="css/jquery.gritter.css"/>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
<body>


<div id="header">

    <h3 style="color: white;position: absolute">
        <a href="dashboard.php" style="color:white; margin-left: 20px; margin-top: 40px">Dimasupil's IS</a>
    </h3>
</div>



<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
    <ul class="nav">
        <li class="dropdown" id="profile-messages">
            <a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i
                    class="icon icon-user"></i> <span class="text">Welcome User</span><b class="caret"></b></a>
            <ul class="dropdown-menu">               
                <li><a href="logout.php"><i class="icon-key"></i> Log Out</a></li>
            </ul>
        </li>


    </ul>
</div>

<!--sidebar-menu-->
<div id="sidebar">
    <ul>
        <li class="active">
            <a href="dashboard.php"><i class="icon icon-home"></i><span>Dashboard</span></a>
        </li>

        <li>
            <a href="add_rice.php"><i class="icon icon-home"></i><span>Add Product</span></a>
        </li>

        <li>
            <a href="#"><i class="icon icon-home"></i><span>View Logs</span></a>
        </li>

        <li>
            <a href="#"><i class="icon icon-home"></i><span>Reports</span></a>
        </li>

        

    </ul>
</div>
<!--sidebar-menu-->
<div id="search">

        <a href="logout.php" style="color:white"><i class="icon icon-share-alt"></i><span>LogOut</span></a>

</div>