
const TILEBACK = "https://192.168.178.20/moodle/blocks/testblock/classes/image_dir/tileback.jpg";
const TILEBACKALT = "tile back image";



const Animals= new Array();
var xhttp = new XMLHttpRequest();
var url ="https://192.168.178.20/moodle/blocks/testblock/classes/memgame.php";
xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    // Do what you want here with the response here
   
    var resultin =new Array();
    resultin = JSON.parse(this.responseText);
    var result = new Array(resultin.length - 1);
    var count = 0;
    for (let i = 0; i < result.length; i=i+3) {
        result[count] = {
            url: resultin[i],
            alt: resultin[i + 1],
            audio: resultin[i + 2]
        };  
        Animals.push(result[count]);
        ++count; 
        
    }
    
    console.log(result);
	
	// console.log(resultin);
    }
};

console.log("booyah",Animals);
xhttp.open("POST",url, true);
xhttp.send();
//tile images
// const Animals = [
//     {
//         url: "https://192.168.178.20/moodle/blocks/testblock/classes/image_dir/cat.png",
//         alt: "cat",
//         audio: "https://192.168.178.20/moodle/blocks/testblock/classes/audio_dir/cat.mp3"
//     },
//     {
//         url: "https://192.168.178.20/moodle/blocks/testblock/classes/image_dir/cow.png",
//         alt: "cow",
//         audio: "https://192.168.178.20/moodle/blocks/testblock/classes/audio_dir/cow.mp3"
//     },
//     {
//         url: "https://192.168.178.20/moodle/blocks/testblock/classes/image_dir/dog.png",
//         alt: "dog",
//         audio: "https://192.168.178.20/moodle/blocks/testblock/classes/audio_dir/dog.mp3"
//     },
//     {
//         url: "https://192.168.178.20/moodle/blocks/testblock/classes/image_dir/pig.png",
//         alt: "pig",
//         audio: "https://192.168.178.20/moodle/blocks/testblock/classes/audio_dir/pig.mp3"
//     },
//     {
//         url: "https://192.168.178.20/moodle/blocks/testblock/classes/image_dir/rooster.png",
//         alt: "rooster",
//         audio: "https://192.168.178.20/moodle/blocks/testblock/classes/audio_dir/rooster.mp3"
//     },
//     {
//         url: "https://192.168.178.20/moodle/blocks/testblock/classes/image_dir/sheep.png",
//         alt: "sheep",
//         audio: "https://192.168.178.20/moodle/blocks/testblock/classes/audio_dir/sheep.mp3"
//     },
//     {
//         url: "https://192.168.178.20/moodle/blocks/testblock/classes/image_dir/lion.png",
//         alt: "lion",
//         audio: "https://192.168.178.20/moodle/blocks/testblock/classes/audio_dir/lion.mp3"
//     },
//     {
//         url: "https://192.168.178.20/moodle/blocks/testblock/classes/image_dir/wolf.png",
//         alt: "wolf",
//         audio: "https://192.168.178.20/moodle/blocks/testblock/classes/audio_dir/wolf.mp3"
//     }
    
// ];