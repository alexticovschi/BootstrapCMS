<?php 

// if the edit link is accessed, get the value of edit key(the id)
// query the database and and select the category that has the specified id
// then get the title of the category
if(isset($_GET['edit'])) {
    $cat_id = $_GET['edit'];
    $query = "SELECT * FROM categories WHERE cat_id='{$cat_id}' ";
    $edit_categories = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($edit_categories);
    $cat_title = $row['cat_title'];                       
}


?>

<form action="" method="post">
    <div class="form-group">                                            
        <label for="cat-title">Edit Category</label>
        <input value="<?php if(isset($cat_title))  { echo $cat_title; } ?>" type="text" class="form-control" name="cat_title"> 
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_category" value="Update Category"> 
    </div>                              
</form>    