<?php 

require_once 'app/helpers.php';
session_start();

if( ! verify_user() ){
  header('location: signin.php');
  exit;
}

$title = 'Edit your avatar';
$error = '';
define('MAX_IMAGE_SIZE', 1024 * 1024 * 5);
$userId = $_SESSION['user_id'];

if( isset($_POST['submit']) ) {
  if ($userId){
$link = mysql_connect('localhost', 'root', '' , 'fakebook');
$res =  mysql_query($link, "SET NAMES utf8");
if ($res && mysql_num_rows($res)>0){

  $avatar = mysql_fetch_assoc($res);
} else {
  header('location: blog.php');
  exit;
}


} else {
  header('location: blog.php');
  exit;


  $ex = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];
  
  if( !empty($_FILES['image']['name']) ){
    
    if(is_uploaded_file($_FILES['image']['tmp_name']) ){
      
      if( $_FILES['image']['error'] == 0 && $_FILES['image']['size'] <= MAX_IMAGE_SIZE ){
        
        $fileinfo = pathinfo($_FILES['image']['name']);
        
        if(in_array( strtolower($fileinfo['extension']), $ex) ){
          $file_name = date('Y.m.d.H.i.s') . '-' . $_FILES['image']['name'];
          $_SESSION['user_avatar'] = $file_name;

          move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $file_name);
          $link = mysqli_connect('localhost', 'root', '', 'fakebook');
          $uid = $_SESSION['user_id'];
          $sql = "UPDATE users SET avatar = '$file_name' WHERE id = $uid";
          $result = mysqli_query($link, $sql);
          
          if( $result && mysqli_affected_rows($link) == 1 ){
            if ($avatar['avatar'] && $avatar['avatar'] != 'man.png' || $avatar['avatar'] && $avatar['avatar'] != 'girl.png')
              unlink('images/' . $avatar['avatar']);
              header('location: blog.php?sm=Your profile image updated');
            exit;
          }
        }
        
      }
      
    }
    
  }
  
}

?>

<?php include 'tpl/header.php'; ?>
  <div class="content">
    <h1>Edit your profile avatar - </h1>
    <form method="post" action="" enctype="multipart/form-data">
      <label for="image">Image profile:</label><br>
      <input type="file" name="image" id="image"><br><br>
      <input type="submit" name="submit" value="Upload image">
      <input type="button" value="Cancel" onclick="window.location='blog.php';">
      <span class="error"><?= $error; ?></span>
    </form>
  </div>
<?php include 'tpl/footer.php'; ?>