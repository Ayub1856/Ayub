<?php

session_start();
include_once "config.php";

$fname = mysqli_real_escape_string($conn ,$_POST['fname']);
$lname = mysqli_real_escape_string($conn ,$_POST['lname']);
$email = mysqli_real_escape_string($conn ,$_POST['email']);
$password = mysqli_real_escape_string($conn ,$_POST['password']);

if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        $sql = "SELECT email FROM `students` WHERE email = '$email' ";
        $result = $conn -> query($sql); 
        if(mysqli_num_rows($result) > 0){
            echo 'This email already exist';
        }else{
            if(isset($_FILES['image'])){
                 $img_name = $_FILES['image']['name'];
                 $img_type = $_FILES['image']['type'];
                 $tmp_name = $_FILES['image']['tmp_name'];

                 $img_explode = explode('.',$img_name);
                 $img_ext = end($img_explode);

                 $extension = ['png','jpeg','jpg'];
                 if(in_array($img_ext, $extension) === true){
                    $time = time();

                    $new_img_name = $time.$img_name;
                    if(move_uploaded_file($tmp_name,"images/".$new_img_name)){
                        $random_id = rand(time(), 100000000);
                        $sql2 = "INSERT INTO `students` (`unique_id`, `fname`, `lname`, `email`, `password`, `img`)
                                VALUES ('$random_id', '$fname', '$lname', '$email', '$password', '$new_img_name')";
                        $result2 = $conn -> query($sql2);
                        if($result2){
                            $sql3 = "SELECT * FROM `students` WHERE email = '$email'";
                            $result3 = $conn -> query($sql3); 
                            if($resultCheck = mysqli_num_rows($result3) > 0){
                                $row = mysqli_fetch_assoc($result3);
                                $_SESSION['unique_id'] = $row['unique_id'];  

                                echo 'success';
                            }
                        }else{
                            echo 'Signup unsuccessfull';
                        }
                         }
                 }else{
                    echo 'Please select a valid image file - jpeg, jpg, png!';
                 }
            }else{
                echo 'Please select an image';
            }
        }

    }else{
        echo "$email - is not a valid email";  
    }

}else{
    echo 'All fields are required';
}

?>