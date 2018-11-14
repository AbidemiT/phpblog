<?php 
    require('config/config.php');
    require('config/db.php');

    if(isset($_POST['delete'])){
        // Get Form data
        $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);
    
    
    $query = "DELETE FROM posts WHERE id = {$delete_id}";
    
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
        <h1><?php echo $value['title']; ?></h1> 
        <small>Created on <?php echo $value['created_at']; ?> by 
            <?php echo $value['author']; ?>
        </small>
        <p><?php echo $value['body']; ?></p>
        <hr>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="hidden" name="delete_id" value="<?php echo $value['id']; ?>" >
            <input type="submit" name="delete" value="Delete">
        </form>
        <a href="<?php echo ROOT_URL; ?>editpost.php?id=<?php echo $value['id']; ?>">Edit</a>
</div>
<?php include('inc/footer.php'); ?>