<h1>Task Manager</h1>

<?php
session_start();
if (isset($_SESSION['message'])) { // check if session 'message' is set
    echo $_SESSION['message']; // display message from session 'message'
    unset($_SESSION['message']); //unset session so that it doesn't display again
}
?>

<form method="post" action="index.php?action=addTask">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title">
    <label for="description">Description:</label>
    <textarea id="description" name="description"></textarea>
    <button type="submit">Add Task</button>
</form>

<?php
$search = isset($_GET['search']) ?  $_GET['search'] : '';
?>

<form method="get" action="index.php">
    <label for="search">Search:</label>
    <input type="text" id="search" name="search" value="<?= $search ?>">
    <button type="submit">Search</button>
</form>

<h2>Tasks</h2>
<ul>
    <?php foreach ($tasks as $task) : ?>
        <li>
            <strong><?php echo htmlspecialchars($task['title']); ?></strong> -
            <?php echo htmlspecialchars($task['status']); ?>
            <a href="index.php?action=updateTaskStatus&update_status=Pending&id=<?php echo $task['id']; ?>">Pending</a>
            <a href="index.php?action=updateTaskStatus&update_status=In Progress&id=<?php echo $task['id']; ?>">In Progress</a>
            <a href="index.php?action=updateTaskStatus&update_status=Completed&id=<?php echo $task['id']; ?>">Completed</a>
        </li>
    <?php endforeach; ?>
</ul>