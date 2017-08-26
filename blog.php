<?php 

require_once 'app/helpers.php';
session_start();

if( ! verify_user() ){
  header('location: signin.php');
  exit;
}

if(isset($_REQUEST['like'])) {
  $isLike = $_REQUEST['like'] || NULL;
  $isUnLike = $_REQUEST['unlike'] || NULL;
}


if (isset($_REQUEST['like'])) {
  $postId = intval($_REQUEST['postid']);
  $sql = "UPDATE posts SET likes = likes + 1 WHERE posts.id=$postId";
  $link = mysqli_connect('localhost', 'root', '', 'fakebook');
  $result = mysqli_query($link, $sql);
}

// if (isset($isUnLike)) until when?!!!! {

// }

$likeNoneOrBlock = 'block';
$unlikeNoneOrBlock = 'none';

function showUnlike(){
  $likeNoneOrBlock = 'none';
  $unlikeNoneOrBlock = 'block';
}
function showLike(){
  $likeNoneOrBlock = 'block';
  $unlikeNoneOrBlock = 'none';
}
$title = 'StyleBook blog page';
$uid = $_SESSION['user_id'];
$posts = [];
$link = mysqli_connect('localhost', 'root', '', 'fakebook');
mysqli_query($link, "SET NAMES utf8");

$sql = "SELECT u.name,u.avatar, p.likes, p.id,p.user_id,p.title,p.article,DATE_FORMAT(p.date,'%d/%m/%Y') date FROM posts p "
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
         
         
         <?php
         #what the fuck php why u dont bring the avatar pic?!!!
          #  $id = $post['user_id'];
           # $mysql = "SELECT avatar FROM `users` WHERE id=$id";
           # $link = mysqli_connect('localhost', 'root', '', 'fakebook');
           # global $imgRes ;
           # $imgRes = mysqli_query($link, $mysql);
         ?>

          <div class="media">
            <div class="media-left">
              <a href="#">
                <img class="media-object" src="./images/<?= $post['avatar'] ?>" alt="..."> 
              </a>
            </div>
            <div class="media-body">
              <h4 class="media-heading"><?= htmlentities($post['title']);?></h4>
              <?= htmlentities($post['article']); ?>
              <p>
              <div class="row">
              <span> 
                  <b>Written by:</b>  <i><?= htmlentities($post['name']); ?></i> &nbsp  <b>On date: </b> <?= $post['date']; ?>

                  <a href="blog.php?like=true?unlike=false?postid=<?= $post['id']?>" style="display:<?= $likeNoneOrBlock ?>"> <button type="button" id="like"  class="btn btn-info">LIKE</button></a>
                   <a href="blog.php?like=false?unlike=true" style="display:<?= $unlikeNoneOrBlock  ?>"><button type="button" id="unlike"   class="btn btn-info">UNLIKE</button> </a>
                   <p> likes <?=$post['likes']; ?></p>
              </span>
                <?php if( $uid == $post['user_id'] ): ?> 
                <span class="right">
                  <a href="update_post.php?pid=<?= $post['id']; ?>"><button type="button" class="btn btn-warning">EDIT</button></a> | 
                  <a href="delete_post.php?pid=<?= $post['id']; ?>"><button type="button" class="btn btn-danger">DELETE</button></a>
                </span>
                <?php endif; ?>
              
              </div>
              </p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
 


<script>

// $(document).ready(function(){
//   $('#like').show();
//   $('#unlike').hide();
// });

  $('#like').click(function(e) {
     $('#like').hide();
     $('#unlike').show();
      console.log(e);
  });
  $('#unlike').click(function(e) {
    console.log('unlike')
    $('#like').show();
    $('#unlike').hide();
  });
</script>

<?php include 'tpl/footer.php'; ?>