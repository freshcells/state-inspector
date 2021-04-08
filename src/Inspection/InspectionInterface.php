<?php

namespace Freshcells\StateInspector\Inspection;

use Freshcells\StateInspector\Issue\IssueInterface;

interface InspectionInterface
{
    /**
     * inspects the object
     *
     * @param mixed $object
     * @return IssueInterface[]
     */
    public function inspect($object): array;

    /**
     * detects if Inspection supports given object
     *
     * @param mixed $object
     * @return bool
     */
    public function supports($object): bool;
}
