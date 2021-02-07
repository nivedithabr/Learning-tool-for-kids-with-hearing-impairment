"use strict";

const TILE_NUM = 4;
var TILES = {};
var move = 1;

var preElt = document.querySelector("#pre"),
    themesElt = document.querySelector("#themes"),
    restart= document.querySelector("#restart"),
    postElt = document.querySelector("#post"),
   // finalElt = document.querySelector("#final"),
    againElt = document.querySelector("#again");


let minutes = 0;
let seconds = 0;

var clock = {
    startTime: undefined,
    timer: undefined
}

var stats = {
    matches: undefined,
    missed: undefined,
    remaining: undefined
}

var lastTile = {
    img: undefined,
    element: undefined
}

/**
 * Shuffles an array in-place.
 * Source: https://bost.ocks.org/mike/shuffle/
 * @param {[]} array 
 * @returns {[]} the shuffled input array
 */
function shuffle(array) {
    var m = array.length, t, i;
    while (m) {
        i = Math.floor(Math.random() * m--);
        t = array[m];
        array[m] = array[i];
        array[i] = t;
    }
    return array;
}

/**
 * Returns a shallow copy of the object by
 * copying all of its properties to a new object.
 * @param {Object} obj - an object to copy
 * @returns {Object} a shallow clone of the object
 */
function cloneObject(obj) {
    return Object.assign({}, obj);
}

function newGame() {

    stats.remaining = TILE_NUM;
    // renderStats(stats);

    let tileArray = shuffle(TILES).slice(0, TILE_NUM);
    let tiles = document.querySelector("#tiles");
    tiles.textContent = "";
    for (let i = 0; i < TILE_NUM; i++) {
        tiles.appendChild(renderTile(tileArray[i]));
    }
}

function renderTile(tile) {
    let tileDiv = document.createElement("div");
    tileDiv.classList.add("tile-div");
    tileDiv.classList.add("col-5");

    let button = document.createElement("button");
    button.classList.add("btn");
    button.setAttribute("aria-label", "flip");
    
    let img = document.createElement("img");
    img.classList.add("zoom");
    img.src = tile.url;
    img.alt = tile.alt;
    
    tileDiv.textContent = tile.alt;
    var audi = document.createElement("audio");
         
    
    button.appendChild(img);
    tileDiv.appendChild(button);


    button.addEventListener("click", function(evt){
        evt.preventDefault();
        if (img.alt === img.alt) {
            img.src = tile.url;
            img.alt = tile.alt;
            var msg_img = new SpeechSynthesisUtterance(tile.alt);
    //msg_img.lang = 'de-DE'; //speech language
            window.speechSynthesis.speak(msg_img);
            audi.src = tile.audio;
            audi.play();
            
            
        }
    });
    return tileDiv;
}

function renderStats(stats) {

    document.querySelector("#remaining").textContent = stats.remaining;
}

function renderClock(clock) {
    let time = Date.now() - clock.startTime;
     minutes = Math.floor(time / 60000);
     seconds = Math.floor((time % 60000) / 1000);
    document.querySelector("#time").textContent = "" + minutes + " min " + seconds + " sec";
}

againElt.addEventListener("click", function(){
   
    postElt.classList.add("hidden");
    newGame();
}
);

restart.addEventListener("click", function() {
        newGame();
})

themesElt.addEventListener("click", function(e) {
    if (e.target.classList.contains("themes")) {
      activateTheme(e.target.id);
      preElt.classList.add("hidden");
    }
  });
  
  function activateTheme(theme) {
    // insert theme in images array
    switch (theme) {
      case "Animals":
        
        TILES=Animals;
        clock.startTime = Date.now();
        clock.timer = window.setInterval(function(){
            renderClock(clock);
        }, 1000);
        newGame();
        break;
    }
    switch (theme) {
        case "Others":
          
          TILES=others;
          clock.startTime = Date.now();
          clock.timer = window.setInterval(function(){
            renderClock(clock);
          }, 1000);
          newGame();
          break;
      }
}
