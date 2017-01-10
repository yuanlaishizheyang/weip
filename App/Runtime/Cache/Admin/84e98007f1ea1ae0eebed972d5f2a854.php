<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - 添加分类 </title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Public/Admin/styles/general.css" rel="stylesheet" type="text/css" />
<link href="/Public/Admin/styles/main.css" rel="stylesheet" type="text/css" />
<script src="/Public/Admin/js/jquery.js"></script>
</head>
<body>

<h1>
<span class="action-span"><a href="catelist.html">商品分类</a></span>
<span class="action-span1"><a href="#">ECSHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 添加分类 </span>
<div style="clear:both"></div>
</h1>

<div class="main-div">
  <form action="/Admin/Attribute/add" method="post" name="theForm" enctype="multipart/form-data">
  <table width="100%" id="general-table">
      <tr>
        <td class="label">属性名称:</td>
        <td>
          <input type='text' name='name' maxlength="20" value='' size='27' /> <font color="red">*</font>
        </td>
      </tr>
      <tr>
        <td class="label">所属商品类型:</td>
        <td>
          <select name="parent_id">
              <?php if(is_array($types)): $i = 0; $__LIST__ = $types;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol["id"]); ?>"><?php echo ($vol["type_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
          </select>
        </td>
      </tr>

      <tr>
        <td class="label">属性类型:</td>
        <td>
          <input type="radio" name="type" value="0"  checked="true"/> 唯一属性          <input type="radio" name="type" value="1"  /> 单选属性        </td>
      </tr>
      <tr>
        <td class="label">属性值录入方式:</td>
        <td>
          <input type="radio" name="in_method" value="0" checked="true" /> 手工录入           <input type="radio" name="in_method" value="1"   />列表选择       </td>
      </tr>

      <tr>
        <td class="label">可选值列表:</td>
        <td>
          <textarea name='list' disabled="true" rows="6" cols="35"></textarea>
        </td>
      </tr>
      <tr>
          <td></td>
          <td>
              <input class="submit" type="submit" value=" 确定 " />
              <input class="reset" type="reset" value=" 重置 " />
          </td>
      </tr>
      </table>
  </form>
</div>

<div id="footer">
共执行 3 个查询，用时 0.021687 秒，Gzip 已禁用，内存占用 2.081 MB<br />
版权所有 &copy; 2005-2010 上海商派网络科技有限公司，并保留所有权利。</div>
<script>
    $(function () {
        $('.reset').on('click',function(){
            $('form')[0].reset();
        });
        $('.submit').on('click',function(){
            $('form').submit();
        });
        $('input[name=in_method]').on('change',function(){
            if ($(this).val() == 0) {
                $('textarea[name=list]').val('').prop('disabled',true);
            } else {
                $('textarea[name=list]').prop('disabled',false);
            }
        });
    });
</script>
</body>
</html>