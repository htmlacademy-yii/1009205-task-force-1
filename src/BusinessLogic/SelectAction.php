<?php


namespace HtmlAcademy\BusinessLogic;


class SelectAction
{
    public static function ActionTitle()
    {
        return 'Принять';
    }

    public static function ActionInternalName()
    {
        return 'action_select';
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
