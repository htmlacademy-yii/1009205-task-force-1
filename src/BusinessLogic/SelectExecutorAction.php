<?php


namespace HtmlAcademy\BusinessLogic;


class SelectExecutorAction extends AbstractAction
{
    public function ActionTitle()
    {
        return 'Принять';
    }

    public function ActionInternalName()
    {
        return 'action_select';
    }

    public static function UserType($currentUserId, $customerId, $executorId)
    {
        if ($currentUserId === $customerId) {
            return true;
        } else {
            return false;
        }
    }
}
