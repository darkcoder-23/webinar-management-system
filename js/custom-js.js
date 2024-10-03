$(document).ready(function () {  
    if (action === 'edit') {
        img_req = false;
    } else {
        img_req = true;
    }
  
    $("#user_from").validate({
        rules: {
            name: {
                required: true
            },
            email: {
                required: true
            },
            username: {
                required: true
            },
            password: {
                required: true
            },

            admin_role: {
                required : true
            }
        },
    
        messages: {
            name: {
                required: "**Please Enter Name**"
            },
            email: {
                required: "**Please Enter Email**" 
            },
            username: {
                required : "**Please Enter username**"
            },
            password : {
                required: "**Enter Your Password**"
            },
            admin_role: { 
                required : "**Please Select Role**" 
            }

        },
        
        errorPlacement: function(error, element) {
            if (element.attr("type") == "radio")
                    error.insertAfter('#LastButton');
                //error.insertAfter(element.siblings('label'));
            else {
                error.insertAfter(element);
            }
               
        },
        submitHandler: function (form) {
            $.ajax({
                url : "db/user_write.php",
                type : "POST",
                data : $(form).serialize(),
                success: function(response) {
                    //alert (response); 
                    $('#display_response').replaceWith($('#display_response').html(response));
                    //return false; 
                }
            });
        },
    });

    $("#category_form").validate({
        rules: {
            category_name: {
                required : true,
            },
            parent: {
                required : true,
            },
            description : {
                required : true,
            }
        },
        messages :{
            category_name : "**Please Enter Category Name**",
            parent: {
                required: "**Select Category Parent**",
            },
            description : "**Please Write Category description**",

        },
        submitHandler: function (form) {
            $.ajax({
                url : "db/category_write.php",
                type : "POST",
                data : $(form).serialize(),
                success: function(response) {
                    //alert (response); 
                    $('#display_response').replaceWith($('#display_response').html(response));
                    //return false; 
                }
            });
        },
    });


    $("#tag_form").validate({
        rules: {
            tags_name: {
                required : true,
            },
            
        },
        messages :{
            tags_name : "**Please Enter Tag Name**",
            parent: {
                required: "**Select Category Parent**",
            },
            description : "**Please Write Category description**",

        },

        submitHandler: function (form) {
            $.ajax({
                url : "db/tags_write.php",
                type : "POST",
                data : $(form).serialize(),
                success: function(response) {
                    //alert (response); 
                    $('#display_response').replaceWith($('#display_response').html(response));
                    //return false; 
                }
            });
        },


    });

    $("#presenterValidation").validate({

        rules:{
            name: {
                required: true,
            },
            Gender: {
                required : true,
            },
            presen_bio : {
                required : true,
            },
            prof_image : {
                required : img_req,
            },
        },
        messages:{
            name:"**Please Enter Name**",
            Gender: "**Select Gender**",
            presen_bio : "**Please write the Presenter Bio**",
            prof_image : "**chooe the Profile Image**",
        },

        errorPlacement: function(error, element) {
            if (element.attr("type") == "radio"){
                error.insertAfter(element.parent());
            }
            else {
                error.insertAfter(element);
            }
               
        },

        submitHandler: function (form) {
            var form = $('#presenterValidation')[0];
            var data = new FormData(form);
            jQuery.each(jQuery('#prof_image')[0].files, function(i, file) {
                data.append('file-'+i, file);
            });

            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "db/presenter_write.php",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                success: function (response) {
                    //alert(response);
                    $('#display_response').replaceWith($('#display_response').html(response));
                    setTimeout(()=>{
                    $('#display_response').replaceWith($('#display_response').html(response));
                    }, 2000)
                   
                }
            });
 
        },

        
    });

    $("#webinarValidation"). validate({
        rules: {
            web_name : {
                required : true,
            },
            web_desc : {
                required : true,
            },
            poster : {
                required : img_req,
            },
            "presenter_id[]" : {
                required : true,
                minlength : 1,
            },
            category : {
                required : true,
            },
            "tagname[]" : {
                required : true,
            }


        },

        messages : {
            web_name : "**Enter the webinar name**",
            web_desc : "**Please write the Description**",
            poster : "**choose the Image**",
            "presenter_id[]" : "**Please check at least one Presenter**",
            category : "**Please select the ctegory**",
            "tagname[]" : "**Please check at least one Tag**",

        },
        errorPlacement: function(error, element) {
            
            if (element.is((":checkbox"))){
                //error.insertBefore(element);
                error.insertAfter(element.parent().parent());
            }
                //error.insertAfter(element.siblings(''));
            else {
                error.insertAfter(element);
            }
               
        },
        submitHandler: function (form) {
            var form = $('#webinarValidation')[0];
            var data = new FormData(form);
            jQuery.each(jQuery('#poster')[0].files, function(i, file) {
            data.append('file-'+i, file);
            });

            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "db/webinar_write.php",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                success: function (response) {
                    $('#display_response').replaceWith($('#display_response').html(response));
                }
            });
 
        },
    });

    $("#indexForm").validate({

        rules : {
            username : {
                required : true,
            },
            password : {
                required : true,
            }

        },
        messages: {
            username : "**Please Enter Username**",
            password : "**Please Enter Password**",
        }

    });

    $("#broadcast_validation").validate({

        rules : {
            broadcast_web_name : {
                required : true,
            },
            date_time : {
                required : true,        
            },
            availabe_seat : {
                required : true,
            }
        },
        messages : {
            broadcast_web_name : "**Please Select Webinar name**",
            date_time : "**choose the Date & Time**",
            availabe_seat : "**Enter the maximum no Seat**",
        },

        
        errorPlacement: function(error, element) {
            
            if (element.attr("type") == "datetime-local"){
                //error.insertBefore(element);
                error.insertAfter('#date_box');
            }
                //error.insertAfter(element.siblings(''));
            else {
                error.insertAfter(element);
            }
               
        },
        submitHandler: function (form) {
            $.ajax({
                url : "db/broadcast_write.php",
                type : "POST",
                data : $(form).serialize(),
                success: function(response) {
                    //alert (response); 
                    $('#display_response_broadcast').replaceWith($('#display_response_broadcast').html(response));
                    //return false; 
                }
            });
        },


    });
    // $(document).on('click','#delete',function(){
    //     if(confirm("Are You Sure want to delete!!")) {

    //     }
    // }); 
});

///////////////////////////////////////////////////////
/////////  Pagination using AJAX    ///////////////////
//////////////////////////////////////////////////////

$(document).ready( function() {
    $(document).on("click",".page-link",function(e) {
        e.preventDefault();
        var go_to_page;
        var curr_page = $('#curr_page').html();
        curr_page = parseInt(curr_page, 10);
    
        var last_page = $('#last_page').html();
        last_page = parseInt(last_page, 10);  

        var active_page = $(this).attr("id");
        
        if (active_page == 'previous_link') {
            go_to_page = curr_page - 1;
        } else if (active_page === 'next_link') {
            go_to_page = curr_page + 1;
        } else {
            go_to_page = parseInt(active_page, 10);
        }

        var ajaxurl = $('#tbody').data('ajaxurl');

        var action_admin = $('.pagination').data('admin');
        var action = 'pagination';
        if ( action_admin === 'admin' ) {
            var action = 'pagination_admin';
        } else if ( action_admin === 'subscriber'  ) {
            var action = 'pagination_subscriber';
        } 

        //alert( go_to_page +"====="+action );
        
        $.ajax
        ({
            type: "POST",
            url: "db/" + ajaxurl,
            data: {
                page: go_to_page,
                action: action
                // admin_action:'pagination_admin',
                // subscriber_action : 'pagination_subscriber',
            },
            success: function (data) {
                //console.log(data);
                $('#tbody').html('');
                $('#tbody').html(data);
                $('#curr_page').html(go_to_page);
                $('.page-item').removeClass('active');
                $('#page_link_' + go_to_page).addClass('active');
                if (go_to_page === 1) {
                    $('#prev_link').hide();
                    $('#next_link').show();
                } 
                else if (go_to_page === last_page) {
                    $('#next_link').hide();
                    $('#prev_link').show()
                } 
                else {
                    $('#prev_link').show();
                    $('#next_link').show();
                }
            }
        });

    });

});

////////////////////////////////////////////////////////
//////////////////ststuts//////////////////////////////
///////////////////////////////////////////////////////


/////////////////////// Admin Status ////////////////////////////////////////////////////////////////////

$(document).on("click", ".admin_status_btn", function(e){
    e.preventDefault();         
    var admin_status = $(this).data("sval");
    var admin_id = $(this).data("id");
    var admin_action = "change_status";
    $.ajax({
      url: "db/user_write.php",
      method: "POST",
      data : {id : admin_id , status : admin_status, action : admin_action},
      success: function(response) {
        if(response){
            $('#display_response').replaceWith($('#display_response').html("Status Updated Successfully! Plz refesh Page.."));
        // setTimeout(function(){
        //   window.location = $_SERVER['HTTP_ORIGIN']."/admin_list.php";
        // }, 3000)
        }
      }
      
    })
});

//////////////////////////Webinar Status //////////////////////////////////////////////////////////////////////////

$(document).on("click", ".webinar_status_btn", function(e){
    e.preventDefault();         
    var admin_status = $(this).data("sval");
    var admin_id = $(this).data("id");
    var admin_action = "change_status";
    $.ajax({
      url: "db/webinar_write.php",
      method: "POST",
      data : {id : admin_id , status : admin_status, action : admin_action},
      success: function(response) {
        if(response){
            $('#display_response').replaceWith($('#display_response').html("Webinar Status Updated Succesfully!... Please wait...."));
            setTimeout(function() {
                window.location = $_SERVER['HTTP_ORIGIN']."/webinar_list.php";
            }, 3000)
        }
      }
    })
});

////////////////////Broadcast Status Button using AJAX////////////////////////////////////////////////////////////////////////

$(document).on("click", ".broadcast_status_btn", function(e){
    e.preventDefault();         
    var admin_status = $(this).data("sval");
    var admin_id = $(this).data("id");
    var admin_action = "change_status";
    $.ajax({
      url: "db/broadcast_write.php",
      method: "POST",
      data : {id : admin_id , status : admin_status, action : admin_action},
      success: function(response) {
        if(response){
            $('#display_response').replaceWith($('#display_response').html("Broadcart Status Update successfully!... Please Wait....."));
            setTimeout(function() {
                window.location = $_SERVER['HTTP_ORIGIN']."/broadcast_list.php";
            }, 3000)
        }
      }
      
    })
});

////////////////////////////Presenter Status Button ///////////////////////////////////////////////////////////////////////

$(document).on("click", ".presenter_status_btn", function(e){
    e.preventDefault();         
    var admin_status = $(this).data("sval");
    var admin_id = $(this).data("id");
    var admin_action = "change_status";
    $.ajax({
      url: "db/presenter_write.php",
      method: "POST",
      data : {id : admin_id , status : admin_status, action : admin_action},
      success: function(response) {
        if(response){
            $('#display_response').replaceWith($('#display_response').html("Presenter Status Updated Successfully!...Please wait...."));
            setTimeout(function() {
                window.location = $_SERVER['HTTP_ORIGIN']."/presenter_list.php";
            }, 3000)
        }
      }
      
    })
});
