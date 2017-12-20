<?php 

if(isset($_GET['p_id'])) {
    $post_id = $_GET['p_id'];

    $query = "SELECT * FROM posts WHERE post_id=$post_id";
    $select_post = mysqli_query($connection, $query);

    confirm_query($select_post);

    while($row = mysqli_fetch_assoc($select_post)) {
        $post_author = $row['post_author']; 
        $post_title = $row['post_title'];                                   
        $post_category_id = $row['post_category_id'];  
        $post_status = $row['post_status'];  
        $post_image = $row['post_image'];  
        $post_tags = $row['post_tags'];  
        $post_comment_count = $row['post_comment_count']; 
        $post_date = $row['post_date'];
        $post_content = $row['post_content'];
    }

}


?>


<form action="" method="post" enctype="multipart/form-data">

    <div class ="form-group">
        <label for ="title">Post Title</label>
        <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="post_title">
    </div>

    <div class ="form-group">
        <label for ="post_category">Post Category</label>
        <br>
        <select name="" id="">

        </select>
    </div>

    <div class ="form-group">
        <label for ="title">Post Author</label>
        <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="post_author">
    </div>

    <div class ="form-group">
        <label for ="post_status">Post Status</label>
        <input value="<?php echo $post_status; ?>" type="text" class="form-control" name="post_status">
    </div>

    <div class ="form-group">
        <label for ="post_image">Post Image: </label><br>
        <img src="../images/<?php echo $post_image; ?>" alt="" width="100">
        <input type="file" name="image">
    </div>

    <div class ="form-group">
        <label for ="post_tages">Post Tags</label>
        <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
    </div>

    <div class ="form-group">
        <label for ="post_content">Post Content</label>
        <textarea type="text" class="form-control" name="post_content" id="" cols="30" rows="10">
            <?php echo $post_content; ?>
        </textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Update Post">
    </div>

</form>






