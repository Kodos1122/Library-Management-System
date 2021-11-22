<?php

if (isset($_SESSION['user'])) exit(header('Location: /'));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    do {
        if (empty($_POST['card'])) $errors[] = "Please enter your library card number.";
        if (empty($_POST['password'])) $errors[] = "Please enter your password.";
        if (empty($_POST['password_confirm'])) $errors[] = "Please confirm your password.";

        if (!empty($errors)) break;

        $client = DB::queryFirstRow("SELECT id, user_id, email, name_first, name_last FROM clients WHERE card = %s", $_POST['card']);
        if (!$client) {
            $errors[] = "You have entered an invalid library card number.";
            break;
        }

        if (!empty($client['user_id'])) {
            $errors[] = "You already have an online account. Please visit a branch to reset your password.";
            break;
        }

        if ($_POST['password'] !== $_POST['password_confirm']) {
            $errors[] = "The passwords you have entered do not match.";
            break;
        }

        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        DB::insert('users', [
            'email' => $client['email'],
            'name_first' => $client['name_first'],
            'name_last' => $client['name_last'],
            'password' => $password
        ]);

        $user_id = DB::insertId();

        DB::update('clients', [
            'user_id' => $user_id
        ], 'id = %i', $client['id']);

        $user = DB::queryFirstRow("SELECT id, email, name_first, name_last FROM users WHERE id = %i", $user_id);

        $_SESSION['user'] = $user;
        $_SESSION['user']['name'] = $user['name_first'] . " " . $user['name_last'];
        $_SESSION['user']['role'] = "client";

        exit(header('Location: /'));
    } while(0);
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

            <div class="px-5 ms-xl-4 text-primary">
              <i class="fas fa-book-reader fa-2x me-3 pt-5 mt-xl-4"></i>
              <span class="h1 fw-bold mb-0">Create Account</span>
            </div>

            <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">
                <form action="/register" method="POST" style="width: 23rem;">
                    <h3 class="fw-normal mb-3 pb-2" style="letter-spacing: 1px;">Register for an Account</h3>

                    <small class="text-muted">If you do not already have a library card, you must first visit an open library branch with valid and current name and address identification to apply for a new library card.</small>

                    <div class="form-outline mb-2 mt-4">
                        <input type="text" id="card" name="card" class="form-control form-control-lg" value="<?= get_value('card') ?>" required>
                        <label class="form-label" for="card">Library Card Number</label>
                    </div>

                    <div class="form-outline mb-2">
                        <input type="password" id="password" name="password" class="form-control form-control-lg" required>
                        <label class="form-label" for="password">New Password</label>
                    </div>

                    <div class="form-outline mb-2">
                        <input type="password" id="password_confirm" name="password_confirm" class="form-control form-control-lg" required>
                        <label class="form-label" for="password_confirm">Confirm Password</label>
                    </div>

                    <div class="pt-1 mb-4">
                        <button class="btn btn-primary btn-lg btn-block px-5" type="submit">Create Account</button>
                    </div>

                </form>
            </div>
        </div>
        <div class="col-sm-6 px-0 d-none d-sm-block">
            <img class="w-100" style="object-fit: cover; object-position: right; height: 94.2vh; opacity: 80%" src="/assets/images/library-cover.png">
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
