<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "department".
 *
 * @property int $id
 * @property string|null $name
 */
class Department extends \yii\db\ActiveRecord
{

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_DELETE => 'beforeDelete',
        ];
    }

    public function beforeDelete()
    {

        $res = $this->deleteAllUsers();

        if ($res) {
            return parent::beforeDelete();
        } else {
            return false;
        }
    }

    public function deleteAllUsers()
    {
        $allUsers = $this->hasMany(User::className(), ['id' => 'id_user'])->viaTable('user_department', ['id_departmen' => 'id'])->all();

        $check = User::involvementInThisDepartment($allUsers, $this->id);

        if ($check) {
            $allUsersArray = ArrayHelper::getColumn($allUsers, 'id');

            if (is_bool($check)) {
                UserDepartment::deleteAll(['id_departmen' => $this->id, 'id_user' => $allUsersArray]);
                return true;
            }
        }

        return $check;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'department';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 45],
            [['name'], 'required'],
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

    /**
     * @return array
     */
    public static function getForSelectDepartment()
    {
        $departments = self::find()->all();
        $res = ArrayHelper::map($departments, 'id', 'name');

        return $res;
    }

    public function getUserDepartment()
    {
        return $this->hasMany(User::className(), ['id' => 'id_user'])->viaTable('user_department', ['id_departmen' => 'id']);
    }

}
