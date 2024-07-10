const BASE_URL = 'http://localhost/completeprojectbcatu';

function asset(file) {
    return `${BASE_URL.replace(/\/+$/, '')}/${file.replace(/^\/+/, '')}`;
}

const dateFormat=new Intl.DateTimeFormat("en-us",{
	dateStyle:"medium"
})

let myVar = setInterval(LoadData, 2000);

function formatDate(dateString) {
    const date = new Date(dateString);
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return date.toLocaleDateString('en-US', options);
}

function LoadData() {
    $.ajax({
        url: 'view.php',
        type: "POST",
        dataType: 'json',
        success: function(data) {
            $('#MyTable tbody').empty();
            // Loop through each comment
            data.forEach(comment => {
                let parent_comment = comment.parent_comment_id;
                let community_id = comment.community_id;
                let createdAtDate = comment.created_at;

                if (parent_comment == 0) {
                    let row = $(`
                        <tr >
                            <td class="community-forum-msgs">
                                <img src="${asset(comment.image)}" />
                                <b>${comment.username}:</b>
                                <i> ${formatDate(createdAtDate)}</i>
                                </br>
                                <div>
                                    <p>${comment.post}</p>
                                    <a data-toggle="modal" data-community_id="${community_id}" title="Reply"  class="open-ReplyModal" href="#ReplyModal">Reply</a>
                                </div>
                            </td>
                        </tr>
                    `);
                    $('#MyTable tbody').append(row);

                    // Loop through to find and display child comments
                    data.forEach(reply => {
                        if (reply.parent_comment_id == community_id) {
                            let replyCreatedAtDate = reply.created_at;
                            let replyRow = $(`
                                <tr>
                                    <td class="community-forum-msgs" style="padding-left:80px; margin:5px 0; ">
                                        <b>
                                            <img src="${asset(reply.image)}" />
                                            ${reply.username} :<i style="font-size: 12px" > ${formatDate(replyCreatedAtDate)}</i>
                                        </b>
                                        </br>
                                        <p>${reply.post}</p>
                                    </td>
                                </tr>
                            `);
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
                    let dataResult = response;

                    if (dataResult.statusCode == 200) {
                        $("#butsave").removeAttr("disabled");
                        document.forms["frm"]["Pcommentid"].value = "";
                        document.forms["frm"]["msg"].value = "";
                        LoadData();

                    } else if (dataResult.statusCode == 201) {
                        console.log("Error occurred! Status 201");
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


// Parent reply comment
$(document).ready(function() {
    $('#btnreply').on('click', function() {
        $("#btnreply").attr("disabled", "disabled");
        let id = document.forms["frm1"]["Rcommentid"].value;
        let msg = document.forms["frm1"]["Rmsg"].value;        
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
                    try {
                        let dataResult =response                                                                                                
                        if (dataResult.statusCode == 200) {
                            $("#btnreply").removeAttr("disabled");                            
                            document.forms["frm1"]["Rcommentid"].value = "";
                            document.forms["frm1"]["Rmsg"].value = "";
                            LoadData();
                            hideModel();
                        } else if (dataResult.statusCode == 201) {
                            console.log("Error occurred!");
                        }
                    } catch (e) {
                        console.error('Failed to parse JSON response: ', e);
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