<?php
/**
 * @var DefaultCommand $this
 * @var MailMessageDaily $message
 */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <!-- script for develop livereload -->
        <script src="//localhost:35729/livereload.js"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Заголовок</title>

    </head>
    <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="background: #f0f0f0;">
        <center>
            <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="border-collapse: collapse;background: #f0f0f0;font-size: 12px; font-family: arial, sans-serif; color: #333333">
                <tr>
                    <td height="20">
                        <img src="<?php echo Yii::app()->request->hostInfo; ?>/images/mail/blank.gif" height="20" width="100%" border="0" />
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="top">
                        <table border="0" cellpadding="0" cellspacing="0" width="710px" style="background: #fff;">

                            <tr>
                                <td valign="top" height="5px" colspan="3" style="font-size:0; line-height:0;">
                                    <img src="<?php echo Yii::app()->request->hostInfo; ?>/new/images/mail/mail-top-border.gif" width="100%" height="5px"/>
                                </td>
                            </tr>
                            <tr>
                                <td width="25">
                                    <img src="<?php echo Yii::app()->request->hostInfo; ?>/images/mail/blank.gif" height="1" width="25" border="0" />
                                </td>
                                <td>
                                    <!-  BEGIN TEMPLATE // -->
                                    <table border="0" cellpadding="0" cellspacing="0" width="660px" style="background: #fff;">
                                        <tr>
                                            <td align="center" valign="top">
                                                <!-  BEGIN HEADER // -->
                                                <table border="0" cellpadding="0" cellspacing="0" width="100%" >
                                                    <tr>
                                                        <td  height="17">
                                                            <img src="<?php echo Yii::app()->request->hostInfo; ?>/images/mail/blank.gif" height="17" width="100%" border="0" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top" align="center">
                                                            <a href="http://www.happy-giraffe.ru/?utm_source=email" target="_blank">
                                                                <img src="<?php echo Yii::app()->request->hostInfo; ?>/new/images/mail/mail-top-logo.png" width="221px" height="62px"/>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td  height="25" style="border-bottom: 1px solid #f1f4f7">
                                                            <img src="<?php echo Yii::app()->request->hostInfo; ?>/images/mail/blank.gif" height="25" width="100%" border="0" />
                                                        </td>
                                                    </tr>
                                                </table>
                                                <!-  // END HEADER -->
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td  height="25" style="">
                                                <img src="<?php echo Yii::app()->request->hostInfo; ?>/images/mail/blank.gif" height="25" width="100%" border="0" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="color: #333333; font-size: 16px;text-align:center;">Добрый день, {firstname}! В вашем профиле появились новые события </td>
                                        </tr>

                                        <tr>
                                            <td  height="35" style="">
                                                <img src="<?php echo Yii::app()->request->hostInfo; ?>/images/mail/blank.gif" height="35" width="100%" border="0" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" valign="top">
                                                <!--  BEGIN BODY // -->
                                                <!-- row icon -->
                                                <table style="width:100%;margin-bottom:35px;" cellpadding="0" cellspacing="0" border="0">
                                                    <tr>
                                                        <td  height="10" style="">
                                                            <img src="<?php echo Yii::app()->request->hostInfo; ?>/images/mail/blank.gif" height="10" width="30" border="0" />
                                                        </td>
                                                        <td align="center" valign="top">
                                                            <!-- icon -->
                                                            <a href="">
                                                                <table style="margin-bottom:5px;margin-left: 20px;" cellpadding="0" border="0" cellspacing="0" width="60" height="50" >
                                                                    <tr>
                                                                        <td background="<?php echo Yii::app()->request->hostInfo; ?>/new/images/mail/ico-messages.png" bgcolor="#ffffff" width="60" height="50" valign="top" align="right">
                                                                            <!--[if gte mso 9]>
                                                                                <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width:60px;height:50px;">
                                                                                    <v:fill type="tile" src="<?php echo Yii::app()->request->hostInfo; ?>/new/images/mail/ico-messages.png" color="#ffffff" />
                                                                                    <v:textbox inset="0,0,0,0">
                                                                            <![endif]-->
                                                                                <div>
                                                                                    <table style="margin: 2px 3px 0 5px;" cellpadding="0" cellspacing="0" border="0">
                                                                                        <tr>
                                                                                            <td align="right" style="color: #fff;">
                                                                                                <span style="padding: 1px 5px;border-radius: 10px; border: 2px solid #ffffff;background:#f84219;color:#ffffff;font-size:12px;line-height:14px;vertical-align:top; display:inline-block;">999</span>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </div>
                                                                            <!--[if gte mso 9]>
                                                                                    </v:textbox>
                                                                                </v:rect>
                                                                            <![endif]-->
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </a>
                                                            <table style="margin: 5px;" cellpadding="0" cellspacing="0" border="0">
                                                                <tr>
                                                                    <td align="center">
                                                                        <a href="" style="color: #4a89dc; text-decoration:underline;">Новые<br />сообщения</a>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td  height="10" style="">
                                                            <img src="<?php echo Yii::app()->request->hostInfo; ?>/images/mail/blank.gif" height="10" width="20" border="0" />
                                                        </td>
                                                        <td align="center" valign="top">
                                                            <!-- icon -->
                                                            <a href="">
                                                                <table style="margin-bottom:5px;margin-left: 20px;" cellpadding="0" cellspacing="0" width="60" height="50" border="0">
                                                                    <tr>
                                                                        <td background="<?php echo Yii::app()->request->hostInfo; ?>/new/images/mail/ico-friends.png" bgcolor="#ffffff" width="60" height="50" valign="top" align="right" >
                                                                            <!--[if gte mso 9]>
                                                                                <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width:60px;height:50px;">
                                                                                    <v:fill type="tile" src="<?php echo Yii::app()->request->hostInfo; ?>/new/images/mail/ico-friends.png" color="#ffffff" />
                                                                                    <v:textbox inset="0,0,0,0">
                                                                            <![endif]-->
                                                                                <div>
                                                                                    <table style="margin: 2px 3px 0 5px;" cellpadding="0" cellspacing="0" border="0">
                                                                                        <tr>
                                                                                            <td align="right" style="color: #fff;">
                                                                                                <span style="padding: 1px 5px;border-radius: 10px; border: 2px solid #ffffff;background:#f84219;color:#ffffff;font-size:12px;line-height:14px;vertical-align:top; display:inline-block;">79</span>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </div>
                                                                            <!--[if gte mso 9]>
                                                                                    </v:textbox>
                                                                                </v:rect>
                                                                            <![endif]-->
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </a>
                                                            <table style="margin: 5px;" cellpadding="0" cellspacing="0" border="0">
                                                                <tr>
                                                                    <td align="center">
                                                                        <a href="" style="color: #4a89dc; text-decoration:underline;">Хотят<br />дружить</a>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td  height="10" style="">
                                                            <img src="<?php echo Yii::app()->request->hostInfo; ?>/images/mail/blank.gif" height="10" width="20" border="0" />
                                                        </td>
                                                        <td align="center" valign="top">
                                                            <!-- icon -->
                                                            <a href="">
                                                                <table style="margin-bottom:5px;margin-left: 20px;" cellpadding="0" cellspacing="0" width="60" height="50" border="0">
                                                                    <tr>
                                                                        <td background="<?php echo Yii::app()->request->hostInfo; ?>/new/images/mail/ico-comment.png" bgcolor="#ffffff" width="60" height="50" valign="top" align="right">
                                                                            <!--[if gte mso 9]>
                                                                                <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width:60px;height:50px;">
                                                                                    <v:fill type="tile" src="<?php echo Yii::app()->request->hostInfo; ?>/new/images/mail/ico-comment.png" color="#ffffff" />
                                                                                    <v:textbox inset="0,0,0,0">
                                                                            <![endif]-->
                                                                                <div>
                                                                                    <table style="margin: 2px 3px 0 5px;" cellpadding="0" cellspacing="0" border="0">
                                                                                        <tr>
                                                                                            <td align="right" style="color: #fff;">
                                                                                                <span style="padding: 1px 5px;border-radius: 10px; border: 2px solid #ffffff;background:#f84219;color:#ffffff;font-size:12px;line-height:14px;vertical-align:top; display:inline-block;">9</span>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </div>
                                                                            <!--[if gte mso 9]>
                                                                                    </v:textbox>
                                                                                </v:rect>
                                                                            <![endif]-->
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </a>
                                                            <table style="margin: 5px;" cellpadding="0" cellspacing="0" border="0">
                                                                <tr>
                                                                    <td align="center">
                                                                        <a href="" style="color: #4a89dc; text-decoration:underline;">Новые<br />комментарии</a>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td  height="10" style="">
                                                            <img src="<?php echo Yii::app()->request->hostInfo; ?>/images/mail/blank.gif" height="10" width="20" border="0" />
                                                        </td>
                                                        <td align="center" valign="top">
                                                            <!-- icon -->
                                                            <a href="">
                                                                <table style="margin-bottom:5px;margin-left: 20px;" cellpadding="0" cellspacing="0" width="60" height="50" border="0">
                                                                    <tr>
                                                                        <td background="<?php echo Yii::app()->request->hostInfo; ?>/new/images/mail/ico-likes.png" bgcolor="#ffffff" width="60" height="50" valign="top" align="right" >
                                                                            <!--[if gte mso 9]>
                                                                                <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width:60px;height:50px;">
                                                                                    <v:fill type="tile" src="<?php echo Yii::app()->request->hostInfo; ?>/new/images/mail/ico-likes.png" color="#ffffff" />
                                                                                    <v:textbox inset="0,0,0,0">
                                                                            <![endif]-->
                                                                                <div>
                                                                                    <table style="margin: 2px 3px 0 5px;" cellpadding="0" cellspacing="0" border="0">
                                                                                        <tr>
                                                                                            <td align="right" style="color: #fff;">
                                                                                                <span style="padding: 1px 5px;border-radius: 10px; border: 2px solid #ffffff;background:#f84219;color:#ffffff;font-size:12px;line-height:14px;vertical-align:top; display:inline-block;">9</span>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </div>
                                                                            <!--[if gte mso 9]>
                                                                                    </v:textbox>
                                                                                </v:rect>
                                                                            <![endif]-->
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </a>
                                                            <table style="margin: 5px;" cellpadding="0" cellspacing="0" border="0">
                                                                <tr>
                                                                    <td align="center">
                                                                        <a href="" style="color: #4a89dc; text-decoration:underline;">Нравится</a>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td  height="10" style="">
                                                            <img src="<?php echo Yii::app()->request->hostInfo; ?>/images/mail/blank.gif" height="10" width="20" border="0" />
                                                        </td>
                                                        <td align="center" valign="top">
                                                            <!-- icon -->
                                                            <a href="">
                                                                <table style="margin-bottom:5px;margin-left: 20px;" cellpadding="0" cellspacing="0" width="60" height="50" border="0">
                                                                    <tr>
                                                                        <td background="<?php echo Yii::app()->request->hostInfo; ?>/new/images/mail/ico-favorites.png" bgcolor="#ffffff" width="60" height="50" valign="top" align="right" >
                                                                            <!--[if gte mso 9]>
                                                                                <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width:60px;height:50px;">
                                                                                    <v:fill type="tile" src="<?php echo Yii::app()->request->hostInfo; ?>/new/images/mail/ico-favorites.png" color="#ffffff" />
                                                                                    <v:textbox inset="0,0,0,0">
                                                                            <![endif]-->
                                                                                <div>
                                                                                    <table style="margin: 2px 3px 0 5px;" cellpadding="0" cellspacing="0" border="0">
                                                                                        <tr>
                                                                                            <td align="right" style="color: #fff;">
                                                                                                <span style="padding: 1px 5px;border-radius: 10px; border: 2px solid #ffffff;background:#f84219;color:#ffffff;font-size:12px;line-height:14px;vertical-align:top; display:inline-block;">+99</span>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </div>
                                                                            <!--[if gte mso 9]>
                                                                                    </v:textbox>
                                                                                </v:rect>
                                                                            <![endif]-->
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </a>
                                                            <table style="margin: 5px;" cellpadding="0" cellspacing="0" border="0">
                                                                <tr>
                                                                    <td align="center">
                                                                        <a href="" style="color: #4a89dc; text-decoration:underline;">В&nbsp;избранное</a>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td  height="10" style="">
                                                            <img src="<?php echo Yii::app()->request->hostInfo; ?>/images/mail/blank.gif" height="10" width="20" border="0" />
                                                        </td>


                                                        <!-- ico guest -->
                                                        <!-- <td align="center" valign="top"> -->
                                                            <!-- icon -->
                                                            <!-- <a href="">
                                                                <table style="margin-bottom:5px;margin-left: 20px;" cellpadding="0" cellspacing="0" width="60" height="50" border="0">
                                                                    <tr>
                                                                        <td background="<?php echo Yii::app()->request->hostInfo; ?>/new/images/mail/ico-guests.png" bgcolor="#ffffff" width="60" height="50" valign="top" align="right" > -->
                                                                            <!--[if gte mso 9]>
                                                                                <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width:60px;height:50px;">
                                                                                    <v:fill type="tile" src="<?php echo Yii::app()->request->hostInfo; ?>/new/images/mail/ico-guests.png" color="#ffffff" />
                                                                                    <v:textbox inset="0,0,0,0">
                                                                            <![endif]-->
                                                                                <!-- <div>
                                                                                    <table style="margin: 2px 3px 0 5px;" cellpadding="0" cellspacing="0" border="0">
                                                                                        <tr>
                                                                                            <td align="right" style="color: #fff;">
                                                                                                <span style="padding: 1px 5px;border-radius: 10px; border: 2px solid #ffffff;background:#f84219;color:#ffffff;font-size:12px;line-height:14px;vertical-align:top; display:inline-block;">0</span>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </div> -->
                                                                            <!--[if gte mso 9]>
                                                                                    </v:textbox>
                                                                                </v:rect>
                                                                            <![endif]-->
                                                                        <!-- </td>
                                                                    </tr>
                                                                </table>
                                                            </a>
                                                            <table style="margin: 5px;" cellpadding="0" cellspacing="0" border="0">
                                                                <tr>
                                                                    <td align="center">
                                                                        <span style="color: #999999;">У вас <br />были гости</span>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td> -->


                                                        <td  height="10" style="">
                                                            <img src="<?php echo Yii::app()->request->hostInfo; ?>/images/mail/blank.gif" height="10" width="30" border="0" />
                                                        </td>
                                                    </tr>
                                                </table>
                                                <!-- /row icon -->

                                                <table style="width:100%;margin-bottom:30px;" cellpadding="0" cellspacing="0" border="0">
                                                    <tr>
                                                        <td  height="10" style="">
                                                            <img src="<?php echo Yii::app()->request->hostInfo; ?>/images/mail/blank.gif" height="10" width="30" border="0" />
                                                        </td>
                                                    </tr>
                                                    <!-- Row articles -->
                                                     <tr>
                                                         <td style="width:320px; " valign="top" >
                                                             <!-- article -->
                                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom:5px; border: 1px solid #f5f5f5;">
                                                                <tr>
                                                                    <td style="padding: 10px 15px 5px;">
                                                                        <table cellpadding="0" cellspacing="0" border="0" style="margin-bottom:5px;">
                                                                             <tr>
                                                                                <td valign="top" rowspan="2" style="padding-right: 10px;" >
                                                                                    <a href="" style="text-decoration:none;"><img src="http://img.happy-giraffe.ru/thumbs/40x40/16534/avadc351ca462c38e06b9b748f0547ef1c9.jpg" style="border: 0;display:block;-moz-border-radius:22px;-webkit-border-radius:22px;border-radius:22px;" /></a>
                                                                                </td>
                                                                                 <td valign="top">
                                                                                     <a href="" style="color:#38a5f4;font:12px arial, helvetica, sans-serif; text-decoration:none;">Ангелина Богоявленская</a>
                                                                                 </td>
                                                                             </tr>
                                                                             <tr>
                                                                                 <td valign="top">
                                                                                    <!-- bg зависит от рубрики -->
                                                                                     <a href="" style="background: #f26748;padding:2px 6px; color: #ffffff;  font-weight:bold; font-size: 10px; font-family: 'Arial black', arial, tahoma; text-decoration:none;">РЕЦЕПТ ДНЯ</a>
                                                                                 </td>
                                                                             </tr>
                                                                         </table>
                                                                        <table cellpadding="0" cellspacing="0" border="0" width="100%"  style="margin-bottom:5px;" >
                                                                            <tr>
                                                                                <td>
                                                                                    <a href="" target="_blank" style="color:#186fb8;font:bold 25px/28px arial, helvetica, sans-serif;letter-spacing:-0.5px;text-decoration:underline;">Пельмени-розочки по ленивому</a>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <table cellpadding="0" cellspacing="0" border="0" width="100%" >
                                                                            <tr>
                                                                                <td style="margin-bottom:5px;">
                                                                                    <!--  -->
                                                                                    <a href="" target="_blank" style="text-decoration: none;"><img src="<?php echo Yii::app()->request->hostInfo; ?>/images/mail/img_01.jpg" width="318" border="0" style="display:block;" /></a>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 0px 15px 15px;">

                                                                         <table cellpadding="0" cellspacing="0" border="0" style="margin-top:20px;margin-left:5px;" width="">
                                                                             <tr>
                                                                                 <td style="padding-right:10px;" rowspan="2">
                                                                                     <img src="<?php echo Yii::app()->request->hostInfo; ?>/new/images/mail/ico-cook-book.jpg" style="margin-right:5px;vertical-align:top;">
                                                                                 </td>
                                                                                 <td align="center" style="color: #333333; font-size: 12px;" colspan="2">
                                                                                     Добавили в кулинарную книгу
                                                                                 </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <img src="<?php echo Yii::app()->request->hostInfo; ?>/images/mail/ava.jpg" style="-moz-border-radius:12px;-webkit-border-radius:12px;border-radius:12px;" />
                                                                                    <img src="<?php echo Yii::app()->request->hostInfo; ?>/images/mail/ava.jpg" style="-moz-border-radius:12px;-webkit-border-radius:12px;border-radius:12px;" />
                                                                                    <img src="<?php echo Yii::app()->request->hostInfo; ?>/images/mail/ava.jpg" style="-moz-border-radius:12px;-webkit-border-radius:12px;border-radius:12px;" />
                                                                                    <img src="<?php echo Yii::app()->request->hostInfo; ?>/images/mail/ava.jpg" style="-moz-border-radius:12px;-webkit-border-radius:12px;border-radius:12px;" />
                                                                                    <img src="<?php echo Yii::app()->request->hostInfo; ?>/images/mail/ava.jpg" style="-moz-border-radius:12px;-webkit-border-radius:12px;border-radius:12px;" />
                                                                                     
                                                                                </td>
                                                                                <td style="color: #333333; font-size: 12px; padding-left: 4px;">
                                                                                     еще 113
                                                                                </td>
                                                                             </tr>
                                                                         </table>
                                                                 
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                             
                                                         </td>
                                                         <td height="100%" width="20">
                                                             <img src="<?php echo Yii::app()->request->hostInfo; ?>/images/mail/blank.gif" width="20" height="100%" border="0" />
                                                         </td>

                                                         <td style="width:320px; " valign="top" >
                                                             <!-- article -->
                                                            <?php $message->render('daily/horoscope', array('message' => $message, 'horoscope' => $message->horoscope)); ?>
                                                             
                                                         </td>                                      
                                                     </tr>
                                                     
                                                    <tr>
                                                        <td  height="20" style="">
                                                            <img src="<?php echo Yii::app()->request->hostInfo; ?>/images/mail/blank.gif" height="20" width="30" border="0" />
                                                        </td>
                                                    </tr>
                                                    <!-- Row articles -->
                                                    <tr>
                                                        <td  style="" colspan="3">
                                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#c2aee5">
                                                                <tr>
                                                                    <td style="padding: 10px 15px 0;">
                                                                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                                            <tr>
                                                                                <td>
                                                                                    <table cellpadding="0" cellspacing="0" border="0">
                                                                                        <tr>
                                                                                            <td valign="top" width="40">
                                                                                                <a href="" style="text-decoration:none;"><img src="http://img.happy-giraffe.ru/thumbs/40x40/16534/avadc351ca462c38e06b9b748f0547ef1c9.jpg" style="border: 0;display:block;-moz-border-radius:22px;-webkit-border-radius:22px;border-radius:22px;" /></a>
                                                                                            </td>

                                                                                            <td width="10">
                                                                                                <img src="<?php echo Yii::app()->request->hostInfo; ?>/images/mail/blank.gif" height="20" width="10" border="0" />
                                                                                            </td>
                                                                                            <td valign="top">
                                                                                                <a href="" style="color:#ffffff;font:12px arial, helvetica, sans-serif;text-decoration:none;">Ангелина Богоявленская</a>
                                                                                            </td>
                                                                                            <td valign="top" style="padding:2px 5px;">
                                                                                                <!-- bg зависит от рубрики -->
                                                                                                <a href="" style="background: #50b347;padding:2px 6px; color: #ffffff;  font-weight:bold; font-size: 10px; font-family: 'Arial black', arial, tahoma; text-decoration:none;">НАШ ДОМ</a>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center">
                                                                        <a href="" target="_blank" style="color:#ffffff;font:bold 34px/38px arial, helvetica, sans-serif;text-decoration:none;">Cоветы для ремонта кухни</a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 10px 0 18px;">
                                                                        <a href="" style="border: 0;">
                                                                            <!--
                                                                                Ширина 660пк, высота пропорциональна исходнику

                                                                                Водяной знак
                                                                                Поверх изображения нужно накладывать
                                                                                /new/images/mail/water-mark.png  151*151px
                                                                                По центру вертикали и горизонтали изображения
                                                                                Текст
                                                                                font-family:Arial;
                                                                                font-size: 18px;
                                                                                color: #333333;
                                                                                Отступ от верха водяного знака 113px.
                                                                                По ширине по центру
                                                                            -->
                                                                            <img src="<?php echo Yii::app()->request->hostInfo; ?>/new/images/mail/img-w660-h320.jpg" alt="" style="border: 0;"/>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 0 20px 20px;">
                                                                        <table cellpadding="0" cellspacing="0" border="0" width="100%" >
                                                                            <tr>
                                                                                <td>
                                                                                    <table cellpadding="0" cellspacing="0" border="0">
                                                                                        <tr>
                                                                                            <td style="padding-right:10px;">
                                                                                                <span style="color:#ffffff;font:12px arial, helvetica, sans-serif;"><img src="<?php echo Yii::app()->request->hostInfo; ?>/new/images/mail/ico-views-white-small.png" style="margin-right:5px;vertical-align:top;">265</span>
                                                                                            </td>
                                                                                            <td style="padding-right:2px;">
                                                                                                <a href="" target="_blank" style="color:#ffffff;font:12px arial, helvetica, sans-serif;text-decoration:none;"><img src="<?php echo Yii::app()->request->hostInfo; ?>/new/images/mail/ico-comments-small.png" style="margin-right:5px;vertical-align:top;"></a>
                                                                                            </td>
                                                                                            <td>
                                                                                                <img src="<?php echo Yii::app()->request->hostInfo; ?>/images/mail/ava.jpg" style="-moz-border-radius:12px;-webkit-border-radius:12px;border-radius:12px;" />
                                                                                                <img src="<?php echo Yii::app()->request->hostInfo; ?>/images/mail/ava.jpg" style="-moz-border-radius:12px;-webkit-border-radius:12px;border-radius:12px;" />
                                                                                                <img src="<?php echo Yii::app()->request->hostInfo; ?>/images/mail/ava.jpg" style="-moz-border-radius:12px;-webkit-border-radius:12px;border-radius:12px;" />
                                                                                                <img src="<?php echo Yii::app()->request->hostInfo; ?>/images/mail/ava.jpg" style="-moz-border-radius:12px;-webkit-border-radius:12px;border-radius:12px;" />
                                                                                                <img src="<?php echo Yii::app()->request->hostInfo; ?>/images/mail/ava.jpg" style="-moz-border-radius:12px;-webkit-border-radius:12px;border-radius:12px;" />

                                                                                            </td>
                                                                                            <td style="color: #333333; font-size: 12px; padding-left: 4px;">
                                                                                                еще 113
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </td>
                                                                                <td align="right">
                                                                                    <table border="0" cellpadding="0" cellspacing="0" style="background-color:#2ea0f7; border-radius:4px;">
                                                                                        <tr>
                                                                                            <td align="center" valign="middle" style="color:#ffffff; font-size:16px;  line-height:150%; padding-top:5px; padding-right:15px; padding-bottom:5px; padding-left:15px;">
                                                                                                <a href="" target="_blank" style="color:#ffffff; text-decoration:none;">Смотреть галерею</a>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td  height="25" style="">
                                                            <img src="<?php echo Yii::app()->request->hostInfo; ?>/images/mail/blank.gif" height="25" width="30" border="0" />
                                                        </td>
                                                    </tr>
                                                    <!-- Row articles -->
                                                     <tr>

                                                         <td style="width:320px; " valign="top" >

                                                            <?php $message->render('daily/post'); ?>
                                                             
                                                         </td>    
                                                         <td height="100%" width="20">
                                                             <img src="<?php echo Yii::app()->request->hostInfo; ?>/images/mail/blank.gif" width="20" height="100%" border="0" />
                                                         </td>
                                                         <td style="width:320px; " valign="top" >

                                                             <?php $message->render('daily/post'); ?>
                                                             
                                                         </td>                                  
                                                     </tr>

                                                    <tr>
                                                        <td  height="20" style="">
                                                            <img src="<?php echo Yii::app()->request->hostInfo; ?>/images/mail/blank.gif" height="20" width="30" border="0" />
                                                        </td>
                                                    </tr>
                                                    <!-- Row articles -->
                                                     <tr>
                                                         <td style="width:320px; " valign="top" >

                                                             <?php $message->render('daily/post'); ?>
                                                             
                                                         </td>    
                                                         <td height="100%" width="20">
                                                             <img src="<?php echo Yii::app()->request->hostInfo; ?>/images/mail/blank.gif" width="20" height="100%" border="0" />
                                                         </td> 

                                                         <td style="width:320px; " valign="top" >

                                                             <?php $message->render('daily/post'); ?>
                                                             
                                                         </td>                                 
                                                     </tr>

                                                    <tr>
                                                        <td  height="20" style="">
                                                            <img src="<?php echo Yii::app()->request->hostInfo; ?>/images/mail/blank.gif" height="20" width="30" border="0" />
                                                        </td>
                                                    </tr>
                                                 </table>
                                                 
                                
                                                <!--  // END BODY -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" valign="top">
                                                <!-  BEGIN FOOTER // -->
                                                <table border="0" cellpadding="0" cellspacing="0" width="100%" >
                                                    <tr>
                                                        <td style="font:13px arial, helvetica, sans-serif;color:#232323;line-height:16px;padding-bottom:17px;">
                                                            С наилучшими пожеланиями,<br/>
                                                            <span style="color: #3587ec;"><a href="http://www.happy-giraffe.ru/?utm_source=email" target="_blank" style="color: #3587ec;">Веселый Жираф</a></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="border-top:1px solid #e6e5e5;padding:6px 0;">

                                                            <p style="font:10px tahoma, arial, sans-serif; color: #979696;">Это письмо было сгенерированно автоматически. Пожалуйста не отвечайте на него. Если вы хотите обратиться в службу поддержки сайта «Веселый Жираф», напишите нам по адресу <span style=" color: #3587ec;"><a href="mailto:info@happy-giraffe.ru" target="_blank" style="color: #3587ec;">info@happy-giraffe.ru</a></span><br/>
                                                            <p style="font:10px tahoma, arial, sans-serif; color: #979696;">Вы получили это письмо, так как являетесь пользователем сайта "Веселый Жираф". <a href="{unsubscribe}" target="_blank" style="color: #3587ec;">Отписаться от рассылки</a></p>
                                                            <p style="font:10px tahoma, arial, sans-serif; color: #979696;">{accountcontactinfo}</p>
                                                            <br/>
                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td  height="10" style="">
                                                            <img src="<?php echo Yii::app()->request->hostInfo; ?>/images/mail/blank.gif" height="10" width="100%" border="0" />
                                                        </td>
                                                    </tr>
                                                </table>
                                                <!-  // END FOOTER -->
                                            </td>
                                        </tr>
                                    </table>
                                    <!-  // END TEMPLATE -->
                                </td>
                                <td width="25">
                                    <img src="<?php echo Yii::app()->request->hostInfo; ?>/images/mail/blank.gif" height="1" width="25" border="0" />
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td  height="30">
                        <img src="<?php echo Yii::app()->request->hostInfo; ?>/images/mail/blank.gif" height="30" width="100%" border="0" />
                    </td>
                </tr>
            </table>
        </center>
    </body>
</html>