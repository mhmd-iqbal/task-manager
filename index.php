<?php
require 'configs/connection.php';
require 'controllers/TaskController.php';

// Variable $conn obtained from connection.php 
$controller = new TaskController($conn);

// Check if URL parameter named 'action' is set
// Set $action to value from parameter 'action' when status link clicked
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Executing a method in TaskController based on value of $action
switch ($action) {
    case 'addTask':
        $controller->addTask();
        break;
    case 'updateTaskStatus':
        $controller->updateTaskStatus();
        break;
    default: // $action = 'index'
        // Invoke the index method in TaskController for displaying the Index Page
        $content = $controller->index();
        break;
}

include 'views/layout.php';
