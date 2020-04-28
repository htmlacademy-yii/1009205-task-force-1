<?php


namespace HtmlAcademy\BusinessLogic;


class RejectAction extends AbstractAction
{
    public static function ActionTitle()
    {
        return 'Отказаться';
    }

    public static function ActionInternalName()
    {
        return 'action_reject';
    }

    public static function UserType($currentUserId,$customerId,$executorId)
    {
        if ($currentUserId === $executorId) {
            return true;
        } else {
            return false;
        }
    }
}
