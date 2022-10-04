<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NewPost</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
    </script>
    <style>
        textarea {
            resize: none;
            scroll-behavior: auto;
        }
    </style>
</head>

<body>
    <!-- <form action="staffcrud.php" method="post">
        <label for="title">Title</label>
        <input type="text" name="title" id="title">
        <br>
        <label for="description">Description</label><br>
        <textarea name="description" id="description" cols="30" rows="10"></textarea>
        <br>
        <label for="location">Location</label>
        <input type="text" name="location" id="location">
        <br>
        <label for="noofvolunteer">Volunteer Needed</label>
        <input type="number" name="noofvolunteer" id="noofvolunteer">
        <br>
        <input type="submit" name="submit" value="Submit">
    </form> -->
    <div class="container-fluid">
        <div class="row">
            <div id="inside-row" class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1">

                <?php if (isset($failed) && ($failed === true)) {
                    echo '<div id="errorlogin" class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <strong>Error!</strong> Please enter a correct username and password. Note that both fields may be case sensitive.</div>';
                } ?>
                <form action="newpost_crud.php" method="post" class="form-horizontal" style="margin-bottom: 20px;">
                    <div class="form-group">
                        <label for="title" class="col-sm-3 control-label">Title</label>
                        <div class="col-sm-9">
                            <input name="title" type="text" class="form-control" id="title" placeholder="Title" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-9">
                            <textarea name="description" class="form-control w-100" id="description" placeholder="Description" cols="30" rows="5" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="location" class="col-sm-3 control-label">Location</label>
                        <div class="col-sm-9">
                            <input name="location" type="text" class="form-control" id="location" placeholder="Location" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="noofvolunteer" class="col-sm-3 control-label">Volunteer Needed</label>
                        <div class="col-sm-9">
                            <input name="noofvolunteer" type="number" class="form-control" id="noofvolunteer" placeholder="Minimum require 1 volunteer" step="1" min="1" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button class="btn btn-default pull-right" type="submit" name="submit"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Post</button>

                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>

</html>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>