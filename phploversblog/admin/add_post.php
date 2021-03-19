<?php include 'includes/header.php'; ?>

<?php
    //Create DB Object
  $db = new Database();


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

  		$query = "INSERT INTO posts 
  		           (title, body, category, author, tags)
  		         VALUES('$title', '$body', $category, '$author', '$tags')";

  		//Run Query
  		$insert_row = $db->insert($query);
  	}
  }
?>
<?php
  //
  //Create Query for Categories
  //
  $query = "SELECT * FROM categories";

  //Run Query
  $categories = $db->select($query);

?>

<form method="post" action="add_post.php ">

  <?php if(isset($error)) : ?>
     <div class="alert alert-danger"><?php echo $error; ?></div>
  <?php endif; ?>

  <div class="form-group">
    <label>Post Title</label>
    <input type="text" name="title" class="form-control" placeholder="Enter Title">
  </div>
   <div class="form-group">
    <label>Post Body</label>
    <textarea type="text" name="body" class="form-control" placeholder="Enter Post Body"></textarea>
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
    <input type="text" name="author" class="form-control" placeholder="Enter Author Name">
  </div>
   <div class="form-group">
    <label>Tags</label>
    <input type="text" name="tags" class="form-control" placeholder="Enter Tags">
  </div>
  
  <div>
  <input name="submit" type="submit" class="btn btn-default" value="Submit">
   <a href="index.php" class="btn btn-default">Cancel</a>
  </div>
  <br />
</form>

<?php include 'includes/footer.php'; ?>