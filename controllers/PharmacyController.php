<?php
namespace app\controllers;

use GuzzleHttp\Client;
use Yii;
use yii\web\Controller;

class PharmacyController extends Controller
{
    private $maskFile;
    private $storesFile;

    public function beforeAction($action)
    {
        $this->maskFile = Yii::getAlias('@webroot/assets/pharmacy/mask-stock.json');
        $this->storesFile = Yii::getAlias('@webroot/assets/pharmacy/stores.json');
        return parent::beforeAction($action);
    }

    public function actionMap()
    {
        $this->layout = 'pharmacy-map';
        return $this->render('map', []);
    }

    public function actionSync()
    {
        $client = new Client();
        $response = $client->get('http://data.nhi.gov.tw/Datasets/Download.ashx?rid=A21030000I-D50001-001&l=https://data.nhi.gov.tw/resource/mask/maskdata.csv');
        $csv = $response->getBody();

        $masks = array_map("str_getcsv", explode("\n", $csv));
        unset($masks[0]);

        $stores = json_decode(file_get_contents($this->storesFile), true);

        foreach ($masks as &$mask) {
            $storeId = $mask[0];
            $mask['geometry']['coordinates'] = @$stores[$storeId]['geometry']['coordinates'];
        }

        $fp = fopen($this->maskFile, 'w+');
        fwrite($fp, json_encode($masks));
        fclose($fp);

        return;
    }

    public function actionGetMap()
    {
        $result = json_decode(file_get_contents($this->maskFile));

        return Yii::createObject([
            'class' => 'yii\web\Response',
            'format' => \yii\web\Response::FORMAT_JSON,
            'data' => [
                'message' => $result,
                'code' => 200,
            ],
        ]);
    }
}
