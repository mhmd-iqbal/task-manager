<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['message'])) { // check if session 'message' is set
    echo $_SESSION['message']; // display message from session 'message'
    unset($_SESSION['message']); //unset session so that it doesn't display again
}

$search = isset($_GET['search']) ?  $_GET['search'] : '';
?>

<div class="card p-3 shadow-sm mt-4" style="border-radius: 20px;">
    <div class="card-body">
        <div class="d-flex gap-3 justify-content-between flex-wrap align-items-center">
            <h4 class="card-title mb-0">Task List</h4>
            <form method="get" action="index.php">
                <div class="input-group">
                    <input type="text" id="search" name="search" placeholder="Type title or status here.." class="form-control" value="<?= $search ?>">
                    <button type="submit" class="btn btn-dark"><i class="bi bi-search"></i></button>
                </div>
            </form>

            <div class="table-responsive w-100">
                <table class="table table-sm">
                    <thead>
                        <th style="min-width: 50px;">ID</th>
                        <th style="min-width: 350px;">Task Detail</th>
                        <th style="min-width: 150px;">Status</th>
                        <th style="min-width: 130px;">Action</th>
                    </thead>
                    <tbody>
                        <?php if (!empty($tasks)) : ?>
                            <?php foreach ($tasks as $task) : ?>
                                <tr>
                                    <td class="py-2"><?= $task['id'] ?></td>
                                    <td class="py-2">
                                        <strong><?= htmlspecialchars($task['title']); ?></strong>
                                        <p class="text-lead mb-0" style="white-space:pre-line">
                                            <?= trim($task['description']) ?>
                                        </p>
                                    </td>
                                    <td class="py-2">
                                        <?php
                                        $badgeColor = "";

                                        switch ($task['status']) {
                                            case 'Pending':
                                                $badgeColor = 'text-secondary';
                                                break;
                                            case 'In Progress':
                                                $badgeColor = 'text-warning';
                                                break;
                                            default:
                                                $badgeColor = 'text-success';
                                                break;
                                        }
                                        ?>

                                        <span class="fw-bold <?= $badgeColor ?>"><?= htmlspecialchars($task['status']); ?></span>
                                    </td>
                                    <td class="py-2">
                                        <div class="d-flex gap-2 flex-wrap">
                                            <a href="index.php?action=updateTaskStatus&update_status=Pending&id=<?= $task['id']; ?>" class="btn btn-sm btn-secondary"><i class="bi bi-hourglass-split"></i></a>
                                            <a href="index.php?action=updateTaskStatus&update_status=In Progress&id=<?= $task['id']; ?>" class="btn btn-sm btn-warning"><i class="bi bi-gear"></i></a>
                                            <a href="index.php?action=updateTaskStatus&update_status=Completed&id=<?= $task['id']; ?>" class="btn btn-sm btn-success"><i class="bi bi-check-circle"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4" class="text-center">
                                    No tasks found.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addTaskModalLabel">Add Task</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="index.php?action=addTask">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title:</label>
                        <input type="text" id="title" name="title" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description:</label>
                        <textarea id="description" name="description" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100"><i class="bi bi-save me-1"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>