<form method="post" action="index.php">
    <input type="number" placeholder="Größe" step="1" name="boardSize">
    <input type="text" placeholder="Spieler 1" name="name">
    <input type="text" placeholder="Spieler 2" name="name2">
    <input type="text" placeholder="Symbol 1" name="token">
    <input type="text" placeholder="Symbol 2" name="token2">
    <input type="submit" value="Senden">
</from>

<?php
    session_start();
    if(isset($_POST["boardSize"])){
        require_once 'bin/output.php';
        require_once 'classes/Board.php';
        require_once 'classes/Player.php';
        require_once 'classes/TicTacToe.php';
        $_SESSION['boardSize'] = $_POST["boardSize"];
        $_SESSION['player1'] = $_POST["name"];
        $_SESSION['player2'] = $_POST["name2"];
        $_SESSION['tokenPlayer1'] = $_POST["token"];
        $_SESSION['tokenPlayer2'] = $_POST["token2"];
        $ttt = new TicTacToe($_POST["name"], $_POST["name2"], $_POST["boardSize"], $_POST["token"], $_POST["token2"]);
        // var_dump($ttt);        
        var_dump($_SESSION);
    }
?>

