var userName = localStorage.getItem('username');

if (!isNaN(userName)) {
    console.log('888');
    
    $.post("login-js.php", {username: 0},
        function (data, textStatus, jqXHR) {
            localStorage.setItem('username', data)
            console.log(data);
        },
    );
}else{
    console.log('3333');
    
    $.post("login-js.php", {username: userName},
        function (data, textStatus, jqXHR) {
            console.log(data);
            
            
        },
    );
}