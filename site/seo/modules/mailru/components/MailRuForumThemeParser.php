<?php
/**
 * Author: alexk984
 * Date: 17.10.12
 */
class MailRuForumThemeParser extends ProxyParserThread
{
    public $cookie = 'VID=3vjQa30CpM12; p=wFAAAM2c0QAA; mrcu=3D044FE31A915E22652EFA01060A; b=Kj0BAACxyw4AAAAC; odklmapi=$$14qtcq4M9IEnmSONbJcUdP=gvfq14qm/Dk/GPq+zDgrrn2; i=; Mpop=1352957939:547c707455794a5e19050219081d00041c0600024966535c465d0002020607160105701658514704041658565c5d1a454c:aiv45@mail.ru:; c=vk+bUAAAUMZnAAAjAgQAaAAAQOU4ARALAL4RYwAA';
    /**
     * @var MailruQuery
     */
    private $query;
    public $page = '';

    public function start()
    {
        while (true) {
            $this->getPage();

            while (!empty($this->page))
                $this->parsePage();

            $this->closeQuery();
        }
    }

    public function getPage()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('active', 0);
        $criteria->compare('type', MailruQuery::TYPE_THEME);
        $criteria->order = 'id desc';

        $transaction = Yii::app()->db_seo->beginTransaction();
        try {
            $this->query = MailruQuery::model()->find($criteria);
            if ($this->query === null)
                throw new Exception(101);

            $this->query->active = 1;
            $this->query->save();
            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollback();
        }

        $this->page = 1;
    }

    public function parsePage()
    {
        $content = $this->query($this->query->text.'&pg='.$this->page);
        if (strpos($content, 'http://deti.mail.ru/') === false) {
            $this->changeBadProxy();
            $this->parsePage();
        } else {
            if (strpos($content, iconv("UTF-8", "Windows-1251",'Нет такой страницы')) === false) {

                $document = phpQuery::newDocument($content);
                foreach ($document->find('td.comment div.t75.nowrap > a') as $link) {
                    $url = pq($link)->attr('href');
                    $name = pq($link)->text();
                    $this->addUser($url, $name);
                }
                $document->unloadDocument();

                $this->page++;
            }else
                $this->page = null;
        }
    }

    public function addUser($url, $name)
    {
        $transaction = Yii::app()->db_seo->beginTransaction();
        try {
            $user = new MailruUser();
            $user->deti_url = $url;
            $user->email = $user->calculateEmail();
            if (!empty($user->email) && MailruUser::model()->findByAttributes(array('email' => $user->email)) == null) {
                $user->name = trim(preg_replace("/  +/", " ", $name));
                $user->save();
            }
            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollback();
        }
    }

    private function closeQuery()
    {
        $this->query->active = 2;
        $this->query->save();
    }

    protected function query($url, $ref = null, $post = false, $attempt = 0)
    {
        if ($ch = curl_init($url)) {
            curl_setopt($ch, CURLOPT_USERAGENT, 'Opera/9.80 (Windows NT 6.1; WOW64; U; ru) Presto/2.10.289 Version/12.00');

            if (!empty($ref))
                curl_setopt($ch, CURLOPT_REFERER, $url);

            if ($this->use_proxy) {
                curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
                curl_setopt($ch, CURLOPT_PROXY, $this->proxy->value);
                if (getenv('SERVER_ADDR') != '5.9.7.81') {
                    curl_setopt($ch, CURLOPT_PROXYUSERPWD, "alexk984:Nokia12345");
                    curl_setopt($ch, CURLOPT_PROXYAUTH, 1);
                }
            }

            //curl_setopt($ch, CURLOPT_COOKIE, $this->cookie);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            $content = curl_exec($ch);

//            $content = iconv("Windows-1251","UTF-8",$content);

            if ($content === false) {
                if (curl_errno($ch)) {
                    $this->log('Error while curl: ' . curl_error($ch));
                    curl_close($ch);

                    $attempt += 1;
                    if ($attempt > 1) {
                        $this->changeBadProxy();
                        $attempt = 0;
                    }

                    return $this->query($url, $ref, $post, $attempt);
                }
                curl_close($ch);

                $this->changeBadProxy();
                return $this->query($url, $ref, $post, $attempt);
            } else {
                curl_close($ch);
                return $content;
            }
        }

        return '';
    }
}

