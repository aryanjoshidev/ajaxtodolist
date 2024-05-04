<?php
$conn = mysqli_connect("localhost", "root", "", "ajaxtodolist");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if (isset($_POST['id'])) {
    $taskId = $_POST['id'];
    

    $query = "UPDATE tasks SET task_status='done' WHERE task_id='$taskId'";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        echo "Task marked as done successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Task ID not provided.";
}
?>
