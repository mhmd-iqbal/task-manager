<?php
require_once 'models/Task.php';

class TaskController
{
    private $taskModel;

    public function __construct($conn)
    {
        $this->taskModel = new Task($conn);
    }

    public function index()
    {
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $tasks = $this->taskModel->getAllTasks($search);
        include 'views/index.php';
    }

    public function addTask()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title']) && isset($_POST['description'])) {
            $this->taskModel->addTask($_POST['title'], $_POST['description']);
        }
        header('Location: index.php');
    }

    public function updateTaskStatus()
    {
        if (isset($_GET['update_status']) && isset($_GET['id'])) {
            $this->taskModel->updateTaskStatus($_GET['id'], $_GET['update_status']);
        }
        header('Location: index.php');
    }
}
