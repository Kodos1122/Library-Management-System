<?php

if (isset($_SESSION['user'])) exit(header('Location: /'));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['email'])) $errors[] = "Please enter your email address.";
    if (empty($_POST['password'])) $errors[] = "Please enter your password.";

    $user = DB::queryFirstRow("SELECT id, email, name_first, name_last, password FROM users WHERE email = %s", $_POST['email']);
    if (!($user && password_verify($_POST['password'], $user['password']))) $errors[] = "You have entered an invalid email or password.";

    if (empty($errors)) {
        $_SESSION['user'] = $user;
        $_SESSION['user']['name'] = $user['name_first'] . " " . $user['name_last'];

        exit(header('Location: /'));
    }
}

?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Login</title>

    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/login.css" rel="stylesheet">
</head>

<body class="text-center">

    <div class="row">

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger d-flex" role="alert">
            <div class="text-body"><strong>Error: </strong><?= implode('<br>', $errors) ?></div>
        </div>
    <?php endif; ?>

    <form action="/login" method="POST" class="form-signin">
        <img class="mb-4" src="/assets/images/logo.png" alt="" width="250">
        <h1 class="h3 my-3 font-weight-normal text-primary">Ontario Tech <span class="text-warning">Library</span></h1>

        <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required autofocus>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block col-12" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted">&copy; <?= date('Y'); ?></p>
    </form>

    </div>
</body>
</html>
