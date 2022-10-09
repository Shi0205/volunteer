<?php
include_once 'database.php';
session_start();
if (!isset($_SESSION["id"])) {
    header("Location: login.php");
}
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $currenttime = date('Y-m-d H:i:s');
    $stmt = $conn->prepare("SELECT * FROM post WHERE eventdate >= :currenttime ORDER BY eventdate");
    $stmt->bindParam(":currenttime", $currenttime, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Event</title>
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/616/616490.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">

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

<body id="myPage>
    <?php
    include_once 'nav_bar.php';

    if (isset($_GET['success'])) {
        if ($_GET['success'] == "true") {
            echo '<div id="errorlogin" class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
            <strong>Success!</strong> You have successfully registered to the event</div>';
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
    if (isset($_GET['success'])) {
        if ($_GET['success'] == "added") {
            echo '<div id="errorlogin" class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
            <strong>Success!</strong> You have successfully posted the event</div>';
        }
    }
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3" style="padding-bottom: 10px;">
                <center>
                    <h2>Volunteer Needed</h2>
                </center>
            </div>

            <div <?php if ($_SESSION['admin'] == false) {
                        echo "style='display:none'";
                    } ?> class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1" style="padding-bottom:20px;">
                <!-- Button trigger modal -->

                <button type="button" class="btn btn-success openBtn pull-left">Add New Post</button>
            </div>

            <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1">

                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <!-- <th>Post ID</th> -->
                            <th>Event Date</th>
                            <th>Title</th>
                            <!-- <th>Description</th> -->
                            <th>Location</th>
                            <th>Volunteer Needed</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($result as $readrow) {
                            if ($readrow['noofvolunteer'] > 0) { ?>
                                <tr>
                                    <!-- <td><?php echo $readrow['id'] ?></td> -->
                                    <td><?php echo $readrow['eventdate'] ?></td>
                                    <td><?php echo $readrow['title'] ?></td>
                                    <!-- <td><?php echo $readrow['description'] ?></td> -->
                                    <td><?php echo $readrow['location'] ?></td>
                                    <td><?php echo $readrow['noofvolunteer'] ?></td>
                                    <td><a href="modalconfirm.php?id=<?php echo $readrow['id'] ?>" class="btn btn-warning btn-xs" role="button">Details</a></td>
                                </tr>
                        <?php }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div> <!-- container fluid -->
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3" style="padding-bottom: 10px;">
                <center>
                    <h2>Volunteer Fulfilled</h2>
                </center>
            </div>

            <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1">

                <table id="datatable2" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <!-- <th>Post ID</th> -->
                            <th>Event Date</th>
                            <th>Title</th>
                            <!-- <th>Description</th> -->
                            <th>Location</th>
                            <th>Volunteer Needed</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($result as $readrow) {
                            if ($readrow['noofvolunteer'] == 0) { ?>
                                <tr>
                                    <!-- <td><?php echo $readrow['id'] ?></td> -->
                                    <td><?php echo $readrow['eventdate'] ?></td>
                                    <td><?php echo $readrow['title'] ?></td>
                                    <!-- <td><?php echo $readrow['description'] ?></td> -->
                                    <td><?php echo $readrow['location'] ?></td>
                                    <td><?php echo $readrow['noofvolunteer'] ?></td>
                                    <td><a href="modalconfirm.php?id=<?php echo $readrow['id'] ?>" class="btn btn-warning btn-xs" role="button">Details</a></td>
                                </tr>
                        <?php }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div><!-- container fluid -->

    <!-- Modal -->
    <div class="modal fade" id="newpostModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header ">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title" id="exampleModalLabel">Add New Post</h3>

                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>


 <footer class="container-fluid bg-5 text-center">
    <a href="#myPage" title="To Top">
      <span class="glyphicon glyphicon-chevron-up"></span>
    </a>
    <p>Copyright @ Star Tech's Website 2022 </p>
</footer>



</body>

</html>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

<!-- Datatable plug in -->
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script> -->

<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
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
    $(document).ready(function() {
        $('#datatable2').DataTable({
            "lengthMenu": [
                [5, 10, 20, 30, -1],
                [5, 10, 20, 30, "All"]
            ]
        });
    });
</script>

<!-- Modal -->
<script>
    $('.openBtn').on('click', function() {
        $('.modal-body').load('newpost.php', function() {
            $('#newpostModal').modal({
                show: true
            });
        });
    });
</script>
