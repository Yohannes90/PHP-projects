<?php

    function validateEmail($email) {
        if ($email) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return $email;
            }
            return("Email not valid.");
        }
        return("Email is required.");
    }

    function validateTitle($title) {
        if ($title) {
            if (preg_match('/^[a-zA-Z\s]+$/', $title)) {
                return $title;
            }
            return("Pizza title not valid.");
        }
        return("Pizza title is required.");
    }

    function validateIngredients($ingredients) {
        if ($ingredients) {
            if (preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) {
                return $ingredients;
            }
            return("Ingredients must be a comma separated list.");
        }
        return("Atleast 1 ingridient is required.");
    }
    if (isset($_POST['submit'])) {
        //check email
        $email = htmlspecialchars($_POST['email']);
        echo(validateEmail(($email)));
        echo("<br/>");

        //check title
        $title = htmlspecialchars($_POST['title']);
        echo(validateTitle(($title)));
        echo("<br/>");

        //check ingredients
        $ingredients = htmlspecialchars($_POST['ingredients']);
        echo(validateIngredients(($ingredients)));
        echo("<br/>");
    }



?>
<!DOCTYPE html>
<html lang="en">
    <?php include("templates/header.html"); ?>

    <section id="add" class="container grey-text">
        <h4 class="center">Add a Pizza</h4>
        <form action="add.php" class="white" method="POST">
            <label for="email">Email</label>
			<input type="text" name="email">
			<label for="title">Pizza</label>
			<input type="text" name="title">
			<label for="ingredients">Ingredients (comma separated)</label>
			<input type="text" name="ingredients">
			<div class="center">
				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
			</div>
        </form>
    </section>

    <?php include("templates/footer.html"); ?>

</body>
</html>
