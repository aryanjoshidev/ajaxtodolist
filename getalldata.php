<?php
$conn = mysqli_connect("localhost", "root", "", "ajaxtodolist");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$i=1;
$sql = "select * from tasks";

$result = $conn->query($sql);
if ($result->num_rows > 0) {

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";     
        
        if ($row["task_status"] != "done") {
          echo "<td>" . $i++ . "</td>";
          echo "<td>" . $row["task_name"] . "</td>";
          echo "<td>" . $row["task_status"] . "</td>";
          
            echo "<td>" . "<a id='donebutton' href='#' onClick='updateTask(".$row["task_id"].")'>done</a>" . " | " . "<a href='#' onclick='deleteTask(" . $row["task_id"] . ")'>Delete</a>" . "</td>";
        } else {
                       
            echo "<td>" . $i++ . "</td>";
            echo "<td>" . $row["task_name"] . "</td>";
            echo "<td>" . $row["task_status"] . "</td>";
            
//               echo "<td>".
              
// "<a href='#' onclick='deleteTask(" . $row["task_id"] . ")'>Delete</a>" . 

// "</td>";


        }
 
      
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>No tasks found</td></tr>";
}