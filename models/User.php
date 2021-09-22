<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string|null $name
 */
class User extends \yii\db\ActiveRecord
{
    public $userDepartmetns;

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'afterSave',
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterSave',
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        foreach ($this->userDepartmetns as $departmetnId) {
            $department = Department::findOne($departmetnId);
            $this->link('userDepartmetns', $department);
        }

        return true;
    }

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
            [['name'], 'string', 'max' => 45],
            [['userDepartmetns'], 'safe'],
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
        ];
    }

    public function getUserDepartmetns()
    {
        return $this->hasMany(Department::className(), ['id' => 'id_departmen'])->viaTable('user_department', ['id_user' => 'id']);
    }
}