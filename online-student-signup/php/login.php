<?php

session_start();
include_once "config.php";

$email = mysqli_real_escape_string($conn ,$_POST['email']);
$password = mysqli_real_escape_string($conn ,$_POST['password']);

if(!empty($email) && !empty($password)){
    $sql = "SELECT * FROM `students` WHERE email = '$email' AND password = '$password';";
    $result = $conn -> query($sql); 
    if($resultCheck = mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $_SESSION['unique_id'] = $row['unique_id']; 
        echo 'success' ;
    }else{
        echo "Incorrect email or password:".$conn -> error;
    }

}else{
    echo"All feilds are required";
}
?>