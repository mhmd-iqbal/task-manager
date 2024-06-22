<?php
require_once 'models/Task.php';

class TaskController
{
    private $taskModel;

    public function __construct($conn)
    {
        $this->taskModel = new Task($conn);
    }

    /**
     * Displays the task manager interface.
     * Retrieves tasks based on search query and includes the view for rendering.
     */
    public function index()
    {
        // Retrieve search query from GET parameter
        $search = isset($_GET['search']) ? $_GET['search'] : '';

        // Get tasks from model based on search query
        $tasks = $this->taskModel->getAllTasks($search);

        // Include the view file to display the tasks
        include 'views/index.php';
    }

    /**
     * Handles adding a new task.
     * If POST request with valid title and description, adds task using taskModel.
     * Redirects back to index.php after adding task.
     */
    public function addTask()
    {
        // Check if request method is POST and title/description are set
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title']) && isset($_POST['description'])) {
            // Add task using taskModel
            $this->taskModel->addTask($_POST['title'], $_POST['description']);
        }

        // Redirect back to index.php after adding task
        header('Location: index.php');
    }

    /**
     * Handles updating task status.
     * If update_status and id parameters are set in GET, updates task status using taskModel.
     * Redirects back to index.php after updating task status.
     */
    public function updateTaskStatus()
    {
        // Check if update_status and id parameters are set in GET
        if (isset($_GET['update_status']) && isset($_GET['id'])) {
            // Update task status using taskModel
            $this->taskModel->updateTaskStatus($_GET['id'], $_GET['update_status']);
        }

        // Redirect back to index.php after updating task status
        header('Location: index.php');
    }
}
