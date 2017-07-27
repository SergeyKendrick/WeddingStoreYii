<?php

namespace app\modules\admin;

/**
 * admin module definition class
 */
class Model extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * @inheritdoc
     */
    public $layout = '/admin';
    
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
