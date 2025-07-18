<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/WordRevealGame.php';

class WordRevealGameTest extends TestCase
{
    public function testInitialRevealIsMasked()
    {
        $game = new WordRevealGame('apple');
        $this->assertEquals('_____', $game->getRevealed());
    }

    public function testCorrectGuessRevealsLetter()
    {
        $game = new WordRevealGame('apple');
        $game->guess('a');
        $this->assertEquals('A____', $game->getRevealed());
    }

    public function testIncorrectGuessIncreasesWrongCount()
    {
        $game = new WordRevealGame('banana');
        $game->guess('x');
        $this->assertTrue($game->isLost() === false);
    }

    public function testWinCondition()
    {
        $game = new WordRevealGame('cat');
        foreach (['c', 'a', 't'] as $letter) {
            $game->guess($letter);
        }
        $this->assertTrue($game->isWon());
    }

    public function testLossCondition()
    {
        $game = new WordRevealGame('dog');
        foreach (['x', 'y', 'z', 'q', 'w', 'u', 'e'] as $letter) {
            $game->guess($letter);
        }
        $this->assertTrue($game->isLost());
    }

    public function testDuplicateGuessDoesNotCountTwice()
    {
        $game = new WordRevealGame('moon');
        $game->guess('z');
        $game->guess('z'); // repeated wrong guess
        $this->assertFalse($game->isLost()); // should be 1 wrong only
    }
}
