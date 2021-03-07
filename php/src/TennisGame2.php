<?php

namespace TennisGame;

use Webmozart\Assert\Assert;

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

        if ($this->hasAPlayerWon()) {
            return 'Win for ' . $this->getBestPlayerName();
        }

        if ($this->hasAPlayerAdvantage()) {
            return 'Advantage ' . $this->getBestPlayerName();
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

    private function getBestPlayerName(): string
    {
        return $this->p1point > $this->p2point
            ? $this->player1Name
            : $this->player2Name;
    }

    private function hasAPlayerWon(): bool
    {
        return ($this->p1point >= 4 || $this->p2point >= 4) && abs($this->p1point - $this->p2point) >= 2;
    }

    private function hasAPlayerAdvantage(): bool
    {
        return ($this->p1point > $this->p2point && $this->p2point >= 3)
            || ($this->p2point > $this->p1point && $this->p1point >= 3);
    }
}
