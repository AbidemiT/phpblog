<?php 
    require('config/config.php');
    require('config/db.php');

    // Check for Submitted
    // if(isset($_POST['submit'])){
    //     echo 'Submitted';
    // }

   if(isset($_POST['submit'])){
    // Get Form data
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $body = mysqli_real_escape_string($conn, $_POST['body']);

    $query = "INSERT INTO posts(title, author, body) VALUES('$title', '$author', '$body')";

    if(mysqli_query($conn, $query)){
        header('Location: '.ROOT_URL.'');
    } else {
        echo 'ERROR: '. mysqli_error($conn);
    }
   }
?>

<?php include('inc/header.php'); ?>

    <div class="container">
        <h1>Add Posts</h1>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
            <div>
                <label for="title">Title:</label>
                <input type="text" name="title" placeholder="Post Title">
            </div>
            <div>
                <label for="author">Author:</label>
                <input type="text" name="author" placeholder="Author Name">
            </div>
            <div>
                <label for="body">Body</label>
                <textarea name="body" cols="30" rows="10"></textarea>
            </div>
            <input type="submit" name="submit" value="Post">
        </form>
</div>

<?php include('inc/footer.php'); ?>