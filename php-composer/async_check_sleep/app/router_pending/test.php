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
        <a href="#/insert_product">Insert Product</a>
        <a href="#/index">Index</a>
    </nav>

    <div id="app"></div>

    <script>
        function loadPage(url) {
            fetch(url)
                .then(res => {
                    if (!res.ok) {
                        throw new Error(`Response status: ${res.status}`);
                    }
                    return res.text();
                })
                .then(html => {
                    document.getElementById('app').innerHTML = html;
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
                case '/index':
                    loadPage('/app/index.php');
                    break;
                default:
                    document.getElementById('app').innerHTML = '<h1>404 Not Found</h1>';
            }
        }

        function initializeScripts() {
            document.querySelectorAll('.runScripts').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    const url = this.dataset.url;
                    const form = this.closest('form');
                    let method = form ? 'POST' : 'GET';
                    let headers = form ? { 'X-Requested-With': 'XMLHttpRequest' } : {};
                    let body = form ? new FormData(form) : null;

                    fetch(url, {
                        method,
                        body,
                        headers
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`Response status: ${response.status}`);
                        }
                        return response.text();
                    })
                    .then(data => {
                        const outputDiv = document.getElementById('output');
                        if (outputDiv) {
                            outputDiv.innerHTML = data;
                        } else {
                            console.error('Output div not found.');
                        }
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
