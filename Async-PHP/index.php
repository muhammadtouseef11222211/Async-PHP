<?php include "router_links/links.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Router Example</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <?php include "css/style.php"; ?>

</head>
<body>
    <!-- Sidebar Navigation -->
    <div class="sidebar" id="sidebar">

<button id="toggleSidebar" style="margin-bottom: 30px; position: relative; margin-left: 50px; width: 40px; height: 40px; border: none; border-radius: 50%; background-color: green; cursor: pointer;"><span style="position: absolute; top: -20px; left: -20px; width: 80px; height: 80px; border-radius: 50%; background-color: rgba(0, 123, 255, 0.5); animation: wave 1.5s infinite; opacity: 0;"></span></button><style>@keyframes wave { 0% { transform: scale(0); opacity: 1; } 100% { transform: scale(1); opacity: 0; } }</style>



<ul class="nav flex-column">
            <?php foreach ($pageNames as $key => $name): ?>
                <li class="nav-item">
                    <a class="nav-link" href="#/<?php echo $key; ?>"><?php echo $name; ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- Main Content Area -->
    <div id="app" class="main-content">

<button id="showSidebar" style="display: none; position: relative; width: 20px; height: 20px; border: none; border-radius: 50%; background-color: green; cursor: pointer;"><span style="position: absolute; top: -10px; left: -10px; width: 40px; height: 40px; border-radius: 50%; background-color: rgba(0, 123, 255, 0.5); animation: wave 1.5s infinite; opacity: 0;"></span></button><style>@keyframes wave { 0% { transform: scale(0); opacity: 1; } 100% { transform: scale(1); opacity: 0; } }</style>



                            <router-view></router-view>
    </div>

    <?php include "js/router_js.php"; ?>
</body>
</html>

