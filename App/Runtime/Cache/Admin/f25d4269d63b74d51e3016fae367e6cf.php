<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script src="/Public/Admin/js/jquery.js"></script>
<head>
    <title>ECSHOP 管理中心 - 商品列表 </title>
    <meta name="robots" c>
    <meta http-equiv="Content-Type" c/>
    <link href="/Public/Admin/styles/general.css" rel="stylesheet" type="text/css"/>
    <link href="/Public/Admin/styles/main.css" rel="stylesheet" type="text/css"/>
</head>
<body>

<h1>
    <span class="action-span"><a href="goodsadd.html">添加新商品</a></span>
    <span class="action-span1"><a href="#">ECSHOP 管理中心</a> </span><span id="search_id"
                                                                        class="action-span1"> - 商品列表 </span>
    <div style="clear:both"></div>
</h1>

<div class="form-div">

    <form action="/Admin/Attribute/lst" name="searchForm">
        <img src="/Public/Admin/images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH"/>

        <select name="id">
            <option value="0">所有分类</option>
            <?php if(is_array($types)): $i = 0; $__LIST__ = $types;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option <?php if($vol["id"] == $id ): ?>selected<?php endif; ?> value="<?php echo ($vol["id"]); ?>"><?php echo ($vol["type_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
        </select>


    </form>
</div>
<form method="post" action="" name="listForm">

    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th>
                   <!-- <input onclick='listTable.selectAll(this, "checkboxes")' type="checkbox"/>-->
                    <a href="#">编号</a><img src="/Public/Admin/images/sort_desc.gif"/></th>

                <th><a href="#">属性名称</a></th>
                <th><a href="#">商品名称</a></th>
                <th><a href="#">属性类型</a></th>
                <th><a href="#">属性值录入方式</a></th>
                <th><a href="#">可选值列表</a></th>
            </tr>
            <?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
                    <td><?php echo ($vol["id"]); ?></td>

                    <td class="first-cell" style=""><span><?php echo ($vol["attr_name"]); ?></span></td>
                    <td><span><?php echo ($vol["type_name"]); ?></span></td>
                    <td align="right"><span><?php if($vol["attr_type"] === '0'): ?>唯一属性<?php elseif($vol["attr_type"] === '1'): ?>单一属性<?php else: endif; ?></span></td>
                    <td align="center"><span><?php if($vol["attr_input_type"] === '0'): ?>手工录入<?php elseif($vol["attr_input_type"] === '1'): ?>列表选择<?php else: endif; ?></span></td>
                    <td align="right"><span><?php echo ($vol["attr_value"]); ?></span></td>
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
    共执行 7 个查询，用时 0.112141 秒，Gzip 已禁用，内存占用 3.085 MB<br/>
    版权所有 &copy; 2005-2010 上海商派网络科技有限公司，并保留所有权利。
</div>
<script>
    $(function () {
        $('select[name=id]').on('change',function(){
            $('form[name=searchForm]').submit();
        });
    });
</script>
</body>
</html>