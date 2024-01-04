          <?php
include "admin/database_connection.php";
session_start();
if(isset($_SESSION['unique_id'])){


?>
<?php include "heder.php"; ?>
<body>
    <style>
        .body{
            content:center;
        }
        link
        {
            style:none;
        }
        .jumbotron img
        {
            margin: top 50px; ;
            height: 50px;
            width: 50px;
        }
    </style>
    <?php 
        $unique = $_SESSION['unique_id'];
        $sql="SELECT * FROM students WHERE unique_id = $unique";
        $statement2 = $connect->prepare($sql);
        $statement2->execute();
        $result2 = $statement2->fetchAll();
        $data = array();
        foreach($result2 as $row){
            $name = $row['fname'];
        }
    echo'
    <div class="jumbotron bg-primary display-inline">
       <h1 class="text-center">WELCOME</h1>
       <div class="dropdown float-right">
    <img src="php/images/'.$row['img'].'"class="rounded-circle dropdown-toggle" data-toggle="dropdown"  alt="Cinque Terre">
    <div class="dropdown-menu">
        <a href="php/images/'.$row['img'].'">View profile</a> <br>
        <a  href="logout.php">Logout</a>
    </div>
    </div> 
    </div>';
    $query = "SELECT * FROM student_course INNER JOIN students 
    ON students.unique_id = student_course.student_unique_id 
    INNER JOIN tbl_course ON tbl_course.course_id = student_course.course_id
    WHERE unique_id = $unique";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $data = array();
    foreach($result as $row){
        $course = $row['course_name'];
    }
    if($filtered_rows = $statement->rowCount()<1){
        echo'
        <div class="container body">
            <div class="card" style="width: 30em; content-align: center;">
            <img class="card-img-top" style="height: 30em;" src="php/images/'.$row['img'].'" alt="Card image cap">
            <div class="card-body">
            <h5 class="card-title">Hello '.$name.'</div></h5>
            <p class="card-text">You are not enrolled for any course .</p>
            <button type="button" id="add_button" class="btn btn-info btn-sm">Enrol for One</a>
            </div>
            </div>
        </div>';
    }else{
        echo'<div class="container" style="margin-top:30px">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-9"><span class="danger">HELLO</span> '.$row['fname'].' '.$row['lname'].'</div>
                    <div class="col-md-3" align="right">
                    <button type="button" id="add_button" class="btn btn-info btn-sm">Enroll</button>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <div class="card-body">
    You are enrolled for '.$course.''
    ;
    }

    ?>
    </div>

    <div class="modal" id="formModal">
  <div class="modal-dialog">
    <form method="post" id="course_form">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="modal_title"></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

    <div class="modal-body">
          <div class="form-group">
            <div class="row">
                <input type="text" name="student_unique_id" value="<?php echo $unique; ?>" class="form-control" hidden>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <label class="col-md-4 text-right">Course<span class="text-danger">*</span></label>
              <div class="col-md-8">
                <select name="course_id" id="course_id" class="form-control">
                  <option value="">Select Course</option>
                  <?php
                  echo load_course_list($connect);
                  ?>
              </select>
              <span id="error_course_id" class="text-danger"></span>
              </div>
            </div>
          </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <input type="hidden" name="course_id" id="course_id" />
          <input type="hidden" name="action" id="action" value="Enroll" />

          <input type="submit" name="button_action" id="button_action" class="btn btn-success btn-sm" value="Enroll" />
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
  </div>
</div>
</body>
<script>
$(document).ready(function(){
  
  function clear_field()
  {
    $('#course_form')[0].reset();
    $('#error_course_name').text('');
  }

  $('#add_button').click(function(){
    $('#modal_title').text('Enroll For A Course');
    $('#button_action').val('Enroll');
    $('#action').val('Enroll');
    $('#formModal').modal('show');
    clear_field();
  });


  $('#course_form').on('submit', function(event){
    event.preventDefault();
    $.ajax({
      url:"course_action.php",
      method:"POST",
      data:$(this).serialize(),
      dataType:"json",
      beforeSend:function()
      {
        $('#button_action').attr('disabled', 'disabled');
        $('#button_action').val('Validate...');
      },
      success:function(data)
      {
        $('#button_action').attr('disabled', false);
        $('#button_action').val($('#action').val());
        if(data.success)
        {
          $('#message_operation').html('<div class="alert alert-success">'+data.success+'</div>');
          clear_field();
          $('#formModal').modal('hide');
        }
        if(data.error)
        {
          if(data.error_course_id != '')
			{
	    	$('#error_course_id').text(data.error_course_id);
			}
			else
			{
			$('#error_course_id').text('');
			}
        }
      }
    })
  });

});
</script>
<?php
}else{
    header("location: login.php");
}
?>
</html>