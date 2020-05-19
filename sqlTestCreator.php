<?php
require_once 'vendor/autoload.php';

use HtmlAcademy\Service\CsvToSqlConverter;

// table CATEGORY (no additional columns)
$path = 'C:\Users\alemu\Desktop\OpenServer\domains\1009205-task-force-1\data\category.csv';
$addColumns = [];
$addValues = [];
try {
    $result = new CsvToSqlConverter($path);
    $result->CsvParser();
    $result->getSqlFile($addColumns,$addValues);
} catch (Exception $e) {
    echo $e->getMessage();
}

// table CITIES (no additional columns)
$path = 'C:\Users\alemu\Desktop\OpenServer\domains\1009205-task-force-1\data\cities.csv';
$addColumns = [];
$addValues = [];
try {
    $result = new CsvToSqlConverter($path);
    $result->CsvParser();
    $result->getSqlFile($addColumns,$addValues);
} catch (Exception $e) {
    echo $e->getMessage();
}

// table USER (city_id column added)
$path = 'C:\Users\alemu\Desktop\OpenServer\domains\1009205-task-force-1\data\user.csv';
$addColumns = ['city_id'];
$addValues = [];

for($i =0; $i<20; ++$i) {
    $addValues[] = [mt_rand(1,1108)];
}
try {
    $result = new CsvToSqlConverter($path);
    $result->CsvParser();
    $result->getSqlFile($addColumns,$addValues);
} catch (Exception $e) {
    echo $e->getMessage();
}

// table USER_INFORMATION (user_id column added)
$path = 'C:\Users\alemu\Desktop\OpenServer\domains\1009205-task-force-1\data\user_information.csv';
$addColumns = ['user_id'];
$addValues = [];
$i = 0;
foreach (range(1, 20) as $num) {
    $addValues[] = [$num];
    $i++;
}
shuffle($addValues);
try {
    $result = new CsvToSqlConverter($path);
    $result->CsvParser();
    $result->getSqlFile($addColumns, $addValues);
} catch (Exception $e) {
    echo $e->getMessage();
}


// table USER_SPECIALIZATION (no columns added)
$path = 'C:\Users\alemu\Desktop\OpenServer\domains\1009205-task-force-1\data\user_specialization.csv';
$addColumns = [];
$addValues = [];

try {
    $result = new CsvToSqlConverter($path);
    $result->CsvParser();
    $result->getSqlFile($addColumns, $addValues);
} catch (Exception $e) {
    echo $e->getMessage();
}

// table TASK (customer_id,status columns added)
$path = 'C:\Users\alemu\Desktop\OpenServer\domains\1009205-task-force-1\data\task.csv';
$addColumns = ['customer_id','status'];
$addValues = [];
$statuses = ['new','cancelled','in_progress','is_done','failed'];
$i = 0;
foreach (range(1, 20) as $num) {
    $addValues[] = [$num,$statuses[mt_rand(0,4)]];
    $i++;
}
shuffle($addValues);
try {
    $result = new CsvToSqlConverter($path);
    $result->CsvParser();
    $result->getSqlFile($addColumns, $addValues);
} catch (Exception $e) {
    echo $e->getMessage();
}

// table TASK_RESPONSE (task_id,responded_user_id columns added)
$path = 'C:\Users\alemu\Desktop\OpenServer\domains\1009205-task-force-1\data\task_response.csv';
$addColumns = ['task_id','responded_user_id'];
$addValues = [];
$i = 0;
foreach (range(1, 21) as $num) {
    $addValues[] = [mt_rand(1,10),mt_rand(1,20)];
    $i++;
}
shuffle($addValues);
try {
    $result = new CsvToSqlConverter($path);
    $result->CsvParser();
    $result->getSqlFile($addColumns, $addValues);
} catch (Exception $e) {
    echo $e->getMessage();
}

// table TASK_REVIEW (task_id,responded_user_id columns added)
$path = 'C:\Users\alemu\Desktop\OpenServer\domains\1009205-task-force-1\data\task_review.csv';
$addColumns = ['task_id','executor_id'];
$addValues = [];
$i = 0;
foreach (range(1, 11) as $num) {
    $addValues[] = [mt_rand(1,10),mt_rand(1,20)];
    $i++;
}
shuffle($addValues);
try {
    $result = new CsvToSqlConverter($path);
    $result->CsvParser();
    $result->getSqlFile($addColumns, $addValues);
} catch (Exception $e) {
    echo $e->getMessage();
}
