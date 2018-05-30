<?php

/**
 * It will add a message to session
 * It's need for login page to show the error or success message
 * @param $message
 * @param bool $is_error - indicates an error. If yes - show red block, no - green
 */
function add_msg($message, $is_error=true) {
	global $_SESSION;
	$_SESSION['message'] = array(
                  'text' => $message,
                  'is_error' => $is_error
    );
}

/**
 * Getting user skills as array
 * @param $db
 * @param $user
 * @return mixed
 */
function get_user_skills($db, $user) {
    $stmt = $db->prepare('SELECT * FROM user_skills WHERE u_id = ?');
    $stmt->execute(array($user['id']));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Getting user researches
 * @param $db
 * @param $user
 * @return mixed
 */
function get_user_researches($db, $user) {
    $stmt = $db->prepare('SELECT * FROM user_researches WHERE u_id = ?');
    $stmt->execute(array($user['id']));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


/**
 * Check can user follow or not
 * @param $db
 * @param $user - user who wants to follow
 * @param $follow_id - user to follow
 * @return bool
 */
function can_follow($db, $user, $follow_id) {
    if($user['id'] == $follow_id) {
        return false;
    }
    $stmt = $db->prepare('SELECT * FROM users_followers WHERE user_id = ? AND follow_id = ?');
    $stmt->execute(array($user['id'], $follow_id));
    return !count($stmt->fetchAll(PDO::FETCH_ASSOC));
}

/**
 * Check new message and retun length of new messages
 * @param $db
 * @param $user
 * @return mixed
 */
function new_message_came($db, $user) {
    $stmt = $db->prepare('SELECT * FROM messages WHERE to_id = ? AND seen = 0');
    $stmt->execute(array($user['id']));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Get all user messages
 * @param $db
 * @param $user
 * @param int $type_id
 * @return mixed
 */
function get_list_user_messages($db, $user, $type_id=1) {
    $stmt = $db->prepare('SELECT messages.*, users.first_name, users.last_name FROM alerts 
        INNER JOIN messages on messages.id = alerts.message_id
        INNER JOIN users on messages.from_id = users.id
        WHERE alerts.user_id = ? AND seen=1 AND type_id = ?');
    $stmt->execute(array($user['id'], $type_id));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


/**
 * Updating messages for user - it sets them as `seen`
 * @param $db
 * @param $user
 */
function update_user_messages($db, $user) {
    $stmt = $db->prepare('UPDATE messages SET seen=1 WHERE to_id = ?');
    $stmt->execute(array($user['id']));
}


/**
 * Adding a message. Will add it when you click on write to some of user
 * @param $db
 * @param $current_user
 * @param $to
 * @param $text
 */
function add_message($db, $current_user, $to, $text) {
    // Create message
    $stmt = $db->prepare('INSERT INTO messages(text, from_id) VALUES(?, ?)');
    $stmt->execute(array($text, $_SESSION['user']['id']));
    // Create an alert
    $message_id = $db->lastInsertId();

    $stmt = $db->prepare('INSERT INTO alerts(type_id, message_id, user_id) VALUES(1, ?, ?)');
    $stmt->execute(array($message_id, $to['id']));


    $stmt = $db->prepare('INSERT INTO messages(text, from_id) VALUES(?, ?)');
    $stmt->execute(array('You have new message!', $_SESSION['user']['id']));
    // Create an alert
    $message_id = $db->lastInsertId();

    $stmt = $db->prepare('INSERT INTO alerts(type_id, message_id, user_id) VALUES(2, ?, ?)');
    $stmt->execute(array($message_id, $to['id']));
}

/**
 * Get number of user projects - just a number (1, 15 etc)
 * @param $db
 * @param $user
 * @return int
 */
function get_user_num_projects($db, $user) {
    $stmt = $db->prepare('SELECT * FROM projects WHERE user_id = ?');
    $stmt->execute(array($user['id']));
    return count($stmt->fetchAll(PDO::FETCH_ASSOC));
}


/**
 * Get num of users who follow
 * @param $db
 * @param $user
 * @return int
 */
function get_user_num_following($db, $user) {
    $stmt = $db->prepare('SELECT * FROM users_followers WHERE user_id = ?');
    $stmt->execute(array($user['id']));
    return count($stmt->fetchAll(PDO::FETCH_ASSOC));
}

/**
 * Get number of researches
 * @param $db
 * @param $user
 * @return int
 */
function get_user_num_researches($db, $user) {
    $stmt = $db->prepare('SELECT * FROM user_researches WHERE u_id = ?');
    $stmt->execute(array($user['id']));
    return count($stmt->fetchAll(PDO::FETCH_ASSOC));
}


/**
 * Getting number of skills
 * @param $db
 * @param $user
 * @return int
 */
function get_user_num_skills($db, $user) {
    $stmt = $db->prepare('SELECT * FROM user_skills WHERE u_id = ?');
    $stmt->execute(array($user['id']));
    return count($stmt->fetchAll(PDO::FETCH_ASSOC));
}

/**
 * Getting number of followers
 * @param $db
 * @param $user
 * @return int
 */
function get_user_num_followers($db, $user) {
    $stmt = $db->prepare('SELECT * FROM users_followers WHERE follow_id = ?');
    $stmt->execute(array($user['id']));
    return count($stmt->fetchAll(PDO::FETCH_ASSOC));
}

/**
 * Checking for some alerts/messages and return number of them.
 * @param $db
 * @param $user
 * @return int
 */
function new_alert_count($db, $user) {
    $stmt = $db->prepare('SELECT  messages.text FROM alerts INNER JOIN messages ON messages.id = alerts.message_id WHERE seen = 0 AND user_id = ? AND type_id=2');
    $stmt->execute(array($user['id']));
    return count($stmt->fetchAll(PDO::FETCH_ASSOC));
}


/**
 * Clear all alerts.
 * @param $db
 * @param $user
 */
function clear_user_alerts($db, $user) {
    $stmt = $db->prepare('UPDATE alerts SET seen=1 WHERE user_id = ?');
    $stmt->execute(array($user['id']));
}

/**
 * Check for recommend. If you can - it will show reccomend, if no - unrecomend.
 * @param $db
 * @param $user
 * @param $project_id
 * @return bool
 */
function i_can_reccomend($db, $user, $project_id) {
    $stmt = $db->prepare('SELECT * FROM project_recomendations WHERE user_id = ? AND  project_id = ?');
    $stmt->execute(array($user['id'], $project_id));
    return count($stmt->fetchAll(PDO::FETCH_ASSOC)) == 0;
}

/**
 * Getting list of followers of user.
 * @param $db
 * @param $user
 * @return mixed
 */
function get_user_followers($db, $user) {
    $stmt = $db->prepare('SELECT * FROM users_followers WHERE follow_id = ?');
    $stmt->execute(array($user['id']));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * It hides a line for project (show/hide function)
 * @param $project
 * @return string
 */
function hide_project($project) {
    if((bool) $project['is_hidden']) {
        return 'style="display:none"';
    }
}