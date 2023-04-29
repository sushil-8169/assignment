<?php



// ------------ Start Session ------------
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ob_start();


// Function 1: isLoggedIn() to check whether the user is logged in or not or redirect to login page
function isLoggedIn()
{
    global $mysqli, $user_browser, $user_os;
    if (isset($_SESSION[AID]) || isset($_COOKIE[AID])) {
        if (isset($_COOKIE[AID]) && !isset($_SESSION[AID])) {
            $_SESSION[AID] = $_COOKIE[AID];
            $_SESSION[NAME] = $_COOKIE[NAME];
            $_SESSION[EMAIL] = $_COOKIE[EMAIL];
        }
        return true;
    } else
        return false;
}

// Function 2: Security function Encrypt() to encrypt a data using MD5 Algorithm
function Encrypt($data)
{
    return md5(md5('SALT') . $data . md5('PAPER'));
}

function secure($data, $isWYSIWYG = false)
{
    global $mysqli;
    if (!is_array($data)) {
        if ($isWYSIWYG) {
            return mysqli_real_escape_string($mysqli, str_replace("<script>", "", str_replace("</script>", "", trim($data))));
        }
        return mysqli_real_escape_string($mysqli, stripslashes(htmlentities(trim($data))));
    } else {
        $cleanArray = array();
        foreach ($data as $s) {
            array_push($cleanArray, mysqli_real_escape_string($mysqli, stripslashes(htmlentities(trim($s)))));
        }
        return $cleanArray;
    }
}

// User consant variable

define("AID", Encrypt("AID"));
define("NAME", Encrypt("NAME"));
define("EMAIL", Encrypt("EMAIL"));
define("ACCESSTOKEN", Encrypt("ACCESSTOKEN"));
define("USER", Encrypt("USER"));


// Function 5: Helper Function redirect() to redirect to a URL using PHP.
function redirect($redirectURL)
{
    header("Location:$redirectURL");
    exit();
}


// Function 7: Flash function gen_log() for setting Flash Data for temporary Messages
function setFlash($name, $value)
{
    $_SESSION[Encrypt("Hertzsoft" . $name)] = $value;
}

// Function 8: Flash function isFlashSet() to check whether Flash Data is set or not
function isFlashSet($name)
{
    return isset($_SESSION[Encrypt("Hertzsoft" . $name)]);
}

// Function 9: Flash function getFlash() to get value of Flash Data.
function getFlash($name)
{
    return isFlashSet($name) ? $_SESSION[Encrypt("Hertzsoft" . $name)] : NULL;
}

// Function 10: Flash function getFlashDelete() for getting Flash Data value and Delete Flash Data
function getFlashDelete($name)
{
    $value = getFlash($name);
    if ($value) {
        unset($_SESSION[Encrypt("Hertzsoft" . $name)]);
    }
    return $value;
}

// Function 11: DateTime function formatDate() to format Date
function formatDate($date)
{
    if (date('Y', strtotime($date)) != '-0001' && $date != NULL)
        return date('d M Y', strtotime($date));
    else
        return '-';
}

// Function 12: DateTime function formatDateTime() to format Date and Time
function formatDateTime($date)
{
    if (date('Y', strtotime($date)) != '-0001' && $date != NULL)
        return date('d M Y - h:i a', strtotime($date));
    else
        return '-';
}

// Function 13: DateTime function formatTime() to format Time
function formatTime($date)
{
    return date('h:i a', strtotime($date));
}

// Function 15: Testing function alert() to show alert popup message
function alert($data)
{
    echo "<script>alert('$data');</script>";
}

// Function 16: Testing function consoleEcho() to print data in console using PHP
function consoleEcho($data, $format = 'log')
{
    echo "<script>console.$format('$data');</script>";
}

// Function 17: Function print_array() to print array
function printArray($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}
