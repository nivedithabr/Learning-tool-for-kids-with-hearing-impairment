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
 * Form for editing HTML block instances.
 *
 * @package   block_testblock
 * @copyright 1999 onwards Martin Dougiamas (http://dougiamas.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once(dirname(__FILE__) . '/../../config.php');
class block_testblock extends block_base {

    public function init() {
        //$this->title = get_string('pluginname', 'block_testblock');
        

        $this->title = "Digital Learning System for kids with Cochlear implant";
        
    }


    function get_content() {
        global $CFG, $COURSE,$IP;

        require_once($CFG->libdir . '/formslib.php');

        if ($this->content !== NULL) {
            return $this->content;
        }
        $systemcontext = context_system::instance();

        if (!user_has_role_assignment($userid, 5)) {
            
            $this->content = new stdClass;
            $this->content->text = '<head>
                       
                         
                                        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
                                        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                                        
                                        <style>
                                            .container {
                                            max-width: fit;
                                            }
                                        </style>
                                    </head>
                                    <body>
                                    
                                    <div class="card" style="width: 18rem; display:inline-block";>
                                    <img src="https://'.$IP.'/moodle/blocks/testblock/music.png" class="card-img-top" alt="...">
                                    <div class="card-body">
                                    <div class="singlebutton">
                                        <form action="' . $CFG->wwwroot . '/blocks/testblock/view/memory_game_view.php" method="get">
                                        <div>
                                            <input type="hidden" name="blockid" value="' . $this->instance->id . '"/>
                                            <input type="hidden" name="courseid" value="' . $COURSE->id . '"/>
                                            <input class="singlebutton btn btn-primary" type="submit" value="Generate Memory Game"/>
                                        </div>
                                        </form>
                                    </div>
                                    </div>
                                    </div>
    
                                    <div class="card" style="width: 18rem; display:inline-block";>
                                    <img src="https://'.$IP.'/moodle/blocks/testblock/ai.png" class="card-img-top" alt="...">
                                    <div class="card-body">
                                    <div class="singlebutton">
                                        <form action="' . $CFG->wwwroot . '/blocks/testblock/view/audio_detection.php" method="get">
                                        <div>
                                            <input type="hidden" name="blockid" value="' . $this->instance->id . '"/>
                                            <input type="hidden" name="courseid" value="' . $COURSE->id . '"/>
                                            <input class="singlebutton btn btn-primary" type="submit" value="Real-time Sound Detection"/>
                                        </div>
                                        </form>
                                    </div>
                                    </div>
                                    </div>
                                    
                                    </body>
    
    
                                    
                                    
                                    
                                    
                                    ';
        }



        if (is_siteadmin())
        {
        // show all

        $this->content = new stdClass;
        $this->content->text = '<head>
                   
                     
                                    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
                                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                                    
                                    <style>
                                        .container {
                                        max-width: fit;
                                        }
                                    </style>
                                </head>
                                <body>
                                

                                <div class="card" style="width: 18rem;display:inline-block">
                                    <img src="https://'.$IP.'/moodle/blocks/testblock/upload.jpg" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <div class="singlebutton">
                                            <form action="' . $CFG->wwwroot . '/blocks/testblock/view/view.php" method="get">
                                                <div>
                                                    <input type="hidden" name="blockid" value="' . $this->instance->id . '"/>
                                                    <input type="hidden" name="courseid" value="' . $COURSE->id . '"/>
                                                    <input class="singlebutton btn btn-primary" type="submit" value="Upload files for Course"/>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                <div class="card" style="width: 18rem; display:inline-block";>
                                <img src="https://'.$IP.'/moodle/blocks/testblock/training.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                <div class="singlebutton">
                                    <form action="' . $CFG->wwwroot . '/blocks/testblock/view/Training.php" method="get">
                                    <div>
                                        <input type="hidden" name="blockid" value="' . $this->instance->id . '"/>
                                        <input type="hidden" name="courseid" value="' . $COURSE->id . '"/>
                                        <input class="singlebutton btn btn-primary" type="submit" value="         Audio Training          "/>
                                    </div>
                                    </form>
                                </div>
                                </div>
                                </div>

                                
                                <div class="card" style="width: 18rem; display:inline-block";>
                                <img src="https://'.$IP.'/moodle/blocks/testblock/music.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                <div class="singlebutton">
                                    <form action="' . $CFG->wwwroot . '/blocks/testblock/view/memory_game_view.php" method="get">
                                    <div>
                                        <input type="hidden" name="blockid" value="' . $this->instance->id . '"/>
                                        <input type="hidden" name="courseid" value="' . $COURSE->id . '"/>
                                        <input class="singlebutton btn btn-primary" type="submit" value="Generate Memory Game"/>
                                    </div>
                                    </form>
                                </div>
                                </div>
                                </div>

                                <div class="card" style="width: 18rem; display:inline-block";>
                                <img src="https://'.$IP.'/moodle/blocks/testblock/ai.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                <div class="singlebutton">
                                    <form action="' . $CFG->wwwroot . '/blocks/testblock/view/audio_detection.php" method="get">
                                    <div>
                                        <input type="hidden" name="blockid" value="' . $this->instance->id . '"/>
                                        <input type="hidden" name="courseid" value="' . $COURSE->id . '"/>
                                        <input class="singlebutton btn btn-primary" type="submit" value="Real-time Sound Detection"/>
                                    </div>
                                    </form>
                                </div>
                                </div>
                                </div>
                                
                                </body>


                                
                                
                                
                                
                                ';
        }
      


        

        $this->content->footer ='This is a test for Learning solution for kids with cochlear implants';

        return $this->content;
    }


}
