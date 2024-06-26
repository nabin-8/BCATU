$(document).ready(function() {
    $('.blog-categories-buttons').click(function() {
        let category = $(this).data('category');
        // console.log(category);

        // AJAX request to fetch blogs based on the selected category
        $.ajax({
            url: 'fetch_blogs.php',
            type: 'POST',
            data: { category: category },
            success: function(response) {
                $('.main-blog-container').html(response);
                console.log(response);
                console.log("hello");
            }
        });
    });
});