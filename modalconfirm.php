<?php
include_once 'database.php';
session_start();
$volunteerid = $_SESSION['id'];
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM post WHERE id=:id");
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();

        $stmt = $conn->prepare("INSERT INTO tbl_post_volunteer(id, fld_volunteer_id) VALUES (:id, :volunteerid)");

        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->bindParam(':volunteerid', $volunteerid, PDO::PARAM_STR);
        $stmt->execute();

        $stmt2 = $conn->prepare("UPDATE post SET noofvolunteer=noofvolunteer-1 WHERE id=:id");
        $stmt2->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt2->execute();

        $conn->commit();

        header("Location:post.php?success=true");
    } catch (PDOException $e) {
        $conn->rollBack();
        echo "Error: " . $e->getMessage();
        header("Location:post.php?success=false&msg=" . $e->getMessage());
    }

    $conn = null;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Details</title>

    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/616/616490.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
    </script>

    <!-- Datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap.min.css">
</head>

<body>
    <?php include_once 'nav_bar.php' ?>
    <div class="container-fluid">
        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">
                <!-- 
                col-xs-12 col-sm-5 col-md-4

                 -->
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Event Details</strong></div>
                    <table class="table">
                        <tr>
                            <td class="col-xs-4 col-sm-4 col-md-4"><strong>Event ID</strong></td>
                            <td><?php echo $result['id'] ?></td>
                        </tr>
                        <tr>
                            <td><strong>Title</strong></td>
                            <td><?php echo $result['title'] ?></td>
                        </tr>
                        <tr>
                            <td><strong>Location</strong></td>
                            <td><a href="https://maps.google.com/?q=<?php echo $result['location'] ?>"><?php echo $result['location'] ?></a></td>
                        </tr>
                        <tr>
                            <td><strong>Event Date</strong></td>
                            <td><?php echo $result['eventdate'] ?></td>
                        </tr>
                        <tr>
                            <td><strong>Description</strong></td>
                            <td><?php echo $result['description'] ?></td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <center>
        <?php
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("SELECT * FROM tbl_post_volunteer WHERE id=:id AND fld_volunteer_id=:volunteerid");
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':volunteerid', $volunteerid, PDO::PARAM_STR);
            $stmt->execute();
            $result2 = $stmt->fetch(PDO::FETCH_ASSOC);

            $stmt = $conn->prepare("SELECT noofvolunteer FROM post WHERE id=:id");
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
            $result4 = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $conn = null;

        ?>
        <form <?php if ($_SESSION['admin'] == true) {
                    echo "style='display:none'";
                } ?> action="modalconfirm.php" method="post">
            <?php
            /*
            if ($result4['noofvolunteer'] == 0) { ?>
                <button disabled name="id" value="<?php echo $result['id'] ?>">Full</button>
                <?php } else {
                if ($result2 == null) { ?>
                    <button name="id" value="<?php echo $result['id'] ?>">Register</button>
                <?php } else { ?>
                    <button disabled name="id" value="<?php echo $result['id'] ?>">Registered</button>
            <?php }
            } 
            */
            ?>
            <?php
            if ($result4['noofvolunteer'] != 0) {
                if ($result2 == null) { ?>
                    <button name="id" value="<?php echo $result['id'] ?>">Register</button>
                <?php } else { ?>
                    <button disabled name="id" value="<?php echo $result['id'] ?>">Registered</button>
                <?php }
            } else {
                if ($result2 == null) { ?>
                    <button disabled name="id" value="<?php echo $result['id'] ?>">Full</button>
                <?php } else { ?>
                    <button disabled name="id" value="<?php echo $result['id'] ?>">Registered</button>
            <?php }
            }  ?>

        </form>
        <a <?php if ($_SESSION['admin'] == true) {
                echo "style='display:none'";
            } ?> href="<?php echo $_SERVER['HTTP_REFERER'] ?>">Back</a>

    </center>
    <?php

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM tbl_volunteers WHERE fld_volunteer_id IN (SELECT fld_volunteer_id FROM tbl_post_volunteer WHERE id=:id)");
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        $stmt->execute();
        $result3 = $stmt->fetchAll();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;
    ?>
    <div <?php if ($_SESSION['admin'] == false) {
                echo "style='display:none'";
            } ?> class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1">
        <h2>Registered Volunteer</h2>

        <table id="datatable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Volunteer ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Gender</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($result3 as $readrow) { ?>
                    <tr>
                        <td><?php echo $readrow['fld_volunteer_id'] ?></td>
                        <td><?php echo $readrow['fld_volunteer_fname'] . " " . $readrow['fld_volunteer_lname'] ?></td>
                        <td><?php echo $readrow['fld_volunteer_email'] ?></td>
                        <td><?php echo $readrow['fld_volunteer_phone'] ?></td>
                        <td><?php echo $readrow['fld_volunteer_gender'] ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <center><a href="<?php echo $_SERVER['HTTP_REFERER'] ?>">Back</a></center>
    </div>


</body>

</html>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

<!-- Datatable plug in -->
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script> -->

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