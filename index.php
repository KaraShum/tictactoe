<?php
session_start();
if (!isset($_SESSION["TicTacToe"])) {
?>
    <form method="get" action="index.php">
        <input type="text" placeholder="Spieler 1" name="name">
        <input type="text" placeholder="Spieler 2" name="name2">
        <input type="submit" value="Senden">
    </form>
<?php
}
require_once 'src/Board.php';
require_once 'src/Player.php';
require_once 'src/TicTacToe.php';

if (isset($_GET['reset'])) {
    $ttt = unserialize($_SESSION["TicTacToe"]);

    $ttt->resetGame();


    $_SESSION["TicTacToe"] = serialize($ttt);
} elseif (!isset($_SESSION["TicTacToe"])) {
    $ttt = new TicTacToe($_GET["name"], $_GET["name2"]);


    $_SESSION["TicTacToe"] = serialize($ttt);
} else {
    $ttt = unserialize($_SESSION["TicTacToe"]);
    $ttt->updateBoard();
    $ttt->checkWin();



    $_SESSION["TicTacToe"] = serialize($ttt);
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
            background-color: #01579B;
            color: white;
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
            border: 0;
            background-color: #01579B;
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
    </style>
</head>

<body>
    <section>
        <h1>Tic-Tac-Toe</h1>
        <article id="mainContent">
            <h2>Your free browsergame!</h2>
            <p>Type your game instructions here...</p>
            <form method="get" action="index.php">
                <table class="tic">
                    <?php
                    $ttt->draw();
                    ?>
                </table>
                <input type="submit" name="reset" value="Neues Spiel" />
            </form>
        </article>
    </section>
</body>

</html>