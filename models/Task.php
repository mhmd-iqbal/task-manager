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
}
