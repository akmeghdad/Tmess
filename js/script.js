$(function(){
    setInterval(listOnline, 1000);
    $('#js_text_user').on('keydown', keypress );
    
});

function listOnline() {
    userStatus();
    $.post("login-js.php", {liststatus: 'update'},
        function (data, textStatus, jqXHR) {
            var listDate = JSON.parse(data);
            $('#js_list').empty()
            // console.log('5555');
            for (let i = 0; i < listDate.length; i++) {
                $('#js_list').append('<li class="users__list-item" id="js_list_users">'+ listDate[i]+'</li>');
            } 
        },
        
    );

    $.post("login-js.php", {allmessage: 'update'},
        function (data, textStatus, jqXHR) {
            $('#js_message_all').append(data);
            
        },
        
    );
}


function userStatus() {
    var userName = localStorage.getItem('username');

    if (!isNaN(userName)) {
        // console.log('888');
        
        $.post("login-js.php", {username: 0},
            function (data, textStatus, jqXHR) {
                localStorage.setItem('username', data)
                // console.log(data);
            },
        );
    }else{
        // console.log('3333');
        
        $.post("login-js.php", {username: userName},
            function (data, textStatus, jqXHR) {
                // console.log(data);
                
                
            },
        );
    }
}

function keypress(monkey){
    switch (monkey.key) { // monkey.keycode
        case "Enter":
        
        var  textchat =  $('#js_text_user').val();
        $('#js_text_user').val('').blur();;
        console.log(textchat);


        $.post("login-js.php", {chattext: textchat},
            function (data, textStatus, jqXHR) {
                // localStorage.setItem('username', data)
                // console.log(data);
            },
        );
            break;
 
        // case "ArrowLeft":
        //     fncPrevious();
        //     break;
 
        default:
            return;
    }
 }
 