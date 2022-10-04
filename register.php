<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title> Register Form </title>

  <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/616/616490.png" type="image/x-icon">
  <link rel="stylesheet" href="style.css">

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
  </script>



  <style type="text/css">
    html {
      margin-bottom: 50px;
    }
  </style>
</head>

<body class="img js-fullheight">
  <?php include_once 'nav_bar.php'; ?>
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3  text-center">
        <center>
          <h1 style="margin: 50px;">Register Form</h1>
        </center>
      </div>

      <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 ">
        <form action="reg_action.php" method="post">
          <div class="form-row">
            <div class="form-group col-md-6" style="padding-left: 0px;">
              <label for="fname">First Name: </label>
              <input type="fname" class="form-control" name="fname" id="fname" placeholder="First Name" required>
            </div>
            <div class="form-group col-md-6" style="padding-left: 0px;">
              <label for="lname">Last Name: </label>
              <input type="lname" class="form-control" name="lname" id="lname" placeholder="Last Name" required>
            </div>
          </div>

          <div class="form-group">
            <label for="email">Email address : </label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required focus>
          </div>

          <div class="form-group">
            <label for="pswd">Password : </label>
            <input type="password" class="form-control" name="passwordd" id="password" placeholder="Enter the Password" aria-describedby="pswdhelp" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,20}$" required>
            <small id="pswdhelp" class="form-text text-muted">
              <ul>
                <li>At least 1 Uppercase</li>
                <li>At least 1 Lowercase</li>
                <li>At least 1 Number</li>
                <li>At least 1 Symbol, symbol allowed --> !@#$%^&*_=+-</li>
                <li>Min 8 chars and Max 20 chars</li>
              </ul>
            </small>
          </div>

          <div class="form-group">
            <label for="confirmpassword">Confirm Password : </label>
            <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="Repeat the Password" required>
          </div>


          <div class="form-group">
            <label>Gender: </label>
            <div class="radio">
              <label for="male"><input type="radio" name="gender" id="male" value="male" checked> Male </label>
            </div>
            <div class="radio">
              <label for="female"><input type="radio" name="gender" id="female" value="female"> Female </label>
            </div>
          </div>

          <div class="form-group">
            <label for="phone">Phone Number : </label>
            <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter phone number" required>
          </div>

          <div class="form-group">
            <label for="address">Address : </label>
            <textarea class="form-control" col="50" row="4" id="address" name="address" required></textarea>
          </div>

          <button type="submit" class="btn btn-primary btn-lg btn-block " id="btnregister" name="register">Register</button>
        </form>
        <p id="test"></p>



      </div> <!-- class-->
    </div> <!-- row 1 -->
  </div> <!-- container -->

  </form>

  <script type="text/javascript">
    var password = document.getElementById("password");
    var confirmpassword = document.getElementById("confirmpassword");

    function validatePassword() {
      if (password.value != confirmpassword.value) {
        confirmpassword.setCustomValidity("Passwords Don't Match");
      } else {
        confirmpassword.setCustomValidity('');
      }
    }

    password.onchange = validatePassword;
    confirmpassword.onkeyup = validatePassword;
  </script>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>

</html>