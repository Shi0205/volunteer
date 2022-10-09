<?php 
include_once 'database.php';
session_start();

if (! isset($_SESSION['id'])) {
  header("Location:login.php");
} 

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $currenttime = date('Y-m-d H:i:s');
    $stmt = $conn->prepare("SELECT * FROM post WHERE eventdate >= :currenttime ORDER BY eventdate LIMIT 3");
    $stmt->bindParam(":currenttime", $currenttime, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Star Tech</title>
  <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/616/616490.png" type="image/x-icon">
  <link rel="stylesheet" href="style.css">

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  
  <style>
      body {
        /*background-color: #4f9a94;*/
        /*background-color: #B1D8B7;*/
       
      }
      
      .c-black {
          color: black;
      }
      
      .c-white{
          color: white;
      }
      
      .bg-1, .bg-2{
        margin-bottom: 0px;
        margin-top: 30px;
        margin-left:0px;
        margin-right:0px;
        padding: 0px 20px;
      }
      
     /* .bg-1 {
          background-color: #116530;
          color: #ffffff;
          margin: 20px 0;
      }*/
      
      .bg-2 {
          background-color: #21B6A8;
          text-align: center;
          padding-bottom: 20px;
      }
      
      .bg-3 {
          padding-bottom: 50px;
      }
      
      #bg-3-h3 {
          padding-bottom: 20px;
      }
      
      .bg-4 {
          background-color: #edeff2;
          padding-top: 20px;
          padding-bottom: 20px;
      }
      

      
     .social-div {
          border-bottom: 1px solid;
          margin-bottom: 5px;
      }
     
    .bg-5 {
      /*background-color: #2f2f2f;*/
      background-color: #4f9a94;
      color: #ffffff;
      padding-top: 50px;
      padding-bottom: 50px;
      padding-left: 50px;
 }

footer.glyphicon {
      font-size: 20px;
      margin-bottom: 20px;
      color: #ffffff;
} 
    
    .center {
        text-align: center;
    }
    

  </style>
</head>

<body id="myPage" >
  <?php include_once 'nav_bar.php';  ?>
  
  <div class="row bg-1" >
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" >
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox" style="height: 480px; width:auto; ">
        <div class="item active ">
          <img src="https://149402086.v2.pressablecdn.com/wp-content/uploads/fun-facts.png" alt="Hand with sand and earth" >
          <div class="carousel-caption">
            <p class="c-black"> Protect the world ! </p>
          </div>
        </div>
        <div class="item ">
          <img src="https://www.bhp.com/-/media/images/2021/cattle-gorge_2021_2123x991.jpg?w=1200&hash=E8A20454612B6C7F2603F233A4C1C11E" alt="tree" >
          <div class="carousel-caption">
            <P class="c-black"> Clean the river !</P>
          </div>
        </div>
        <div class="item ">
          <img src="https://s2.research.com/wp-content/uploads/2022/05/06092018/environmental-1200x600.jpeg" alt="waterdrop" >
          <div class="carousel-caption">
            <p class="c-black"> World need you !</p>
          </div>
        </div>
      </div>

      <!-- Controls -->
      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    
  </div>
  
  <div class="container-fluid bg-2 ">
      <h3>What Star Tech can do ? </h3>
      <div class="row">
          <div class="col-sm-4 col-xs-12">
              <p>Become a platform for volunteers to view the environmental event.</p>
              <img src="https://www.eventbrite.co.uk/blog/wp-content/uploads/2022/06/iStock-670719454.jpg"  alt="People doing volunteering image" class="img-responsive"  style="display: inline;">
          </div>
          <div class="col-sm-4 col-xs-12 ">
              <p>Encourage volunteers to involve in the suitable environmental event.</p>
              <img src="https://transcode-v2.app.engoo.com/image/fetch/f_auto,c_lfill,w_300,dpr_3/https://assets.app.engoo.com/images/CGPkj72Wn3gPmu9ebqmpS1nGQNOZQlR70NilqMAWUBm.png"  alt="Clock image" class="img-responsive"  style="display: inline;">
          </div>
           <div class="col-sm-4 col-xs-12">
              <p>Record the history of events that participated.</p>
              <img src="https://blog.collabware.com/hs-fs/hubfs/case-file-pexels-image-1.jpeg?width=815&name=case-file-pexels-image-1.jpeg"  alt="File image" class="img-responsive"  style="display: inline;">
          </div>
      </div>
      
  </div>
  
  <div class="container-fluid bg-3">
      <h3 id="bg-3-h3">Current Hot Event: </h3>
      <div class="row">
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
                                    <?php if(isset($_SESSION['id'])) ?>
                                       <td><a href="modalconfirm.php?id=<?php echo $readrow['id'] ?>" class="btn btn-warning btn-xs" role="button">Details</a></td> 
                                    
                                </tr>
                        <?php }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
      </div>
  </div> <!-- Container -->
 
  
  <div class="container-fluid bg-4">
      <div class="row">
          <div class="col-sm-4 col-sm-offset-2 col-xs-12" id="AboutUs">
              <h4 class="center">About Us</h4>
              <p class="center">Star Tech is a simple website deployment for volunteers and organizations to interact and process environmental activism. Star Tech provides support to users that sign up with several functions. With the help of Star Tech, volunteers will be able to manage their volunteering activities and events orderly. </p>
          </div>
          <div class="col-sm-2 col-sm-offset-1 col-xs-12" id="SocialMedia">
              <h4 class="center">Social Media</h4>
              <div class="social-div">
                  <a href="index.php"><img src="https://raw.githubusercontent.com/eirikmadland/notion-icons/master/v5/icon5/ul-twitter.svg" width="20"> Twitter</a>
              </div>
              <div class="social-div">
                  <a href="index.php"><img src="https://raw.githubusercontent.com/eirikmadland/notion-icons/master/v5/icon5/ul-youtube.svg" width="20"> Youtube</a>
              </div>
               <div class="social-div">
                  <a href="index.php"><img src="https://raw.githubusercontent.com/eirikmadland/notion-icons/master/v5/icon5/ul-facebook.svg" width="20"> Facebook</a>
              </div>
               <div class="social-div">
                  <a href="index.php"><img src="https://raw.githubusercontent.com/eirikmadland/notion-icons/master/v5/icon5/ul-instagram-alt.svg" width="20"> Instagram</a>
              </div>
              <div class="social-div">
                  <a href="index.php"><img src="https://raw.githubusercontent.com/eirikmadland/notion-icons/master/v5/icon5/mt-email.svg" width="20"> Email</a>
              </div>
             
              
          </div>
      </div>
  </div>
  

  
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
  
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
  
  
<footer class="container-fluid bg-5 text-center">
    <a href="#myPage" title="To Top">
      <span class="glyphicon glyphicon-chevron-up"></span>
    </a>
    <p>Copyright @ Star Tech's Website 2022 </p>
</footer>

</body>


</html>
