<?php

class TicTacToe {

    private $currentPlayer;     //Active Player (Object)
    private $board;             //Board object
    private $allPlayers;        //All Player objects

    /**
     * Construct the TicTacToe object
     * @param string $playerName
     * @param string $playerName2
     * @param int $boardSize
     * @param string $tokenValue
     * @param string $tokenValue2
     * @return void
     * $playerName2, $tokenValue2, $tokenValue changed on 17.03.2022
     */
    public function __construct($playerName,$playerName2, $boardSize, $tokenValue, $tokenValue2){
        $this->allPlayers[0] = new Player($playerName);
        $this->allPlayers[0]->setTokenSymbol($tokenValue);
        $this->allPlayers[0]->setOnTurn(true);
        $this->currentPlayer = $this->allPlayers[0];

        $this->allPlayers[1] = new Player($playerName2);
        $this->allPlayers[1]->setTokenSymbol($tokenValue2);

        $this->board = new Board($boardSize);
    }

    /**
     * Set the active Player
     * @return void
     */
    public function setCurrentPlayer(){
        foreach ($this->allPlayers as $player) {
            $player->setOnTurn(!$player->isOnTurn());
            if($player->isOnTurn() === true){
                $this->currentPlayer = $player;
            }
        }
    }

    /**
     * Added on 24.03.2022
     * Updates the board Array to the new state
     * @return void
     */
    public function updateBoard() {
        $board = $this->board->getBoardArray();
        $length = count($board) - 1; 
        $token = $this->currentPlayer->getTokenSymbol();

        for($i = 0; $i <= $length; $i++){
            for($j = 0; $j <= $length; $j++){
                if(isset($_GET['cell-'.$i.'-'.$j])){
                    $board[$i][$j] = $token;
                    $this->board->setBoardArray($board);
                }
            }
        }
        var_dump($board);
    }

    /**
     * Check if someone has won
     * @return void
     */
    public function checkWin(){
        $tempCount = 0;
        $board = $this->board->getBoardArray();
        $length = count($board) - 1; 
        $token = $this->currentPlayer->getTokenSymbol();

        for($i = 0; $i <= $length; $i++){
            for($j = 0; $j <= $length; $j++){
                if(isset($_GET['cell-'.$i.'-'.$j])){
                    $board[$i][$j] = $token;
                    $this->board->setBoardArray($board);
                    // $tempCount++;
                }
            }
        }
        var_dump($board);

        if ($tempCount === 3)  {
            $this->setCurrentPlayer();
        } else {
            $this->announceWinner();
        }
    }

    /**
     * Announce the Winner name
     * @return void
     */
    private function announceWinner(){
        // Todo Logic
    }

    /**
     * Start the game
     * @return void
     */
    private function initGame(){
        // Todo Logic
    }

}

?>