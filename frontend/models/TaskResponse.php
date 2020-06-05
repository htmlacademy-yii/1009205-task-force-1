<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "task_response".
 *
 * @property int $id
 * @property int $task_id
 * @property int $responded_user_id
 * @property string|null $message
 * @property string|null $responded_at
 *
 * @property Task $task
 * @property User $respondedUser
 */
class TaskResponse extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task_response';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'responded_user_id'], 'required'],
            [['task_id', 'responded_user_id'], 'integer'],
            [['message'], 'string'],
            [['responded_at'], 'safe'],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['task_id' => 'id']],
            [['responded_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['responded_user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'task_id' => 'Task ID',
            'responded_user_id' => 'Responded User ID',
            'message' => 'Message',
            'responded_at' => 'Responded At',
        ];
    }

    /**
     * Gets query for [[Task]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::className(), ['id' => 'task_id']);
    }

    /**
     * Gets query for [[RespondedUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRespondedUser()
    {
        return $this->hasOne(User::className(), ['id' => 'responded_user_id']);
    }
}
