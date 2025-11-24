<?php
require "config/koneksi.php";
include "components/components.php";

?>
<!DOCTYPE html>
<html>

<head>
	<?php head("Auth"); ?>
	<title>Slide Navbar</title>
	<link rel="stylesheet" type="text/css" href="slide navbar style.css">
	<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/auth.css">
</head>

<body>

	<div class="main">
		<div class="alert-box">
			<?php if (isset($_GET['status'])) listAlert($_GET['status']); ?>
		</div>
		<?php
		$openLogin = false;
		if (isset($_GET['action']) && $_GET['action'] === "login") {
			$openLogin = true;
		}

		if (isset($_GET['status'])) {
			$status_login_error = [
				"email_tidak_ditemukan",
				"password_salah"
			];	
			if (in_array($_GET['status'], $status_login_error)) {
				$openLogin = false;
			}
		}
		?>
		<input type="checkbox" id="chk" aria-hidden="true" <?= $openLogin ? "" : "checked" ?>>
		<div class="signup">
			<form action="logic/auth.logic.php?action=register" method="POST">
				<label for="chk" aria-hidden="true">Register</label>
				<input type="text" name="name" placeholder="Full name" required="">
				<input type="email" name="email" placeholder="Email" required="">
				<input type="tel" name="phone" placeholder="Number Phone (Optional)" min="0">
				<input type="password" name="password" placeholder="Password" required="">
				<input type="password" name="re-password" placeholder="Re-Password" required="">
				<button>Sign up</button>
			</form>
		</div>

		<div class="login">
			<form action="logic/auth.logic.php?action=login" method="POST">
				<label for="chk" aria-hidden="true">Login</label>
				<input type="email" name="email" placeholder="Email" required="">
				<input type="password" name="password" placeholder="Password" required="">
				<button>Login</button>
			</form>
		</div>
	</div>
	<?php footer(); ?>

</body>

</html>