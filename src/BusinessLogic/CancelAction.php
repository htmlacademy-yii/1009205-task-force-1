<?php


namespace HtmlAcademy\BusinessLogic;


class CancelAction extends AbstractAction
{
    public function ActionTitle()
    {
        return 'Отменить';
    }

    public function ActionInternalName()
    {
        return 'action_cancel';
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
