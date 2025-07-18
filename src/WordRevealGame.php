<?php

class WordRevealGame
{
    private string $word;
    private array $guessedLetters = [];
    private int $wrongGuesses = 0;
    private int $maxWrong = 6;

    public function __construct(string $word)
    {
        $this->word = strtoupper($word);
    }

    public function guess(string $letter): void
    {
        $letter = strtoupper($letter);
        if (in_array($letter, $this->guessedLetters)) return;

        $this->guessedLetters[] = $letter;

        if (strpos($this->word, $letter) === false) {
            $this->wrongGuesses++;
        }
    }

    public function getRevealed(): string
    {
        $output = '';
        foreach (str_split($this->word) as $char) {
            $output .= in_array($char, $this->guessedLetters) ? $char : '_';
        }
        return $output;
    }

    public function isWon(): bool
    {
        return strpos($this->getRevealed(), '_') === false;
    }

    public function isLost(): bool
    {
        return $this->wrongGuesses >= $this->maxWrong;
    }
}
