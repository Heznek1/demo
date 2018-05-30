<?php

// Include all required files:
// config - for configuration variables. They will be used later
// functions - for functions
// connect - for connect to db
// session - for checking user in session
require_once 'config.php';
require_once 'functions.php';
require_once 'connect.php';
require_once 'session.php';
$action = @$_GET['action'];

// if no action - redirect
if(!$action) {
    header('Location: /index.php');
}

if($action == 'delete') {
    $id = $_GET['id'];
    if(!$id)
        header('location:javascript://history.go(-1)');
    $stmt = $db->prepare('DELETE FROM user_skills WHERE id = ?');
    $stmt->execute(array($id));
    header('Location: '.$_SERVER['HTTP_REFERER']);
} else if($action == 'add') {
    $id = @$_GET['user_id'];
    if(empty($id) or empty($_POST['skill']))
        header('Location: /index.php');
    $skill = $_POST['skill'];
    $stmt = $db->prepare('INSERT INTO user_skills(u_id, skill) VALUES(?, ?)');
    $stmt->execute(array($id, $skill));
    header('Location: '.$_SERVER['HTTP_REFERER']);
} else {
    header('Location: /index.php');
}

?>