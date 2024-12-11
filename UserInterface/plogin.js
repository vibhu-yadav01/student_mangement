$(function() {
    
    $(document).on("click", "#btnloginp", function() {
        var un =$("#txtemail").val();
        var pwd =$("#txtpass").val();

        var ln=un.length;
        var pas=pwd.length;

        if(ln!=0 && pas!=0){
            $.ajax({
                url : "../AjaxHandanler/ploginajax.php",
                type: "POST",
                dataType: "json",
                data: {username: un, pwd:pwd, action:"loginHandler"},
                beforeSend: function(){
                    // alert("Before sending to ajax");
                },
                success: function(x){
                    if(x.status== "OK")
                    {
                        document.location.replace("/PROJECT/student_mangement/UserInterface/professor.php");
                    }
                 else
                 {
                    $("#Alert").text("Invalid Details");

                 }
                },
                error: function(){
                    alert("ERROR");

                },
            });
        }
        else{
            alert("Invalid Details");
        }

    });
});