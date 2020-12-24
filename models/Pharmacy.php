<?php
namespace app\models;

use GuzzleHttp\Client;
use Yii;

class Pharmacy
{
    private $maskFile;
    private $storesFile;

    public function __construct()
    {
        $webroot = Yii::$app->params['basePath'] . '/web/';
        $this->maskFile = $webroot . 'static/pharmacy/mask-stock.json';
        $this->storesFile = $webroot . 'static/pharmacy/stores.json';
    }

    /**
     * sync mask data from authority API
     */
    public function sync()
    {
        $data = $this->fetchMaskData();
        if (!$data) {
            return;
        }
        // testing drone by pushing a commit

        $data = $this->processData($data);

        $r = $this->updateMaskData($data);

        if (is_int($r)) {
            Yii::info('synced');
        }
        return $r;
    }

    /**
     * Process data before writing to file
     *
     * @param array $data
     * @return array
     */
    private function processData(array &$data): array
    {
        // remove title row from csv file
        unset($data[0]);

        return $data;
    }

    /**
     * Write latest data to file
     *
     * @param array $data
     */
    private function updateMaskData(array $data)
    {
        $stores = json_decode(file_get_contents($this->storesFile), true);

        foreach ($data as &$mask) {
            $storeId = $mask[0];
            $mask['geometry']['coordinates'] = @$stores[$storeId]['geometry']['coordinates'];
        }

        $fp = fopen($this->maskFile, 'w+');
        $r = fwrite($fp, json_encode($data));
        fclose($fp);

        return $r;
    }

    /**
     * Fetch data from authority
     *
     * @return void
     */
    private function fetchMaskData(): ?array
    {
        $client = new Client();
        $response = $client->get('https://data.nhi.gov.tw/Datasets/Download.ashx?rid=A21030000I-D50001-001&l=https://data.nhi.gov.tw/resource/mask/maskdata.csv');

        if ($response->getStatusCode() !== 200) {
            Yii::error('Unable to fetch mask data from NHI', __METHOD__);
            return null;
        }
        $csv = $response->getBody();
        $maskData = array_map("str_getcsv", explode("\n", $csv));

        return $maskData;
    }
}
