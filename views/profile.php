<main class="container">
	<div class="panel panel-info user-info">
		<div class="panel-heading">
			<h3 class="panel-title">
				<?php
					if ($_SESSION['user']['firstname'] == "" && $_SESSION['user']['lastname'] == "")
						echo $_SESSION['user']['username'];
					else
						echo $_SESSION['user']['firstname'] . " " . $_SESSION['user']['lastname'];
				?>
			</h3>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-3 col-lg-3 " align="center">
					<img alt="User Pic" src="images/avatar.png" class="img-circle img-responsive">
				</div>

				<div class=" col-md-9 col-lg-9 ">
					<table class="table table-hover">
						<tr>
							<th>Username:</th>
							<td><?php echo $_SESSION['user']['username'] ?></td>
						</tr>
						<tr>
							<th>First Name:</th>
							<td><?php echo $_SESSION['user']['firstname'] ?></td>
						</tr>
						<tr>
							<th>Last Name</th>
							<td><?php echo $_SESSION['user']['lastname'] ?></td>
						</tr>
						<tr>
							<th>Address</th>
							<td><?php echo $_SESSION['user']['address'] ?></td>
						</tr>
						<tr>
							<th>Role</th>
							<td><?php echo $_SESSION['user']['role'] ?></td>
						</tr>
					</table>

				<!--                   <a href="#" class="btn btn-primary">My Sales Performance</a>
				<a href="#" class="btn btn-primary">Team Sales Performance</a> -->
				</div>
				<div class="col-md-12">
                    <span class="pull-right">
                        <a href="#" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning">
                        	<i class="fa fa-edit"></i>
                    	</a>
                        <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger">
                        	<i class="fa fa-times"></i>
                    	</a>
                    </span>
				</div>
			</div>
		</div>
	</div>
</main>
