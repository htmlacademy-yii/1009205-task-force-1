<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_information".
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $birthday
 * @property string|null $about
 * @property string|null $skype
 * @property string|null $telegram
 * @property string|null $phone_number
 * @property string|null $avatar
 * @property string|null $address
 *
 * @property User $user
 */
class UserInformation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_information';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['birthday'], 'safe'],
            [['about'], 'string'],
            [['skype', 'telegram', 'phone_number'], 'string', 'max' => 45],
            [['avatar', 'address'], 'string', 'max' => 255],
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
            'birthday' => 'Birthday',
            'about' => 'About',
            'skype' => 'Skype',
            'telegram' => 'Telegram',
            'phone_number' => 'Phone Number',
            'avatar' => 'Avatar',
            'address' => 'Address',
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
