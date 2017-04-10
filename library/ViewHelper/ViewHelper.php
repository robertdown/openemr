<?php
/**
 * View helper
 *
 * Render various UI components
 *
 * LICENSE: This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 3
 * of the License, or (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://opensource.org/licenses/gpl-license.php>;.
 *
 * @author Robert Down <robertdown@live.com>
 * @copyright Copyright 2017 Robert Down <robertdown@live.com>
 * @package OpenEMR
 * @subpackage HTMLHelper
 * @license GPL3
 */

namespace OpenEMR\ViewHelper;

class ViewHelper
{

    static public function expander(array $parameters = array(), $closingTags = false)
    {

        if ($closingTags == true) {
            return "\n</div>\n</div>";
        }

        $defaultOpts = array(
            'title' => null,
            'label' => null,
            'id' => null,
            'startOpen' => false,
            'button' => array(
                'label' => '<i class="fa fa-pencil"></i>',
                'link' => null,
                'classes' => array(
                    'btn',
                    'btn-secondary'
                ),
                'linkMethod' => 'anchor',
            ),
            'body' => array(
                'classes' => array(),
            ),
            'auth' => false,
            'alwaysExpanded' => false,
        );

        $opts = array_replace_recursive($defaultOpts, $parameters);
        $editButton = "";
        if ($opts['auth']) {
            // Allow the edit button
            $buttonClasses = implode(" ", $opts['button']['classes']);
            $editButton = '<a href="{href}" class="{classes}" {onclick}>{label}</a>';
            $editButton = str_replace("{label}", $opts['button']['label'], $editButton);
            $editButton = str_replace("{classes}", $buttonClasses, $editButton);
            if ($opts['button']['linkMethod'] == 'js') {
                $editButton = str_replace("{href}", "#", $editButton);
                $editButton = str_replace("{onclick}", $opts['button']['link'], $editButton);
            } elseif ($opts['button']['linkMethod'] == 'anchor') {
                $editButton = str_replace("{href}", $opts['button']['link'], $editButton);
            }
        }

        if ($opts['alwaysExpanded']) {
            // @todo Somehow force this to never be closed
        }

        $isOpen = ($opts['startOpen'] == false) ? true : false;

        $titleButton = '<a href="#{id}" data-toggle="collapse" aria-expanded="{expanded}">{label}</a>';
        $titleButton = str_replace("{id}", $opts['id'], $titleButton);
        $titleButton = str_replace("{label}", $opts['label'], $titleButton);
        $titleButton = str_replace("{expanded}", $opts['startOpen'], $titleButton);

        $collapserOpen = '<div class="collapse {closed}" id="{billing}><div class="well">';
        $collapserOpen = str_replace("{closed}", $isOpen, $collapserOpen);

        $widget = $editButton . " " . $titleButton . " " . $collapserOpen;
        return $widget;
    }
}
