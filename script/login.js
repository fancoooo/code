window.onload = function () {
    var email = document.getElementById('email');
    var pass = document.getElementById('pass');
    var btn = document.getElementsByClassName('btn')[0];

    $('.form-group input').on('keypress',function(e){
        
        /*$.ajax({
            type: "POST",
            dataType: "text",
            url: "http://localhost:8080/Coffee/app/checklogin.php",
            data: {myData:json},
            contentType: "application/json; charset=utf-8",
            success: function(data){
                alert(data);
            },
            error: function(e){
                console.log(e.message);
            }
        });
        */
       if(e.keyCode == 13){
            $.post('http://localhost:8080/Coffee/app/checklogin.php', { email: `${email.value}`, pass: `${pass.value}` }, function(data){
                // show the response
                console.log(data + data.length);
                if(data.trim() == "user"){
                    window.open("http://localhost:8080/Coffee/public/user.php","_parent");
                }else if(data.trim() === "admin"){
                    window.open("http://localhost:8080/Coffee/public/admin.php","_parent");
                }else{
                    alert("Thông tin đăng nhập không chính xác");
                }
                
            }).fail(function() {
            
                // just in case posting your form failed
                alert( "Posting failed." );
                
            });
       }
    });
}