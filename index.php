<?php 
    require('config/config.php');
    require('config/db.php');

    // Create Query
    $query = 'SELECT * FROM posts ORDER BY created_at DESC';

    // Get Result
    $result = mysqli_query($conn, $query);

    // FETCH Data
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // var_dump($posts);
    // Free Result
    mysqli_free_result($result);

    // Close Connection
    mysqli_close($conn);
?>

<?php include('inc/header.php'); ?>

    <div class="container">
        <h1>Posts</h1>
        <?php foreach ($posts as $post => $value) : ?>
        <div class="well">
        <h3>
            <?php echo $value['title']; ?>
        </h3>
        <small>Created on <?php echo $value['created_at']; ?> by 
            <?php echo $value['author']; ?>
        </small>
        <p><?php echo $value['body']; ?></p>
        <a href="<?php echo ROOT_URL; ?>post.php?id=<?php echo $value['id']; ?>">Read More</a>
        </div>
    <?php endforeach; ?>
</div>

<?php include('inc/footer.php'); ?>