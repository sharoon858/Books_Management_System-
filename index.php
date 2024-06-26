<?php require_once './partials/session.php' ?>
<?php require_once './partials/check_if_authenticated.php' ?>

<!DOCTYPE html>
<html lang="en">

<?php
$title = "Dashboard";
require_once './partials/head.php';
?>

<body>
	<div class="wrapper">
		<?php require_once './partials/sidebar.php' ?>

		<div class="main">
			<?php require_once './partials/topbar.php' ?>

			<main class="content">
				<div class="container-fluid p-0">
					<h1 class="h3 mb-3">Dashboard</h1>
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-body border border-3  border-warning">
						<div class="col-6">
										
						<img src="./img/download.jpeg" alt="" class="rounded mx-auto d-block" height="500px"width="900px  ">
									
						</div>
								
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>

			<?php require_once './partials/footer.php' ?>
		</div>
	</div>

	<script src="./assets/js/app.js"></script>
	<script>
		const dashboardMenuElement = document.querySelector("#dashboard-menu");
		dashboardMenuElement.classList.add("active");
	</script>

</body>

</html>