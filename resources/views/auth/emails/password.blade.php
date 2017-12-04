<?php 
$link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset());
$user = App\User::where('email',$user->getEmailForPasswordReset())->first();
$emailTemplate = App\EmailTemplate::where('name','password-reset')->first();


$placeholders = array('{username}','{action_url}');
$replacements = array($user->f_name, $link);
$str = $emailTemplate->email;
$newMessage =  str_replace($placeholders,$replacements,$str);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Nurtured For Living | {!! $emailTemplate->subject !!}</title>
<style type="text/css">

.btn {
    display: inline-block;
    padding: 6px 12px;
    font-size: 16px;
    font-weight: 400;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    cursor: pointer;
    border: 1px solid transparent;
    border-radius: 4px;
    color: #fff;
    background-color: #7A962B;
    text-decoration: none;
}

</style>
</head>

<body bgcolor="#ddd">
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ddd">
  <tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center">
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="400"></td>
                <td width="150">
                  <a href= "http://yourlink" target="_blank">
                    <img src="{{asset('/assets/frontend/images/emaillogo.jpg')}}" width="144" height="" border="0" alt=""/>
                  </a>
                </td>
                <td width="50"></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="20">
              <tr>
                <td width="10%">&nbsp;</td>
                <td width="80%" align="left" valign="top">
                  <font style="font-family: Verdana, Geneva, sans-serif; color:#666766; font-size:13px; line-height:21px">

                    {!! $newMessage !!}
                    <br/><br/>

                    <b>Nurtured For Living</b> <br/>
                    info@nurturedforliving.com<br/>
                    www.nurturedforliving.com
                  </font>
                </td>
                <td width="10%">&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td align="right" valign="top"></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
              	<td colspan="3" align="center">
		            <font style="font-family:'Myriad Pro', Helvetica, Arial, sans-serif; color:#231f20; font-size:8px">
		              <small>Nurtured For Living Ltd, PO box 69041, London, SW17 1FU | Tel: +44(0)203 371 1503 | <a href="mailto:info@nurturedforliving.com"  style="color:#010203; text-decoration:none">info@nurturedforliving.com</a></small></font>
		        </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><br/><br/></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
