<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_settings".
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $notification_task
 * @property int|null $notification_action
 * @property int|null $notification_new_review
 * @property int|null $profile_hidden
 * @property int|null $contacts_hidden
 *
 * @property User $user
 */
class UserSettings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'notification_task', 'notification_action', 'notification_new_review', 'profile_hidden', 'contacts_hidden'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'notification_task' => 'Notification Task',
            'notification_action' => 'Notification Action',
            'notification_new_review' => 'Notification New Review',
            'profile_hidden' => 'Profile Hidden',
            'contacts_hidden' => 'Contacts Hidden',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
