<?php
require './configs/connection.php';

// Untuk melakukan proses tambah Task
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title']) && isset($_POST['description'])) {
    $stmt = $conn->prepare('INSERT INTO tasks (title, description) VALUES (?, ?)');
    $stmt->execute([$_POST['title'], $_POST['description']]);
}

// Untuk melakukan update status Task
if (isset($_GET['update_status']) && isset($_GET['id'])) {
    $stmt = $conn->prepare('UPDATE tasks SET status = ? WHERE id = ?');
    $stmt->execute([$_GET['update_status'], $_GET['id']]);
}

// Untuk melakukan search Task berdasarkan title atau statusnya
$searchQuery = '';
$params = [];
if (isset($_GET['search'])) {
    $searchQuery = 'WHERE title LIKE ? OR status = ?';
    $params = ['%' . $_GET['search'] . '%', $_GET['search']];
}

// Untuk mengambil semua Task order by created_at
$stmt = $conn->prepare("SELECT * FROM tasks $searchQuery ORDER BY created_at DESC");
$stmt->execute($params);
$tasks = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Task Manager</title>
</head>

<body>
    <h1>Task Manager</h1>

    <form method="post" action="">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>
        <button type="submit">Add Task</button>
    </form>

    <form method="get" action="">
        <label for="search">Search:</label>
        <input type="text" id="search" name="search">
        <button type="submit">Search</button>
    </form>

    <h2>Tasks</h2>
    <ul>
        <?php foreach ($tasks as $task) : ?>
            <li>
                <strong><?= htmlspecialchars($task['title']); ?></strong> -
                <?= htmlspecialchars($task['status']); ?>
                <a href="?update_status=Pending&id=<?= $task['id']; ?>">Pending</a>
                <a href="?update_status=In Progress&id=<?= $task['id']; ?>">In Progress</a>
                <a href="?update_status=Completed&id=<?= $task['id']; ?>">Completed</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>

</html>