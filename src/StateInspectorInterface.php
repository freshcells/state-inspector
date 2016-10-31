<?php

namespace Freshcells\StateInspector;

use Freshcells\StateInspector\Inspection\InspectionInterface;

interface StateInspectorInterface
{

    /**
     * @param mixed $object
     * @param bool $bubble
     */
    public function inspect($object, $bubble = false);

    /**
     * @param string $name
     * @param mixed $object
     * @param bool $bubble
     * @return InspectionInterface[]
     * @throws \Exception
     */
    public function inspection(string $name, $object, $bubble = false): array;

    /**
     * @return IssueInterface[]
     */
    public function getIssues(): array;

    /**
     * @param InspectionInterface $inspection
     * @return StateInspectorInterface
     */
    public function addInspection(InspectionInterface $inspection): StateInspectorInterface;
}
