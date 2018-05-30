<?php
    update_user_messages($db, $_SESSION['user']);
?>


<div class="content-wrapper">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Messages</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>From</th>
                            <th>Date</th>
                            <th>Text</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach(get_list_user_messages($db, $_SESSION['user']) as $message) {
                            ?>
                            <tr>
                                <td><a href="/profile.php?id=<?= $message['from_id'] ?>"><?= $message['first_name'].' '.$message['last_name'] ?></a></td>
                                <td><?= $message['date'] ?></td>
                                <td><?= $message['text'] ?> </td>
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



