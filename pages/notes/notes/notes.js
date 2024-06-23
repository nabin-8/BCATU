// $(document).ready(function() {
//     $('#semester').change(function() {
//         let sem = $(this).val();
//         $.ajax({
//             url: 'fetch_subject.php',
//             data: {
//                 'semester_id': sem
//             },
//             dataType: 'text',
//             method: 'post',
//             success: function(resp) {
//                 $('#subject').empty();
//                 $('#subject').append(resp);
//             }

//         })
//     })
// })

// for fetch notes
$(document).ready(function() {
    $('#notetype').change(function() {
        let noteType = $(this).val();
        $.ajax({
            url: 'fetch_notes.php',
            data: {
                'note_type': noteType
            },
            dataType: 'html',
            method: 'post',
            success: function(resp) {
                $('.notes-section-right-bottom-main').empty();
                $('.notes-section-right-bottom-main').html(resp);
            }
        });
    });
});

// for search notes
$(document).ready(function() {
    $('#searchnotes').on("keyup", 
        function() {
        let searchnotes = $(this).val();
        // alert("hello");
        $.ajax({
            url: 'search.php',
            data: {
                'search_note': searchnotes
            },
            dataType: 'html',
            method: 'post',
            success: function(resp) {
                $('.notes-section-right-bottom-main').empty();
                $('.notes-section-right-bottom-main').html(resp);
            }
        });
    });
});
