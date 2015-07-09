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

    public function ajax_aAction(){
        //暂停 1 秒
        sleep(1);
        echo '第一模块异步显示';
        $this->view->disable();
    }

    public function ajax_bAction(){
        //暂停 1 秒
        sleep(1);
        echo '第二模块异步显示';
        $this->view->disable();
    }

    public function ajax_cAction(){
        //暂停 1 秒
        sleep(1);
        echo '第三模块异步显示';
        $this->view->disable();
    }

    public function ajax_dAction(){
        //暂停 1 秒
        sleep(1);
        echo '第四模块异步显示';
        $this->view->disable();
    }
}