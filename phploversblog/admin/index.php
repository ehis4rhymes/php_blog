<?php include 'includes/header.php'; ?>
<?php
//Create DB Object
  $db = new Database;

//Create Query for Posts
  $query = "SELECT posts.* , categories.name FROM posts
            INNER JOIN categories
            ON posts.category = categories.id
            ORDER BY posts.id DESC";
//Run Query for Posts
  $posts = $db->select($query);

//Create Query for Cateegory
  $query = "SELECT * FROM categories 
             ORDER BY categories.id DESC";
//Run Query for categories
  $categories = $db->select($query);

?>

<table class="table table-striped">
   <tr>
     <th>Post ID#</th>
     <th>Title</th>
     <th>Category</th>
     <th>Author</th>
     <th>Date</th>
   </tr>
   <?php while($row = $posts->fetch_assoc()) : ?>
   <tr>
     <td><?php echo $row['id']; ?></td>
     <td><a href="edit_post.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></td>
     <td><?php echo $row['name']; ?></td>
     <td><?php echo $row['author']; ?></td>
     <td><?php echo $row['date']; ?></td>
   </tr>
   <?php endwhile; ?>
</table>

<br />
<br />

<table class="table table-striped">
   <tr>
     <th>Category ID#</th>
     <th>Name</th>
   </tr>
   <?php while($row = $categories->fetch_assoc()) : ?>
   <tr>
     <td><?php echo $row['id']; ?></td>
     <td><a href="edit_category.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></td>
     <td></td>
   </tr>
 <?php endwhile; ?>
</table>


<?php include 'includes/footer.php'; ?>
