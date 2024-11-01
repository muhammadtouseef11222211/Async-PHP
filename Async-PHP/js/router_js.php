<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
<script src="https://cdn.jsdelivr.net/npm/vue-router@3"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js'></script>
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
                            document.getElementById(`${path}-content`).innerHTML = 'Check Connectivity/File';
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
                // Global event delegation for button clicks
                document.addEventListener('click', (e) => {
                    if (e.target.matches('.runScripts')) {
                        e.preventDefault();
                        const url = e.target.getAttribute('data-url');
                        const outputDivId = url.split(':')[1] || 'output'; // Default to 'output' if not specified

                        if (e.target.closest('form')) {
                            const form = e.target.closest('form');
                            const formData = new FormData(form);

                            axios.post(url.split(':')[0], formData) // Use the base URL
                                .then(response => {
                                    document.getElementById(outputDivId).innerHTML = response.data;
                                })
                                .catch(err => {
                                    document.getElementById(outputDivId).innerHTML = 'Error: ' + err.message;
                                });
                        } else {
                            axios.post(url.split(':')[0]) // Use the base URL
                                .then(response => {
                                    document.getElementById(outputDivId).innerHTML = response.data;
                                })
                                .catch(err => {
                                    document.getElementById(outputDivId).innerHTML = 'Error: ' + err.message;
                                });
                        }
                    }
                });

                // Global event for form submissions
                document.addEventListener('submit', (e) => {
                    if (e.target.matches('form')) {
                        e.preventDefault();
                        const url = e.target.querySelector('.runScripts').getAttribute('data-url');
                        const outputDivId = url.split(':')[1] || 'output'; // Default to 'output' if not specified
                        const formData = new FormData(e.target);

                        axios.post(url.split(':')[0], formData) // Use the base URL
                            .then(response => {
                                document.getElementById(outputDivId).innerHTML = response.data;
                            })
                            .catch(err => {
                                document.getElementById(outputDivId).innerHTML = 'Error: ' + err.message;
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


// Function to execute when the class is detected
function runWhenClassLoaded() {
    console.log('Class detected! Running your code...');

    // Find the button with the target class
    const button = document.querySelector('.key.btn.btn-light.mb-3.runScripts');

    if (button) {
        // Trigger a click on the button
        button.click();
    } else {
        console.warn('Button not found!');
    }
}

// Class to watch for
const targetClass = 'key';

// Create a MutationObserver to monitor the DOM
const observer = new MutationObserver((mutations) => {
    mutations.forEach((mutation) => {
        if (mutation.addedNodes.length) {
            mutation.addedNodes.forEach((node) => {
                // Check if the node has the target class
                if (node.nodeType === 1 && node.classList.contains(targetClass)) {
                    runWhenClassLoaded();
                    // Stop observing after the class is detected
                    observer.disconnect();

                    // Run the code every 5 seconds
                    setInterval(runWhenClassLoaded, 5000);
                }
            });
        }
    });
});

// Start observing the document body for child node additions
observer.observe(document.body, { childList: true, subtree: true });

    </script>


