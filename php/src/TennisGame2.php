<?php

namespace TennisGame;

class TennisGame2 implements TennisGame
{
    private int $p1point = 0;
    private int $p2point = 0;
    private string $p1res = '';
    private string $p2res = '';

    public function __construct(
        private string $player1Name,
        private string $player2Name,
    ) {
    }

    public function wonPoint($player): void
    {
        if ($player === $this->player1Name) {
            $this->p1Score();
        } else {
            $this->p2Score();
        }
    }

    public function getScore(): string
    {
        $score = '';
        if ($this->p1point === $this->p2point && $this->p1point < 4) {
            if ($this->p1point === 0) {
                $score = 'Love';
            }
            if ($this->p1point === 1) {
                $score = 'Fifteen';
            }
            if ($this->p1point === 2) {
                $score = 'Thirty';
            }
            $score .= '-All';
        }

        if ($this->p1point === $this->p2point && $this->p1point >= 3) {
            $score = 'Deuce';
        }

        if ($this->p1point > 0 && $this->p2point === 0) {
            if ($this->p1point === 1) {
                $this->p1res = 'Fifteen';
            }
            if ($this->p1point === 2) {
                $this->p1res = 'Thirty';
            }
            if ($this->p1point === 3) {
                $this->p1res = 'Forty';
            }

            $this->p2res = 'Love';
            $score = "{$this->p1res}-{$this->p2res}";
        }

        if ($this->p2point > 0 && $this->p1point === 0) {
            if ($this->p2point === 1) {
                $this->p2res = 'Fifteen';
            }
            if ($this->p2point === 2) {
                $this->p2res = 'Thirty';
            }
            if ($this->p2point === 3) {
                $this->p2res = 'Forty';
            }
            $this->p1res = 'Love';
            $score = "{$this->p1res}-{$this->p2res}";
        }

        if ($this->p1point > $this->p2point && $this->p1point < 4) {
            if ($this->p1point === 2) {
                $this->p1res = 'Thirty';
            }
            if ($this->p1point === 3) {
                $this->p1res = 'Forty';
            }
            if ($this->p2point === 1) {
                $this->p2res = 'Fifteen';
            }
            if ($this->p2point === 2) {
                $this->p2res = 'Thirty';
            }
            $score = "{$this->p1res}-{$this->p2res}";
        }

        if ($this->p2point > $this->p1point && $this->p2point < 4) {
            if ($this->p2point === 2) {
                $this->p2res = 'Thirty';
            }
            if ($this->p2point === 3) {
                $this->p2res = 'Forty';
            }
            if ($this->p1point === 1) {
                $this->p1res = 'Fifteen';
            }
            if ($this->p1point === 2) {
                $this->p1res = 'Thirty';
            }
            $score = "{$this->p1res}-{$this->p2res}";
        }

        if ($this->p1point > $this->p2point && $this->p2point >= 3) {
            $score = 'Advantage player1';
        }

        if ($this->p2point > $this->p1point && $this->p1point >= 3) {
            $score = 'Advantage player2';
        }

        if ($this->p1point >= 4 && $this->p2point >= 0 && ($this->p1point - $this->p2point) >= 2) {
            $score = 'Win for player1';
        }

        if ($this->p2point >= 4 && $this->p1point >= 0 && ($this->p2point - $this->p1point) >= 2) {
            $score = 'Win for player2';
        }

        return $score;
    }

    private function p1Score(): void
    {
        ++$this->p1point;
    }

    private function p2Score(): void
    {
        ++$this->p2point;
    }
}
