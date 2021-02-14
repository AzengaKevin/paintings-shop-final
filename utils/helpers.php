<?php

/**
 * Dumping a variable for debuging
 * @param mixed a variable to debug
 */
function dd($variable)
{
    echo "<pre class=\"mt-nav p-3 bg-dark text-white\">";
    var_dump($variable);
    echo "</pre>";
    die;
}

/**
 * Clears request errors and old input
 */
function resetPage()
{
    unset($_SESSION['errors']);
    unset($_SESSION['input']);
}

/**
 * Check which page is active
 * 
 * @return boolean to show whether the passed params are similar
 */
function requestUriIs($page, $uri)
{
    if ($uri === '/') {
        return true;
    }

    return $page === str_replace('/', '', $uri);
}

/**
 * Check if user is logged in using the user session key
 * 
 * @return boolean true if logged in else false
 */
function isLoggedIn()
{
    return array_key_exists('user', $_SESSION);
}

/**
 * Counts the number of items in the session cart 
 * 
 * @return int cart items count or 0
 */
function cartCount()
{
    return isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
}

/**
 * Generates a random string
 * 
 * @param int length of the string to be generated
 * 
 * @return string a genererated name
 */
function randomString(int $howMany = 16)
{
    $alphanumerics = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz';

    return substr(str_shuffle($alphanumerics), 0, $howMany);
}

function storageLink()
{
    symlink(__DIR__ . '/../uploads', __DIR__ . '/../public/uploads');
}