<?php

return array(
    'urlFormat' => 'path',
    'showScriptName' => false,
    'urlSuffix' => '/',
    'useStrictParsing' => true,
    'rules' => array(
        /*************************
         *      CONTROLLERS      *
         *************************/

        'testupload' => 'blog/default/upload',

        // global
        '.*/index' => 404,

        'findFriends' => array('friends/find', 'defaultParams' => array('type' => 0)),
        'findFriends/byRegion' => array('friends/find', 'defaultParams' => array('type' => 1)),
        'findFriends/byInterests' => array('friends/find', 'defaultParams' => array('type' => 2)),
        'findFriends/byStatus' => array('friends/find', 'defaultParams' => array('type' => 3)),

        // photo view
        'user/<user_id:\d+>/blog/post<content_id:\w+>/photo<photo_id:\d+>' => array('albums/singlePhoto', 'defaultParams' => array('entity' => 'CommunityContentGallery')),
        'community/<community_id:\d+>/forum/(post|photoPost)/<content_id:\d+>/photo<photo_id:\d+>' => array('albums/singlePhoto', 'defaultParams' => array('entity' => 'CommunityContentGallery')),
        'user/<user_id:\d+>/albums/<album_id:\d+>/photo<photo_id:\d+>' => array('albums/singlePhoto', 'defaultParams' => array('entity' => 'Album')),
        'cook/recipe/<recipe_id:\d+>/photo<photo_id:\d+>' => array('albums/singlePhoto', 'defaultParams' => array('entity' => 'SimpleRecipe')),
        'cook/multivarka/<recipe_id:\d+>/photo<photo_id:\d+>' => array('albums/singlePhoto', 'defaultParams' => array('entity' => 'MultivarkaRecipe')),
        'cook/decor/photo<photo_id:\d+>' => array('albums/singlePhoto', 'defaultParams' => array('entity' => 'CookDecorationCategory')),
        'cook/decor/<category_id:\d+>/photo<photo_id:\d+>' => array('albums/singlePhoto', 'defaultParams' => array('entity' => 'CookDecorationCategory')),
        'contest/<contest_id:\d+>/photo<photo_id:\d+>' => array('albums/singlePhoto', 'defaultParams' => array('entity' => 'Contest')),
        'ValentinesDay/valentines/photo<photo_id:\d+>' => array('albums/singlePhoto', 'defaultParams' => array('entity' => 'Album', 'valentines' => 1)),
        'ValentinesDay/howToSpend/photo<photo_id:\d+>' => array('albums/singlePhoto', 'defaultParams' => array('entity' => 'valentinePost')),

        // site controller
        '/' => 'site/index',
        'js_dynamics/<hash:\w+>.js' => 'site/seoHide',
        'moderation'=>'site/moderationRules',
        'site/<_a:(confirmEmail|resendConfirmEmail|passwordRecovery|passwordRecoveryForm|login|logout|link)>' => 'site/<_a>',


        //===================== Subscribes =========================//
        'subscribes'=>'myGiraffe/default/subscribes',
        'recommends'=>'myGiraffe/default/recommends',
        'my/friends' => array('myGiraffe/default/index', 'defaultParams' => array('type' => 2)),
        'my/blogs' => array('myGiraffe/default/index', 'defaultParams' => array('type' => 3)),
        'my/community/<community_id:\d+>' => array('myGiraffe/default/index', 'defaultParams' => array('type' => 4)),
        'my'  => array('myGiraffe/default/index', 'defaultParams' => array('type' => 1)),
        'my/<_a>' => 'myGiraffe/default/<_a>',

        // ajax controller
        //'ajax/duelShow/question_id/<question_id:\d+>' => 'ajax/duelShow',
        'ajaxSimple/<_a>'=>'ajaxSimple/<_a>',

        // signup controller
        'signup' => 'signup/index',
        'signup/<_a:(showForm|finish)>' => 'signup/<_a>',
        'signup/validate/step/<step:\d+>' => 'signup/validate',

        // friendRequests controller
        'friendRequests/update/request_id/<request_id:\d+>/action/<action:(accept|decline|retry|cancel)>' => 'friendRequests/update',

        //notifications
        'notifications' => 'notifications/default/index',
        'notifications/<_a>' => 'notifications/default/<_a>',

        // rss controller
        'rss/page<page:\d+>' => 'rss/index',
        'rss/social/' => 'rss/social',
        'rss/social/page<page:\d+>' => 'rss/social',
        'news/rss/<for:\w+>' => 'rss/news',
        'news/rss' => 'rss/news',

        // morning controller
        'morning/<id:\d+>' => 'morning/view',
        'morning/<date:[\d\d\d\d-\d\d-\d\d]*>' => 'morning/index',

        // albums controller
//        'albums/addPhoto/a/<a:\d+>/text/<text:\w+>/u/<u:\d+>' => 'albums/addPhoto',
//        'albums/addPhoto/a/<a:\d+>' => 'albums/addPhoto',
//        'albums/addPhoto' => 'albums/addPhoto',
//        'albums/redirect/<id:\d+>' => 'albums/redirect',
//        'albums/<_a:(attach|wPhoto|attachView|editDescription|editPhotoTitle|changeTitle|changePermission|removeUploadPhoto|communityContentEdit|communityContentSave|partnerPhoto|recipePhoto|cookDecorationPhoto|cookDecorationCategory|commentPhoto|crop|changeAvatar|humorPhoto|albumSettings|updatePhoto|postLoad|updateAlbum|messagingMessagePhoto|uploadPhoto)>' => 'albums/<_a>',

        // user/*

        'blog/form/type<type:\d+>' => 'blog/default/form',
        'blog/settings/<_a>' => 'blog/settings/<_a>',

        'user/settings/' => 'profile/settings/personal',
        'user/settings/<_a>' => 'profile/settings/<_a>',
        'user/<user_id:\d+>/blog/rubric<rubric_id:\d+>' => 'blog/default/index',
        'user/<user_id:\d+>/blog/post<content_id:\d+>' => 'blog/default/view',
        'user/<user_id:\d+>/blog' => 'blog/default/index',
        'newblog/<_a:>' => 'blog/default/<_a>',

        'user/<userId:\d+>' => 'userProfile/default/index',
        'user/<user_id:\d+>/friends' => 'profile/default/friends',
        'user/<user_id:\d+>/award/<id:\d+>' => array('profile/default/award', 'defaultParams' => array('type' => 'award')),
        'user/<user_id:\d+>/achievement/<id:\d+>' => array('profile/default/award', 'defaultParams' => array('type' => 'achievement')),
        'user/<user_id:\d+>/awards' => 'profile/default/awards',
        'profile/<_a>' => 'profile/default/<_a>',

        'user/<user_id:\d+>/rss/page<page:\d+>' => 'rss/user',
        'user/<user_id:\d+>/rss' => 'rss/user',
        'user/<user_id:\d+>/comments/rss/page<page:\d+>' => 'rss/comments',
        'user/<user_id:\d+>/comments/rss' => 'rss/comments',
        'user/<user_id:\d+>/albums' => 'gallery/user/index',
        'user/<user_id:\d+>/albums/<album_id:\d+>' => 'gallery/user/view',
        'user/<user_id:\d+>/albums/<album_id:\d+>/photo<id:\d+>' => 'albums/photo',
        'user/<_a:(updateMood|activityAll)>' => 'user/<_a>',
        'user/createRelated/relation/<relation:\w+>/' => 'user/createRelated',
        'user/myFriendRequests/<direction:\w+>/' => 'user/myFriendRequests',

        //blog
        'blog/edit/content_id/<content_id:\d+>' => 'blog/edit',
        'blog/add/content_type_slug/<content_type_slug>' => 'blog/add',
        'blog/add/content_type_slug/<content_type_slug>/rubric_id/<rubric_id:\d+>' => 'blog/add',
        'blog/<_a:(add|empty)>' => 'blog/<_a>',


        /************************************************* community  *************************************************/

        // community/*
        'community/36.*' => 404,
        'news/rubric<rubric_id:\d+>' => array('community/default/forum', 'defaultParams' => array('forum_id' => 36)),
        'news' => array('community/default/forum', 'defaultParams' => array('forum_id' => 36)),
        'news/<content_type_slug:[a-z]+><content_id:\d+>' => array('community/default/view', 'defaultParams' => array('forum_id' => 36)),

        'pregnancy-and-children' => array('community/default/section', 'defaultParams' => array('section_id' => 1)),
        'home' => array('community/default/section', 'defaultParams' => array('section_id' => 2)),
        'beauty-and-health' => array('community/default/section', 'defaultParams' => array('section_id' => 3)),
        'husband-and-wife' => array('community/default/section', 'defaultParams' => array('section_id' => 4)),
        'interests-and-hobby' => array('community/default/section', 'defaultParams' => array('section_id' => 5)),
        'family-holiday' => array('community/default/section', 'defaultParams' => array('section_id' => 6)),

        'community/<_a:(subscribe)>/'=>'community/default/<_a>',
        'community/<forum_id:\d+>/forum/rubric/<rubric_id:\d+>' => 'community/default/forum',
        'community/<forum_id:\d+>/forum/<content_type_slug:\w+>/<content_id:\d+>' => 'community/default/view',
        'community/<forum_id:\d+>/forum/' => 'community/default/forum',

        //global
        '<_c:(settings|ajax|notification|profile|friendRequests|communityRubric|morning|userPopup|features|blog)>/<_a>' => '<_c>/<_a>',
        '<_c:(settings|profile|rss|morning|community|happyBirthdayMira)>' => '<_c>/index',

        //others
        'news/about' => 'community/contacts',
        'news/about/authors' => 'community/authors',
        array('class' => 'site.frontend.extensions.sitemapgenerator.SGUrlRule', 'route' => '/sitemap'),

        /*************************
         *        MODULES        *
         *************************/

        // live
        'whatsNew/clubs' => array('whatsNew/default/clubs', 'defaultParams' => array('show' => 'all')),
        'whatsNew/clubs/my' => array('whatsNew/default/clubs', 'defaultParams' => array('show' => 'my')),
        'whatsNew/blogs' => array('whatsNew/default/blogs', 'defaultParams' => array('show' => 'all')),
        'whatsNew/blogs/my' => array('whatsNew/default/blogs', 'defaultParams' => array('show' => 'my')),
        'whatsNew/page<page:\d+>' => 'whatsNew/default/index',
        'whatsNew' => 'whatsNew/default/index',
        'whatsNew/friends' => 'whatsNew/friends/index',
        'whatsNew/friends/page<page:\d+>' => 'whatsNew/friends/index',
        'whatsNew/<_a:(ajax|moreItems)>' => 'whatsNew/default/<_a>',

        'contest/<id:\d+>' => 'contest/default/view',
        'contest/<id:\d+>/rules' => 'contest/default/rules',
        'contest/<id:\d+>/list/<sort:\w+>' => 'contest/default/list',
        'contest/<id:\d+>/list' => 'contest/default/list',
        'contest/<id:\d+>/results/work<work:\d+>' => 'contest/default/results',
        'contest/<id:\d+>/results' => 'contest/default/results',
        'contest/<id:\d+>/prizes' => 'contest/default/prizes',
        'contest/work<id:\d+>' => 'contest/default/work',
        'contest/<_a>/<id:\d+>' => 'contest/default/<_a>',

        '<_m:(scores|cook|contest)>/' => '<_m>/default/index',
        'commentator' => 'signal/commentator/index',
        'commentator/links/<month:\d\d\d\d-\d\d>' => 'signal/commentator/links',
        'commentator/award/<type:\w+>' => 'signal/commentator/award',
        'commentator/reports/<section:\w+>/<month:\d\d\d\d-\d\d>' => 'signal/commentator/reports',
        'commentator/reports/<section:\w+>' => 'signal/commentator/reports',
        'commentator/<_a>' => 'signal/commentator/<_a>',

        //cook
        'cook/calorisator/ac' => 'cook/calorisator/ac',

        'cook/choose/<id:[\w_]+>' => 'cook/choose/view',

        'cook/converter/<_a>' => 'cook/converter/<_a>',

        'cook/decor/<id:\d+>/page<page:\d+>' => 'cook/decor/index',
        'cook/decor/<id:\d+>' => 'cook/decor/index',
        'cook/decor/page<page:\d+>' => 'cook/decor/index',
        'cook/decor' => 'cook/decor/index',

        'cook/recipe/tag/valentinesDay/type/<type:\d+>' => array('cook/recipe/tag', 'defaultParams' => array('section' => 0, 'tag'=>97)),
        'cook/recipe/tag/valentinesDay' => array('cook/recipe/tag', 'defaultParams' => array('section' => 0, 'tag'=>97)),

        'cook/recipe/tag/<tag:\d+>/type/<type:\d+>' => array('cook/recipe/tag', 'defaultParams' => array('section' => 0)),
        'cook/recipe/tag/<tag:\d+>' => array('cook/recipe/tag', 'defaultParams' => array('section' => 0)),
        'cook/recipe/tag/' => array('cook/recipe/tag', 'defaultParams' => array('section' => 0)),
        'cook/recipe/cookBook/type/<type:\d+>' => array('cook/recipe/cookBook'),
        'cook/recipe/cookBook/' => array('cook/recipe/cookBook'),
        'cook/recipe/random/' => array('cook/recipe/random'),

        'cook/recipe/edit/<id:\d+>' => array('cook/recipe/form', 'defaultParams' => array('section' => 0)),
        'cook/recipe/add' => array('cook/recipe/form', 'defaultParams' => array('section' => 0)),
        'cook/recipe/<id:\d+>' => array('cook/recipe/view', 'defaultParams' => array('section' => 0)),
        'cook/recipe/type/<type:\d+>' => array('cook/recipe/index', 'defaultParams' => array('section' => 0)),
        'cook/recipe' => array('cook/recipe/index', 'defaultParams' => array('section' => 0)),
        'cook/recipe/advancedSearch' => array('cook/recipe/advancedSearch', 'defaultParams' => array('section' => 0)),
        'cook/recipe/advancedSearchResult' => array('cook/recipe/advancedSearchResult', 'defaultParams' => array('section' => 0)),
        'cook/recipe/searchByIngredients' => array('cook/recipe/searchByIngredients', 'defaultParams' => array('section' => 0)),
        'cook/recipe/searchByIngredientsResult' => array('cook/recipe/searchByIngredientsResult', 'defaultParams' => array('section' => 0)),

        'cook/multivarka/add' => array('cook/recipe/form', 'defaultParams' => array('section' => 1)),
        'cook/multivarka/<id:\d+>' => array('cook/recipe/view', 'defaultParams' => array('section' => 1)),
        'cook/multivarka/type/<type:\d+>' => array('cook/recipe/index', 'defaultParams' => array('section' => 1)),
        'cook/multivarka' => array('cook/recipe/index', 'defaultParams' => array('section' => 1)),
        'cook/multivarka/advancedSearch' => array('cook/recipe/advancedSearch', 'defaultParams' => array('section' => 1)),
        'cook/multivarka/advancedSearchResult' => array('cook/recipe/advancedSearchResult', 'defaultParams' => array('section' => 1)),
        'cook/multivarka/searchByIngredients' => array('cook/recipe/searchByIngredients', 'defaultParams' => array('section' => 1)),
        'cook/multivarka/searchByIngredientsResult' => array('cook/recipe/searchByIngredientsResult', 'defaultParams' => array('section' => 1)),

        'cook/recipe/feed.xml' => 'cook/recipe/feed',
        'cook/recipe/<_a:(ac|import|search|test|autoSelect|addTag|removeTag|book)>' => 'cook/recipe/<_a>',

        'cook/spices/category/<id:[\w_]+>' => 'cook/spices/category',
        'cook/spices/<id:[\w_]+>' => 'cook/spices/view',

        'cook/<_c:(spices|choose|calorisator|converter)>' => 'cook/<_c>/index',

        //===================== Services =========================//

        'childCalendar/<slug:[\w-]+>' => array('calendar/default/index', 'defaultParams' => array('calendar' => 0)),
        'pregnancyCalendar/join' => array('calendar/default/join'),
        'pregnancyCalendar/<slug:[\w-]+>' => array('calendar/default/index', 'defaultParams' => array('calendar' => 1)),
        'childCalendar' => array('calendar/default/index', 'defaultParams' => array('calendar' => 0)),
        'pregnancyCalendar' => array('calendar/default/index', 'defaultParams' => array('calendar' => 1)),

        '<_m:(test|tester|vaccineCalendar|childrenDiseases|menstrualCycle|horoscope|babyBloodGroup|placentaThickness|pregnancyWeight|contractionsTime|names|hospitalBag|maternityLeave|dailyCalories|weightLoss|idealWeight|bodyFat|birthDate)>/' => 'services/<_m>/default/index',
        '<_m:(babySex|vaccineCalendar|sewing|hospitalBag)>/<_a>/' => 'services/<_m>/default/<_a>',

        'babySex' => 'services/babySex/default/index',
        'babySex/default/<_a:(bloodUpdate, japanCalc, ovulationCalc)>/' => 'services/babySex/default/<_a>',

        'childrenDiseases/<id:[\w-+\s]+>' => 'services/childrenDiseases/default/view',

        //horoscope compatibility
        'horoscope/compatibility/validate' => 'services/horoscope/compatibility/validate',
        'horoscope/compatibility/<zodiac1:[\w]+>/<zodiac2:[\w]+>' => 'services/horoscope/compatibility/index',
        'horoscope/compatibility/<zodiac1:[\w]+>' => 'services/horoscope/compatibility/index',
        'horoscope/compatibility' => 'services/horoscope/compatibility/index',

        //horoscope
        'horoscope/likes/<zodiac:[\d]+>/<date:\d\d\d\d-\d\d-\d\d>' => 'services/horoscope/default/likes',
        'horoscope/month/<zodiac:[\w]+>/<month:\d\d\d\d-\d\d>' => 'services/horoscope/default/month',
        'horoscope/year/<zodiac:[\w]+>/<year:\d\d\d\d>' => 'services/horoscope/default/year',
        'horoscope/year/<year:\d\d\d\d>' => 'services/horoscope/default/year',
        'horoscope/<zodiac:[\w]+>/<date:\d\d\d\d-\d\d-\d\d>' => 'services/horoscope/default/date',
        'horoscope/<_a:(year|month|tomorrow|yesterday)>/<zodiac:[\w]+>' => 'services/horoscope/default/<_a>',
        'horoscope/<_a:(year|month|tomorrow|viewed)>' => 'services/horoscope/default/<_a>',
        'horoscope/<zodiac:[\w]+>' => 'services/horoscope/default/today',

        'names/saint/<month:[\w]+>' => 'services/names/default/saint/',
        'names/<_a:(saintCalc|likes|like|top10|saint)>' => 'services/names/default/<_a>',
        'names/<name:[\w]+>' => 'services/names/default/name/',

        'recipeBook/<_a:(diseases|ac)>' => 'services/recipeBook/default/<_a>',
        'recipeBook/edit/<id:\d+>' => 'services/recipeBook/default/form',
        'recipeBook/add' => 'services/recipeBook/default/form',
        'recipeBook/recipe<id:\d+>' => 'services/recipeBook/default/view',
        'recipeBook/<slug:\w+>' => 'services/recipeBook/default/index',
        'recipeBook' => 'services/recipeBook/default/index',

        'services/repair/<_c>/<_a>' => 'services/repair/<_c>/<_a>',
        'repair/<_c>' => 'services/repair/<_c>/index',

        'test/<slug:[\w-]+>' => 'services/test/default/view',

        'tester/<slug:[\w-]+>' => 'services/tester/default/view',

        '<_m:(menstrualCycle|placentaThickness|pregnancyWeight|birthDate)>/<_a:(calculate)>' => 'services/<_m>/default/<_a>',

        'services/<_m:(dailyCalories|weightLoss|idealWeight|bodyFat)>/default/<_c>' => 'services/<_m>/default/<_c>',
        'services/lines/<id:[\d]+>.jpeg' => 'services/lines/default/index',

        'auto/routes/<id:[\d]+>'=>'routes/default/index',
        'auto/routes/'=>'routes/default/index',
        'auto/routes/<_a>'=>'routes/default/<_a>',
        'auto/routes/<_a>/<id:[\d]+>'=>'routes/default/<_a>',

        'ValentinesDay' => 'valentinesDay/default/index',
        'ValentinesDay/<_a>' => 'valentinesDay/default/<_a>',

        'messaging' => 'messaging/default/index',
        'messaging/<_c>/<_a>' => 'messaging/<_c>/<_a>',

        'friends' => 'friends/default/index',
        'friends/search' => 'friends/search/index',
        'friends/<_c>/<_a>' => 'friends/<_c>/<_a>',

        'favourites/tags/byLetter/<letter:\w+>' => array('favourites/tags/index', 'defaultParams' => array('type' => 1)),
        'favourites/tags/byLetter' => array('favourites/tags/index', 'defaultParams' => array('type' => 1)),
        'favourites/tags' => array('favourites/tags/index', 'defaultParams' => array('type' => 0)),
        'favourites/default/<_a:(search|getEntityData|get|test)>' => 'favourites/default/<_a>',
        'favourites/favourites/<_a:\w+>' => 'favourites/favourites/<_a>',
        'favourites' => 'favourites/default/index',

        'search' => 'search/default/index',
        'search/default/get' => 'search/default/get',

        'user/<userId:\d+>/family' => 'family/default/index',
        'family/<_a>' => 'family/default/<_a>',
    ),
);