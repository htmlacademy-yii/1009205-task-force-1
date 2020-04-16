<?php
require_once 'vendor/autoload.php';
use HtmlAcademy\BusinessLogic\TaskStatus;
$task = new TaskStatus(1,null);

assert($task->getNextStatus(TaskStatus::ACTION_CANCEL) == TaskStatus::STATUS_CANCELLED, 'cancel action');
assert($task->getNextStatus(TaskStatus::ACTION_SELECT) == TaskStatus::STATUS_IN_PROGRESS, 'select action');
assert($task->getNextStatus(TaskStatus::ACTION_REJECT) == TaskStatus::STATUS_FAILED, 'reject action');
assert($task->getNextStatus(TaskStatus::ACTION_IS_DONE) == TaskStatus::STATUS_IS_DONE, 'is done action');
try {
    $task->getNextStatus('TEST');
} catch (Exception $e){
echo $e->getMessage();
}

// for Customer

$task->setStatus(TaskStatus::STATUS_NEW);
assert($task->getAvailableActions(true) == TaskStatus::ACTION_CANCEL, 'customer status new');
$task->setStatus(TaskStatus::STATUS_IN_PROGRESS);
assert($task->getAvailableActions(true) == TaskStatus::ACTION_IS_DONE, 'customer status new');
$task->setStatus(TaskStatus::STATUS_IS_DONE);
assert($task->getAvailableActions(true) == null, 'customer status is done');
$task->setStatus(TaskStatus::STATUS_CANCELLED);
assert($task->getAvailableActions(true) == null, 'customer status cancelled');
$task->setStatus(TaskStatus::STATUS_FAILED);
assert($task->getAvailableActions(true) == null, 'customer status failed');

// for Executor

$task->setStatus(TaskStatus::STATUS_NEW);
assert($task->getAvailableActions(false) == TaskStatus::ACTION_RESPONSE, 'executor status new');
$task->setStatus(TaskStatus::STATUS_IN_PROGRESS);
assert($task->getAvailableActions(false) == TaskStatus::ACTION_REJECT, 'executor status in progress');
$task->setStatus(TaskStatus::STATUS_IS_DONE);
assert($task->getAvailableActions(false) == null, 'customer status is done');
$task->setStatus(TaskStatus::STATUS_CANCELLED);
assert($task->getAvailableActions(false) == null, 'customer status cancelled');
$task->setStatus(TaskStatus::STATUS_FAILED);
assert($task->getAvailableActions(false) == null, 'customer status failed');











