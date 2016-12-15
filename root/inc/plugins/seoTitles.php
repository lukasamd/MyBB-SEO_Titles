<?php
/**
 * This file is part of SEO Titles plugin for MyBB.
 * Copyright (C) Lukasz Tkacz <lukasamd@gmail.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */
 
/**
 * Disallow direct access to this file for security reasons
 * 
 */
if (!defined("IN_MYBB")) exit;


/**
 * Add hooks
 *
 */
$plugins->add_hook("pre_output_page", ['seoTitles', 'makeTitle']);
$plugins->add_hook('pre_output_page', ['seoTitles', 'pluginThanks']);

/**
 * Standard MyBB info function
 * 
 */
function seoTitles_info()
{
    global $lang;

    $lang->load("seoTitles");
    
    $lang->seoTitlesDesc = '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" style="float:right;">' .
        '<input type="hidden" name="cmd" value="_s-xclick">' . 
        '<input type="hidden" name="hosted_button_id" value="3BTVZBUG6TMFQ">' .
        '<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">' .
        '<img alt="" border="0" src="https://www.paypalobjects.com/pl_PL/i/scr/pixel.gif" width="1" height="1">' .
        '</form>' . $lang->seoTitlesDesc;

    return Array(
        'name' => $lang->seoTitlesName,
        'description' => $lang->seoTitlesDesc,
        'website' => 'https://tkacz.pro',
        'author' => 'Lukasz Tkacz',
        'authorsite' => 'https://tkacz.pro',
        'version' => '1.3.0',
        'guid' => '',
        'compatibility' => '18*',
        'codename' => 'seo_titles',
    );
}

/**
 * Standard MyBB installation functions
 *
 */
function seoTitles_install() {
    require_once MYBB_ROOT . '/inc/plugins/seoTitles.settings.php';
    seoTitlesInstaller::install();
}

function seoTitles_is_installed() {
    global $mybb;
    return (isset($mybb->settings['seoTitlesForum']));
}

function seoTitles_uninstall() {
    require_once MYBB_ROOT . '/inc/plugins/seoTitles.settings.php';
    seoTitlesInstaller::uninstall();
}

/**
 * Standard MyBB activation functions 
 * 
 */
function seoTitles_activate() {
    require_once('seoTitles.tpl.php');
    seoTitlesActivator::activate();
}

function seoTitles_deactivate() {
    require_once('seoTitles.tpl.php');
    seoTitlesActivator::deactivate();
}

/**
 * Plugin Class 
 * 
 */
class seoTitles
{

    /**
     * Replace titles
     *
     * @param $content Page content
     */
    public static function makeTitle(&$content)
    {
        global $mybb, $page, $thread, $forum, $foruminfo, $memprofile;

        $ogDesc = '';

        $titleMatch = array();
        preg_match('#<title>(.*)<\/title>#iU', $content, $titleMatch);
        if (isset($titleMatch[1]))
        {
            $title  = '';

            switch (THIS_SCRIPT) {
                case 'showthread.php':
                    $title = ($page > 1) ? self::getConfig('TopicPage') : self::getConfig('Topic');

                    $title = str_replace('{$subject}', $thread['subject'], $title);
                    $title = str_replace('{$lastposter}', $thread['lastposter'], $title);
                    $title = str_replace('{$forum}', $forum['name'], $title);
                    $title = str_replace('{$description}', $forum['description'], $title);

                    $ogDesc = $forum['description'];

                    // Add topic prefix
                    if ($thread['threadprefix'] != '') {
                        $prefix = str_replace(
                            '{$prefix}',
                            self::getConfig('Prefix'),
                            str_replace("&nbsp;", "", $thread['threadprefix'])
                        );

                        $title = str_replace('{$prefix}', $prefix, $title);
                    } else {
                        $title = str_replace('{$prefix}', '', $title);
                    }

                    break;

                case 'forumdisplay.php':
                    $title = ($page > 1) ? self::getConfig('ForumPage') : self::getConfig('Forum');

                    $title = str_replace('{$forum}', $foruminfo['name'], $title);
                    $title = str_replace('{$description}', $foruminfo['description'], $title);

                    $ogDesc = $foruminfo['description'];
                    break;

                case 'member.php';
                    if (!empty($memprofile)) {
                        $title = self::getConfig('Member');

                        $title = str_replace('{$username}', $memprofile['username'], $title);
                    }
                    break;

                case 'index.php';
                    $title = self::getConfig('Index');
                    break;

                default:
                    return;
                    break;
            }

            // Add page number
            if ($page > 1) {
                $title = str_replace('{$page}', $page, $title);
            }

            // Add main title
            $title = str_replace('{$boardname}', $mybb->settings['bbname'], $title);

            $content = str_replace(
                '<title>' . $titleMatch[1] . '</title>',
                '<title>' . $title . '</title>',
                $content
            );

            // Add Open Graph data
            $ogData = '';
            $ogData .= '<meta property="og:url" content="' . $mybb->settings['bburl'] . getenv("REQUEST_URI") . '" />';
            if (self::getConfig('OGType')) {
                $ogData .= '<meta property="og:type" content="' . self::getConfig('OGType') . '" />';
            }
            if (self::getConfig('OGImage')) {
                $ogData .= '<meta property="og:image" content="' . self::getConfig('OGImage') . '" />';
            }
            if (self::getConfig('OGFacebook')) {
                $ogData .= '<meta property="fb:app_id" content="' . self::getConfig('OGFacebook') . '" />';
            }

            $ogTitle = (!self::getConfig('seoTitlesOGGenerate')) ? $title : self::getConfig('OGTitle');
            if ($ogTitle) {
                $ogData .= '<meta property="og:title" content="' . $title . '" />';
            }

            if (!self::getConfig('seoTitlesOGGenerate') || !$ogDesc) {
                $ogDesc = self::getConfig('OGDesc');
            }
            if ($ogDesc) {
                $ogData .= '<meta property="og:description" content="' . $ogDesc . '" />';
            }

            $ogData = str_replace('/>', "/>\n", $ogData);
            $content = str_replace('<!-- SEO_TITLE_META -->', $ogData, $content);
        }
    }

    /**
     * Helper function to get variable from config
     *
     * @param string $name Name of config to get
     * @return string Data config from MyBB Settings
     */
    public static function getConfig($name)
    {
        global $mybb;

        return $mybb->settings["seoTitles{$name}"];
    }
    
    /**
     * Say thanks to plugin author - paste link to author website.
     * Please don't remove this code if you didn't make donate
     * It's the only way to say thanks without donate :)     
     */
    public static function pluginThanks(&$content)
    {
        global $session, $lukasamd_thanks;
        
        if (!isset($lukasamd_thanks) && $session->is_spider)
        {
            $thx = '<div style="margin:auto; text-align:center;">This forum uses <a href="https://tkacz.pro">Lukasz Tkacz</a> MyBB addons.</div></body>';
            $content = str_replace('</body>', $thx, $content);
            $lukasamd_thanks = true;
        }
    }

}