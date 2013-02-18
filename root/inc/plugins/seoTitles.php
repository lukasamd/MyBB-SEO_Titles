<?php
/**
 * This file is part of SEO Titles plugin for MyBB.
 * Copyright (C) 2010-2013 Lukasz Tkacz <lukasamd@gmail.com>
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
 * Create plugin object
 * 
 */
$plugins->objects['seoTitles'] = new seoTitles();

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
        'website' => 'http://lukasztkacz.com',
        'author' => 'Lukasz "LukasAMD" Tkacz',
        'authorsite' => 'http://lukasztkacz.com',
        'version' => '1.6',
        'guid' => 'f190add5b01ce1b7b72da024ed8d1941',
        'compatibility' => '16*'
    );
}

/**
 * Standard MyBB activation functions 
 * 
 */
function seoTitles_activate()
{
    
}

function seoTitles_deactivate()
{
    
}

/**
 * Plugin Class 
 * 
 */
class seoTitles
{

    /**
     * Constructor - add plugin hooks
     */
    public function __construct()
    {
        global $plugins;

        // Add all hooks
        $plugins->hooks["pre_output_page"][10]["seoTitles_makeTitle"] = array("function" => create_function('&$arg', 'global $plugins; $plugins->objects[\'seoTitles\']->makeTitle($arg);'));
        $plugins->hooks["pre_output_page"][10]["seoTitles_pluginThanks"] = array("function" => create_function('&$arg', 'global $plugins; $plugins->objects[\'seoTitles\']->pluginThanks($arg);'));
    }

    public function makeTitle(&$content)
    {
        global $mybb, $lang, $page;

        $lang->load("online");

        preg_match('#<title>(.*)<\/title>#iU', $content, $titleMatch);
        if (isset($titleMatch[1]))
        {
            $newTitle = $titleMatch[1];
            $standardName = $mybb->settings['bbname'] . ' - ';

            switch (THIS_SCRIPT)
            {
                case 'showthread.php':
                    global $thread;

                    // Add thread prefix
                    if ($thread['threadprefix'] != '')
                    {
                        $thread['threadprefix'] = str_replace("&nbsp;", "", $thread['threadprefix']);
                        $newTitle = $thread['threadprefix'] . ' - ' . $newTitle;
                    }
                    break;

                // Add search results keyword
                case 'search.php':
                    global $search;

                    if ($mybb->input['action'] == 'results' && $search['keywords'] != '')
                    {
                        $newTitle = str_replace($standardName, '', $newTitle);
                        $newTitle = $search['keywords'] . ' - ' . $newTitle . ' - ' . $mybb->settings['bbname'];
                    }
                    break;

                default:
                    break;
            }

            // Add page number
            if ($page > 1)
            {
                $newTitle .= ' - ' . $lang->page . ' ' . $page;
            }

            // Add board name
            if (!strstr($titleMatch[1], $mybb->settings['bbname']))
            {
                $newTitle .= ' - ' . $mybb->settings['bbname'];
            }

            $oldTitle = '<title>' . $titleMatch[1] . '</title>';
            $newTitle = '<title>' . $newTitle . '</title>';

            $content = str_replace($oldTitle, $newTitle, $content);
        }
    }
    
    /**
     * Say thanks to plugin author - paste link to author website.
     * Please don't remove this code if you didn't make donate
     * It's the only way to say thanks without donate :)     
     */
    public function pluginThanks(&$content)
    {
        global $session, $lukasamd_thanks;
        
        if (!isset($lukasamd_thanks) && $session->is_spider)
        {
            $thx = '<div style="margin:auto; text-align:center;">This forum uses <a href="http://lukasztkacz.com">Lukasz Tkacz</a> MyBB addons.</div></body>';
            $content = str_replace('</body>', $thx, $content);
            $lukasamd_thanks = true;
        }
    }

}