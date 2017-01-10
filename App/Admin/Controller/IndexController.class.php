<?php
namespace Admin\Controller;

class IndexController extends MyController
{
    public function index()
    {
        $this->display();
    }

    public function top()
    {
        $this->display();
    }

    public function left()
    {
        $info = D('Admin')->getButtons();
        $info = getFormat($info);
        $this->assign('info',$info);
        $this->display();
    }

    public function drag()
    {
        $this->display();
    }

    public function main()
    {
        $this->display();
    }
}