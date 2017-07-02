<?php

namespace app\controllers;

use app\models\logic\IndexLogic;
use swoft\base\ApplicationContext;
use swoft\rpc\RpcClient;
use swoft\Swf;
use swoft\web\Controller;
use swoft\web\Request;
use swoft\web\Response;

/**
 *
 *
 * @uses      IndexController
 * @version   2017年04月25日
 * @author    stelin <phpcrazy@126.com>
 * @copyright Copyright 2010-2016 swoft software
 * @license   PHP Version 7.x {@link http://www.php.net/license/3_0.txt}
 */
class IndexController extends Controller
{
    /**
     * @Inject
     * @var IndexLogic
     */
    private $logic;

    public function actionIndex()
    {
        $data = $this->logic->getUser();
        $data['params'] = Swf::$app->params();
        $this->outputJson($data, 'suc');
    }

    public function actionLogin()
    {
        $this->outputJson(array('login suc'), 'suc');
    }

    public function actionHtml()
    {
        $data = [
            'name' => 'stelin'
        ];
        $this->render('/main/layout.html', $data);
    }

    public function actionRpc()
    {
        /* @var RpcClient $client*/
        $client = ApplicationContext::getBean('rpcClient');
        $data = $client->rpcCall(RpcClient::USER_SERVICE, '/inner/uri', []);
        $this->outputJson($data);
    }
}