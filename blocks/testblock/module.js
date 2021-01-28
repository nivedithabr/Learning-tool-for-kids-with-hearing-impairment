// const ffmpeg = require("fluent-ffmpeg");



// const fs = require("fs");

// ffmpeg.setFfmpegPath("D:/Tools/ffmpeg-20181217-f22fcd4-win64-static/bin/ffmpeg.exe");

// ffmpeg.setFfprobePath("D:/Tools/ffmpeg-20181217-f22fcd4-win64-static/bin");

// console.log(ffmpeg);

// var inputElement =  document.getElementById("myFile");

// document.getElementById("demo").innerHTML = inputElement;

let url;
let model;
var capturedimage;
var vidname;

function changeVideo() {
                    
    var chosenFile = document.getElementById("myFile").files[0];
    document.getElementById("theVideo").setAttribute("src", URL.createObjectURL(chosenFile));
    // url = "https://192.168.178.20/moodle/blocks/testblock/classes/ajax.php";
    // /// send video file via ajax to ajax.php to extract audio from video
    // var formdata = new FormData();
    // formdata.append("myFile",chosenFile);
    // var xhttp = new XMLHttpRequest();
    // xhttp.onreadystatechange = function() {
    //     if (this.readyState == 4 && this.status == 200) {
    //     // Do what you want here with the response here
    //     document.getElementById("myResponse").innerHTML = this.responseText;
    //     }
    // };
    // xhttp.onerror = function(event) {
    //     document.getElementById("myResponse").innerHTML = "Request error:" + event.target.status;
    // };
    // xhttp.open("POST", url, true);
    // xhttp.send(formdata);
  }


  function changeAudio() {
    var audiofile = document.getElementById("audio").files[0];
    document.getElementById("theAudio").setAttribute("src", URL.createObjectURL(audiofile ));
  }

 
  document.getElementById("myFile").addEventListener("change", changeVideo);
  
  document.getElementById("audio").addEventListener("change", changeAudio);

  

function upload(){
    var videofile = document.getElementById("myFile");
    var vidfile = videofile.files[0];


    
    if(!videofile.files.length ==0 ){

        url = "https://192.168.178.20/moodle/blocks/testblock/classes/ajax.php";
        /// send video file via ajax to ajax.php to extract audio from video
        var formdata = new FormData();
        formdata.append("myFile",vidfile);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            // Do what you want here with the response here
            var result= this.responseText;
                if(result=="sucess"){
                    $('#Modalsucess').modal('show')
                }
            }
        };
        xhttp.onerror = function(event) {
            document.getElementById("myResponse").innerHTML = "Request error:" + event.target.status;
        };
        xhttp.open("POST", url, true);
        xhttp.send(formdata+"&image="+capturedimage+"&name="+vidname);
        
    }
    else{
        $('#Modaldanger').modal('show')
    }
    
}  

function mediaUpload(){
    var imagefile = document.getElementById("image_url");
    var audiofile = document.getElementById("audio");
    if(!(imagefile.files.length ==0 || audiofile.files.length ==0 ) ){
        $('#Modalsucess2').modal('show')
    }
    else{
        $('#Modaldanger2').modal('show')
    }
    
} 

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

//// Object detection 

function doPrediction() {
    if( model ) {
        model.detect(canvas).then(predictions => {
            showPrediction(predictions);
        });
    } else {
        cocoSsd.load().then(_model => {
            model = _model;
            model.detect(canvas).then(predictions => {
                showPrediction(predictions);
            });
        });
    }
}

function showPrediction(predictions) {

    document.getElementById("prediction").innerHTML = "This might be a " + predictions[0].class;
    var toconvert = "This might be a " + predictions[0].class;
    vidname = predictions[0].class;

    

    var msg = new SpeechSynthesisUtterance("This might be a " + predictions[0].class);
    msg.lang='de-DE';
    window.speechSynthesis.speak(msg);

    document.getElementById("image_name").innerHTML = predictions[0].class;
    
}

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
    document.getElementById("prediction_image").innerHTML = "Loading...";
    doPrediction_img();

    
  }
  function failed() {
    console.error("The provided file couldn't be loaded as an Image media");
  }


  function doPrediction_img() {
    if( model ) {
        model.detect(canvas_img).then(predictions_img => {
            showPrediction_img(predictions_img);
        });
    } else {
        cocoSsd.load().then(_model => {
            model = _model;
            model.detect(canvas_img).then(predictions_img => {
                showPrediction_img(predictions_img);
            });
        });
    }
}

function showPrediction_img(predictions_img) {


    document.getElementById("prediction_image").innerHTML = "This might be a " + predictions_img[0].class;
    var msg_img = new SpeechSynthesisUtterance("This might be a " + predictions_img[0].class);
    msg_img.lang = 'de-DE';
    window.speechSynthesis.speak(msg_img);
    
}
