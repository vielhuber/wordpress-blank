<?php
namespace WP;

class Core
{
    public function __construct()
    {
        $this->init();
    }

    private function init()
    {
        /* general */
        $this->addMenus();
        $this->addConstants();
        $this->addMetaTags();
        $this->addFavicon();
        $this->removeEmojis();
        $this->enableSvgUpload();
        $this->removeAllDashboardWidgets();
        $this->detectPageSpeedInsights();
        $this->removeBulkHeaderLinksAndOembed();
        $this->alwaysEnableShowHiddenCharactersInTinyMce();
        $this->disableEmailBugAlerts();
        $this->sendMailsNotOnProductionToDeveloper();
        $this->removePrivacyPolicyLinkFromLogin();
        $this->resetWordPressLoginFormLayout();
        $this->addThemeSupportForBasicFeatures();
        $this->enableCustomEditorStyle();
        $this->disableBackendLanguageSwitcher();
        $this->disableAutoParagraph();
        $this->disableUnneededArchives();
        $this->disableMediaSlugsFromTakingAwayPageSlugs();
        $this->disableWelcomeEmailsOnMultisiteRegistrations();
        $this->disablePasswordChangeMails();
        //$this->disableFrontendBackendOnTesting();
        //$this->disableAutoQuoteConversion();

        /* adminbar */
        //$this->hideAdminbarInFrontend();
        $this->showAdminbarInFrontendOnHover();

        /* js */
        $this->loadJsBasicWithLocalize();
        //$this->loadJsAdvanced();
        //$this->loadJsWithJQuery();
        //$this->makeStringsAvailableInJsWithoutLocalizeScript();

        /* css */
        $this->loadCssInline();
        //$this->loadCssAdvanced();
        //$this->loadCssBasic();

        /* cache busting */
        $this->enableCacheBusting();

        /* media */
        $this->addBasicImageSizes();
        $this->preventResizeOfBigImages();
        $this->backendSearchInAltTags();
        //$this->forceUseOfImageMagick();
        //$this->disableStripExifIptcFromImages();
        //$this->increaseImageQualityOfResizedImages();

        /* security */
        $this->disableUserSniffing();
        $this->blockSubscribersFromAdmin();
        $this->removeWordPressVersionInHead();
        //$this->disableWpCors();
        //$this->fixWpJsonOrigin();

        /* performance */
        $this->addAsyncDeferToJsFiles();
        $this->removeTypeTextJavaScriptForValidation();
        $this->disableGlobalGutenbergStylesInFrontend();
        $this->disablejQueryAndOtherScriptsAddedByPlugins();
        //$this->disableAllScriptsStylesinFrontend();

        /* plugins */
        $this->yoastAddCustomSeparator();
        $this->yoastShowEmptyCategoriesInSitemap();
        $this->enableMediaReplaceDisableOption();
        $this->advancedCustomFieldsRemoveEditorsOnAllPages();
        $this->advancedCustomFieldsReenableCustomMetaBox();
        $this->advancedCustomFieldsReduceWysiwygHeight();
        $this->advancedCustomFieldsFixDraftPreview();
        $this->advancedCustomFieldsFlexibleContentPreview();
        $this->webPConverterAndCropThumbnailsFixPluginConflict();
        $this->autoClearCacheForWpFastestCache();
        $this->fixLeadingCodeSpacesForWpFastestCache();
        $this->cropThumbnailsOnlyShowNeededSize();
        $this->cropThumbnailsEnableEverywhere();
        $this->blockListUpdaterModifySpamlist();
        $this->allowEditorsToAddHTMLToTextareaFields();
        //$this->advancedCustomFieldsAddQuickLinkToRefs();
    }

    /* public functions */

    public static function isProduction()
    {
        return strpos($_SERVER['HTTP_HOST'], '.local') === false &&
            strpos($_SERVER['HTTP_HOST'], 'close2dev') === false &&
            strpos($_SERVER['HTTP_HOST'], '192.168.178') === false;
    }

    public static function asciiArt()
    {
        $rand = [
            '____________/\\\\\\_______/\\\\\\\\\\\\\\\\\\_____________
___________/\\\\\\\\\\_____/\\\\\\///////\\\\\\__________
__________/\\\\\\/\\\\\\____\\///______\\//\\\\\\________
_________/\\\\\\/\\/\\\\\\______________/\\\\\\/________
________/\\\\\\/__\\/\\\\\\___________/\\\\\\//_________
_______/\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\_____/\\\\\\//___________
_______\\///////////\\\\\\//____/\\\\\\/_____________
__________________\\/\\\\\\_____/\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\__
___________________\\///_____\\///////////////__',
            ' __   __       # _____       #
/__/\/__/\     #/_____/\     #
\  \ \: \ \__  #\:::_:\ \    #
 \::\_\::\/_/\ #    _\:\|    #
  \_:::   __\/ #   /::_/__   #
       \::\ \  #   \:\____/\ #
        \__\/  #    \_____\/ #
               #             #',
            '➖➖➖➖➖➖➖➖➖➖➖➖➖➖➖
➖🟩🟩➖➖🟩🟩➖🟩🟩🟩🟩🟩🟩➖
➖🟩🟩➖➖🟩🟩➖🟩🟩🟩🟩🟩🟩➖
➖🟩🟩➖➖🟩🟩➖➖➖➖➖🟩🟩➖
➖🟩🟩➖➖🟩🟩➖➖➖➖➖🟩🟩➖
➖🟩🟩🟩🟩🟩🟩➖🟩🟩🟩🟩🟩🟩➖
➖🟩🟩🟩🟩🟩🟩➖🟩🟩🟩🟩🟩🟩➖
➖➖➖➖➖🟩🟩➖🟩🟩➖➖➖➖➖
➖➖➖➖➖🟩🟩➖🟩🟩➖➖➖➖➖
➖➖➖➖➖🟩🟩➖🟩🟩🟩🟩🟩🟩➖
➖➖➖➖➖🟩🟩➖🟩🟩🟩🟩🟩🟩➖
➖➖➖➖➖➖➖➖➖➖➖➖➖➖➖',
            '██╗  ██╗██████╗ 
██║  ██║╚════██╗
███████║ █████╔╝
╚════██║██╔═══╝ 
     ██║███████╗
     ╚═╝╚══════╝',
            '                      
  _/  _/      _/_/    
 _/  _/    _/    _/   
_/_/_/_/      _/      
   _/      _/         
  _/    _/_/_/_/      
                      ',
            '       _              _       
   _  /\ \          /\ \      
  /\_\\ \ \        /  \ \     
 / / / \ \ \      / /\ \ \    
/ / /   \ \ \     \/_/\ \ \   
\ \ \____\ \ \        / / /   
 \ \________\ \      / / /    
  \/________/\ \    / / /  _  
            \ \ \  / / /_/\_\ 
             \ \_\/ /_____/ / 
              \/_/\________/  
                              '
        ];
        $rand = $rand[mt_rand(0, count($rand) - 1)];
        echo "<!--
$rand
-->
";
    }

    /* private functions */

    private function removeAllDashboardWidgets()
    {
        add_action(
            'wp_dashboard_setup',
            function () {
                global $wp_meta_boxes;
                // remove specific widget
                //unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
                // remove all widgets
                unset($wp_meta_boxes['dashboard']);
            },
            PHP_INT_MAX
        );
    }

    private function disableFrontendBackendOnTesting()
    {
        if (strpos($_SERVER['HTTP_HOST'], 'close2dev') !== false) {
            // frontend redirect to backend
            if (!is_admin() && !in_array($GLOBALS['pagenow'], ['wp-login.php', 'wp-register.php'])) {
                wp_redirect(get_admin_url());
                die();
            }
            // disable backend also
            else {
                die();
            }
        }
    }

    private function detectPageSpeedInsights()
    {
        add_action(
            'wp_head',
            function () {
                echo '<script>window.pagespeed = navigator.userAgent.indexOf(\'Speed Insights\') > -1 || navigator.userAgent.indexOf(\'Chrome-Lighthouse\') > -1;</script>';
            },
            -9999
        );
    }

    private function blockListUpdaterModifySpamlist()
    {
        // add more whitelisted keywords
        add_filter(
            'option_disallowed_keys',
            function ($input) {
                if ($input != '') {
                    foreach (['online.de'] as $whitelist__value) {
                        $input = str_replace($whitelist__value, 'MANUALLY_DISABLED_KEYWORD', $input);
                    }
                }
                return $input;
            },
            PHP_INT_MAX
        );
    }

    private function allowEditorsToAddHTMLToTextareaFields()
    {
        // see https://www.advancedcustomfields.com/resources/html-escaping/ / https://kellenmace.com/add-unfiltered_html-capability-to-admins-or-editors-in-wordpress-multisite/
        add_filter(
            'map_meta_cap',
            function ($caps, $cap, $user_id) {
                if ('unfiltered_html' === $cap && user_can($user_id, 'editor')) {
                    $caps = ['unfiltered_html'];
                }
                return $caps;
            },
            1,
            3
        );
    }

    private function blockSubscribersFromAdmin()
    {
        add_action('init', function () {
            if (is_admin() && !defined('DOING_AJAX') && current_user_can('read') && !current_user_can('edit_posts')) {
                wp_redirect(home_url());
                die();
            }
        });
    }

    private function disableBackendLanguageSwitcher()
    {
        // wordpress
        add_filter('login_display_language_dropdown', '__return_false');
        // wpml
        add_action('login_head', function() {
            echo '<style>.wpml-login-ls { display: none !important; }</style>';
        });
    }

    private function removeBulkHeaderLinksAndOembed()
    {
        // remove oembed links in header (ryte gives otherwise errors)
        remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
        // remove the rest api endpoint.
        remove_action('rest_api_init', 'wp_oembed_register_route');

        // remove wp-json rest api links in header (ryte gives otherwise errors)
        remove_action('wp_head', 'rest_output_link_wp_head', 10);
        // remove windows live writer manifest in header
        remove_action('wp_head', 'wlwmanifest_link');
        // remove rsd link in header
        remove_action('wp_head', 'rsd_link');
    }

    private function alwaysEnableShowHiddenCharactersInTinyMce()
    {
        add_filter('tiny_mce_before_init', function ($settings) {
            $settings['visualchars_default_state'] = true;
            return $settings;
        });
    }

    private function disableEmailBugAlerts()
    {
        add_filter(
            'recovery_mode_email',
            function ($email, $url) {
                $email['to'] = 'unknown@local';
                return $email;
            },
            10,
            2
        );
    }

    private function sendMailsNotOnProductionToDeveloper()
    {
        if (!self::isProduction()) {
            add_filter('wp_mail', function ($data) {
                // exclude welcome reset mails
                if (strpos($data['subject'], 'Anmeldedaten') !== false) {
                    return $data;
                }
                // exclude specific email
                if (@$data['to'] === 'i-want-to-test@tld.com') {
                    return $data;
                }
                $data['to'] =
                    isset($_SERVER['SERVER_ADMIN']) &&
                    $_SERVER['SERVER_ADMIN'] != '' &&
                    strpos($_SERVER['SERVER_ADMIN'], '@') !== false &&
                    strpos($_SERVER['SERVER_ADMIN'], 'webmaster@') === false
                        ? $_SERVER['SERVER_ADMIN']
                        : 'support@close2.de';
                return $data;
            });
        }
    }

    private function yoastAddCustomSeparator()
    {
        add_filter('wpseo_separator_options', function ($separators) {
            return array_merge($separators, [
                'sc-doubleslash' => '//'
            ]);
        });
    }

    private function removePrivacyPolicyLinkFromLogin()
    {
        add_filter('the_privacy_policy_link', '__return_empty_string');
    }

    private function resetWordPressLoginFormLayout()
    {
        add_action('login_enqueue_scripts', function () {
            if (isset($GLOBALS['pagenow']) && $GLOBALS['pagenow'] === 'wp-login.php') { ?>
                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        if( document.querySelector('input[name="rememberme"]') !== null ) {
                            document.querySelector('input[name="rememberme"]').checked = true;
                        }
                    });
                </script>
                <style>
                body {
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    align-items:center;
                    min-height: 100vh;
                }
                #login {
                    padding: 0 !important;
                }
                .login form {
                    margin-top: 0 !important;
                }
                h1, #nav, #backtoblog {
                    display:none;
                }
                </style>
            <?php }
        });
    }

    private function hideAdminbarInFrontend()
    {
        add_filter('show_admin_bar', '__return_false');
    }

    private function showAdminbarInFrontendOnHover()
    {
        // remove margin top from html
        add_theme_support('admin-bar', ['callback' => '__return_false']);
        // add styles
        add_action('wp_head', function () {
            ?>
            <style>
            #wpadminbar { opacity: 0; transition: opacity 0.25s ease-in-out; }
            #wpadminbar:hover { opacity: 1; }
            </style>
            <?php
        });
    }

    private function preventResizeOfBigImages()
    {
        // >2k (wp >= 5.3 by default creates -scaled versions when higher)
        add_filter('big_image_size_threshold', '__return_false');
    }

    private function videoCookieConsent($provider)
    {
        $provider_full_name = '';
        switch ($provider) {
            case 'youtube':
                $provider_full_name = 'YouTube';
                break;
            case 'vimeo':
                $provider_full_name = 'Vimeo';
                break;
        }

        return '<div class="privacy-text hidden"><div class="privacy-text__inner">' .
            '<div class="optoutin"><span class="optoutin-switch" data-cookie="cc_accept_' .
            $provider .
            '"><span class="switch rounded-important"></span></span><div class="text">' .
            sprintf(
                'Ich möchte %s-Inhalte aktivieren und stimme zu, dass Daten von %s geladen werden (siehe %sDatenschutz%s)',
                $provider_full_name,
                $provider_full_name,
                '<a href="' .
                    get_permalink(get_field('page_privacy', 'option')->ID) .
                    '" target="_blank" class="underline">',
                '</a>'
            ) .
            '</div></div></div></div>';
    }

    private function backendSearchInAltTags()
    {
        add_filter(
            'posts_clauses',
            function ($pieces) {
                global $wp_query, $wpdb;
                $vars = $wp_query->query_vars;
                if (empty($vars)) {
                    $vars = isset($_REQUEST['query']) ? $_REQUEST['query'] : [];
                }
                if (
                    !empty($vars['s']) &&
                    ((isset($_REQUEST['action']) && $_REQUEST['action'] == 'query-attachments') ||
                        $vars['post_type'] == 'attachment')
                ) {
                    $pieces['where'] = str_replace(
                        "$wpdb->posts.post_title LIKE",
                        $wpdb->prepare(
                            "(pm.meta_key IN ('_wp_attachment_image_alt') AND pm.meta_value LIKE %s) OR $wpdb->posts.post_title LIKE",
                            '%' . $wpdb->esc_like($vars['s']) . '%'
                        ),
                        $pieces['where']
                    );
                    $pieces['join'] .= " LEFT JOIN $wpdb->postmeta AS pm ON $wpdb->posts.ID = pm.post_id";
                }
                return $pieces;
            },
            0
        );
    }

    private function increaseImageQualityOfResizedImages()
    {
        add_filter('jpeg_quality', function ($arg) {
            return 100;
        });
    }

    private function forceUseOfImageMagick()
    {
        // wp uses it by default when installed, so this is only needed in special environments; check with site health > report
        add_filter('wp_image_editors', function () {
            return ['WP_Image_Editor_Imagick'];
        });
    }

    private function disableStripExifIptcFromImages()
    {
        // don't strip exif/iptc data from images
        // only works with imagemagick enabled and when no other plugins interfer or reset it
        // also never strips copyright information when set to true(!)
        add_filter('image_strip_meta', false);
    }

    private function addAsyncDeferToJsFiles()
    {
        // be careful when using this!
        add_filter(
            'script_loader_tag',
            function ($tag, $handle) {
                if (is_admin() || $GLOBALS['pagenow'] == 'wp-login.php') {
                    return $tag;
                }
                return str_replace(' src', ' async defer src', $tag);
            },
            10,
            2
        );
    }

    private function removeTypeTextJavaScriptForValidation()
    {
        add_filter(
            'script_loader_tag',
            function ($tag, $handle) {
                $tag = str_replace('script type=\'text/javascript\'', 'script', $tag);
                return $tag;
            },
            10,
            2
        );
    }

    private function disableGlobalGutenbergStylesInFrontend()
    {
        add_action('wp_enqueue_scripts', function () {
            wp_dequeue_style('global-styles');
        });
    }

    private function disablejQueryAndOtherScriptsAddedByPlugins()
    {
        // disable jquery and other scripts added by plugins (be careful when using this!)
        // if you really need them bundle them locally(!) in your package.json
        add_action('wp_enqueue_scripts', function () {
            wp_deregister_script('jquery');
            wp_deregister_style('wp-block-library'); // gutenberg
            wp_deregister_style('classic-theme-styles'); // gutenberg
        });
        add_action('wp_footer', function () {
            wp_deregister_script('wp-embed');
        });
        if (!is_admin()) {
            define('WPFC_HIDE_TOOLBAR', true);
        }
    }

    private function disableAllScriptsStylesinFrontend()
    {
        /* this is a more strict variant: deregister all scripts/styles in frontend */
        add_action('wp_enqueue_scripts', function () {
            global $wp_styles;
            foreach ($wp_styles->queue as $style_handle) {
                wp_dequeue_style($style_handle);
            }
            global $wp_scripts;
            foreach ($wp_scripts->queue as $script_handle) {
                wp_dequeue_script($script_handle);
            }
        });
    }

    private function makeStringsAvailableInJsWithoutLocalizeScript()
    {
        // make strings available in js without specific registered script (access with window.settings.***)
        add_action('wp_head', function () {
            ?>
            <script>
            var settings = <?php echo json_encode([
                'baseurl' => get_bloginfo('url'),
                'tplurl' => get_bloginfo('template_directory'),
                'resturl' => rest_url(),
                'lng' => defined('ICL_LANGUAGE_CODE') ? ICL_LANGUAGE_CODE : 'en',
                'nonce' => wp_create_nonce('wp_rest'),
                'environment' => self::isProduction() ? 'prod' : 'dev'
            ]); ?>
            </script>
            <?php
        });
    }

    private function loadJsBasicWithLocalize()
    {
        // in header, because we use async
        add_action('wp_enqueue_scripts', function () {
            wp_enqueue_script('script', get_bloginfo('template_directory') . '/_build/bundle.js', [], false, false);
            // make urls available in js (access with window.settings.***)
            wp_localize_script('script', 'settings', [
                'baseurl' => get_bloginfo('url'),
                'tplurl' => get_bloginfo('template_directory'),
                'resturl' => rest_url(),
                'lng' => defined('ICL_LANGUAGE_CODE') ? ICL_LANGUAGE_CODE : 'en',
                'nonce' => wp_create_nonce('wp_rest'),
                'environment' => self::isProduction() ? 'prod' : 'dev'
            ]);
        });
    }

    private function loadJsAdvanced()
    {
        /* further delay js loading (only use for highly optimized pages) */
        add_action('wp_footer', function () {
            echo '<script>
                var script = document.createElement(\'script\');
                script.src = \'' .
                get_bloginfo('template_directory') .
                '/_build/bundle.js\';
                if( window.pagespeed ) {
                    // we don\'t need dom ready here
                    //document.addEventListener(\'DOMContentLoaded\', function() {
                        /* do some lighthouse specific stuff */
                        // too many dom elements
                        document.querySelectorAll(\'.section + .section\').forEach($el => { $el.remove(); });
                        // accessibility
                        document.querySelectorAll(\'.specific-element\').forEach($el => {
                            $el.style.backgroundColor = \'#fff\';
                            $el.style.fontSize = \'16px\';
                        });
                        // show elements above the fold before js init
                        let slider = document.querySelector(\'.intro-slider\');
                        if( slider !== null ) { slider.style.opacity = 1; }  
                        // mobile
                        if( window.innerWidth < 700 ) {         
                            document.querySelectorAll(\'.duration-500\').forEach($el => {
                                $el.style.transition = \'none\';
                            });
                        }
                    //});
                    // delay loading (only on desktop)
                    if( window.innerWidth >= 700 ) {
                        window.addEventListener(\'load\', function() {
                            setTimeout(function() {
                                document.head.appendChild(script);
                            }, 6500);
                        });
                    }
                }
                else {
                    document.head.appendChild(script);
                }
            </script>';
        });
    }

    private function loadJsWithJQuery()
    {
        add_action('wp_enqueue_scripts', function () {
            wp_enqueue_script('script', get_bloginfo('template_directory') . '/_build/bundle.js', ['jquery']);
            wp_enqueue_script('jquery');
        });
    }

    private function loadCssInline()
    {
        // fully embed css
        add_action('wp_head', function () {
            if (file_exists(get_template_directory() . '/_build/bundle.css')) {
                echo '<style>';
                $stylesheet = file_get_contents(get_template_directory() . '/_build/bundle.css');
                // replace relative paths
                $stylesheet = str_replace(
                    'url("../_',
                    'url("' . get_bloginfo('template_directory') . '/_',
                    $stylesheet
                );
                $stylesheet = str_replace(
                    'url(\'../_',
                    'url(\'' . get_bloginfo('template_directory') . '/_',
                    $stylesheet
                );
                $stylesheet = str_replace('url(../_', 'url(' . get_bloginfo('template_directory') . '/_', $stylesheet);
                // tailwind invalid variables fix (https://github.com/tailwindlabs/tailwindcss/issues/7121)
                $stylesheet = str_replace(' ;--tw', 'var(--tw-empty,/*!*/ /*!*/);--tw', $stylesheet);
                $stylesheet = preg_replace('/(;--tw-.+?:)( )(})/', '$1var(--tw-empty,/*!*/ /*!*/);$3', $stylesheet);
                echo $stylesheet;
                // this is how to embed adobe fonts (typekit)
                /*
                echo PHP_EOL;
                $stylesheet = file_get_contents('https://use.typekit.net/xxxxxxx.css');
                echo $stylesheet;
                */
                echo '</style>';
            }
        });
    }

    private function loadCssAdvanced()
    {
        // split in critical/non-critical
        // load css (critical)
        add_action('wp_head', function () {
            if (file_exists(get_template_directory() . '/_build/bundle-critical.css') && self::isProduction()) {
                echo '<style>';
                $stylesheet = file_get_contents(get_template_directory() . '/_build/bundle-critical.css');
                // replace relative paths
                $stylesheet = str_replace(
                    'url("../_',
                    'url("' . get_bloginfo('template_directory') . '/_',
                    $stylesheet
                );
                $stylesheet = str_replace(
                    'url(\'../_',
                    'url(\'' . get_bloginfo('template_directory') . '/_',
                    $stylesheet
                );
                $stylesheet = str_replace('url(../_', 'url(' . get_bloginfo('template_directory') . '/_', $stylesheet);
                echo $stylesheet;
                echo '</style>';
            }
        });
        // load css (non-critical)
        add_action('wp_footer', function () {
            // https://github.com/filamentgroup/loadCSS
            echo '<link rel="preload" href="' .
                get_bloginfo('template_directory') .
                '/_build/bundle.css' .
                (!self::isProduction() ? '?ver=' . mt_rand(1000, 9999) : '') .
                '" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">';
            echo '<noscript><link rel="stylesheet" href="' .
                get_bloginfo('template_directory') .
                '/_build/bundle.css"></noscript>';
            echo '<script>';
            echo '(function(a){"use strict";a.loadCSS||(a.loadCSS=function(){});var b=loadCSS.relpreload={};if(b.support=function(){var d;try{d=a.document.createElement("link").relList.supports("preload")}catch(f){d=!1}return function(){return d}}(),b.bindMediaToggle=function(d){function f(){d.media=g}var g=d.media||"all";d.addEventListener?d.addEventListener("load",f):d.attachEvent&&d.attachEvent("onload",f),setTimeout(function(){d.rel="stylesheet",d.media="only x"}),setTimeout(f,3e3)},b.poly=function(){if(!b.support())for(var g,d=a.document.getElementsByTagName("link"),f=0;f<d.length;f++)g=d[f],"preload"!==g.rel||"style"!==g.getAttribute("as")||g.getAttribute("data-loadcss")||(g.setAttribute("data-loadcss",!0),b.bindMediaToggle(g))},!b.support()){b.poly();var c=a.setInterval(b.poly,500);a.addEventListener?a.addEventListener("load",function(){b.poly(),a.clearInterval(c)}):a.attachEvent&&a.attachEvent("onload",function(){b.poly(),a.clearInterval(c)})}"undefined"==typeof exports?a.loadCSS=loadCSS:exports.loadCSS=loadCSS})("undefined"==typeof global?this:global);';
            echo '</script>';
        });
    }

    private function loadCssBasic()
    {
        add_action('wp_enqueue_scripts', function () {
            wp_enqueue_style('style', get_bloginfo('template_directory') . '/_build/bundle.css');
        });
    }

    private function addThemeSupportForBasicFeatures()
    {
        add_theme_support('title-tag');
        add_theme_support('automatic-feed-links');
        add_theme_support('post-thumbnails');
        add_theme_support('html5', [
            'comment-list',
            'comment-form',
            'search-form',
            'gallery',
            'caption',
            'style',
            'script'
        ]);
    }

    private function addBasicImageSizes()
    {
        // add cropped image sizes
        add_action('after_setup_theme', function () {
            add_image_size('300x300', 300, 300, true);
            add_image_size('400x500', 400, 500, true);
            add_image_size('400x800', 400, 800, true);
            add_image_size('1600x1200', 1600, 1200, true);
            add_image_size('1920x600', 1920, 600, true);
            add_image_size('600x', 600, 9999, false); // no crop example
        });
    }

    private function cropThumbnailsOnlyShowNeededSize()
    {
        // plugin "Crop-Thumbnails": only show only size that is needed in acf field (with e.g. "300x300" in description field)
        add_action('admin_footer', function () {
            ?>
            <script>
            document.addEventListener('click', (e) => {
                if( e.target.closest('.acf-field-image') ) {
                    if( e.target.matches('.acf-button') || e.target.matches('.acf-icon.-pencil') ) {
                        if( e.target.closest('.acf-field-image') !== null ) {
                            let size = null;
                            // support for single fields
                            if(
                                e.target.closest('.acf-field-image').querySelector('.description') !== null
                            ) {
                                size = e.target.closest('.acf-field-image').querySelector('.description').innerText;
                            }
                            // support for repeater tables
                            else if(
                                e.target.closest('.acf-field-image').getAttribute('data-key') !== null && 
                                document.querySelector('.acf-th[data-key="'+e.target.closest('.acf-field-image').getAttribute('data-key')+'"] .description') !== null
                            ) {
                                size = document.querySelector('.acf-th[data-key="'+e.target.closest('.acf-field-image').getAttribute('data-key')+'"] .description').innerText;
                            }
                            if( size !== null && size.match(/[0-9]+x[0-9]+/) ) {
                                let opened = false;
                                let t1 = setInterval(() => {
                                    if( opened === false && document.querySelector('.media-modal-content') !== null ) {
                                        opened = true;
                                        localStorage.setItem('cpt_same_ratio_mode','select');
                                        document.head.insertAdjacentHTML('beforeend',`<style class="hide-crop-images">
                                            .CropImageSize:not(.cptImageSize-${size}) { display:none !important; }
                                        </style>`);
                                    }
                                    if( opened === true && document.querySelector('.media-modal-content') === null ) {
                                        opened = false;
                                        if( document.querySelector('.hide-crop-images') !== null ) {
                                            document.querySelector('.hide-crop-images').remove();
                                        }
                                        clearInterval(t1);
                                    }
                                },1000);
                            }
                        }
                    }
                }
            });
            </script>
            <?php
        });
    }

    private function cropThumbnailsEnableEverywhere()
    {
        // see https://github.com/vollyimnetz/crop-thumbnails#filter-crop_thumbnails_activat_on_adminpages
        add_filter('crop_thumbnails_activat_on_adminpages', function ($oldValue) {
            return true;
        });
    }

    private function enableCustomEditorStyle()
    {
        add_editor_style();
    }

    private function addMetaTags() {
        // add meta charset
        add_action('wp_head', function () {
            echo '<meta charset="' . get_bloginfo('charset') . '" />';
        });

        // add meta viewport
        add_action('wp_head', function () {
            echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, minimum-scale=1" />';
        });

        // disable automatic phone number links on ios
        add_action('wp_head', function () {
            echo '<meta name="format-detection" content="telephone=no" />';
        });
    }

    private function addFavicon()
    {
        add_action('wp_head', function () {
            echo '<link rel="icon" type="image/png" sizes="32x32" href="' . site_url() . '/favicon.png">';
        });
        add_action('admin_head', function () {
            echo '<link rel="icon" type="image/png" sizes="32x32" href="' . site_url() . '/favicon.png">';
        });
    }

    private function addMenus()
    {
        add_action('init', function () {
            register_nav_menus([
                'main-menu' => 'Main menu',
                'sub-menu' => 'Sub menu (Top bar)',
                'footer' => 'Footer menu'
            ]);
        });
    }

    private function addConstants()
    {
        define('LOGO', get_bloginfo('template_directory') . '/_assets/images/logo.svg');
        define('IMAGES_PATH', get_bloginfo('template_directory') . '/_assets/_images/');
        define('ICONS_PATH', get_bloginfo('template_directory') . '/_assets/_icons/');
    }

    private function disableAutoParagraph()
    {
        remove_filter('the_content', 'wpautop');
        remove_filter('the_excerpt', 'wpautop');
        remove_filter('acf_the_content', 'wpautop');
    }

    private function enableCacheBusting()
    {
        add_filter(
            'style_loader_src',
            function ($src) {
                return $this->enableCacheBustingFn($src);
            },
            9999
        );
        add_filter(
            'script_loader_src',
            function ($src) {
                return $this->enableCacheBustingFn($src);
            },
            9999
        );
    }

    private function enableCacheBustingFn($src)
    {
        // remove wordpress version
        if (strpos($src, 'ver=')) {
            $src = remove_query_arg('ver', $src);
        }
        // enable cache busting on dev on every reload
        if (!self::isProduction()) {
            $src = add_query_arg('ver', mt_rand(1000, 9999), $src);
        }
        // enable cache busting on production on file change
        if (self::isProduction()) {
            if (strpos($src, 'http') === false || strpos($src, get_bloginfo('url')) !== false) {
                $src_abs = $src;
                $src_abs = str_replace(get_bloginfo('url') . '/', ABSPATH, $src_abs);
                $src_abs = str_replace(get_template_directory_uri(), get_template_directory(), $src_abs);
                if (strpos($src_abs, '?') !== false) {
                    $src_abs = substr($src_abs, 0, strpos($src_abs, '?'));
                }
                if (file_exists($src_abs)) {
                    $src = add_query_arg('ver', filemtime($src_abs), $src);
                }
            }
        }
        return $src;
    }

    private function disableUserSniffing()
    {
        // source: https://www.wp-tweaks.com/hackers-can-find-your-wordpress-username
        add_action('template_redirect', function () {
            // redirect_to_home_if_author_parameter
            $is_author_set = get_query_var('author', '');
            if ($is_author_set != '' && !is_admin()) {
                wp_redirect(home_url(), 301);
                exit();
            }
        });

        add_filter('rest_endpoints', function ($endpoints) {
            // disable_rest_endpoints
            if (isset($endpoints['/wp/v2/users'])) {
                unset($endpoints['/wp/v2/users']);
            }
            if (isset($endpoints['/wp/v2/users/(?P<id>[\d]+)'])) {
                unset($endpoints['/wp/v2/users/(?P<id>[\d]+)']);
            }
            return $endpoints;
        });
    }

    private function disableUnneededArchives()
    {
        // disable category / tag / date / author / archive / attachments / search route
        add_action('template_redirect', function () {
            if (
                is_category() ||
                is_tag() ||
                is_date() ||
                is_author() ||
                is_attachment() ||
                is_search() ||
                is_singular('custom_posttype') ||
                is_tax('custom_taxonomy')
            ) {
                header('Status: 404 Not Found');
                global $wp_query;
                $wp_query->set_404();
                status_header(404);
                nocache_headers();
            }
        });
    }

    private function disableMediaSlugsFromTakingAwayPageSlugs()
    {
        add_filter('wp_unique_post_slug_is_bad_attachment_slug', '__return_true');
    }

    private function disableAutoQuoteConversion()
    {
        /* WordPress e.g. auto converts "" into „“ */
        add_filter('run_wptexturize', '__return_false');
    }

    private function removeEmojis()
    {
        add_action('init', function () {
            remove_action('wp_head', 'print_emoji_detection_script', 7);
            remove_action('admin_print_scripts', 'print_emoji_detection_script');
            remove_action('wp_print_styles', 'print_emoji_styles');
            remove_action('admin_print_styles', 'print_emoji_styles');
            remove_filter('the_content_feed', 'wp_staticize_emoji');
            remove_filter('comment_text_rss', 'wp_staticize_emoji');
            remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
        });
    }

    private function removeWordPressVersionInHead()
    {
        remove_action('wp_head', 'wp_generator');
    }

    private function disableWpCors()
    {
        /* disable wordpress native cors settings (so that .htaccess settings are applied) */
        add_action(
            'rest_api_init',
            function () {
                remove_filter('rest_pre_serve_request', 'rest_send_cors_headers');
            },
            15
        );
    }

    private function fixWpJsonOrigin()
    {
        /*
        on /wp-json/ routes, if you set the "Origin" header in the request,
        that makes then wordpress respond with that same value in "Access-Control-Allow-Origin" in the response
        burp suite sees this as a vulneraribility; fix that.
        note: this only works if you *don't* set the cors headers in .htaccess
        */
        add_action('rest_api_init', function () {
            add_filter('http_origin', function ($origin) {
                if (strpos(rtrim($origin,'/').'/', rtrim(get_bloginfo('url'),'/').'/') !== false) {
                    return $origin;
                }
                return get_bloginfo('url');
            });
        });
    }

    private function disableWelcomeEmailsOnMultisiteRegistrations()
    {
        add_filter('wpmu_welcome_notification', '__return_false');
    }

    private function disablePasswordChangeMails()
    {
        add_filter('wp_password_change_notification_email', function ($wp_password_change_notification_email) {
            $wp_password_change_notification_email['to'] = '';
            return $wp_password_change_notification_email;
        });
    }

    private function advancedCustomFieldsRemoveEditorsOnAllPages()
    {
        add_action('admin_init', function () {
            remove_post_type_support('post', 'editor');
            remove_post_type_support('page', 'editor');
        });
    }

    private function advancedCustomFieldsReduceWysiwygHeight()
    {
        add_filter('acf/render_field/type=wysiwyg', [$this, 'preRenderWysiwygField'], 0, 1);
    }

    private function advancedCustomFieldsFixDraftPreview()
    {
        /* https://support.advancedcustomfields.com/forums/topic/preview-solution/page/3/#post-134967 */
        add_filter(
            'acf/pre_load_post_id',
            function ($null, $post_id) {
                if (is_preview()) {
                    return get_the_ID();
                }
                return $null;
            },
            10,
            2
        );
    }

    private function advancedCustomFieldsFlexibleContentPreview()
    {
        add_filter(
            'acf/fields/flexible_content/layout_title', // for specific field use "acf/fields/flexible_content/layout_title/name=custom_name"
            function ($title, $field, $layout, $i) {
                $custom_title = '';

                // images
                if (trim($custom_title) == '') {
                    $subfield = get_sub_field('image') ? get_sub_field('image') : get_sub_field('images');
                    if ($subfield) {
                        $custom_title .= '<div style="margin-top:10px">';
                        foreach (isset($subfield['sizes']) ? [$subfield] : $subfield as $subfield__value) {
                            $custom_title .=
                                '<img style="height:30px;border: 1px solid #ccd0d4" src="' .
                                esc_url(
                                    isset($subfield__value['image'])
                                        ? $subfield__value['image']['sizes']['thumbnail']
                                        : $subfield__value['sizes']['thumbnail']
                                ) .
                                '" />';
                        }
                        $custom_title .= '</div>';
                    }
                }
                // simple text fields
                foreach (
                    ['title', 'subtitle', 'text', 'label', 'main_text', ['custom_subfield' => 'custom_name']]
                    as $names__value
                ) {
                    if (trim($custom_title) == '') {
                        $subfield = get_sub_field(
                            is_array($names__value) ? array_keys($names__value)[0] : $names__value
                        );
                        if ($subfield) {
                            $label = strip_tags(
                                is_array($names__value) ? $subfield[array_values($names__value)[0]] : $subfield
                            );
                            if (mb_strlen($label) > 200) {
                                $label = mb_substr($label, 0, 200) . '…';
                            }
                            $custom_title .=
                                '<div style="margin-top:10px"><i style="font-size:10px">' . $label . '</i></div>';
                        }
                    }
                }
                // info messages
                if (trim($custom_title) == '') {
                    if (isset($layout['sub_fields']) && !empty($layout['sub_fields'])) {
                        foreach ($layout['sub_fields'] as $subfields__value) {
                            if (isset($subfields__value['type']) && $subfields__value['type'] === 'message') {
                                $custom_title .=
                                    '<div style="margin-top:10px"><i style="font-size:10px">' .
                                    $subfields__value['message'] .
                                    '</i></div>';
                            }
                        }
                    }
                }
                // other: empty div
                if (trim($custom_title) == '') {
                    $custom_title .= '<div style="margin-top:10px"><i style="font-size:10px">&nbsp;</i></div>';
                }

                if (trim($custom_title) != '') {
                    $title .= $custom_title;
                }
                return $title;
            },
            10,
            4
        );
    }

    public function preRenderWysiwygField()
    {
        ob_start();
        add_filter('acf/render_field/type=wysiwyg', [$this, 'afterRenderWysiwygField'], 20, 1);
    }

    public function afterRenderWysiwygField($field)
    {
        // it is set to a default value but can be modified
        // via php acf_add_local_field_group by setting
        // 'height' => xx, 'no_menubar' => 1
        $height = 120;
        remove_filter('acf/render_field/type=wysiwyg', [$this, 'afterRenderWysiwygField'], 20, 1);
        $output = ob_get_contents();
        if (@$field['height'] != '') {
            $height = $field['height'];
        }
        $output = str_replace('height:300px;', 'height:' . $height . 'px;', $output);
        $output =
            '<style>[data-key="' .
            $field['key'] .
            '"] iframe { min-height:' .
            $height .
            'px; }[data-key="' .
            $field['key'] .
            '"]</style>' .
            $output;
        if ($height < 100) {
            $output =
                '<style>[data-key="' .
                $field['key'] .
                '"] iframe[style*="height: 100px"] { height:' .
                $height .
                'px !important; }</style>' .
                $output;
        }
        if (@$field['no_menubar'] == '1') {
            $output = '<style>[data-key="' . $field['key'] . '"] .mce-menubar { display:none; }</style>' . $output;
        }
        ob_end_clean();
        echo $output;
    }

    private function advancedCustomFieldsAddQuickLinkToRefs()
    {
        add_action('admin_head', function () {
            ?>
            <script>
            let refs = {
                test_name_1: 'post_type_name_1',
                test_name_2: 'post_type_name_2'
            };
            let args = {
                width: Math.round(window.innerWidth/2.2),
                height: Math.round(window.innerHeight/1.2),
                left: Math.round((window.innerWidth-(window.innerWidth/2.2))/2),
                top: Math.round((window.innerHeight-(window.innerHeight/1.2))/1.4),
                menubar: false,
                scrollbars: false,
                status: false,
                toolbar: false
            }
            let specs = '';
            Object.entries(args).forEach(([args__key, args__value]) => {
                if( args__value === true ) { args__value = 1; }
                if( args__value === false ) { args__value = 0; }
                specs += args__key + '=' + args__value + ',';
            });
            specs = specs.substring(0, specs.length-1);
            window.specs = specs;
            document.addEventListener('DOMContentLoaded', () => {
                if( document.querySelector('.acf-field-relationship, .acf-th[data-type="relationship"]') !== null ) {
                    document.querySelectorAll('.acf-field-relationship, .acf-th[data-type="relationship"]').forEach($el => {
                        let name = $el.closest('.acf-field[data-name]').getAttribute('data-name');
                        if (name in refs) {
                            $el.querySelector('label').insertAdjacentHTML('beforeend', `
                                <br/><a href="#" onclick="window.open('<?php echo get_bloginfo(
                                    'url'
                                ); ?>/wp-admin/post-new.php?post_type=${refs[name]}','_blank',window.specs);return false;">Neues Element hinzufügen</a>
                            `);
                        }
                    });
                }
            });
            </script>
            <style>
            /* reduce also height */
            .acf-relationship .list {
                height: 100px;
            }
            </style>
	    <?php
        });
    }

    private function advancedCustomFieldsReenableCustomMetaBox()
    {
        add_filter('acf/settings/remove_wp_meta_box', '__return_false');
    }

    private function enableSvgUpload()
    {
        add_filter('upload_mimes', function ($existing_mimes = []) {
            $existing_mimes['vcf'] = 'text/x-vcard';
            $existing_mimes['svg'] = 'image/svg+xml';
            return $existing_mimes;
        });
        add_filter(
            'wp_check_filetype_and_ext',
            function ($data, $file, $filename, $mimes) {
                $filetype = wp_check_filetype($filename, $mimes);
                return [
                    'ext' => $filetype['ext'],
                    'type' => $filetype['type'],
                    'proper_filename' => $data['proper_filename']
                ];
            },
            10,
            4
        );
    }

    private function enableMediaReplaceDisableOption()
    {
        // disable in plugin "Enable Media Replace" second option "Datei ersetzen, aber neuen Dateinamen verwenden und alle Links automatisch aktualisieren"
        add_filter(
            'emr_enable_replace_and_search',
            function () {
                return false;
            },
            10,
            0
        );
    }

    private function webPConverterAndCropThumbnailsFixPluginConflict()
    {
        // (!!)attention: you manually have to save in the webp converter settings to get this applied(!!)
        // plugin "WebP Converter for Media": serve original image instead of webp-version for "Crop Featured Image"
        // because webp-conversion is not yet ready at time of request
        add_filter(
            'webpc_htaccess_mod_rewrite',
            function ($rules, $path) {
                $rules = str_replace(
                    'RewriteCond %{HTTP_ACCEPT} image/webp',
                    "RewriteCond %{HTTP_ACCEPT} image/webp\n  # exclude resize in backend\n  RewriteCond %{QUERY_STRING} !cacheBreak=",
                    $rules
                );
                return $rules;
            },
            10,
            2
        );
        // force reconversion after crop
        add_action(
            'crop_thumbnails_after_save_new_thumb',
            function ($full_path) {
                do_action('webpc_convert_paths', [$full_path]);
            },
            10,
            1
        );
    }

    private function autoClearCacheForWpFastestCache()
    {
        // clear cache for "WP Fastest Cache" programmatically every hour
        add_action('init', function () {
            $task = 'wp_fastest_cache_clear_cache';
            $frequency = 'hourly'; // hourly|twicedaily|daily
            add_action($task, function () {
                if (function_exists('wpfc_clear_all_cache')) {
                    wpfc_clear_all_cache(true);
                }
            });
            if (!wp_next_scheduled($task)) {
                wp_schedule_event(strtotime(date('Y-m-d H:00:00', strtotime('now + 1 hour'))), $frequency, $task);
            }
        });
    }

    private function fixLeadingCodeSpacesForWpFastestCache()
    {
        add_filter(
            'the_content',
            function ($content) {
                if (strpos($content, '<code>') === false) {
                    return $content;
                }
                $content = preg_replace_callback(
                    '/<code>(.*?)<\/code>/s',
                    function ($matches1) {
                        return '<code>' .
                            preg_replace_callback(
                                '/^(\s+)/m',
                                function ($matches2) {
                                    return str_repeat('&nbsp;', strlen($matches2[1]));
                                },
                                $matches1[1]
                            ) .
                            '</code>';
                    },
                    $content
                );
                return $content;
            },
            0
        );
    }

    private static function yoastShowEmptyCategoriesInSitemap()
    {
        add_filter(
            'wpseo_sitemap_exclude_empty_terms',
            function () {
                return false;
            },
            10,
            2
        );
    }
}
