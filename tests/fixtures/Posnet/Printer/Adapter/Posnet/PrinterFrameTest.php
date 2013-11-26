<?php

namespace Posnet;

use InvalidArgumentException;
use Posnet\Printer\Adapter\Posnet;
use Posnet\Printer\Adapter\Posnet\RequestFrame;

class PrinterFrameTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateEmptyFrame()
    {
        new RequestFrame('test');
    }

    public function testBuildFrameWithoutArguments()
    {
        $frame = new RequestFrame('test');
        $this->assertEquals("\002test\t#b4f7\003", $frame->build());
    }

    public function testBuildFrameWithoutArgumentsWithToken()
    {
        $frame = new RequestFrame('test', array(), '1234');
        $this->assertEquals("\002test\t@1234\t#6c2c\003", $frame->build());
        $frame->setToken(9999);
        $this->assertEquals("\002test\t@9999\t#c183\003", $frame->build());
    }

    public function testBuildFrameWithArguments()
    {
        $frame = new RequestFrame('test', array('aa' => 123, 'bb' => 'xyz'));
        $this->assertEquals("\002test\taa123\tbbxyz\t#483e\003", $frame->build());
    }

    public function testBuildFrameWithArgumentsAndToken()
    {
        $frame = new RequestFrame('test', array('aa' => 123, 'bb' => 'xyz'), 1234);
        $this->assertEquals("\002test\taa123\tbbxyz\t@1234\t#6db7\003", $frame->build());
        $frame->setToken(9999);
        $this->assertEquals("\002test\taa123\tbbxyz\t@9999\t#c018\003", $frame->build());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testBuildFrameWithInvalidArguments()
    {
        $frame = new RequestFrame('test', array('aas' => 123, 'bb' => 'xyz'));
        $frame->build();
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testBuildFrameWithInvalidToken()
    {
        $frame = new RequestFrame('test', array(), 'asd');
        $frame->build();
    }
}