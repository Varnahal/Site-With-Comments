function executar(){
    let div = document.getElementById('memes');
    let butao = document.getElementById('pulo');
    div.style.transition = '0.8s';
        butao.onclick = function() {arroz()};
        div.style.top ='420px'
        setTimeout(() => {
          div.style.top = '570px';
          
        }, 400);
        
        setTimeout(() => {
            butao.onclick = function(){executar()};
        }, 400);
    
}//556top 156left
function morreu(){
    let div = document.getElementById('memes');
    let div1 = document.getElementById('memes1');
    let cano = document.getElementById('cano');
    let contador = document.getElementById('cont')
    var morreu = false;
    var cont = 0
    div1.style.display = 'none'
    setInterval(() => {
        var coordsl = Number(cano.offsetLeft);
        var coordst = Number(div.offsetTop);
        console.log(coordsl +' and '+ coordst)
        
        if(coordsl <= 173  && coordst > 556 && coordsl >26){
            
        div.style.display = 'none';
        div1.style.display = 'flex';
        div1.style.top = coordst+'px'
        morreu = true
        cano.style.animation = 'nada'
        cano.style.display ='none'
        butao.onclick = function() {arroz()};
        }
        
    }, 100);  
    setInterval(() => {
        if(morreu == false){
            cont ++  
            contador.innerHTML = 'Pontuação: ' + cont;
        }
    }, 2000); 
}
function restart(){
    document.location.reload(true);
}

var body = document.getElementById("body");

// Execute a function when the user presses a key on the keyboard
body.addEventListener("keypress", function(event) {
  // If the user presses the "Enter" key on the keyboard
  if (event.key === " ") {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
    document.getElementById("pulo").click();
    console.log('pulo')
  }
});