<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_department".
 *
 * @property int $id_user
 * @property int $id_departmen
 */
class UserDepartment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_department';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'id_departmen'], 'required'],
            [['id_user', 'id_departmen'], 'integer'],
            ['id_user', 'unique', 'targetAttribute' => ['id_user', 'id_departmen']]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_user' => 'Id User',
            'id_departmen' => 'Id Departmen',
        ];
    }
}
