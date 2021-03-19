<?php include 'includes/header.php'; ?>

<?php
   //Get id
   $id = $_GET['id'];

  //Create DB Object
  $db = new Database();
   
  //
  //Create Query for Post
  //
  $query = "SELECT * FROM categories WHERE id = ".$id;

  //Run Query
  $category = $db->select($query)->fetch_assoc();

?>

<?php

  if(isset($_POST['submit'])){
    //Assign Variables
    $name = mysqli_real_escape_string($db->link, $_POST['name']);

    //Simple Validation

    if($name == ''){
      //Set Error
      $error = 'Please fill in the empty field';
      //echo $error;
    }else{

      $query = "UPDATE categories 
                SET
                name = '$name'
                WHERE id=".$id;

      //Run Query
      $update_row = $db->update($query);
    }
  }
?>

<?php
   
   if(isset($_POST['delete'])){

    //Set Query
      $query = "DELETE FROM categories
                WHERE id=".$id;

    //Run Query
      $delete_row = $db->delete($query);

   }

?>

<form method="post" action="edit_category.php?id=<?php echo $category['id']; ?>">
   
  <?php if(isset($error)) : ?>
     <div class="alert alert-danger"><?php echo $error; ?></div>
  <?php endif; ?>

  <div class="form-group">
    <label>Category Name</label>
    <input type="text" name="name" class="form-control" placeholder="Enter Category" value="<?php echo $category['name']; ?>">
  </div>
  
   <div>
   <input name="submit" type="submit" class="btn btn-default" value="Submit">
   <a href="index.php" class="btn btn-default">Cancel</a>
   <input name="delete" type="submit" class="btn btn-danger" value="Delete">
  </div>
  <br />
</form>

<?php include 'includes/footer.php'; ?>