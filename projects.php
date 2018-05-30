<?php

$action = $_GET['action'];

// For project we have few actions
// We can: reccomend, unroccemend, show, hide, add a project
// So there we slitted it logicaly

// In every block we have id variable - it indicates id of a project
// If there is no id - it will redirect you back to the index page

if($action == 'reccomend') {
	$id  = $_GET['id'];
	if(empty($id)) {
		header('Location: /index.php');
		exit();
	}

	require_once 'config.php';
	require_once 'functions.php';
	require_once 'connect.php';
	require_once 'session.php';


    $stmt = $db->prepare('INSERT INTO project_recomendations(user_id, project_id) VALUES(?, ?)');
    $stmt->execute(array($_SESSION['user']['id'], $id));

    header('Location: '.$_SERVER['HTTP_REFERER']);
    exit();
} elseif($action == 'unreccomend') {
    $id  = $_GET['id'];
    if(empty($id)) {
        header('Location: /index.php');
        exit();
    }

    require_once 'config.php';
    require_once 'functions.php';
    require_once 'connect.php';
    require_once 'session.php';


    $stmt = $db->prepare('DELETE FROM project_recomendations WHERE user_id = ? AND  project_id = ?');
    $stmt->execute(array($_SESSION['user']['id'], $id));

    header('Location: '.$_SERVER['HTTP_REFERER']);
    exit();
}else if($action == 'add') {
	$name = $_GET['name'];

	require_once 'config.php';
	require_once 'functions.php';
	require_once 'connect.php';
	require_once 'session.php';

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		if($_POST['name'] and $_POST['description'] and $_POST['start_date'] and $_POST['end_date']) {
			$stmt = $db->prepare('INSERT INTO researches(start, end) VALUES (?, ?)');
			$stmt->execute(array($_POST['start_date'], $_POST['end_date']));

			$reseach_id = $db->lastInsertId();

			$stmt = $db->prepare('INSERT INTO projects(description, user_id, name, research_id) VALUES (?, ?, ?, ?)');
			$stmt->execute(array($_POST['description'], $_SESSION['user']['id'], $_POST['name'], $reseach_id));

			$followers = get_user_followers($db, $_SESSION['user']);

			foreach($followers as $follower) {
                $stmt = $db->prepare('INSERT INTO messages(text, from_id) VALUES(?, ?)');
                $stmt->execute(array('Your friend has posted a project.', $_SESSION['user']['id']));
                // Create an alert
                $message_id = $db->lastInsertId();

                $stmt = $db->prepare('INSERT INTO alerts(type_id, message_id, user_id) VALUES(2, ?, ?)');
                $stmt->execute(array($message_id, $follower['user_id']));
            }

			header('Location: /projects.php');
			exit();
		}
	} else {
		require_once 'header.php';
		require_once 'html/add_project.php';
	}

	require_once 'footer.php';
} else if($action == 'view') {
    $id = $_GET['id'];
    if(empty($id)) {
        header('Location: /projects.php');
        exit();
    }

    require_once 'config.php';
    require_once 'functions.php';
    require_once 'connect.php';
    require_once 'session.php';

    require_once 'header.php';
    require_once 'html/view_project.php';
    require_once 'footer.php';
} elseif($action == 'hide' or $action == 'show') {
    $id = $_GET['id'];
    if(empty($id)) {
        header('Location: /projects.php');
        exit();
    }

    require_once 'config.php';
    require_once 'functions.php';
    require_once 'connect.php';
    require_once 'session.php';

    $is_hidden = 1;
    if($action == 'show')
        $is_hidden = 0;

    $stmt = $db->prepare('UPDATE projects SET is_hidden = ? WHERE id=?');
    $stmt->execute(array($is_hidden, $id));

    header('Location: '.$_SERVER['HTTP_REFERER']);
    exit();
}else {
	header('Location: /index.php');
	exit();
}