<?php

namespace Freshcells\StateInspector\Test\Unit;

use Freshcells\StateInspector\Inspection\InspectionInterface;
use Freshcells\StateInspector\StateInspector;
use Freshcells\StateInspector\Test\TestObject;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

class StateInspectorTest extends TestCase
{
    public function testEmptyInspectAll()
    {
        $object = new TestObject('prop', new \DateTime('now'), ['Hecht', 'Barsch', 'Zander']);

        $inspector = new StateInspector();
        $issues = $inspector->inspect($object);
        $this->assertCount(0, $issues);
    }

    public function testInspectAll()
    {
        $object = new TestObject('prop', new \DateTime('now'), ['Hecht', 'Barsch', 'Zander']);

        $inspection1 = $this->createMock(InspectionInterface::class);
        $inspection1->expects($this->once())->method('supports')->with($object)->willReturn(true);
        $inspection1->expects($this->once())->method('inspect')->with($object)->willReturn([]);

        $inspection2 = $this->createMock(InspectionInterface::class);
        $inspection2->expects($this->once())->method('supports')->with($object)->willReturn(true);
        $inspection2->expects($this->once())->method('inspect')->with($object)->willReturn([]);

        $inspector = new StateInspector();
        $inspector->addInspection($inspection1, 'second')->addInspection($inspection2);
        $issues = $inspector->inspect($object);
        $this->assertCount(0, $issues);
    }
}
