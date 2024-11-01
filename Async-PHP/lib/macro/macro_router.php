<?php
// router_macro.php

function renderDynamicContent($navItems, $defaultContent = '<h1>Welcome to the Home Page</h1>') {
    ?>
    <div id="app" class="container mt-4"><?= $defaultContent ?></div>

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
                <?php foreach ($navItems as $hash => $item): ?>
                    case '<?= $hash ?>':
                        loadPage('<?= $item['url'] ?>');
                        break;
                <?php endforeach; ?>
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
                    let formData;
                    if (form) {
                        formData = new FormData(form);
                    }

                    fetch(url, {
                        method: form ? 'POST' : 'GET',
                        body: formData,
                        headers: form ? { 'X-Requested-With': 'XMLHttpRequest' } : {}
                    })
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('output').innerHTML = data;
                    })
                    .catch(err => console.error('Error:', err));
                });
            });
        }

        window.addEventListener('hashchange', router);
        window.addEventListener('load', router);
    </script>
    <?php
}
?>

