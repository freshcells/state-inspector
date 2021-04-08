<?php

namespace Freshcells\StateInspector\Issue;

class Issue implements IssueInterface
{
    private string $subject;
    private string $description;
    private string $solution;

    /**
     * Issue constructor.
     * @param string $subject
     * @param string $description
     * @param string $solution
     */
    public function __construct(string $subject, string $description = '', string $solution = '')
    {
        $this->subject     = $subject;
        $this->description = $description;
        $this->solution    = $solution;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getSolution(): string
    {
        return $this->solution;
    }
}
