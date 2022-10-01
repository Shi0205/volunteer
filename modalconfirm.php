<?php
include_once 'database.php';
$volunteerid = "tes1t";
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

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
    </script>
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
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $conn = null;

        ?>
        <form action="modalconfirm.php" method="post">
            <?php if ($result2 == null) { ?>
                <button name="id" value="<?php echo $result['id'] ?>">Submit</button>
            <?php } else { ?>
                <button disabled name="id" value="<?php echo $result['id'] ?>">Registered</button>
            <?php } ?>

        </form>
        <a href="post.php">Back</a>
    </center>

</body>

</html>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>