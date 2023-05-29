<?php

namespace app\src;

class Rules
{
    public function validateStartMoves(array $moves): array|string
    {
        if (empty($moves)) {
            $help = "For example:\n php index.php  rock paper scissors lizard spock";
            return "You have not entered any options! \n $help";
        } elseif (count($moves) < 3) {
            return "You must enter 3 or more options!";
        } elseif (count($moves) % 2 == 0) {
            return "You must enter only odd number of options!";
        } elseif (count(array_unique($moves)) < count($moves)) {
            return "All options should be unique!";
        }
        return $moves;
    }

    public function validateUserChoice(int|string $choice): int|string
    {
        if ($choice == "") {
            return "Make any choice!";
        }
        return $choice;
    }

    public function detectWinner(string $user_move, string $computer_move): string
    {
        $user_move = strtolower($user_move);
        $computer_move = strtolower($computer_move);
        if ($user_move == $computer_move) {
            $message = "Draw! \n";
        } elseif ($user_move == "rock" && $computer_move == "scissors" || $user_move == "rock" && $computer_move == "lizard") {
            $message = "You win! \n";
        } elseif ($user_move == "paper" && $computer_move == "rock" || $user_move == "paper" && $computer_move == "spock") {
            $message = "You win! \n";
        } elseif ($user_move == "scissors" && $computer_move == "paper" || $user_move == "scissors" && $computer_move == "spock") {
            $message = "You win! \n";
        } elseif ($user_move == "lizard" && $computer_move == "paper" || $user_move == "lizard" && $computer_move == "spock") {
            $message = "You win! \n";
        } elseif ($user_move == "spock" && $computer_move == "scissors" || $user_move == "spock" && $computer_move == "rock") {
            $message = "You win! \n";
        } else {
            $message = "Computer win! \n";
        }

        return $message;
    }
}