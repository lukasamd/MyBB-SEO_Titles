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

$l['seoTitlesName'] = 'SEO Titles';
$l['seoTitlesDesc'] = 'This plugin impove forum subpages titles (add page number and forum name).';
$l['seoTitlesGroupDesc'] = 'Settings for plugin "SEO Titles"';


$l['seoTitlesForum'] = 'Patter for forum view (without page number)';
$l['seoTitlesForumDesc'] = 'Page title pattern. You can use variables:
<br />{$forum} - forum name
<br />{$description} - forum description
<br />{$boardname} - board name';

$l['seoTitlesForumPage'] = 'Patter for forum view (with page number)';
$l['seoTitlesForumPageDesc']  = 'Page title pattern. You can use variables:
<br />{$forum} - forum name
<br />{$description} - forum description
<br />{$page} - page number
<br />{$boardname} - board name';

$l['seoTitlesTopic'] = 'Patter for thread view (without page number)';
$l['seoTitlesTopicDesc'] = 'Page title pattern. You can use variables:
<br />{$forum} - forum name
<br />{$description} - forum description
<br />{$subject} - thread title
<br />{$lastposter} - lastposer username
<br />{$prefix} - thread prefix
<br />{$boardname} - board name';

$l['seoTitlesTopicPage'] = 'Patter for thread view (with page number)';
$l['seoTitlesTopicPageDesc'] = 'Page title pattern. You can use variables:
<br />{$forum} - forum name
<br />{$description} - forum description
<br />{$page} - page number
<br />{$subject} - thread title
<br />{$lastposter} - lastposer username
<br />{$prefix} - thread prefix
<br />{$boardname} - board name';

$l['seoTitlesMember'] = 'Patter for profile view';
$l['seoTitlesMemberDesc'] = 'Page title pattern. You can use variables:
<br />{$username} - member username
<br />{$boardname} - board name';

$l['seoTitlesIndex'] = 'Patter for forum index';
$l['seoTitlesIndexDesc'] = 'Page title pattern. You can use variables:
<br />{$boardname} - board name';


$l['seoTitlesPrefix'] = 'Patter for prefix';
$l['seoTitlesPrefixDesc'] = 'Here you can modify prefix data.';

$l['seoTitlesOGType'] = 'Open Graph Type';
$l['seoTitlesOGTypeDesc'] = 'Default type parameter for Open Graph.';

$l['seoTitlesOGTitle'] = 'Open Graph Title';
$l['seoTitlesOGTitleDesc'] = 'Default title for Open Graph.';

$l['seoTitlesOGDesc'] = 'Open Graph Description';
$l['seoTitlesOGDescDesc'] = 'Default description for Open Graph.';

$l['seoTitlesOGImage'] = 'Open Graph Image';
$l['seoTitlesOGImageDesc'] = 'Default image url for Open Graph.';

$l['seoTitlesOGFacebook'] = 'Open Graph Facebook APP ID';
$l['seoTitlesOGFacebookDesc'] = 'APP ID from Facebook for Open Graph.';

$l['seoTitlesOGGenerate'] = 'Automaically generate Open Graph data';
$l['seoTitlesOGGenerateDesc'] = 'If enabled, plugin will try to generate Open Graph data based on forum content.';