$("#myForm").submit(function(e){
    e.preventDefault();
    if ($('input[name="username"]').val() == "" || $('input[name="password"]').val() == "") 
        $("#NotesArea").html("Please enter both Username and Passnumber");
    else
        $.post($(this).attr("action"), $(this).serialize())
              .done(function(data)              { $("#NotesArea").html(data); 
              
              if(data.indexOf("Successful") > -1){
                    $(".condition.loggedin").addClass("valid")
              }
               $(".condition.indexlogin").addClass("valid");
               })
              .fail(function(jqXHR, textStatus) {alert( "Request failed: " + textStatus );});
});
