$(document).ready(function() {
    $('#semester').change(function() {
        let sem = $(this).val();
        $.ajax({
            url: 'fetch_subject.php',
            data: {
                'semester_id': sem
            },
            dataType: 'text',
            method: 'post',
            success: function(resp) {
                $('#subject').empty();
                $('#subject').append(resp);
            }

        })
    })
})