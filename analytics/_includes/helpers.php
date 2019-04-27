<?php

function isPost()
{
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function post($key, $default = null)
{
    if (isset($_POST[$key])) {
        return $_POST[$key];
    }

    return $default;
}

function get($key, $default = null)
{
    if (isset($_GET[$key])) {
        return $_GET[$key];
    }

    return $default;
}

function json_input($keys, $defaults = [])
{
    $input = file_get_contents('php://input');
    $rawData = json_decode($input, true);
    $data = [];

    foreach ($keys as $key) {
        $data[$key] = null;

        if (isset($rawData[$key]) && $rawData[$key] != null) {
            $data[$key] = $rawData[$key];

            continue;
        }

        if (isset($defaults[$key])) {
            $data[$key] = $defaults[$key];
        }
    }

    return $data;
}

function db_prepare_vars($columnCount)
{
    return rtrim(str_repeat('?,', $columnCount), ',');
}

function json_output($data)
{
    header('Content-Type: application/json');

    echo json_encode($data, JSON_PRETTY_PRINT);

    exit;
}

function now()
{
    return date('Y-m-d H:i:s');
}

function session_get($key, $default = null)
{
    if (isset($_SESSION[$key])) {
        return $_SESSION[$key];
    }

    return $default;
}

function session_put($key, $value)
{
    $_SESSION[$key] = $value;
}

function session_remove($key)
{
    unset($_SESSION[$key]);
}

function login_account($account)
{
    session_put('_current_account', $account['id']);
}

function logout_account()
{
    session_remove('_current_account');
}

function account()
{
    if ($id = session_get('_current_account')) {
        $statement = db()->prepare('SELECT * FROM accounts WHERE id = ?');
        $statement->execute([$id]);

        return $statement->fetch();
    }

    return false;
}
