<?php

namespace Freshcells\StateInspector\Inspection;

use Freshcells\StateInspector\Exception\StateInspectorException;
use Freshcells\StateInspector\Issue\Issue;
use Freshcells\StateInspector\Issue\IssueInterface;

/**
 * Class AbstractInspection
 * @package Freshcells\StateInspector\Inspection
 */
abstract class AbstractInspection implements InspectionInterface
{
    /**
     * @var array
     */
    private $issues = [];

    /**
     * @param $object
     * @return bool
     */
    abstract public function inspect($object):bool;

    /**
     * @return string
     */
    abstract public function getName():string;

    /**
     * @param mixed $object
     * @return bool
     */
    abstract public function supports($object):bool;

    /**
     *
     */
    public function success()
    {
        // hooray i could celebrate now
    }

    /**
     * you probably want to override this
     * @throws StateInspectorException
     */
    public function failure()
    {
        $issue = new Issue(
            'Something is not right in the State of Denmark',
            'You probably want to override this method',
            'This would be the solution'
        );
        $this->addIssue($issue);
        throw new StateInspectorException($issue);
    }

    /**
     * @param IssueInterface $issue
     */
    public function addIssue(IssueInterface $issue)
    {
        $this->issues[] = $issue;
    }

    /**
     * @return IssueInterface[]
     */
    public function getIssues():array
    {
        return $this->issues;
    }
}
