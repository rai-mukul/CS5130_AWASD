<?php
// Get tasklist array from POST
$task_list = filter_input(INPUT_POST, 'tasklist', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
if ($task_list === NULL) {
    $task_list = [];
}

// Get action variable from POST
$action = filter_input(INPUT_POST, 'action');

// Initialize error messages array
$errors = [];

// Process
switch ($action) {
    case 'add':
        $new_task = filter_input(INPUT_POST, 'task');
        if (empty($new_task)) {
            $errors[] = 'The new task cannot be empty.';
        } else {
            // Add the new task at the beginning of the task list
            array_unshift($task_list, $new_task);
        }
        break;
    case 'delete':
        $task_index = filter_input(INPUT_POST, 'taskid', FILTER_VALIDATE_INT);
        if ($task_index === NULL || $task_index === FALSE) {
            $errors[] = 'The task cannot be deleted.';
        } else {
            unset($task_list[$task_index]);
            $task_list = array_values($task_list);
        }
        break;
}

include('task_list.php');
?>
