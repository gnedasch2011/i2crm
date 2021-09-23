<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string|null $name
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * Метод проверки на валидацию, когда сотрудник прикреплён только к одному отделу
     * @param $allUsers
     * @param $depId
     * @return bool
     */
    public static function involvementInThisDepartment($allUsers, $depId)
    {
        $res = true;

        foreach ($allUsers as $user) {
            $departsLink = $user->getUserDepartmetns()->all();
            $departsLink = ArrayHelper::getColumn($departsLink, 'id');

            if (is_array($departsLink) && count($departsLink) == 1) {
                if (isset($departsLink[0]) && $departsLink[0] == $depId) {
                    $res = false;
                }
                break;
            }
        }

        return $res;
    }


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
        UserDepartment::deleteAll(['id_user' => $this->id]);

        if ($this->userDepartmetns) {
            foreach ($this->userDepartmetns as $departmetnId) {
                $userDepartment = new UserDepartment();
                $userDepartment->id_departmen = $departmetnId;
                $userDepartment->id_user = $this->id;

                if ($userDepartment->validate()) {
                    $userDepartment->save();
                }

            }
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
            ['userDepartmetns', 'required', 'message' => 'Сотрудник должен быть прикреплён'],
            [['name'], 'string', 'max' => 45],
            [['name'], 'required', 'message' => 'Поле не может пустое'],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'userDepartmetns' => 'Отделы',
        ];
    }

    public function getUserDepartmetns()
    {
        return $this->hasMany(Department::className(), ['id' => 'id_departmen'])->viaTable('user_department', ['id_user' => 'id']);
    }

    public function getForSelectDepartment()
    {
        $departments = Department::find()->all();
        $res = ArrayHelper::map($departments, 'id', 'name');

        return $res;
    }

    public static function checkedDepartment($userId, $departmentId)
    {
        $checked = UserDepartment::find()->where(['and',
            [
                'id_user' => $userId,
                'id_departmen' => $departmentId
            ]

        ])->exists();

        return $checked;
    }

    public static function getAllUser()
    {
        $users = self::find()->all();
        $users = ArrayHelper::map($users, 'id', 'name');

        return $users ?? [];
    }

    public function getUserDepartment()
    {
        return $this->hasMany(Department::className(), ['id' => 'id_departmen'])->viaTable('user_department', ['id_user' => 'id']);
    }
}
