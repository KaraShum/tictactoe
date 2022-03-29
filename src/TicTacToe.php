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
    public function __construct($playerName,$playerName2){
        $this->allPlayers[0] = new Player($playerName);
        $this->allPlayers[0]->setTokenSymbol("X");
        $this->allPlayers[0]->setOnTurn(true);
        $this->currentPlayer = $this->allPlayers[0];

        $this->allPlayers[1] = new Player($playerName2);
        $this->allPlayers[1]->setTokenSymbol("O");

        $this->board = new Board(3);
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
                if(isset($_GET['cell-'.$i.'-'.$j]) && $board[$i][$j] == "") {
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

        // check horizontal
        for($i = 0; $i <= $length; $i++){
            $tempCount = 0;
            for($j = 0; $j <= $length; $j++){
                if(isset($_GET['cell-'.$i.'-'.$j]) && $_GET['cell-'.$i.'-'.$j] == $token){
                    $tempCount++;
                }
            }
        }

        // check vertical
                for($i = 0; $i <= $length; $i++){
                    $tempCount = 0;
                    for($j = 0; $j <= $length; $j++){
                        if(isset($_GET['cell-'.$j.'-'.$i]) && $_GET['cell-'.$j.'-'.$i] == $token){
                            $tempCount++;
                        }
                    }
                }

        // check diagonal top-left to bottom-right
        for ($i = 0; $i <= $length; $i ++) {
            if(isset($_GET['cell-'.$i.'-'.$i]) && $_GET['cell-'.$i.'-'.$i] == $token){
                $tempCount++;
            }
        }

        // check diagonal bottom-left to top-right
        for ($i = 0; $i < $length; $i++) {
            $j = ($length - 1) - $i;
            if(isset($_GET['cell-'.$i.'-'.$j]) && $_GET['cell-'.$i.'-'.$j] == $token){
                $tempCount++;
            }
        }

        var_dump($board);

        if ($tempCount === 3)  {
            $this->announceWinner();
        } else {
            $this->setCurrentPlayer();
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
     * changed name to draw on 29.03.2022
     */
    public function draw(){
        $token = $this->currentPlayer->getTokenSymbol();
        $board = $this->board->getBoardArray();
        $length = count($board) - 1; 

        $output = "";
        for($i = 0; $i <= $length; $i++){
            $output .= '<tr>';
            for($j = 0; $j <= $length; $j++){
                if ($board[$i][$j] != "") {
                    $output .= '<td><span class="color'.$board[$i][$j].'">'.$board[$i][$j].'</span></td>';
                } else {
                    $output .= '<td><input type="submit" class="reset field" name="cell-'.$i.'-'.$j.'" value="'.$token.'" /></td>';    
                }
            }
            $output .= '</tr>';
        }

        // Todo Logic
       echo $output;
    }

}
?>