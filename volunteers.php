<?php

include_once 'volunteers_crud.php';


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM tbl_volunteers");
    $stmt->execute();
    $result = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>

<?php

if (!isset($_SESSION["id"])) {
    header("Location: login.php");
}
if (isset($_SESSION['admin'])) {
    if ($_SESSION['admin'] != true) {
        header("Location:post.php");
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteers</title>

    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/616/616490.png" type="image/x-icon">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <!-- Datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap.min.css">
    
     <style>
    .bg-5 {
      /*background-color: #2f2f2f;*/
      background-color: #4f9a94;
      color: #ffffff;
      margin-top: 30px;
      padding-top: 50px;
      padding-bottom: 50px;
      padding-left: 50px;
    }

    footer.glyphicon {
      font-size: 20px;
      margin-bottom: 20px;
      color: #ffffff;
    } 
 </style>



</head>

<body id="myPage">
    <?php include_once 'nav_bar.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">

                <div class="page-header">
                    <h2>Add New Volunteers</h2>
                </div>

                <form action="volunteers.php" method="post" class="form-horizontal">
                    <div class="form-group">
                        <label for="fname" class="col-sm-3  control-label">First Name : </label>
                        <div class="col-sm-9">
                            <input type="text" name="fname" class="form-control" id="fname" placeholder="First Name" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="lname" class="col-sm-3  control-label">First Name : </label>
                        <div class="col-sm-9">
                            <input type="text" name="lname" class="form-control" id="lname" placeholder="Last Name" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-sm-3  control-label">Email : </label>
                        <div class="col-sm-9">
                            <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="passwordd" class="col-sm-3  control-label">Password : </label>
                        <div class="col-sm-9">
                            <input type="password" name="passwordd" class="form-control" id="passwordd" placeholder="Password" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3  control-label">Gender : </label>
                        <div class="col-sm-9">
                            <div class="radio">
                                <label><input type="radio" name="gender" value="male" id="male" checked required> Male </label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="gender" value="female" id="female" checked required> Female </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="phone" class="col-sm-3  control-label">Phone Number : </label>
                        <div class="col-sm-9">
                            <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone Number" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address" class="col-sm-3 control-label">Address : </label>
                        <div class="col-sm-9">
                            <textarea class="form-control" col="50" row="6" id="address" name="address" required></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-3  col-sm-9">
                            <button class="btn btn-default" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
                            <button type="reset" class="btn btn-default"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>
                        </div>
                    </div>

                </form>
            </div>
        </div> <!-- row  -->

        <div class="row">
            <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1">
                <div class="page-header"><br>
                    <h2>Volunteer List</h2>
                </div>

                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <!-- <th>Post ID</th> -->
                            <th>Volunteer's ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <!-- <th>Description</th> -->
                            <th>Gender</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        foreach ($result as $readrow) {
                        ?>
                            <tr>
                                <td><?php echo $readrow['fld_volunteer_id'] ?></td>
                                <td><?php echo $readrow['fld_volunteer_fname'] ?></td>
                                <td><?php echo $readrow['fld_volunteer_lname'] ?></td>
                                <td><?php echo $readrow['fld_volunteer_email'] ?></td>
                                <td><?php echo $readrow['fld_volunteer_gender'] ?></td>
                                <td><?php echo $readrow['fld_volunteer_phone'] ?></td>
                                <td><?php echo $readrow['fld_volunteer_address'] ?></td>
                                <td><a href="volunteers.php?delete=<?php echo $readrow['fld_volunteer_id']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button" style="<?php if ($_SESSION['admin'] == false) echo 'display: none;' ?>">Delete</a></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div> <!-- row  -->




    </div> <!-- container-fluid -->
    
 <footer class="container-fluid bg-5 text-center">
    <a href="#myPage" title="To Top">
      <span class="glyphicon glyphicon-chevron-up"></span>
    </a>
    <p>Copyright @ Star Tech's Website 2022 </p>
</footer>




    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                "lengthMenu": [
                    [5, 10, 20, 30, -1],
                    [5, 10, 20, 30, "All"]
                ]
            });
        });
    </script>
</body>


</html>
