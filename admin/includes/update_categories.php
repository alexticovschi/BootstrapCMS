<form action="" method="post">
    <div class="form-group">                                            
        <label for="cat-title">Edit Category</label>
        <input value="<?php if(isset($cat_title))  { echo $cat_title; } ?>" type="text" class="form-control" name="cat_title"> 
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_category" value="Update Category"> 
    </div>                              
</form>    