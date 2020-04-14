<?php


class TaskStatus
{
    public $currentStatus;
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

    // Определяет след. статус для действия
    public function getNextStatus($action)
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
            default:
                return null;
        }
    }

// Определяет доступные действия для конкретного статуса
    public function getAvailableActionsCustomer()
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

    public function getAvailableActionsExecutor()
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
    public
    function statusesList()
    {
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
    }

//карта действий
    public
    function actionList()
    {
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

// Определяет след. Доступный статус
//    public function getAvailableStatuses()
//    {
//        $availableStatus = [];
//        switch ($this->currentStatus) {
//            case self::STATUS_NEW:
//                $availableStatus = [self::STATUS_CANCELLED, self::STATUS_IN_PROGRESS];
//                break;
//            case self::STATUS_IN_PROGRESS:
//                $availableStatus = [self::STATUS_FAILED, self::STATUS_IS_DONE];
//                break;
//            case self::STATUS_CANCELLED || self::STATUS_IS_DONE || self::STATUS_FAILED:
//                $availableStatus = null;
//                break;
//        }
//        return $availableStatus;
//    }
}
