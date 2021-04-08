<?php

namespace Freshcells\StateInspector\Issue;

interface IssueInterface
{
    public function getSubject(): string;

    public function getDescription(): string;

    public function getSolution(): string;
}
