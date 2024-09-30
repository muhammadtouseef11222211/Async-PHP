<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigo Example</title>
    <script src="https://unpkg.com/navigo"></script>
</head>
<body>
    <nav>
        <a href="/" data-navigo>Home</a>
        <a href="/async_calculation" data-navigo>Async Calculation</a>
        <a href="/insert_product" data-navigo>Insert Product</a>
        <a href="/insert_user" data-navigo>Insert User</a>
    </nav>
    <div id="app"></div>

    <script>
        const router = new Navigo('/', { linksSelector: 'a[data-navigo]' });

        function loadPage(url) {
            fetch(url)
                .then(res => res.text())
                .then(html => {
                    document.getElementById('app').innerHTML = html;
                })
                .catch(err => console.error(err));
        }

        router.on('/', () => {
            document.getElementById('app').innerHTML = '<h1>Welcome to the Home Page</h1>';
        });

        router.on('/async_calculation', () => loadPage('/app/async_calculation.php'));
        router.on('/insert_product', () => loadPage('/app/insert_product_form_template.php'));
        router.on('/insert_user', () => loadPage('/app/insert_user_form_template.php'));

        router.resolve(); // Start the router
    </script>
</body>
</html>

