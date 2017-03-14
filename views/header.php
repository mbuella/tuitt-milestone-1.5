<header class="container">
	<div>
		<img src="images/title.png" class="img-responsive">
	</div>
	<nav class="navbar">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
	        <i class="fa fa-bars fa-2x" aria-hidden="true"></i>
	      </button>
	    </div>
	    <div class="collapse navbar-collapse" id="myNavbar">
	      <ul class="nav navbar-nav">
	        <li class="active"><a href="index.php">Vins</a></li>
	        <li><a href="jeux.php">Jeux</a></li>
	        <li><a href="findus.php">Find Us</a></li> 
	      </ul>
			<ul class="nav navbar-nav navbar-right">
			<?php
				//display this alert if a cart is existing
				if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0):
			?>
				<li>
					<a class="btn btn-info navbar-btn" style="padding: 6px;display: block;margin: 8px;" href="cart.php">						
						<span class="fa fa-shopping-cart"></span>
						Cart
						<span class="badge"><?= count($_SESSION['cart']) ?></span>
					</a>
				</li>
			<?php
				else:
					//need to delete the cart once it empties
					unset($_SESSION['cart']);
				endif;
			?>
				<li role="separator" class="divider"></li>
				<li class="dropdown">
			<?php
				//Display this menu when a user is logged in
				if (isset($_SESSION['user'])):
			?>

					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						<span class="fa fa-user-circle">
						</span>
						<?php echo $_SESSION['user']['username'] ?>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
							<!-- Name and some Picture here -->
						<li><a href="profile.php">
							<span class="fa fa-user">
							</span>
							Profile
						</a></li>
					<?php if($_SESSION['user']['role'] == 'regular'):?>
						<li><a href="#">
							<span class="fa fa-glass">
							</span>
							My wines
						</a></li>
					<?php endif; ?>
						<li role="separator" class="divider"></li>
						<li><a href="index.php?signout">
							<span class="fa fa-sign-out">
							</span>
							Sign out
						</a></li>
					</ul>

			<?php else: ?>
					<a href="members.php">
						<span class="fa fa-user">
						</span>	
						Login
					</a>
			<?php endif; ?>
				</li>
			</ul>
	    </div>
	  </div>
	</nav>
</header>