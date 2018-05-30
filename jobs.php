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
	require_once 'header.php';

	// Fetch all jobs and display them.
	$stmt = $db->prepare('SELECT * FROM jobs WHERE 1');
	$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="content-wrapper">
	<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Jobs</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="table-responsive">
                  	<table class="table">
                      <thead>
                        <tr>
                          <th>Role</th>
                          <th>University</th>
                          <th>Location</th>
                          <th>Date published</th>
                          <th>Description</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                  	<?php
                  		foreach($rows as $job) {
                  			?>
                  				<tr>
			                          <td><?= $job['role'] ?></td>
			                          <td><?= $job['university'] ?></td>
			                          <td><?= $job['location'] ?> </td>
			                          <td><?= $job['date'] ?></td>
			                          <td><?= $job['description'] ?></td>
			                          <td><button disabled class="btn btn-success">Apply</button></td>
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


<?php require_once 'footer.php' ?>