<?php
    ob_start();
    require_once 'config.php';
    require_once 'functions.php';
    require_once 'connect.php';
    require_once 'session.php';
?>
<?php
    $action = @$_GET['action'];
    if(empty($action)) {
        clear_user_alerts($db, $_SESSION['user']);
        require_once 'header.php';
        require_once 'html/list_messages.php';
    } else {
        if($action == 'write') {
            require_once 'header.php';
            $id = $_GET['id'];
            if(!empty($id)) {
                require_once 'html/write_message.php';
            } else {
                header('Location: /index.php');
            }
        }
    }
?>
<?php require_once 'footer.php' ?>
