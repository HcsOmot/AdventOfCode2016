<?php
/**
 * Created by PhpStorm.
 * User: omot
 * Date: 04.12.16.
 * Time: 00:25
 */

namespace AdventOfCode2016Test\Day1;

use AdventOfCode2016\Day1\PathResolver;

class PathResolverTest extends \PHPUnit_Framework_TestCase {
    public function testPathResolverResolvesPath() {
        $resolver = new PathResolver();
//        self::assertEquals(5, $resolver->resolvePath("R2, L3"));
        self::assertEquals(299, $resolver->resolvePath("L1, L3, L5, L3, R1, L4, L5, R1, R3, L5, R1, L3, L2, L3, R2, R2, L3, L3, R1, L2, R1, L3, L2, R4, R2, L5, R4, L5, R4, L2, R3, L2, R4, R1, L5, L4, R1, L2, R3, R1, R2, L4, R1, L2, R3, L2, L3, R5, L192, R4, L5, R4, L1, R4, L4, R2, L5, R45, L2, L5, R4, R5, L3, R5, R77, R2, R5, L5, R1, R4, L4, L4, R2, L4, L1, R191, R1, L1, L2, L2, L4, L3, R1, L3, R1, R5, R3, L1, L4, L2, L3, L1, L1, R5, L4, R1, L3, R1, L2, R1, R4, R5, L4, L2, R4, R5, L1, L2, R3, L4, R2, R2, R3, L2, L3, L5, R3, R1, L4, L3, R4, R2, R2, R2, R1, L4, R4, R1, R2, R1, L2, L2, R4, L1, L2, R3, L3, L5, L4, R4, L3, L1, L5, L3, L5, R5, L5, L4, L2, R1, L2, L4, L2, L4, L1, R4, R4, R5, R1, L4, R2, L4, L2, L4, R2, L4, L1, L2, R1, R4, R3, R2, R2, R5, L1, L2"));
        self::assertEquals(2, $resolver->resolvePath("R2, R2, R2"));
        self::assertEquals(12, $resolver->resolvePath("R5, L5, R5, R3"));
        self::assertEquals(4, $resolver->resolvePath("R8, R4, R4, R8"));
    }

    public function testPathResolverInitializesCorrectly() {
        $resolver = new PathResolver();

        self::assertAttributeEquals(0, "currentX", $resolver);
        self::assertAttributeEquals(0, "currentY", $resolver);
        self::assertAttributeEquals(1, "currentOrientation", $resolver);
    }

  

}
