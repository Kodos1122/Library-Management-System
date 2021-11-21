<?php

$featured_books = DB::query("SELECT *, (SELECT name FROM genres WHERE id = (SELECT genre_id FROM book_genres WHERE book_id = books.id LIMIT 1)) as genre FROM books ORDER BY RAND() LIMIT 6");

include('includes/header.php');

?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="fas fa-book-reader"></i> Ontario Tech <strong>Library</strong></h1>
</div>

<div class="row mb-4">
    <h2 class="mb-3">Search</h2>

    <div class="row">
        <div class="col-lg-12">
            <form action="/books" class="">
                <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control form-control-lg" placeholder="Search">
                    <button type="submit" class="input-group-text btn-success"><i class="fa fa-search">&nbsp;</i>&nbsp;Search</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row mb-4">
    <h2 class="mb-3">Featured Books</h2>

    <div class="row">

        <?php foreach ($featured_books as $book): ?>
            <div class="col-md-6">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative cursor-pointer" onclick="window.location.href='/book/<?= strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $book['title']))); ?>-<?= $book['id'] ?>'">
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-primary"><?= $book['genre'] ?></strong>
                        <h3 class="mb-0"><?= (strlen($book['title']) > 43) ? substr($book['title'], 0, 40) . '...' : $book['title'] ?></h3>
                        <div class="mb-1 text-muted">Published <?= date('F j, Y', strtotime($book['published_at'])) ?></div>
                        <p class="card-text mb-auto">
                            Read this book in <?= floor(($book['pages'] * 1.7) / 60) . ' hours and ' . (($book['pages'] * 1.7) % 60) . ' minutes' ?>.<br>
                            Rated <?= $book['rating'] ?> out of 5 stars
                            <span class="fa fa-star<?= round($book['rating']) >= 1 ? ' text-warning' : ''?>"></span>
                            <span class="fa fa-star<?= round($book['rating']) >= 2 ? ' text-warning' : ''?>"></span>
                            <span class="fa fa-star<?= round($book['rating']) >= 3 ? ' text-warning' : ''?>"></span>
                            <span class="fa fa-star<?= round($book['rating']) >= 4 ? ' text-warning' : ''?>"></span>
                            <span class="fa fa-star<?= round($book['rating']) >= 5 ? ' text-warning' : ''?>"></span>
                        </p>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                        <img height="250" src="/assets/images/cover-default.png" alt="<?= $book['title'] ?>">
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>

<?php include('includes/footer.php'); ?>