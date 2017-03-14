<main class="container checkout-success">
	<div class="row text-center">
        <div class="col-md-12 col-xs-12">
            <h2>Oh yeah!</h2>
            <i class="fa fa-check-circle-o fa-5x" style="font-size: 10em; color: green"></i>
        <?php
            if (isset($_SESSION['user'])):
        ?>
            <h3>Dear <?php
                        if($_SESSION['user']['firstname'] === '')
                            echo $_SESSION['user']['username'];
                        else
                            echo $_SESSION['user']['firstname'];
                     ?>,
             </h3>
        <?php
            else:
        ?>
            <h3>Thank you for checking us out!</h3>
        <?php endif; ?>
                <p style="font-size:20px;color:#5C5C5C;">
                    Your purchase has been accepted and recorded by our system. It's time to drink it on!
                </p>
                <a href="index.php" class="btn btn-info">More wines please!</a>
        </div>        
	</div>
</main>