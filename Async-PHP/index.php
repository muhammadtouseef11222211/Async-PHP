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
            <?php foreach ($pageNames as $key => $name): ?>
                <li class="nav-item">
                    <a class="nav-link" href="#/<?php echo $key; ?>"><?php echo $name; ?></a>
                </li>
            <?php endforeach; ?>
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

