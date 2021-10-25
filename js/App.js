//temporizador
let segundos = 30;

function temporizador() {

    segundos--;
    if (segundos == 0) {
        window.location.href = "index.html";
    }

}

//formulario sing up

function singUp(){
var singUp = document.getElementById('singUp');
singUp.addEventListener('submit',event => {
    event.preventDefault();

    const alerta = document.getElementById("alerta-singup");
    alerta.style.visibility = 'visible';


    var name = document.getElementById("full-name").value;
    var email = document.getElementById("email").value;
    var username = document.getElementById("user").value;
    var password = document.getElementById("password").value;
    var passwordValidation = document.getElementById("passwordValidation").value;

   console.log(name);
    alerta.innerHTML = `Usuario registrado correctamente <br>  -name: ${name}, <br> -email: ${email}, <br> -username: ${username}, <br> -password ${password} <br> <br> Redireccionando a la pagina principal en ${segundos}s `;
    alerta.style.visibility = 'visible';
     gsap.to("#alerta-singup", {
        duration: .8,
        y: 950,
        ease: 'bounce'
    });
})
}


//formulario de envio de lugar 


//console.log(alerta);

var placeForm = document.getElementById('placeForm');
placeForm.addEventListener('submit', event => {
    event.preventDefault();
    const alerta = document.getElementById("alerta-place");
    alerta.style.visibility = 'hidden';

    var autor = document.getElementById('autor').value;
    var titulo = document.getElementById('titulo').value;
    var description = document.getElementById('description').value;


    var categories = document.getElementById("categorias")
    var seleccionado = categories.options[categories.selectedIndex].value;

    //console.log(autor + titulo + seleccionado + description);
    document.querySelector('form').reset();
    alerta.innerHTML = `Su formulario ha sido enviado con los siguientes datos <br>  -autor: ${autor}, <br> -titulo: ${titulo}, <br> -descripcion: ${description}, <br> -categoria ${seleccionado} <br> <br> Redireccionando a la pagina principal en ${segundos}s `;
    alerta.style.visibility = 'visible';

    gsap.to("#alerta-place", {
        duration: .8,
        y: 950,
        ease: 'bounce'
    });
    setInterval(function () {
        alerta.innerHTML = `Su formulario ha sido enviado con los siguientes datos <br>  -autor: ${autor}, <br> -titulo: ${titulo}, <br> -descripcion: ${description}, <br> -categoria ${seleccionado} <br> <br> Redireccionando a la pagina principal en ${segundos}s `;
         temporizador();

    }, 1000)
})

