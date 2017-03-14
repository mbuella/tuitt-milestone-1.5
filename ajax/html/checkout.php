<div class="modal-dialog">
    <div class="modal-content">
    	<div class="modal-header">
			<h3 id="myModalLabel">Your Ordered Wines</h3>
    	</div>
    	<div class="modal-body">

                    <div class="items">
                        <div class="col-md-8">
                            <?php
                                $total = 0;
                                foreach ($cart as $wine_name => $qty):
                                    $wine = getWineRecord($wine_name);
                                    $subtotal = $wine['price'] * $qty;
                            ?>
                        	<table class="table table-striped">
                                <tr>
                                    <td>
                                        <b><?= $wine['name'] ?></b>
                                    </td>
                                    <td class="checkout-subtotal">
                                    	$<?= number_format($subtotal,2,'.',',') ?>
                                	</td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                        	<i class="glyphicon glyphicon-map-marker"></i>
                                            <?= $wine['origin'] ?>
    				                    </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                        	<i class="glyphicon glyphicon-usd"></i>
                                            <?= $wine['price'] ?>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                        	<i class="glyphicon glyphicon-glass"></i>
                                            <?= $qty ?> bottles
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <?php
                                $total += $subtotal;
                                endforeach;
                            ?>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center">
                                <h3>Order Total</h3>
                                <h3>
                                    <span style="color:green;">
                                    $<?= number_format($total,2,'.',',') ?>
                                    </span>
                                </h3>
                            </div>
                        </div>
    					<div class="clearfix"></div>
                    </div>
                    <div class="checkout-confirm">
                        <button type="button" class=" btn btn-danger" name="checkout_cancel" data-dismiss="modal" aria-hidden="true">
                            <i class="fa fa-times"></i>
                            <span class="hidden-xs">Back to Cart</span>
                        </button>
                        <button type="submit" class="btn btn-success" name="checkout_go">
                            <i class="fa fa-money"></i>
                            <span class="hidden-xs">Confirm Checkout</span>
                        </button>
                    </div>

    	</div>
    </div>
</div>