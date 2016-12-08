<?php
/**
 * Created by PhpStorm.
 * User: omot
 * Date: 02.12.16.
 * Time: 21:51
 */

namespace AdventOfCode2016\Day1;


/**
 * Class PathResolver
 * @package AdventOfCode2016
 *
 * Day 1 puzzle solution
 *
 * Part 1: Santa needs to find the distance between his airdrop point and the final destination calculated from move
 * sequence
 *
 * Part 2: Santa needs to find the distance between his airdrop point and the Easter Bunny HQ, which is located at
 * the very point he first visited twice (mind you, not the actual destination visited twice, but ANY point along his
 * route)
 */
/**
 * Class PathResolver
 * @package AdventOfCode2016
 */
class PathResolver {
    /**
     * @var int Current X coordinate
     */
    private $currentX;
    /**
     * @var int Current Y coordinate
     */
    private $currentY;
    /**
     * @var int Value of currently facing direction (is Santa currently North, East, South, or West oriented)
     */
    private $currentOrientation;

    /**
     * @var array List of moves Santa needs to take
     */
    private $moveList = [];

    /**
     * @var array List of visited locations - all points in the coordinate system visited by Santa while traversing
     * through the move sequence
     */
    private $visitedLocations = [];

    /**
     * @const magic number denoting North bound orientation
     */
    const _ORIENTATION_NORTH    = 1;
    /**
     * @const magic number denoting East bound orientation
     */
    const _ORIENTATION_EAST     = 2;
    /**
     * @const magic number denoting South bound orientation
     */
    const _ORIENTATION_SOUTH    = 3;
    /**
     * @const magic number denoting West bound orientation
     */
    const _ORIENTATION_WEST     = 4;

    /**
     * PathResolver constructor.
     *
     * Initializes starting point coordinates to 0 and sets Santa's orientation North bound
     */
    public function __construct() {
        $this->currentX = 0;
        $this->currentY = 0;
        $this->currentOrientation = self::_ORIENTATION_NORTH;
    }

    /**
     * Calculates the distance from airdrop point to the final destination encoded in Santa's move sequence (path)
     *
     * The move sequence is analyzed and resolved to a list of coordinates, and the distance to airdrop point is
     * calculated in regards to the final coordinate in the sequence
     * @param $path
     * @return int
     */
    public function resolvePath($path) {
        $this->processPath($path);
        $this->handleMoves();
        /**
         * Part 1 & Part 2 code is jumbled up together, need to refactor this whole thing.
         * The following two lines print the list of all traveled points across the coordinate system - the complete
         * movement history - every step taken while executing movements from the move sequence, and the current
         * coordinates, which are actually the coordinates of Easter Bunny HQ. The execution of the handleMoves method
         * is stopped when the location is found.
         * This is used in Part 2
         * The final line calculates the distance to HQ, because the current coordinates are set to the first
         * occurrence of point that was visited twice - hence those are the coordinates of the HQ and the distance is
         * calculated to those coordinates.
         *
         */
        print_r($this->visitedLocations);
        echo PHP_EOL . $this->currentX . " : " . $this->currentY;
        return $this->calculateFinalDistance();
    }

    /**
     * Explode move sequence string to an array
     *
     * Explode the string to an array so it's easily traversable
     *
     * @param $path
     */
    private function processPath($path) {
        $this->moveList = explode(", ", $path);
    }

    /**
     * Process the move sequence
     *
     * Loops through the moveList array and processes each move by separating the turing direction from the distance
     * that Santa needs to travel
     *
     * @internal string $move Element from the moveList array - a move that needs to be handled
     */
    private function handleMoves() {
        foreach ($this->moveList as $move) {
            $turnValue = $move[0];
            $moveValue = substr($move, 1);
            $this->handleTurning($turnValue);
            if ($this->performMove($moveValue)){
                return;
            }
        }
    }

    /**
     * Turn Santa whichever way necessary
     *
     * Analyzes the turn value and performs a turn by setting the currentOrientation to a new value
     *
     * @param $turnValue
     */
    private function handleTurning($turnValue) {
        if ($turnValue == "R") {
            if ($this->currentOrientation < 4) {
                $this->currentOrientation += 1;
            } elseif ($this->currentOrientation == 4){
                $this->currentOrientation = 1;
            }
        } elseif ($turnValue == "L") {
                if ($this->currentOrientation > 1) {
                    $this->currentOrientation -= 1;
                } elseif ($this->currentOrientation == 1){
                    $this->currentOrientation = 4;
                }
        }
    }

    /**
     * Move Santa forward by some value
     *
     * Part 1:
     * analyze the current orientation and adjust the value of appropriate coordinate (X or Y, depending on if Santa
     * need to move North or South, or East or West, respectfully) by the amount of movement needed to be made.
     *
     * Part 2 (needs to be refactored out):
     * increment movement by unit of 1, because now Santa needs to keep track of EVERY. SINGLE. FUCKING. STEP. he
     * makes, in order to be able to know when he passes the same POINT for the second time.
     * He keeps a ledger of every step for each move, and keeps checking if he's already been here.
     *
     * @param $moveValue
     * @return bool
     */
    private function performMove($moveValue) {
        for ($i = 1; $i <= $moveValue; $i++){
            if ($this->currentOrientation == 4) {
                $this->currentX -= 1;
            } elseif ($this->currentOrientation == 2) {
                $this->currentX += 1;
            }

            if ($this->currentOrientation == 1) {
                $this->currentY += 1;
            } elseif ($this->currentOrientation == 3) {
                $this->currentY -= 1;
            }
            if (in_array([$this->currentX, $this->currentY], $this->visitedLocations)){
                return true;
            }
            $this->visitedLocations[] = [$this->currentX, $this->currentY];

        }
    }

    /**
     * Calculate rectilinear distance between two points
     *
     * Taxicab metric, rectilinear distance, L1 distance, snake distance. The non Euclidean distance between two
     * points in system. Calculated by summing the absolute differences of Cartesian coordinates.
     *
     * @return int $finalDistance The integer representation of the rectilinear distance between two points in
     * Cartesian system
     */
    private function calculateFinalDistance() {
        $finalDistance = abs(0 - $this->currentX) + abs(0 - $this->currentY);
        return $finalDistance;
    }

}