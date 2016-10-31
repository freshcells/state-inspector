<?php

namespace Freshcells\StateInspector;

use Freshcells\StateInspector\Inspection\InspectionInterface;

class StateInspector implements StateInspectorInterface
{
    /**
     * @var InspectionInterface[]
     */
    private $inspections = [];

    /**
     * @var IssueInterface[]
     */
    private $issues = [];

    /**
     * StateInspectorManager constructor.
     * @param InspectorInterface[] $inspections
     */
    public function __construct(array $inspections = [])
    {
        foreach ($inspections as $inspection) {
            $this->addInspection($inspection);
        }
    }

    /**
     * @param mixed $object
     * @param bool $bubble
     */
    final public function inspect($object, $bubble = false)
    {
        $this->issues = []; //reset
        foreach ($this->inspections as $name => $inspection) {
            $issues       = $this->inspection($name, $object, $bubble);
            $this->issues = array_merge($this->issues, $issues);
        }
    }

    /**
     * @param string $name
     * @param mixed $object
     * @param bool $bubble
     * @return array
     * @throws \Exception
     */
    final public function inspection(string $name, $object, $bubble = false): array
    {
        $inspection = $this->inspections[$name];

        if ($inspection->supports($object) === false) {
            throw new StateInspectorException(
                $name.' Inspection doesnt support object type! Please create new Inspector for different type.'
            );
        }

        try {
            $inspection->inspect($object)
                ? $inspection->success()
                : $inspection->failure();
        } catch (\Exception $e) {
            if ($bubble) {
                throw $e;
            }
        }

        return $inspection->getIssues();
    }

    /**
     * @return IssueInterface[]
     */
    final public function getIssues(): array
    {
        return $this->issues;
    }

    /**
     * @param InspectionInterface $inspection
     * @return StateInspectorInterface
     */
    final public function addInspection(InspectionInterface $inspection): StateInspectorInterface
    {
        $this->inspections[$inspection->getName()] = $inspection;

        return $this;
    }
}
