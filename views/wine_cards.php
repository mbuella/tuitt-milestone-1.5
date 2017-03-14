<ul class="list-group prod-cards col-md-4 col-sm-4 col-xs-12">
  <li class="list-group-item item-img">
  	<img src="<?php echo 'images/wines/' . $prod_range[$i]['image'] ?>" class="img-responsive">
  </li>
  <li class="list-group-item item-name-origin">
  	<h4>
  		<strong><?php echo $prod_range[$i]['name'] ?></strong>
		</h4>
  	<em><?php echo $prod_range[$i]['origin'] ?></em>
  </li><!-- 
  <li class="list-group-item item-price ">
  	<?php echo $prod_range[$i]['price'] ?>
  </li> -->
  <li class="list-group-item item-desc text-left">
  	<?php echo return_truncated($prod_range[$i]['desc']) ?>
  </li>
  <li class="list-group-item"> 
	  		<!-- <a href="wine.php?wine=<?php echo base64_encode($prod_range[$i]['name']) ?>" class="btn btn-info">Read more</a> -->
  		<button 
  			class="btn btn-info load-wine"
  			data-target="#wineModal"
  			data-toggle="modal"
  			value="<?php echo base64_encode($prod_range[$i]['name']) ?>">
  			Read more
			</button> 
  </li>
</ul>

