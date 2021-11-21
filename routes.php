<?php

require_once("{$_SERVER['DOCUMENT_ROOT']}/router.php");

post('/login', 'views/login.php');
get('/login', 'views/login.php');

if (empty($_SESSION['user'])) exit(header('Location: /login'));

get('/', 'views/index.php');
get('/users', 'views/users.php');

get('/books', 'views/books.php');
get('/book/$slug', 'views/book.php');

get('/authors', 'views/authors.php');
get('/genres', 'views/genres.php');
get('/publishers', 'views/publishers.php');

get('/logout', 'views/logout.php');

get('/template', 'views/template.php');
any('/404','views/404.php');