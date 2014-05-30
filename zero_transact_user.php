<?php
// (c)Perez Karjee(www.aas9.in)
// Project Site www.aas9.in/zerocms
// Created March 2014
require_once 'db.kate.php';
require_once 'zero_http_functions.kate.php';

$dbx = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) or
    die ('Unable to connect. Check your connection parameters.');

mysql_select_db(MYSQL_DB, $dbx) or die(mysql_error($dbx));

if (isset($_REQUEST['action'])) {

    switch ($_REQUEST['action']) {
    case 'Login':
        $email = (isset($_POST['email'])) ? $_POST['email'] : '';
        $password = (isset($_POST['password'])) ? $_POST['password'] : '';
        $sql = 'SELECT
                user_id, access_level, name
            FROM
                zero_users
            WHERE
                email = "' . mysql_real_escape_string($email, $dbx) . '" AND
                password = PASSWORD("' . mysql_real_escape_string($password,
                    $dbx) . '")';
        $result = mysql_query($sql, $dbx) or die(mysql_error($dbx));
        if (mysql_num_rows($result) > 0) {
            $row = mysql_fetch_array($result);
            extract($row);
            session_start();
            $_SESSION['user_id'] = $user_id;
            $_SESSION['access_level'] = $access_level;
            $_SESSION['name'] = $name;
        }
        mysql_free_result($result);
        redirect('index.php');
        break;

    case 'Logout':
        session_start();
        session_unset();
        session_destroy();
        redirect('index.php');
        break;

    case 'Create Account':
        $name = (isset($_POST['name'])) ? $_POST['name'] : '';
        $email = (isset($_POST['email'])) ? $_POST['email'] : '';
        $password_1 = (isset($_POST['password_1'])) ? $_POST['password_1'] : '';
        $password_2 = (isset($_POST['password_2'])) ? $_POST['password_2'] : '';
        $password = ($password_1 == $password_2) ? $password_1 : '';
        if (!empty($name) && !empty($email) && !empty($password)) {
            $sql = 'INSERT INTO zero_users
                    (email, password, name)
                VALUES
                ("' . mysql_real_escape_string($email, $dbx) . '",
                PASSWORD("' . mysql_real_escape_string($password, $dbx) . '"), 
                "' . mysql_real_escape_string($name, $dbx) . '")';
            mysql_query($sql, $dbx) or die(mysql_error($dbx));

            session_start();
            $_SESSION['user_id'] = mysql_insert_id($dbx);
            $_SESSION['access_level'] = 1;
            $_SESSION['name'] = $name;
        }
        redirect('index.php');
        break;

    case 'Modify Account':
        $user_id = (isset($_POST['user_id'])) ? $_POST['user_id'] : '';
        $email = (isset($_POST['email'])) ? $_POST['email'] : '';
        $name = (isset($_POST['name'])) ? $_POST['name'] : '';
        $access_level = (isset($_POST['access_level'])) ? $_POST['access_level']
            : '';
        if (!empty($user_id) && !empty($name) && !empty($email) &&
            !empty($access_level) && !empty($user_id)) {
            $sql = 'UPDATE `zero_users` SET
                    email = "' . mysql_real_escape_string($email, $dbx) . '",
                    name = "' . mysql_real_escape_string($name, $dbx) . '",
                    access_level = "' . mysql_real_escape_string($access_level, $dbx) . '"
                WHERE
                    user_id = ' . $user_id;
                 
      	
                    
            mysql_query($sql, $dbx) or die(mysql_error($dbx));
        }
        redirect('zero_admin.php');
        break;

    case 'Recover Password':
        $email = (isset($_POST['email'])) ? $_POST['email'] : '';
        if (!empty($email)) {
            $sql = 'SELECT email FROM zero_users WHERE email="' .
                mysql_real_escape_string($email, $dbx) . '"';
            $result = mysql_query($sql, $dbx) or die(mysql_error($dbx));
            if (mysql_num_rows($result) > 0) {
                $password = strtoupper(substr(sha1(time()), rand(0, 32), 8));
                $subject = 'Comic site password reset';
                $body = 'Forgot your password? we will send you a new one. ' . 
                    'We\'ve reset it for you!' . "\n\n";
                $body .= 'Your new password is: ' . $password;
                mail($email, $subject, $body);
            }
            mysql_free_result($result);
        }
        redirect('zero_login.php');
        break;

    case 'Change my info':
        session_start();
        $email = (isset($_POST['email'])) ? $_POST['email'] : '';
        $name = (isset($_POST['name'])) ? $_POST['name'] : '';
        if (!empty($name) && !empty($email) && !empty($_SESSION['user_id']))
        {
            $sql = 'UPDATE zero_users SET
                    email = "' . mysql_real_escape_string($email, $dbx) . '",
                    name = "' . mysql_real_escape_string($name, $dbx) . '"
                WHERE
                    user_id = ' . $_SESSION['user_id'];
            mysql_query($sql, $dbx) or die(mysql_error($dbx));
        }
        redirect('zero_cpanel.php');
        break;
    default:
        redirect('index.php');
    }
} else {
    redirect('index.php');
}
?>
