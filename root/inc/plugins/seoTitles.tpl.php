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
 * Plugin Activator Class
 *
 */
class seoTitlesActivator
{
    public static function activate() {
        self::deactivate();

        require_once MYBB_ROOT . '/inc/adminfunctions_templates.php';
        find_replace_templatesets('headerinclude', '#' . preg_quote('{$stylesheets}') .'#', '<!-- SEO_TITLE_META -->{$stylesheets}');
    }

    public static function deactivate() {
        require_once MYBB_ROOT . '/inc/adminfunctions_templates.php';
        find_replace_templatesets('headerinclude', '#' . preg_quote('<!-- SEO_TITLE_META -->') .'#', '');
    }

}