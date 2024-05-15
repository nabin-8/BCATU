$(document).ready(function() {
    // Load data initially
    loadData();

    // Submit question form
    $('#questionForm').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.post('save.php', formData, function(response) {
            handleResponse(response);
            loadData(); // Reload data after submission
        });
    });

    // Submit reply form
    $('#replyForm').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.post('save.php', formData, function(response) {
            handleResponse(response);
            $('#replyModal').modal('hide');
            loadData(); // Reload data after submission
        });
    });

    // Open reply modal
    $(document).on('click', '.open-reply-modal', function() {
        var commentId = $(this).data('id');
        $('#commentId').val(commentId);
        $('#replyModal').modal('show');
    });

    // Function to load data from server
    function loadData() {
        $.getJSON('view.php', function(data) {
            var tableBody = $('#questionTable tbody');
            tableBody.empty();
            $.each(data, function(i, item) {
                var row = $('<tr>').append(
                    $('<td>').text(item.student + ': ' + item.date + ': ' + item.post),
                    $('<td>').html('<a href="#" class="open-reply-modal" data-id="' + item.id + '">Reply</a>')
                );
                tableBody.append(row);
            });
        });
    }

    // Function to handle server response
    function handleResponse(response) {
        var data = JSON.parse(response);
        if (data.statusCode == 200) {
            alert('Operation successful');
        } else {
            alert('Error: ' + data.error);
        }
    }
});
