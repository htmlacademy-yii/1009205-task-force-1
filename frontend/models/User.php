<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $registered_at
 * @property int $city_id
 *
 * @property ChatMessage[] $chatMessages
 * @property Task[] $tasks
 * @property Task[] $tasks0
 * @property TaskResponse[] $taskResponses
 * @property TaskReview[] $taskReviews
 * @property Cities $city
 * @property UserFavorites[] $userFavorites
 * @property UserFavorites[] $userFavorites0
 * @property User[] $favorites
 * @property User[] $users
 * @property UserInformation[] $userInformations
 * @property UserSettings[] $userSettings
 * @property UserSpecialization[] $userSpecializations
 * @property Category[] $categories
 * @property UserTasksdonePhoto[] $userTasksdonePhotos
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'password', 'city_id'], 'required'],
            [['registered_at'], 'safe'],
            [['city_id'], 'integer'],
            [['name', 'email', 'password'], 'string', 'max' => 45],
            [['email'], 'unique'],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'registered_at' => 'Registered At',
            'city_id' => 'City ID',
        ];
    }

    /**
     * Gets query for [[ChatMessages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChatMessages()
    {
        return $this->hasMany(ChatMessage::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['customer_id' => 'id']);
    }

    /**
     * Gets query for [[Tasks0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks0()
    {
        return $this->hasMany(Task::className(), ['executor_id' => 'id']);
    }

    /**
     * Gets query for [[TaskResponses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaskResponses()
    {
        return $this->hasMany(TaskResponse::className(), ['responded_user_id' => 'id']);
    }

    /**
     * Gets query for [[TaskReviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaskReviews()
    {
        return $this->hasMany(TaskReview::className(), ['executor_id' => 'id']);
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }

    /**
     * Gets query for [[UserFavorites]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserFavorites()
    {
        return $this->hasMany(UserFavorites::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[UserFavorites0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserFavorites0()
    {
        return $this->hasMany(UserFavorites::className(), ['favorite_id' => 'id']);
    }

    /**
     * Gets query for [[Favorites]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFavorites()
    {
        return $this->hasMany(User::className(), ['id' => 'favorite_id'])->viaTable('user_favorites', ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('user_favorites', ['favorite_id' => 'id']);
    }

    /**
     * Gets query for [[UserInformations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserInformations()
    {
        return $this->hasMany(UserInformation::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[UserSettings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserSettings()
    {
        return $this->hasMany(UserSettings::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[UserSpecializations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserSpecializations()
    {
        return $this->hasMany(UserSpecialization::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Categories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable('user_specialization', ['user_id' => 'id']);
    }

    /**
     * Gets query for [[UserTasksdonePhotos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserTasksdonePhotos()
    {
        return $this->hasMany(UserTasksdonePhoto::className(), ['user_id' => 'id']);
    }
}
