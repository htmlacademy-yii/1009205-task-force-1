<?php

namespace HtmlAcademy\BusinessLogic;

use RuntimeException;


class TaskStatus
{
    private $currentStatus;
    private $currentUserId;
    private $customerId;
    private $executorId;
    const CUSTOMER = 'customer';
    const EXECUTOR = 'executor';
    const STATUS_NEW = 'new';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_IS_DONE = 'is_done';
    const STATUS_FAILED = 'failed';
    const ACTION_CANCEL = CancelAction::class;
    const ACTION_RESPONSE = ResponseAction::class;
    const ACTION_REJECT = RejectAction::class;
    const ACTION_IS_DONE = IsDoneAction::class;
    const ACTION_SELECT = SelectAction::class;

    public function __construct($currentUserId, $customerId, $executorId)
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
    public function getAvailableActions(): ?object
    {
        $currentStatus = $this->currentStatus;
        $userType = null;
        if (CancelAction::UserType($this->currentUserId, $this->customerId, $this->executorId)) {
            $userType = self::CUSTOMER;
        } elseif ( ResponseAction::UserType($this->currentUserId, $this->customerId, $this->executorId)){
            $userType = self::EXECUTOR;
        }
        $actions = [
            self::CUSTOMER => [
                self::STATUS_NEW => self::ACTION_CANCEL,
                self::STATUS_IN_PROGRESS => self::ACTION_IS_DONE,
                self::STATUS_IS_DONE => null,
                self::STATUS_CANCELLED => null,
                self::STATUS_FAILED => null
            ],
            self::EXECUTOR => [
                self::STATUS_NEW => self::ACTION_RESPONSE,
                self::STATUS_IN_PROGRESS => self::ACTION_REJECT,
                self::STATUS_IS_DONE => null,
                self::STATUS_CANCELLED => null,
                self::STATUS_FAILED => null
            ]
        ];
        $availableAction = $actions[$userType][$currentStatus];
        if ($availableAction != null) {
            return new $availableAction;
        } else {
            throw new RuntimeException('You have no available actions for current status: ' . $currentStatus . '  ');
        }
    }

// карта статусов
    public
    function statusesList(): array

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
    public
    function actionList(): array

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












