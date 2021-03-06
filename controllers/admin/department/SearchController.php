<?php

namespace app\controllers\admin\department;

use app\models\admin\department\search\UserSearch;
use app\models\User;
use yii\web\Controller;

class SearchController extends Controller
{
    public function actionFindUser()
    {
        $searchModel = new UserSearch();

        $dataProvider = $searchModel->search(\Yii::$app->request->post());

        return $this->render('user-search', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider??[],
        ]);
    }
}