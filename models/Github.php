<?php
namespace app\models;

use Yii;

class Github
{
    public function deploy()
    {
        echo exec(Yii::$app->params['basePath'] . '/script/deploy.sh');
    }
}
