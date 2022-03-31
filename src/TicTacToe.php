<?php
class TicTacToe
{

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
    public function __construct($playerName, $playerName2)
    {
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
    public function setCurrentPlayer()
    {
        foreach ($this->allPlayers as $player) {
            $player->setOnTurn(!$player->isOnTurn());
            if ($player->isOnTurn() === true) {
                $this->currentPlayer = $player;
            }
        }
    }

    /**
     * Added on 24.03.2022
     * Updates the board Array to the new state
     * @return void
     */
    public function updateBoard()
    {
        $board = $this->board->getBoardArray();
        $length = count($board) - 1;
        $token = $this->currentPlayer->getTokenSymbol();

        for ($i = 0; $i <= $length; $i++) {
            for ($j = 0; $j <= $length; $j++) {
                if (isset($_GET['cell-' . $i . '-' . $j]) && $board[$i][$j] == "") {
                    $board[$i][$j] = $token;
                    $this->board->setBoardArray($board);
                }
            }
        }
    }

    /**
     * Check if someone has won
     * @return void
     */
    public function checkWin()
    {
        $countHorizontal = 0;
        $countVertical = 0;
        $countDiagonalTopBottom = 0;
        $countDiagonalBottomTop = 0;
        $countDraw = 0;
        $board = $this->board->getBoardArray();
        $length = count($board) - 1;
        $token = $this->currentPlayer->getTokenSymbol();

        // check horizontal
        for ($i = 0; $i <= $length; $i++) {
            if ($countHorizontal === 3) {
                break;
            } else {
                $countHorizontal = 0;
            }
            for ($j = 0; $j <= $length; $j++) {
                if ($board[$i][$j] === $token) {

                    $countHorizontal++;
                }
            }
        }

        // check vertical
        for ($i = 0; $i <= $length; $i++) {
            if ($countVertical === 3) {
                break;
            } else {
                $countVertical = 0;
            }
            for ($j = 0; $j <= $length; $j++) {
                if ($board[$j][$i] === $token) {
                    $countVertical++;
                }
            }
        }

        // check diagonal top-left to bottom-right
        for ($i = 0; $i <= $length; $i++) {
            if ($board[$i][$i] === $token) {
                $countDiagonalTopBottom++;
            }
        }

        // check diagonal bottom-left to top-right
        for ($i = 0; $i <= $length; $i++) {
            $j = $length - $i;
            if ($board[$j][$i] === $token) {
                $countDiagonalBottomTop++;
            }
        }

        // check draw
        for ($i = 0; $i <= $length; $i++) {
            for ($j = 0; $j <= $length; $j++) {
                if ($board[$j][$i] != "") {
                    $countDraw++;
                }
            }
        }

        if (
            $countHorizontal === 3 || $countVertical === 3
            || $countDiagonalTopBottom === 3 || $countDiagonalBottomTop === 3
        ) {
            $this->announceWinner();
        } elseif ($countDraw === 9) {
            $this->announceDraw();
        } else {
            $this->setCurrentPlayer();
        }
    }

    /**
     * Announce the Winners name
     * @return void
     */
    private function announceWinner()
    {
        $playerName = $this->currentPlayer->getName();
        echo '<div id="container">
        <h1>' . $playerName . ' hat gewonnen! </h1>
        </div>';
    }

    /**
     * Added on 31.03.2022 to better split program functionality and seperate different methods
     * Makes an announcement if the game ends in a draw
     * @return void
     */
    private function announceDraw()
    {
        echo '<div id="container">
        <h1> Das Spiel endet in einem Unentschieden! </h1>
        </div>';
    }

    /**
     * Added on 30.03.2022 to reset the Game state do default values
     * Resets the board to empty values
     * @return void
     */
    public function resetGame()
    {
        $board = $this->board->getBoardArray();
        $length = count($board) - 1;

        for ($i = 0; $i <= $length; $i++) {
            for ($j = 0; $j <= $length; $j++) {

                $board[$i][$j] = "";
                $this->board->setBoardArray($board);
            }
        }
    }

    /**
     * Start the game
     * @return void
     * changed name from initGame to draw to better reflect its functionality on 29.03.2022
     */
    public function draw()
    {
        $token = $this->currentPlayer->getTokenSymbol();
        $board = $this->board->getBoardArray();
        $length = count($board) - 1;

        $output = "";
        for ($i = 0; $i <= $length; $i++) {
            $output .= '<tr>';
            for ($j = 0; $j <= $length; $j++) {
                if ($board[$i][$j] != "") {
                    $output .= '<td><span class="color' . $board[$i][$j] . '">' . $board[$i][$j] . '</span></td>';
                } else {
                    $output .= '<td><input type="submit" class="reset field" name="cell-' . $i . '-' . $j . '" value="' . $token . '" /></td>';
                }
            }
            $output .= '</tr>';
        }

        // Todo Logic
        echo $output;
    }
}
