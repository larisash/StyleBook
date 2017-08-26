<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    
    <link href="css/header.css" rel="stylesheet" type="text/css"/>
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
  </head>
  <body>
     <div class="page-wrapper">
       <!-- <div class="header">
        <ul>
          <li><a href="./">StyleBook</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="blog.php">Blog</a></li>
          <?php if( ! isset($_SESSION['user_id']) ): ?>
            <li><a href="signin.php">Signin</a></li>
            <li><a href="signup.php">Signup</a></li>
          <?php else: ?>
            <li><?= $_SESSION['user_name'] ?></li>
            <li>
              <a href="edit_avatar.php"><img border="0" width="30" src="images/<?= $_SESSION['user_avatar']; ?>"></a>
            </li>
            <li><a href="logout.php">Logout</a></li>
          <?php endif; ?>
        </ul>
      </div>   -->

       <div>
        <nav class="navbar navbar-default navigation-clean-button">
            <div class="container" style="width: auto; padding-right: 0; padding-left: 0;"> 
                <div class="navbar-header"><a class="navbar-brand" href="./">StyleBook</a>
                    <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                </div>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav">
                        <li  role="presentation"><a href="about.php">About</a></li>
                        <li role="presentation"><a href="blog.php">Blog</a></li>
                    </ul>
                    <p class="navbar-text navbar-right actions">
                      <?php if( ! isset($_SESSION['user_id']) ): ?>
                      <a class="navbar-link login" href="signin.php">Log In</a> 
                      <a class="btn btn-default action-button" role="button" href="signup.php">Sign Up</a>
                      <?php else: ?>
                      <a class="btn btn-default action-button" role="button" href="logout.php">Logout</a>
                      <?php endif; ?>
                    </p>
                </div>
            </div>
        </nav>
    </div> 


      <?php if( isset($_GET['sm']) ): ?>
        <div id="sm-box">
          <p><?= $_GET['sm']; ?></p>
        </div>
      <?php endif; ?>
