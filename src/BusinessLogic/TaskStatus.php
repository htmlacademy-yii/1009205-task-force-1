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
    const ACTION_CANCEL = CancelAction::class;
    const ACTION_RESPONSE = ResponseAction::class;
    const ACTION_REJECT = RejectAction::class;
    const ACTION_IS_DONE = IsDoneAction::class;
    const ACTION_SELECT = 'action_select';

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
        $availableActions = [];
        $currentStatus = $this->currentStatus;
        $actions = [
            new CancelAction(),
            new IsDoneAction(),
            new RejectAction(),
            new ResponseAction()
        ];
        foreach ($actions as $action) {
            if ($action::AccessVerification($this->currentUserId, $this->customerId, $this->executorId, $this->currentStatus)) {
                $availableActions[] = $action;
            }
        }
        if (empty($availableActions)) {
            throw new RuntimeException('You have no available actions for current status: ' . $currentStatus . '  ');
        }
        return $availableActions[0];
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
}












