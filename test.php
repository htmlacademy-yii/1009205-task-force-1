<?php
require_once 'vendor/autoload.php';


use HtmlAcademy\BusinessLogic\TaskStatus;
use HtmlAcademy\BusinessLogic\CancelAction;
use HtmlAcademy\BusinessLogic\IsDoneAction;
use HtmlAcademy\BusinessLogic\RejectAction;
use HtmlAcademy\BusinessLogic\ResponseAction;


// for Customer
$task = new TaskStatus(1, 1, 2);

$task->setStatus(TaskStatus::STATUS_NEW);
assert(in_array(CancelAction::class, $task->getAvailableActions()), 'new status error Customer');
$task->setStatus(TaskStatus::STATUS_IN_PROGRESS);
assert(in_array(IsDoneAction::class, $task->getAvailableActions()), 'in progress status error Customer');
$task->setStatus(TaskStatus::STATUS_IS_DONE);
assert(in_array(ResponseAction::class, $task->getAvailableActions()), 'is done status error Customer');

// for Executor
$task = new TaskStatus(2, 1, 2);

$task->setStatus(TaskStatus::STATUS_NEW);
assert(in_array(ResponseAction::class, $task->getAvailableActions()), 'new status error Executor');
$task->setStatus(TaskStatus::STATUS_IN_PROGRESS);
assert(in_array(RejectAction::class, $task->getAvailableActions()), 'in progress status error Executor');
$task->setStatus(TaskStatus::STATUS_FAILED);
assert(in_array(RejectAction::class, $task->getAvailableActions()), 'failed status error Executor');

try {
    assert($task->getNextStatus(TaskStatus::ACTION_CANCEL) == TaskStatus::STATUS_CANCELLED, 'cancel action');
    assert($task->getNextStatus(TaskStatus::ACTION_SELECT) == TaskStatus::STATUS_IN_PROGRESS, 'select action');
    assert($task->getNextStatus(TaskStatus::ACTION_REJECT) == TaskStatus::STATUS_FAILED, 'reject action');
    assert($task->getNextStatus(TaskStatus::ACTION_IS_DONE) == TaskStatus::STATUS_IS_DONE, 'is done action');
} catch (Exception $e) {
    echo $e->getMessage();
}
try {
    $task->getNextStatus(TaskStatus::ACTION_RESPONSE);
} catch (Exception $e) {
    echo $e->getMessage();
}

try {
    $task->setStatus('TEST');
} catch (Exception $e) {
    echo $e->getMessage();
}



