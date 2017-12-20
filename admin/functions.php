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

// FIND ALL POSTS FROM posts TABLE AND DISPLAY THE CONTENT
function find_all_posts() {
    global $connection;

    $query = "SELECT * FROM posts";
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

        echo "<tr>";
            echo "<td>$post_id</td>";
            echo "<td>$post_author</td>";
            echo "<td>$post_title</td>";
            echo "<td>$post_category_id</td>";
            echo "<td>$post_status</td>";
            echo "<td><img width='110' class='img-responsive' src='../images/$post_image'></td>";
            echo "<td>$post_tags</td>";
            echo "<td>$post_comment_count</td>";
            echo "<td>$post_date</td>";   
            echo "<td><a href='posts.php?delete=$post_id'>Delete</a></td>";
            echo "<td><a href='posts.php?source=edit_post&p_id=$post_id'>Edit</a></td>";                                                                    

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
function update_caterories() {
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

        $post_category_id = $_POST['post_category_id'];
        $post_author = $_POST['post_author']; 
        $post_title = $_POST['post_title'];                                   
        $post_status = $_POST['post_status'];  

        $post_image = $_FILES['image']['name']; 
        $post_image_temp = $_FILES['image']['tmp_name']; 

        $post_tags = $_POST['post_tags'];  
        $post_content = $_POST['post_content'];  
        $post_comment_count = 4; 
        $post_date = date('d-m-y');

        move_uploaded_file($post_image_temp, "../images/$post_image");

        $query = "INSERT INTO posts ";
        $query .= "(post_category_id, post_title, post_author, post_date, post_image, ";
        $query .= "post_content, post_tags, post_comment_count, post_status) ";
        $query .= "VALUES(";
        $query .= "$post_category_id, '$post_title', '$post_author', now(), '$post_image', ";
        $query .= "'$post_content', '$post_tags', $post_comment_count, '$post_status'";
        $query .= ")";

        $insert_query = mysqli_query($connection, $query);

        confirm_query($insert_query);
        
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


?>






