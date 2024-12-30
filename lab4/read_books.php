<?php
include 'db.php'; // Ensure db.php is included to establish the database connection

$sql = "SELECT b.id, b.isbn, b.title, a.name AS author, b.publication_year, g.name AS genre
        FROM books b
        JOIN authors a ON b.author_id = a.id
        JOIN genres g ON b.genre_id = g.id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>ISBN</th>
                <th>Title</th>
                <th>Author</th>
                <th>Publication Year</th>
                <th>Genre</th>
                <th>Actions</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['isbn']}</td>
                <td>{$row['title']}</td>
                <td>{$row['author']}</td>
                <td>{$row['publication_year']}</td>
                <td>{$row['genre']}</td>
                <td>
                    <a href='update_book.php?id={$row['id']}'>Edit</a> |
                    <a href='delete_book.php?id={$row['id']}'>Delete</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No books found.";
}

$conn->close();
?>