<?php


namespace HtmlAcademy\BusinessLogic;


class ResponseAction extends AbstractAction
{

    public static function ActionTitle()
    {
        return 'Откликнуться';
    }

    public static function ActionInternalName()
    {
        return 'action_response';
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
