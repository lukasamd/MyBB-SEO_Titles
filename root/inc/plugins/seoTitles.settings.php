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
 * Plugin Installator Class
 * 
 */
class seoTitlesInstaller 
{

    public static function install() 
    {
        global $db, $lang;
        self::uninstall();

        $result = $db->simple_select('settinggroups', 'MAX(disporder) AS max_disporder');
        $max_disporder = $db->fetch_field($result, 'max_disporder');
        $disporder = 1;

        $settings_group = array(
            'name' => 'seoTitles',
            'title' => $db->escape_string($lang->seoTitlesName),
            'description' => $db->escape_string($lang->seoTitlesGroupDesc),
            'disporder' => $max_disporder + 1,
            'isdefault' => '0'
        );
        $db->insert_query('settinggroups', $settings_group);
        $gid = (int) $db->insert_id();

        $setting = array(
            'name' => 'seoTitlesIndex',
            'title' => $db->escape_string($lang->seoTitlesIndex),
            'description' => $db->escape_string($lang->seoTitlesIndexDesc),
            'optionscode' => 'text',
            'value' => '{$boardname}',
            'disporder' => $disporder++,
            'gid' => $gid
        );
        $db->insert_query('settings', $setting);

        $setting = array(
            'name' => 'seoTitlesForum',
            'title' => $db->escape_string($lang->seoTitlesForum),
            'description' => $db->escape_string($lang->seoTitlesForumDesc),
            'optionscode' => 'text',
            'value' => '{$forum} - {$boardname}',
            'disporder' => $disporder++,
            'gid' => $gid
        );
        $db->insert_query('settings', $setting);

        $setting = array(
            'name' => 'seoTitlesForumPage',
            'title' => $db->escape_string($lang->seoTitlesForumPage),
            'description' => $db->escape_string($lang->seoTitlesForumPageDesc),
            'optionscode' => 'text',
            'value' => '{$forum} - {$page} - {$boardname}',
            'disporder' => $disporder++,
            'gid' => $gid
        );
        $db->insert_query('settings', $setting);

        $setting = array(
            'name' => 'seoTitlesTopic',
            'title' => $db->escape_string($lang->seoTitlesTopic),
            'description' => $db->escape_string($lang->seoTitlesTopicDesc),
            'optionscode' => 'text',
            'value' => '{$prefix}{$subject} - {$boardname}',
            'disporder' => $disporder++,
            'gid' => $gid
        );
        $db->insert_query('settings', $setting);

        $setting = array(
            'name' => 'seoTitlesTopicPage',
            'title' => $db->escape_string($lang->seoTitlesTopicPage),
            'description' => $db->escape_string($lang->seoTitlesTopicPageDesc),
            'optionscode' => 'text',
            'value' => '{$prefix}{$subject} - {$page} - {$boardname}',
            'disporder' => $disporder++,
            'gid' => $gid
        );
        $db->insert_query('settings', $setting);

        $setting = array(
            'name' => 'seoTitlesMember',
            'title' => $db->escape_string($lang->seoTitlesMember),
            'description' => $db->escape_string($lang->seoTitlesMemberDesc),
            'optionscode' => 'text',
            'value' => '{$username} - {$boardname}',
            'disporder' => $disporder++,
            'gid' => $gid
        );
        $db->insert_query('settings', $setting);

        $setting = array(
            'name' => 'seoTitlesPrefix',
            'title' => $db->escape_string($lang->seoTitlesPrefix),
            'description' => $db->escape_string($lang->seoTitlesPrefixDesc),
            'optionscode' => 'text',
            'value' => '{$prefix}',
            'disporder' => $disporder++,
            'gid' => $gid
        );
        $db->insert_query('settings', $setting);
        
        rebuild_settings();
    }

    public static function uninstall() 
    {
        global $db;
        
        $result = $db->simple_select('settinggroups', 'gid', "name = 'seoTitles'");
        $gid = (int) $db->fetch_field($result, "gid");
        
        if ($gid > 0) {
            $db->delete_query('settings', "gid = '{$gid}'");
        }
        $db->delete_query('settinggroups', "gid = '{$gid}'");

        rebuild_settings();
    }

}
