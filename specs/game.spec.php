<?php
use Peridot\BowlingKata\Game;

require_once 'scopes/roller.php';

describe('Game', function () {

    $this->peridotAddChildScope(new Roller());

    beforeEach(function () {
        $this->game = new Game();
        $this->setGame($this->game);
    });

    describe('gutter game', function () {
        it('should result in a score of 0', function () {
            $this->rollMany(20, 0);

            expect($this->game->score())->to->equal(0);
        });
    });

    describe("when rolling all 1's", function () {
        it('should result in the sum of all frames', function () {
            $this->rollMany(20, 1);

            expect($this->game->score())->to->equal(20);
        });
    });

    describe('when rolling 1 spare', function () {
        it("should add the next ball rolled to that frame's score", function () {
            $this->rollSpare();
            $this->game->roll(3);
            $this->rollMany(17, 0);

            expect($this->game->score())->to->equal(16);
        });
    });

    describe('when rolling 1 strike', function () {
        it("should add the next 2 balls rolled to that frame's score", function () {
            $this->rollStrike();
            $this->game->roll(3);
            $this->game->roll(4);
            $this->rollMany(16, 0);

            expect($this->game->score())->to->equal(24);
        });
    });

    describe('when rolling a perfect game', function () {
        it('should result in a perfect score', function () {
            $this->rollMany(12, 10);
            
            expect($this->game->score())->to->equal(300);
        });
    });
});
