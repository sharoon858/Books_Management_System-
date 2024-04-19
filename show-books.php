<?php
require_once './database/connection.php';
require_once './partials/session.php';
require_once './partials/check_if_authenticated.php';

$books = [];



// if ($_SERVER["REQUEST_METHOD"] == "POST") {

// }


$sql = "SELECT * FROM `book`";
$result = $conn->query($sql);
$books = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<?php
$title = "Add Course";
require_once './partials/head.php';
?>

<body>
	<div class="wrapper">
		<?php require_once './partials/sidebar.php' ?>

		<div class="main">
			<?php require_once './partials/topbar.php' ?>

			<main class="content">
				<div class="container-fluid p-0">
					<div class="row mb-3">
						<div class="col-6">
							<h1 class="h3">Add Course</h1>
						</div>
						<div class="col-6 text-end">
							<a href="./add-book.php" class="btn btn-outline-primary">Add</a>
						</div>
					</div>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-body">
									<?php require_once "./partials/alerts.php" ?>
								</div>
								<table class="table table-bordered m-0">
									<?php
									if ($result->num_rows > 0) { ?>
										<thead>
											<tr>
												<th>Sr. No</th>
												<th>Book Name</th>
												<th>Author Name</th>
												<th>Description</th>
												<th>Price</th>
												<th>Publishing Year</th>
												<th>Picture</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$sr = 1;
											foreach ($books as $book) { ?>
												<tr>
													<td><?php echo $sr++; ?></td>
													<td><?php echo $book['book_name']; ?></td>
													<td><?php echo $book['author_name']; ?></td>
													<td><?php echo $book['description']; ?></td>
													<td><?php echo $book['price']; ?></td>
													<td><?php echo $book['publishing_year']; ?></td>
													<td><img src="<?php echo $book['picture']; ?>" alt="Book Picture" style="max-width: 100px;"></td>
													<?php
													?>

													<td>
														<a href="./edit-books.php?id=<?php echo $book['id'] ?>" class="btn btn-primary">Edit</a>
														<a href="./delete-books.php?id=<?php echo $book['id'] ?>" class="btn btn-danger">Delete</a>
													</td>
												</tr>
											<?php
											}
											?>

										</tbody>
								</table>
							<?php
									} else { ?>
								<div class="alert alert-info m-0">No record found!</div>
							<?php
									}
							?>
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
		const coursesMenuElement = document.querySelector("#courses-menu");
		coursesMenuElement.classList.add("active");
	</script>

</body>

</html>