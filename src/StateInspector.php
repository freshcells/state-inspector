<?php

namespace Freshcells\StateInspector;

use Freshcells\StateInspector\Exception\StateInspectorException;
use Freshcells\StateInspector\Inspection\InspectionInterface;
use Freshcells\StateInspector\Issue\Issue;

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
        foreach ($inspections as $name => $inspection) {
            if (is_numeric($name)) {
                $name = null;
            }
            $this->addInspection($inspection, $name);
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
     * @return InspectionInterface[]
     * @throws \Exception
     */
    final public function inspection(string $name, $object, $bubble = false): array
    {
        if (isset($this->inspections[$name]) === false) {
            $msg = $name.' no such inspection!';
            throw new StateInspectorException(
                new Issue($msg, $name.' is no inspection.', 'Please create new Inspection or use other name.'),
                $msg
            );
        }
        $inspection = $this->inspections[$name];

        if ($inspection->supports($object) === false) {
            $msg = $name.' inspection doesnt support object type!';
            throw new StateInspectorException(
                new Issue($msg, get_class($object).' is not supported.', 'Please create new Inspection for this type.'),
                $msg
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
     * @param string|null $name
     * @return StateInspectorInterface
     */
    final public function addInspection(InspectionInterface $inspection, string $name = null): StateInspectorInterface
    {
        if (null === $name) {
            $name = get_class($inspection);
        }
        $this->inspections[$name] = $inspection;

        return $this;
    }
}
