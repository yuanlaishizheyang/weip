<?php if (!defined('THINK_PATH')) exit();?><!-- $Id: goods_info.htm 17126 2010-04-23 10:30:26Z liuhui $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ECSHOP 管理中心 - 添加新商品 </title>
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="/Public/Admin/styles/general.css" rel="stylesheet" type="text/css"/>
    <link href="/Public/Admin/styles/main.css" rel="stylesheet" type="text/css"/>
    <script src="/Public/Admin/js/jquery.js"></script>
    <script type="text/javascript">
        function charea(a) {
            var spans = ['general', 'detail', 'mix'];
            for (i = 0; i < 3; i++) {
                var o = document.getElementById(spans[i] + '-tab');
                var tb = document.getElementById(spans[i] + '-table');
                o.className = o.id == a + '-tab' ? 'tab-front' : 'tab-back';
                tb.style.display = tb.id == a + '-table' ? 'block' : 'none';
            }

        }
    </script>
</head>
<body>

<h1>
    <span class="action-span"><a href="goods.php?act=list">商品列表</a></span>
    <span class="action-span1"><a href="index.php?act=main">ECSHOP 管理中心</a> </span><span id="search_id"
                                                                                         class="action-span1"> - 添加新商品 </span>
    <div style="clear:both"></div>
</h1>

<!-- start goods form -->
<div class="tab-div">
    <!-- tab bar -->
    <div id="tabbar-div">
        <p>
            <span class="tab-front" id="general-tab" onclick="charea('general');">通用信息</span>
            <span class="tab-back" id="detail-tab" onclick="charea('detail');">详细描述</span>
            <span class="tab-back" id="mix-tab" onclick="charea('mix');">其他信息</span>

        </p>
    </div>

    <!-- tab body -->
    <div id="tabbody-div">
        <form action="/Admin/Role/add" method="post" name="theForm">
            <!-- 最大文件限制 -->
            <input type="hidden" name="MAX_FILE_SIZE" value="2097152"/>
            <!-- 通用信息 -->
            <table width="90%" id="general-table" align="center">
                <tr>
                    <td class="label">角色名称：</td>
                    <td><input type="text" name="role_name" value="" style="float:left;color:;" size="30"/></td>
                </tr>
                <tr>
                    <td class="label">权限名称：</td>
                    <td>
                        <?php foreach($infos as $info):?>
                        <div class="box">
                            <input type="checkbox" class="parent" name="priv_id[]"
                                   value="<?php echo $info['id']?>"><?php echo str_repeat('--',$info['level']),$info['priv_name']?>
                            <div>
                                <?php foreach($info['child'] as $row):?>
                                <input type="checkbox" class="child" name="priv_id[]"
                                       value="<?php echo $row['id']?>"><?php echo str_repeat('--',$row['level']),$row['priv_name']?><br/>
                                <?php endforeach?>
                            </div>
                        </div>

                        <?php endforeach?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" value=" 确定 " class="button"/>
                        <input type="reset" value=" 重置 " class="reset"/>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<!-- end goods form -->
<script>
    //表单提交
    $(function () {
        $('.button').on('click', function () {
            $('form').submit();
        });
        $('.reset').on('click', function () {
            $('form')[0].reset();
        });
    });
    $(function () {
        $('.parent').on('change',function () {
            if ($(this).prop('checked')) {
                $(this).parent().find('.child').prop('checked',true);
            } else {
                $(this).parent().find('.child').prop('checked',false);
            }
        });
        $('.child').on('change',function () {
            var objChilds = $(this).parent().find('.child');
            var label = false;
            objChilds.each(function () {
                if ($(this).prop('checked')) {
                    label = true;
                }
            });
            if (label) {
                $(this).parent().prev().prop('checked',true);
            } else {
                $(this).parent().prev().prop('checked',false);
            }
        });
    });
</script>
</body>
</html>