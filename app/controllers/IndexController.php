<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        header("Content-type: text/html; charset=utf-8");
        //查询条件
        $condition = '';
        $count = User::count($condition);

        //分页处理
        $pageNumber = 5;
        $currentPage = (int)$_GET["page"];
        //处理最小页数
        $currentPage = $currentPage <= 0 ? 1 : $currentPage;
        //处理最大页数
        $maxPage = ceil($count / $pageNumber);
        $currentPage = $currentPage > $maxPage ? $maxPage : $currentPage;

        $offset = ($currentPage - 1) * $pageNumber;
        //上一页下一页
        $prePage = ($currentPage - 1) <= 0 ? 1 : ($currentPage - 1);
        $nextPage = ($currentPage + 1) > $maxPage ? $maxPage : ($currentPage + 1);
        //分页条件
        $limit = array("limit" => array("number" => $pageNumber, "offset" => $offset));
        //获取数据
        $list = User::find($limit);

        //结果展示
        foreach ($list as $item) {
            echo $item->id . ':' . $item->name . '<br/>';
        }
        //数字分页展示
        for ($i = 1; $i <= $maxPage; $i++) {
            echo "<a href='?page=$i'>$i</a> ";
        }
        //翻页展示
        echo "<a href='?page=1'>首页</a> ";
        echo "<a href='?page=$prePage'>上一页</a> ";
        echo "<a href='?page=$nextPage'>下一页</a> ";
        echo "<a href='?page=$maxPage'>尾页</a> ";
        //TODO 当前页为首页或尾页时A标签的状态处理
        die;
    }

    public function route404Action()
    {
        echo '404';
        die;
    }

}

