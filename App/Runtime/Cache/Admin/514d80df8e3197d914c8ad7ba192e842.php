<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - 商品列表 </title>
<meta name="robots" c>
<meta http-equiv="Content-Type" c />
<link href="/Public/Admin/styles/general.css" rel="stylesheet" type="text/css" />
<link href="/Public/Admin/styles/main.css" rel="stylesheet" type="text/css" />
<style>
  #page-table .first,#page-table .end,#page-table .next,#page-table .prev,#page-table .num{
    padding:4px;
    margin:2px;
    background-color:#99CCFF;
    border-radius:3px;
    text-decoration:none;
  }
  #page-table .current{
    padding:4px;
    margin:2px;
    border-radius:3px;
    background-color: #1bdb68;
  }
</style>
</head>
<body>

<h1>
<span class="action-span"><a href="/Admin/Type/add">添加新商品</a></span>
<span class="action-span1"><a href="#">ECSHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 商品列表 </span>
<div style="clear:both"></div>
</h1>

<div class="form-div">

  <form action="" name="searchForm">
    <img src="/Public/Admin/images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
      
    <select name="cat_id"><option value="0">所有分类</option><option value="1" >手机类型</option><option value="4" >&nbsp;&nbsp;&nbsp;&nbsp;3G手机</option><option value="5" >&nbsp;&nbsp;&nbsp;&nbsp;双模手机</option><option value="2" >&nbsp;&nbsp;&nbsp;&nbsp;CDMA手机</option><option value="3" >&nbsp;&nbsp;&nbsp;&nbsp;GSM手机</option><option value="12" >充值卡</option><option value="14" >&nbsp;&nbsp;&nbsp;&nbsp;移动手机充值卡</option><option value="15" >&nbsp;&nbsp;&nbsp;&nbsp;联通手机充值卡</option><option value="13" >&nbsp;&nbsp;&nbsp;&nbsp;小灵通/固话充值卡</option><option value="6" >手机配件</option><option value="11" >&nbsp;&nbsp;&nbsp;&nbsp;读卡器和内存卡</option><option value="7" >&nbsp;&nbsp;&nbsp;&nbsp;充电器</option><option value="8" >&nbsp;&nbsp;&nbsp;&nbsp;耳机</option><option value="9" >&nbsp;&nbsp;&nbsp;&nbsp;电池</option></select>

   
    <select name="brand_id"><option value="0">所有品牌</option><option value="1">诺基亚</option><option value="10">金立</option><option value="9">联想</option><option value="8">LG</option><option value="7">索爱</option><option value="6">三星</option><option value="5">夏新</option><option value="4">飞利浦</option><option value="3">多普达</option><option value="2">摩托罗拉</option><option value="11">  恒基伟业</option></select>

    
    <select name="intro_type"><option value="0">全部</option><option value="is_best">精品</option><option value="is_new">新品</option><option value="is_hot">热销</option><option value="is_promote">特价</option><option value="all_type">全部推荐</option></select>
         
     
      <select name="suppliers_id"><option value="0">全部</option><option value="1">北京供货商</option><option value="2">上海供货商</option></select>

            
      <select name="is_on_sale"><option value=''>全部</option><option value="1">上架</option><option value="0">下架</option></select>
      
    关键字 <input type="text" name="keyword" size="15" />
    <input type="submit" value=" 搜索 " class="button" />
  </form>
</div>
<form method="post" action="" name="listForm" >

  <div class="list-div" id="listDiv">
<table cellpadding="3" cellspacing="1">
  <tr>
    <th>
      <!--<input onclick='listTable.selectAll(this, "checkboxes")' type="checkbox" />-->
      <a>编号</a><img src="/Public/Admin/images/sort_desc.gif"/>    </th>

    <th><a>商品类型名称</a></th>
    <th><a>属性数</a></th>
        <th>操作</th>
  </tr>
  <?php if(is_array($typeInfo)): $key = 0; $__LIST__ = $typeInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($key % 2 );++$key;?><tr>
      <td><input type="checkbox" name="checkboxes[]" value="32" /><?php echo ($key+$pageSize*($nowPage-1)); ?></td>

      <td class="first-cell" style=""><span ><?php echo ($vol["type_name"]); ?></span></td>
      <td><span ><?php if($vol["type_id"] == null): ?>0<?php else: echo ($vol["count"]); endif; ?></span></td>
      <td align="center">
        <a href="/Admin/Attribute/lst/id/<?php echo ($vol["id"]); ?>">属性列表</a> |
        <a href="#">编辑</a> |
        <a href="#">移除</a>
      </td>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      </table>

<table id="page-table" cellspacing="0">
  <tr>
    <td align="right" nowrap="true">
      <?php echo ($show); ?>
    </td>
  </tr>

</table>
  </div>
</form>
<div id="footer">
共执行 7 个查询，用时 0.112141 秒，Gzip 已禁用，内存占用 3.085 MB<br />
版权所有 &copy; 2005-2010 上海商派网络科技有限公司，并保留所有权利。</div>
</body>
</html>