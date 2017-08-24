<?php 

require_once 'app/helpers.php';
session_start();

if( isset($_SESSION['user_id']) ){
  header('location: blog.php');
  exit;
}

$title = 'Sign in page';
$error = '';

if( isset($_POST['submit']) ){
  
  if( isset($_POST['token']) && isset($_SESSION['token']) && $_POST['token'] == $_SESSION['token'] ){
    
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $email = trim($email);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $password = trim($password);

    if( ! $email ){
      $error = ' * A valid email is required';
    } elseif( ! $password || strlen($password) < 6 || strlen($password) > 10){
      $error = ' * Password field is required';
    } else{

      $link = mysqli_connect('localhost', 'root', '', 'fakebook');
      $email = mysqli_real_escape_string($link, $email);
      $password = mysqli_real_escape_string($link, $password);
      $sql = "SELECT * FROM users WHERE email = '$email'";
      $result = mysqli_query($link, $sql);

      if( $result && mysqli_num_rows($result) > 0 ){

        $user = mysqli_fetch_assoc($result);
        
        if( password_verify($password, $user['password']) ){
          $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
          $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
          $_SESSION['user_id'] = $user['id'];
          $_SESSION['user_name'] = $user['name'];
          $_SESSION['user_avatar'] = $user['avatar'];
          header('location: blog.php?sm=' . $user['name'] . ' welcome back!');
          exit;
          
        } else {
          
          $error = ' * Wrong email/password combination';
          
        }
        


      } else {

        $error = ' * Wrong email/password combination';

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
    <h1>Here you can sign in with your account</h1>
    <form method="post" action="">
      <input type="hidden" name="token" value="<?= $token; ?>">
      <label for="email">Email:</label><br>
      <input type="text" name="email" id="email" value="<?= old('email'); ?>"><br><br>
      <label for="password">Password:</label><br>
      <input type="password" name="password" id="password"><br><br>
      <input type="submit" name="submit" value="Signin">
      <span class="error"><?= $error; ?></span>
    </form> 
  </div>
<?php include 'tpl/footer.php'; ?>