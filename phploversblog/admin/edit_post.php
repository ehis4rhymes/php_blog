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

<?php

  if(isset($_POST['submit'])){
    //Assign Variables
    $title = mysqli_real_escape_string($db->link, $_POST['title']);
    $body = mysqli_real_escape_string($db->link, $_POST['body']);
    $category = mysqli_real_escape_string($db->link, $_POST['category']);
    $author = mysqli_real_escape_string($db->link, $_POST['author']);
    $tags = mysqli_real_escape_string($db->link, $_POST['tags']);

    //Simple Validation

    if($title == '' || $body == '' || $category == '' || $author == ''){
      //Set Error
      $error = 'Please fill in the empty fields';
      //echo $error;
    }else{

      $query = "UPDATE posts
                SET 
                title = '$title',
                body = '$body',
                author ='$author',
                tags = '$tags'
                WHERE id =".$id;

      //Run Query
      $update_row = $db->update($query);
    }
  }
?>

<?php
   
   if(isset($_POST['delete'])){

    //Set Query
      $query = "DELETE FROM posts
                WHERE id=".$id;

    //Run Query
      $delete_row = $db->delete($query);

   }

?>

<form method="post" action="edit_post.php?id=<?php echo $id; ?>">
   
   <?php if(isset($error)) : ?>
     <div class="alert alert-danger"><?php echo $error; ?></div>
  <?php endif; ?>

  <div class="form-group">
    <label>Post Title</label>
    <input type="text" name="title" class="form-control" placeholder="Enter Title" value="<?php echo $post['title']; ?>">
  </div>
   <div class="form-group">
    <label>Post Body</label>
    <textarea type="text" name="body" class="form-control"  placeholder="Enter Post Body"><?php echo $post['body']; ?></textarea>
  </div>
   <div class="form-group">
    <label>Category</label>
    <select class="form-control" name="category">
      <?php while($row = $categories->fetch_assoc()) : ?>
        <?php if($row['id'] == $post['category']){
          $selected = 'selected';
        } else{
          $selected = '';
        }
        ?>
       <option <?php echo $selected; ?> value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
      <?php endwhile; ?>
    </select>
  </div>
   <div class="form-group">
    <label>Author</label>
    <input type="text" name="author" class="form-control" placeholder="Enter Author Name" value="<?php echo $post['author']; ?>">
  </div>
   <div class="form-group">
    <label>Tags</label>
    <input type="text" name="tags" class="form-control" placeholder="Enter Tags" value="<?php echo $post['tags']; ?>">
  </div>
  
  <div>
   <input name="submit" type="submit" class="btn btn-default" value="Submit">
   <a href="index.php" class="btn btn-default">Cancel</a>
   <input name="delete" type="submit" class="btn btn-danger" value="Delete">
  </div>
  <br />
</form>

<?php include 'includes/footer.php'; ?>