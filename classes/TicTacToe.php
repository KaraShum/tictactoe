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
     * $playerName2, $tokenValue2, $tokenValue Changed on 17.03.2022
     */
    public function __construct($playerName,$playerName2, $boardSize, $tokenValue, $tokenValue2){
        $this->allPlayers[0] = new Player($playerName);
        $this->allPlayers[1] = new Player($playerName2);
        $this->allPlayers[0]->setTokenSymbol($tokenValue);
        $this->allPlayers[1]->setTokenSymbol($tokenValue2);
    }

    /**
     * Set the active Player
     * @return void
     */
    private function setCurrentPlayer(){

    }

    /**
     * Check if someone has won
     * @return void
     */
    private function checkWin(){

    }

    /**
     * Announce the Winner name
     * @return void
     */
    private function announceWinner(){

    }

    /**
     * Start the game
     * @return void
     */
    private function initGame(){

    }

}

?>