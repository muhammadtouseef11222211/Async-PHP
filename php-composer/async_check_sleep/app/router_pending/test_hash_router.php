<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hash Router Example</title>
</head>
<body>
    <nav>
        <a href="#/">Home</a>
        <a href="#/async_calculation">Async Calculation</a>
        <a href="#/insert_user">Insert User</a>
        <a href="#/insert_product">Insert product</a>
        <a href="#/Index">Index</a>

    </nav>
    <div id="app"></div>

    <script>
        function loadPage(url) {
            fetch(url)
                .then(res => res.text())
                .then(html => {
                    document.getElementById('app').innerHTML = html;
                    // Reinitialize event listeners for AJAX functionality
                    initializeScripts();
                })
                .catch(err => console.error(err));
        }

        function router() {
            const hash = window.location.hash.slice(1) || '/';
            switch (hash) {
                case '/':
                    document.getElementById('app').innerHTML = '<h1>Welcome to the Home Page</h1>';
                    break;
                case '/async_calculation':
                    loadPage('/app/async_calculation.php');
                    break;
                case '/insert_user':
                    loadPage('/app/insert_user_form_template.php');
                    break;

                   case '/insert_product':
                    loadPage('/app/insert_product_form_template.php');
                    break;

                    case '/Index':
                    loadPage('/app/index.php');
                    break;

                default:
                    document.getElementById('app').innerHTML = '<h1>404 Not Found</h1>';
            }
        }

        function initializeScripts() {
            // Handle AJAX functionality for buttons with class 'runScripts'
            document.querySelectorAll('.runScripts').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Get the URL from the data-url attribute of the button
                    const url = this.dataset.url;

                    // Check if the button is inside a form
                    const form = this.closest('form');
                    let formData;
                    if (form) {
                        // Gather form data using FormData object
                        formData = new FormData(form);
                    }

                    // Make the AJAX request
                    fetch(url, {
                        method: form ? 'POST' : 'GET',
                        body: formData,
                        headers: form ? { 'X-Requested-With': 'XMLHttpRequest' } : {}
                    })
                    .then(response => response.text())
                    .then(data => {
                        // Show response in the output div
                        document.getElementById('output').innerHTML = data;
                    })
                    .catch(err => console.error('Error:', err));
                });
            });
        }

        window.addEventListener('hashchange', router);
        window.addEventListener('load', router);
    </script>
</body>
</html>

