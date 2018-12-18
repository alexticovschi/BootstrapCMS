<?php

// CHECK IF THE QUERY FAILED OR NOT
function confirm_query($result) {
    global $connection;

    if(!$result) {
        die('Query Failed: ' . mysqli_error($connection));
    }
}


// INCLUDE update_categories.php FILE
function include_update_categories_file() {
	global $connection;

    // if the edit link has the key edit in it, include update_categories.php file 
    if(isset($_GET['edit'])) {
        include("includes/update_categories.php");
    }	
}


// FIND ALL CATEGORIES FROM categories TABLE
function find_all_categories() {
	global $connection;

    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);

    confirm_query($select_categories);

    while($row = mysqli_fetch_assoc($select_categories)) {
        $cat_id = $row['cat_id'];  
        $cat_title = $row['cat_title'];                               

        echo "<tr>";
            echo "<td>{$cat_id}</td>";
            echo "<td>{$cat_title}</td>";
            echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>"; 
            echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>"; 
        echo "</tr>";
    }	
}


// FIND ALL COMMENTS FROM comments TABLE AND DISPLAY THEM
// AND RELATE COMMENTS TO POSTS
function find_all_comments() {
    global $connection;

    $query = "SELECT * FROM comments";
    $select_comments = mysqli_query($connection, $query);

    confirm_query($select_comments);

    while($row = mysqli_fetch_assoc($select_comments)) {
        $comment_id = $row['comment_id']; 
        $comment_post_id = $row['comment_post_id']; 
        $comment_author = $row['comment_author'];
        $comment_email = $row['comment_email']; 
        $comment_content = $row['comment_content']; 
        $comment_status = $row['comment_status']; 
        $comment_date = $row['comment_date']; 

        echo "<tr>";
            echo "<td>$comment_id</td>";
            echo "<td>$comment_author</td>";
            echo "<td>$comment_content</td>";
            echo "<td>$comment_email</td>"; 
            echo "<td>$comment_status</td>";


            // RELATE COMMENTS TO POSTS
            $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
            $select_post_id = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_post_id)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];

                echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
            }

                
            echo "<td>$comment_date</td>";  
            echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
            echo "<td><a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>";
            echo "<td><a href='comments.php?delete=$comment_id'>Delete</a></td>";                                                        
        echo "</tr>";
    }     
}


// DELETE COMMENT FROM comments TABLE
function delete_comment() {
    global $connection;

    if(isset($_GET['delete'])) {
        $comment_id = $_GET['delete'];

        $query = "DELETE FROM comments WHERE comment_id=$comment_id";
        $delete_comment = mysqli_query($connection, $query);

        confirm_query($delete_comment);

        header("Location: comments.php");

    }

}

// UNAPPROVE COMMENT
function unapprove_comment() {
    global $connection;

    if(isset($_GET['unapprove'])) {
        $comment_status = $_GET['unapprove'];

        $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $comment_status ";
        $update_comment_status = mysqli_query($connection, $query);

        confirm_query($update_comment_status);

        header("Location: comments.php");
    }    
}


// APPROVE COMMENT
function approve_comment() {
    global $connection;

    if(isset($_GET['approve'])) {
        $comment_status = $_GET['approve'];

        $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $comment_status ";
        $update_comment_status = mysqli_query($connection, $query);

        confirm_query($update_comment_status);

        header("Location: comments.php");
    }      
}


// FIND ALL POSTS FROM posts TABLE AND DISPLAY THE CONTENT
function find_all_posts() {
    global $connection;

    $query = "SELECT * FROM posts ORDER BY post_id ASC";
    $select_posts = mysqli_query($connection, $query);

    confirm_query($select_posts);

    while($row = mysqli_fetch_assoc($select_posts)) {
        $post_id = $row['post_id']; 
        $post_author = $row['post_author']; 
        $post_title = $row['post_title'];                                   
        $post_category_id = $row['post_category_id'];  
        $post_status = $row['post_status'];  
        $post_image = $row['post_image'];  
        $post_tags = $row['post_tags'];  
        $post_comment_count = $row['post_comment_count']; 
        $post_date = $row['post_date'];
        $post_views_count = $row['post_views_count'];
        
        echo "<tr>";

        ?>

        <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>

        <?php
            echo "<td>$post_id</td>";
            echo "<td>$post_author</td>";
            echo "<td>$post_title</td>";


            // Relate the category(from the catagories table) to post_category_id(from the posts table) and display the title
            $query = "SELECT cat_id, cat_title FROM categories WHERE cat_id='{$post_category_id}' ";
            $select_category = mysqli_query($connection, $query);
            $row = mysqli_fetch_assoc($select_category);   
            $cat_title = $row['cat_title']; 
            echo "<td>$cat_title</td>";



            echo "<td>$post_status</td>";
            echo "<td><img width='110' class='img-responsive' src='../images/$post_image'></td>";
            echo "<td>$post_tags</td>";

            $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
            $comment_query = mysqli_query($connection, $query);

            $row = mysqli_fetch_assoc($comment_query);
            $comment_id = $row['comment_id'];
            $count_comments = mysqli_num_rows($comment_query);
            echo "<td><a href='comment.php?id=$comment_id'>$count_comments</a></td>";

            echo "<td>$post_date</td>";   
            echo "<td style='text-align: center'><a href='../post.php?p_id={$post_id}'><i class='fa fa-eye' aria-hidden='true' data-toggle='tooltip' title='View Post'></i></a></td>";  
            echo "<td style='text-align: center'><a href='posts.php?source=edit_post&p_id=$post_id'><i class='fa fa-pencil-square-o' aria-hidden='true' data-toggle='tooltip' title='Edit Post'></i></a></td>";                
            echo "<td onClick=\"javascript: return confirm('Are you sure you want to delete this post?');\" style='text-align: center'><a href='posts.php?delete=$post_id'><i class='fa fa-trash trash-post' aria-hidden='true' data-toggle='tooltip' title='Delete Post'></i></a></td>";
            echo "<td>{$post_views_count}  <a href='posts.php?reset=$post_id'><i class='fa fa-times-circle' data-toggle='tooltip' title='Reset Count'></i></a></td>";
        echo "</tr>";
    }    
}

// INSERT CATEGORIES IN categories TABLE
function insert_categories() {
	global $connection;

    // check if the user has submitted some value and store the value in the $cat_title variable 
    // if the input field is empty, inform the user, else insert the value into categories table
    // and then check if the query was successful; if it wasn't, kill the script and display the error
    if(isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];

        if(trim($cat_title == "") || empty($cat_title)) {
            echo "This field should not be empty";
        } else {
            $query = "INSERT INTO categories (cat_title) VALUES ('{$cat_title}')";

            $category_query = mysqli_query($connection, $query);

            confirm_query($category_query);
        }
    }	
}


// UPDATE CATEGORIES INTO categories TABLE
function update_categories() {
	global $connection;

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

    // UPDATE QUERY
    if(isset($_POST['update_category'])) {
        $the_cat_title = $_POST['cat_title'];
        $query = "UPDATE categories SET cat_title = '{$the_cat_title}' WHERE cat_id='{$cat_id}' ";
        $edit_query = mysqli_query($connection, $query);

        confirm_query($edit_query);

        header("Location: categories.php"); 
    } 


}

// DELETE CATEGORIES FROM categories TABLE
function delete_categories() {
	global $connection;

    // if there is a delele key in the url, and its value is identical with ...
    // the id from the categories table, delete that category
    // then refresh the page
    if(isset($_GET['delete'])) {
        $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = '{$the_cat_id}' ";
        $delete_query = mysqli_query($connection, $query);

        confirm_query($delete_query);

        header("Location: categories.php"); 
    }	
}


// CREATE POST - INSERT POST INTO posts TABLE
function create_post() {
    global $connection;

    if(isset($_POST['create_post'])) {

        $post_category_id = $_POST['post_category'];
        $post_author = $_POST['post_author']; 
        $post_title = mysqli_real_escape_string($connection, $_POST['post_title']);                                   
        $post_status = $_POST['post_status'];  

        $post_image = $_FILES['image']['name']; 
        $post_image_temp = $_FILES['image']['tmp_name']; 

        $post_tags = $_POST['post_tags'];  
        $post_content = mysqli_real_escape_string($connection, $_POST['post_content']);   
        $post_date = date('d-m-y');

        move_uploaded_file($post_image_temp, "../images/$post_image");

        $query = "INSERT INTO posts ";
        $query .= "(post_category_id, post_title, post_author, post_date, post_image, ";
        $query .= "post_content, post_tags, post_status) ";
        $query .= "VALUES(";
        $query .= "$post_category_id, '$post_title', '$post_author', now(), '$post_image', ";
        $query .= "'$post_content', '$post_tags', '$post_status'";
        $query .= ")";

        $insert_query = mysqli_query($connection, $query);

        confirm_query($insert_query);

        $post_id = mysqli_insert_id($connection);

        echo "<h4 style='padding: 8px; border-radius: 2px' class='bg-success'>Post Created. <a href='../post.php?p_id={$post_id}'>View Post</a></h4>";
        
    }
}



// DELETE POST FROM posts TABLE
function delete_post() {
    global $connection;

    if(isset($_GET['delete'])) {
        $post_id = $_GET['delete'];

        $query = "DELETE FROM posts WHERE post_id=$post_id";
        $delete_query = mysqli_query($connection, $query);

        confirm_query($delete_query);

        header("Location: posts.php");

    }

}



// RESET POST VIEWS 
function reset_post_views() {
    global $connection;

    if(isset($_GET['reset'])) {
        $post_id = $_GET['reset'];

        $query = "UPDATE posts SET post_views_count = 0 WHERE post_id =" . mysqli_real_escape_string($connection, $post_id) . " ";
        $reset_query = mysqli_query($connection, $query);

        confirm_query($reset_query);

        header("Location: posts.php");
    }
}


// DISPLAY ONLINE USERS
function display_online_users() {
    
    if(isset($_GET['onlineusers'])) {
        global $connection;

        if(!$connection) {
            session_start();
            include("../includes/db.php");
        
            $session = session_id();
            $time = time();
            $time_out_in_seconds = 05;
            $time_out = $time - $time_out_in_seconds;

            $query = "SELECT * FROM users_online WHERE session = '$session'";
            $count = mysqli_num_rows(mysqli_query($connection, $query));

            $session_query = "INSERT INTO users_online(session, time) VALUES('$session', '$time')";
            $update_query = "UPDATE users_online SET time = '$time' WHERE session = '$session'";

            if($count == NULL) {
                mysqli_query($connection, $session_query);    
            } else {
                mysqli_query($connection, $update_query); 
            }

            $users_online = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
            $count_users = mysqli_num_rows($users_online);
            
            echo $count_users;
        }
    }
}

display_online_users();






?>






