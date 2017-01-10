<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ECSHOP 管理中心 - 商品列表 </title>
    <meta name="robots" c>
    <meta http-equiv="Content-Type" c/>
    <link href="/Public/Admin/styles/general.css" rel="stylesheet" type="text/css"/>
    <link href="/Public/Admin/styles/main.css" rel="stylesheet" type="text/css"/>
    <script src="/Public/Admin/js/jquery.js"></script>
</head>
<style>
    .modify {
        width: 160px;
    }

    .shop_price {
        width: 50px;
    }

    .first-cell {
        width: 80px;
    }
</style>
<body>

<h1>
    <span class="action-span"><a href="goodsadd.html">添加新商品</a></span>
    <span class="action-span1"><a href="#">ECSHOP 管理中心</a> </span><span id="search_id"
                                                                        class="action-span1"> - 商品列表 </span>
    <div style="clear:both"></div>
</h1>

<div class="form-div">

    <form action="" name="searchForm">
        <img src="/Public/Admin/images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH"/>

        <select name="cat_id">
            <option value="0">所有分类</option>
            <option value="1">手机类型</option>
            <option value="4">&nbsp;&nbsp;&nbsp;&nbsp;3G手机</option>
            <option value="5">&nbsp;&nbsp;&nbsp;&nbsp;双模手机</option>
            <option value="2">&nbsp;&nbsp;&nbsp;&nbsp;CDMA手机</option>
            <option value="3">&nbsp;&nbsp;&nbsp;&nbsp;GSM手机</option>
            <option value="12">充值卡</option>
            <option value="14">&nbsp;&nbsp;&nbsp;&nbsp;移动手机充值卡</option>
            <option value="15">&nbsp;&nbsp;&nbsp;&nbsp;联通手机充值卡</option>
            <option value="13">&nbsp;&nbsp;&nbsp;&nbsp;小灵通/固话充值卡</option>
            <option value="6">手机配件</option>
            <option value="11">&nbsp;&nbsp;&nbsp;&nbsp;读卡器和内存卡</option>
            <option value="7">&nbsp;&nbsp;&nbsp;&nbsp;充电器</option>
            <option value="8">&nbsp;&nbsp;&nbsp;&nbsp;耳机</option>
            <option value="9">&nbsp;&nbsp;&nbsp;&nbsp;电池</option>
        </select>


        <select name="brand_id">
            <option value="0">所有品牌</option>
            <option value="1">诺基亚</option>
            <option value="10">金立</option>
            <option value="9">联想</option>
            <option value="8">LG</option>
            <option value="7">索爱</option>
            <option value="6">三星</option>
            <option value="5">夏新</option>
            <option value="4">飞利浦</option>
            <option value="3">多普达</option>
            <option value="2">摩托罗拉</option>
            <option value="11"> 恒基伟业</option>
        </select>


        <select name="intro_type">
            <option value="0">全部</option>
            <option value="is_best">精品</option>
            <option value="is_new">新品</option>
            <option value="is_hot">热销</option>
            <option value="is_promote">特价</option>
            <option value="all_type">全部推荐</option>
        </select>


        <select name="suppliers_id">
            <option value="0">全部</option>
            <option value="1">北京供货商</option>
            <option value="2">上海供货商</option>
        </select>


        <select name="is_on_sale">
            <option value=''>全部</option>
            <option value="1">上架</option>
            <option value="0">下架</option>
        </select>

        关键字 <input type="text" name="keyword" size="15"/>
        <input type="submit" value=" 搜索 " class="button"/>
    </form>
</div>
<form method="post" action="" name="listForm">

    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th>
                    <input onclick='listTable.selectAll(this, "checkboxes")' type="checkbox"/>
                    <a href="#">编号</a><img src="/Public/Admin/images/sort_desc.gif"/></th>

                <th><a href="#">商品名称</a></th>
                <th><a href="#">货号</a></th>
                <th><a href="#">价格</a></th>
                <th><a href="#">上架</a></th>
                <th><a href="#">精品</a></th>
                <th><a href="#">新品</a></th>

                <th><a href="#">热销</a></th>
                <th><a href="#">推荐排序</a></th>
                <th><a href="#">库存</a></th>
                <th>操作</th>
                <?php foreach($infos as $info):?>
            </tr>
            <tr goods_id="<?php echo $info['id']?>">
                <td><input type="checkbox" name="checkboxes[]" value="32"/>1</td>

                <td class="first-cell modify" field="goods_name" style=""><?php echo $info['goods_name']?></td>
                <td class="modify" field="goods_sn"><?php echo $info['goods_sn']?></td>
                <td align="right" class="modify shop_price" field="shop_price"><?php echo $info['shop_price']?></td>
                <td align="center"><img onclick="isToggle(this,<?php echo $info['id']?>,'is_sale')"
                                        src="/Public/Admin/images/<?php if($info['is_sale']==0):?>no<?php else:?>yes<?php endif?>.gif"/>
                </td>
                <td align="center"><img onclick="isToggle(this,<?php echo $info['id']?>,'is_best')"
                                        src="/Public/Admin/images/<?php if($info['is_best']==0):?>no<?php else:?>yes<?php endif?>.gif"/>
                </td>
                <td align="center"><img onclick="isToggle(this,<?php echo $info['id']?>,'is_new')"
                                        src="/Public/Admin/images/<?php if($info['is_new']==0):?>no<?php else:?>yes<?php endif?>.gif"/>
                </td>
                <td align="center"><img onclick="isToggle(this,<?php echo $info['id']?>,'is_hot')"
                                        src="/Public/Admin/images/<?php if($info['is_hot']==0):?>no<?php else:?>yes<?php endif?>.gif"/>
                </td>

                <td align="center"><span>100</span></td>
                <td align="right"><span>1</span></td>
                <td align="center">
                    <a href="#" target="_blank" title="查看"><img src="/Public/Admin/images/icon_view.gif" width="16"
                                                                height="16" border="0"/></a>
                    <a href="#" title="编辑"><img src="/Public/Admin/images/icon_edit.gif" width="16" height="16" border="0"/></a>
                    <a href="#" title="复制"><img src="/Public/Admin/images/icon_copy.gif" width="16" height="16" border="0"/></a>
                    <a href="#" title="回收站"><img src="/Public/Admin/images/icon_trash.gif" width="16" height="16"
                                                 border="0"/></a>
                    <a href="#" title="货品列表"><img src="/Public/Admin/images/icon_docs.gif" width="16" height="16"
                                                  border="0"/></a></td>
            </tr>
            <?php endforeach?>
        </table>
    </div>
</form>
<script>
    function isToggle(o, goods_id, field) {
        var str = $(o).attr('src');
        var value = 0;
        if (str.indexOf('yes') == -1) {
            value = 1;
        }
        $.ajax({
            type: 'get',
            url: '<?php echo U('isToggle')?>',
            data: {goods_id: goods_id, field: field, value: value},
            cache: false,
            success: function (msg) {
                console.log(msg);
                if (msg > 0) {
                    if (value == 1) {
                        str = str.replace('no', 'yes');
                    } else {
                        str = str.replace('yes', 'no');
                    }
                    $(o).attr('src', str);
                }
            }
        });
    }
    $(function () {
        $('tr').delegate('.modify', 'dblclick', function (event) {
            if ($(this).children('input').length == 0) {
                var text = $(this).text();
                var objInput = $('<input type="text" >');
                objInput.width($(this).width()).css('border-width', '0px').css('font-size', '15px').css('font-weight', 'bold');
                objInput.val(text);
                $(this).html(objInput);
                objInput[0].focus();
                //获取id,字段
                goods_id = $(event.delegateTarget).attr('goods_id');
                field = $(this).attr('field');
            }
        });
        $('.modify').on('focus', 'input', function () {
            iniValue = $(this).val();
        });
        $('.modify').on('blur keydown', 'input', function (event) {
            if (event.type == 'blur' || event.keyCode == 13) {
                var o = $(this);
                var value = o.val();
                $.ajax({
                    type: 'get',
                    url: '<?php echo U('changeContent')?>',
                    data: {'goods_id': goods_id, 'field': field, 'value': value},
                    cache: false,
                    success: function (msg) {
                        if (msg > 0) {
                            //修改成功
                            $(o).parent().text(value);
                        } else {
                            //修改失败
                            $(o).parent().text(iniValue);
                        }
                    }
                });
            }
        });
    });
</script>
<div id="footer">
    共执行 7 个查询，用时 0.112141 秒，Gzip 已禁用，内存占用 3.085 MB<br/>
    版权所有 &copy; 2005-2010 上海商派网络科技有限公司，并保留所有权利。
</div>
</body>
</html>