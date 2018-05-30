<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Project title</title>
    <link rel="stylesheet" href="/StarAdmin-Free-Bootstrap-Admin-Template/node_modules/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="/StarAdmin-Free-Bootstrap-Admin-Template/node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css" />
    <link rel="stylesheet" href="/StarAdmin-Free-Bootstrap-Admin-Template/node_modules/flag-icon-css/css/flag-icon.min.css" />
    <link rel="stylesheet" href="/StarAdmin-Free-Bootstrap-Admin-Template/css/style.css" />
    <link rel="shortcut icon" href="/StarAdmin-Free-Bootstrap-Admin-Template//StarAdmin-Free-Bootstrap-Admin-Template/images/favicon.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-date-range-picker/0.16.1/daterangepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
<div class=" container-scroller">
    <nav class="navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="bg-white text-center navbar-brand-wrapper">
            <a class="navbar-brand brand-logo" href="/index.php"><img src="/StarAdmin-Free-Bootstrap-Admin-Template/images/logo_star_mini.jpg" /></a>
            <a class="navbar-brand brand-logo-mini" href="/index.php"><img src="/StarAdmin-Free-Bootstrap-Admin-Template/images/logo_star_mini.jpg" alt=""></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center">
            <button class="navbar-toggler navbar-toggler d-none d-lg-block navbar-dark align-self-center mr-3" type="button" data-toggle="minimize">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php
                $stmt = $db->prepare('SELECT users.*, GROUP_CONCAT(DISTINCT user_skills.skill SEPARATOR ", ") as skills, GROUP_CONCAT(DISTINCT user_researches.research SEPARATOR ", ") as interests FROM 
                        users 
                        LEFT JOIN user_researches ON users.id = user_researches.u_id
                        LEFT JOIN user_skills ON users.id = user_skills.u_id
                        WHERE users.username <> "Admin" GROUP BY users.id');
                $stmt->execute();
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $users_json = json_encode(array_map(function($v) {
                    return array('value' => $v['first_name'].' '.$v['last_name'], 'id' => $v['id']);
                }, $rows));
            ?>
            <form class="form-inline mt-2 mt-md-0 d-none d-lg-block">
                <input class="form-control mr-sm-2 search user-search" type="text" placeholder="Search">
            </form>
            <ul class="navbar-nav ml-lg-auto d-flex align-items-center flex-row">
                <li class="nav-item">
                    <a class="nav-link" href="/notifications.php" style="color: #58d8a3;">
                        <i class="fa fa-envelope fa-fw"></i>(<?=new_alert_count($db, $_SESSION['user'])?>)
                    </a>
                </li>
                <li class="nav-item">
                    <?php if(!empty($_SESSION['user']['image'])): ?>
                        <a class="nav-link profile-pic" href="/profile.php?id=<?=$_SESSION['user']['id'] ?>"><img class="rounded-circle" src="/img/users/<?= $_SESSION['user']['image'] ?>" alt=""></a>
                    <?php else: ?>
                        <a class="nav-link profile-pic" href="/profile.php?id=<?=$_SESSION['user']['id'] ?>"><img class="rounded-circle" src="/img/users/user2.jpg" alt=""></a>
                    <?php endif; ?>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout.php">Logout</a>
                </li>
            </ul>
            <button class="navbar-toggler navbar-dark navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid">
        <div class="row row-offcanvas row-offcanvas-right">
            <!-- partial:partials/_sidebar.html -->
            <nav class="bg-white sidebar sidebar-offcanvas" id="sidebar">
                <div class="user-info">
                    <img src="/img/users/<?= $_SESSION['user']['image'] ?>" alt="">
                    <p class="name"><?= $_SESSION['user']['first_name'].' '.$_SESSION['user']['last_name'] ?></p>
                    <p class="designation"><?= $_SESSION['user']['position'] ?></p>
                    <span class="online"></span>
                </div>
                <ul class="nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="/index.php">
                            <img src="/StarAdmin-Free-Bootstrap-Admin-Template/images/icons/1.png" alt="">
                            <span class="menu-title">Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/messages.php">
                            <img src="/StarAdmin-Free-Bootstrap-Admin-Template/images/icons/2.png" alt="">
                            <span class="menu-title">Messages</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/notifications.php">
                            <img src="/StarAdmin-Free-Bootstrap-Admin-Template/images/icons/2.png" alt="">
                            <span class="menu-title">Notifications</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/profile.php?id=<?= $_SESSION['user']['id'] ?>">
                            <img src="/StarAdmin-Free-Bootstrap-Admin-Template/images/icons/005-forms.png" alt="">
                            <span class="menu-title">Profile</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/users.php">
                            <img src="/StarAdmin-Free-Bootstrap-Admin-Template/images/icons/005-forms.png" alt="">
                            <span class="menu-title">Users</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/jobs.php">
                            <img src="/StarAdmin-Free-Bootstrap-Admin-Template/images/icons/4.png" alt="">
                            <span class="menu-title">Jobs</span>
                        </a>
                    </li>
                </ul>
            </nav>