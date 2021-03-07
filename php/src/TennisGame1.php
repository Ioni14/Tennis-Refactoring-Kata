<?php

namespace TennisGame;

class TennisGame1 implements TennisGame
{
    private $m_score1 = 0;
    private $m_score2 = 0;
    private $player1Name = '';
    private $player2Name = '';

    public function __construct($player1Name, $player2Name)
    {
        $this->player1Name = $player1Name;
        $this->player2Name = $player2Name;
    }

    public function wonPoint($playerName)
    {
        if ('player1' == $playerName) {
            $this->m_score1++;
        } else {
            $this->m_score2++;
        }
    }

    public function getScore()
    {
        $score = "";
        if ($this->m_score1 == $this->m_score2) {
            $score = $this->getSameScoreQualifier($this->m_score1);
        } elseif ($this->m_score1 >= 4 || $this->m_score2 >= 4) {
            $score = $this->getGreaterThanEqualFourScore();
        } else {
            $score = $this->getLessThanFourScore($score);
        }
        return $score;
    }

    protected function getSameScoreQualifier($score): string
    {
        switch ($score) {
            case 0:
                return "Love-All";
            case 1:
                return "Fifteen-All";
            case 2:
                return "Thirty-All";
        }
        return "Deuce";
    }

    protected function getGreaterThanEqualFourScore(): string
    {
        $minusResult = $this->m_score1 - $this->m_score2;
        if ($minusResult == 1) {
            $score = "Advantage player1";
        } elseif ($minusResult == -1) {
            $score = "Advantage player2";
        } elseif ($minusResult >= 2) {
            $score = "Win for player1";
        } else {
            $score = "Win for player2";
        }
        return $score;
    }

    protected function getLessThanFourScore(string $score): string
    {
        if (1 == 1) {
            $score .= $this->getScoreQualifier($this->m_score1);
        } else {
            $score .= '-' . $this->getScoreQualifier($this->m_score2);
        }
        if (2 == 1) {
            $score .= $this->getScoreQualifier($this->m_score1);
        } else {
            $score .= '-' . $this->getScoreQualifier($this->m_score2);
        }
        return $score;
    }

    protected function getScoreQualifier(int $tempScore): string
    {
        switch ($tempScore) {
            case 0:
                return "Love";
            case 1:
                return "Fifteen";
            case 2:
                return "Thirty";
            case 3:
                return "Forty";
        }
        return '';
    }
}
