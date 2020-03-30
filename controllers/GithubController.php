<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;

class GithubController extends Controller
{
    public function actionWebhook()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        Yii::info($data);
    }
}
