<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        header("Content-type: text/html; charset=utf-8");
        //查询条件
        $condition = '';
        $data_count = User::count($condition);
        $page_num = 5;
        $current_page = (int)$_GET["page"];

        //分页处理
        $pagination = Tools::pagination($data_count, $page_num, $current_page);

        //分页条件
        $limit = array("limit" => array("number" => $page_num, "offset" => $pagination->offset));
        //获取数据
        $list = User::find($limit);

        //结果展示
        foreach ($list as $item) {
            echo $item->id . ':' . $item->name . '<br/>';
        }
        //数字分页展示
        for ($i = 1; $i <= $pagination->maxPage; $i++) {
            echo "<a href='?page=$i'>$i</a> ";
        }
        //翻页展示
        echo "<a href='?page=1'>首页</a> ";
        echo "<a href='?page=$pagination->prePage'>上一页</a> ";
        echo "<a href='?page=$pagination->nextPage'>下一页</a> ";
        echo "<a href='?page=$pagination->maxPage'>尾页</a> ";
        //TODO 当前页为首页或尾页时A标签的状态处理
        die;
    }

    public function route404Action()
    {
        echo '404';
        die;
    }

}

