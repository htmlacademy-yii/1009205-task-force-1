<?php

namespace HtmlAcademy\BusinessLogic;

use RuntimeException;


class TaskStatus
{
    private $currentStatus;
    private $currentUserId;
    private $customerId;
    private $executorId;
    const STATUS_NEW = 'new';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_IS_DONE = 'is_done';
    const STATUS_FAILED = 'failed';
    const ACTION_CANCEL = 'action_cancel';
    const ACTION_RESPONSE = 'action_response';
    const ACTION_SELECT = 'action_select';
    const ACTION_REJECT = 'action_reject';
    const ACTION_IS_DONE = 'action_is_done';

    public function __construct($currentUserId,$customerId, $executorId)
    {
        $this->customerId = $customerId;
        $this->executorId = $executorId;
        $this->currentUserId = $currentUserId;
    }

    public function setStatus($newStatus)
    {
        $this->currentStatus = $newStatus;
    }

    // Определяет след. статус для конкретного действия
    public function getNextStatus($action): string
    {
        switch ($action) {
            case self::ACTION_CANCEL:
                return self::STATUS_CANCELLED;
            case self::ACTION_SELECT:
                return self::STATUS_IN_PROGRESS;
            case self::ACTION_REJECT:
                return self::STATUS_FAILED;
            case  self::ACTION_IS_DONE:
                return self::STATUS_IS_DONE;
        }
        throw new RuntimeException('action:' . $action . ' does not change status');
    }

// Определяет доступные действия для конкретного статуса
     public function getAvailableActions():? object
    {
        $availableAction = null;
        switch ($this->currentStatus) {
            case self::STATUS_NEW:
                if (CancelAction::UserType($this->currentUserId,$this->customerId,$this->executorId) === true) {
                    $availableAction = new CancelAction();
                } elseif (ResponseAction::UserType($this->currentUserId,$this->customerId,$this->executorId) === true)
                {
                    $availableAction = new ResponseAction();
                }
                    break;
            case  self::STATUS_IN_PROGRESS:
                if (IsDoneAction::UserType($this->currentUserId,$this->customerId,$this->executorId) === true) {
                    $availableAction = new IsDoneAction();
                } elseif (RejectAction::UserType($this->currentUserId,$this->customerId,$this->executorId) === true){
                    $availableAction = new RejectAction();
                }
                break;
            default:
                throw new RuntimeException('You have no available actions for current status: '. $this->currentStatus. '  ');
        }
        return $availableAction;
    }
// карта статусов
    public function statusesList(): array

    {
        $array = [
            self::STATUS_IN_PROGRESS => 'В работе',
            self::STATUS_NEW => 'Новое',
            self::STATUS_CANCELLED => 'Отменено',
            self::STATUS_FAILED => 'Провалено',
            self::STATUS_IS_DONE => 'Выполнено'
        ];
        return $array;
    }


//карта действий
    public function actionList(): array

    {
        $array = [
            self::ACTION_REJECT => 'Отказаться',
            self::ACTION_RESPONSE => 'Откликнуться',
            self::ACTION_IS_DONE => 'Выполнено',
            self::ACTION_CANCEL => 'Отменить',
            self::ACTION_SELECT => 'Принять'
        ];
        return $array;
    }
}












