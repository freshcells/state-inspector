<?php

namespace Freshcells\StateInspector\Exception;

use Freshcells\StateInspector\Issue\IssueInterface;

class StateInspectorException extends \Exception
{
    private $issue;

    /**
     * StateInspectorException constructor.
     * @param IssueInterface $issue
     * @param string $message
     * @param null $code
     */
    public function __construct(IssueInterface $issue, $message = '', $code = null)
    {
        $this->issue = $issue;

        parent::__construct($message, $code);
    }

    /**
     * @return IssueInterface
     */
    public function getIssue(): IssueInterface
    {
        return $this->issue;
    }
}
