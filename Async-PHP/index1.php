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
        <h4>Navigation</h4>

        <button id="toggleSidebar" class="btn btn-primary">Toggle Sidebar</button>
        <ul class="nav flex-column">
            <!-- Manual Links -->
            <li class="nav-item">
                <a class="nav-link" href="#/app/index">Index</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#/app/async_calculation.php">Async Calculation</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#/app/100_async_time.php">Insert 100 timestamps</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#/app/run_without_reload.php">Run Without Reload</a>
            </li>
            <li class="nav-item">
                       <div class="dropdown">
                       <button class="dropbtn">Dropdown</button>
                       <div class="dropdown-content">

                    <a class="dropdown-item" href="#/app/insert_user_form_template.php">Insert User</a>
                    <a class="dropdown-item" href="#/app/insert_product_form_template.php">Insert Product</a>
                </div>
                </div>
            </li>
        </ul>
    </div>

    <!-- Main Content Area -->
    <div id="app" class="main-content">
        <button id="showSidebar" class="btn btn-secondary" style="display: none;">Show Sidebar</button>
        <router-view></router-view>
    </div>



<?php include "js/router_js.php"; ?>
</body>
</html>

