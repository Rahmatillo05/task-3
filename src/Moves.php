<?php

namespace app\src;

use Exception;

class Moves
{
    public Rules $rules;
    public Help $help;

    protected GenerateHMAC $hmac;
    public array $moves;
    protected string $user_move;
    protected string $computer_move;

    public function __construct()
    {
        $this->rules = new Rules();
        $this->hmac = new GenerateHMAC();
        $this->help = new Help();
        $this->user_move = "";
        $this->computer_move = '';
        $this->moves = [];
    }

    /**
     * @throws Exception
     */
    public function start(): void
    {
        echo $this->getStartMoves();
        if ($this->moves) {
            echo $this->getUserChoice();
        }
        if ($this->user_move && $this->computer_move) {
            echo $this->detectWinner();
        }
    }

    /**
     * @throws Exception
     */
    protected function getStartMoves(): array|string
    {
        global $argv;
        $moves = $this->rules->validateStartMoves(array_slice($argv, 1));
        if (is_string($moves)) {
            return $moves;
        }
        $this->moves = $moves;
        return $this->displayedMoves($moves);
    }

    /**
     * @throws Exception
     */
    protected function displayedMoves(array $moves): string
    {
        $message = "HMAC: " . $this->hmac->setHMAC($this->getRandomChoice($moves));
        $message .= "\nAvailable moves: \n";
        foreach ($moves as $key => $value) {
            $key += 1;
            $message .= "$key - $value \n";
        }
        $message .= "0 - exit \n? - help \n";
        return $message;
    }

    public function getUserChoice(): ?string
    {
        echo "Enter your move:";
        $choice = trim(fgetc(STDIN));
        $user_move = $this->rules->validateUserChoice($choice);
        return $this->setUserMove($user_move, $this->moves);
    }

    protected function setUserMove($user_move, array $moves): string
    {
        $computer_choice = $this->getRandomChoice($moves);
        if (strlen($user_move) > 1) {
            return $user_move;
        } elseif ($user_move == '?') {
            return $this->help->generateTable();
        } elseif ($user_move == 0) {
            return "Good Bye ):";
        }
        $user_move -= 1;
        $message = "Your move: $moves[$user_move] \n";
        $message .= "Computer move: $computer_choice \n";
        $this->user_move = $moves[$user_move];
        $this->computer_move = $computer_choice;
        return $message;
    }

    private function getRandomChoice(array $moves)
    {
        $computer_move = rand(0, count($moves) - 1);

        return $moves[$computer_move];
    }

    /**
     * @throws Exception
     */
    private function detectWinner(): string
    {
        $result = $this->rules->detectWinner($this->user_move, $this->computer_move);
        $hmac = $this->hmac->setHMAC($result);

        return "$result HMAC: $hmac";
    }
}