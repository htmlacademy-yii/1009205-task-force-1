<?php


namespace HtmlAcademy\BusinessLogic;


abstract class AbstractAction
{
    protected $currentUserId;
    protected $customerId;
    protected $executorId;

    abstract protected function ActionTitle();

    abstract protected function ActionInternalName();

    abstract protected static function UserType($currentUserId,$customerId,$executorId);
}

