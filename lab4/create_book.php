<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $isbn = $_POST['isbn'];
    $title = $_POST['title'];
    $author_id = $_POST['author_id'];
    $publication_year = $_POST['publication_year'];
    $genre_id = $_POST['genre_id'];

    $sql = "INSERT INTO books (isbn, title, author_id, publication_year, genre_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisi", $isbn, $title, $author_id, $publication_year, $genre_id);

    if ($stmt->execute()) {
        echo "New book added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <form method="post" action="create_book.php">
        ISBN: <input type="text" name="isbn"><br>
        Title: <input type="text" name="title"><br>
        Author ID: <input type="text" name="author_id"><br>
        Publication Year: <input type="text" name="publication_year"><br>
        Genre ID: <input type="text" name="genre_id"><br>
        <input type="submit" value="Add Book">
    </form>
</body>
</html>