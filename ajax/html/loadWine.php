<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
				<i class="fa fa-times"></i>
			</button>
			<div class="col-md-12 col-sm-12 col-xs-12 wine-heading">						
				<div class="col-md-8 col-sm-8 col-xs-12">
					<h4><?= $wine['name'] ?></h4>					
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12">
					<?= $wine['origin'] ?>
				</div>
			</div>
		</div>
		<div class="modal-body">


			<div class="col-md-5 col-sm-4 col-xs-12 wine-image text-center">
				<img src="images/wines/<?= $wine['image'] ?>" class="img-responsive img-thumbnail">
			</div>
			<div class="col-md-7 col-sm-8 col-xs-12 wine-info">
				<div class="col-md-12 wine-desc">
					<p>
						<?= $wine['desc'] ?>
						<a href="#">Know more about this wine</a>
					</p>
			<?php
				//Display the following if there's an admin logged in
				if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin') {
					//edit delete item here
					echo <<<EOT
				<h4>Price: $ {$wine['price']}</h4>
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12 wine-admin text-center">
				<div class="col-md-6 col-sm-6 col-xs-12 wine-edit">
					<a href="edit_wine.php?wine={$_POST['wine_name']}" class="btn btn-warning">Edit Wine</a>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 wine-delete">
					<a href="delete_wine.php?wine={$_POST['wine_name']}" class="btn btn-danger">Delete Wine</a>					
				</div>
			</div>
EOT;
				}
				//Display the following if there's no admin logged in
				else {
					echo <<<EOT
			</div>
			<form method="POST">
			<div class="col-md-12 add-to-cart text-center">
				<div class="col-md-12">
					<span>Number of bottles to buy: </span>
					<span class="input-num">
						<input type="number" class="form-control" min=1 max=9999 value="1" name="wine_quantity"></input>
					</span>
				</div>
				<div class="col-md-12">
					<button type="submit" name="add_to_cart" class="btn btn-success btn-sm">
			  			<i class="fa fa-cart-plus"></i>&nbsp;
							Add to Cart
					</button>
				</div>
			</div>
			</form>
EOT;
				} ?>
			</div>
			<div class="clearfix"></div>

		</div>
		<div class="modal-footer">
			<button class="btn btn-info" data-dismiss="modal" aria-hidden="true">Close</button>
		</div>
	</div>
</div>