/**
 * This file contains function on video playback
 * media upload
 * object detection
 * capture image from video
 */

let url;
let model;
var capturedimage;
var vidname;
var image_data_upload;
var upload_name;
var IP = "192.168.178.20";

// video play back
function changeVideo() {
                    
    var chosenFile = document.getElementById("myFile").files[0];
    document.getElementById("theVideo").setAttribute("src", URL.createObjectURL(chosenFile));
  }


  function changeAudio() {
    var audiofile = document.getElementById("audio").files[0];
    document.getElementById("theAudio").setAttribute("src", URL.createObjectURL(audiofile ));
  }

 
  document.getElementById("myFile").addEventListener("change", changeVideo);
  
  document.getElementById("audio").addEventListener("change", changeAudio);

  
// upload video file
function upload(){
    var videofile = document.getElementById("myFile");
    var vidfile = videofile.files[0];


    
    if(!videofile.files.length ==0 ){

        var arr= [];
        arr.push(capturedimage,vidname);
        console.log(arr);

        url = "https://"+IP+"/moodle/blocks/testblock/classes/ajax.php";
        /// send video file via ajax to ajax.php to extract audio from video
        var formdata = new FormData();
        arr.forEach((item) => formdata.append("videoUpload[]", item))
        formdata.append("myFile",vidfile);

        // verify the data
        console.log(formdata.getAll("videoUpload[]"));
        console.log(formdata.getAll("myFile"));

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            // Do what you want here with the response here
            var result= this.responseText;
            
                if(result=="sucess"){
                    $('#Modalsucess').modal('show');
                } else if(result=="alert"){
                    $('#Modaluploadexists').modal('show');
                }
                else if(result=="failed"){
                    $('#Modaluploadfailed').modal('show');
                }
            }
        };
        xhttp.onerror = function(event) {
            document.getElementById("myResponse").innerHTML = "Request error:" + event.target.status;
        };
        xhttp.open("POST", url, true);
        xhttp.send(formdata);
        // xhttp.send(formdata1);
      
    }
    else{
        $('#Modaldanger').modal('show')
    }
    
}  

// upload image and audio
function mediaUpload(){
    var imagefile = document.getElementById("image_url");
    var audiofile = document.getElementById("audio");
    var audfile = audiofile.files[0];

    if(!(imagefile.files.length ==0 || audiofile.files.length ==0 ) ){
        
        var arr_upload= [];
        arr_upload.push(image_data_upload,upload_name);
        console.log(arr_upload);

        url = "https://"+IP+"/moodle/blocks/testblock/classes/mediaupload.php";
       
        var formdata = new FormData();
        arr_upload.forEach((item) => formdata.append("mediaUpload[]", item))
        formdata.append("audio",audfile);

        // verify the data
        console.log(formdata.getAll("mediaUpload[]"));
        console.log(formdata.getAll("audio"));

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            // Do what you want here with the response here
            var result= this.responseText;
            
                if(result=="sucess"){
                    $('#Modalsucess2').modal('show');
                } else if(result=="alert"){
                    $('#Modaluploadexists2').modal('show');
                }
                else if(result=="failed"){
                    $('#Modaluploadfailed2').modal('show');
                }
            }
        };
        xhttp.onerror = function(event) {
            document.getElementById("myResponse").innerHTML = "Request error:" + event.target.status;
        };
        xhttp.open("POST", url, true);
        xhttp.send(formdata);


    }
    else{
        $('#Modaldanger2').modal('show')
    }
    
} 

// capture image from video file
function capture() {
    
    var canvas = document.getElementById("canvas");     
    var video = document.getElementById("theVideo");
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    canvas.getContext("2d").drawImage(video, 0, 0, video.videoWidth, video.videoHeight); 
    capturedimage= canvas.toDataURL('image/png');
    document.getElementById("prediction").innerHTML = "Loading...";
    doPrediction();
        
}

//// Object detection video upload

function doPrediction() {
    if( model ) {
        //model.detect  //for cocossd
            //model.classify //for mobilenet
        model.detect(canvas).then(predictions => {
            showPrediction(predictions);
        });
    } else {
         //cocoSsd.load() //for cocossd
        //mobilenet.load() // mobile net model
        cocoSsd.load().then(_model => {
            model = _model;
            //model.detect  //for cocossd
            //model.classify //for mobilenet
            model.detect(canvas).then(predictions => {
                showPrediction(predictions);
            });
        });
    }
}

// show object detection predictions on UI
function showPrediction(predictions) {

    
    var toconvert = "This might be a " + predictions[0].class;
    //var predicted_name= predictions[0].className;  //mobilenet
    var predicted_name;
    if(predictions.length == 0){
        predicted_name = "undefined";
    } else {
        predicted_name= predictions[0].class; //cocossd
    }
    var pred_name=predicted_name.toString().split(',')[0];
    if (pred_name.match(/\s/g)){
        var myString = pred_name.replaceAll(" ", "_").toLowerCase()
        vidname = myString;
    } else {
        vidname= pred_name;
    }
    document.getElementById("prediction").innerHTML = "This might be a " + pred_name;

    var msg = new SpeechSynthesisUtterance("This might be a " + pred_name);
    // msg.lang='de-DE';  // speech language
    window.speechSynthesis.speak(msg);

    
}


/// object detection in image upload section 

document.getElementById("image_url").onchange = function(e) {
    
    var img = new Image();
    img.onload = draw;
    img.onerror = failed;
    img.src = URL.createObjectURL(this.files[0]);
  };
  function draw() {
    var canvas_img = document.getElementById('canvas_img');
    canvas_img.width = this.width;
    canvas_img.height = this.height;
    var ctx = canvas_img.getContext('2d');
    ctx.drawImage(this, 0,0);
    image_data_upload= canvas_img.toDataURL('image/png');
    document.getElementById("prediction_image").innerHTML = "Loading...";
    doPrediction_img();

    
  }
  function failed() {
    console.error("The provided file couldn't be loaded as an Image media");
  }


  function doPrediction_img() {
    if( model ) {
        //model.detect
        //model.classify 
        model.detect(canvas_img).then(predictions_img => {
            showPrediction_img(predictions_img);
        });
    } else {
        //cocoSsd.load() //for cocossd
        //mobilenet.load() // mobile net model
        cocoSsd.load().then(_model => {
            model = _model;
            //model.detect  //for cocossd
            //model.classify //for mobilenet
            model.detect(canvas_img).then(predictions_img => {
                showPrediction_img(predictions_img);
            });
        });
    }
}

function showPrediction_img(predictions_img) {

    //var predicted_name= predictions_img[0].className;  //mobilenet
       //cocossd
    var predicted_name; 
    if(predictions_img.length == 0){
        predicted_name = "undefined";
    } else {
        predicted_name= predictions_img[0].class; //cocossd
    }
    var pred_name=predicted_name.toString().split(',')[0];
    if (pred_name.match(/\s/g)){
        var myString = pred_name.replaceAll(" ", "_").toLowerCase()
        upload_name = myString;
    } else {
        upload_name= pred_name;
    }
    
    document.getElementById("prediction_image").innerHTML = "This might be a " + pred_name;
    

    var msg_img = new SpeechSynthesisUtterance("This might be a " + pred_name);
    //msg_img.lang = 'de-DE'; //speech language
    window.speechSynthesis.speak(msg_img);
    
}
