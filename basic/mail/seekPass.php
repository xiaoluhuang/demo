<p>亲爱的<?= $admin_user?>,您好:</p>
<p>您的找回密码链接如下:</p>
<?php $url = Yii::$app->urlManager->createAbsoluteUrl([
    'admin/manage/mailchangepass','timestamp'=> $time,
    'admin_user' => $admin_user,
    'token' => $token
]);?>

<p><a href="<?= $url?>"><?= $url?></a> </p>
<p>该链接5分钟内有效</p>
<p>该邮件为系统自动发送,请勿回复!</p>