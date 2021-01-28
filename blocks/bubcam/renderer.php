<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * html render class
 *
 * @license   https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @package   block_bubcam
 * @copyright 2015 MFreak.nl
 * @author    Luuk Verhoeven
 **/
defined('MOODLE_INTERNAL') || die;

/**
 * Class block_bubcam_renderer
 */
class block_bubcam_renderer extends plugin_renderer_base {

    /**
     * add_javascript_module
     *
     * @throws coding_exception
     * @throws dml_exception
     * @throws moodle_exception
     */
    public function add_javascript_module() {
        global $PAGE, $CFG, $USER;

        $config = get_config('block_bubcam');

        // Load swfobject 2.2 always fallback.
        $PAGE->requires->js(new moodle_url($CFG->wwwroot . '/blocks/bubcam/module.js'), true);

        $jsmodule = [
            'name' => 'block_bubcam',
            'fullpath' => '/blocks/bubcam/module.js',
            'requires' => ['io-base'],
        ];

        $PAGE->requires->js_init_call('M.block_bubcam.init', [
            $CFG->wwwroot . '/blocks/bubcam/swf/snapshot.swf?' . time(),
            $CFG->wwwroot . '/blocks/bubcam/swf/expressInstall.swf',
            [
                'sessionid' => $USER->sesskey,
                'uploadPath' => $CFG->wwwroot . '/blocks/bubcam/ajax.php',
                'text_select_device' => get_string('flash:textselectdevice', 'block_bubcam'),
                'text_make_snapshot' => get_string('flash:text_make_snapshot', 'block_bubcam'),
                'text_result_field' => get_string('flash:text_result_field', 'block_bubcam'),
                'text_feed_field' => get_string('flash:text_feed_field', 'block_bubcam'),
                'failed_saving' => get_string('flash:failed_saving', 'block_bubcam'),
                'success_saving' => get_string('flash:success_saving', 'block_bubcam'),
            ],
        ], false, $jsmodule);
    }

    /**
     * Add the snapshot tool
     *
     * @return string
     * @throws coding_exception
     */
    public function snapshot_tool() {
        // TODO Convert to mustache.
        global $USER, $CFG; // Used for the profile link.

        $html = '<div id="snapshotholder" style="display: none;">
                    <div id="snapshot">
                        <h1>' . get_string('installflash', 'block_bubcam') . '</h1>
                        <p><a href="https://www.adobe.com/go/getflashplayer">
                        <img src="https://www.adobe.com/images/shared/download_buttons/get_flash_player.gif"
                        alt="Get Adobe Flash player" /></a></p>
                    </div>
                </div>';

        // Add webrtc container.
        $html .= '<div id="snapshotholder_webrtc" style="display: none;">
                    <video autoplay></video>
                    <div id="previewholder">
                        <canvas id="render"></canvas>
                        <canvas id="preview"></canvas>
                    </div>
                 </div>
                 <div class="pt-3 clearboth">
                    <button id="snapshot" class="btn btn-primary">' .
            get_string('flash:text_make_snapshot', 'block_bubcam') . '</button>
                    <a href="' . $CFG->wwwroot . '/user/profile.php?id=' . $USER->id . '" class="btn btn-info">' .
            get_string('returntoprofile', 'block_bubcam') . '</a>
                 </div>';

        return $html;
    }

}
