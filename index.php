<?php session_start(); 
// require_once 'Control.php'; 
// var_dump($_SESSION);
// $_SESSION['username'] = 55;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Chat Room</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/login.js"></script>
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1 class="heading__1"><a href="index.html">ChatRoom of developer WEB</a></h1>
    <main>
        <div class="message">
            <div name="messages" id="js_message_all"  class="message__all"></div>
            <textarea name="message__text-user" id="js_text_user" cols="30" rows="10" class="text"></textarea>
        </div>
        <ul class="users" id="js_list">
            <?php /*$listUser = userOnline();
            foreach ($listUser as $value): ?> 
            <li class="users__list-item" id="js_list_users"><?= $value ?></li>
            <!-- <li class="users__list-item" id="js_list_users">meghdad</li> -->
            <?php endforeach; */?>
        </ul>

    </main>
    <footer class="footer"></footer>

</body>

</html>