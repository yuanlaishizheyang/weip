<?php
/**验证码验证
 * @param string $captcha
 * @return bool
 */
function checkCaptcha($captcha)
{
    $verify = new \Think\Verify();
    return $verify->check($captcha);
}
