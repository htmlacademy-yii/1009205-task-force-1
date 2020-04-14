<?php

require_once 'TaskStatus.php';

$obj = new TaskStatus(1, null);

assert($obj->getNextStatus(TaskStatus::ACTION_CANCEL) == TaskStatus::STATUS_CANCELLED, 'cancel action');
assert($obj->getNextStatus(TaskStatus::ACTION_SELECT) == TaskStatus::STATUS_IN_PROGRESS, 'select action');
assert($obj->getNextStatus(TaskStatus::ACTION_REJECT) == TaskStatus::STATUS_FAILED, 'reject action');
assert($obj->getNextStatus(TaskStatus::ACTION_IS_DONE) == TaskStatus::STATUS_IS_DONE, 'is done action');

// for Customer

$obj->setStatus(TaskStatus::STATUS_NEW);
assert($obj->getAvailableActionsCustomer() == TaskStatus::ACTION_CANCEL, 'customer status new');
$obj->setStatus(TaskStatus::STATUS_IN_PROGRESS);
assert($obj->getAvailableActionsCustomer() == TaskStatus::ACTION_IS_DONE, 'customer status new');
$obj->setStatus(TaskStatus::STATUS_IS_DONE);
assert($obj->getAvailableActionsCustomer() == null, 'customer status is done');
$obj->setStatus(TaskStatus::STATUS_CANCELLED);
assert($obj->getAvailableActionsCustomer() == null, 'customer status cancelled');
$obj->setStatus(TaskStatus::STATUS_FAILED);
assert($obj->getAvailableActionsCustomer() == null, 'customer status failed');

// for Executor

$obj->setStatus(TaskStatus::STATUS_NEW);
assert($obj->getAvailableActionsExecutor() == TaskStatus::ACTION_RESPONSE, 'executor status new');
$obj->setStatus(TaskStatus::STATUS_IN_PROGRESS);
assert($obj->getAvailableActionsExecutor() == TaskStatus::ACTION_REJECT, 'executor status in progress');
$obj->setStatus(TaskStatus::STATUS_IS_DONE);
assert($obj->getAvailableActionsExecutor() == null, 'customer status is done');
$obj->setStatus(TaskStatus::STATUS_CANCELLED);
assert($obj->getAvailableActionsExecutor() == null, 'customer status cancelled');
$obj->setStatus(TaskStatus::STATUS_FAILED);
assert($obj->getAvailableActionsExecutor() == null, 'customer status failed');













