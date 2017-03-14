<?php
	
	$customMsg = "";

	function getWines() {
		//fetch wine data from the wine json file
		$wines = json_decode(
					file_get_contents("data/wines.json"),
					true
				);
		return $wines;
	}

	function getWineRecord($searchKey) {
		foreach (getWines() as $wine) {
			if ($wine['name'] == $searchKey) {
				return $wine;
			}
		}
		return false;
	}

	function getWineRecIndex($searchKey) {
		foreach (getWines() as $index => $wine) {
			if ($wine['name'] == $searchKey) {
				return $index;
			}
		}		
		return false;
	}

	function loadWine($wine_name) {		
		$wine = getWineRecord(
					base64_decode($wine_name)
				);

		$_SESSION['wine'] = $wine;

		include_once("ajax/html/loadWine.php");
	}

	function addWine() {
		//add the wines into an array
		$newWine = [
			"name" => $_POST['wine_name'],
			"image" => "dummy-wine.jpg",
			"origin" => $_POST['wine_origin'],
			"desc" => $_POST['wine_desc'],
			"price" => $_POST['wine_price']
		];
		//get the existing wines
		$wines = getWines();

		//get the contents of the wine file
		$writeFile = fopen('data/wines.json', "w");
		//add the new user to the users files
		array_push($wines, $newWine);
		//convert userRecord to JSON
		$winesJson = json_encode($wines,JSON_PRETTY_PRINT);
		//write JSON string to file
		fwrite($writeFile, $winesJson);
		//close file
		fclose($writeFile);

		//redirect to homepage
		header('Location: index.php');		
	}

	function editWine() {
				//get the index of the wine
		if (isset($_SESSION['wine_name_long'])) {
			$wineIdx = getWineRecIndex(
						base64_decode($_SESSION['wine_name_long'])
					);
			//add the wines into an array
			$editWine = [
				"name" => $_POST['wine_name'],
				"image" => $_POST['wine_image'],
				"origin" => $_POST['wine_origin'],
				"desc" => $_POST['wine_desc'],
				"price" => $_POST['wine_price']
			];
			//get the existing wines
			$wines = getWines();

			//get the contents of the wine file
			$writeFile = fopen('data/wines.json', "w");
			//replace the current record with the new record
			$wines[$wineIdx] = $editWine;
			//convert userRecord to JSON
			$winesJson = json_encode($wines,JSON_PRETTY_PRINT);
			//write JSON string to file
			fwrite($writeFile, $winesJson);
			//close file
			fclose($writeFile);

			//redirect to homepage
			header('Location: index.php');	
		}
	}

	function deleteWine() {
		//see if the get variable for wine name exist
		if (isset($_GET['wine'])) {
			//get the index of the wine
			$wineIdx = getWineRecIndex(
						base64_decode($_GET['wine'])
					);
			//get the existing wines
			$wines = getWines();

			//get the contents of the wine file
			$writeFile = fopen('data/wines.json', "w");
			//delete the record from the array using the index
			array_splice($wines, $wineIdx, 1);
			//convert userRecord to JSON
			$winesJson = json_encode($wines,JSON_PRETTY_PRINT);
			//write JSON string to file
			fwrite($writeFile, $winesJson);
			//close file
			fclose($writeFile);
		}
	}

	function addToCart() {
		//get the name of the wine;
		$wine_name = $_SESSION['wine']['name'];
		//check if there is a registered user logged in
		// --> LET US NOT THINK ABOUT USERNAMES FOR NOW <--
		//if (!isset($_SESSION['user'])) {
			//generate a random username (string) for
			//unlogged user
			//$username = uniqid('',true);
			//$_SESSION['user']['username'] = $username;
		//}

		//get the cart
		$cart = $_SESSION['cart'];
		//get wine count
		$wine_qty = $_POST['wine_quantity'];
		// detect if the same item already exist in the cart
		if (isset($_SESSION['cart'][$wine_name])) {
			//just add the post quantity to the quantity in the cart
			$_SESSION['cart'][$wine_name] += $wine_qty;
		}
		else {
			//create an array of the selected item to be
			//added to the cart
			$_SESSION['cart'][$wine_name] = intval($wine_qty);
			//current date will also be used at view cart
			//"purchase_date" => date("Y-m-d h:i:sa")
		}
		//redirect to homepage
		header('Location: index.php');
	}

	function updateCart($ucart) {
		//loop through the POST item names
		for ($i=0; $i < count($ucart['item']); $i++) {
			$item = $ucart['item'][$i];
			$newQty = $ucart['quantity'][$i];
			//set the new quantity
			$_SESSION['cart'][$item] = $newQty;
		}
	}

	function deleteCart() {
		//delete the item from the cart
		unset($_SESSION['cart']);		
	}

	function loadCart() {		
		$cart = $_SESSION['cart'];

		include_once("ajax/html/checkout.php");
	}

	function listenCartChanges() {
		if (isset($_SESSION['cart'])) {
			//check if back to shop
			if (isset($_POST['back_to_shop'])) {
				//update cart first
				updateCart($_POST['cart']);
				//redirect to homepage
				header("Location: index.php");
			}

			//check if an item is to be deleted
			if (isset($_POST['cart_remove'])) {
				//detect illegal access to view_cart
				//delete the item from the cart
				unset(
					$_SESSION['cart'][
						$_POST['cart_remove']
					]
				);
			}			

			//check if the cart has updates
			if (isset($_POST['cart_update'])) {
				updateCart($_POST['cart']);
			}

			//check if the cart is to be emptied
			if (isset($_POST['cart_clear'])) {
				//set the cart to empty []
				$_SESSION['cart'] = [];
			}

			//check if to confirm checkout
			if (isset($_POST['checkout_go'])) {
				//record the transaction
				recordTransaction();
				//unset the cart
				deleteCart();
				//redirect to checkout success page
				//redirect not working here!
				//header("Location: checkout_success.php");
			}
		}
	}

	function loadTransactions() {
		//fetch wine data from the wine json file
		$trans = json_decode(
					file_get_contents("data/trans.json"),
					true
				);
		return $trans;
	}

	function recordTransaction() {
		//load transaction file
		//and convert the contents into array
		$trans = loadTransactions();
		//check if there is user logged in
		if (isset($_SESSION['user']))
			$custName = $_SESSION['user']['username'];
		else
			$custName = "guest-" . sprintf("%s", uniqid());

		//get current timestamp
		$transDate = time();

		//	Add values to trans array
		$trans[$custName][$transDate] = $_SESSION['cart'];

		//get the contents of the wine file
		$transFile = fopen('data/trans.json', "w");
		//write JSON string to file
		fwrite(
			$transFile,
			json_encode($trans, JSON_PRETTY_PRINT)
		);
		//close file
		fclose($transFile);
	}

	function getUsers() {
		//fetch user data from the users json file
		$users = json_decode(
					file_get_contents("data/users.json"),
					true
				);
		return $users;
	}

	function getUserRecord($searchKey) {
		foreach (getUsers() as $user) {
			if ($user['username'] == $searchKey) {
				return $user;
			}
		}
	}

	function addUser($userRecord) {
		/* Warning: file exceptions are not handled */
		//get the user data array
		$users = getUsers();
		//open file for writing
		$writeFile = fopen('data/users.json', "w");
		//add the new user to the users files
		array_push($users, $userRecord);
		//convert userRecord to JSON
		$usersJson = json_encode($users,JSON_PRETTY_PRINT);
		//write JSON string to file
		fwrite($writeFile, $usersJson);
		//close file
		fclose($writeFile);
	}

	function return_truncated($text) {
  		$desc_trunc = $text;
		$maxPos = 90;

		if (strlen($desc_trunc) > $maxPos)
		{
		    $lastPos = ($maxPos - 4) - strlen($desc_trunc);
		    $desc_trunc = substr($desc_trunc, 0, strrpos($desc_trunc, ' ', $lastPos)) . '...';
		}

		return $desc_trunc;
	}

	function open_page($page = "") {
		/*** PAGE HEADER ***/
			require_once('views/header.php');

		/*** PAGE BODY ***/
			//if the page is members.php, determine
			//if it is for signin or signup.
			if ($page == 'members.php') {
				if(isset($_GET['register']))
					require_once('views/signup.php');
				else
					require_once('views/signin.php');
			}

			//if it is for a wine deletion			
			else if ($page == 'delete_wine') {
				//perform wine delete
				deleteWine();
				//redirect to homepage
				header("Location: index.php");
			}

			//if it is for a wine edit			
			else if ($page == 'views/edit_wine_form.php') {
				$wine = $_SESSION['wine'];
				require_once($page);
			}

			else
				require_once($page);

		/*** PAGE FOOTER ***/
			require_once('views/footer.html');
	}

	function setCustomMsg($msg) {
		$GLOBALS['customMsg'] = $msg;
	}

	function displayCustomMsg() {
		switch ($GLOBALS['customMsg']) {
			case 'invldPword':
				include_once('messages/error/invldPword.html');
				break;

			case 'noUsername':
				include_once('messages/warning/noUsername.html');
				break;

			case 'pwordMismatch':
				include_once('messages/error/pwordMismatch.html');
				break;

			case 'usernameExists':
				include_once('messages/error/usernameExists.html');
				break;
			//add more messages here

			default:
				# Nothing to display
				break;
		}
	}

	function signup() {
		//register user
		//check if the two passwords match
		if ($_POST['signup_pword'] == $_POST['signup_pword2']) {
			//check if username already exists
			$user = getUserRecord($_POST['signup_uname']);
			if (!$user) {
				//convert preferred password to sha1
				$pwordSha1 = sha1($_POST['signup_pword']);
				//create array out of the user information
				$newUser = [
					"username" => $_POST['signup_uname'],
	        		"firstname" => "",
	        		"lastname" => "",
	        		"address" => "",
	        		"password" => $pwordSha1,
	        		"role" => "regular"
				];
				//add the new user info to the user data file
				//using addUser
				addUser($newUser);
				//redirect to login page
				header('Location: members.php');
			}
			else
				setCustomMsg('usernameExists');
		}
		else
			setCustomMsg('pwordMismatch');
	}

	function signin() {
		//signin/login user
		//get the user record from the user list
		$user = getUserRecord($_POST['signin_uname']);
		//if found do the following:
		if ($user) {
			//change the input password to sha1
			$pwInput = sha1($_POST['signin_pword']);
			//validate the password is correct
			if ($pwInput == $user['password']) {
		        //create a session array of user info
		        $_SESSION['user'] = [
		        	"username" => $user['username'],
		        	"firstname" => $user['firstname'],
		        	"lastname" => $user['lastname'],
		        	"address" => $user['address'],
		        	"role" => $user['role']
		        ];

				//need to delete any previous cart after the
				//admin logs in
				if ($user['role'] == 'admin') {
					if (isset($_SESSION['cart'])) {
						unset($_SESSION['cart']);
					}
				}

				//redirect to homepage
				header('Location: index.php');
			}
			else
				setCustomMsg('invldPword');
		}
		else
			setCustomMsg('noUsername');
	}

	function signout() {
		//signout/logout user
		//destroy session
		session_destroy();
		//redirect to homepage
		header('Location: index.php');
	}

	function display_items($prod, $start, $max) {
		$start = ($start-1)*$max;
		$prod_range = array_slice($prod, $start, $max); //offset minus 1
		for ($i=0; $i < count($prod_range); $i++){
			require('views/wine_cards.php');
		}
	}

	/**
		MAIN PAGE EXECUTIONS START HERE
	**/

	//start new session
	session_start();

	//detect cart changes 
	listenCartChanges();

	//detect if signup button is pressed
	if(isset($_POST['signup_submit'])) {
		signup();
	}

	//detect if signin button is pressed
	if (isset($_POST['signin_submit'])) {
		signin();
	}

	//detect if signout button is pressed
	if(isset($_GET['signout'])) {
		signout();
	}

	//detect if the save wine button is pressed
	if (isset($_POST['wine_save'])) {
		addWine();
	}

	//detect if the edit wine button is pressed
	if (isset($_POST['wine_edit'])) {
		editWine();
	}

	//detect if the add-to-cart button is pressed
	if (isset($_POST['add_to_cart'])) {
		addToCart();
	}

	/*AJAX requests here*/

	//detect if load_wine button is called 
	if (isset($_POST['wine_name'])) {
		loadWine($_POST['wine_name']);
	}

	//detect if load_wine button is called 
	if (isset($_POST['loadCart'])) {
		loadCart();
	}
?>