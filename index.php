<?php

include('config/db_connect.php');

$query = "SELECT * FROM song ORDER BY title ASC";
$result = mysqli_query($conn, $query);
$songs = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

<div class="row">
    <?php foreach ($songs as $song) : ?>
        <div class="col s12 m6 l4 xl3">
            <div class="card z-depth-0 radius-card">
                <img src="img/icon.png" alt="icon" class="icon-card">
                <div class="card-content center">
                    <h5><?php echo htmlspecialchars($song['title']); ?></h5>
                    <h6><?php echo htmlspecialchars($song['artist']); ?></h6>
                </div>
                <div class="card-action right-align radius-card">
                    <a href="song.php?id=<?php echo $song['id']; ?>" class="blue-text text-darken-2">
                        More Info
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php include('templates/footer.php'); ?>

</html>