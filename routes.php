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

any('/404','views/404.php');

if (empty($_SESSION['user'])) exit(header('Location: /login'));

get('/users', 'views/users.php');
get('/template', 'views/template.php');
