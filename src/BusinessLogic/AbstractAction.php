<?php


namespace HtmlAcademy\BusinessLogic;


abstract class AbstractAction
{
    protected $currentUserId;
    protected $customerId;
    protected $executorId;

    abstract protected static function ActionTitle();

    abstract protected static function ActionInternalName();

    abstract protected static function UserType($currentUserId,$customerId,$executorId);
}

