// Init scrollStopped jQuery plugin
$.fn.scrollStopped = function(callback) {
    $(this).scroll(function() {
        var self = this, $this = $(self);
        if ($this.data('scrollTimeout')) {
            clearTimeout($this.data('scrollTimeout'));
        }
        $this.data('scrollTimeout', setTimeout(callback, 250, self));
    });
};

// Init TOC
(function() {
    $('h1,h2,h3,h4,h5,a').removeAttr('id');

    gajus.contents.formatId = function(str){
        if(/^[0-9]/.test(str)){
            str = '_'+str;
        }
        return str.replace(/ /g,'_').replace(/[^a-zA-Z_0-9\u4e00-\u9fa5]/g,'_');
    };

    var tocContents = gajus.contents({
        contents: document.querySelector('#toc-wrapper'),
        articles: $('.col-sm-9').find('h1, h2, h3, h4').get()
    });

    // Add essential classes
    $('#toc-wrapper ol').first().attr('id','toc');
    $('#toc').addClass('nav');

    tocContents.eventProxy.on('ready', function () {
        doSideBar();
        if(window.location.hash){//因为 dom改变导致 hash位置不正确，需要进行重新定位
            window.location=window.location.hash;
        }
    });
})();

var SidebarAffixShadow = $('.sidebar-affix-shadow');
var updateSidebarAffixShadowWidth = function() {
    var tocWidth = $('#left-nav').width();
    SidebarAffixShadow.removeClass('bottom').addClass('on').attr('data-width', tocWidth);
    $('style[title=css-sidebar-affix-shadow-width]').remove();
    $('head').append('<style title=css-sidebar-affix-shadow-width>.sidebar-affix-shadow:before, .sidebar-affix-shadow:after {width: ' + tocWidth + 'px;}</style>');
    $('#toc-wrapper').width(tocWidth);
};

// Sidebar affix
var doSideBar = function() {
    $('.sidebar-loading').removeClass('on');
    $('.sidebar-wrapper').affix({
        offset: {
            top: 80,
            bottom: function () {
                return (this.bottom = $('.footer').outerHeight(true));
            }
        }
    })
        .on('affix.bs.affix', function (e) {
            updateSidebarAffixShadowWidth();
        })
        .on('affix-top.bs.affix', function (e) {
            // If scrolls back to top
            $('#toc-wrapper').removeAttr('style');
            SidebarAffixShadow.removeClass('bottom on');
        })
        .on('affix-bottom.bs.affix', function (e) {
            // If window reaches bottom (Affix style)
            SidebarAffixShadow.addClass('bottom').removeClass('on');
        });
};

var updateScrollSpy = function() {
    setTimeout(function(){
        $('body').scrollspy({ target: '.sidebar-wrapper' });
    }, 200);
};

// Add a hover class to detect if users mouse is hovering over the sidebar
var addSidebarHoverListener = function() {
    $('.sidebar-affix-shadow').hover(
        function() {
            $(this).removeClass('sidebar-hover-off');
        }, function() {
            $(this).addClass('sidebar-hover-off');
        }
    );
};

// Smooth scrolling, disabled by default
var initSmoothScroll = function() {
    // Bind to the click of all links with a #hash in the href
    $('a[href^="#"]').click(function(e) {
        // Prevent the jump and the #hash from appearing on the address bar
        e.preventDefault();
        // Scroll the window, stop any previous animation, stop on user manual scroll
        // Check https://github.com/flesler/jquery.scrollTo for more customizability
        $(window).stop(true).scrollTo(this.hash, {duration: 400, interrupt: true});
    });
};

// Init GitHub links
var initGitHubLinks = function() {
    // var currentPath = window.location.pathname.match(/.*\/(.+).html/i)[1];
    // $('#content').prepend("<div class=docs-meta>\
    //     <span class='icon icon-github'></span>\
    //     <a href='https://github.com/leancloud/docs#贡献'>编辑文档</a>\
    //   </div>");
    $('.sidebar-wrapper #toc').append("<li class=sidebar-meta><a href='#' class=do-expand-all>展开所有</a> <a href='#top' class=back-to-top>返回顶部</a></li>");
};

function sidebarExpandAll() {
    var el = $('.do-expand-all');
    var target = $('.sidebar-wrapper');

    el.on('click', function(e) {
        e.preventDefault();
        target.toggleClass('expand-all');
        $(this).text(function(i, t) {
            return t === '展开所有' ? '折叠所有' : '展开所有';
        });
    });
}

var initScrollHistoryState = function() {
    var activeItem = $('#toc li .active').last().find('a').attr('href');
    if (typeof activeItem === 'undefined') {
        activeItem = '';
    }

    // Will change URL without reloading, affecting the history
    history.replaceState('data', 'title', location.origin + location.pathname + activeItem);
    console.log(location.origin + location.pathname + activeItem);
};

var codeBlockTabber = (function() {
    'use strict';

    // save some bytes
    var w = window,
        d = document;

    function uniqArr(a) {
        var seen = {};
        return a.filter(function(item) {
            return seen.hasOwnProperty(item) ? false : (seen[item] = true);
        });
    }

    function checkCodeBlocks() {
        var $codeBlocks = $('.prettyprint');
        var langLabelMap = {
            'lang-swift': 'Swift',
            'lang-objc': 'Objective-C',
            'lang-objective-c': 'Objective-C',
            'lang-php': 'PHP',
            'lang-javascript': 'JavaScript',
            'lang-js': 'JavaScript',
            'lang-python': 'Python',
            'lang-java': 'Java',
            'lang-ts':'TypeScript',
            'lang-es7': 'ECMAScript7',
            'lang-html': 'HTML',
            'lang-cs': 'C#'
        };

        // Multilingual init
        var $translatableElements = $('code, var');
        var snippetMap = {};
        var snippetDefault = 'objc';
        var snippetsJson = 'custom/js/languages.json';
        $.getJSON(snippetsJson, function(data) {
            snippetMap = data;
        })
            .done(function() {
                $.each($translatableElements, function () {
                    for (var key in snippetMap[snippetDefault]) {
                        if ($(this).text() === key) {
                            $(this).attr('data-translatable', key);
                        }
                    }
                });
            })
            .fail(function() { console.log('fetch language error'); })
            .always(function() { console.log('fetch language complete'); });

        $.each($codeBlocks, function () {
            var $current = $(this);
            var currentCodeClass = $current.children().attr('class');

            var $nextAll = $current.nextUntil('*:not(pre)');
            var nextCodeClass = $current.next('.prettyprint').children().attr('class');
            var nextAllLangs = [currentCodeClass];
            var tabToggleDoms = [];
            var isFirstBlock = true;

            // if $nextAll exists, push lang tags to a temporary array
            if ($nextAll) {
                $.each($nextAll, function () {
                    var lang = $(this).children().attr('class');
                    nextAllLangs.push(lang);
                });
            }

            // if it's the very first code block of current scope
            if ($current.prev().hasClass('prettyprint')) {
                isFirstBlock = false;
            }

            // prepare toggler DOM
            $.each(nextAllLangs, function (i, lang) {
                tabToggleDoms.push('\
          <div class="toggle-item">\
            <a class="toggle" data-toggle-lang="' + lang + '" href="#">' + langLabelMap[lang] + '</a>\
          </div>\
        ');
            });

            if (nextCodeClass) {
                $current.addClass('codeblock-toggle-enabled');

                if (currentCodeClass !== nextCodeClass) {
                    var langCounter = uniqArr(nextAllLangs).length - 1;

                    // hide silbing element
                    $.each($nextAll, function () {
                        $(this).addClass('codeblock-toggle-enabled');
                        $(this).hide();
                    });

                    // append toggle
                    if (isFirstBlock) {
                        $('<div/>', {
                            class: "code-lang-toggles",
                            html: tabToggleDoms.join('')
                        }).insertAfter($nextAll.last());
                    }

                    $('.code-lang-toggles .toggle-item:first-child .toggle').addClass('active');
                }
            }
        });

        $('.code-lang-toggles .toggle').click(function (e) {
            e.preventDefault();
            var targetLang = $(this).data('toggle-lang');
            var $blocks = $('.codeblock-toggle-enabled');

            // check if is switching to another language first
            if (!$(this).hasClass('active')) {
                var prevHeihgt = 0;
                var nextHeight = 0;
                var heightOffset = 0;

                // sum all heights of previous visible code blocks with multilang enabled
                $(this).closest('.code-lang-toggles').prevAll('.codeblock-toggle-enabled:visible').each(function () {
                    prevHeihgt += $(this).outerHeight(true);
                });

                // sum all heights of previous hidden code blocks with multilang enabled, also excludes unrelated (non-targetLang) codeblocks
                $(this).closest('.code-lang-toggles').prevAll('.codeblock-toggle-enabled').not(':visible').find('.' + targetLang).parent().each(function () {
                    nextHeight += $(this).outerHeight(true);
                });

                heightOffset = prevHeihgt - nextHeight;

                if (heightOffset !== 0) {
                    var currentTop = document.documentElement.scrollTop || document.body.scrollTop;
                    window.scrollTo(0, currentTop - heightOffset);
                    console.log('codeblock height offset: ' + heightOffset);
                }
            }

            console.log('switching to ' + targetLang);

            $.each($('.code-lang-toggles'), function () {
                var langArr = [];
                var $toggles = $(this).find('.toggle');

                $.each($toggles, function () {
                    var lang = $(this).data('toggle-lang');
                    langArr.push(lang);
                });

                if (langArr.indexOf(targetLang) > - 1) {
                    // Update toggler visibility
                    $(this).find('.toggle').removeClass('active');
                    $(this).find('.toggle[data-toggle-lang=' + targetLang + ']').addClass('active');

                    // Update codeblock visibility
                    var $codeBlocks = $(this).prevUntil('*:not(.codeblock-toggle-enabled)');
                    $.each($codeBlocks, function () {
                        var $current = $(this);
                        var currentCodeClass = $current.children().attr('class');

                        if (currentCodeClass === targetLang) {
                            $current.show();
                        } else {
                            $current.hide();
                        }
                    });
                } else {
                    console.log('No matching codeblock in current scope!');
                }
            });

            // Update strings for specific language
            $.each($translatableElements, function () {
                var currentLang = targetLang.split('-').pop();
                var snippets = snippetMap[currentLang];
                for (var key in snippets) {
                    if ($(this).data('translatable') === key) {
                        $(this).text(snippets[key]);
                    }
                }
            });
        });
    }

    return {
        start: checkCodeBlocks
    };

})();

$(function() {
    prettyPrepare(); // prepare elements that need to be prettified
    refactDom();//
    prettyPrint(updateScrollSpy);
    glueCopy();
    updateScrollSpy();
    addSidebarHoverListener();
    initGitHubLinks();
    sidebarExpandAll();
    codeBlockTabber.start();
    // initSmoothScroll();

    var arr = $('#toc ul').parents('li');
    angular.forEach(arr, function(v, k) {
        var a = $(v).children('a:first-child');
        a.addClass('has-subdoc-nav');
    });

    setTimeout(function() {
        updateSidebarAffixShadowWidth();
    }, 400);

});

// If the cursor is off the sidebar, scrolls to parent active heading
$(window).scrollStopped(function() {
    var activeToc = $('#toc > li .active').first();
    if (activeToc.length === 0) {
        activeToc = $('#toc > li:first-child');
    }

    setTimeout(function() {
        $('.sidebar-affix-shadow.on.sidebar-hover-off .sidebar-wrapper').scrollTo(activeToc, 800, {offset: -20});
        // console.log('Haven't scrolled in 250ms, fired in 250ms later.');
        updateSidebarAffixShadowWidth();
        initScrollHistoryState();
    }, 200);
});

$(window).resize(function() {
    updateSidebarAffixShadowWidth();
});

$(window).load(function() {
    //2016-11-07 add scrollbar for out-streched tables
    $('.doc-content table').each(function(index, el) {
        var $el = $(el);
        if ( $el.outerWidth() > $('.doc-content').width() ){
            $el.css('display','block');
        }
    });
});