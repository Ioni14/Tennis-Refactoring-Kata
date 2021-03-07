<?php

namespace TennisGame;

class TennisGame2 implements TennisGame
{
    private int $p1point = 0;
    private int $p2point = 0;

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
        if ($this->p1point === $this->p2point) {
            return $this->getSameScoreQualifier();
        }

        if ($this->hasPlayer1Won()) {
            return 'Win for ' . $this->player1Name;
        }

        if ($this->hasPlayer2Won()) {
            return 'Win for ' . $this->player2Name;
        }

        if ($this->hasPlayer1Advantage()) {
            return 'Advantage ' . $this->player1Name;
        }

        if ($this->hasPlayer2Advantage()) {
            return 'Advantage ' . $this->player2Name;
        }

        $p1res = $this->computeResultPlayerLessThanFour($this->p1point);
        $p2res = $this->computeResultPlayerLessThanFour($this->p2point);

        return "{$p1res}-{$p2res}";
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

    protected function getSameScoreQualifier(): string
    {
        return match ($this->p1point) {
            0 => 'Love-All',
            1 => 'Fifteen-All',
            2 => 'Thirty-All',
            default => 'Deuce',
        };
    }

    protected function computeResultPlayerLessThanFour($point): string
    {
        return match ($point) {
            0 => 'Love',
            1 => 'Fifteen',
            2 => 'Thirty',
            3 => 'Forty',
            default => '',
        };
    }
}
