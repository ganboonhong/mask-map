<?php
namespace app\models;

use Yii;

class Github
{
    /**
     * Execute deploy script
     *
     * @return string
     */
    public function deploy(): string
    {
        return exec(Yii::$app->params['basePath'] . '/scripts/deploy.sh');
    }
}
