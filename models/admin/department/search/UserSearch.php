<?php
namespace app\models\admin\department\search;

class UserSearch extends \yii\base\Model
{
    public $city_from;
    public $date_from;


    public function rules()
    {
        return [
            [['date_from','city_from'], 'required'],
            ['city_from', 'integer'],
            ['date_from', 'date', 'format' => 'php:d.m.Y' ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'city_from' => Yii::t('module', 'SEARCH_CITY_START'),
            'date_from' => Yii::t('module', 'SEARCH_DATE_START'),
        ];
    }

    public function search($params)
    {

        $query = Flights::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if(!$this->validate()){
            /*$query->where('0=1');*/
            return $dataProvider;
        }

        $query->andFilterWhere(['>=', 'date_start', $this->date_from ? strtotime($this->date_from . ' 00:00:00') : null])
            ->andFilterWhere(['=', 'city_start_id', $this->city_from]);
        return $dataProvider;

    }
}

