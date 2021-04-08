<?php

namespace Freshcells\StateInspector;

use Freshcells\StateInspector\Exception\StateInspectorException;
use Freshcells\StateInspector\Inspection\InspectionInterface;
use Freshcells\StateInspector\Issue\Issue;
use Freshcells\StateInspector\Issue\IssueInterface;

class StateInspector implements StateInspectorInterface
{
    /**
     * @var InspectionInterface[]
     */
    private array $inspections = [];

    /**
     * StateInspectorManager constructor.
     * @param InspectionInterface[] $inspections
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
     * @return IssueInterface[]
     * @throws StateInspectorException
     */
    final public function inspect($object, bool $bubble = false): array
    {
        $issues = [];
        foreach ($this->inspections as $name => $inspection) {
            $issues = array_merge($issues, $this->inspection($name, $object, $bubble));
        }

        return $issues;
    }

    /**
     * @param string $name
     * @param mixed $object
     * @param bool $bubble
     * @return IssueInterface[]
     * @throws StateInspectorException
     */
    final public function inspection(string $name, $object, bool $bubble = false): array
    {
        if (isset($this->inspections[$name]) === false) {
            $msg = $name.' no such inspection!';
            throw new StateInspectorException(
                [new Issue($msg, $name.' is no inspection.', 'Please create new Inspection or use other name.')],
                $msg
            );
        }
        $inspection = $this->inspections[$name];

        if ($inspection->supports($object) === false) {
            $msg = $name.' inspection does not support object type!';
            throw new StateInspectorException(
                [new Issue($msg, get_class($object).' is not supported.', 'Please create new Inspection for this type.')],
                $msg
            );
        }

        $issues = $inspection->inspect($object);

        if ($bubble) {
            throw new StateInspectorException($issues);
        }

        return $issues;
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
