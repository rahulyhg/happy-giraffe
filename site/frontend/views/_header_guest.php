<!-- header-->
<div class="layout-header">
    <header class="header header__simple header__guest">
        <div class="header_hold clearfix">
            <!-- logo-->
            <div class="logo"><a title="Веселый жираф - сайт для всей семьи" href="<?=$this->createUrl('/site/index')?>" class="logo_i">Веселый жираф - сайт для всей семьи</a><span class="logo_slogan">САЙТ ДЛЯ ВСЕЙ СЕМЬИ</span></div>
            <!-- /logo-->
            <div class="header-login"><a class="header-login_a login-button" data-bind="follow: {}">Вход</a><a class="header-login_a registration-button" data-bind="follow: {}">Регистрация</a></div>
            <?php $this->widget('site.frontend.widgets.headerGuestWidget.HeaderGuestSectionsWidget'); ?>
            <?php if (false && ($this->module === null || $this->module->id != 'search')): ?>
                <div class="sidebar-search clearfix sidebar-search__big">
                    <!-- <input type="text" name="" placeholder="Поиск" class="sidebar-search_itx"> -->
                    <!-- При начале ввода добавить класс .active на кнопку-->
                    <!-- <button class="sidebar-search_btn"></button> -->
                    <?php $this->widget('site.frontend.modules.search.widgets.YaSearchWidget'); ?>
                </div>
            <?php endif; ?>
        </div>
    </header>
</div>
<!-- /header-->
