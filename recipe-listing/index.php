<?php

    include("config/db_connect.php");

    //get all recipe
    // construct query
    $sql = "SELECT title, ingredients, id FROM recipes ORDER BY created_at DESC;";
    // query through conn
    $result = mysqli_query($conn, $sql);
    // parse results
    $recipes = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_free_result($result);
    mysqli_close($conn);





?>
<!DOCTYPE html>
<html lang="en">
    <?php include("templates/header.html"); ?>

    <h4 class="center grey-text">Recipes</h4>
    <div class="container">
        <div class="row">
        <?php foreach ($recipes as $recipe): ?>
            <div class="col s6 md-3">
                <div class="card z-depth-0">
                    <img src="images/pizza.svg" class="pizza">
                    <div class="card-content center">
                        <h5><?php echo(htmlspecialchars($recipe['title'])); ?></h5>
                        <ul class="grey-text">
                            <?php foreach(explode(',', $recipe['ingredients']) as $ing): ?>
                                <li><?php echo htmlspecialchars($ing); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="card-action right-align">
                        <a href="details.php?id=<?php echo $recipe['id']; ?>" class="brand-text">Read more >>></a>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
        </div>
    </div>


    <?php include("templates/footer.html"); ?>

</body>
</html>
