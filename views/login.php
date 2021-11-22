<?php

if (isset($_SESSION['user'])) exit(header('Location: /'));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['email'])) $errors[] = "Please enter your email address.";
    if (empty($_POST['password'])) $errors[] = "Please enter your password.";

    $user = DB::queryFirstRow("SELECT id, email, name_first, name_last, password, role FROM users WHERE email = %s", $_POST['email']);
    if (!($user && password_verify($_POST['password'], $user['password']))) $errors[] = "You have entered an invalid email or password.";

    if (empty($errors)) {
        $_SESSION['user'] = $user;
        $_SESSION['user']['name'] = $user['name_first'] . " " . $user['name_last'];

        switch ($user['role']) {
            case 4:
                $_SESSION['user']['role'] = "admin";
                break;
            case 3:
                $_SESSION['user']['role'] = "librarian";
                break;
            case 2:
                $_SESSION['user']['role'] = "researcher";
                break;
            case 1:
            default:
                $_SESSION['user']['role'] = "client";
                break;
        }

        exit(header('Location: /'));
    }
}

include('includes/header.php');

?>

<div class="container-fluid">
    <div class="row">

        <div class="col-sm-6 text-black">
            <?php if (!empty($errors)): ?>
                <div class="col-sm-10 offset-sm-1 mt-5 mb-0">
                    <div class="alert alert-danger d-flex mb-0" role="alert">
                        <div class="text-body"><strong>Error: </strong><?= implode('<br>', $errors) ?></div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="px-5 ms-xl-4">
              <i class="fas fa-book-reader fa-2x me-3 pt-5 mt-xl-4 text-primary"></i>
              <span class="h1 fw-bold mb-0">Library Login</span>
            </div>

            <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">
                <form action="/login" method="POST" style="width: 23rem;">
                    <h3 class="fw-normal mb-3 pb-2" style="letter-spacing: 1px;">Log in</h3>

                    <div class="form-outline mb-2">
                        <input type="email" id="email" name="email" class="form-control form-control-lg" />
                        <label class="form-label" for="email">Email address</label>
                    </div>

                    <div class="form-outline mb-2">
                        <input type="password" id="password" name="password" class="form-control form-control-lg" />
                        <label class="form-label" for="password">Password</label>
                    </div>

                    <div class="pt-1 mb-4">
                        <button class="btn btn-primary btn-lg btn-block px-5" type="submit">Login</button>
                    </div>

                    <!--<p>Don't have an account? <a href="/register" class="link-primary">Register here</a></p>-->

                </form>
            </div>

            <div class="col-sm-10 offset-sm-1 mt-4 card" id="demo">
                <div class="card-body text-muted small">
                    <strong>This is a demonstration website.</strong> Please use these accounts to test the website functionality as different roles.
                </div>
                <ul class="list-group list-group-flush small">
                    <li class="list-group-item text-muted">Email: admin@ontariotechu.net<span style="float: right;">Password: password</span></li>
                    <li class="list-group-item text-muted">Email: librarian@ontariotechu.net<span style="float: right;">Password: password</span></li>
                    <li class="list-group-item text-muted">Email: researcher@ontariotechu.net<span style="float: right;">Password: password</span></li>
                    <li class="list-group-item text-muted">Email: student@ontariotechu.net<span style="float: right;">Password: password</span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 px-0 d-none d-sm-block">
            <img class="w-100" style="object-fit: cover; object-position: right; height: 94.2vh" src="/assets/images/library-cover.png">
        </div>
    </div>
</div>




<?php /*
<div class="row text-center">
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger d-flex" role="alert">
            <div class="text-body"><strong>Error: </strong><?= implode('<br>', $errors) ?></div>
        </div>
    <?php endif; ?>

    <form action="/login" method="POST" class="form-signin">
        <img class="my-5" src="/assets/images/logo.png" alt="" width="250">

        <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required autofocus>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block col-12" type="submit">Sign in</button>
    </form>
</div>
*/ ?>
