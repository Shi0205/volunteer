<?php
include_once 'admins_crud.php';
include_once 'nav_bar.php';

?>

<?php

if (!isset($_SESSION["id"])) {
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Star Tech : Admins</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">

                <div class="page-header">
                    <h2>Add New Admin</h2>
                </div>

                <form action="admins.php" method="post" class="form-horizontal">
                    <div class="form-group">
                        <label for="fname" class="col-sm-3  control-label">First Name : </label>
                        <div class="col-sm-9">
                            <input type="text" name="fname" class="form-control" id="fname" placeholder="First Name" value="<?php if (isset($_GET['edit'])) echo $editrow['fld_admin_fname']; ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="lname" class="col-sm-3  control-label">First Name : </label>
                        <div class="col-sm-9">
                            <input type="text" name="lname" class="form-control" id="lname" placeholder="Last Name" value="<?php if (isset($_GET['edit'])) echo $editrow['fld_admin_lname']; ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-sm-3  control-label">Email : </label>
                        <div class="col-sm-9">
                            <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="<?php if (isset($_GET['edit'])) echo $editrow['fld_admin_email']; ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="passwordd" class="col-sm-3  control-label">Password : </label>
                        <div class="col-sm-9">
                            <input type="password" name="passwordd" class="form-control" id="passwordd" placeholder="Password" value="<?php if (isset($_GET['edit'])) echo $editrow['fld_user_password']; ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3  control-label">Gender : </label>
                        <div class="col-sm-9">
                            <div class="radio">
                                <label><input type="radio" name="gender" value="male" id="male" <?php if (isset($_GET['edit'])) if ($editrow['fld_admin_gender'] == "male") echo "checked"; ?> checked required> Male </label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="gender" value="female" id="female" <?php if (isset($_GET['edit'])) if ($editrow['fld_admin_gender'] == "female") echo "checked"; ?>> Female </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="phone" class="col-sm-3  control-label">Phone Number : </label>
                        <div class="col-sm-9">
                            <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone Number" value="<?php if (isset($_GET['edit'])) echo $editrow['fld_admin_phone']; ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address" class="col-sm-3 control-label">Address : </label>
                        <div class="col-sm-9">
                            <textarea class="form-control" col="50" row="6" id="address" name="address" required><?php if (isset($_GET['edit'])) echo $editrow['fld_admin_address']; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-3  col-sm-9">
                            <?php if (isset($_GET['edit'])) { ?>
                                <input type="hidden" name="oldaid" value="<?php echo $editrow['fld_admin_id']; ?>">
                                <button class="btn btn-default" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
                            <?php } else { ?>
                                <button type="submit" class="btn btn-default" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
                            <?php } ?><button class="btn btn-default" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>
                        </div>
                    </div>

                </form>
            </div>
        </div> <!-- row  -->

        <div class="row">
            <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                <div class="page-header"><br>
                    <h2>Admin List</h2>
                </div>

                <table id="vlist" class="table table-striped table-bordered" style="width:100%">
                    <thread>
                        <th>Admin ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th></th>
                    </thread>

                    <tbody>
                        <?php
                        $per_page = 45;
                        if (isset($_GET["page"]))
                            $page = $_GET["page"];
                        else
                            $page = 1;
                        $start_form = ($page - 1) * $per_page;

                        try {
                            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $stmt = $conn->prepare("SELECT * FROM tbl_admins LIMIT $start_form, $per_page");
                            $stmt->execute();
                            $result = $stmt->fetchAll();
                        } catch (PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                        foreach ($result as $readrow) {
                        ?>
                            <tr>
                                <td><?php echo $readrow['fld_admin_id']; ?></td>
                                <td><?php echo $readrow['fld_admin_fname']; ?></td>
                                <td><?php echo $readrow['fld_admin_lname']; ?></td>
                                <td><?php echo $readrow['fld_admin_email']; ?></td>
                                <td><?php echo $readrow['fld_admin_gender']; ?></td>
                                <td><?php echo $readrow['fld_admin_phone']; ?></td>
                                <td><?php echo $readrow['fld_admin_address']; ?></td>
                                <td>
                                    <a href="admins.php?edit=<?php echo $readrow['fld_admin_id']; ?>" class="btn btn-success btn-xs" role="button">Edit</a>
                                    <a href="admins.php?delete=<?php echo $readrow['fld_admin_id']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
                                </td>
                            </tr>
                        <?php  } ?>
                    </tbody>

                </table>
            </div>
        </div> <!-- row  -->




    </div> <!-- container-fluid -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                lengthMenu: [
                    [5, 10, 20, 30, -1],
                    [5, 10, 20, 30, 'All'],
                ],
            });
        });
    </script>
</body>

</html>