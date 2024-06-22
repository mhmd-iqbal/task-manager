<?php
require 'configs/connection.php';
require 'controllers/TaskController.php';

// Variable $conn obtained from connection.php 
$controller = new TaskController($conn);

// Invoke the index method in TaskController for displaying the Index Page
$content = $controller->index();

include 'views/layout.php';
