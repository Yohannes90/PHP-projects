<?php require "includes/header.php"; ?>
<?php require "config.php"; ?>

<?php
    if(isset($_SESSION['username'])) {
        header("location: index.php");
    }
    if (isset($_POST['submit'])) {
        if ($_POST['email'] == '' || $_POST['password'] == '') {
            echo("some input empty");
        } else {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $login = $conn->query("SELECT * FROM users WHERE email = '$email'");
            $login->execute();
            $user = $login->fetch(PDO::FETCH_ASSOC);

            if ($user &&  password_verify($password, $user['pass'])) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                header("location: index.php");

                echo($user);
                print_r($user);
            } else {
                echo("Wrong email or password, please try again");
            }
        }
    }


?>


<main class="form-signin w-50 m-auto">
  <form method="POST" action="login.php">
    <!-- <img class="mb-4 text-center" src="/docs/5.2/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> -->
    <h1 class="h3 mt-5 fw-normal text-center">Please sign in</h1>

    <div class="form-floating">
      <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>

    <div class="form-floating">
      <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <button name="submit" class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <h6 class="mt-3">Don't have an account? <a href="register.php">Create new account</a></h6>
  </form>
</main>
<?php require "includes/footer.php"; ?>
