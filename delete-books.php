<?php require_once './database/connection.php' ?>
<?php require_once './partials/session.php' ?>
<?php require_once './partials/check_if_authenticated.php' ?>

<?php
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
} else {
    header('location: ./show-books.php');
}

$sql = "SELECT * FROM `book` WHERE `id` = $id";
$result = $conn->query($sql);
if ($result->num_rows === 1) {
    $sql = "DELETE FROM `book` WHERE `id` = $id";
    $result = $conn->query($sql);
    if ($result) {
        $_SESSION['success'] = "Magic has been spelled!";
    } else {
        $_SESSION['error'] = "Magic has failed to spell!";
    }
    header('location: ./show-books.php');
} else {
    header('location: ./show-books.php');
}
?>