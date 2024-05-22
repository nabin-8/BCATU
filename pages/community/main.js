const BASE_URL = 'http://localhost/completeprojectbcatu';

function asset(file) {
    return `${BASE_URL.replace(/\/+$/, '')}/${file.replace(/^\/+/, '')}`;
}

const dateFormat=new Intl.DateTimeFormat("en-us",{
	dateStyle:"medium"
})

let myVar = setInterval(LoadData, 2000);

function LoadData() {
    $.ajax({
        url: 'view.php',
        type: "POST",
        dataType: 'json',
        success: function(data) {
            $('#MyTable tbody').empty();
            // console.log("Data received:", data);  // Debugging line
            // console.log($('#MyTable tbody')); // Ensure this is the correct selector

            // Loop through each comment
            data.forEach(comment => {
                // console.log("Comment:", comment); // Debugging line
				let parent_comment=comment.parent_comment_id;
                let community_id = comment.community_id;
				let createdAtDate = new Date(comment.created_at); 
                let formattedDate = dateFormat.format(createdAtDate);
				// console.log(parent_comment);
                if (parent_comment == 0) {
                    let row = $(`
                        <tr>
                            <td class="community-forum-msgs">
								<img src="${asset(comment.image)}" />
                                <b>${comment.username}:</b>
									<i> ${formattedDate}</i>
                                </br>
                                <div>
                                    <p>${comment.post}</p>
                                    <a data-toggle="modal" data-community_id="${community_id} title="Reply" class="open-ReplyModal" href="#ReplyModal">Reply</a>
                                    
                                </div>
                            </td>
                        </tr>
                    `); // Debugging line
                    $('#MyTable tbody').append(row);
                    
                    // Loop through to find and display child comments
                    data.forEach(reply => {
                        if (reply.parent_comment == community_id) {
                            let replyRow = $(`
                                <tr>
                                    <td style="padding-left:80px">
                                        <b>
                                            <img src="${asset(reply.image)}" />
                                            ${reply.username} :<i> ${reply.formattedDate}:</i>
                                        </b>
                                        </br>
                                        <p>${reply.post}</p>
                                    </td>
                                </tr>
                            `);
                            console.log("Child row created:", replyRow); // Debugging line
                            $('#MyTable tbody').append(replyRow);
                        }
                    });
                }
            });
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log("Error: " + textStatus + " - " + errorThrown);
        }
    });
}

$(document).on("click", ".open-ReplyModal", function() {
    let commentid = $(this).data('community_id');
    $(".modal-body #commentid").val(commentid);
});


$(document).ready(function() {
    // to show dialog
    $(document).on('click', '.open-ReplyModal', function() {
        $('#ReplyModal').show(); 
        $("body").css('overflow', "hidden");
        console.log("Modal triggered");
    });
    
    $('.close').on('click', function() {
        $('#ReplyModal').hide();
        console.log("hided");
        $("body").css('overflow', "auto");
    });

});

function hideModel(){
    $("body").css('overflow', "auto");
    $('#ReplyModal').hide();
}

// parent comment
$(document).ready(function(){
    $('#butsave').on('click', function(){
        $("#butsave").attr("disabled", "disabled");
        let id = document.forms["frm"]["Pcommentid"].value;
        let msg = document.forms["frm"]["msg"].value;

        if (msg != "") {
            $.ajax({
                url: "save.php",
                type: "POST",
                data: {
                    id: id,
                    msg: msg
                },
                cache: false,
                success: function(response) {
                    let dataResult = JSON.parse(response);
                    // console.log(dataResult.statusCode == 200);
                    // console.log(id);
                    // console.log(msg);
                    if (dataResult.statusCode == 200) {
                        $("#butsave").removeAttr("disabled");
                        document.forms["frm"]["Pcommentid"].value = "";
                        document.forms["frm"]["msg"].value = "";
                        LoadData();
                        console.log("Data sent");
                    } else if (dataResult.statusCode == 201) {
                        console.log("Error occurred!");
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('Error: ' + textStatus + ' - ' + errorThrown);
                    $("#butsave").removeAttr("disabled");
                }
            });
        } else {
            console.log("Fill form");
            $("#butsave").removeAttr("disabled");
        }
    });
});


// parent reply comment
$(document).ready(function(){
    $('#btnreply').on('click', function(){
        $("#btnreply").attr("disabled", "disabled");
        // let id = document.forms["frm1"]["Rcommentid"].value;
        let id = 1;
        let msg = document.forms["frm1"]["Rmsg"].value;
        console.log("pass 1");
        if (msg != "") {
            $.ajax({
                url: "save.php",
                type: "POST",
                data: {
                    id: id,
                    msg: msg
                },
                cache: false,
                success: function(response) {
                    let dataResult = JSON.parse(response);
                    console.log("pass 2");
                    console.log(id);
                    console.log(msg);
                    console.log(dataResult.statusCode == 200);
                    if (dataResult.statusCode == 200) {
                        $("#btnreply").removeAttr("disabled");
                        console.log("pass 3");
                        document.forms["frm1"]["Rcommentid"].value = "";
                        document.forms["frm1"]["Rmsg"].value = "";
                        LoadData();
                        hideModel();
                        console.log("Data sent");
                    } else if (dataResult.statusCode == 201) {
                        console.log("Error occurred!");
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('Error: ' + textStatus + ' - ' + errorThrown);
                    $("#btnreply").removeAttr("disabled");
                }
            });
        } else {
            console.log("Fill form");
            $("#btnreply").removeAttr("disabled");
        }
    });
});
