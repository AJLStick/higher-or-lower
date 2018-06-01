<?php

/**
 * Higher or lower
 *
 * PHP version 5
 *
 * @category TBD
 * @package  None
 * @author   Jon Crump <jcrump@outlook.com>
 * @license  http://element121.com Open Source
 * @version  GIT: 0.0.1
 * @link     http://element121.com
 */

session_start();

if (!isset($_SESSION['number'])) {
    if (isset($_POST['cboLimits'])) {
        if (intval($_POST['cboLimits']) === 1) {
            $number = rand(0, 100);
        }

        if (intval($_POST['cboLimits']) === 2) {
            $number = rand(0, 200);
        }

        $_SESSION['number'] = $number;
    }

    unset($_SESSION['guesses']);
    $_SESSION['guesses'] = array();
} else {
    if (isset($_POST['guess'])) {
        $guess = intval($_POST['guess']);

        $message = "";

        array_push($_SESSION['guesses'], $guess);


        if ($guess > $_SESSION['number']) {
            $message = "Lower!";
        }
        if ($guess < $_SESSION['number']) {
            $message = "Higher!";
        }
        if ($guess === $_SESSION['number']) {
            $message = "Congrats you got it in ". count($_SESSION['guesses']) ." guesses<br><br>Play again?";
            unset($_SESSION['number']);

            if (!isset($_SESSION['scoreboard'])) {
                $_SESSION['scoreboard'] = array();
            } else {
                array_push($_SESSION['scoreboard'], count($_SESSION['guesses']));
            }

        }

    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Higher or Lower?</title>

    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container"><br>
    <div class="jumbotron">
        <h1>Higher or Lower?</h1>
        <?php
        if (isset($message)) {
            echo "<br>". $message;
        }

        if (!isset($_SESSION['number'])) {
            ?>
            <form action="higher-or-lower.php" method="post">
                <select name="cboLimits" required>
                    <option value="1">0 - 100</option>
                    <option value="2">0 - 200</option>
                </select>
                <input type="submit" value='Start' name="cmdStart" class="btn btn-primary">
            </form>
            <?php
        } else {
            ?>
            <form action="higher-or-lower.php" method="post">
                <input type="number" required name="guess">
                <input type="submit" value='Guess' class="btn btn-primary">
            </form>
            <?php
        }
        ?>
    </div></div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
