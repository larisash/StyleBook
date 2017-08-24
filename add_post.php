<?php 

require_once 'app/helpers.php';
session_start();

if( ! verify_user() ){
  header('location: signin.php');
  exit;
}

$title = 'Add post page';
$error = '';

if( isset($_POST['submit']) ){
  
  $ptitle = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
  $ptitle = trim($ptitle);
  
  $article = filter_input(INPUT_POST, 'article', FILTER_SANITIZE_STRING);
  $article = trim($article);
  
  if( ! $ptitle ){
    $error = ' * Title field is required';
  } elseif( ! $article ){
    $error = ' * Article field is required';
  } else {
    $link = mysqli_connect('localhost', 'root', '', 'fakebook');
    $ptitle = mysqli_real_escape_string($link, $ptitle);
    $article = mysqli_real_escape_string($link, $article);
    mysqli_query($link, "SET NAMES utf8");
    $uid = $_SESSION['user_id'];
    $sql = "INSERT INTO posts VALUES('',$uid,'$ptitle','$article',NOW())";
    $result = mysqli_query($link, $sql);
    if( $result && mysqli_affected_rows($link) > 0 ){
      header('location: blog.php?sm=Your post is saved');
      exit;
    }
  }
  
}

?>

<?php include 'tpl/header.php'; ?>
  <div class="content">
    <h1>Add your new post here - </h1>
    <form method="post" action="">
      <label for="title">Title:</label><br>
      <input type="text" name="title" value="<?= old('title'); ?>"><br><br>
      <label for="article">Article:</label><br>
      <textarea cols="50" rows="10" name="article"><?= old('article'); ?></textarea><br><br>
      <input type="submit" name="submit" value="Save post">
      <input type="button" value="Cancel" onclick="window.location='blog.php';">
      <span class="error"><?= $error; ?></span>
    </form>
  </div>
<?php include 'tpl/footer.php'; ?>