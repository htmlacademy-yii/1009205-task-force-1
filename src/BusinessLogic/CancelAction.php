<?php


namespace HtmlAcademy\BusinessLogic;


class CancelAction extends AbstractAction
{
    const STATUS_NEW = 'new';
    public static function ActionTitle()
    {
        return 'Отменить';
    }

    public static function ActionInternalName()
    {
        return 'action_cancel';
    }

    public static function AccessVerification($currentUserId,$customerId,$executorId,$currentStatus)
    {
        if ($currentUserId === $customerId && $currentStatus === self::STATUS_NEW ) {
            return true;
        } else {
            return false;
        }
    }
}
