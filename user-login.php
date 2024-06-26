<?php require_once './database/connection.php' ?>
<?php require_once './partials/session.php' ?>
<?php require_once './partials/redirect_if_authenticated.php' ?>

<?php
$email = "";
if (isset($_POST['submit'])) {
	$email = htmlspecialchars($_POST['email']);
	$password = htmlspecialchars($_POST['password']);

	if (empty($email)) {
		$error = "Enter your email!";
	} elseif (empty($password)) {
		$error = "Enter your password!";
	} else {
		$hashed_password = sha1($password);
		$sql = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$hashed_password' LIMIT 1";
		$result = $conn->query($sql);

		if ($result->num_rows === 1) {
			$user = $result->fetch_assoc();
			$_SESSION['user'] = $user;
			header('location: ./user-books.php');
		} else {
			$error = "Invalid login credentials!";
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<?php
$title = "Login";
require_once './partials/head.php';
?>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Welcome back, Magicians</h1>
							<p class="lead">
								log in as a User
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<?php require_once('./partials/alerts.php'); ?>
									<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
										<div class="mb-3">
											<label for="email" class="form-label">Email</label>
											<input type="email" class="form-control" name="email" id="email" placeholder="Enter your email!" value="<?php echo $email ?>">
										</div>

										<div class="mb-3">
											<label for="password" class="form-label">Password</label>
											<input type="password" class="form-control" name="password" id="password" placeholder="Enter your password!">
										</div>

										<div class="mb-3">
											<input type="submit" name="submit" value="Login" class="btn btn-primary">
											<input type="reset" value="Reset" class="btn btn-dark">
										</div>

										<div>
											<p>don't have an account  <a href="./register.php">register</a></p>
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="./assets/js/app.js"></script>

</body>

</html>