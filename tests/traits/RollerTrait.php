<?php
trait RollerTrait
{
    private $game;

    public function rollMany($n, $pins) 
    {
        for ($i = 0; $i < $n; $i++) {
            $this->game->roll($pins);
        }
    }

    public function rollSpare()
    {
        $this->game->roll(5);
        $this->game->roll(5);
    }

    public function rollStrike()
    {
        $this->game->roll(10);
    }
}
