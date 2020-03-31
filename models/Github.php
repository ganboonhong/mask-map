<?php
namespace app\models;

use Yii;

class Github
{
    /**
     * Execute deploy script
     *
     * @return void
     */
    public function deploy(): void
    {
        exec(Yii::$app->params['basePath'] . '/scripts/deploy.sh');
    }
}
