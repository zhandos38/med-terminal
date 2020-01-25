<?php
/**
 * Created by PhpStorm.
 * User: Zhandos
 * Date: 11.11.2019
 * Time: 22:37
 */

namespace app\controllers;


use app\models\Employee;
use app\models\Rating;
use yii\helpers\VarDumper;
use yii\web\Controller;

class EmployeeController extends Controller
{
    public function actionIndex()
    {
        $this->layout = 'index';
        return $this->render('index');
    }

    public function actionList($id)
    {
        $models = Employee::find()->where(['type' => $id])->all();
        return $this->render('list', ['models' => $models]);
    }

    public function actionView($id)
    {
        $model = Employee::findOne(['id' => $id]);
        $rating = new Rating();

        if ($rating->load(\Yii::$app->request->post())) {
            $rating->employee_id = $id;
            $rating->save();

            $rating = new Rating();
        }

        return $this->render('view', [
            'model' => $model,
            'ratingModel' => $rating
        ]);
    }
}