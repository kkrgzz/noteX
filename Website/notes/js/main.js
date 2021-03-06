(function ($) {
    "use strict";

    /*==================================================================
    [ Notes Operations - Add Note and Receive Note ]*/

    function receiveNotes(){
      $(".container-fluid").load("getNotes.php");
    }

    // Receive notes on startup
    receiveNotes();

    // Receive notes every 5 seconds
    setInterval(function(){
        receiveNotes();
    }, 5000);

    // Insert note with AJAX without refresh page
    $("#submit-add-note-button").click(function(){
        var noteOwner = $("#noteOwnerID").val();
        var noteTitle = $("#noteTitleInput").val();
        var noteContent = $("#noteContentInput").val();
        var noteDate = $("#noteDate").val();

        $.ajax({
            url: '../src/dbOperations/noteOperations.php',
            method: 'POST',
            data: {
                "submitAddNote" : "true",
                "noteTitle" : noteTitle,
                "noteContent" : noteContent,
                "noteOwner" : noteOwner,
                "noteDate" : noteDate
            },
            success: function(response){
                $("#noteTitleInput").val("");
                $("#noteContentInput").val("");
                $(".existingContentLength").text("500");
                $(".existingTitleLength").text("50");

                // Receive notes again. This makes new note visible and don't need to wait 5 seconds.
                receiveNotes();
            }
        });
    });

    $(".container-fluid").on('click', '.noteDetailsButton', function(){
        var noteId = $(this).attr("noteDetailsID");
        var noteOwner = $(this).attr("noteDetailsOwner");
        var noteTitle = $(this).attr("noteDetailsTitle");
        var noteContent = $(this).attr("noteDetailsContent");
        var noteDate = $(this).attr("noteDetailsDate");
        
        $("#modalNoteTitle").text(noteTitle);
        $("#modalNoteContent").text(noteContent);
    });
    /*==================================================================
    [ Note Details Modal Operations ]*/
    



    /*==================================================================
    [ Focus input ]*/
    $('.input100').each(function(){
        $(this).on('blur', function(){
            if($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
        })
    })


    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');

    $('.validate-form').on('submit',function(){
        var check = true;

        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }

        return check;
    });


    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });

    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }

    /*==================================================================
    [ Show pass ]*/
    var showPass = 0;
    $('.btn-show-pass').on('click', function(){
        if(showPass == 0) {
            $(this).next('input').attr('type','text');
            $(this).addClass('active');
            showPass = 1;
        }
        else {
            $(this).next('input').attr('type','password');
            $(this).removeClass('active');
            showPass = 0;
        }

    });


    $(".hide-add-note-card-button-area").click(function(){
      $(".add-note-section").css("visibility", "hidden");
      $(".show-add-note-section-area").css("visibility", "visible");
    });

    $(".noteTitleInput").keyup(function(){
      var titleText = $(this).val();
      var titleTextLen = titleText.length;

      var maxTitleTextLen = 50;
      var existingTitleLength = maxTitleTextLen - titleTextLen;
      $(".existingTitleLength").text(existingTitleLength);

      if($(".noteTitleInput").val().length >= 5){
        $("#submit-add-note-button").prop("disabled", false);
        }else{
            $("#submit-add-note-button").prop("disabled", true);
        }

    });

    $(".noteContentInput").keyup(function(){
      var titleText = $(this).val();
      var titleTextLen = titleText.length;

      var maxTitleTextLen = 500;
      var existingTitleLength = maxTitleTextLen - titleTextLen;
      $(".existingContentLength").text(existingTitleLength);

      if($(".noteContentInput").val().length >= 5){
        $("#submit-add-note-button").prop("disabled", false);
        }else{
            $("#submit-add-note-button").prop("disabled", true);
        }

    });

    $(".show-add-note-section-button").click(function(){
      $(".show-add-note-section-area").css("visibility", "hidden");
      $(".add-note-section").css("visibility", "visible");
    });

    //TOAST JAVASCRIPT CODES
    $("#logoutToastMessage").click(function(){
        var myAlert =document.getElementById('logoutToast');//select id of toast
      var bsAlert = new bootstrap.Toast(myAlert);//inizialize it
      bsAlert.show();//show it
      });

    $("#liveToastBtn").click(function(){
      var myAlert =document.getElementById('toast1');//select id of toast
    var bsAlert = new bootstrap.Toast(myAlert);//inizialize it
    bsAlert.show();//show it
    });

    $("#liveToastBtn2").click(function(){
      var myAlert =document.getElementById('toast2');//select id of toast
    var bsAlert = new bootstrap.Toast(myAlert);//inizialize it
    bsAlert.show();//show it
    });



})(jQuery);

