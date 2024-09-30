<?php
$pagePaths = [
    'index' => 'index.php',
    'async_calculation.php' => 'async_calculation.php',
    '100_async_time.php' => '100_async_time.php',
    'insert_product_form_template.php' => 'insert_product_form_template.php',
    'insert_user_form_template.php' => 'insert_user_form_template.php',
    'run_without_reload.php' => 'run_without_reload.php',
    'test' => 'sidebar_left.php',
    // Add more pages here as needed
];

$pageNames = [
    'index' => 'Index',
    'async_calculation.php' => 'Async Calculation',
    '100_async_time.php' => 'Insert 100 timestamps',
    'run_without_reload.php' => 'Run Without Reload',
    'insert_product_form_template.php' => 'insert_product_form_template.php',
    'insert_user_form_template.php' => 'insert_user_form_template.php',
    'test' => 'Test',
    // Add more names here as needed
];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Router Example</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
        }
        .sidebar {
            width: 200px;
            height: 100vh;
            background-color: #f8f9fa;
            padding: 15px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }
        .main-content {
            flex-grow: 1;
            padding: 20px;
        }
    </style>
</head>
<body>
    <!-- Sidebar Navigation -->
    <div class="sidebar">
        <h4>Navigation</h4>
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
        <router-view></router-view>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-router@3"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        // Function to create dynamic components for Vue Router
        function createComponent(path) {
            return {
                template: `<div id="${path}-content"></div>`,
                mounted() {
                    this.loadContent();
                },
                methods: {
                    loadContent() {
                        const paths = <?php echo json_encode($pagePaths); ?>; 
                        const currentPath = paths[this.$route.path.substring(1)] || paths['index']; 

                        fetch(currentPath)
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok ' + response.statusText);
                                }
                                return response.text();
                            })
                            .then(data => {
                                document.getElementById(`${path}-content`).innerHTML = data;
                            })
                            .catch(err => {
                                console.error(`Error fetching ${path}:`, err);
                                document.getElementById(`${path}-content`).innerHTML = 'Error fetching content.';
                            });
                    }
                }
            };
        }

        // Create the router dynamically
        const routes = Object.keys(<?php echo json_encode($pagePaths); ?>).map(key => ({
            path: `/${key}`,
            component: createComponent(key)
        }));

        const router = new VueRouter({
            mode: 'hash',
            routes
        });

        // Create the main Vue instance
        const app = new Vue({
            el: '#app',
            router,
            mounted() {
                this.initGlobalEvents();
            },
            methods: {
                initGlobalEvents() {
                    // Global event delegation for form submissions and button clicks
                    document.addEventListener('click', (e) => {
                        if (e.target.matches('.runScripts')) {
                            e.preventDefault();
                            const url = e.target.getAttribute('data-url');
                            
                            if (e.target.closest('form')) {
                                const form = e.target.closest('form');
                                const formData = new FormData(form);
                                
                                axios.post(url, formData)
                                    .then(response => {
                                        document.getElementById('output').innerHTML = response.data;
                                    })
                                    .catch(err => {
                                        document.getElementById('output').innerHTML = 'Error: ' + err.message;
                                    });
                            } else {
                                axios.post(url)
                                    .then(response => {
                                        document.getElementById('output').innerHTML = response.data;
                                    })
                                    .catch(err => {
                                        document.getElementById('output').innerHTML = 'Error: ' + err.message;
                                    });
                            }
                        }
                    });

                    // Global event for form submissions
                    document.addEventListener('submit', (e) => {
                        if (e.target.matches('form')) {
                            e.preventDefault();
                            const url = e.target.querySelector('.runScripts').getAttribute('data-url');
                            const formData = new FormData(e.target);
                            
                            axios.post(url, formData)
                                .then(response => {
                                    document.getElementById('output').innerHTML = response.data;
                                })
                                .catch(err => {
                                    document.getElementById('output').innerHTML = 'Error: ' + err.message;
                                });
                        }
                    });
                }
            }
        });
    </script>
</body>
</html>

