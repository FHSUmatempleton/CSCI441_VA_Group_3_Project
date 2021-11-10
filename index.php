
		<?php
		    if (session_status() === PHP_SESSION_NONE) {
				session_start();
			}

			$includeCSS = array();
			$action = filter_input(INPUT_GET, 'a', FILTER_SANITIZE_STRING);
			if (strlen($action) == 0) {
				$action = 'search';
			}
			if (!isset($_SESSION['login']) && !isset($_COOKIE['login']) && $action != 'register') {
				$action = 'login';
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
				case 'profile':
					$PageTitle = "Profile";
					$FileLoc = "user/profile.php";
					break;
				case 'search':
					$PageTitle = "Search";
					array_push($includeCSS, "css/search/search.css");
					$FileLoc = "search/search.php";
					break;
				case 'view':
					$PageTitle = "Car Detail";
					$FileLoc = "car_view/index.php";
					break;
			}
			include_once('view/header1.php');
			foreach ($includeCSS as $cssFile): ?>
				<link href="<?= $cssFile; ?>" type="text/css" rel="stylesheet">
			<?php
			endforeach;
			include_once('view/header2.php');
			include_once($FileLoc)
		?>


		<?php include_once('view/footer.php'); ?>
