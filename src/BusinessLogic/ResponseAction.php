<?php


namespace HtmlAcademy\BusinessLogic;


class ResponseAction extends AbstractAction
{
    const STATUS_NEW = 'new';
    public static function ActionTitle()
    {
        return 'Откликнуться';
    }

    public static function ActionInternalName()
    {
        return 'action_response';
    }

    public static function AccessVerification($currentUserId,$customerId,$executorId,$currentStatus)
    {
        if ($currentUserId === $executorId && $currentStatus === self::STATUS_NEW) {
            return true;
        } else {
            return false;
        }
    }
}
