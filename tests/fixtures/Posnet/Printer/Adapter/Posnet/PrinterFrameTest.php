<?php

namespace Posnet;

use InvalidArgumentException;
use Posnet\Printer\Adapter\Posnet;
use Posnet\Printer\Adapter\Posnet\Frame;

class PrinterFrameTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateEmptyFrame()
    {
        new Frame('test');
    }

    public function testBuildFrameWithoutArguments()
    {
        $frame = new Frame('test');
        $this->assertEquals("\002test\t#b4f7\003", $frame->build());
    }

    public function testBuildFrameWithoutArgumentsWithToken()
    {
        $frame = new Frame('test', array(), '1234');
        $this->assertEquals("\002test\t@1234\t#6c2c\003", $frame->build());
        $frame->setToken(9999);
        $this->assertEquals("\002test\t@9999\t#c183\003", $frame->build());
    }

    public function testBuildFrameWithArguments()
    {
        $frame = new Frame('test', array('aa' => 123, 'bb' => 'xyz'));
        $this->assertEquals("\002test\taa123\tbbxyz\t#483e\003", $frame->build());
    }

    public function testBuildFrameWithArgumentsAndToken()
    {
        $frame = new Frame('test', array('aa' => 123, 'bb' => 'xyz'), 1234);
        $this->assertEquals("\002test\taa123\tbbxyz\t@1234\t#6db7\003", $frame->build());
        $frame->setToken(9999);
        $this->assertEquals("\002test\taa123\tbbxyz\t@9999\t#c018\003", $frame->build());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testBuildFrameWithInvalidArguments()
    {
        $frame = new Frame('test', array('aas' => 123, 'bb' => 'xyz'));
        $frame->build();
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testBuildFrameWithInvalidToken()
    {
        $frame = new Frame('test', array(), 'asd');
        $frame->build();
    }
}