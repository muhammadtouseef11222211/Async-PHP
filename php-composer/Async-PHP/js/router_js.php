    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-router@3"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> 
    <script>
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
        const routes = Object.keys(<?php echo json_encode($pagePaths); ?>).map(key => ({
            path: `/${key}`,
            component: createComponent(key)
        }));
        const router = new VueRouter({
            mode: 'hash',
            routes
        });
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

<script>
        // JavaScript for sidebar toggle
        const toggleButton = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('app');
        const showSidebarButton = document.getElementById('showSidebar');

        toggleButton.addEventListener('click', function() {
            sidebar.classList.toggle('hidden'); // Hide/Show sidebar
            mainContent.classList.toggle('shifted'); // Shift main content

            // Show or hide the "Show Sidebar" button
            if (sidebar.classList.contains('hidden')) {
                showSidebarButton.style.display = 'block'; // Show button to bring back sidebar
            } else {
                showSidebarButton.style.display = 'none'; // Hide the button if sidebar is visible
            }
        });

        showSidebarButton.addEventListener('click', function() {
            sidebar.classList.remove('hidden'); // Show sidebar
            mainContent.classList.remove('shifted'); // Reset main content position
            showSidebarButton.style.display = 'none'; // Hide the button
        });
    </script>


