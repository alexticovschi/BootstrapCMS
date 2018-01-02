<?php 

if(isset($_POST['checkBoxArray'])) {
    $checkBoxArray = $_POST['checkBoxArray'];
    //print_r($checkBoxArray);

    foreach($checkBoxArray as $post_id) {
        $bulk_options = $_POST['bulk_options'];
        
        switch ($bulk_options) {
            case 'published':
                
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = $post_id";
                $update_to_published = mysqli_query($connection, $query);

                confirm_query($update_to_published);
                break;

            case 'draft':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = $post_id";
                $update_to_draft = mysqli_query($connection, $query);

                confirm_query($update_to_draft);
                break;

            case 'delete':
                $query = "DELETE FROM posts WHERE post_id = $post_id";
                $delete_post = mysqli_query($connection, $query);

                confirm_query($delete_post);
                break;
            
            default:
                # code...
                break;
        }
    }
}


?>


<form action="" method="post">
    <table class="table table-hover table-bordered">

        <div id="bulkOptionContainer" class="col-xs-4">
            
            <select class="form-control" name="bulk_options" id="">
                <option value="">Select Options</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
            </select>

        </div>
        <div class="col-xs-6">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a class="btn btn-primary" href="add_post.php">Add New</a>
        </div>

        <thead>
            <tr>
                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>ID</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>Delete</th>
                <th>Edit</th>

            </tr>
        </thead>
        <tbody>
            <?php find_all_posts(); ?>
        </tbody>
    </table>
</form>



<?php delete_post(); ?>








