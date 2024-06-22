<?php
class Task
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    /**
     * Retrieves all tasks from the database optionally filtered by title or status.
     *
     * @param string $search Optional search keyword to filter tasks by title or status.
     * @return array Array of tasks retrieved from the database.
     */
    public function getAllTasks($search = '')
    {
        try {
            $query = 'SELECT * FROM tasks';
            $params = [];

            // If search keyword is provided, filter tasks by title or status
            if ($search) {
                $query .= ' WHERE title LIKE ? OR status = ?';
                $params = ['%' . $search . '%', $search];
            }

            // Order tasks by created_at timestamp in descending order
            $query .= ' ORDER BY created_at DESC';

            // Prepare and execute the SQL query with parameters
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);

            // Return the fetched results as an array of tasks
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            // Log the error or handle it as needed
            error_log("Error retrieving tasks: " . $e->getMessage());
        }
    }

    /**
     * Adds a new task to the database with the specified title and description.
     *
     * @param string $title Title of the task to be added.
     * @param string $description Description of the task to be added.
     */
    public function addTask($title, $description)
    {
        try {
            // Prepare SQL statement to insert a new task into the database
            $stmt = $this->conn->prepare('INSERT INTO tasks (title, description) VALUES (?, ?)');

            // Execute the SQL statement with title and description as parameters
            $stmt->execute([$title, $description]);
        } catch (PDOException $e) {
            // Log the error or handle it as needed
            error_log("Error adding task: " . $e->getMessage());
        }
    }

    /**
     * Updates the status of a task in the database identified by its ID.
     *
     * @param int $id ID of the task to update.
     * @param string $status New status to set for the task.
     */
    public function updateTaskStatus($id, $status)
    {
        try {
            // Prepare SQL statement to update the status of a task in the database
            $stmt = $this->conn->prepare('UPDATE tasks SET status = ? WHERE id = ?');

            // Execute the SQL statement with status and ID as parameters
            $stmt->execute([$status, $id]);
        } catch (PDOException $e) {
            // Log the error or handle it as needed
            error_log("Error updating task status: " . $e->getMessage());
        }
    }
}
