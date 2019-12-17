<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>PHP CRUD</title>
</head>
<body>
    <div class="container">
    <?php
        require_once 'process.php';
    ?>

    <?php
        if(isset($_SESSION['message'])):
    ?>

    <div class="alert alert-<?=$_SESSION['message_type']?>">
            <?php
                echo $_SESSION['message'];
                //unset($_SESSION['message']);
            ?>
    </div>
        <?php  endif; ?>


    <?php
        $mysqli = new mysqli('localhost','root','','crud') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
       // print_r($result);

       //fecth associated array and print 
       //print_r($result->fetch_assoc());      
    ?>
    <div class="row justify-content-center">
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th colspan="2"></th>
                </tr>
            </thead>
    <?php
    //loop for fetch associative array keys 
        while($row = $result->fetch_assoc()):?>         
                <tr>
                    <td><?php echo $row["name"];?></td>
                    <td><?php echo $row["location"];?></td>
                    <td>
                    <!--edit and delete variable is being passed-->
                        <a href="index.php?edit=<?php echo $row['id']; ?>"
                        class="btn btn-info">Edit</a>
                        <a href="index.php?delete=<?php echo $row['id']; ?>"
                        class="btn btn-danger">Delete</a>
                    </td>
                </tr>
         <?php  endwhile; ?> 
            </table>
    </div>
        <div class="row justify-content-center">
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <div class="form-group">
                <label for="name"></label>
                <input type="text" name="name" class="form-control" value="<?php echo $name;?>" placeholder="Enter your name">
                <label for="location"></label>
                <input type="text" name="location" class="form-control" value="<?php echo $location;?>" placeholder="Enter your location">
            </div>
            <div class="form-group">
                <?php
                if($update == true):?>
                <button type="submit" class="btn btn-info" name="update">Update</button>
                <?php else: ?>
                <button class="btn btn-success" type="save" name="save">Save</button>
                <?php endif;?>
            </div>
        </form>
        </div>
    </div>
</body>
</html>

