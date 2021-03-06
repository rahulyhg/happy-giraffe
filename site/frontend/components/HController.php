<?php

class HController extends CController
{
    public $menu = array();
    public $breadcrumbs = array();
    public $rssFeed = null;
    public $seoHrefs = array();
    public $seoContent = array();
    public $registerUserModel = null;
    public $registerUserData = null;

    public $meta_description = '';
    public $meta_keywords = null;
    public $meta_title = null;
    public $page_meta_model = null;

    public $pGallery = null;
    public $broadcast = false;

    public $body_class = 'body-club';
    public $bodyClass = null;

    public $tempLayout = false;
    public $showLikes = false;
    public $showAddBlock = true;
    public $r = 1378549348;

    public function filterAjaxOnly($filterChain)
    {
        if (Yii::app()->getRequest()->getIsAjaxRequest())
            $filterChain->run();
        else {
            header('X-Robots-Tag: noindex');
        }
    }

    public function invalidActionParams($action)
    {
        throw new CHttpException(404,Yii::t('yii','Your request is invalid.'));
    }

    public function init()
    {
        parent::init();

        if (! Yii::app()->request->isAjaxRequest)
        {
            if(Yii::app()->clientScript->useAMD)
                Yii::app()->clientScript->registerAMD('serverTime', array(), 'var serverTime = ' . time() . '; serverTimeDelta = new Date().getTime() - (serverTime * 1000)');
            else
                Yii::app()->clientScript->registerScript('serverTime', 'var serverTime = ' . time() . '; serverTimeDelta = new Date().getTime() - (serverTime * 1000)', CClientScript::POS_HEAD);
        }

//        if (YII_DEBUG === false && ($this->module === null || $this->module == 'messaging'))
//            $this->combineStatic();

        // авторизация
        if (isset($this->actionParams['token'])) {
            if (($user_id = UserToken::model()->useToken($this->actionParams['token'])) !== false) {
                $identity = new SafeUserIdentity($user_id);
                if ($identity->authenticate())
                    Yii::app()->user->login($identity);
            }
            unset($_GET['token']);
        }

        // если запрос инициирован с помощью метода redirect, то читаем только с мастера
        if (Yii::app()->db instanceof DbConnectionMan && Yii::app()->user->getFlash('redirected') !== null) {
            Yii::app()->db->enableSlave = false;
        }

        \site\frontend\modules\signup\components\IntroductionManager::check();
    }

    protected function filterBySpamStatus()
    {
        if (! Yii::app()->user->isGuest) {
            $status = AntispamStatusManager::getUserStatus(Yii::app()->user->id);
            if ($status == AntispamStatusManager::STATUS_BLACK)
                Yii::app()->end();
        }
    }

    protected function beforeAction($action)
    {
        \site\frontend\modules\specialists\components\SpecialistFilter::denySpecialists();

        $this->addView($action);

        $this->filterBySpamStatus();
//        if (Yii::app()->user->id == 12936 || Yii::app()->user->id == 56 || Yii::app()->user->id == 16534)
//            $this->showLikes = true;

//        if (Yii::app()->user->id == 22 && !($this->id == 'happyBirthdayMira' || $this->route == 'site/logout' || $this->route == 'ajax/sendcomment'))
//            $this->redirect(array('happyBirthdayMira/index'));

//        $this->_mobileRedirect();

        // отключение повторной подгрузки jquery
        if (Yii::app()->request->isAjaxRequest) {
            Yii::app()->clientScript->scriptMap = array(
                'jquery.js' => false,
                'jquery.min.js' => false,
                'jquery.yiiactiveform.js' => false,
                'jquery.ba-bbq.js' => false,
                'jquery.yiilistview.js' => false,
                'require2.1.11-jquery1.10.2.js' => false,
            );
        }

        // noindex для дева
        Yii::app()->ads->addNoindex();
        if (isset($_GET['CommunityContent_page']) || isset($_GET['BlogContent_page']) || isset($_GET['Comment_page']))
            Yii::app()->clientScript->registerMetaTag('noindex', 'robots');

        if (!Yii::app()->user->isGuest && (Yii::app()->user->model->blocked == 1 || Yii::app()->user->model->deleted == 1))
            Yii::app()->user->logout();

        $received_params = array(
            'utm_source',
            'utm_medium',
            'utm_campaign',
            'utm_content',
            'im_interlocutor_id',
            'im_type',
            'openSettings',
            'fb_action_ids',
            'fb_action_types',
            'fb_source',
            'action_object_map',
            'open_gallery',
            'openGallery',
        );

        // seo-фильтр get-параметров
        if (in_array($this->uniqueId, array(
            'blog/default',
            'community/default',
            'services/horoscope/default',
            'services/childrenDiseases/default',
            'cook/spices',
            'cook/choose',
        )) || in_array($this->route, array(
                'cook/recipe/view',
                'cook/recipe/index',
                'userProfile/default/index',
                'posts/forums/club/index',
                ))
        ) {
            $reflector = new ReflectionClass($this);
            $parametersObjects = $reflector->getMethod('action' . $this->action->id)->getParameters();
            $parametersNames = array();
            foreach ($parametersObjects as $p)
                $parametersNames[] = $p->name;
            foreach ($this->actionParams as $p => $v)
                if (array_search($p, $parametersNames) === false && (strpos($p, '_page') === false || in_array($this->route, ['userProfile/default/index', 'posts/forums/club/index'])) && !in_array($p, $received_params))
                    throw new CHttpException(404, 'Такой записи не существует');
        }

        // мета-теги
        $this->setMetaTags();


        if (Yii::app()->user->getState('redirect_to') != null){
            Yii::app()->clientScript->registerScript('redirect_to','HGoTo("'.Yii::app()->user->getState('redirect_to').'");');
            Yii::app()->user->setState('redirect_to', null);
        }

        return parent::beforeAction($action);
    }

    protected function afterRender($view, &$output)
    {
        $js = '$(function() {
                var seoHrefs = ' . CJSON::encode($this->seoHrefs) . ';
                var seoContent = ' . CJSON::encode($this->seoContent) . ';
                var $elements = $("[data-key]");
                for(var i = 0, count = $elements.length; i < count; i++) {
                    var $element = $elements.eq(i);
                    var key = $element.data("key");
                    switch($element.data("type")) {
                        case "href":
                            $element.attr("href", Base64.decode(seoHrefs[key]));
                            break;
                        case "content":
                            $element.replaceWith(Base64.decode(seoContent[key]));
                            break;
                    }
                }
            });';

        $hash = md5($js);
        $dir = substr($hash, 0, 2);
        $file = substr($hash, 2);
        $dirPath = Yii::getPathOfAlias('application.www-submodule.jsd') . DIRECTORY_SEPARATOR . $dir;

        $path = $dirPath . DIRECTORY_SEPARATOR . $file . '.js';

        if (! file_exists($path)) {
            if (! is_dir($dirPath))
                mkdir($dirPath);
            file_put_contents($path, $js);
        }

        if(Yii::app()->clientScript->useAMD)
            Yii::app()->clientScript->registerAMDFile(array('jquery', 'common'), '/jsd/' . $dir . '/' . $file . '.js');
        else
            Yii::app()->clientScript->registerScriptFile('/jsd/' . $dir . '/' . $file . '.js', CClientScript::POS_END);

        return parent::afterRender($view, $output);
    }

    public function getViews()
    {
        $path = '/' . Yii::app()->request->pathInfo . '/';

        return PageView::model()->incViewsByPath($path);
    }

    public function setMetaTags()
    {
        if (!Yii::app()->request->isAjaxRequest) {
            $this->page_meta_model = PageMetaTag::getModel(Yii::app()->controller->route, Yii::app()->controller->actionParams);

            if ($this->page_meta_model !== null) {
                if (!empty($this->page_meta_model->description))
                    $this->meta_description = $this->page_meta_model->description;
                if (!empty($this->page_meta_model->keywords))
                    $this->meta_keywords = $this->page_meta_model->keywords;
                if (!empty($this->page_meta_model->title))
                    $this->meta_title = $this->page_meta_model->title;
            }
        }
    }

    protected function combineStatic()
    {
        $wwwPath = Yii::getPathOfAlias('application.www-submodule');

        foreach (Yii::app()->params['combineMap'] as $all => $filesArray) {
            if (file_exists($wwwPath . $all)) {
                $to = Yii::app()->request->isAjaxRequest ? false : $all;
                foreach ($filesArray as $f)
                    Yii::app()->clientScript->scriptMap[$f] = $to;
            }
        }
    }

    private function _mobileRedirect()
    {
        require_once('mobiledetect/Mobile_Detect.php');

        $detect = new Mobile_Detect();
        $mobile = $newMobile = (string) Yii::app()->request->cookies['mobile'];

        if ($mobile == '' && $detect->isMobile() && ! $detect->isTablet())
            $newMobile = 1;

        if ($mobile == 1 && Yii::app()->request->getQuery('nomo') == 1)
            $newMobile = 0;

        if ($mobile != $newMobile)
            Yii::app()->request->cookies['mobile'] = new CHttpCookie('mobile', $newMobile, array('expire' => time() + 60 * 60 * 24 * 365));

        if ($newMobile == 1)
            $this->redirect('http://m.happy-giraffe.ru' . $_SERVER['REQUEST_URI']);
    }

    public function getMenuData()
    {
        $user = Yii::app()->user->getModel();

        $newNotificationsCount = (int) \site\frontend\modules\notifications\models\Notification::getUnreadSum();
        $newMessagesCount = (int) MessagingManager::unreadMessagesCount($user->id);
        $newFriendsCount = (int) FriendRequest::model()->getUserCount($user->id);
        $newPostsCount = 0;//(int) ViewedPost::getInstance()->newPostCount($user->id, SubscribeDataProvider::TYPE_ALL);
        $newScoreCount = (int) ($user->score->scores - $user->score->seen_scores);
        $activeModule = $this->module ? $this->module->id : null;

        return compact('newNotificationsCount', 'newMessagesCount', 'newFriendsCount', 'newPostsCount', 'newScoreCount', 'activeModule');
    }

    public function addView($action)
    {
        //\Yii::log("checkView", 'info', 'hcontroller');
        if (Yii::app()->user->isGuest && ! Yii::app()->request->isAjaxRequest && Yii::app()->errorHandler->error === null && $action instanceof CInlineAction) {
            $viewsCount = Yii::app()->user->getState('viewsCount', 0);
            Yii::app()->user->setState('viewsCount', $viewsCount + 1);
        }
    }

    public function redirect($url,$terminate=true,$statusCode=302)
    {
        Yii::app()->user->setFlash('redirected', true);
        parent::redirect($url,$terminate,$statusCode);
    }
}
