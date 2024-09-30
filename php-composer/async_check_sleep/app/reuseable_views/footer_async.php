<script>
    document.addEventListener('DOMContentLoaded', () => {
        const button = document.querySelector('.runScripts');
        button.addEventListener('click', (e) => {
            e.preventDefault();
            const url = button.getAttribute('data-url'); // Get the URL from the data attribute
            
            fetch(url, {
                method: 'POST',  // Change to POST
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'  // Set content type
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.text();
            })
            .then(data => {
                document.getElementById('output').innerHTML = data;
            })
            .catch(err => {
                console.error('Error fetching output:', err);
                document.getElementById('output').innerHTML = 'Error fetching output: ' + err.message;
            });
        });
    });
</script>
</body>
</html>
