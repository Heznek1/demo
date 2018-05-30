<?php
    $stmt = $db->prepare('SELECT * FROM users WHERE id = ?');
    $stmt->execute(array($id));
    $write_to = $stmt->fetch(PDO::FETCH_ASSOC);
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $current_user = $_SESSION['user'];

        if(!empty($_POST['text'])) {
            add_message($db, $current_user, $write_to, $_POST['text']);
        }
        ob_clean();
        header('Location: /profile.php?id='.$id);
        exit();
    } else {
?>
        <div class="content-wrapper">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Write message to <a
                                href="/profile.php?id=<?= $write_to['id'] ?>"></a><?= $write_to['first_name'] . ' ' . $write_to['last_name'] ?>
                        </h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form id="demo-form2" action='/messages.php?action=write&id=<?= $id ?>' method='post'
                              data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Text
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea type="text" id="last-name" name="text" required="required"
                                      class="form-control col-md-7 col-xs-12">

                            </textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <a class="btn btn-primary" href="/index.php" type="button">Cancel</a>
                                    <button class="btn btn-primary" type="reset">Reset</button>
                                    <button type="submit" class="btn btn-success">Publish</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


<?php
    }
?>
