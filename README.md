
# Task Manager App

## Requirements
- PHP (version 7 or above)
- MySQL (version 5.6 or above)
- XAMPP (version 8 or above)

## Setup Instructions

#### 1. **Clone the repository:**

Clone the repository using the command `git clone https://github.com/mhmd-iqbal/task_manager.git` or download from [here](https://github.com/mhmd-iqbal/task_manager.git). After that, copy the `task-manager` directory into the `htdocs` directory, which can be found inside your XAMPP installation directory.

#### 2. **Set up the database:**
- Create a MySQL database named `task_manager`.
- Run the following SQL script to create the `tasks` table:
```
  CREATE DATABASE task_manager;

  USE task_manager;

  CREATE TABLE tasks (
      id INT AUTO_INCREMENT PRIMARY KEY,
      title VARCHAR(255) NOT NULL,
      description TEXT,
      status ENUM('Pending', 'In Progress', 'Completed') DEFAULT 'Pending',
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  );
```
- Or you can create Database by access url `http://localhost/task-manager/initDb.php` and create table by access url `localhost/task-manager/initTable.php`

#### 3. **Configure the database connection:**
- Update the database connection configuration in `configs/config.php` if needed.
```
<?php
$host =  'localhost';    // DB Host
$db =  'task_manager';    // DB Name
$user =  'root';    // MySQL username
$pass =  '';    // MySQL password
$charset =  'utf8mb4';    // or utf8
```

#### 4. **Start the web server:**
- Open XAMPP.
- Start Apache and MySQL services. Make sure that both services are running well. 

#### 5. **Access the app:**
- Open your web browser and navigate to `http://localhost/task_manager`.

## Description

This is a simple Task Manager application built with PHP and MySQL. It allows you to:
- Add new tasks with a title and description.
- Update the status of tasks (Pending, In Progress, Completed).
- Search for tasks by title or status.

## Testing
- Add a new task using the form.
- Update the status of existing tasks by clicking the status links.
- Use the search functionality to filter tasks. To retrieve all data, simply empty the search box and click the search button.
