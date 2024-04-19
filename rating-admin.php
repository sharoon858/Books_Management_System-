<?php
require_once './database/connection.php';
require_once './partials/session.php';
require_once './partials/check_if_authenticated.php';

$books = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["submit"])) {
        $rating = $_POST["submit"];
        $book_id = $_POST["book_id"]; // Add this line to get the book_id

        $sql = "INSERT INTO `rating`(`rating`, `book_id`) VALUES ('$rating', '$book_id')"; // Add the book_id in the SQL query
        $result = $conn->query($sql);
        if ($result) {
            echo "New Rating added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}

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
                        <div class="col-12 text text-center">
                            <h1 class="h3">Rating</h1>
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
                                                <th>Rating</th>
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

                                                    <td>
                                                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                                                            <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>"> <!-- Add this line to include the book_id -->

                                                            <div class="rateyo" id="rating" data-rateyo-rating="4" data-rateyo-num-stars="5" data-rateyo-score="3">
                                                            </div>

                                                            <span class='result'>0</span>
                                                            <input type="hidden" name="submit">

                                                        </form>
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

    <!-- Include necessary CSS and JavaScript -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

    <script>
        $(function() {
            $(".rateyo").rateYo({
                onSet: function(rating, rateYoInstance) {
                    $(this).parent().find('.score').text('score :' + rating);
                    $(this).parent().find('.result').text('rating :' + rating);
                    // Update the hidden input field with the rating value
                    $(this).parent().find('input[name=submit]').val(rating);
                }
            });
        });
    </script>

</body>

</html>
