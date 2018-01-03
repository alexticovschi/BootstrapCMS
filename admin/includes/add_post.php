<?php create_post();  ?>

<?php 

if(isset($_POST['create_post'])) {
    echo "<h4 style='padding: 8px; border-radius: 2px' class='bg-success'>Post Added. <a href='posts.php'>View Posts</a></h4>";
}

?>


<form action="" method="post" enctype="multipart/form-data">

    <div class ="form-group">
        <label for ="title">Post Title</label>
        <input type="text" class="form-control" name="post_title">
    </div>


    <div class ="form-group">
        <label for ="post_category">Post Category</label>
        <br>
        <select name="post_category" id="">
            
            <?php

            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection, $query);
                
            confirm_query($select_categories);

            while($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row['cat_id']; 
                $cat_title = $row['cat_title']; 

                echo "<option value='$cat_id'>{$cat_title}</option>";
            }

            ?>

        </select>
    </div>


    <div class ="form-group">
        <label for ="title">Post Author</label>
        <input type="text" class="form-control" name="post_author">
    </div>

    <div class ="form-group">
        <!-- <label for ="post_status">Post Status</label> -->
        <br>
        <select name="post_status" id="">
            <option value="draft">Post Status</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
        </select>
    </div>

    <div class ="form-group">
        <label for ="post_image">Post Image</label>
        <input type="file" name="image">
    </div>

    <div class ="form-group">
        <label for ="post_tages">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class ="form-group">
        <label for ="post_content">Post Content</label>
        <textarea type="text" class="form-control" name="post_content" id="" cols="30" rows="10"></textarea>    
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Add Post">
    </div>

</form>