<?php

namespace Freshcells\StateInspector\Test;

use Freshcells\StateInspector\Exception\StateInspectorException;
use Freshcells\StateInspector\Inspection\AbstractInspection;
use Freshcells\StateInspector\Inspection\InspectionInterface;
use Freshcells\StateInspector\Inspection\IssueInterface;
use Freshcells\StateInspector\Issue\Issue;

class PelicanInspection implements InspectionInterface
{
    public function inspect($object): array
    {
        $issues = [];
        if (in_array('Pelican', $object->getCollection()) === false) {
            $issues[] = new Issue('No Pelican found!', 'We like Pelicans', 'Add some Pelicans');
        }

        return $issues;
    }

    public function supports($object): bool
    {
        return $object instanceof TestObject;
    }
}
