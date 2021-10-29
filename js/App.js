//temporizador
let segundos = 10;

function temporizador() {

    segundos--;


}

//areglos para los usuarios de prueba
var userstest = ['admin'];
var passwordstest = ['admin'];

window.sessionStorage.setItem('usersA', JSON.stringify(userstest));
window.sessionStorage.setItem('passwordsA', JSON.stringify(passwordstest));


//formulario sing up

function singUp() {
    var singUps = document.getElementById('singUp');
    singUps.addEventListener('submit', event => {
        event.preventDefault();

        const alerta = document.getElementById("alerta-singup");
        alerta.style.visibility = 'hidden';


        var name = document.getElementById("full-name").value;
        var email = document.getElementById("email").value;
        var username = document.getElementById("user").value;
        var password = document.getElementById("password").value;
        var passwordValidation = document.getElementById("passwordValidation").value;

        if (password != passwordValidation) {
            alerta.innerHTML = "Las contraseñas no coinciden";
            gsap.to("#alerta-singup", {
                duration: .8,
                y: 950,
                ease: 'bounce'
            });
        } else {

            //console.log(name);
            alerta.innerHTML = `Usuario registrado correctamente <br>  -name: ${name}, <br> -email: ${email}, <br> -username: ${username} <br> <br> Redireccionando al login en ${segundos}s `;

            alerta.style.visibility = 'visible';
            gsap.to("#alerta-singup", {
                duration: .8,
                y: 950,
                ease: 'bounce'
            });
            setInterval(function () {
                alerta.innerHTML = `Usuario registrado correctamente <br>  -name: ${name}, <br> -email: ${email}, <br> -username: ${username} <br> <br> Redireccionando al login en ${segundos}s `;
                temporizador();
                if (segundos == 0) {
                    window.location.href = "login.html";
                }

            }, 1000);
            userstest.push(username);
            passwordstest.push(password);

            window.sessionStorage.setItem('users', JSON.stringify(userstest));
            window.sessionStorage.setItem('passwords', JSON.stringify(passwordstest));


        }
    })
}


//formulario de envio de lugar 


//console.log(alerta);

function formplace() {


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
            if (segundos == 0) {
                window.location.href = "index.html";
            }

        }, 1000)
    });
}
// para iniciar sesion
function singIn() {
    var login = document.getElementById('login');
    login.addEventListener('submit', event => {
        event.preventDefault();


        const alerta = document.getElementById("alerta-login");
        alerta.style.visibility = 'hidden';

        var user = document.getElementById("user-name-login").value;
        var password = document.getElementById("password-login").value;

        var users = JSON.parse(window.sessionStorage.getItem('users'));
        var passwords = JSON.parse(window.sessionStorage.getItem('passwords'));
         var admins = JSON.parse(window.sessionStorage.getItem('usersA'));
         var passwordsA = JSON.parse(window.sessionStorage.getItem('passwordsA'));

        if(users==null && passwords==null){
            users="n";
            passwords="n";
           
        }
        if (users.includes(user) && passwords.includes(password) || admins.includes(user) && passwordsA.includes(password)) {
            alerta.innerHTML = `Bienvenido ${user} <br> Redireccionando a la pagina principal en ${segundos}s `;

            alerta.style.visibility = 'visible';
            window.sessionStorage.setItem('login', true);

            gsap.to("#alerta-login", {
                duration: .8,
                y: 850,
                ease: 'bounce'
            });
            setInterval(function () {
                alerta.innerHTML = `Bienvenido ${user} <br> Redireccionando a la pagina principal en ${segundos}s `;
                temporizador();
                if (admins.includes(user) && passwordsA.includes(password)  && segundos == 0) {
                    window.location.href = "admin-home.html";
                    window.sessionStorage.setItem('admin-login',true);
                }else if (segundos == 0) {
                    window.location.href = "index.html";
                }

            }, 1000)
        }else if(users=="n" && passwords=="n"){
             alerta.innerHTML = "No hay usuarios registrados";
             alerta.style.visibility = 'visible';
             gsap.to("#alerta-login", {
                 duration: .8,
                 y: 850,
                 ease: 'bounce'
             });

        } else {
            alerta.innerHTML = "Usuario o contraseña incorrecta (para terminos de prueba de admin, inserte admin tanto en user como password)";
            alerta.style.visibility = 'visible';
            gsap.to("#alerta-login", {
                duration: .8,
                y: 850,
                ease: 'bounce'
            });
        }


    });
}

//validar login para ver formulario de envio de lugar
function validateFormPlace() {
    var login = window.sessionStorage.getItem('login');
    if (login == "true") {
        window.location.href = "placeForm.html";
    }else{
       var aviso = document.getElementById("forms");
       aviso.innerHTML = "Por favor <br> inicie  sesion <br> para continuar";
       aviso.style.color = "#921111";
    }
}

//verificar si el usuario ya esta logeado
function validateLogin() {
    var login = window.sessionStorage.getItem('login');
    var loginAdmin = window.sessionStorage.getItem('admin-login');
    if (login == "true" || loginAdmin == "true") {
        var log = document.getElementById("log");
        var regis = document.getElementById("regis");
        log.style.display = "none";
        regis.style.display = "none";
    }
}

//ocultar foto si admin elimina
function hidePhoto(id) {
    var photo = document.getElementById(id);
    photo.style.display = "none";
}
//aceptar foto admins
function acceptPhoto(id) {
     const alerta = document.getElementById("alerta-control");
     alerta.style.visibility = 'hidden';

    var photo = document.getElementById(id);
    photo.style.display = "none";

     
}