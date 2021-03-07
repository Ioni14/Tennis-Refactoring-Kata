<?php

namespace TennisGame;

class TennisGame1 implements TennisGame
{
    private int $m_score1 = 0;
    private int $m_score2 = 0;

    public function __construct(
        private string $player1Name,
        private string $player2Name
    ) {
    }

    public function wonPoint($playerName): void
    {
        if ($this->player1Name === $playerName) {
            ++$this->m_score1;
        } else {
            ++$this->m_score2;
        }
    }

    public function getScore(): string
    {
        if ($this->isSameScore()) {
            return $this->getSameScoreQualifier($this->m_score1);
        }
        if ($this->isAtLeastOneScoreGreaterThanEqualFour()) {
            return $this->getGreaterThanEqualFourScore();
        }

        return $this->getLessThanFourScore();
    }

    protected function getSameScoreQualifier($score): string
    {
        return match ($score) {
            0 => 'Love-All',
            1 => 'Fifteen-All',
            2 => 'Thirty-All',
            default => 'Deuce',
        };
    }

    protected function getScoreQualifier(int $score): string
    {
        return match ($score) {
            0 => 'Love',
            1 => 'Fifteen',
            2 => 'Thirty',
            3 => 'Forty',
            default => '',
        };
    }

    protected function getGreaterThanEqualFourScore(): string
    {
        if ($this->hasOnePlayerAdvantage()) {
            return 'Advantage ' . $this->getPlayerHasAdvantage();
        }
        return 'Win for ' . $this->getPlayerHasWon();
    }

    protected function getLessThanFourScore(): string
    {
        return $this->getScoreQualifier($this->m_score1) . '-' . $this->getScoreQualifier($this->m_score2);
    }

    protected function isSameScore(): bool
    {
        return $this->m_score1 === $this->m_score2;
    }

    protected function hasPlayer1Advantage(): bool
    {
        return $this->m_score1 - $this->m_score2 === 1;
    }

    protected function hasPlayer1Won(): bool
    {
        return $this->m_score1 - $this->m_score2 >= 2;
    }

    protected function isAtLeastOneScoreGreaterThanEqualFour(): bool
    {
        return $this->m_score1 >= 4 || $this->m_score2 >= 4;
    }

    protected function getPlayerHasAdvantage(): string
    {
        return $this->hasPlayer1Advantage() ? $this->player1Name : $this->player2Name;
    }

    private function hasOnePlayerAdvantage(): bool
    {
        return abs($this->m_score1 - $this->m_score2) === 1;
    }

    protected function getPlayerHasWon(): string
    {
        return $this->hasPlayer1Won() ? $this->player1Name : $this->player2Name;
    }
}
