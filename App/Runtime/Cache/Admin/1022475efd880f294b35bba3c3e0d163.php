<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="/Public/Admin/js/jquery.js"></script>
</head>
<body>
<!--<form action="/Admin/Test/test" method="post">
    <input type="text" name="text">
    <input type="password" name="password">
    <input type="number" name="number">
    <select name="select" id=""></select>
    <input type="radio" name="radio" value="">
    <input type="checkbox" name="checkbox">
    <textarea name="textarea" cols="30" rows="10"></textarea>
    <input type="file" name="file">
    <input type="submit">
</form>-->
<!--<input type="text" class="btn">-->
<input type="text" class="add">
<div>
    <input type="text" class="add">
</div>
<script>
//    console.log(a);
//    var a = 10;
//    function a(p) {
//        console.log(p);
////        var m = 1;
//    }
//    console.log(a);
//    $(function () {
        /*$('.btn').on('click',function(){
            var btn = $('<input type="text" class="add">');
            $('body').append(btn);
        });
//        $('.add').on('click',function(){
//            console.log('ok');
//        });
        $('body').on('click','.add',function(){
            console.log('ok');
        });*/
//        $('.btn').on('blur keydown',function (event) {
//            console.log(event);
//        });
//    });
//$('div').on('click','.add',function(){
//    console.log('ok');
//function t() {
//    console.log('ok3');
//}
//console.log(t);
//window.onload = t;
var str = 'fsdf<a href="http://www.baidu.com/">百度</a>sdff<a href="http://www.google.com">谷歌</a>fsdf';
var reg = /<a href="([^>]*)">.*<\/a>/g;
var res = reg.exec(str);
console.log(res);
//});
</script>
</body>
</html>