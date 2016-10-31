<?php

namespace Freshcells\StateInspector\Inspection;

interface InspectionInterface
{
    /**
     * inspects the object
     *
     * @param $object
     * @return bool
     */
    public function inspect($object):bool;

    /**
     * success check callback
     */
    public function success();

    /**
     * failure check callback
     */
    public function failure();

    /**
     * @return string
     */
    public function getName():string;

    /**
     * returns all found issues
     *
     * @return IssueInterface[]
     */
    public function getIssues():array;

    /**
     * detects if Inspection supports given object
     *
     * @param mixed $object
     * @return bool
     */
    public function supports($object):bool;
}
