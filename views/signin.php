<main class="container">
	<div class="row">
		<div class="col-md-6 col-sm-6 hidden-xs signin-image">
			<img src="images/wine_quote1.jpg" class="img-responsive img-thumbnail">
		</div>
		<div class="col-md-6 col-sm-6">

	      <form class="form-signin" method="POST">
	        <h3 class="form-signin-heading text-center">Please sign in</h3>
	        <label for="signin_uname" class="sr-only">Username</label>
	        <input type="text" name="signin_uname" id="signin_uname" class="form-control" placeholder="Username" required autofocus>
	        <label for="signin_pword" class="sr-only">Password</label>
	        <input type="password" name="signin_pword" id="signin_pword" class="form-control" placeholder="Password" required>
	        <div class="checkbox">
	          <label>
	            <input type="checkbox" name="signin_remember" value=1> Remember me
	          </label>
	        </div>
	        <input type="submit" class="btn btn-lg btn-primary btn-block" name="signin_submit" value="Sign in">
	        <a href="#" class="btn btn-link lost-pw-link">Lost Password?</a>
	        <a href="members.php?register" class="btn btn-link reg-link">Register</a>
			<div class="err-msg">
				<?php displayCustomMsg() ?>
			</div>
	      </form>
		</div>
	</div>
</main>