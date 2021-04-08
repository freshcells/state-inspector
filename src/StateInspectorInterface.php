<?php

namespace Freshcells\StateInspector;

use Freshcells\StateInspector\Inspection\InspectionInterface;
use Freshcells\StateInspector\Issue\IssueInterface;

interface StateInspectorInterface
{
    /**
     * @param mixed $object
     * @param bool $bubble
     * @return IssueInterface[]
     */
    public function inspect($object, bool $bubble = false): array;

    /**
     * @param string $name
     * @param bool $bubble
     * @param mixed $object
     * @return InspectionInterface[]
     */
    public function inspection(string $name, $object, bool $bubble = false): array;

    /**
     * @param InspectionInterface $inspection
     * @return $this
     */
    public function addInspection(InspectionInterface $inspection): self;
}
