<?php


namespace HtmlAcademy\BusinessLogic;


class IsDoneAction extends AbstractAction
{
    public static function ActionTitle()
    {
        return 'Выполнено';
    }

    public static function ActionInternalName()
    {
        return 'action_is_done';
    }

    public static function UserType($currentUserId,$customerId,$executorId)
    {
        if ($currentUserId === $customerId) {
            return true;
        } else {
            return false;
        }
    }
}
