<?php include 'includes/header.php'; ?>

<?php
  //Create DB Object
  $db = new Database();
   
  //
  //Create Query for Post
  //
  $query = "SELECT * FROM posts ORDER by id DESC";

  //Run Query
  $posts = $db->select($query);

  //
  //Create Query for Categories
  //
  $query = "SELECT * FROM categories";

  //Run Query
  $categories = $db->select($query);

?>


<?php if($posts) : ?>

  <?php while($row = $posts->fetch_assoc()) : ?>
          <div class="blog-post">
            <h2 class="blog-post-title"><?php echo $row['title']; ?></h2>
            <p class="blog-post-meta"><?php echo formatDate($row['date']); ?>  by <a href="#"><?php echo $row['author']; ?></a></p>
            <?php echo shortenText($row['body']); ?>
            <a href="post.php?id=<?php echo urlencode($row['id']); ?>" class="readmore">Read More</a>
          </div><!-- /.blog-post -->
  <?php endwhile; ?>
          
<?php else : ?>
  <p>There are no posts yet</p>
<?php endif; ?>


<?php include 'includes/footer.php'; ?>
