<script>

$(document).ready(function() {
    $(document).on('click', '.runScripts', function(e) {
        e.preventDefault();
        var url = $(this).data('url'); // Get the URL from the data attribute
        console.log("AJAX URL:", url); // Log the URL to console

        $.ajax({
            url: url,
            method: 'POST',
            success: function(data) {
                console.log("AJAX Success:", data); // Log the response
                $('#output').html(data); // Directly output the raw response data
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("AJAX Error:", textStatus, errorThrown); // Log error details
                $('#output').html("Error: " + textStatus + " " + errorThrown);
            }
        });
    });
});



</script>


</body>
</html>

