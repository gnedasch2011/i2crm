<?php
namespace app\models\admin\department\search;

use app\models\Department;
use yii\data\ActiveDataProvider;

class UserSearch extends \yii\base\Model
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

        $query = Department::find();

        $this->load($params);
  
        $query->where(['department.id'=>$this->name]);
        $query->joinWith('userDepartment');

        return $query->all();

    }
}

