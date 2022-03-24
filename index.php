<?php
session_start();

if(!isset($_SESSION["TicTacToe"])) { 
?>
<form method="get" action="index.php">
    <input type="number" step="1" name="boardSize">
    <input type="text" name="name">
    <input type="text" name="name2">
    <input type="text" name="token">
    <input type="text" name="token2">
    <input type="submit" value="Senden">
</form>
<?php
}
define ('BASEPATH', realpath(dirname(__FILE__)));
require_once (BASEPATH.DIRECTORY_SEPARATOR.'vendor' .DIRECTORY_SEPARATOR.'autoload.php');
//require_once 'bin/output.php';
//require_once 'classes/Board.php';
//require_once 'classes/Player.php';
//require_once 'classes/TicTacToe.php';

    if(empty($_SESSION["TicTacToe"]) && isset($_GET['boardSize'])) {
        $ttt = new TicTacToe($_GET["name"], $_GET["name2"], $_GET["boardSize"], $_GET["token"], $_GET["token2"]);
        echo '<pre>';
        var_dump($ttt);
        echo '</pre><br><br>';
    
        $_SESSION["TicTacToe"] = serialize($ttt);

    } else {
        $ttt = unserialize($_SESSION["TicTacToe"]);
        $ttt->updateBoard();
        $ttt->setCurrentPlayer();

        echo '<pre>SESSION AUSGABE <br />';
        var_dump($_SESSION["TicTacToe"]);
        echo '</pre><br><br>';

        $_SESSION = serialize($ttt);
    }
?>

