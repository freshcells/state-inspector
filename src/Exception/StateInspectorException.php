<?php

namespace Freshcells\StateInspector\Exception;

use Freshcells\StateInspector\Issue\IssueInterface;

class StateInspectorException extends \Exception
{
    /**
     * @var IssueInterface[]
     */
    private array $issues;

    /**
     * StateInspectorException constructor.
     * @param IssueInterface[] $issues
     * @param string $message
     * @param int|null $code
     */
    public function __construct(array $issues, string $message = '', int $code = null)
    {
        $this->issues = $issues;

        parent::__construct('StateInspector found '.count($issues).' issues!', $code);
    }

    /**
     * @return IssueInterface[]
     */
    public function getIssues(): array
    {
        return $this->issues;
    }
}
