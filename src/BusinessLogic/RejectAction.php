<?php


namespace HtmlAcademy\BusinessLogic;


class RejectAction extends AbstractAction
{
    const STATUS_IN_PROGRESS = 'in_progress';
    public static function ActionTitle()
    {
        return 'Отказаться';
    }

    public static function ActionInternalName()
    {
        return 'action_reject';
    }

    public static function AccessVerification($currentUserId,$customerId,$executorId,$currentStatus)
    {
        if ($currentUserId === $executorId && $currentStatus === self::STATUS_IN_PROGRESS) {
            return true;
        } else {
            return false;
        }
    }
}
