<?php 
    require('config/config.php');
    require('config/db.php');

    // Check for Submitted
    // if(isset($_POST['submit'])){
    //     echo 'Submitted';
    // }

   if(isset($_POST['submit'])){
    // Get Form data
    $update_id = mysqli_real_escape_string($conn, $_POST['update_id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $body = mysqli_real_escape_string($conn, $_POST['body']);

    $query = "UPDATE posts SET
                title = '$title',
                author = '$author',
                body = '$body'
                    WHERE id = {$update_id}";

    if(mysqli_query($conn, $query)){
        header('Location: '.ROOT_URL.'');
    } else {
        echo 'ERROR: '. mysqli_error($conn);
    }
   }

   // GET ID
   $id = mysqli_real_escape_string($conn,$_GET['id']);

   // Create Query
   $query = 'SELECT * FROM posts WHERE id = '.$id;

   // Get Result
   $result = mysqli_query($conn, $query);

   // FETCH Data
   $value = mysqli_fetch_assoc($result);
   // var_dump($posts);
   // Free Result
   mysqli_free_result($result);

   // Close Connection
   mysqli_close($conn);
?>

<?php include('inc/header.php'); ?>

    <div class="container">
        <h1>Add Posts</h1>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
            <div>
                <label for="title">Title:</label>
                <input type="text" name="title" placeholder="Post Title" value="<?php echo $value['title']; ?>">
            </div>
            <div>
                <label for="author">Author:</label>
                <input type="text" name="author" placeholder="Author Name" value="<?php echo $value['author']; ?>">
            </div>
            <div>
                <label for="body">Body</label>
                <textarea name="body" cols="30" rows="10"><?php echo $value['body']; ?></textarea>
            </div>
            <input type="hidden" name="update_id" value="<?php echo $value['id']; ?>">
            <input type="submit" name="submit" value="Post">
        </form>
</div>

<?php include('inc/footer.php'); ?>