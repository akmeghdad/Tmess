<?php
if (session_status() == PHP_SESSION_NONE || session_id() == '') {
    session_start();
}
require_once 'Database.class.php';
// require_once 'Control.php'; 

if (isset($_POST['username'])) {
    $username = $_POST['username'];
    if ($username == 0) {
        if (isset($_SESSION['username'])){
            echo $_SESSION['username'];
            // var_dump($_SESSION);
            exit;
        }else{
            $new_username = uniqid();
            $_SESSION['username'] = $new_username;
            addUser();
            echo $new_username;
            // var_dump($_SESSION); //
            exit;
        }
    } elseif(!empty($username)) {
        updateLoginUser($username);
        // var_dump($_SESSION);
    }
}elseif(isset($_POST['liststatus'])){
    if ($_POST['liststatus'] = 'update') {
        checkOnline();
        updateLoginUser($_SESSION['username']);
        echo json_encode( userOnline());
            exit;
    }elseif ($_POST['liststatus'] = 'fillList') {
        // checkOnline();
    }
}elseif(isset($_POST['chattext'])){
    addTexttoSQL($_POST['chattext']);

}elseif(isset($_POST['allmessage'])){
    getAllMessage();
}

function getAllMessage()
{
    $oneDate = date('Y-m-d H:i:s', strtotime(' -1 second'));

    $query=
        "SELECT
            `message`
        FROM
            `messages`
        WHERE
            `date` > '$oneDate'";

    $db = new Database();
    // var_dump($_SESSION['username']);
    $ret = $db->query($query);
    $return = '';
    foreach ($ret as $value) {
        $return .= '<p>'.$value['message'].'</p>';
    }
    echo $return;
    exit;
}


function addUser(){
    $sqlData = [
        $_SESSION['username'],
        date('Y-m-d H:i:s')
    ];

    $query = 
        "INSERT
        INTO
            users(
                `user_name`,
                `date_register`,
                `status`)
        VALUES(
            ?,
            ?,
            'online')";

    $db = new Database();
    // var_dump($_SESSION['username']);
    $db->executeSql($query,$sqlData);
}

function updateLoginUser($usName)
{
    $_SESSION['username'] = $usName;

    $sqlData = [
        date('Y-m-d H:i:s'),
        $usName
    ];

    $query = 
        "UPDATE
            `users`
        SET
            `date_last_visit` = ?,
            `status` = 'online'
        WHERE
            `user_name` = ?";

    $db = new Database();
    $db->executeSql($query,$sqlData);
}

function userOnline()
{
    $oneDate = date('Y-m-d H:i:s', strtotime(' -1 heure'));
    $query = 
        "SELECT
            `user_name`
        FROM
            `users`
        WHERE
            `status` = 'online'";
            // `date_last_visit` < '$oneDate'";

    $db = new Database();
    $list = $db->query($query);

    $listReturn = array();
    foreach ($list as $value) {
        $listReturn[] .= $value['user_name'];
    }

    if (isset($_SESSION['username'])) {
        if (!in_array($_SESSION['username'], $listReturn)) {
            $listReturn[] .= $_SESSION['username'];
        }
    }

    return $listReturn;

}

function checkOnline()
{
    $oneDate = date('Y-m-d H:i:s', strtotime(' -1 minutes'));
    $query = 
    "UPDATE
        `users`
    SET
        `status` = 'offline'
        WHERE
            `date_last_visit` < '$oneDate'";

    $db = new Database();
    $db->executeSql($query);

    // $listReturn = array();
    // foreach ($list as $value) {
    //     $listReturn[] .= $value['user_name'];
    // }

    // if (isset($_SESSION['username'])) {
    //     if (!in_array($_SESSION['username'], $listReturn)) {
    //         $listReturn[] .= $_SESSION['username'];
    //     }
    // }

    // return $listReturn;
}

function addTexttoSQL($txt)
{
    $db = new Database();

    $sqlData = [
        $_SESSION['username']
    ];

    $query=
        "SELECT
            `id`
        FROM
            `users`
        WHERE
            `user_name` = ?";

    $id = $db->queryOne($query,$sqlData);


    $sqlData = [
        $id['id'],
        $txt,
        date('Y-m-d H:i:s')
    ];

    $query = 
        "INSERT
        INTO
            messages(
                `user_id`,
                `message`,
                `date`
                )
        VALUES(
            ?,
            ?,
            ?)";

    
    // var_dump($_SESSION['username']);
    $db->executeSql($query,$sqlData);
}