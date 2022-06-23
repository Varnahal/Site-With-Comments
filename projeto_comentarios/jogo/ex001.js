var body = document.getElementById("body");
//função parra pular
function pular(){
    let butao = document.getElementById('pulo');
        butao.onclick = function() {arroz()};
        body.classList.add('pulo');
        setTimeout(() => {
            body.classList.remove('pulo');
            butao.onclick = function(){pular()};
        }, 800);   
    
}

//função para pegar informações de localização e o contador, tambem verifica se morreu
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

    setInterval(function muda() {
        if(cont > 4){
            body.classList.add('speed');
        }
        if(cont > 19){
            body.classList.remove('speed');
            body.classList.add('speed1');
        }
        if(cont > 49){
            body.classList.remove('speed1');
            body.classList.add('speed2');
        }    
    }, 10);
    
    setInterval(() => {
        if(morreu == false){
            cont ++  
            contador.innerHTML = cont;
        }
    }, 2000);
   
}

//restarta o jogo
function restart(){ 
    document.location.reload(true);
}

// função para pegar qual tecla o usuario clicou
body.addEventListener("keypress", function(event) {
  // If the user presses the "Space" key on the keyboard
  if (event.key === " ") {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
    document.getElementById("pulo").click();
    //console.log('pulo')
  }
});