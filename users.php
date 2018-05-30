<?php
    // Include all required files:
    // config - for configuration variables. They will be used later
    // functions - for functions
    // connect - for connect to db
    // session - for checking user in session
    // header - to show header html.
	require_once 'config.php';
	require_once 'functions.php';
	require_once 'connect.php';
	require_once 'session.php';

	$stmt = $db->prepare('SELECT users.*, GROUP_CONCAT(DISTINCT user_skills.skill SEPARATOR ", ") as skills, GROUP_CONCAT(DISTINCT user_researches.research SEPARATOR ", ") as interests FROM 
        users 
        LEFT JOIN user_researches ON users.id = user_researches.u_id
        LEFT JOIN user_skills ON users.id = user_skills.u_id
        WHERE users.username <> "Admin" GROUP BY users.id');
	$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

	// if there is some action(follow) - do this action
	if(array_key_exists('action', $_GET)) {
	    $action = $_GET['action'];
	    if($action == 'follow') {
	        if(array_key_exists('id', $_GET) && !empty($_GET['id'])) {
                $stmt = $db->prepare('INSERT INTO users_followers(user_id, follow_id) VALUES(?, ?)');
                $stmt->execute(array($_SESSION['user']['id'], $_GET['id']));

                // Create message
                $stmt = $db->prepare('INSERT INTO messages(text, from_id) VALUES(?, ?)');
                $stmt->execute(array('You have new follower!', $_SESSION['user']['id']));

                // Create an alert
                $message_id = $db->lastInsertId();
                $stmt = $db->prepare('INSERT INTO alerts(type_id, message_id, user_id) VALUES(2, ?, ?)');
                $stmt->execute(array($message_id, $_GET['id']));
                header('Location: '.$_SERVER['HTTP_REFERER']);
                exit();
            }
        } else if($action == 'unfollow') {
            if(array_key_exists('id', $_GET) && !empty($_GET['id'])) {
                $stmt = $db->prepare('DELETE FROM users_followers WHERE follow_id = ? AND user_id = ?');
                $stmt->execute(array($_GET['id'], $_SESSION['user']['id']));
                header('Location: '.$_SERVER['HTTP_REFERER']);
                exit();
            }
        }
    }

    require_once 'header.php';
    // If no action - display html
?>

<div class="content-wrapper">
    <form action="/projects.php" method="get">
        <div class="input-group">
            <input type="text" name="search" class="form-control p-input user-search" />
        </div>
    </form>
    <br>
    <br>
	<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Users</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="table-responsive">
                  	<table class="table">
                      <thead>
                        <tr>
                          <th>Username</th>
                          <th>First name</th>
                          <th>Last name</th>
                          <th>Position</th>
                          <th>Skills</th>
                          <th>Research interests</th>
                        </tr>
                      </thead>
                      <tbody>
                  	<?php
                  		foreach($rows as $user) {
                  			?>
                  				<tr>
			                          <td><a href="/profile.php?id=<?= $user['id'] ?>"><?= $user['username'] ?></a></td>
			                          <td><?= $user['first_name'] ?></td>
			                          <td><?= $user['last_name'] ?> </td>
			                          <td><?= $user['position'] ?></td>
			                          <td><?= $user['skills'] ?></td>
			                          <td><?= $user['interests'] ?></td>
                        		</tr>
							<?php
                  		}
                  	?>  
                      </tbody>
                    </table>
                    </div>
                  
                  </div>
                </div>
              </div>
</div>

<?php

$scripts = '<script src="/js/users.js"></script>';

require_once 'footer.php'

?>



