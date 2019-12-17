<?php
   session_start();
    // $host = 'localhost';
    // $username = 'root';
    // $password = '';
    // $db = 'crud';
    // $conn = mysqli_connect($host,$username,$password);
    $mysqli = new mysqli("localhost","root","","crud");

    $name = '';
    $location = '';
    $update = false;
    // $id = 0;

    if(isset($_POST['save'])){
        $name = $_POST['name'];
        $location = $_POST['location'];
        // $sqlresult = "INSERT INTO `data`(`name`, `location`) VALUES ('$name','$location')";
        // mysqli_select_db($conn,$sqlresult);

        $mysqli->query("INSERT INTO `data`(`name`, `location`) VALUES ('$name','$location')") or
            die($mysqli->error);

        $_SESSION['message'] = "Record has been saved";
        $_SESSION['message_type'] = "success";

        header('location: index.php');
    }
   //if delete button is clicked, get id and delete
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $mysqli->query("Delete FROM data where id = $id") or die($mysqli->error());

        $_SESSION['message'] = "Record has been deleted";
        $_SESSION['message_type'] = "danger";

        header('location: index.php');
    }


    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        $update = true;
        $result = $mysqli->query("SELECT * FROM data WHERE id = $id") or die($mysqli->error());
        if (count($result)==1){
            $row = $result->fetch_array();
            $name = $row['name'];
            $location = $row['location'];
        }
    }

    //update existing record
    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $newname = $_POST['name'];
        $newlocation = $_POST['location'];

        $mysqli->query("UPDATE data SET name='$newname', location = '$newlocation' WHERE id = $id")
        or die($mysqli->error());

        $_SESSION['message'] = "Record has been updated!";
        $_SESSION['message_type'] = "warning"; 

        header('location: index.php');
    }
?>