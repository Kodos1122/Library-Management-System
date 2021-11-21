<?php 

$where = new WhereClause("and");

if (isset($_GET['search'])) {
    $where->add("name LIKE %ss", $_GET['search']);
}

$count = DB::queryFirstField("SELECT COUNT(*) FROM publishers WHERE %l", $where);

$pagination = pagination($count, 5);
$order_by = $pagination['order_by'];
$sort_by = $pagination['sort_by'];
$limit = $pagination['limit'];
$offset = $pagination['offset'];
$order_by = strtolower($_GET['order_by'] ?? "id");
$sort_by = ((strtoupper($_GET['sort_by'] ?? null) == "DESC") ? "DESC" : "ASC");

$publishers = DB::query("SELECT *, (SELECT COUNT(*) FROM books WHERE publisher_id = publishers.id) as books FROM publishers WHERE %l ORDER BY %b $sort_by LIMIT %i OFFSET %i", $where, $order_by, $limit, $offset);

include('includes/header.php');

?>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><i class="fas fa-user-edit"></i> Publishers</h1>
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
        <div class="col-sm-8"><h2>All <strong>Publishers</strong></h2></div>
        <div class="col-sm-4">
            <form class="form-group search" method="GET" action="">
                <div class="form-group search">
                    <span class="fa fa-search form-control-feedback"></span>
                    <input type="text" name="search" class="form-control" placeholder="Search" value="<?= get_value('search', '') ?>">
                    <input type="submit" hidden>
                </div>
            </form>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" width="5%">#</th>
                    <th scope="col" width="85%"><a href="<?= modify_query_url([ 'order_by' => 'name', 'sort_by' => ($sort_by == "ASC" ? 'desc' : 'asc') ]) ?>" class="text-decoration-none text-dark">Publisher<?= (($order_by == "name") ? ' <i class="fas fa-caret-' . (($sort_by == "ASC") ? 'up' : 'down') . '"></i>' : '') ?></a></th>
                    <th scope="col" width="10%"><a href="<?= modify_query_url([ 'order_by' => 'books', 'sort_by' => ($sort_by == "ASC" ? 'desc' : 'asc') ]) ?>" class="text-decoration-none text-dark">Books<?= (($order_by == "books") ? ' <i class="fas fa-caret-' . (($sort_by == "ASC") ? 'up' : 'down') . '"></i>' : '') ?></a></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($publishers as $publisher): ?>
                    <tr onclick="window.location.href='/books?publisher=<?= $publisher['id'] ?>'">
                        <td><?= $publisher['id'] ?></td>
                        <td><?= $publisher['name'] ?></td>
                        <td><?= $publisher['books'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="row">
        <div class="col-4 hint-text">Showing <b><?= $pagination['start'] ?> - <?= $pagination['end'] ?></b> out of <b><?= $pagination['count'] ?></b> entries</div>
        <nav class="col-8">
            <ul class="pagination justify-content-end">
                <li class="page-item<?= ($pagination['page'] == 1) ? ' disabled' : '' ?>">
                    <a class="page-link" href="<?= modify_query_url('offset', 0) ?>" aria-label="First">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <?php foreach ($pagination['buttons'] as $button): ?>
                    <li class="page-item<?= ($button['active'] ? ' active' : '') ?>"><a class="page-link" href="<?= modify_query_url('offset', ($button['number'] - 1) * $pagination['limit']) ?>"><?= $button['number'] ?></a></li>
                <?php endforeach; ?>

                <li class="page-item<?= ($pagination['page'] == $pagination['pages']) ? ' disabled' : '' ?>">
                    <a class="page-link" href="<?= modify_query_url('offset', ($pagination['pages'] - 1) * $pagination['limit'] ) ?>" aria-label="Last">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

<?php include('includes/footer.php'); ?>