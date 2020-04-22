<?php


namespace HtmlAcademy\BusinessLogic;


class IsDoneAction extends AbstractAction
{
    public function ActionTitle()
    {
        return 'Выполнено';
    }

    public function ActionInternalName()
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
