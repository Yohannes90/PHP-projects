<?php
    include("config/db_connect.php");

    
    if (isset($_POST['delete'])) {
        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
		$sql = "DELETE FROM recipes WHERE id = $id_to_delete";

        if (mysqli_query($conn, $sql)) {
            header('Location: index.php');
        } else {
            echo('query error: ' . mysqli_error($conn));
        }
	}

    if (isset($_GET['id'])) {
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        $sql = "SELECT * FROM recipes WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        $recipe = mysqli_fetch_assoc($result);

        mysqli_free_result($result);
        mysqli_close($conn);
    }

?>
<!DOCTYPE html>
<html>

    <?php include("templates/header.html"); ?>

    <h2>Details</h2>
    <div class="container center">
        <?php if ($recipe): ?>
            <h4><?php echo(htmlspecialchars($recipe['title'])); ?></h4>
            <p>Created by: <?php echo(htmlspecialchars($recipe['email'])); ?></p>
            <p><?php echo(date($recipe['created_at'])); ?></p>
            <h5>Ingredients:</h5>
			<p><?php echo $recipe['ingredients']; ?></p>
            <!-- DELETE FORM -->
			<form action="details.php" method="POST">
				<input type="hidden" name="id_to_delete" value="<?php echo $recipe['id']; ?>">
				<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
			</form>
        <?php else: ?>
            <h5>Recipe not found.</h5>
        <?php endif; ?>


    </div>
    <?php include("templates/footer.html"); ?>

</html>
