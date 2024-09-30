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
    <title>Combined Router Example</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS for the sidebar layout */
        body {
            display: flex;
        }
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            width: 250px;
            padding: 20px;
            background-color: #f8f9fa; /* Light gray background */
            border-right: 1px solid #dee2e6; /* Light border on the right */
            box-shadow: 2px 0 5px rgba(0,0,0,.1); /* Slight shadow */
        }
        .content {
            flex-grow: 1;
            padding: 20px;
            margin-left: 250px; /* Space for sidebar on the left */
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

    <!-- Main content area -->
    <div id="app" class="content">
        <!-- Vue Router's <router-view> for dynamic content rendering -->
        <router-view></router-view>
    </div>

    <!-- Include Vue.js and Vue Router -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-router@3"></script>

    <!-- JavaScript to handle Hash-based and Vue Router-based navigation -->
    <script>
        // PHP page paths array
        const pagePaths = <?php echo json_encode($navItems); ?>;

        // Vue component creation function for async hits
        function createComponent(path) {
            return {
                template: `<div id="${path}-content"></div>`,
                mounted() {
                    this.loadContent();
                },
                methods: {
                    loadContent() {
                        const currentPath = pagePaths[this.$route.path]?.url || pagePaths['/'].url;

                        fetch(currentPath) // Fetch dynamic content from the backend
                            .then(response => response.text())
                            .then(data => {
                                document.getElementById(`${path}-content`).innerHTML = data;
                            })
                            .catch(err => {
                                document.getElementById(`${path}-content`).innerHTML = 'Error fetching content.';
                            });
                    }
                }
            };
        }

        // Create Vue Router routes dynamically from pagePaths
        const routes = Object.keys(pagePaths).map(key => ({
            path: key,
            component: createComponent(key)
        }));

        // Create the Vue Router instance
        const router = new VueRouter({
            mode: 'hash', // Use hash mode for routing
            routes
        });

        // Create the Vue instance
        new Vue({
            el: '#app',
            router
        });

        // Add hash-based navigation handling for non-async hits
        document.addEventListener('DOMContentLoaded', () => {
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    const hash = this.getAttribute('href').substring(1);
                    
                    // Check if it's a Vue async route or hash-based route
                    if (router.resolve(hash).route.matched.length > 0) {
                        // It's a Vue async route, use Vue Router for navigation
                        router.push(hash);
                    } else {
                        // It's a hash-based route, navigate manually
                        window.location.hash = hash;
                        fetchContent(hash);
                    }
                });
            });
            
            // Function to fetch content for hash-based routes
            function fetchContent(hash) {
                const path = pagePaths[hash]?.url || pagePaths['/'].url;
                if (path) {
                    fetch(path)
                        .then(response => response.text())
                        .then(data => {
                            document.getElementById('app').innerHTML = data;
                        })
                        .catch(err => {
                            document.getElementById('app').innerHTML = 'Error fetching content.';
                        });
                }
            }
        });
    </script>
</body>
</html>
