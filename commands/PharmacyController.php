<?php
namespace app\commands;

use app\models\Pharmacy;
use yii\console\Controller;
use yii\console\ExitCode;

class PharmacyController extends Controller
{
    /**
     * This command syncs the latest mask data from NHI
     * @return int Exit code
     */
    public function actionIndex()
    {
        $pharmacy = new Pharmacy;
        $pharmacy->sync();

        return ExitCode::OK;
    }
}
