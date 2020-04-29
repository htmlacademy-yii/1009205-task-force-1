<?php
require_once 'vendor/autoload.php';

use HtmlAcademy\BusinessLogic\TaskStatus;
use HtmlAcademy\BusinessLogic\CancelAction;
use HtmlAcademy\BusinessLogic\IsDoneAction;
use HtmlAcademy\BusinessLogic\RejectAction;
use HtmlAcademy\BusinessLogic\ResponseAction;

// for Customer
$task = new TaskStatus(1, 1, 2);

try {
    $task->setStatus(TaskStatus::STATUS_NEW);
    assert($task->getAvailableActions() == new CancelAction(), 'new status error Customer');
    $task->setStatus(TaskStatus::STATUS_IN_PROGRESS);
    assert($task->getAvailableActions() == new IsDoneAction(), 'in progress status error Customer');
    $task->setStatus(TaskStatus::STATUS_IS_DONE);
    assert($task->getAvailableActions() == new ResponseAction(), 'is done status error Customer');
} catch (Exception $e) {
    echo $e->getMessage() . "\n";

}
// for Executor
$task = new TaskStatus(2, 1, 2);
try {
    $task->setStatus(TaskStatus::STATUS_NEW);
    assert($task->getAvailableActions() == new ResponseAction(), 'new status error Executor');
    $task->setStatus(TaskStatus::STATUS_IN_PROGRESS);
    assert($task->getAvailableActions() == new RejectAction(), 'in progress status error Executor');
    $task->setStatus(TaskStatus::STATUS_FAILED);
    assert($task->getAvailableActions() == new RejectAction(), 'failed status error Executor');
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
}

assert($task->getNextStatus(TaskStatus::ACTION_CANCEL) == TaskStatus::STATUS_CANCELLED, 'cancel action');
assert($task->getNextStatus(TaskStatus::ACTION_SELECT) == TaskStatus::STATUS_IN_PROGRESS, 'select action');
assert($task->getNextStatus(TaskStatus::ACTION_REJECT) == TaskStatus::STATUS_FAILED, 'reject action');
assert($task->getNextStatus(TaskStatus::ACTION_IS_DONE) == TaskStatus::STATUS_IS_DONE, 'is done action');
try {
    $task->getNextStatus('TEST');
} catch (Exception $e) {
    echo $e->getMessage();
}



