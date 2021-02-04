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
 * @package   block_testblock
 * @copyright 2015 MFreak.nl
 * @author    Luuk Verhoeven
 **/
require_once(dirname(__FILE__) . '/../../config.php');
defined('MOODLE_INTERNAL') || die;

/**
 * Class block_testblock_renderer
 */
class block_testblock_renderer extends plugin_renderer_base {

    /**
     * add_javascript_module
     *
     * @throws coding_exception
     * @throws dml_exception
     * @throws moodle_exception
     */
    public function add_javascript_module() {
        global $PAGE, $CFG, $USER, $IP;

        $config = get_config('block_testblock');

        // Load swfobject 2.2 always fallback.
       // $PAGE->requires->js(new moodle_url($CFG->wwwroot . '/blocks/testblock/module.js'), true);

        $jsmodule = [
            'name' => 'block_testblock',
            'fullpath' => '/blocks/testblock/module.js',
            'requires' => ['io-base'],
        ];

    }

    /**
     * Add the snapshot tool
     *
     * @return string
     * @throws coding_exception
     */
    public function snapshot_tool() {
        // TODO Convert to mustache.
        global $USER, $CFG,$IP; // Used for the profile link.
        
        // Add webrtc container.
        $html .= '


                <!doctype html>
                <html lang="en">
                
                    <head>
                   
                     
                        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
                        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                        
                        <title>Test</title>
                        <style>
                            .container {
                            max-width: fit;
                            }
                        </style>
                    </head>

                    <body>

                        <div class="container">

    

                        <div class="bs-example">
                                <div class="accordion" id="accordionExample">
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h2 class="mb-0">
                                                <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"><i class="fa fa-plus"></i> To upload Audio and Image from Video</button>									
                                            </h2>
                                        </div>
                                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                            <div class="card-body">
                                                
                                                <input type="file" id="myFile"  ><br>
                                                <video controls id="theVideo"></video>
                                                                                                                    
                                                <div class="pt-3 clearboth">
                                                <label for="fname">To Extract Image from Video:</label>
                                                <button type="button" class="btn btn-secondary" onclick="capture()">Load Random frame</button>
                    
                                                <div id="demo"></div>
                                                <canvas id="canvas" ></canvas>
                                                </div>                
                                                <div>Suggestions: 
                                                <div id="prediction"></div>
                                                </div>
                                                
                                                
                                                <button type="button" class="btn btn-info btn-lg" onclick="upload()">Upload</button>
                                                <div class="modal fade" id="Modalsucess" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="alert alert-success alert-dismissible">
                                                            <a  class="close" data-dismiss="modal" aria-label="close">&times;</a>
                                                            <strong>Upload Success!</strong> Image and Audio has been uploaded to database.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" id="Modaldanger" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="alert alert-danger alert-dismissible">
                                                            <a  class="close" data-dismiss="modal" aria-label="close">&times;</a>
                                                            <strong>No File Chosen !!!!</strong> Please Select a Video File.
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="modal fade" id="Modaluploadexists" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="alert alert-danger alert-dismissible">
                                                            <a  class="close" data-dismiss="modal" aria-label="close">&times;</a>
                                                            <strong>File Already Exists!!!!</strong> The Image and Audio File Exists in our database, Please choose other file.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" id="Modaluploadfailed" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="alert alert-danger alert-dismissible">
                                                            <a  class="close" data-dismiss="modal" aria-label="close">&times;</a>
                                                            <strong>Upload Failed!!!!</strong> Please Upload again.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingTwo">
                                            <h2 class="mb-0">
                                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"><i class="fa fa-plus"></i> To Upload Audio and Image</button>
                                            </h2>
                                        </div>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div>
                                                    <label for="fname">To Upload Image:</label>
                                                    <input type="file" id="image_url" accept="image/*">
                                                    <canvas id="canvas_img"></canvas>
                                                    <div>Suggestions: 
                                                <div id="prediction_image"></div>
                                                </div>
                                                </div>
                                                <div>
                                                    <label for="fname">To Upload Audio:</label>
                                                    <input type="file" id="audio" accept="audio/*">
                                                    <audio controls id="theAudio" >   </audio>
                                                </div>
                                                <button type="button" class="btn btn-info btn-lg" onclick="mediaUpload()">Upload</button>
                                                <div class="modal fade" id="Modalsucess2" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="alert alert-success alert-dismissible">
                                                            <a  class="close" data-dismiss="modal" aria-label="close">&times;</a>
                                                            <strong>Upload Success!</strong> Image and Audio has been uploaded to database.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" id="Modaldanger2" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="alert alert-danger alert-dismissible">
                                                            <a  class="close" data-dismiss="modal" aria-label="close">&times;</a>
                                                            <strong>No File Chosen !!!!</strong> Please Select a Image and Audio File.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade" id="Modaluploadexists2" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="alert alert-danger alert-dismissible">
                                                            <a  class="close" data-dismiss="modal" aria-label="close">&times;</a>
                                                            <strong>File Already Exists!!!!</strong> The Image and Audio File Exists in our database, Please choose other file.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" id="Modaluploadfailed2" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="alert alert-danger alert-dismissible">
                                                            <a  class="close" data-dismiss="modal" aria-label="close">&times;</a>
                                                            <strong>Upload Failed!!!!</strong> Please Upload again.
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        </div>

                 
                        <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"> </script> 
                            
                        <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/mobilenet"> </script>
                        <script src="../module.js">  </script>

                    </body>

                </html>
                             
             ';
             
        return $html;
    }
    public function memory_game() {
        // TODO Convert to mustache.
        global $USER, $CFG,$IP; // Used for the profile link.
        
        // Add webrtc container.
        $html .= '
        
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <meta http-equiv="X-UA-Compatible" content="ie=edge">
                    <title>Memory</title>
                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
                        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
                    <link rel="icon" href="img/page-icon.png">
                    <link rel="stylesheet" href="https://'.$IP.'/moodle/blocks/testblock/classes/memgame_css/style.css">
                </head>
                <body>
                
                    <section id="pre" class="">
                        <div id="themes">
                            Chose your theme !
                            <p id="Animals" class="themes" title="Animals">Animals</p>
                            <p id="Alert" class="themes" title="Alert">Alert</p>
                            <p id="Birds" class="themes" title="Birds">Birds</p>
                        </div>
                    </section>
                    <!-- you can use these elements to display the game statistics
                    or you can use some other set of HTML elements  -->
                    <div class="container">
                        <div class="row" id="stats">
                            <p class="col">matches: <span id="matches"></span></p>
                            <p class="col">missed: <span id="missedMatches"></span></p>
                            <p class="col">remaining: <span id="remaining"></span></p>
                            <p class="col">time: <span id="time"></span></p>
                            <div class="col" id="restart"> 
                                <i class="fa fa-repeat"></i>     Restart
                            </div>
                        </div>
                    </div>
                
                    <!-- you can use this element as a container for all of your tile buttons/images -->
                    <div class="container">
                        <div class="row" id="tiles"></div>
                        
                    </div>
                    <section id="post" class="hidden">
                    <div>
                        <p>BRAVO !</p>
                        <p id="final"></p>
                        <br>
                        <p>
                        <a id="again">Play Again !</a>
                        </p>
                    </div>
                    </section>
                    
                    <script src="https://'.$IP.'/moodle/blocks/testblock/classes/mem_game_js/tiles.js"></script>
                    <script src="https://'.$IP.'/moodle/blocks/testblock/classes/mem_game_js/app.js"></script>
                    
                
                </body>
                </html>

                             
             ';
             
        return $html;
    }
    public function audio_detection() {
        // TODO Convert to mustache.
        global $USER, $CFG,$IP; // Used for the profile link.
        
        // Add webrtc container.
        $html .= '
                <!DOCTYPE html>
                <html>
                    <head>
                        <script src="https://'.$IP.'/moodle/blocks/testblock/classes/p5.js"></script>
                        <script src="https://'.$IP.'/moodle/blocks/testblock/classes/p5.dom.min.js"></script>
                        <script src="https://'.$IP.'/moodle/blocks/testblock/classes/p5.sound.min.js"></script>
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                    
                        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
                                                        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                                                        
                                                        <style>
                                                            .container {
                                                            text-align: center;
                                                            }
                                                        </style>
                        <script src="https://'.$IP.'/moodle/blocks/testblock/classes/ml5.min.js"></script>
                    
                    
                    </head>
                    <body>
                        <div class=container>
                        <div class="card" style="width: 40rem;display:inline-block">
                        <img src="https://'.$IP.'/moodle/blocks/testblock/classes/ai.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                        Real-time Audio Recognition Tool
                        <div id="res"></div>
                        </div>
                        </div>
                        </div>
                        <script src="https://'.$IP.'/moodle/blocks/testblock/classes/command.js"></script>
                    
                    
                    </body>
                
                </html>





        ';
             
        return $html;
    }

}
