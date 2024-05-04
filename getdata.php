<?php
$conn = mysqli_connect("localhost", "root", "", "ajaxtodolist");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$i=1;
$query = "select * from tasks";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";      
        
        if ($row["task_status"] != "done") {

          echo "<td>" . $i++ . "</td>";
          echo "<td>" . $row["task_name"] . "</td>";
          echo "<td>" . $row["task_status"] . "</td>";
          
            echo "<td>" . "<a id='donebutton' href='#' onClick='updateTask(".$row["task_id"].")'>done</a>" . " | " . "<a href='#' onclick='deleteTask(" . $row["task_id"] . ")'>Delete</a>" . "</td>";
        } else {
            // echo "<td>" . "<a href='#' onclick='deleteTask(" . $row["task_id"] . ")'>Delete</a>" . "</td>";
        }

     
      
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>No tasks found</td></tr>";
}
?>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  function deleteTask(taskId) {
    if (confirm("Are you sure you want to delete this task?")) {
      $.ajax({
        url: 'delete_task.php',
        type: 'POST',
        data: { id: taskId },
        success: function(response) {
    
          alert(response);
          window.location.reload(); 
        },
        error: function(xhr, status, error) {
          console.error('Error:', error);
          alert('Failed to delete task. Please try again.');
        }
      });
    }
  }
</script>


<script>
function updateTask(taskId) {
  if (confirm("Are you sure you want to mark this task as done?")) {
    $.ajax({
      url: 'update_task.php',
      type: 'POST',
      data: { id: taskId },
      success: function(response) {
        alert(response);        
        window.location.reload();
     
      },
      error: function(xhr, status, error) {
        console.error('Error:', error);
        alert('Failed to mark task as done. Please try again.');
      }
    });
  }
}
</script>