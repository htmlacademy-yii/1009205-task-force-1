<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property int $category_id
 * @property int|null $city_id
 * @property string $title
 * @property int $customer_id
 * @property int|null $executor_id
 * @property string|null $description
 * @property string|null $address
 * @property int|null $budget
 * @property string|null $deadline
 * @property string|null $created_at
 * @property string $status
 * @property float|null $latitude
 * @property float|null $longitude
 *
 * @property Chat[] $chats
 * @property Category $category
 * @property Cities $city
 * @property User $customer
 * @property User $executor
 * @property TaskFiles[] $taskFiles
 * @property TaskResponse[] $taskResponses
 * @property TaskReview[] $taskReviews
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'title', 'customer_id', 'status'], 'required'],
            [['category_id', 'city_id', 'customer_id', 'executor_id', 'budget'], 'integer'],
            [['description'], 'string'],
            [['deadline', 'created_at'], 'safe'],
            [['latitude', 'longitude'], 'number'],
            [['title', 'address'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 45],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['city_id' => 'id']],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['executor_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['executor_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'city_id' => 'City ID',
            'title' => 'Title',
            'customer_id' => 'Customer ID',
            'executor_id' => 'Executor ID',
            'description' => 'Description',
            'address' => 'Address',
            'budget' => 'Budget',
            'deadline' => 'Deadline',
            'created_at' => 'Created At',
            'status' => 'Status',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
        ];
    }

    /**
     * Gets query for [[Chats]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChats()
    {
        return $this->hasMany(Chat::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
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
     * Gets query for [[Customer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(User::className(), ['id' => 'customer_id']);
    }

    /**
     * Gets query for [[Executor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExecutor()
    {
        return $this->hasOne(User::className(), ['id' => 'executor_id']);
    }

    /**
     * Gets query for [[TaskFiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaskFiles()
    {
        return $this->hasMany(TaskFiles::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[TaskResponses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaskResponses()
    {
        return $this->hasMany(TaskResponse::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[TaskReviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaskReviews()
    {
        return $this->hasMany(TaskReview::className(), ['task_id' => 'id']);
    }
}
