<main class="container">
	<div class="row">
		<div class="col-md-9 col-sm-12 col-xs-12" id="main-left">
			<div class="col-md-4 col-sm-2 col-xs-12">
				<h3>
					Wines
				</h3>
			</div>
			<div class="col-md-8 col-sm-10 col-xs-12"> 
				<div id="search-wine">
					<div class="input-group col-md-12 col-sm-12">
						<input type="text" class="form-control" placeholder="Find wines..." />
						<span class="input-group-btn">
							<button class="btn btn-default" type="submit">
								<span class="fa fa-search"></span>
							</button>
						</span>
					</div>
				</div>
			</div>
			<?php
				//display this alert if a cart is existing
				if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0):
			?>
			<div class="col-md-12 col-sm-12 col-xs-12 cart-alert">
				<div class="alert alert-info" role="alert">
					<div class="col-md-10 col-sm-10 col-xs-12">
						<h5>You have <?= count($_SESSION['cart']) ?> items in your cart.</h5>						
					</div>
					<div class="col-md-2 col-sm-2 col-xs-12">
						<a class="btn btn-success btn-sm" href="cart.php">View cart</a>						
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<?php
				else:
					//need to delete the cart once it empties
					unset($_SESSION['cart']);
				endif;
			?>
<!-- 			<div class="col-md-2">
				<div class="add-wine">
					<a href="#" class="btn btn-warning">Add Wine</a>
				</div>	
			</div> -->
			<div class="clearfix"></div>
			<?php
				/*Assume item count per page is 3*/
				$maxItems = 3;
				$currPage = 1; //page1 on first load
				if (isset($_GET['page']))
					$currPage = $_GET['page'];

				display_items(getWines(),$currPage, $maxItems);
			?>
				<?php
					if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin'):
				?>
			<div class="col-md-12 col-sm-12 col-xs-12 text-center">	
				<a href="add_wine.php" class="btn btn-warning">Add Wine</a>
			</div>
				<?php
					endif;
				?>

			<!-- Pagination -->
			<div class="col-md-12 col-sm-12 col-xs-12 text-center">
				<ul class="pagination">
					<?php
						if ($currPage == 1) //disable previous button at the start of the page
							echo "<li class='disabled'><a>";
						else
							echo "<li><a href='index.php?page=" . ($currPage - 1) ."'>";
					?>
							<span class="fa fa-chevron-left"></span>
						</a>
					</li>
					<?php
						$maxPageCnt = ceil(count(getWines())/$maxItems);
						for ($pg=1; $pg <= $maxPageCnt; $pg++) { 
							echo "<li";
							if ($pg == $currPage) { //set the link as colored and non-clickable
								echo " class='active'><a>";
							}
							else
								echo "><a href='index.php?page={$pg}'>";
							//echo the rest of the tag
							echo "$pg</a></li>";
						}
					?>
					<?php
						if ($currPage == $maxPageCnt) //disable previous button at the start of the page
							echo "<li class='disabled'><a>";
						else
							echo "<li><a href='index.php?page=" . ($currPage + 1) ."'>";
					?>
							<span class="fa fa-chevron-right"></span>
						</a>
					</li>
				</ul>				
			</div>
		</div>
		<?php require_once('views/main_right.php') ?>
	</div>
	<div id="wineModal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myModalLabel" aria-hidden="true">
		<!-- Modal content here -->
	</div>
</main>