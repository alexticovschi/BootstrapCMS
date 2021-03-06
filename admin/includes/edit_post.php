<?php 

if(isset($_GET['p_id'])) {
    $post_id = escape($_GET['p_id']);

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


    if(isset($_POST['update_post'])) {
        $post_author = escape($_POST['post_author']); 
        $post_title = escape($_POST['post_title']); 
        $post_title = escape($post_title);
        $post_category_id = escape($_POST['post_category']);  
        $post_status = escape($_POST['post_status']);  
        $post_image = escape($_FILES['image']['name']);  
        $post_image_temp = escape($_FILES['image']['tmp_name']);  
        $post_content = escape($_POST['post_content']);        
        $post_tags = escape($_POST['post_tags']);  

        move_uploaded_file($post_image_temp, "../images/$post_image");

        if(empty($post_image)) {
            $query = "SELECT * FROM posts WHERE post_id = $post_id";
            $select_image = mysqli_query($connection, $query);

            $row = mysqli_fetch_assoc($select_image);
            $post_image = $row['post_image'];
        } 

        $query  = "UPDATE posts SET ";
        $query .= "post_author = '$post_author', ";
        $query .= "post_title = '$post_title', ";
        $query .= "post_category_id = '$post_category_id', ";
        $query .= "post_date = now(), ";
        $query .= "post_status = '$post_status', ";
        $query .= "post_tags = '$post_tags', ";
        $query .= "post_content = '$post_content', ";
        $query .= "post_image = '$post_image' ";
        $query .= "WHERE post_id = $post_id ";

        $update_post = mysqli_query($connection, $query);

        confirm_query($update_post);

        echo "<h4 style='padding: 8px; border-radius: 2px' class='bg-success'>Post Updated. <a href='../post.php?p_id={$post_id}'>View Post</a> or <a href='posts.php'>Edit More Posts</a></h4>";

        //header("Location: posts.php");

    }

}



?>


<form action="" method="post" enctype="multipart/form-data">

    <div class ="form-group">
        <label for ="title">Post Title</label>
        <input value="<?php echo stripslashes($post_title); ?>" type="text" class="form-control" name="post_title">
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

                    if($cat_id == $post_category_id) {
                        echo "<option selected value='$cat_id'>{$cat_title}</option>";
                    } else {
                        echo "<option value='$cat_id'>{$cat_title}</option>";
                    }

                }
                


            ?>

        </select>
    </div>

    <div class ="form-group">
        <label for ="title">Post Author</label>
        <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="post_author">
    </div>

    <div class ="form-group">
        <label for ="post_status">Post Status</label>
        <br>
        <select name="post_status" id="">
            
            <option value="<?php echo $post_status; ?>"><?php echo ucwords($post_status); ?></option>
            <?php 

            if($post_status == 'published') {
                echo "<option value='draft'>Draft</option>";
            } else {
                echo "<option value='published'>Publish</option>";
            }

            ?>

        </select>
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
        <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
    </div>

</form>






