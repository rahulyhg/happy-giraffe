<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mikita
 * Date: 04/04/14
 * Time: 10:31
 * To change this template use File | Settings | File Templates.
 */

abstract class MailMessage
{
    abstract public function getTitle();
    abstract public function getBody();
}