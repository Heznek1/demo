<?php

require_once 'config.php';
require_once 'functions.php';
require_once 'connect.php';
require_once 'session.php';

// If it's form send - try to register user
if($_SERVER["REQUEST_METHOD"] == "POST") { 
	$username = $_POST['username'];
	$password = $_POST['password'];
	$password_confirm = $_POST['password_confirm'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];

	// If some field is empty - show an error
	if(empty($username) or empty($password) or empty($first_name) or empty($last_name) or empty($password_confirm)) {
		add_msg('Please fill out all forms.');
		header('Location: /login.php#signup');
		exit();
	}

	// If passwords are not the same
	if($password != $password_confirm) {
		add_msg('Passwords must be the same.');
		header('Location: /login.php#signup');
		exit();
	}

	// if Username is not a Admin or email
	if($username != 'Admin' && !filter_var($username, FILTER_VALIDATE_EMAIL)) {
        add_msg('Username must be an email.');
        header('Location: /login.php#signup');
        exit();
    }

	$stmt = $db->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute(array($username));
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // If user with such email exist
    if(count($rows) > 0) {
    	add_msg('User with such username already exists. Try another one.');
		header('Location: /login.php#signup');
		exit();
    }
    $stmt = $db->prepare("INSERT INTO users (first_name, last_name, username, password, is_admin) VALUES (:first_name, :last_name, :username, :password, 1)");
	$stmt->execute(array(
		'first_name' => $first_name,
		'last_name' => $last_name,
		'username' => $username,
		'password' => $password
	));

    $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute(array($db->lastInsertId()));
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Create a user, login and redirect him to dashboard

    $_SESSION['user'] = $rows[0];

    header('Location: /index.php');
    exit();
}

// If not send a form - display html
header('Location: /login.php');