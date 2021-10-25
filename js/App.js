
//temporizador
let segundos =30;

function temporizador(){
   
    segundos --;
     if(segundos==0){
        window.location.href = "index.html";
    }
    
}

//formulario de envio de lugar 

const alerta = document.getElementById("alerta");
alerta.style.visibility = 'visible';
//console.log(alerta);

const formulario = document.querySelector('form');
formulario.addEventListener('submit', event => {
    event.preventDefault();

    var autor = document.getElementById('autor').value;
    var titulo = document.getElementById('titulo').value;
    var description = document.getElementById('description').value;

    
    var categories = document.getElementById("categorias")
    var seleccionado = categories.options[categories.selectedIndex].value;
    
    //console.log(autor + titulo + seleccionado + description);
    document.querySelector('form').reset();
    alerta.innerHTML=`Su formulario ha sido enviado con los siguientes datos <br>  -autor: ${autor}, <br> -titulo: ${titulo}, <br> -descripcion: ${description}, <br> -categoria ${seleccionado} <br> <br> Redireccionando a la pagina principal en ${segundos}s `;
    alerta.style.visibility = 'visible';
    
     gsap.to("#alerta", {
        duration: .8,
        y: 950,
        ease: 'bounce'
    });
    setInterval(function() {
    alerta.innerHTML=`Su formulario ha sido enviado con los siguientes datos <br>  -autor: ${autor}, <br> -titulo: ${titulo}, <br> -descripcion: ${description}, <br> -categoria ${seleccionado} <br> <br> Redireccionando a la pagina principal en ${segundos}s `;
  
    
    temporizador();
   
    }, 1000)
   
    //alert(`Su formulario ha sido enviado con los siguientes datos autor: ${autor}, titulo: ${titulo}, descripcion: ${description}, categoria ${seleccionado}... Redireccionando a la pagina principal` );
   // setTimeout(function(){
  //      window.location.href = "index.html";
   // }, 5000);
    

})

   
