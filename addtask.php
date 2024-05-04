<?php

$conn = mysqli_connect("localhost", "root", "", "ajaxtodolist");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$name = $_POST['taskname'];
$status = $_POST['taskstatus'];

$checkduplicay="select * from tasks where task_name = '$name'";
$resultr = mysqli_query($conn, $checkduplicay);
if (mysqli_num_rows($resultr) > 0) {
    echo "<div class='alert alert-danger'>Task with the same name already exists.</div>";
}
else{

$insertdata = "insert into tasks (task_name,task_status) values (?,?)";
$stmt = mysqli_prepare($conn, $insertdata);
mysqli_stmt_bind_param($stmt, "ss", $name,$status);
$success = mysqli_stmt_execute($stmt);
if ($success) {
    echo "<div class='alert alert-success'>Task added successfully.</div>";
} else {
       echo "Error: " . mysqli_error($conn);
}
}

?>
