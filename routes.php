<?php

require_once("{$_SERVER['DOCUMENT_ROOT']}/router.php");

# Guest Pages

get('/', 'views/index.php');

post('/login', 'views/login.php');
get('/login', 'views/login.php');
get('/logout', 'views/logout.php');

get('/books', 'views/books.php');
get('/book/$slug', 'views/book.php');

get('/authors', 'views/authors.php');
get('/genres', 'views/genres.php');
get('/publishers', 'views/publishers.php');

if (isset($_SESSION['user'], $_SESSION['user']['role'])) {
	$role = $_SESSION['user']['role'];

	if ($role == 'admin') {
		get('/users', 'views/users.php');
		get('/template', 'views/template.php');
	}
}

any('/404','views/404.php');