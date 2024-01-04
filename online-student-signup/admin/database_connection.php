<?php

//database_connection.php
$servername = "localhost";
$uName = "root";
$Pass = "";

$con = new mysqli('localhost','root','','derison');

if($con){
}else{
  die(mysqli_error($con));
}
$connect = new PDO("mysql:host=localhost;dbname=derison","root","");

$connect = new PDO("mysql:host=localhost;dbname=derison","root","");

$base_url = "http://localhost/online-student-signup/";

function get_total_records($connect, $table_name)
{
	$query = "SELECT * FROM $table_name";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}

function load_course_list($connect)
{
	$query = "
	SELECT * FROM tbl_course ORDER BY course_name ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["course_id"].'">'.$row["course_name"].'</option>';
	}
	return $output;
}


function Get_student_name($connect, $student_id)
{
	$query = "
	SELECT student_name FROM tbl_student 
	WHERE student_id = '".$student_id."'
	";

	$statement = $connect->prepare($query);

	$statement->execute();

	$result = $statement->fetchAll();

	foreach($result as $row)
	{
		return $row["student_name"];
	}
}

function Get_student_course_name($connect, $student_id)
{
	$query = "
	SELECT tbl_course.course_name FROM tbl_student 
	INNER JOIN tbl_course 
	ON tbl_course.course_id = tbl_student.student_course_id 
	WHERE tbl_student.student_id = '".$student_id."'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row['course_name'];
	}
}

function Get_course_name($connect, $course_id)
{
	$query = "
	SELECT course_name FROM tbl_course 
	WHERE course_id = '".$course_id."'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row["course_name"];
	}
}

?>