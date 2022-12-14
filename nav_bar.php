<nav class="navbar navbar-default ">
  <div class="container-fluid bg-info " style="background-color:#80cbc4">
    <!--  Brand and toggle  get grouped for better mobile display -->
    <div class="navbar-header ">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      <a class="navbar-brand" href="index.php">
        <img src="https://cdn-icons-png.flaticon.com/512/616/616490.png" width="25" height="25" style="float: left; margin-bottom: 50px;">
        <div style="display: inline-block; margin-left: 10px;">Star Tech
        </div>
      </a>
    </div>
    <?php if ($_SESSION) { ?>
      <!-- Collect the nav links, forms, and other content for toggling  -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li><a href="index.php">Home</a></li>
          <?php
          if (isset($_SESSION['admin'])) {
            echo "<li><a href='' style='pointer-events:none;'> Hi, " . $_SESSION['name'] . " Have a nice day!</a></li>";
          }
          ?>
        </ul>

        <ul class="nav navbar-nav navbar-right" style="<?php if (!isset($_SESSION['admin'])) echo '' ?>">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="post.php">Post</a></li>
              <li><a href="registeredevent.php" style="<?php if (isset($_SESSION['admin']) && ($_SESSION['admin'] == true)) echo 'display: none;' ?>">Registered Event</a></li>
              <li><a href="volunteers.php" style="<?php if (isset($_SESSION['admin'])) if (!$_SESSION['admin'] == true) echo 'display: none;' ?>">Volunteer</a></li>
              <li><a href="admins.php" style="<?php if (isset($_SESSION['admin'])) if (!$_SESSION['admin'] == true) echo 'display: none;' ?>">Admin</a></li>
              <li><a href="archivedevent.php" style="<?php if (isset($_SESSION['admin'])) if (!$_SESSION['admin'] == true) echo 'display: none;' ?>">Archived Event</a></li>
              <li><a href="profile.php" style="<?php if (isset($_SESSION['admin'])) if ($_SESSION['admin'] == true) echo 'display: none;' ?>">Profile</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="logout.php">Logout</a></li>
              <!--  <li><?php echo $_SESSION['name'] . " " . $_SESSION['id'] ?></li> -->
            </ul>
          </li>
        </ul>

      </div> <!-- / .navbar-collapse-->
    <?php } ?>
  </div><!-- /.container-fluid -->
</nav>
