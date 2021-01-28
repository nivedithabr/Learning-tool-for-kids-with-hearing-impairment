
let mic;
let vol;
let sound;
let soundClassifier;
let resultP;

//https://teachablemachine.withgoogle.com/models/QVtdHsAFG/    (for animal sound)
//https://teachablemachine.withgoogle.com/models/soGlJQFWa/     (for alert sound)



let soundModelURL = 'https://teachablemachine.withgoogle.com/models/soGlJQFWa/';

//results paragraph
function preload() {

  soundClassifier = ml5.soundClassifier(soundModelURL+ 'model.json');
  //name of the model, pass the options into the classifier as the 2nd argument
}
// }

function setup() {
  
  //resultP = createP('listening...')
  
 
  soundClassifier.classify(gotCommand);

  random(loadSound);
  noLoop();
}
function gotCommand(error, results){
  if (error){
    console.error(error);
  }

  //resultP.html(`${results[0].label} : ${results[0].confidence}`);
  document.getElementById("res").innerHTML = (`${results[0].label} : ${results[0].confidence}`);
  var rt=results[0].confidence;
  var result = parseFloat(rt.toFixed(2))
  if(result >= 0.98){
    if(!((results[0].label)=="Background Noise")){
      var msg = new SpeechSynthesisUtterance(results[0].label);
      window.speechSynthesis.speak(msg);
    }
    
  }
  




}
    
  
  
