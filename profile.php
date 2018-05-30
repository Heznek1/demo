<?php
// getting user id from url
// if no there - redirect it to index page
$user_id = $_GET['id'];
if(!$user_id) {
   header('Location: /index.php');
}
// Include all required files:
// config - for configuration variables. They will be used later
// functions - for functions
// connect - for connect to db
// session - for checking user in session
require_once 'config.php';
require_once 'functions.php';
require_once 'connect.php';
require_once 'session.php';
// Getting user
$stmt = $db->prepare('SELECT * FROM users WHERE id = ?');
$stmt->execute(array($user_id));
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
// If no user - redirect to login
if(empty($rows)) {
   header('Location: /index.php');
}

$user = $rows[0];

// Num of following and projects
$num_projects = get_user_num_projects($db, $user);
$num_following = get_user_num_following($db, $user);
// Num of skills and researches to display
$num_researches = get_user_num_researches($db, $user);
$num_skills =  get_user_num_skills($db, $user);
// Number of followers
$num_followers = get_user_num_followers($db, $user);
// Getting list of skills
$skills_stmt = $db->prepare('SELECT * FROM user_skills WHERE u_id   = ?');
$skills_stmt->execute(array($user_id));
$skills = $skills_stmt->fetchAll(PDO::FETCH_ASSOC);
// Getting list of researches
$researches_stmt = $db->prepare('SELECT * FROM user_researches WHERE u_id   = ?');
$researches_stmt->execute(array($user_id));
$researches = $researches_stmt->fetchAll(PDO::FETCH_ASSOC);
// Getting user projects (without following)
$stmt = $db->query("SELECT projects.*, users.last_name, users.first_name, 
        researches.start as research_start_date, 
        researches.end as research_end_date, 
        COUNT(project_recomendations.id) as recomend_count
        FROM projects
        INNER JOIN researches on projects.research_id = researches.id
        INNER JOIN users on projects.user_id = users.id 
        LEFT JOIN project_recomendations on project_recomendations.project_id = projects.id
        WHERE projects.user_id = ({$user['id']}) GROUP BY projects.id");
$stmt->execute();
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

// If it's edit on form
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $position = @$_POST['position'];

    // If there an image - move it to local folder and save to db.
    if(!empty($_FILES['image']['name'])) {
        $target_dir = "img/users/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["image"]["tmp_name"]);

        if($check !== false) {
            if(!file_exists($target_file)) {

            }
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
            $stmt = $db->prepare('UPDATE users SET image = ? WHERE id = ?');
            $stmt->execute(array($_FILES["image"]["name"], $user_id));
        }
    }

    // If there position
    if($position or $target_dir) {
        if($position) {
            $stmt = $db->prepare('UPDATE users SET position = ? WHERE id = ?');
            $stmt->execute(array($position, $user_id));
        }

        $stmt = $db->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute(array($user_id));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(!count($rows)) {
            header('Location: /index.php');
        }

        $user = $rows[0];
        $_SESSION['user'] = $user;
    }
}

// If it's not edit - show html
require_once 'header.php';
?>

<!-- page content -->
<div class="content-wrapper">
            <div class="row mb-2">
                <div class="col-lg-6 mb-4">
                    <div class="page-title">
                        <div class="title_left">
                            <h3><?= $user['first_name'].' '.$user['last_name'] ?></h3>
                        </div>
                    </div>
                  <div class="profile_img">
                    <div id="crop-avatar">
                      <!-- Current avatar -->
                      <?php
                          if(!empty($user['image'])) {
                            $src = '/img/users/'.$user['image'];
                          } else {
                            $src = '/img/profile.png';
                          }
                      ?>
                      <img style="max-width: 200px;" class="img-responsive avatar-view" src="<?= $src ?>" alt="Avatar" title="Change the avatar">
                    </div>
                  </div>

                  <ul class="list-unstyled user_data">
                    <li>
                       <h2><?= $user['position'] ?></h2>
                    </li>
                    <li>
                      <strong><?= $user['location'] ?></strong>
                    </li>
                  </ul>

                  <?php if(can_follow($db, $_SESSION['user'], $user['id'])) {?>
                    <a class="btn btn-success" href="/users.php?action=follow&id=<?= $user['id'] ?>">Follow user</a>
                    <br>
                    <br>
                  <?php } else if($_SESSION['user']['id'] != $user['id']) {?>
                      <a href="/users.php?action=unfollow&id=<?= $user['id'] ?>" class="btn btn-success">Unfollow</a>
                      <br>
                      <br>
                    <?php
                    }
                    ?>
                    <?php if($_SESSION['user']['id'] != $user['id']) { ?>
                        <a class="btn btn-success" href="/messages.php?action=write&id=<?= $user['id'] ?>">Write a message</a>
                    <?php } ?>
                  <br>
                </div>
                <div class="col-lg-6 mb-4">
                        <ul>
                            <li><?= $num_projects ?> Projects</li>
                            <li><?= $num_following ?> Following</li>
                            <li><?= $num_researches ?> Researches</li>
                            <li><?= $num_skills ?> Skills</li>
                            <li><?= $num_followers ?> Followers</li>
                        </ul>

                            <?php if($user['id'] == $_SESSION['user']['id']): ?>
                            <h2>Update user</h2>
                            <form enctype="multipart/form-data" method="post" action="/profile.php?id=<?= $user['id'] ?>">
                                <div class="form-group">
                                    <input class="form-control" type="file" name="image" value="" />
                                </div>

                                <div class="form-group">
                                    <input type="text" placeholder="Position..." value="<?= $user['position'] ?>" name="position" class="form-control">
                                </div>

                                <div class="form-group">
                                    <input type="submit" class="btn btn-success" value="Update">
                                </div>
                            </form>
                            <?php endif ?>

                            <hr>

                            <h2>Skills</h2>
                            <br>

                            <?php if(count($skills ) > 0): ?>
                                <div class="table-responsive">
                                    <table>
                                        <tbody>
                                        <?php
                                            foreach($skills as $skill) {
                                                echo '<tr>
                                                    <td>'.$skill['skill'].'</td>
                                                    <td>&nbsp;</td>';
                                                if($user['id'] == $_SESSION['user']['id'])
                                                    echo '<td><a class="btn btn-danger" href="/skills.php?action=delete&id='.$skill['id'].'">Delete</a></td>';
                                                echo '</tr>';
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                                <br>
                            <?php endif ?>

                            <?php if($user['id'] == $_SESSION['user']['id']): ?><button data-toggle="modal" data-target="#addNewSkillModal" class="btn btn-success">Add new</button> <?php endif ?>
                            <br>
                            <br>

                            <hr>

                            <h2>Research interests</h2>

                            <?php if(count($researches ) > 0): ?>
                                <div class="table-responsive">
                                    <table>
                                        <tbody>
                                        <?php
                                        foreach($researches as $research) {
                                            echo '<tr>
                                                    <td>'.$research['research'].'</td>
                                                    <td>&nbsp;</td>';
                                            if($user['id'] == $_SESSION['user']['id'])
                                                echo '<td><a class="btn btn-danger" href="/researches.php?action=delete&id='.$research['id'].'">Delete</a></td>';
                                            echo '</tr>';
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                                <br>
                            <?php endif ?>

                            <?php if($user['id'] == $_SESSION['user']['id']): ?>
                                <button data-toggle="modal" data-target="#addNewResearchModal" class="btn btn-success">Add new</button>
                            <?php endif; ?>
                            <br>
                            <br>
                    </div>
             </div>
            <div class="row mb-2">
                <div class="col-lg-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Projects</h5>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Date published</th>
                                        <th>Research start date</th>
                                        <th>Research end date</th>
                                        <th>Author name</th>
                                        <th>Recomandations</th>
                                        <th>Number or reads</th>
                                        <th>Reccomend</th>
                                        <th>Hide/Show</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach($projects as $project) {
                                        ?>
                                        <tr>
                                            <td <?= hide_project($project); ?>><a href="/projects.php?action=view&id=<?=$project['id']?>"><?= $project['name'] ?></a></td>
                                            <td <?= hide_project($project); ?>><?= $project['description'] ?></td>
                                            <td <?= hide_project($project); ?>><?= $project['date'] ?></td>
                                            <td <?= hide_project($project); ?>><?= $project['research_start_date'] ?></td>
                                            <td <?= hide_project($project); ?>><?= $project['research_end_date'] ?></td>
                                            <td <?= hide_project($project); ?>><?= $project['first_name'].' '.$project['last_name'] ?></td>
                                            <td <?= hide_project($project); ?>><?= isset($project['recomend_count']) ? $project['recomend_count'] : 0 ?></td>
                                            <td <?= hide_project($project); ?>><?= $project['reads'] ?></td>
                                            <td <?= hide_project($project); ?>>
                                                <?php if(i_can_reccomend($db, $_SESSION['user'], $project['id'])) {?>
                                                    <a href="/projects.php?action=reccomend&id=<?=$project['id']?>" class="btn btn-success">Reccomend</a>
                                                <?php } else { ?>
                                                    <a href="/projects.php?action=unreccomend&id=<?=$project['id']?>" class="btn btn-danger">Unrecomend</a>
                                                <?php }?>
                                            </td>
                                            <td>
                                                <?php
                                                if((bool) $project['is_hidden']) {
                                                    echo '<a class="btn btn-success" href="/projects.php?action=show&id='.$project['id'].'">Show</a>';
                                                } else {
                                                    echo '<a class="btn btn-success" href="/projects.php?action=hide&id='.$project['id'].'">Hide</a>';
                                                }
                                                ?>

                                            </td>
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
</div>
<!-- /page content -->


    <?php if($user['id'] == $_SESSION['user']['id']) { ?>
        <div class="modal fade" id="addNewSkillModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form method="post" action="/skills.php?action=add&user_id=<?=$user['id']?>">
                            <input type="text" name="skill" value="" placeholder="" class="form-control"/>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="addNewResearchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form method="post" action="/researches.php?action=add&user_id=<?=$user['id']?>">
                            <input type="text" name="research" value="" placeholder="" class="form-control"/>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>



<?php require_once 'footer.php' ?>