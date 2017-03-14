<main class="container">	
		<form method="POST">
	<div class="row">
			<div class="col-md-12">
				<div class="panel panel-info shopping-cart">
					<div class="panel-heading">
						<div class="panel-title">
							<div class="row">
								<div class="col-xs-8">
									<h5><span class="fa fa-shopping-cart"></span> Shopping Cart</h5>
								</div>
								<div class="col-xs-4">
									<button type="submit" name="back_to_shop" class="btn btn-primary btn-sm btn-block">
										<span class="fa fa-reply"></span>
										<span class="hidden-xs">Back to shop</span>
										<span class="visible-xs">
										</span>
									</button>
								</div>
							</div>
						</div>
					</div>

					<div class="panel-body">
						<?php
							$total = 0;
							if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0):
								foreach ($_SESSION['cart'] as $wineName => $qty):
									$wine = getWineRecord($wineName);
						?>
							<div class="row cart-item">
								<div class="col-md-4 col-sm-4 cart-image">
									<img class="img-responsive" src="images/wines/<?= $wine['image']?>">
								</div>
								<div class="col-md-8 col-sm-8 cart-info">
									<div class="col-md-7 col-sm-12">
										
										<h4 class="product-name">
											<strong>
												<?= $wine['name'] ?>
											</strong>
										</h4>
										<h4>
											<small>From 
												<?= $wine['origin'] ?>
											</small>
										</h4>

									</div>
									<div class="col-md-5 col-sm-12 wine-price">
										
										<strong><?= $wine['price'] ?></strong>
										<span class="text-muted">
											<i class="fa fa-times"></i>
										</span>
										<input type="hidden" name="cart[item][]" value="<?= $wine['name'] ?>">
										<input type="number" name="cart[quantity][]" class="form-control" value=<?= $qty ?> min=1>
										<button type="submit" name="cart_remove" value="<?= $wine['name'] ?>" class="btn btn-danger btn-xs wine-delete" >
											<span class="fa fa-trash" data-original-title="Delete this item." data-toggle="tooltip" data-placement="top"> </span>
										</button>

									</div>
								</div>
							</div>
							<hr>
						<?php
								//add product of price and quantity
								$total += ($wine['price'] * $qty);
								endforeach;
						?>
							<div class="row">
								<div class="text-center">
									<div class="col-md-6 col-sm-6 col-xs-6">
										<div class="col-md-6 col-sm-8 col-xs-10 cart-empty">
											<button type="submit" name="cart_clear" class="btn btn-danger btn-sm btn-block cart-clear">
												<span class="fa fa-trash-o"></span>
												<span class="hidden-xs">
													Empty cart													
												</span>
											</button>											
										</div>
									</div>
									<div class="col-md-6 col-sm-6 col-xs-6">
										<div class="col-md-6 col-sm-8 col-xs-10 cart-update">
											<button type="submit" name="cart_update" class="btn btn-info btn-sm btn-block">
												<span class="fa fa-pencil"></span>
												<span class="hidden-xs">
													Update cart													
												</span>
											</button>
										</div>
									</div>
								</div>
							</div>
					</div>
					<div class="panel-footer total-scn">
						<div class="row text-center">
							<div class="col-md-9 col-xs-12 total-amt">
								<h4>Total:&nbsp;&nbsp;&nbsp; <strong>$ <?= number_format($total,2,'.',',') ?></strong></h4>
							</div>
							<div class="col-md-3 col-xs-12">
								<button type="button"
										class="btn btn-success btn-block"
										name="checkout_action"
										id="checkout_action"
										data-toggle="modal"
										data-target="#checkoutModal">
									Checkout
								</button>
							</div>
						</div>
					</div>
						<?php
							else:
					 			if(isset($_POST['checkout_go']))
									header("Location: checkout_success.php");
								else
									header("Location: index.php");
							endif;
						?>
				</div>
			</div>
	</div>
	<div id="checkoutModal"
		 class="modal fade"
		 tabindex="-1"
		 role="dialog"
		 data-backdrop="static"
		 aria-labelledby="myModalLabel"
		 aria-hidden="true">

	</div>
	</form>
</main>