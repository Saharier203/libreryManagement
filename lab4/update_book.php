<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $isbn = $_POST['isbn'];
    $title = $_POST['title'];
    $author_id = $_POST['author_id'];
    $publication_year = $_POST['publication_year'];
    $genre_id = $_POST['genre_id'];

    $sql = "UPDATE books SET isbn = ?, title = ?, author_id = ?, publication_year = ?, genre_id = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisii", $isbn, $title, $author_id, $publication_year, $genre_id, $id);

    if ($stmt->execute()) {
        echo "Book updated successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM books WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $book = $result->fetch_assoc();

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Book</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h2>Update Book</h2>
        <form method="post" action="update_book.php">
            <input type="hidden" name="id" value="<?php echo $book['id']; ?>">
            <div class="form-group">
                <label for="isbn">ISBN</label>
                <input type="text" name="isbn" class="form-control" id="isbn" value="<?php echo $book['isbn']; ?>" required>
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="title" value="<?php echo $book['title']; ?>" required>
            </div>
            <div class="form-group">
                <label for="author_id">Author ID</label>
                <input type="text" name="author_id" class="form-control" id="author_id" value="<?php echo $book['author_id']; ?>" required>
            </div>
            <div class="form-group">
                <label for="publication_year">Publication Year</label>
                <input type="text" name="publication_year" class="form-control" id="publication_year" value="<?php echo $book['publication_year']; ?>" required>
            </div>
            <div class="form-group">
                <label for="genre_id">Genre ID</label>
                <input type="text" name="genre_id" class="form-control" id="genre_id" value="<?php echo $book['genre_id']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Book</button>
        </form>
    </div>
</body>
</html>