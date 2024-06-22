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

        // Render the view with tasks data
        $this->render('views/layout.php', ['tasks' => $tasks]);
    }

    /**
     * Handles adding a new task.
     * If POST request with valid title and description, adds task using taskModel.
     * Redirects back to index.php after adding task.
     */
    public function addTask()
    {
        try {
            // Check if title or description inputs are empty
            if ((isset($_POST['title']) && $_POST['title'] == "") || isset($_POST['description']) && ($_POST['description'] == "")) {
                session_start();
                // Set session named 'message' with validation message 
                $_SESSION['message'] = "Title and description inputs must be filled.";
                $_SESSION['old'] = [
                    'title' => $_POST['title'] ?? '',
                    'description' => $_POST['description'] ?? '',
                ];
            } else {
                // Check if request method is POST and title/description are set
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title']) && isset($_POST['description'])) {
                    // Add task using taskModel
                    $this->taskModel->addTask($_POST['title'], $_POST['description']);
                }
            }

            // Redirect back to index.php after adding task
            header('Location: index.php');
        } catch (Exception $e) {
            // Log the error or handle it as needed
            error_log("Error adding task: " . $e->getMessage());
        }
    }

    /**
     * Handles updating task status.
     * If update_status and id parameters are set in GET, updates task status using taskModel.
     * Redirects back to index.php after updating task status.
     */
    public function updateTaskStatus()
    {
        try {
            // Check if update_status and id parameters are set in GET
            if (isset($_GET['update_status']) && isset($_GET['id'])) {
                // Update task status using taskModel
                $this->taskModel->updateTaskStatus($_GET['id'], $_GET['update_status']);
            }

            // Redirect back to index.php after updating task status
            header('Location: index.php');
        } catch (Exception $e) {
            // Log the error or handle it as needed
            error_log("Error updating task status: " . $e->getMessage());
        }
    }

    /**
     * Renders a view file with optional data.
     *
     * @param string $view The path to the view file to render.
     * @param array $data Optional data to pass to the view.
     */
    private function render($view, $data = [])
    {
        // Extract the data array to variables accessible within the view
        extract($data);

        // Start output buffering to capture the rendered view
        ob_start();

        // Include the view file
        require $view;

        // Get the captured output and clean the buffer
        $content = ob_get_clean();

        // Assuming you want to return the content to the caller
        echo $content;
    }
}
