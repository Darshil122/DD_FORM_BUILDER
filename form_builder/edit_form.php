<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Form Name</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div>
    <h2>Edit Form Name</h2>

    <!-- Input field to display and update the form name -->
    <input type="text" id="formName" placeholder="Enter new form name">
    <button id="updateFormName">Update Form Name</button>
</div>

<script>
    $(document).ready(function() {
        // Check if editId is correctly passed in the URL
        var editId = <?php echo isset($_GET['edit_id']) ? $_GET['edit_id'] : 0; ?>;
        console.log("editId:", editId); // Debugging log to verify the correct editId is passed

        // Fetch and display the form name
        if (editId) {
            $.get('index.php?edit_id=' + editId, function(data) {
                console.log("Fetched form name:", data); // Debugging log to check the response
                if (data.startsWith("Error")) {
                    alert(data); // Alert the error if there is one
                } else {
                    $('#formName').val(data);
                }
            });
        } else {
            console.log("editId not found in URL or is invalid");
        }

        // Handle update form name
        $('#updateFormName').click(function() {
            var newFormName = $('#formName').val();

            if (newFormName && editId) {
                $.ajax({
                    url: 'index.php',
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        formId: editId,
                        newFormName: newFormName
                    }),
                    success: function(response) {
                        alert('Form name updated successfully');
                    },
                    error: function() {
                        alert('Failed to update form name');
                    }
                });
            }
        });
    });
</script>

</body>
</html>
