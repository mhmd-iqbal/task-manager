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
}
