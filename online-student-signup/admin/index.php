<?php

//course.php

include('header.php');

?>

<div class="container" style="margin-top:30px">
  <div class="card">
  	<div class="card-header">
      <div class="row">
        <div class="col-md-9">Student's Enrollment List</div>
      </div>
    </div>
  	<div class="card-body">
  		<div class="table-responsive">
        <span id="message_operation"></span>
        <table class="table table-striped table-bordered" id="course_table">
          <thead>
            <tr>
              <th>Student Name</th>
              <th>Course Enrolled</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php
                $query = "SELECT * FROM student_course INNER JOIN students 
                ON students.unique_id = student_course.student_unique_id 
                INNER JOIN tbl_course ON tbl_course.course_id = student_course.course_id";
                $statement = $connect->prepare($query);
                $statement->execute();
                $result = $statement->fetchAll();
                $data = array();
                foreach($result as $row){
                    echo '
                    <tr>
                        <td>'.$row['fname'].' '.$row['lname'].'</td>
                        <td>'.$row['course_name'].'</td>
                        <td><button type="button" name="delete_course" class="btn btn-danger btn-sm delete_course" id="'.$row["course_id"].'">Delete</button></td>
                    </tr>
                    ';
                }
            ?>
          </tbody>
        </table>
  		</div>
  	</div>
  </div>
</div>

</body>
</html>