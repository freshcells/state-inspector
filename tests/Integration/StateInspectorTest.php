<?php

namespace Freshcells\StateInspector\Test\Integration;

use Freshcells\StateInspector\StateInspector;
use Freshcells\StateInspector\Test\PelicanInspection;
use Freshcells\StateInspector\Test\TestObject;

class StateInspectorTest extends \PHPUnit_Framework_TestCase
{
    public function testInspect()
    {
        $inspector         = new StateInspector();
        $object            = new TestObject('prop', new \DateTime('now'), ['Herron', 'Stork', 'Pelican']);
        $pelicanInspection = new PelicanInspection();
        $inspector->addInspection($pelicanInspection);
        $inspector->inspect($object);
        $this->assertCount(0, $inspector->getIssues());
    }

    public function testInspection()
    {
        $object            = new TestObject('prop', new \DateTime('now'), ['Herron', 'Stork', 'Pelican']);
        $pelicanInspection = new PelicanInspection();
        $inspector         = new StateInspector([$pelicanInspection]);
        $inspector->addInspection($pelicanInspection, 'other_pelican_inspection');
        $inspector->inspection('other_pelican_inspection', $object);
        $inspector->inspection(PelicanInspection::class, $object);
        $this->assertCount(0, $inspector->getIssues());
    }

    public function testFailInspect()
    {
        $inspector         = new StateInspector();
        $object            = new TestObject('prop', new \DateTime('now'), ['Herron', 'Stork', 'Seagull']);
        $pelicanInspection = new PelicanInspection();
        $inspector->addInspection($pelicanInspection);
        $inspector->inspect($object);
        $this->assertCount(1, $inspector->getIssues());
        $this->assertEquals('No Pelican found!', $inspector->getIssues()[0]->getSubject());
    }

    /**
     * @expectedException Freshcells\StateInspector\Exception\StateInspectorException
     */
    public function testFailBubbleInspect()
    {
        $inspector         = new StateInspector();
        $object            = new TestObject('prop', new \DateTime('now'), ['Herron', 'Stork', 'Seagull']);
        $pelicanInspection = new PelicanInspection();
        $inspector->addInspection($pelicanInspection);
        $inspector->inspect($object, true);
    }
}
