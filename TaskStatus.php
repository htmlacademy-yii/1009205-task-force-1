<?php


class TaskStatus
{
    public $currentStatus;
    private $customerId;
    private $executorId;
    private $accountType;
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
    const ACCOUNT_CUSTOMER = 'account_customer';
    const ACCOUNT_EXECUTOR = 'account_executor';

    public function __construct($customerId, $executorId, $accountType)
    {
        $this->customerId = $customerId;
        $this->executorId= $executorId;
        $this->accountType = $accountType;
    }

    public function setStatus($newStatus){
        $this->currentStatus = $newStatus;
    }

 // Определяет след. статус для действия
    public function getNextStatus($action)
    {
        $nextStatus = null;
        switch ($action) {
            case self::ACTION_CANCEL:
                $nextStatus = self::STATUS_CANCELLED;
                break;
            case self::ACTION_SELECT:
                $nextStatus = self::STATUS_IN_PROGRESS;
                break;
            case self::ACTION_REJECT:
                $nextStatus = self::STATUS_FAILED;
                break;
            case  self::ACTION_IS_DONE:
                $nextStatus = self::STATUS_IS_DONE;
                break;
        }
        return $nextStatus;
    }

// Определяет доступные действия для конкретного статуса
    public function getAvailableActions()
    {
        $availableAction = null;
        if ($this->accountType == self::ACCOUNT_CUSTOMER) {
            switch ($this->currentStatus) {
                case self::STATUS_NEW:
                    $availableAction = self::ACTION_CANCEL;
                    break;
                case  self::STATUS_IN_PROGRESS:
                    $availableAction = self::ACTION_IS_DONE;
                    break;
                case self::STATUS_IS_DONE || self::STATUS_FAILED || self::STATUS_CANCELLED:
                    $availableAction = null;
            }
            return $availableAction;
        } elseif ($this->accountType == self::ACCOUNT_EXECUTOR

        ) {
            switch ($this->currentStatus) {
                case self::STATUS_NEW:
                    $availableAction = self::ACTION_RESPONSE;
                    break;
                case self::STATUS_IN_PROGRESS:
                    $availableAction = self::ACTION_REJECT;
                    break;
                case self::STATUS_IS_DONE || self::STATUS_FAILED || self::STATUS_CANCELLED:
                    $availableAction = null;
                    break;
            }
        }
        return $availableAction;
    }

    // карта статусов
    public function statusesList()
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
    public function actionList()
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
