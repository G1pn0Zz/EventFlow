<?php
    if (!empty($_POST)) {
        $current_email = $_POST['username'];
        $current_password = $_POST['password'];        
        if ($link = mysqli_connect('localhost', 'root', '', `eventflow`)) {            
            mysqli_query($link, 'USE `eventflow`;');
            if ($result = mysqli_fetch_assoc(mysqli_query($link, $mysql))) {
                $customer_id = $result['customer_id'];
                $customer_fullname = $result['firstname'] . ' ' . $result['lastname'];
                setcookie('customer_id', $customer_id, time() + 600);
                setcookie('customer_fullname', $customer_fullname, time() + 600);
                header ('Location: index.php');
                die;
            };
        }
        header ('Location: login.php');
    }
