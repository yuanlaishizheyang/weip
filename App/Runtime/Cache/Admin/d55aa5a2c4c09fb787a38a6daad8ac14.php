<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - 商品分类 </title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Public/Admin/styles/general.css" rel="stylesheet" type="text/css" />
<link href="/Public/Admin/styles/main.css" rel="stylesheet" type="text/css" />
</head>
<body>

<h1>
<span class="action-span"><a href="cateadd.html">添加分类</a></span>
<span class="action-span1"><a href="#">ECSHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 商品分类 </span>
<div style="clear:both"></div>
</h1>
<form method="post" action="" name="listForm">
<div class="list-div" id="listDiv">

<table width="100%" cellspacing="1" cellpadding="2" id="list-table">
  <tr>
    <th>管理员名称</th>
    <th>所属角色</th>
    <th>操作</th>
  </tr>
  <?php foreach($infos as $info):?>
  <input type="hidden" name="role_id" value="<?php echo $info['id']?>">
    <tr align="center" class="0" id="0_1" id = 'tr_1'>
      <td align="left" class="first-cell" style = 'padding-left="0"'>
        <?php echo $info['admin_name']?>
      </td>
      <td align="left" class="first-cell" style = 'padding-left="0"'>
        <?php echo $info['role_name']?>
      </td>
      <td width="24%" align="center">
        <a href="/Admin/Admin/update/id/<?php echo ($vol["id"]); ?>">编辑</a> |
        <a href="<?php echo U('delete',array('id'=>$info['id']))?>" title="移除">移除</a>
      </td>
    </tr>
  <?php endforeach?>
  </table>
</div>
</form>

<div id="footer">
共执行 1 个查询，用时 0.015927 秒，Gzip 已禁用，内存占用 1.999 MB<br />

版权所有 &copy; 2005-2010 上海商派网络科技有限公司，并保留所有权利
。</div>

</body>
</html>