<?php

namespace app\controllers\admin\user;

use app\models\admin\department\search\UserSearch;
use app\models\admin\user\search\DepartmentSearch;
use app\models\User;
use yii\web\Controller;

class SearchController extends Controller
{
    public function actionFindDepartment()
    {
        $searchModel = new DepartmentSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->post());

        return $this->render('department-search', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider ?? [],
        ]);
    }
}