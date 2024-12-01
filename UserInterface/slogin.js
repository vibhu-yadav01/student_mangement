$(function() {
    
    $(document).on("click", "#btnlogin", function() {
        // 
        // alert($("#txtroll").val()); 
        // alert($("#txtpassword").val()); 
        var un =$("#txtroll").val();
        var pwd =$("#txtpassword").val();

        var ln=un.length;
        var pas=pwd.length;

        if(ln!=0 && pas!=0){
            //ajax call
            $.ajax({
                url : "../AjaxHandanler/sloginajax.php",
                type: "POST",
                dataType: "json",
                data: {username: un, pwd:pwd, action:"loginHandler"},
                beforeSend: function(){
                    alert("Before sending to ajax");
                },
                success: function(x){
                    // alert(x.yourusername);
                    // alert("successful");


                    if(x.status== "OK")
                    {
                        $("#Alert").text("VALID DETAILS");
                    }
                 else
                 {
                    $("#Alert").text("INVALID DETAILS");

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
