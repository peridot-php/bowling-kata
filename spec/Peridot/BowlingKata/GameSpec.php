<?php
namespace spec\Peridot\BowlingKata;

use PhpSpec\ObjectBehavior;

class GameSpec extends ObjectBehavior
{
    function it_should_result_in_a_score_of_0_for_a_gutter_game()
    {
        $this->rollMany(20, 0);

        $this->score()->shouldBe(0);
    }

    function it_should_result_in_the_sum_of_all_frames_when_rolling_all_1s()
    {
        $this->rollMany(20, 1);

        $this->score()->shouldBe(20);
    }

    function it_should_add_the_next_ball_rolled_to_that_frames_score_when_rolling_a_spare()
    {
        $this->rollSpare();
        $this->roll(3);
        $this->rollMany(17, 0);

        $this->score()->shouldBe(16);
    }

    function it_should_add_the_next_2_balls_rolled_to_that_frames_score_when_rolling_a_strike()
    {
        $this->rollStrike();
        $this->roll(3);
        $this->roll(4);
        $this->rollMany(16, 0);

        $this->score()->shouldBe(24);
    }

    function it_should_result_in_a_perfect_score_when_rolling_a_perfect_game()
    {
        $this->rollMany(12, 10);

        $this->score()->shouldBe(300);
    }

    function rollMany($n, $pins) 
    {
        for ($i = 0; $i < $n; $i++) {
            $this->roll($pins);
        }
    }

    function rollSpare()
    {
        $this->roll(5);
        $this->roll(5);
    }

    function rollStrike()
    {
        $this->roll(10);
    }
}