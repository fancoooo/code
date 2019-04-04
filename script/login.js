window.onload = function () {
    var email = document.getElementById('email');
    var pass = document.getElementById('pass');
    var btn = document.getElementsByClassName('btn')[0];

    btn.addEventListener('click', function(e){
        e.preventDefault();
        
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
       $.post('http://localhost:8080/Coffee/app/checklogin.php', { email: `${email.value}`, pass: `${pass.value}` }, function(data){
            // show the response
            console.log(data + data.length);
            if(data.trim() == "User"){
                window.open("http://localhost:8080/Coffee/public/User.php","_parent");
            }else if(data.trim() === "Admin"){
                window.open("http://localhost:8080/Coffee/public/admin.php","_parent");
            }else{
                alert("Thông tin đăng nhập không chính xác");
            }
             
        }).fail(function() {
         
            // just in case posting your form failed
            alert( "Posting failed." );
             
        });

    });
}