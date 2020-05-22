<?php


class TaskStatus
{
    private $currentStatus;
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

    public function __construct($customerId, $executorId)
    {
        $this->customerId = $customerId;
        $this->executorId = $executorId;
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
    public function getAvailableActions(bool $isCustomer = true):?string
    {
        if ($isCustomer) {
            return $this->getAvailableActionsCustomer();
        } else {
            return $this->getAvailableActionsExecutor();
        }
    }

    private function getAvailableActionsCustomer():?string
    {
        $availableAction = null;
        switch ($this->currentStatus) {
            case self::STATUS_NEW:
                $availableAction = self::ACTION_CANCEL;
                break;
            case  self::STATUS_IN_PROGRESS:
                $availableAction = self::ACTION_IS_DONE;
                break;
            default:
                $availableAction = null;
        }
        return $availableAction;
    }

    private function getAvailableActionsExecutor():?string
    {
        $availableAction = null;
        switch ($this->currentStatus) {
            case self::STATUS_NEW:
                $availableAction = self::ACTION_RESPONSE;
                break;
            case self::STATUS_IN_PROGRESS:
                $availableAction = self::ACTION_REJECT;
                break;
            default:
                $availableAction = null;
                break;
        }
        return $availableAction;
    }

// карта статусов
    public function statusesList():array

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
    public function actionList():array

    {
        $array = [
            self::ACTION_REJECT => 'Отказаться',
            self::ACTION_RESPONSE => 'Откликнуться',
            self::ACTION_IS_DONE => 'Выполнено',
            self::ACTION_CANCEL => 'Отменить'
        ];
        return $array;
    }
}

