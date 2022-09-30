<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Name : Login </title>
 
  <!-- Latest compiled and minified CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

   <!-- Optional theme -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  
 <style type="text/css">
   #btnsign {
    border-radius: 12px;
    box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
   }

   #username, #pswd {
    border-radius:  30px;
    text-align: center;
    font-size: 15px;
   }
 </style>
  </head>

  <body class="img js-fullheight"  >
      
    <?php include_once 'nav_bar.php'; ?>
   
    <div class="container-fluid" >
      <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3  text-center">
          <center> 
            <img src="https://cdn-icons-png.flaticon.com/512/616/616490.png" style="width: 40%" class="img-responsive">
          </center>
          <center>
            <form action="action.php" method="post" class="form-horizontal">
            <div class="form-group">
              <div class="col-sm-8 col-sm-offset-2">
                <input type="text" name="username" class="form-control" id="username" placeholder="Username"  required> 
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-8 col-sm-offset-2">
                <input type="password" name="pswd" class="form-control" id="pswd" placeholder="Password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$" required> 
              </div>
            </div>

            <div class="form-group">
              <br>
              <div class="col-md-offset-3  col-sm-6">
                <p><p>
                <button class="btn btn-primary btn-lg btn-block" id="btnsign" type="submit" name="login" >Sign In</button>
              </div>    
            </div>
          </form>
          </center>

          
        </div> <!-- class-->      
      </div> <!-- row 1 -->
    </div> <!-- container -->

   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
  </body>
  </html>