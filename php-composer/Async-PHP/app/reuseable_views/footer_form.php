<script>
    $(document).ready(function() {
        // Use event delegation to handle click events for elements with class 'runScripts'
        $(document).on('click', '.runScripts', function(e) {
            e.preventDefault();

            // Get the URL from the data-url attribute of the button
            var url = $(this).data('url');

            // Get the form associated with the button that was clicked
            var form = $(this).closest('form');

            // Check if a form was found
            if (form.length) {
                // Gather form data using FormData object
                var formData = new FormData(form[0]);

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    processData: false,  // Do not process the data into a query string
                    contentType: false,  // Do not set content type
                    success: function(data) {
                        $('#output').html(data);  // Show response in the output div
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('#output').html("Error: " + textStatus + " " + errorThrown);
                    }
                });
            } else {
                $('#output').html("Error: No form associated with this button.");
            }
        });
    });
</script>
</body>
</html>
