<?php
namespace app\controllers;

use app\models\Github;
use Yii;
use yii\web\Controller;

class GithubController extends Controller
{
    /**
     * Deploy to production when PR is merged
     *
     * @return void
     */
    public function actionWebhook(): void
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if ($data && $this->isPRMerged($data)) {
            Yii::info(json_encode($data));
            $github = new Github;
            $github->deploy();
        }
    }

    /**
     * Check whether the webhook event is a PR merge event
     *
     * @param array $data
     * @return boolean
     */
    private function isPRMerged(array $data): bool
    {
        return
        isset($data['action'])
        && $data['action'] === 'closed'
        && isset($data['pull_request']['merged'])
            && $data['pull_request']['merged'] === true;
    }
}
