<?php

namespace Freshcells\StateInspector\Test\Unit;

use Freshcells\StateInspector\Inspection\InspectionInterface;
use Freshcells\StateInspector\StateInspector;
use Freshcells\StateInspector\Test\TestObject;
use Prophecy\Argument;

class StateInspectorTest extends \PHPUnit_Framework_TestCase
{
    public function testEmptyInspectAll()
    {
        $object = new TestObject('prop', new \DateTime('now'), ['Hecht', 'Barsch', 'Zander']);

        $inspector = new StateInspector();
        $inspector->inspect($object);
        $this->assertCount(0, $inspector->getIssues());
    }

    public function testInspectAll()
    {
        $object = new TestObject('prop', new \DateTime('now'), ['Hecht', 'Barsch', 'Zander']);

        $inspection1 = $this->prophesize(InspectionInterface::class);
        $inspection1->supports(Argument::exact($object))->shouldBeCalled()->willReturn(true);
        $inspection1->inspect(Argument::exact($object))->shouldBeCalled()->willReturn(true);
        $inspection1->success()->shouldBeCalled();
        $inspection1->getIssues()->shouldBeCalled()->willReturn([]);

        $inspection2 = $this->prophesize(InspectionInterface::class);
        $inspection2->supports(Argument::exact($object))->shouldBeCalled()->willReturn(true);
        $inspection2->inspect(Argument::exact($object))->shouldBeCalled()->willReturn(false);
        $inspection2->failure()->shouldBeCalled();
        $inspection2->getIssues()->shouldBeCalled()->willReturn([]);

        $inspector = new StateInspector();
        $inspector->addInspection($inspection1->reveal())->addInspection($inspection2->reveal());
        $inspector->inspect($object);
        $this->assertCount(0, $inspector->getIssues());
    }
}
