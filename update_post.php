<?php 

require_once 'app/helpers.php';
session_start();

if( ! verify_user() ){
  header('location: signin.php');
  exit;
}

$title = 'Update post';
$error = '';

$pid = filter_input(INPUT_GET, 'pid', FILTER_SANITIZE_STRING);
$uid = $_SESSION['user_id'];

 if( $pid && is_numeric($pid) ){
   
$link = mysqli_connect('localhost', 'root', '', 'fakebook');
mysqli_query($link, "SET NAMES utf8");

$sql = "SELECT * FROM posts WHERE id = $pid AND user_id = $uid";
$result = mysqli_query($link, $sql);

if( $result && mysqli_num_rows($result) == 1 ){
  
  $post = mysqli_fetch_assoc($result);
  
} else {
  header('location: blog.php');
  exit;
}
   
} else {
  header('location: blog.php');
  exit;
}

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

    $ptitle = mysqli_real_escape_string($link, $ptitle);
    $article = mysqli_real_escape_string($link, $article);
    $sql = "UPDATE posts SET title = '$ptitle',article = '$article' WHERE id = $pid";
    $result = mysqli_query($link, $sql);
    if( $result ){
      header('location: blog.php?sm=Your post updated');
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
      <input type="text" name="title" value="<?= $post['title']; ?>"><br><br>
      <label for="article">Article:</label><br>
      <textarea cols="50" rows="10" name="article"><?= $post['article']; ?></textarea><br><br>
      <input type="submit" name="submit" value="Update post">
      <input type="button" value="Cancel" onclick="window.location='blog.php';">
      <span class="error"><?= $error; ?></span>
    </form>
  </div>
<?php include 'tpl/footer.php'; ?>