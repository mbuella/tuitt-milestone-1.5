<main class="container">
	<div class="row">
		
		<div class="col-md-5 col-sm-6">

	      <form class="form-signup" method="POST">
	        <h3 class="form-signup-heading text-center">Please join us here</h3>

	        <label for="signup_uname" class="sr-only">Preferred Username</label>
	        <input type="text" name="signup_uname" id="signup_uname" class="form-control" placeholder="Preferred Username" required autofocus>

        	<label for="signup_pword" class="sr-only">Password</label>
	        <input type="password" name="signup_pword" id="signup_pword" class="form-control" placeholder="Password" required>	 	              
    		<input type="password" name="signup_pword2" id="signup_pword2" class="form-control" placeholder="Confirm Password" required>

	        <input type="submit" class="btn btn-lg btn-primary" name="signup_submit" value="Register">
	        <label class="text-right" style="width: 30px">or</label>
	        <a href="members.php" class="btn btn-link">Signin</a>
	        
			<div class="err-msg">
				<?php displayCustomMsg() ?>
			</div>
	      </form>

		</div>
		<div class="col-md-7 col-sm-6 hidden-xs signup-image">
			<img src="images/wine_quote2.jpg" class="img-responsive img-thumbnail">
		</div>
	</div>
</main>