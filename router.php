<?php

// Start Session
session_start();

// Establish Database Connection
require_once 'db.class.php';
DB::$user = 'root';
DB::$password = 'password';
DB::$host = 'localhost';
DB::$port = '3307';
DB::$dbName = 'library';

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
    return (isset($_POST, $_POST[$key]) ? $_POST[$key] : (isset($variable) ? $variable : ''));
}
