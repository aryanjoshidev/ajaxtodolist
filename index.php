<!doctype html>
<html lang="en">
<head>
  <title>ADD TASK|VIEW TASK</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

 
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-4" style="background-color:lavender;">
      <div class="form-group">
        <form id="dataForm">
          <label for="taskname">TASK NAME</label>
          <input type="text" class="form-control" name="taskname" id="taskname" aria-describedby="helpId" placeholder="">


          <input type="text" class="form-control" hidden name="taskstatus" value="pending" id="taskstatus" aria-describedby="helpId" placeholder="">
          
          <br>
          <button id="submitnow" type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
    

    <div class="col-sm-6" style="background-color:lavenderblush;">
      <table class="table">
        <thead>
          <tr>
            <th>S. NO</th>
            <th>TASK NAME</th>   
            <th>STATUS</th>        
            <th>ACTION</th>
          </tr>
        </thead>
        <tbody id="tasklist">
   
</tbody>

      </table>
    </div>
	
	
	 <div class="col-sm-2" style="background-color:lavenderblush;">
      <button class="btn btn-success" id="showall">show all task</button>
    </div>
	
	
	
  </div>
</div>

<div id="feedback"></div>



<script>
$(document).ready(function () {

    function fetchTaskData() {
        $.get("getdata.php", function(data) {
            $("#tasklist").html(data);

            sessionStorage.setItem("taskData", data);
        });
    }


    fetchTaskData();


    $('#submitnow').click(function (event) { 
        event.preventDefault(); 
        var name = $('#taskname').val();
        var status = $('#taskstatus').val();
      
        if (name === "") {
      
            $('#feedback').fadeIn();
            $('#feedback').removeClass('alert alert-success').addClass('alert alert-danger').html('Name field is required.');
        } 
        else {
         
            $.ajax({
                type: "post",
                url: "addtask.php",
                data: $('#dataForm').serialize(),
                success: function (response){
                    $('#feedback').fadeIn();
                    $('#feedback').removeClass('alert alert-danger').addClass('alert alert-success').html(response);
                                     fetchTaskData();
                }
            });
        }
    });




    var storedTaskData = sessionStorage.getItem("taskData");
    if (storedTaskData) {

        $("#tasklist").html(storedTaskData);
    }
});



</script>

<script>
  //show all data
    $(document).ready(function() {
      $('#showall').click(function() {
        $.ajax({
          url: "getalldata.php",
          type: "GET",
          success: function(data) {
            $('#tasklist').html(data);
          },
          error: function(xhr, status, error) {
            console.error(status, error);
          }
        });
      });
    });
  </script>

</body>
</html>
