<?php

include_once 'volunteers_crud.php';

if (!isset($_SESSION['admin'])) {
    header("Location:login.php");
} else if ($_SESSION['admin'] == true) {
    header("Location:login.php");
}



try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM tbl_volunteers INNER JOIN tbl_users ON tbl_volunteers.fld_volunteer_id = tbl_users.fld_user_id  WHERE fld_volunteer_id=:vid");
    $stmt->bindParam(':vid' , $volunteerid, PDO::PARAM_STR);
    $volunteerid = $_SESSION['id'];
    
    $stmt->execute();
    $readresult = $stmt->fetch();
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;


?>

<!DOCTYPE html>
<html lang="en">
    <head>
          <meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          
          <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
          <title> Profile </title> 
          <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/616/616490.png" type="image/x-icon">
          
                  
                 
          <!-- Latest compiled and minified CSS -->
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
          
          <!-- Optional theme -->
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
          
          <!-- Latest compiled and minified JavaScript -->
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
          </script>
        
 

    </head>
    <body>
        
        <?php include_once 'nav_bar.php';
        if (isset($_GET['success'])) {
            if ($_GET['success'] == "true") {
            echo '<div id="errorlogin" class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
            <strong>Success!</strong> You have successfully unregistered the event</div>';
            }
        }
        if (isset($_GET['success'])) {
            if ($_GET['success'] == "false") {
            echo '<div id="errorlogin" class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <strong>Error!</strong>' . $_GET['msg'] . ' </div>';
            }
        }
        ?>
        
        
        <div class="container-fluid">
            <div class="row col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 ">
                <div class="page-header ">
                    <h1>Profile</h1>
                </div>
                
                <form action="profile.php" method="post" class="form-horizontal">
                      <div class="form-group">
                      <label for="vid" class="col-sm-3 control-label">Volunteer's ID : </label>
                        <div class="col-sm-9">
                            <input type="text" name="vid" class="form-control" id="vid" value="<?php  echo $readresult['fld_volunteer_id']; ?>"  disabled readonly>
                        </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="fname" class="col-sm-3 control-label">First Name : </label>
                        <div class="col-sm-9">
                            <input type="text" name="fname" class="form-control" id="fname"  value="<?php echo $readresult['fld_volunteer_fname']; ?>" required>
                        </div>
                    </div>
                    
                     <div class="form-group">
                      <label for="lname" class="col-sm-3 control-label">Last Name : </label>
                        <div class="col-sm-9">
                            <input type="text" name="lname" class="form-control" id="lname"  value="<?php echo $readresult['fld_volunteer_lname']; ?>" required>
                        </div>
                    </div>
                    
                     <div class="form-group">
                      <label for="email" class="col-sm-3 control-label">First Name : </label>
                        <div class="col-sm-9">
                            <input type="email" name="email" class="form-control" id="email"  value="<?php echo $readresult['fld_volunteer_email']; ?>" required>
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label for="passwordd" class="col-sm-3  control-label">Password : </label>
                        <div class="col-sm-9">
                            <input type="password" name="passwordd" class="form-control" id="passwordd" placeholder="Password" value="<?php echo $readresult['fld_user_password']; ?>" required>
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label class="col-sm-3  control-label">Gender : </label>
                        <div class="col-sm-9">
                            <div class="radio">
                                <label><input type="radio" name="gender" value="male" id="male" <?php  if ($readresult['fld_volunteer_gender'] == "male") echo "checked"; ?> checked required> Male </label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="gender" value="female" id="female" <?php if ($readresult['fld_volunteer_gender'] == "female") echo "checked"; ?>> Female </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="phone" class="col-sm-3 control-label">Phone Number : </label>
                        <div class="col-sm-9">
                            <input type="text" name="phone" class="form-control" id="phone"  value="<?php echo $readresult['fld_volunteer_phone']; ?>" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="address" class="col-sm-3 control-label">First Name : </label>
                        <div class="col-sm-9">
                            <textarea class="form-control" col="50" row="6" id="address" name="address" required><?php echo $readresult['fld_volunteer_address']; ?></textarea>
                        </div>
                    </div>
                    
                    
                    <div class="form-group" style="margin-top: 20px;">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end pull-right " >
                             <input type="hidden" name="oldid" value="<?php echo $readresult['fld_volunteer_id']; ?>" >
                             <button class="btn btn-lg me-md-2" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
                             <button class="btn btn-lg" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>
                        </div>
                    </div>
                    
                    
                    
                    
                  
                </form>
          
                
                
                
            </div> <!-- row -->
        </div> <!-- container -->
        
        
        
        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
        
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

    </body>
    
</html>
