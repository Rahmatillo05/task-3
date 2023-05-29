<?php

namespace app\src;

use Laminas\Text\Table\Decorator\Ascii;
use MathieuViossat\Util\ArrayToTextTable;

class Help
{
    public function generateTable(): string
    {
        $table = new ArrayToTextTable($this->data());
        $table->setDisplayKeys(false);
        $table->setIndentation("\t");
        $table->setDecorator(new Ascii());
        return $table->getTable();
    }

    protected function data(): array
    {
        return [
            [
                "v PC\User >",
                "Rock",
                "Paper",
                "Scissors"
            ],
            [
                "Rock",
                "Draw",
                "Win",
                "Lose"
            ],
            [
                "Paper",
                "Lose",
                "Draw",
                "Win"
            ],
            [
                "Scissors",
                "Win",
                "Lose",
                "Draw",
            ],

        ];
    }
}