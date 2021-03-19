<?php include 'includes/header.php'; ?>

<?php
    //Create DB Object
  $db = new Database();


  if(isset($_POST['submit'])){
    //Assign Variables
    $name = mysqli_real_escape_string($db->link, $_POST['name']);

    //Simple Validation

    if($name == ''){
      //Set Error
      $error = 'Please fill in the empty field';
      //echo $error;
    }else{

      $query = "INSERT INTO categories 
                 (name)
               VALUES('$name')";

      //Run Query
      $update_row = $db->update($query);
    }
  }
?>

<form method="post" action="add_category.php">

  <?php if(isset($error)) : ?>
     <div class="alert alert-danger"><?php echo $error; ?></div>
  <?php endif; ?>

  <div class="form-group">
    <label>Category Name</label>
    <input type="text" name="name" class="form-control" placeholder="Enter Category">
  </div>
  
   <div>
   <input name="submit" type="submit" class="btn btn-default" value="Submit">
   <a href="index.php" class="btn btn-default">Cancel</a>
  </div>
  <br />
</form>

<?php include 'includes/footer.php'; ?>