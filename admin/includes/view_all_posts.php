<?php 

include('delete_modal.php');

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

            case 'clone':
                $query = "SELECT * FROM posts WHERE post_id = '{$post_id}' ";
                $select_post = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_array($select_post)) {
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_date = $row['post_date'];
                    $post_author = $row['post_author'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_content = $row['post_content'];
                    $post_views_count = $row['post_views_count'];
                }

                $post_title = mysqli_real_escape_string($connection, $post_title);
                $post_content = mysqli_real_escape_string($connection, $post_content);
                
                $query = "INSERT INTO posts ";
                $query .= "(post_category_id, post_title, post_author, post_date, post_image, ";
                $query .= "post_content, post_tags, post_status) ";
                $query .= "VALUES(";
                $query .= "$post_category_id, '$post_title', '$post_author', now(), '$post_image', ";
                $query .= "'$post_content', '$post_tags', '$post_status'";
                $query .= ")";
                
                $clone_posts = mysqli_query($connection, $query);
                confirm_query($clone_posts);
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
                <option value="clone">Clone</option>
            </select>

        </div>
        <div class="col-xs-6">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a class="btn btn-primary" href="posts.php?source=add_post">Add New Post</a>
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
                <th>View Post</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Views</th>
            </tr>
        </thead>
        <tbody>
            <?php find_all_posts(); ?>
        </tbody>
    </table>
</form>



<?php delete_post() ?>
<?php reset_post_views() ?>









