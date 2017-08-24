<?php 

require_once 'app/helpers.php';
session_start();

if( isset($_SESSION['user_id']) ){
  header('location: blog.php');
  exit;
}

$title = 'Sign up page';
$error = ['name' => '', 'email' => '', 'password' => ''];

if( isset($_POST['submit']) ){
  
  if( isset($_POST['token']) && isset($_SESSION['token']) && $_POST['token'] == $_SESSION['token'] ){
    
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $name = trim($name);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $email = trim($email);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $password = trim($password);
    $cpassword = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_STRING);
    $cpassword = trim($cpassword);
    $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);
    $gender = $_POST['gender'];
      if ($gender == "woman") {
          $avatar = 'girl.png';
      } elseif ($gender == "man") {
          $avatar = 'man.png';
      }
    $link = mysqli_connect('localhost', 'root', '', 'fakebook');
    mysqli_query($link, "SET NAMES utf8");
    $email = mysqli_real_escape_string($link, $email);

    $valid = true;
    
    if( ! $name || strlen($name) < 2 || strlen($name) > 70 ){
      $valid = false;
      $error['name'] = ' * Name field is required and must be 2 to 70 characters';
    }
    

    function hasNumber($text){
      return preg_match("/\d/",$text) > 0;
    }    
    if (hasNumber($name)) {
      $valid = false;
      $error['name'] = ' * Name must contain letters only';
    }

    if( ! $email ){
      
      $valid = false;
      $error['email'] = ' * A valid email is required';
      
    } elseif( email_exist($link, $email) ){
      $valid = false;
      $error['email'] = ' * The email is taken';
    }
    
    if( ! $password || strlen($password) < 6 || strlen($password) > 10 ){
      $valid = false;
      $error['password'] = ' * Password field is required and must be 6 to 10 characters';
    } elseif( $password != $cpassword ){
      $valid = false;
      $error['password'] = ' * Password mis match';
    }
    
    if( $valid ){
      
      $name = mysqli_real_escape_string($link, $name);
      $password = mysqli_real_escape_string($link, $password);
      $password = password_hash($password, PASSWORD_BCRYPT);
      $sql = "INSERT INTO users VALUES('','$name','$email','$password','$avatar',NOW())";
      $result = mysqli_query($link, $sql);
      
      if( $result && mysqli_affected_rows($link) == 1 ){
        
        $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
        $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
        $_SESSION['user_id'] = mysqli_insert_id($link);
        $_SESSION['user_name'] = $name;
        $_SESSION['user_avatar'] = $avatar ;
        header('location: blog.php?sm=Your account created, you are now loged in!');
        exit;
        
      }
      
    }
    
  }
  
  $token = csrf_token();
  
} else {
  
  $token = csrf_token();
  
}

?>

<?php include 'tpl/header.php'; ?>
  <div class="content">
    <h1>Here you can sign up for new account</h1>
    <form method="post" action="">
      <input type="hidden" name="token" value="<?= $token; ?>">
      <label for="name">Name:</label><br>
      <input type="text" name="name" id="name" value="<?= old('name'); ?>"><br>
      <span class="error"><?= $error['name']; ?></span>
      <br><br>
      <label for="email">Email:</label><br>
      <input type="text" name="email" id="email" value="<?= old('email'); ?>"><br>
      <span class="error"><?= $error['email']; ?></span>
      <br><br>
      <label for="password">Password:</label><br>
      <input type="password" name="password" id="password"><br>
      <span class="error"><?= $error['password']; ?></span>
      <br><br>
      <label for="confirm-password">Confirm password:</label><br>
      <input type="password" name="confirm_password" id="confirm-password"><br><br>
      <br><br>
       <label for="gender">gender:</label><br>
      <input type="text" name="gender" id="gender"><br> 

      <!--submit!  -->
      <input type="submit" name="submit" value="Signup">
    </form> 
  </div>
<?php include 'tpl/footer.php'; ?>