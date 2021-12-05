		<?php
		    if (session_status() === PHP_SESSION_NONE) {
				session_start();
			}

			$includeCSS = array();
			$action = filter_input(INPUT_GET, 'a', FILTER_SANITIZE_STRING);
			if (strlen($action) == 0) {
				$action = 'search';
			}

			$exclude_pages = array('register', 'recovery', 'recovery2', 'agreement');

			if (!isset($_SESSION['login']) && !in_array($action, $exclude_pages)) {
				$action = 'login';
			}
			if ($action == "admin" && (!isset($_SESSION['perms']) || $_SESSION['perms'] < 2)) {
				$action = 'search';
			}
			switch ($action) {
				case 'login':
					$PageTitle = "Login";
					$FileLoc = "user/login.php";
					break;
				case 'register':
					$PageTitle = "Register";
					array_push($includeCSS, "css/login/register.css");
					$FileLoc = "user/register.php";
					break;
				case 'recovery':
					$PageTitle = "Password Recovery";
					$FileLoc = "user/recovery.php";
					break;
				case 'recovery2':
					$PageTitle = "Password Recovery";
					array_push($includeCSS, "css/login/register.css");
					$FileLoc = "user/recovery2.php";
					break;
				case 'profile':
					$PageTitle = "Profile";
					array_push($includeCSS, "css/search/search.css");
					array_push($includeCSS, "css/login/register.css");
					$FileLoc = "user/profile.php";
					break;
				case 'search':
					$PageTitle = "Search";
					array_push($includeCSS, "css/search/search.css");
					$FileLoc = "search/search.php";
					break;
				case 'view':
					$PageTitle = "Car Detail";
					$FileLoc = "car_view/view.php";
					break;
				case 'changepass':
					$PageTitle = "Change Password";
					array_push($includeCSS, "css/login/register.css");
					$FileLoc = "user/password.php";
					break;
				case 'admin':
					$PageTitle = "Admin";
					$FileLoc = "admin/admin.php";
					break;
				case 'inventory':
					$PageTitle = "Inventory";
					array_push($includeCSS, "css/search/search.css");
					$FileLoc = "inventory/inventory.php";
					break;
				case 'editcar':
					$PageTitle = "Edit Car";
					array_push($includeCSS, "css/search/search.css");
					$FileLoc = "inventory/editcar.php";
					break;
				case 'agreement':
					$PageTitle = "Purchase Agreement";
					$FileLoc = "checkout/agreement.php";
					break;

				case 'purchase': //purchase HC
					$PageTitle = "Purchase Car";
					array_push($includeCSS, "/css/purchase/purchase.css"); 
					$FileLoc = "purchase/main.php";
					break;
				case 'transport': //delivery or pick up page HC
					$PageTitle = "Purchase Car";
					array_push($includeCSS, "/css/purchase/purchase.css");
					$FileLoc = "purchase/transport.php";
					break;
				case 'review': //review page HC
					$PageTitle = "Purchase Car";
					array_push($includeCSS, "/css/purchase/purchase.css");
					$FileLoc = "purchase/review.php";
					break;
				case 'finalize': //finalize payment page HC
					$PageTitle = "Purchase Car";
					array_push($includeCSS, "/css/purchase/purchase.css");
					$FileLoc = "purchase/finalize.php";
					break;
				case 'payment': //payment page HC
					$PageTitle = "Purchase Car";
					array_push($includeCSS, "/css/purchase/purchase.css");
					$FileLoc = "purchase/payment.php";
					break;
				case 'purchaseagreement': //purchase agreement HC
						$PageTitle = "Purchase Agreement";
						array_push($includeCSS, "/css/purchase/purchase.css");
						$FileLoc = "purchase/purchaseagreement.php"; 
						break;
			}
			include_once('view/header1.php');
			foreach ($includeCSS as $cssFile): ?>
		<link href="<?= $cssFile; ?>" type="text/css" rel="stylesheet">
		<?php
			endforeach;
			include_once('view/header2.php');
			include_once($FileLoc);
			include_once('view/footer.php');
		?>