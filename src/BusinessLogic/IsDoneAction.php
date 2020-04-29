<?php


namespace HtmlAcademy\BusinessLogic;


class IsDoneAction extends AbstractAction
{
    const STATUS_IN_PROGRESS = 'in_progress';
    public static function ActionTitle()
    {
        return 'Выполнено';
    }

    public static function ActionInternalName()
    {
        return 'action_is_done';
    }

    public static function AccessVerification($currentUserId,$customerId,$executorId,$currentStatus)
    {
        if ($currentUserId === $customerId && $currentStatus === self::STATUS_IN_PROGRESS) {
            return true;
        } else {
            return false;
        }
    }
}
