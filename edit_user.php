<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<br>
<div class="container">
  <h2>Edit User</h2>
  <?php
  $conn = mysqli_connect('localhost','root','','crud');
  if(isset($_GET['edit'])){
    $edit_id = $_GET['edit'];

    $select = "SELECT * FROM user WHERE user_id='$edit_id'";

    $run = mysqli_query($conn,$select);
    $row_user = mysqli_fetch_array($run);
      $user_name = $row_user['user_name'];
      $user_email = $row_user['user_email'];
      $user_password = $row_user['user_password'];
      $user_image = $row_user['user_image'];
      $user_details = $row_user['user_details'];
  }
  ?>
  <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
    <label>Name:</label>
      <input type="text" class="form-control" value="<?php echo $user_name?>"  placeholder="Name" name="user_name">
      </div>
      <div class="form-group">
    <label for="email">Email:</label>
      <input type="email" class="form-control" value="<?php echo $user_email?>" id="email" placeholder="Enter email" name="user_email">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" value="<?php echo $user_password?>" id="pwd" placeholder="Enter password" name="user_password">
    </div>
    <div class="form-group">
    <label>Image:</label>
      <input type="file" class="form-control"  placeholder="Name" name="user_image">
      </div>
      <div class="form-group">
    <label>Details:</label>
      <textarea class="form-control" name="user_details"><?php echo $user_details?></textarea>
 
    </div>
    <input type="submit" name="insert-btn" class="btn btn-primary"/>
  </form>


  <?php
        $conn = mysqli_connect('localhost','root','','crud');
        // if(mysqli_connect_errno()) {
        //     echo "connection fail";
        // } else {
        //     echo "connection OK";
        // }

        if(isset($_POST['insert-btn'])){

           $euser_name = $_POST['user_name'];
           $euser_email = $_POST['user_email'];
           $euser_password = $_POST['user_password']; 
           $eimage = $_FILES['user_image']['name'];  
           $etmp_name = $_FILES['user_image']['tmp_name'];  
           $euser_details = $_POST['user_details'];

            if(empty($eimage)){
                $eimage =  $user_image;
            }

           $update = "UPDATE user SET user_name='$euser_name',
           user_email='$euser_email',
           user_password='$euser_password',
           user_image='$eimage',
           user_details='$euser_details' WHERE user_id='$edit_id'";

            $run_update = mysqli_query($conn,$update);
            if($run_update === true){
                echo "Data has been updated";
                move_uploaded_file($etmp_name,"upload/$eimage");
            } else {
                echo "failed";
            }
        }
        
       
    ?>

<br/>
        <a class="btn btn-primary" href="view_user.php">View User</a>







</div>

</body>
</html>
