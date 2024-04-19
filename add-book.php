<?php
require_once './database/connection.php';
require_once './partials/session.php';
require_once './partials/check_if_authenticated.php';

$bookName = $authorName = $description = $price = $publishingYear = "";

if (isset($_POST['submit'])) {
    $bookName = htmlspecialchars($_POST['book-name']);
    $authorName = htmlspecialchars($_POST['author-name']);
    $description = htmlspecialchars($_POST['description']);
    $price = htmlspecialchars($_POST['price']);
    $publishingYear = htmlspecialchars($_POST['publishing-year']);

    // Check if 'picture' key exists in $_FILES
    if (isset($_FILES['picture'])) {
        $picture = $_FILES['picture'];

        if (empty($bookName)) {
            $error = "Enter the book name!";
        } elseif (empty($authorName)) {
            $error = "Enter the author Name!";
        } elseif (empty($description)) {
            $error = "Enter the description";
        } elseif (empty($price)) {
            $error = "Enter the price";
        } elseif ($picture['error'] != 0) {
            $picture_error = 'Please select a picture!';
        } else {
            $tmp_name = $picture['tmp_name'];
            $picture_name = $picture['name'];
            $target_directory = "./img/" . $picture_name;

            $allowed_extensions = ['jpg', 'jpeg', 'png'];
            $picture_array = explode('.', $picture_name);
            $picture_extension = strtolower(end($picture_array));

            if (in_array($picture_extension, $allowed_extensions)) {
                if (move_uploaded_file($tmp_name, $target_directory)) {                    
                    $sql = "INSERT INTO `book`(`book_name`, `author_name`, `description`, `price`, `publishing_year`, `picture`) VALUES ('$bookName','$authorName','$description','$price','$publishingYear', '$target_directory')";

                    $result = $conn->query($sql);
                    if ($result) {
                        $success = "Magic has been spelled!";
                        $name = $duration = "";
                    } else {
                        $error = "Magic has failed to spell!";
                    }
                }
            } else {
                $picture_error = 'Only JPG, JPEG, and PNG file types are allowed!';
            }
        }
    } else {
        $picture_error = 'Please select a picture!';
    }
}
?>
?>

<!DOCTYPE html>
<html lang="en">

<?php
$title = "Add Books";
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
                            <h1 class="h3">Edit Cours</h1>
                        </div>
                        <div class="col-6 text-end">
                            <a href="./show-books.php" class="btn btn-outline-primary">Back</a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <?php require_once "./partials/alerts.php" ?>
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST"  enctype="multipart/form-data">

                                        <div class="mb-3">
                                            <label for="book-name" class="form-label">Book Name</label>
                                            <input type="text" id="book-name" name="book-name" class="form-control <?php echo isset($error) ? 'is-invalid' : '' ?>" placeholder="Enter your name!" value="<?php echo $bookName ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="author-name" class="form-label">Author Name</label>
                                            <input type="text" id="author-name" name="author-name" class="form-control <?php echo isset($error) ? 'is-invalid' : '' ?>" placeholder="Enter your name!" value="<?php echo $authorName ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <input type="text" id="description" name="description" class="form-control <?php echo isset($error) ? 'is-invalid' : '' ?>" placeholder="Enter your name!" value="<?php echo $description ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="price" class="form-label">Price</label>
                                            <input type="text" id="price" name="price" class="form-control <?php echo isset($error) ? 'is-invalid' : '' ?>" placeholder="Enter your name!" value="<?php echo $price ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="publishing-year" class="form-label">Publishing Year</label>
                                            <input type="text" id="publishing-year" name="publishing-year" class="form-control <?php echo isset($error) ? 'is-invalid' : '' ?>" placeholder="Enter your name!" value="<?php echo $publishingYear ?>">
                                        </div>


                                        <div class="mb-3">
                                            <label for="picture" class="form-label">Picture</label>
                                            <input type="file" id="picture" name="picture" class="form-control <?php echo isset($picture_error) ? 'is-invalid' : '' ?>">
                                            <?php
                                            if (isset($picture_error)) { ?>
                                                <div class="text-danger">
                                                    <?php echo $picture_error ?>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>

                                        <div>
                                            <input type="submit" name="submit" class="btn btn-primary">
                                            <input type="reset" class="btn btn-secondary">
                                        </div>
                                    </form>
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
        const booksMenuElement = document.querySelector("#books-menu");
        booksMenuElement.classList.add("active");
    </script>

</body>

</html>