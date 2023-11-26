<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login Page</title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="user/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="user/css/bootstrap-responsive.min.css"/>
    <link rel="stylesheet" href="user/css/matrix-login.css"/>

    <style>
        #wrapper {
            text-align: center;
        }

        .panel-option {
            display: inline-block;
            vertical-align: top;
            border: 1px solid green;
            border-radius: 10px;
            height: 70px;
            width: 200px;
            font-size: large;
            color: white;
            padding-top: 40px;
            cursor: pointer;
            margin-right: 10px; /* Add margin for better separation */
        }

        .user-panel {
            background-color: lightblue;
        }

        .admin-panel {
            background-color: orange;
        }
    </style>
</head>
<body>

<div id="wrapper">
    <div class="panel-option user-panel" onclick="window.location='user/index.php'">User Panel</div>
    <div class="panel-option admin-panel" onclick="window.location='admin/index.php'">Admin Panel</div>
</div>
</body>
</html>