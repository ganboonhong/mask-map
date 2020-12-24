<?php
namespace app\controllers;

use app\models\Pharmacy;
use Yii;
use yii\web\Controller;

class PharmacyController extends Controller
{
    public function actionMap()
    {
        $this->layout = 'pharmacy-map';

        return $this->render('map', []);
    }

    public function actionSync()
    {
        $pharmacy = new Pharmacy();
        $pharmacy->sync();

        return;
    }

    public function actionGetMap()
    {
        $maskFile = Yii::getAlias('@webroot/static/pharmacy/mask-stock.json');
        $result = json_decode(file_get_contents($maskFile));

        return Yii::createObject([
            'class' => 'yii\web\Response',
            'format' => \yii\web\Response::FORMAT_JSON,
            'data' => [
                'message' => $result,
                'code' => 200,
            ],
        ]);
    }

	public function actionGtm()
	{
        $this->layout = 'pharmacy-map';

        return $this->render('gtm', []);
	}
}
