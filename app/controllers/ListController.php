<?php
/**
 * Created by PhpStorm.
 * User: zhanghe
 * Date: 15-7-9
 * Time: 下午9:16
 */

class ListController extends ControllerBase {
    public function indexAction(){
        $this->view->setVar('model_a', '第一模块渲染显示');
        $this->view->setVar('model_b', '第二模块渲染显示');
        $this->view->setVar('model_c', '第三模块渲染显示');
        $this->view->setVar('model_d', '第四模块渲染显示');
    }
}