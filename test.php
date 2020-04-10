<?php

require_once 'TaskStatus.php';

$obj = new TaskStatus(1, null, 'account_customer');

assert($obj->getNextStatus(TaskStatus::ACTION_CANCEL) == TaskStatus::STATUS_CANCELLED, 'cancel action');
assert($obj->getNextStatus(TaskStatus::ACTION_SELECT) == TaskStatus::STATUS_IN_PROGRESS, 'select action');
assert($obj->getNextStatus(TaskStatus::ACTION_REJECT) == TaskStatus::STATUS_FAILED, 'reject action');
assert($obj->getNextStatus(TaskStatus::ACTION_IS_DONE) == TaskStatus::STATUS_IS_DONE, 'is done action');

// FOR CUSTOMER ACCOUNT TYPE

$obj->setStatus(TaskStatus::STATUS_NEW);
assert($obj->getAvailableActions() == TaskStatus::ACTION_CANCEL, 'customer status new');
$obj->setStatus(TaskStatus::STATUS_IN_PROGRESS);
assert($obj->getAvailableActions() == TaskStatus::ACTION_IS_DONE, 'customer status new');
$obj->setStatus(TaskStatus::STATUS_IS_DONE);
assert($obj->getAvailableActions() == null, 'customer status is done');
$obj->setStatus(TaskStatus::STATUS_CANCELLED);
assert($obj->getAvailableActions() == null, 'customer status cancelled');
$obj->setStatus(TaskStatus::STATUS_FAILED);
assert($obj->getAvailableActions() == null, 'customer status failed');

// FOR executor ACCOUNT TYPE

$obj = new TaskStatus(1, null, 'account_executor');
$obj->setStatus(TaskStatus::STATUS_NEW);
assert($obj->getAvailableActions() == TaskStatus::ACTION_RESPONSE, 'executor status new');
$obj->setStatus(TaskStatus::STATUS_IN_PROGRESS);
assert($obj->getAvailableActions() == TaskStatus::ACTION_REJECT, 'executor status in progress');
$obj->setStatus(TaskStatus::STATUS_IS_DONE);
assert($obj->getAvailableActions() == null, 'customer status is done');
$obj->setStatus(TaskStatus::STATUS_CANCELLED);
assert($obj->getAvailableActions() == null, 'customer status cancelled');
$obj->setStatus(TaskStatus::STATUS_FAILED);
assert($obj->getAvailableActions() == null, 'customer status failed');













