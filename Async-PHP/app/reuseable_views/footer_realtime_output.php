<script>
    document.addEventListener('DOMContentLoaded', function () {
        const runScriptButtons = document.querySelectorAll('.runScripts');

        runScriptButtons.forEach(button => {
            button.addEventListener('click', function () {
                const outputDiv = document.getElementById('output');
                outputDiv.innerHTML = ''; // Clear previous output

                const url = this.getAttribute('data-url'); // Get the URL from the button

                const eventSource = new EventSource(url);

                eventSource.onmessage = function (event) {
                    // Append output to the div
                    outputDiv.innerHTML += `<pre>${event.data}</pre>`;
                };

                eventSource.addEventListener('end', function () {
                    // Close the connection when scripts are done
                    eventSource.close();
                    outputDiv.innerHTML += '<p>All scripts executed.</p>';
                });

                eventSource.onerror = function (event) {
                    outputDiv.innerHTML += '<p>Error occurred while executing scripts.</p>';
                    eventSource.close();
                };
            });
        });
    });
</script>
