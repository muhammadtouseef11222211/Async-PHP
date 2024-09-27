<script>
    $(document).ready(function() {
        // Use event delegation to handle click events for elements with class 'runScripts'
        $(document).on('click', '.runScripts', function(e) {
            e.preventDefault();
            var url = $(this).data('url'); // Get the URL from the data attribute

            $.ajax({
                url: url,
                method: 'POST',
                success: function(data) {
                    $('#output').html(data);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#output').html("Error: " + textStatus + " " + errorThrown);
                }
            });
        });
    });
</script>
</body>
</html>

