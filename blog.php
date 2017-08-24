<?php 

require_once 'app/helpers.php';
session_start();

if( ! verify_user() ){
  header('location: signin.php');
  exit;
}

$title = 'StyleBook blog page';
$uid = $_SESSION['user_id'];
$posts = [];
$link = mysqli_connect('localhost', 'root', '', 'fakebook');
mysqli_query($link, "SET NAMES utf8");

$sql = "SELECT u.name,p.id,p.user_id,p.title,p.article,DATE_FORMAT(p.date,'%d/%m/%Y') date FROM posts p "
        . " JOIN users u ON u.id = p.user_id "
        . " ORDER BY p.date DESC";

$result = mysqli_query($link, $sql);

if( $result && mysqli_num_rows($result) > 0 ){
  
  $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
  
}

?>

<?php include 'tpl/header.php'; ?>
   <div class="content">
    <h1>StyleBook users posts</h1>
    <p><input type="button" value="+ add your post" onclick="window.location='add_post.php';"></p>
    <?php if( $posts ): ?>
      <?php foreach($posts as $post): ?>
        <div class="post-box">
         
         
         <?
            $id = $post['user_id'];
            $mysql = "SELECT avatar FROM `users` WHERE id=$id";
            $link = mysqli_connect('localhost', 'root', '', 'fakebook')
            $imgRes = mysqli_query($link, $mysql);
         ?>

          <h3><?= htmlentities($post['title']);?></h3>
          <img class="media-object" src="/images/<?php echo $imgRes ?>" />
          <p><?= htmlentities($post['article']); ?></p>
          <hr>
          <p>
            Written by: <i><?= htmlentities($post['name']); ?></i> , On date: <?= $post['date']; ?>
            <?php if( $uid == $post['user_id'] ): ?> 
            <span class="right">
              <a href="update_post.php?pid=<?= $post['id']; ?>">Edit</a> | 
              <a href="delete_post.php?pid=<?= $post['id']; ?>">Delete</a>
            </span>
            <?php endif; ?>
          </p>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div> 
<div class="media">
  <div class="media-left">
    <a href="#">
      <!-- <img class="media-object" src="./images/<? $img ?>" alt="..."> -->
    </a>
  </div>
  <div class="media-body">
    <h4 class="media-heading">Media heading</h4>
    ...
  </div>
</div>


  
<?php include 'tpl/footer.php'; ?>