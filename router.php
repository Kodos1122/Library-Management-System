<?php

// Start Session
session_start();

// Establish Database Connection
$config = parse_ini_file('config.ini');

require_once 'db.class.php';
DB::$user = $config['user'];
DB::$password = $config['password'];
DB::$dbName = $config['dbName'];
DB::$host = $config['host'];
DB::$port = $config['port'];
DB::$encoding = $config['encoding'];

// Routing
function get($route, $path_to_include) {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (route($route, $path_to_include)) exit();
    }
}

function post($route, $path_to_include) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (route($route, $path_to_include)) exit();
    }
}

function put($route, $path_to_include) {
    if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
        if (route($route, $path_to_include)) exit();
    }
}

function patch($route, $path_to_include) {
    if ($_SERVER['REQUEST_METHOD'] == 'PATCH') {
        if (route($route, $path_to_include)) exit();
    }
}

function delete($route, $path_to_include) {
    if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
        if (route($route, $path_to_include)) exit();
    }
}

function any($route, $path_to_include) {
    route($route, $path_to_include);
}

function route($route, $path_to_include) {
    $ROOT = $_SERVER['DOCUMENT_ROOT'];

    if ($route == "/404") {
        include_once("$ROOT/$path_to_include");
        return true;
    }

    $request_url       = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
    $request_url       = rtrim($request_url, '/');
    $request_url       = strtok($request_url, '?');
    $route_parts       = explode('/', $route);
    $request_url_parts = explode('/', $request_url);

    array_shift($route_parts);
    array_shift($request_url_parts);

    if ($route_parts[0] == '' && count($request_url_parts) == 0) {
        include_once("$ROOT/$path_to_include");
        return true;
    }

    if (count($route_parts) != count($request_url_parts)) {
        return false;
    }
    
    $parameters = [];
    for ($__i__ = 0; $__i__ < count($route_parts); $__i__++) {
        $route_part = $route_parts[$__i__];
        if (preg_match("/^[$]/", $route_part)) {
            $route_part = ltrim($route_part, '$');
            array_push($parameters, $request_url_parts[$__i__]);
            $$route_part = $request_url_parts[$__i__];
        } else if ($route_parts[$__i__] != $request_url_parts[$__i__]) {
            return;
        }
    }

    include_once("$ROOT/$path_to_include");
    return true;
}

function set_csrf() {
    $csrf_token       = bin2hex(random_bytes(25));
    $_SESSION['csrf'] = $csrf_token;

    echo '<input type="hidden" name="csrf" value="' . $csrf_token . '">';
}

function validate_csrf() {
    if (!isset($_SESSION['csrf']) || !isset($_POST['csrf'])) {
        return false;
    }

    if ($_SESSION['csrf'] != $_POST['csrf']) {
        return false;
    }

    return true;
}

function sanitize($text) {
    return htmlspecialchars($text);
}

function get_value($key, $variable = null) {
    return (isset($_POST, $_POST[$key]) ? $_POST[$key] : (isset($_GET, $_GET[$key]) ? $_GET[$key] : (isset($variable) ? $variable : '')));
}

function modify_query_url($key, $value = null) {
    $parameters = array();
    
    if (is_array($key)) {
        $parameters = $key;
    } else $parameters[$key] = $value;

    $path = parse_url($_SERVER['REQUEST_URI']);
    $query_string = $path['query'] ?? "";

    parse_str($query_string, $query);
    
    foreach ($parameters as $key => $value) {
        $query[$key] = $value;
    }

    return '?' . http_build_query($query);
}

function pagination($count, $buttons) {
    $limit = (empty($_GET['limit'])) ? 25 : max(5, min(100, $_GET['limit']));
    $offset = (empty($_GET['offset'])) ? 0 : $_GET['offset'];

    $order_by = strtolower($_GET['order_by'] ?? "id");
    $sort_by = ((strtoupper($_GET['sort_by'] ?? null) == "DESC") ? "DESC" : "ASC");

    // Calculate page number
    $page = ($offset / $limit) + 1;
    $pages = max(1, ceil($count / $limit));

    $end = min($count, ($offset + $limit));
    $start = min($end, ($offset + 1));

    $pagination = array();
    $pagination['buttons'] = array();

    $pagination['end'] = $end;
    $pagination['start'] = $start;
    $pagination['count'] = $count;
    $pagination['limit'] = $limit;
    $pagination['offset'] = $offset;
    $pagination['order_by'] = $order_by;
    $pagination['sort_by'] = $sort_by;

    $pagination['page'] = $page;
    $pagination['pages'] = $pages;

    // Pagination initalization
    $buttons = 5;

    if ($buttons > $pages) $buttons = $pages;

    $page_offset = ceil($buttons / 2);
    if ($page_offset - $page <= 2) $page_offset = min($page, $page_offset);
    if ($page + ($buttons - $page_offset) > $pages) $page_offset = ($buttons - ($pages - $page));

    if ($page == 1) $page_offset = 1;
    if ($page == $pages) $page_offset = $buttons;

    foreach (range(1, $buttons) as $i) {
        if ($i < $page_offset) $page_number = $page - ($page_offset - $i);
        if ($i == $page_offset) $page_number = $page;
        if ($i > $page_offset) $page_number = $page + ($i - $page_offset);

        $active = ($page == $page_number);

        $button = array();
        $button['active'] = $active;
        $button['number'] = $page_number;
        $button['offset'] = (($page_number - 1) * $limit);

        $pagination['buttons'][] = $button;
    }

    return $pagination;
}
