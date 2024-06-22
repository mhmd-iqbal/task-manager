<?php
class Task
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllTasks($search = '')
    {
        $query = 'SELECT * FROM tasks';
        $params = [];

        if ($search) {
            $query .= ' WHERE title LIKE ? OR status = ?';
            $params = ['%' . $search . '%', $search];
        }

        $query .= ' ORDER BY created_at DESC';
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function addTask($title, $description)
    {
        $stmt = $this->conn->prepare('INSERT INTO tasks (title, description) VALUES (?, ?)');
        $stmt->execute([$title, $description]);
    }

    public function updateTaskStatus($id, $status)
    {
        $stmt = $this->conn->prepare('UPDATE tasks SET status = ? WHERE id = ?');
        $stmt->execute([$status, $id]);
    }
}
