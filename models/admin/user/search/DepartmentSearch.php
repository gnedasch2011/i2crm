<?php
namespace app\models\admin\user\search;

use app\models\Department;
use app\models\User;
use yii\data\ActiveDataProvider;

class DepartmentSearch extends \yii\base\Model
{
    public $name;


    public function rules()
    {
        return [
            [['name'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [

        ];
    }

    public function search($params)
    {

        $query = User::find();

        $this->load($params);
        $query->where(['user.id'=>$this->name]);
        $query->joinWith('userDepartment');

        return $query->all();

    }
}

