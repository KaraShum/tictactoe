<?php
session_start();

/**
 * index.php
 * 
 * Starting point of the Program
 * 
 * @author Kevin
 * https://github.com/KaraShum/tictactoe
 */
define('BASEPATH', realpath(dirname(__FILE__)));
require_once(BASEPATH . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');

if (isset($_POST['reset']) && isset($_SESSION['TicTacToe'])) {
    $ttt = unserialize($_SESSION['TicTacToe']);

    $ttt->resetGame();

    $_SESSION['TicTacToe'] = serialize($ttt);
} elseif (!isset($_SESSION['TicTacToe'])) {
    $ttt = new TicTacToe('Spieler 1', 'Spieler 2');

    $_SESSION['TicTacToe'] = serialize($ttt);
} else {
    $ttt = unserialize($_SESSION['TicTacToe']);
    $ttt->updateBoard();
    $ttt->checkWin();
    var_dump($_GET);
    $_SESSION['TicTacToe'] = serialize($ttt);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Tic-Tac-Toe. This is the title. It is displayed in the titlebar of the window in most browsers.</title>
    <meta name="description" content="Tic-Tac-Toe-Game. Here is a short description for the page. This text is displayed e. g. in search engine result listings.">
    <style>
        body {
            background-color: #424242;
            color: white;
        }

        #container {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        table.tic td {
            border: 1px solid #333;
            /* grey cell borders */
            width: 8rem;
            height: 8rem;
            vertical-align: middle;
            text-align: center;
            font-size: 4rem;
            font-family: Arial;
        }

        table {
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 2rem;

        }

        input.field {
            background-color: #424242;
            border: 0;
            border-color: white;
            color: white;
            /* make the value invisible (white) */
            height: 8rem;
            width: 8rem !important;
            font-family: Arial;
            font-size: 4rem;
            font-weight: normal;
            cursor: pointer;
        }

        input.field:hover {
            border: 0;
            color: #c81657;
            /* red on hover */
        }

        .colorX {
            color: #e77;
        }

        /* X is light red */
        .colorO {
            color: #77e;
        }

        /* O is light blue */
        table.tic {
            border-collapse: collapse;
        }

        .resetGame {
            box-shadow: inset 0px 1px 0px 0px #54a3f7;
            background: linear-gradient(to bottom, #007dc1 5%, #0061a7 100%);
            background-color: #007dc1;
            border-radius: 3px;
            border: 1px solid #124d77;
            display: inline-block;
            margin-left: 45%;
            cursor: pointer;
            color: #ffffff;
            font-family: Arial;
            font-size: 13px;
            padding: 6px 24px;
            text-decoration: none;
            text-shadow: 0px 1px 0px #154682;
        }

        .resetGame:hover {
            background: linear-gradient(to bottom, #0061a7 5%, #007dc1 100%);
            background-color: #0061a7;
        }

        .resetGame:active {
            position: relative;
            top: 1px;
        }
    </style>
</head>

<body>
    <div id="container">
        <div id="content">
            <section>
                <h1>Tic-Tac-Toe</h1>
                <article>
                    <h2>Your free browsergame!</h2>
                    <p>Two players play on a 3 by 3 square. One Player places X and the other places O.
                        If one player gets 3 in a row, column or diagonally he/she wins. If no winner is found
                        the game ends in a draw.
                    </p>
                    <form method="get" action="index.php">
                        <table class="tic">
                            <?php
                            $ttt->draw();
                            ?>
                        </table>
                    </form>
                    <form method="post">
                        <input class="resetGame" type="submit" name="reset" value="Neues Spiel" />
                    </form>
                </article>
            </section>
        </div>
    </div>
</body>

</html>