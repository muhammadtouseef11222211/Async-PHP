<?php
// index.php

// Include the hash router macro
include 'lib/macro/macro_router.php'; // Adjust the path if necessary

// Define navigation items with labels and URLs
$navItems = [
    '/' => ['label' => 'Home', 'url' => '/app/index.php'],
    '/async_calculation' => ['label' => 'Async Calculation', 'url' => '/app/async_calculation.php'],
    '/insert_user' => ['label' => 'Insert User', 'url' => '/app/insert_user_form_template.php'],
    '/insert_product' => ['label' => 'Insert Product', 'url' => '/app/insert_product_form_template.php'],
    '/Index' => ['label' => 'Index', 'url' => '/app/index.php'],
    '/no_reload' => ['label' => 'No Reload', 'url' => '/app/run_without_reload.php'],
    '/test' => ['label' => 'Test', 'url' => '/app/test.php']
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hash Router Example with Bootstrap</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS for the sidebar layout */
        body {
            display: flex;
        }
        .sidebar {
            position: fixed;
            right: 0;
            top: 0;
            bottom: 0;
            width: 250px;
            padding: 20px;
            background-color: #f8f9fa; /* Light gray background */
            border-left: 1px solid #dee2e6; /* Light border */
            box-shadow: -2px 0 5px rgba(0,0,0,.1); /* Slight shadow */
        }
        .content {
            flex-grow: 1;
            padding: 20px;
            margin-right: 250px; /* Space for sidebar */
        }
        .nav-link {
            display: block;
            margin: 10px 0;
        }
        .nav-link.active {
            font-weight: bold;
            color: #000;
        }
    </style>
</head>
<body>
    <!-- Main content area -->
    <div class="content">
        <!-- Render dynamic content from the router macro -->
        <?php renderDynamicContent($navItems); ?>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4>Navigation</h4>
        <ul class="nav flex-column">
            <?php foreach ($navItems as $hash => $item): ?>
                <li class="nav-item">
                    <a class="nav-link" href="#<?= $hash ?>"><?= $item['label'] ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- Include Bootstrap JS and dependencies (Optional, for features like modals, dropdowns, etc.) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Additional custom JS (if needed)
        document.addEventListener('DOMContentLoaded', () => {
            // Add 'active' class to the active nav link
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    navLinks.forEach(link => link.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });
    </script>
</body>
</html>
