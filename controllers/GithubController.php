<?php
namespace app\controllers;

use app\models\Github;
use Yii;
use yii\web\Controller;

class GithubController extends Controller
{
    public function actionWebhook()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if ($data && $this->isPRMerged($data)) {
            Yii::info(json_encode($data));
            $github = new Github;
            $github->deploy();
        }
    }

    private function isPRMerged(array $data): bool
    {
        return
        isset($data['action']) && $data['action'] === 'closed'
        && isset($data['pull_request']['merged']) && $data['pull_request']['merged'] === true;
    }
}
