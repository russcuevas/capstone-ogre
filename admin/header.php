<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dimasupil's Inventory System</title>
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
        <a href="dashboard.html" style="color:white; margin-left: 10px; margin-top: 10px">Dimasupil's DSS</a>
    </h3>
</div>



<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
    <ul class="nav">
        <li class="dropdown" id="profile-messages">
            <a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i
                    class="icon icon-user"></i> <span class="text">Welcome Admin</span><b class="caret"></b></a>
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
            <a href="add_new_user.php"><i class="icon icon-user"></i><span>Add User</span></a>
        </li>

        <li>
            <a href="add_rice.php"><i class="icon icon-leaf"></i><span>Add Rice</span></a>
            <!-- Replace 'icon-leaf' with the appropriate icon class for Add Rice -->
        </li>

        <li>
            <a href="report.php"><i class="icon icon-bar-chart"></i><span>Reports</span></a>
            <!-- Replace 'icon-bar-chart' with the appropriate icon class for Reports -->
        </li>

        <li>
            <a href="deletion_history.php"><i class="icon icon-bar-chart"></i><span>History</span></a>
            <!-- Replace 'icon-bar-chart' with the appropriate icon class for Reports -->
        </li>
    </ul>
</div>

<!--sidebar-menu-->
<div id="search">
</div>