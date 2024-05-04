<?php
$conn = mysqli_connect("localhost", "root", "", "ajaxtodolist");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if(isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "delete from tasks where task_id = $id";

    if (mysqli_query($conn, $sql)) {
        echo "Task deleted successfully";
    } else {
        echo "Error deleting task: " . mysqli_error($conn);
    }
} else {
    echo "Task ID not provided";
}

mysqli_close($conn);
?>
