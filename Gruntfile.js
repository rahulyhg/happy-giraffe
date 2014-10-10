module.exports = function(grunt){
  require('time-grunt')(grunt);

  //timer.init(grunt);
  require('load-grunt-tasks')(grunt, {scope: 'devDependencies'});

  grunt.initConfig({

    jade: {
      
      // Пересобираем все шаблоны
      new: {
        files: [{
          expand: true,
          cwd: 'new/jade',
          src: ['page/**/*.jade', '!block/**/*.jade', '!extend/**/*.jade'],
          dest: 'new/html',
          ext: ".html"
        }],
        options: {
          pretty: true,
          client: false,
          cache: true,
          nospawn : true,
        }
      },
      // пересобираем документацию
      docs: {
        files: [{
          expand: true,

          cwd: 'new/jade',
          src: ['docs/**/*.jade', ], // 'lite/jade/docs/**/*.jade', 
          dest: 'new/html',
          ext: ".html"
        }],
        options: {
          pretty: true,
          client: false,
          cache: true,
          nospawn : true,
        }
      },
      // пересобираем документацию
      docs_lite: {
        files: [{
          expand: true,
          cwd: 'lite/jade',
          src: ['docs/**/*.jade', ], // 'lite/jade/docs/**/*.jade', 
          dest: 'lite/html',
          ext: ".html"
        }],
        options: {
          pretty: true,
          client: false,
          cache: true,
          nospawn : true,
          data: {
            debug: true,
            timestamp: "<%= grunt.template.today() %>"
          }
        }
      },

      // Пересобираем все шаблоны
      lite_prod: {
        files: [{
          expand: true,
          cwd: 'lite/jade',
          src: ['page/**/*.jade', '!block/**/*.jade', '!extend/**/*.jade'],
          dest: 'lite/html',
          ext: ".html"
        }],
        options: {
          pretty: true,
          client: false,
          cache: true,
          nospawn : true,
          data: {
            debug: false,
            timestamp: "<%= grunt.template.today() %>"
          }
        }
      },
      // Пересобираем все шаблоны
      lite_dev: {
        files: [{
          expand: true,
          cwd: 'lite/jade',
          src: ['page/**/*.jade', '!block/**/*.jade', '!extend/**/*.jade'],
          dest: 'lite/html-dev',
          ext: ".html"
        }],
        options: {
          pretty: true,
          client: false,
          cache: true,
          nospawn : true,
          data: {
            debug: true,
            timestamp: "<%= grunt.template.today() %>"
          }
        }
      },
    },

    // Удаляем файлы
    // clean: {
    //   new: ['new/css/tidy.css']
    // },

    ///////////////////////////////////////////////////
    // css
    less: {
      old: {
        files: {
          'stylesheets/common.css': ['less/all1.less'],
          'stylesheets/global.css': ['less/all2.less'],
          // стили страницы вакансий
          'stylesheets/vacancy.css': ['less/vacancy.less'],
          // стили html баннеров, независимы от всего 
          // 'stylesheets/banner.css': ['less/banner.less']
        },
        options: {
          compress: true,
          cleancss: true,
        }
      },
      old_dev: {
        files: {
          'stylesheets/common.dev.css': ['less/all1.less'],
          'stylesheets/global.dev.css': ['less/all2.less'],
        },
        options: {
          sourceMap: true,
        }
      },


      newestdev: {
        files: {
          'new/css/all1.dev.css': ['new/less/all1.less'] 
        },
        options: {
          sourceMap: true,
        },
      },
      // newest: {
      //   files: {
      //     'new/css/all1.css': ['new/less/all1.less'] 
      //   },
      //   options: {
      //     compress: true,
      //     cleancss: true,
      //   }
      // },
      aviary: {
        files: {
          'new/css/plugins/aviary.hg.css': ['new/less/plugins/aviary.hg.less'] 
        },
        options: {
          compress: true,
          cleancss: true,
        }
      },


      litedev: {
        
        files: [{
          expand: true,
          cwd: 'lite/less/',
          src: ['*.less',],
          dest: 'lite/css/dev/',
          ext: '.css'
        }],
        // files: {
        //   'lite/css/dev/all.css': ['lite/less/all.less'] 
        // },
        options: {
          sourceMap: true,
        }
      },
<<<<<<< HEAD
      newest: {
        files: {
          'new/css/all1.css': ['new/less/all1.less'] 
        },
        options: {
          compress: true,
          cleancss: true,
        }
      },
      aviary: {
        files: {
          'new/css/plugins/aviary.hg.css': ['new/less/plugins/aviary.hg.less'] 
        },
        options: {
          compress: true,
          cleancss: true,
        }
      }
=======
>>>>>>> 6081550e7a623a80fec29defb625e8f09b115fc3
    },

    // неиспользуемые стили
    uncss: {
      new: {
        options: {
          stylesheets  : ['/css/all1.dev.css'],
          timeout      : 1000,

          htmlroot     : 'new',
          ignore       : [
            // Выбираем все стили где в начале .class
            /#ctrlcopy+/,
            /.dropdown+/,
            /.flag+/,
            /.jcrop+/,
            /.mfp+/,
            /.redactor+/,
            /.select2+/,
            /.tooltip+/,
            /.header-menu_li+/,
            /.header_+/,
            /.header-banner+/,
          ],
        },
        src: ['new/html/docs/*.html', 'new/html/page/**/*.html'],
        dest: 'new/css/all1.css'
      },
      // Блог
      lite_blog: {
        options: {
          stylesheets  : ['/css/dev/all.css'],
          timeout      : 1000,

          htmlroot     : 'lite',
          ignore       : [
            // Выбираем все стили где в начале .class
            // /.dropdown+/,
            /#ctrlcopy+/,
            /.jcrop+/,
            /.mfp+/,
            /.mfp+/,
            /.select2+/,
            /.header-menu_li+/,
            /.header_+/,
            /.header-banner+/,
            //.tooltip+/,
          ],
        },
        src: [
          'lite/html/page/blog/**/*.html', 
          'lite/html/page/comments/**/*.html', 
          'lite/html/page/sign/**/*.html', 

          '!lite/html/page/**/*-user.html', // стариницы зареганого 
          '!lite/html/page/comments/comments-page.html'
        ],
        dest: 'lite/css/min/blog.css'
      },
      // Традиционные рецепты
      'services': {
        options: {
          stylesheets  : ['/css/dev/all.css'],
          timeout      : 1000,
          htmlroot     : 'lite',
          ignore       : [
            // Выбираем все стили где в начале .class
            /#ctrlcopy+/,
            /.jcrop+/,
            /.mfp+/,
            /.select2+/,
            /.header-menu_li+/,
            /.header_+/,
            /.header-banner+/,
            /.calendar-serv-note__+/,
          ],
        },
        src: [
          'lite/html/page/comments/**/*.html', 
          'lite/html/page/sign/**/*.html', 
          'lite/html/page/services/**/*.html', 

          '!lite/html/page/**/*-user.html', // стариницы зареганого 
          '!lite/html/page/comments/comments-page.html',
        ],
        dest: 'lite/css/min/services.css'
      },
      // Традиционные рецепты у зареганого пользователя
      'services_user': {
        options: {
          stylesheets  : ['/css/dev/all.css'],
          timeout      : 1000,
          htmlroot     : 'lite',
          ignore       : [
            // Выбираем все стили где в начале .class
            /#ctrlcopy+/,
            /.jcrop+/,
            /.mfp+/,
            /.select2+/,
            /.header-menu_li.active+/,
            /.calendar-serv-note__+/,

            /.header-drop+/, // Drop, active элементы
            /.chzn+/,
            /.redactor+/,
            /.fancybox+/,
            /.header-banner+/,
            /.header-drop+/, // Drop, active элементы
            /.header-menu_li+/,
            /.header_+/,
          ],
        },
        src: [
          'lite/html/page/comments/**/*.html', 
          '!lite/html/page/comments/comments-page.html',
          'lite/html/page/user/**/*.html', 
          'lite/html/page/services/**/*.html', 

        ],
        dest: 'lite/css/min/services-user.css'
      },
      'member': {
        options: {
          stylesheets  : ['/css/dev/all.css'],
          timeout      : 1000,
          htmlroot     : 'lite',
          ignore       : [
            // Выбираем все стили где в начале .class
            /#ctrlcopy+/,
            /.jcrop+/,
            /.mfp+/,
            /.select2+/,
            /.header-menu_li+/,
            /.header-banner+/,
            /.header_+/,
            
            // Для страниц собранных разделов
            /.flag+/,
          ],
        },
        src: [
          'lite/html/page/comments/**/*.html', 
          'lite/html/page/sign/**/*.html', 
          'lite/html/page/member/**/*.html', 

          '!lite/html/page/**/*-user.html', // стариницы зареганого пользователя
          '!lite/html/page/comments/comments-page.html',
        ],
        dest: 'lite/css/min/member.css'
      },
      'member_user': {
        options: {
          stylesheets  : ['/css/dev/all.css'],
          timeout      : 1000,
          htmlroot     : 'lite',
          ignore       : [
            // Выбираем все стили где в начале .class
            /#ctrlcopy+/,
            /.jcrop+/,
            /.mfp+/,
            /.select2+/,
            // Для пользователя
            /.chzn+/,
            /.redactor+/,
            /.fancybox+/,
            /.header-banner+/,
            /.header-drop+/, // Drop, active элементы
            /.header-menu_li+/,
            /.header_+/,
            // Для страниц собранных разделов
            /.flag+/,
          ],
        },
        src: [
          'lite/html/page/comments/**/*.html', 
          'lite/html/page/user/**/*.html', 
          'lite/html/page/member/**/*.html', 

          '!lite/html/page/comments/comments-page.html',
        ],
        dest: 'lite/css/min/member-user.css'
      },
    },
    // Объеденяем медиа запросы в css
    cmq: {
      options: {
        log: true
      },
      new: {
        files: {
          'new/css/all1.css': ['new/css/all1.css']
        }
      },
      redactor: {
        files: {
          'lite/css/min/redactor.css': ['lite/css/dev/redactor.css']
        }
      },
      // lite: {
      //   files: {
      //     'lite/css/min/*.css': ['lite/css/min/*.css']
      //   }
      // },
      lite: {
        expand: true,
        cwd: 'lite/css/',
        src: ['min/*.css'],
        dest: 'lite/css/',
        ext: '.css'
      }
    },
    // Сжимаем css
    cssmin: {
      new: {
        options: {
          compatibility: 'ie8',
          keepSpecialComments: 0,
          report: 'max'
        },
        files: {
          'new/css/all1.css': 'new/css/all1.dev.css'
        }
      },
      lite: {
        options: {
          compatibility: 'ie8',
          keepSpecialComments: 0,
          report: 'max'
        },
        files: [{
          expand: true,
          cwd: 'lite/css/min/',
          src: ['*.css',],
          dest: 'lite/css/min/',
          ext: '.css'
        }]
      }
    },
    // Умное сжате css
    csso: {
      new: {
        options: {
          report: 'gzip'
        },
        files: {
          'new/css/all1.css': ['new/css/all1.css']
        }
      },
      lite: {
        options: {
          report: 'gzip'
        },
        files: [{
          expand: true,
          cwd: 'lite/css/min/',
          src: ['*.css',],
          dest: 'lite/css/min/',
          ext: '.css'
        }]
      }
    },
    // /css
    //////////////////////////////

    imagemin: {
      lite: {
          files: [{
              expand: true,
              cwd: 'lite/images/',
              src: ['**/*.{gif,GIF,jpg,JPG,png,PNG}'],
              dest: 'lite/images/'
          }]
      },
      bannerold: {
          files: [{
              expand: true,
              cwd: 'images/branding/',
              src: ['**/*.{png,jpg,gif}'],
              dest: 'images/branding/'
          }]
      },
      new: {
          files: [{
              expand: true,
              cwd: 'new/images/',
              src: ['**/*.{gif,GIF,jpg,JPG,png,PNG}'],
              dest: 'new/images/'
          }]
      },
      old: {
          files: [{
              expand: true,
              cwd: 'images/',
              src: ['**/*.{gif,GIF,jpg,JPG,png,PNG}'],
              dest: 'images/'
          }]
      }
    },


    svgmin: {                       // Task
      options: {                  // Configuration that will be passed directly to SVGO
          plugins: [{
              removeViewBox: false
          }, {
              removeUselessStrokeAndFill: false
          }, {
              convertPathData: { 
                  straightCurves: false // advanced SVGO plugin option
              }
          }]
      },
      dist: {                     // Target
          files: [{               // Dictionary of files
              expand: true,       // Enable dynamic expansion.
              cwd: 'lite/images',     // Src matches are relative to this path.
              src: ['*.svg'],  // Actual pattern(s) to match.
              dest: 'lite/images',       // Destination path prefix.
              ext: '.svg'     // Dest filepaths will have this extension.
              // ie: optimise img/src/branding/logo.svg and store it in img/branding/logo.min.svg
          }]
      },
    },

    "svg-sprites": {
        // 'icons-meta': {
        //     options: {
        //         spriteElementPath: "lite/images/sprite/icons-meta",
        //         spritePath: "lite/images/sprite/icons-meta.svg",
        //         cssPath: "lite/less/sprite/",
        //         cssSuffix: 'less',
        //         cssSvgPrefix: '',
        //         cssPngPrefix: '.no-svg',
        //         layout: 'vertical',
        //         map: function (filename) {
        //             return filename.replace(/~/g, ":");
        //         },
        //         unit: 5
        //     }
        // },
        'ico-arrow': {
            options: {
                spriteElementPath: "lite/images/sprite/ico-arrow",
                spritePath: "lite/images/sprite/ico-arrow.svg",
                cssPath: "lite/less/sprite/",
                cssSuffix: 'less',
                cssSvgPrefix: '',
                cssPngPrefix: '.no-svg',
                layout: 'vertical',
                map: function (filename) {
                    return filename.replace(/~/g, ":");
                },
                unit: 200
            }
        },
        'ico-club': {
            options: {
                spriteElementPath: "lite/images/sprite/ico-club",
                spritePath: "lite/images/sprite/ico-club.svg",
                cssPath: "lite/less/sprite/",
                cssSuffix: 'less',
                cssSvgPrefix: '',
                cssPngPrefix: '.no-svg',
                layout: 'horizontal',
                map: function (filename) {
                    return filename.replace(/~/g, ":");
                },
                unit: 100
            }
        },
        'ico-product': {
            options: {
                spriteElementPath: "lite/images/sprite/ico-product",
                spritePath: "lite/images/sprite/ico-product.svg",
                cssPath: "lite/less/sprite/",
                cssSuffix: 'less',
                cssSvgPrefix: '',
                cssPngPrefix: '.no-svg',
                layout: 'horizontal',
                map: function (filename) {
                    return filename.replace(/~/g, ":");
                },
                unit: 100
            }
        },
        'ico-zodiac': {
            options: {
                spriteElementPath: "lite/images/sprite/ico-zodiac",
                spritePath: "lite/images/sprite/ico-zodiac.svg",
                cssPath: "lite/less/sprite/",
                cssSuffix: 'less',
                cssSvgPrefix: '',
                cssPngPrefix: '.no-svg',
                layout: 'horizontal',
                map: function (filename) {
                    return filename.replace(/~/g, ":");
                },
                unit: 100
            }
        },
        'ico-child-disease': {
            options: {
                spriteElementPath: "lite/images/sprite/ico-child-disease",
                spritePath: "lite/images/sprite/ico-child-disease.svg",
                cssPath: "lite/less/sprite/",
                cssSuffix: 'less',
                cssSvgPrefix: '',
                cssPngPrefix: '.no-svg',
                layout: 'horizontal',
                map: function (filename) {
                    return filename.replace(/~/g, ":");
                },
                unit: 100
            }
        },
        'horoscope-year-t': {
            options: {
                spriteElementPath: "lite/images/sprite/horoscope-year-t",
                spritePath: "lite/images/sprite/horoscope-year-t.svg",
                cssPath: "lite/less/sprite/",
                cssSuffix: 'less',
                cssSvgPrefix: '',
                cssPngPrefix: '.no-svg',
                layout: 'horizontal',
                map: function (filename) {
                    return filename.replace(/~/g, ":");
                },
                unit: 100
            }
        },
        'ico-spices': {
            options: {
                spriteElementPath: "lite/images/sprite/ico-spices",
                spritePath: "lite/images/sprite/ico-spices.svg",
                cssPath: "lite/less/sprite/",
                cssSuffix: 'less',
                cssSvgPrefix: '',
                cssPngPrefix: '.no-svg',
                layout: 'horizontal',
                map: function (filename) {
                    return filename.replace(/~/g, ":");
                },
                // refSize: 100,
                unit: 100
            }
        },
        // 'cook-choose': {
                //refSize: 75, 
                // sizes: {
                //     large: 130,
                //     mid: 75
                // },
        //         unit: 10
        //     }
        // },
        // 'comments-menu_a': {
        //     options: {
        //         spriteElementPath: "lite/images/sprite/cook-choose",
        //         spritePath: "lite/images/sprite/cook-choose.svg",
        //         cssPath: "lite/less/sprite/",
        //         cssSuffix: 'less',
        //         cssSvgPrefix: '',
        //         cssPngPrefix: '.no-svg',
        //         layout: 'horizontal',
        //         map: function (filename) {
        //             return filename.replace(/~/g, ":");
        //         },
        //         // refSize: 100,
        //         unit: 20
        //     }
        // },
    },

    watch: {

      // Следим за статическими страницами
      jadenew: {
        files: [ 'new/jade/page/**/*.jade'], // 'new/jade/page/**/*.jade',
        tasks: ['newer:jade:new'],
        options: {
          spawn: false,
          livereload: true,
        },
      },
      // Следим за статическими страницами
      jadelite: {
        files: [ 'lite/jade/page/**/*.jade'], // 'new/jade/page/**/*.jade',
        tasks: ['newer:jade:lite_dev'],
        options: {
          spawn: false,
          livereload: true,
        },
      },
      // Пересобираем документацию
      jadedocs: {
        files: ['new/jade/docs/**/*.jade', ], // 'lite/jade/docs/**/*.jade'
        tasks: ['jade:docs'],
        options: {
          spawn: false,
          livereload: true,
        },
      },
      // Пересобираем документацию
      jadedocs_lite: {
        files: ['lite/jade/docs/**/*.jade', ], // 'lite/jade/docs/**/*.jade'
        tasks: ['jade:docs_lite'],
        options: {
          spawn: false,
          livereload: true,
        },
      },
      // Следим за старым less 
      lessold: {
        files: ['less/**/*.less'],
        tasks: ['less:old', 'less:old_dev'],
        options: {
          livereload: true,
        },
      },
      // следим за новым less
      newless: {
        files: ['new/less/**/*.less'],
<<<<<<< HEAD
        tasks: ['less:newest', 'less:newestdev', /*'cmq','cssmin', 'csso'*/ ],
=======
        tasks: ['less:newestdev'/*, 'cmq', 'cssmin', 'csso'*/],
>>>>>>> 6081550e7a623a80fec29defb625e8f09b115fc3
        options: {
          livereload: true,
        },
      },
<<<<<<< HEAD
      // следим за новым less
=======
>>>>>>> 6081550e7a623a80fec29defb625e8f09b115fc3
      aviary: {
        files: ['new/less/**/aviary.hg.less'],
        tasks: ['less:aviary'],
        options: {
          livereload: true,
        },
      },
<<<<<<< HEAD
=======
      // следим за новым less
>>>>>>> 6081550e7a623a80fec29defb625e8f09b115fc3
      liteless: {
        files: ['lite/less/**/*.less'],
        tasks: ['less:litedev'/*, 'cmq', 'cssmin', 'csso'*/],
        options: {
          livereload: true,
        },
      },
      // Следим за изменениями в рассылках
      email: {
        files: ['new/html/email/**/*'],
        // tasks:['less:newest'],
        options: {
          livereload: true,
        },
      },


      // изобрражения сжатие
      image_lite: {
        files: ['lite/images/**/*.{gif,GIF,jpg,JPG,png,PNG}'],
        tasks:['newer:imagemin:lite'],
        options: {
          livereload: true,
        },
      },
      // изобрражения svg сжатие
      svg: {
        files: ['lite/images/**/*.svg'],
        tasks:['svgmin'],
        options: {
          livereload: true,
        },
      },
      // изобрражения
      svg_sprite: {
        files: ['lite/images/sprite/**/*.svg'],
        tasks:['svg-sprites'],
        options: {
          livereload: true,
        },
      },

    },

    csscomb: {
      options: {
          config: 'new/less/bootstrap/.csscomb.json'
      },
      aviary: {
          files: {
              'new/less/plugins/aviary.hg.less': ['new/less/plugins/aviary.hg.less'],
          },
      },
        
    },

    // Поднимаем сервер
    connect: {
      server: {
        options: {
          port: 4000,
          base: '.',
        }
      }
    },
  });

  //grunt.registerTask('bild', ['css:new', 'css:lite'/*, 'jade'*/]);
  grunt.registerTask('new-css', ['jade:new', 'less:newestdev', /*'uncss:new', 'cmq:new',*/ 'cssmin:new', 'csso:new']);

  // lite tasks
  // bild lite версии
  grunt.registerTask('lite', ['jade:lite_prod', 'less:litedev','uncss:lite_blog','uncss:services','uncss:services_user', 'cmq:redactor', 'cmq:lite', 'cssmin:lite', 'csso:lite']);

  grunt.registerTask('lite-css', [/*'jade:lite_prod',*/ 'less:litedev','uncss:lite_blog','uncss:services', 'uncss:services_user','uncss:member', 'uncss:member_user', 'cmq:redactor', 'cmq:lite', 'cssmin:lite', 'csso:lite']);
  // Блоги
  grunt.registerTask('blog', ['jade:lite_prod', 'less:litedev','uncss:lite_blog', 'cmq:lite', 'cssmin:lite', 'csso:lite']);
  // сервисы
  grunt.registerTask('services', ['jade:lite_prod', 'less:litedev','uncss:services', 'cmq:lite', 'cssmin:lite', 'csso:lite']);

  // Базовый для разработки верстки
  grunt.registerTask('default', [
    'connect',
    'watch', 
  ]);
};