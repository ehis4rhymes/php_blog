<?php include 'includes/header.php'; ?>

<?php
   //Get id
   $id = $_GET['id'];

  //Create DB Object
  $db = new Database();
   
  //
  //Create Query for Post
  //
  $query = "SELECT * FROM posts WHERE id = ".$id;

  //Run Query
  $post = $db->select($query)->fetch_assoc();

  //
  //Create Query for Categories
  //
  $query = "SELECT * FROM categories";

  //Run Query
  $categories = $db->select($query);

?>


           <div class="blog-post">
            <h2 class="blog-post-title"><?php echo $post['title']; ?></h2>
            <p class="blog-post-meta"><?php echo formatDate($post['date']); ?> by <a href="#"><?php echo $post['author']; ?></a></p>
            <?php echo $post['body']; ?>
          </div><!-- /.blog-post -->

<?php include 'includes/footer.php'; ?>
