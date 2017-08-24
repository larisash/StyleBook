<?php 

require_once 'app/helpers.php';
session_start();
$title = 'About us';

?>

<?php include 'tpl/header.php'; ?>
  <div class="content">
    <h1>About our blog</h1>
    <p>FakeBook is the blog of the blogs.</p>
  </div>
<?php include 'tpl/footer.php'; ?>