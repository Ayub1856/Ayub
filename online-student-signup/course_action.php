<?php

//course_action.php

include('database_connection.php');

session_start();

if(isset($_POST["action"]))
{

	if($_POST["action"] == 'Enroll')
	{
		$unique_id = '';
		$course_id = '';
		$error_course_id = '';
		$error = 0;
		if(empty($_POST["course_id"]))
		{
			$error_course_id = "Course is required";
			$error++;
		}
		else
		{
			$unique_id = $_POST["student_unique_id"];
			$course_id = $_POST["course_id"];
		}
		if($error > 0)
		{
			$output = array(
				'error'							=>	true,
				'error_course_id'		=>	$error_course_id
			);
		}
		else
		{
			$data = array(
				':unique_id'		=>	$unique_id,
				':course_id'	=>	$course_id
			);
			$query = "
			INSERT INTO student_course
			(student_unique_id, course_id) 
			VALUES (:unique_id, :course_id)
			";

			$statement = $connect->prepare($query);
			if($statement->execute($data))
			{
				$output = array(
					'success'		=>	'Your Enrollment Is Successfull',
				);
			}
		}
		echo json_encode($output);
	}
}

?>