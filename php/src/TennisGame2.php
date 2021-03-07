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
        if ($this->p1point === $this->p2point) {
            $score = $this->getSameScoreQualifier();
        }

        if ($this->p1point > $this->p2point) {
            if ($this->p2point === 0) {
                $this->p1res = $this->getResultByPointGreaterThanZero($this->p1point);
                $this->p2res = 'Love';
            }
            if ($this->p1point < 4) {
                $this->computeResultForBestPlayer1LessThanFour();
            }
            $score = "{$this->p1res}-{$this->p2res}";
        }

        if ($this->p2point > $this->p1point) {
            if ($this->p1point === 0) {
                $this->p2res = $this->getResultByPointGreaterThanZero($this->p2point);
                $this->p1res = 'Love';
            }
            if ($this->p2point < 4) {
                $this->computeResultForBestPlayer2LessThanFour();
            }
            $score = "{$this->p1res}-{$this->p2res}";
        }

        if ($this->hasPlayer1Advantage()) {
            $score = 'Advantage ' . $this->player1Name;
        }

        if ($this->hasPlayer2Advantage()) {
            $score = 'Advantage ' . $this->player2Name;
        }

        if ($this->hasPlayer1Won()) {
            $score = 'Win for ' . $this->player1Name;
        }

        if ($this->hasPlayer2Won()) {
            $score = 'Win for ' . $this->player2Name;
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

    protected function hasPlayer1Won(): bool
    {
        return $this->p1point >= 4 && $this->p2point >= 0 && ($this->p1point - $this->p2point) >= 2;
    }

    protected function hasPlayer2Won(): bool
    {
        return $this->p2point >= 4 && $this->p1point >= 0 && ($this->p2point - $this->p1point) >= 2;
    }

    protected function hasPlayer1Advantage(): bool
    {
        return $this->p1point > $this->p2point && $this->p2point >= 3;
    }

    protected function hasPlayer2Advantage(): bool
    {
        return $this->p2point > $this->p1point && $this->p1point >= 3;
    }

    protected function getResultByPointGreaterThanZero($point): string
    {
        return match ($point) {
            1 => 'Fifteen',
            2 => 'Thirty',
            3 => 'Forty',
            default => '',
        };
    }

    protected function computeResultForBestPlayer1LessThanFour(): void
    {
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
    }

    protected function computeResultForBestPlayer2LessThanFour(): void
    {
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
    }

    protected function getSameScoreQualifier(): string
    {
        return match ($this->p1point) {
            0 => 'Love-All',
            1 => 'Fifteen-All',
            2 => 'Thirty-All',
            default => 'Deuce',
        };
    }
}
