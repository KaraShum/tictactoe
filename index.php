<form method="post" action="index.php">
    <input type="number" step="1" name="boardSize">
    <input type="text" name="name">
    <input type="text" name="name2">
    <input type="text" name="token">
    <input type="text" name="token2">
    <input type="submit" value="Senden">
</from>

<?php
    if(isset($_POST["boardSize"])){
        require_once 'bin/output.php';
        require_once 'classes/Board.php';
        require_once 'classes/Player.php';
        require_once 'classes/TicTacToe.php';
        $ttt = new TicTacToe($_POST["name"], $_POST["name2"], $_POST["boardSize"], $_POST["token"], $_POST["token2"]);
        var_dump($ttt);
    }
?>

