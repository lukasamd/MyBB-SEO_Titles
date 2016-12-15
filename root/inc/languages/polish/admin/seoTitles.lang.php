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

$l['seoTitlesName'] = 'Przyjazne (SEO) tytuły';
$l['seoTitlesDesc'] = 'Ten plugin poprawia tytuły podstron na bardziej przyjazne (dodaje numery stron oraz nazwę forum).';
$l['seoTitlesGroupDesc'] = 'Ustawienia pluginu "Przyjazne (SEO) tytuły"';

$l['seoTitlesForum'] = 'Wzorzec dla widoku forum (bez numeru strony)';
$l['seoTitlesForumDesc'] = 'Używany wzorzec. Możliwe zmienne:
<br />{$forum} - nazwa forum
<br />{$description} - opis forum
<br />{$boardname} - nazwa witryny';

$l['seoTitlesForumPage'] = 'Wzorzec dla widoku forum (z numerem strony)';
$l['seoTitlesForumPageDesc']  = 'Używany wzorzec. Możliwe zmienne:
<br />{$forum} - forum name
<br />{$description} - opis forum
<br />{$page} - numer strony
<br />{$boardname} - nazwa witryny';

$l['seoTitlesTopic'] = 'Wzorzec dla widoku tematu (bez numeru strony)';
$l['seoTitlesTopicDesc'] = 'Używany wzorzec. Możliwe zmienne:
<br />{$forum} - forum name
<br />{$description} - opis forum
<br />{$subject} - nazwa tematu
<br />{$lastposter} - nick autora ostatniego postu
<br />{$prefix} - prefix tematu
<br />{$boardname} - nazwa witryny';

$l['seoTitlesTopicPage'] = 'Wzorzec dla widoku tematu (z numerem strony)';
$l['seoTitlesTopicPageDesc'] = 'Używany wzorzec. Możliwe zmienne:
<br />{$forum} - forum name
<br />{$description} - opis forum
<br />{$page} - numer strony
<br />{$subject} - nazwa tematu
<br />{$lastposter} - nick autora ostatniego postu
<br />{$prefix} - prefix tematu
<br />{$boardname} - nazwa witryny';

$l['seoTitlesMember'] = 'Wzorzec dla widoku profilu';
$l['seoTitlesMemberDesc'] = 'Używany wzorzec. Możliwe zmienne:
<br />{$username} - nazwa użytkownika
<br />{$boardname} - nazwa witryny';

$l['seoTitlesIndex'] = 'Wzorzec dla strony głównej forum';
$l['seoTitlesIndexDesc'] = 'Używany wzorzec. Możliwe zmienne:
<br />{$boardname} - nazwa witryny';

$l['seoTitlesPrefix'] = 'Wzorzec prefiksu tematu';
$l['seoTitlesPrefixDesc'] = 'Tutaj można zmienić wzorzec prefiksu.';

$l['seoTitlesOGType'] = 'Open Graph Type';
$l['seoTitlesOGTypeDesc'] = 'Domyślny parametr type dla Open Graph.';

$l['seoTitlesOGTitle'] = 'Open Graph Title';
$l['seoTitlesOGTitleDesc'] = 'Domyślny parametr title dla Open Graph.';

$l['seoTitlesOGDesc'] = 'Open Graph Description';
$l['seoTitlesOGDescDesc'] = 'Domyślny parametr description dla Open Graph.';

$l['seoTitlesOGImage'] = 'Open Graph Image';
$l['seoTitlesOGImageDesc'] = 'Domyślny adres obrazka dla Open Graph.';

$l['seoTitlesOGFacebook'] = 'Open Graph Facebook APP ID';
$l['seoTitlesOGFacebookDesc'] = 'Numer APP ID z Facebooka dla Open Graph.';

$l['seoTitlesOGGenerate'] = 'Automatyczne generowanie Open Graph';
$l['seoTitlesOGGenerateDesc'] = 'Jeśli włączone, dodatek spróbuje dynamicznie generować dane dla Open Graph na podstawie treści na forum.';
