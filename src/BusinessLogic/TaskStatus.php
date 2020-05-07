<?php

namespace HtmlAcademy\BusinessLogic;

use HtmlAcademy\Exceptions\InputException;
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
    const ACTION_SELECT = 'action_select';
    const ACTION_CANCEL = CancelAction::class;
    const ACTION_RESPONSE = ResponseAction::class;
    const ACTION_REJECT = RejectAction::class;
    const ACTION_IS_DONE = IsDoneAction::class;
    private array $actions = [
        self::ACTION_CANCEL,
        self::ACTION_RESPONSE,
        self::ACTION_REJECT,
        self::ACTION_IS_DONE,
    ];

    public function __construct($currentUserId, $customerId, $executorId)
    {
        $this->customerId = $customerId;
        $this->executorId = $executorId;
        $this->currentUserId = $currentUserId;
    }
    // задаёт текущий статус задачи
    public function setStatus(string $newStatus):void
    {
        if (!array_key_exists($newStatus, $this->statusesList())) {
            throw new InputException('status ' . $newStatus . ' does not exist' . "\n");
        }
        $this->currentStatus = $newStatus;
    }

    // Определяет след. статус для конкретного действия
    public function getNextStatus(string $action): ?string
    {
        if (!in_array($action, $this->actions)) {
            throw new InputException('action ' . $action . ' does not exist' . "\n");
        } else {
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
            throw new RuntimeException('action:' . $action . ' does not change status' .  "\n");
        }
    }

// Определяет доступные действия для конкретного статуса
    public function getAvailableActions(): array
    {
        $availableActions = [];
        foreach ($this->actions as $action) {
            if ($action::AccessVerification($this->currentUserId, $this->customerId, $this->executorId, $this->currentStatus)) {
                $availableActions[] = $action;
            }
        }
        return $availableActions;
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












