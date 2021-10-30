
		<?php

			$action = filter_input(INPUT_GET, 'a', FILTER_SANITIZE_STRING);
			if (strlen($action) == 0) {
				$action = 'login';
			}
			switch ($action) {
				case 'login':
					$PageTitle = "Login";
					$FileLoc = "login/login.php";
					break;
				case 'register':
					$PageTitle = "Register";
					$includeCSS = array("css/login/register.css");
					$FileLoc = "login/register.php";
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
