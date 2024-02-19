<?php

    include("config/db_connect.php");

    $email = htmlspecialchars($_POST['email']);
    $title = htmlspecialchars($_POST['title']);
    $ingredients = htmlspecialchars($_POST['ingredients']);


    function validateEmail() {
        global $email;
        if (isset($_POST['submit'])) {
            if ($email) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    return;
                }
                return("Email not valid.");
            }
            return("Email is required.");
        }
    }

    function validateTitle() {
        global $title;
        if (isset($_POST['submit'])) {
            if ($title) {
                if (preg_match('/^[a-zA-Z\s]+$/', $title)) {
                    return;
                }
                return("Recipe title not valid.");
            }
            return("Recipe title is required.");
        }
    }

    function validateIngredients() {
        global $ingredients;
        if (isset($_POST['submit'])) {
            if ($ingredients) {
                if (preg_match('/^([a-zA-Z0-9\s]+)(,\s*[a-zA-Z0-9\s]*)*$/', $ingredients)) {
                    return;
                }
                return("Ingredients must be a comma separated list.");
            }
            return("Atleast 1 ingredient is required.");
        }
    }

    if (isset($_POST['submit']) && !validateEmail() && !validateTitle() && !validateIngredients()) {
        echo("form has no errors");
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);
        $sql = "INSERT INTO recipes(title, email, ingredients) VALUES('$title', '$email', '$ingredients')";
        // $sql = "INSERT INTO pizzas(title,email,ingredients) VALUES('$title','$email','$ingredients')";
        if (mysqli_query($conn, $sql)) {
            header('Location: index.php');
        } else {
            echo('query error: ' . mysqli_error($conn));
        }
    }

?>



<!DOCTYPE html>
<html lang="en">
    <?php include("templates/header.html"); ?>

    <section id="add" class="container grey-text">
        <h4 class="center">Add a Recipe</h4>
        <form action="add.php" class="white" method="POST">
            <label for="email">Email</label>
			<input type="text" name="email" value="<?php echo $email?>">
            <div class="red-text"><?php echo validateEmail() ?></div>
			<label for="title">Dish name</label>
			<input type="text" name="title" value="<?php echo $title?>">
            <div class="red-text"><?php echo validateTitle(); ?></div>
			<label for="ingredients">Ingredients (comma separated)</label>
			<input type="text" name="ingredients" value="<?php echo $ingredients?>">
            <div class="red-text"><?php echo validateIngredients(); ?></div>
			<div class="center">
				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
			</div>
        </form>
    </section>

    <?php include("templates/footer.html"); ?>

</body>
</html>
