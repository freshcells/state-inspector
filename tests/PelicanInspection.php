<?php

namespace Freshcells\StateInspector\Test;

use Freshcells\StateInspector\Exception\StateInspectorException;
use Freshcells\StateInspector\Inspection\AbstractInspection;
use Freshcells\StateInspector\Inspection\IssueInterface;
use Freshcells\StateInspector\Issue\Issue;

class PelicanInspection extends AbstractInspection
{
    public function inspect($object):bool
    {
        return in_array('Pelican', $object->getCollection());
    }

    public function failure()
    {
        $issue = new Issue('No Pelican found!', 'We like Pelicans', 'Add some Pelicans');
        $this->addIssue($issue);
        throw new StateInspectorException($issue);
    }

    public function getName():string
    {
        return 'pelican_inspection';
    }

    public function supports($object):bool
    {
        return $object instanceof TestObject;
    }
}
