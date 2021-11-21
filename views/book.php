<?php 

$book_id = substr($slug, strrpos($slug, '-') + 1);

$book = DB::queryFirstRow("SELECT *, (SELECT name FROM publishers WHERE publishers.id = books.publisher_id) AS publisher FROM books WHERE id = %i", $book_id);
if (!($book)) exit(header('Location: /books'));

$authors = DB::queryFirstColumn("SELECT CONCAT(name_first, IFNULL(CONCAT(' ', name_middle), ''), ' ', name_last) AS name FROM authors WHERE id IN (SELECT author_id FROM book_authors WHERE book_id = %i)", $book['id']);

include('includes/header.php');

?>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><i class="fas fa-book"></i> <?= $book['title'] ?></h1>
        <p class="lead">ISBN: <?= $book['isbn'] ?></p>
        <!--<div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
            </button>
        </div>-->
    </div>

    <div class="row">
        <div class="col-sm-2">
            <img src="/assets/images/cover-default.png" alt="<?= $book['title'] ?>" class="img-thumbnail">
        </div>

        <div class="col-sm-10">
            <h1 class="book-title"><?= $book['title'] ?></h1>
            <p class="lead">
                <strong>Written By:</strong> <?= implode(", ", $authors) ?><br>
                <strong>Published By:</strong> <?= $book['publisher'] ?><br>
                <strong>Published On:</strong> <?= date('F, j Y', strtotime($book['published_at'])) ?>
            </p>
            <p>
                This book has <strong><?= $book['pages'] ?></strong> pages and should take approximately <strong><?= floor(($book['pages'] * 1.7) / 60) . ' hours and ' . (($book['pages'] * 1.7) % 60) . ' minutes' ?></strong> to read.<br>
                Our readers have rated this book (<strong><?= $book['rating'] ?></strong> out of 5 stars)
                <span class="fa fa-star<?= round($book['rating']) >= 1 ? ' text-warning' : ''?>"></span>
                <span class="fa fa-star<?= round($book['rating']) >= 2 ? ' text-warning' : ''?>"></span>
                <span class="fa fa-star<?= round($book['rating']) >= 3 ? ' text-warning' : ''?>"></span>
                <span class="fa fa-star<?= round($book['rating']) >= 4 ? ' text-warning' : ''?>"></span>
                <span class="fa fa-star<?= round($book['rating']) >= 5 ? ' text-warning' : ''?>"></span>
            </p>
            </p>
        </div>
    </div>

<?php include('includes/footer.php'); ?>