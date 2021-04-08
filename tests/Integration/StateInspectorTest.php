<?php

namespace Freshcells\StateInspector\Test\Integration;

use Freshcells\StateInspector\Exception\StateInspectorException;
use Freshcells\StateInspector\StateInspector;
use Freshcells\StateInspector\Test\PelicanInspection;
use Freshcells\StateInspector\Test\TestObject;
use PHPUnit\Framework\TestCase;

class StateInspectorTest extends TestCase
{
    public function testInspect()
    {
        $inspector         = new StateInspector();
        $object            = new TestObject('prop', new \DateTime('now'), ['Herron', 'Stork', 'Pelican']);
        $pelicanInspection = new PelicanInspection();
        $inspector->addInspection($pelicanInspection);
        $issues = $inspector->inspect($object);
        $this->assertCount(0, $issues);
    }

    public function testInspection()
    {
        $object            = new TestObject('prop', new \DateTime('now'), ['Herron', 'Stork', 'Pelican']);
        $pelicanInspection = new PelicanInspection();
        $inspector         = new StateInspector([$pelicanInspection]);
        $inspector->addInspection($pelicanInspection, 'other_pelican_inspection');
        $issues = $inspector->inspection('other_pelican_inspection', $object);
        $this->assertCount(0, $issues);
        $issues = $inspector->inspection(PelicanInspection::class, $object);
        $this->assertCount(0, $issues);
    }

    public function testFailInspect()
    {
        $inspector         = new StateInspector();
        $object            = new TestObject('prop', new \DateTime('now'), ['Heron', 'Stork', 'Seagull']);
        $pelicanInspection = new PelicanInspection();
        $inspector->addInspection($pelicanInspection);
        $issues = $inspector->inspect($object);
        $this->assertCount(1, $issues);
        $this->assertEquals('No Pelican found!', $issues[0]->getSubject());
    }

    public function testFailBubbleInspect()
    {
        $this->expectException(StateInspectorException::class);
        $inspector         = new StateInspector();
        $object            = new TestObject('prop', new \DateTime('now'), ['Heron', 'Stork', 'Seagull']);
        $pelicanInspection = new PelicanInspection();
        $inspector->addInspection($pelicanInspection);
        $inspector->inspect($object, true);
    }
}
