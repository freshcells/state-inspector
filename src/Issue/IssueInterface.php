<?php

namespace Freshcells\StateInspector\Issue;

interface IssueInterface
{
    public function getSubject();
    public function getDescription();
    public function getSolution();
}
