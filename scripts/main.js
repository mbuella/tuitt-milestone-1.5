//jQuery

$(document).ready(function () {
	$('[data-toggle="tooltip"]').tooltip();

	//trigger .load-wine button press
    $("button.load-wine").click(function(e){
    	$("#wineModal").load('ajax/html/ajaxDefault.html');

        $.post("vins_lib.php",
        {
          wine_name: $(this).val()
        },
        function(data,status){
        	//delay display of data for at least 1 sec (1000 ms)
            $("#wineModal").delay(1000).queue(function(next) {
            	$(this).html(data);
            	next();
            });
        });
    });

    	//trigger .load-wine button press
    $("button#checkout_action").click(function(e){
    	$("#checkoutModal").load('ajax/html/ajaxDefault.html');

        $.post("vins_lib.php",{
        	loadCart: true
        },
        function(data,status){
        	//delay display of data for at least 1 sec (1000 ms)
            $("#checkoutModal").delay(1000).queue(function(next) {
            	$(this).html(data);
            	next();
            });
        });
    });

    $(".wine-delete").click(function(e){
    	var conf = confirm("Do you really want to delete this item?");
		if( conf == true ){
			return true;
		}
		else{
			return false;
		}
    });

    $(".cart-clear").click(function(e){
    	var conf = confirm("Do you really want to empty your cart?");
		if( conf == true ){
			return true;
		}
		else{
			return false;
		}
    });
});