


//formulario de envio de lugar 

const formulario = document.querySelector('form');
formulario.addEventListener('submit', event => {
    event.preventDefault();

    var autor = document.getElementById('autor').value;
    var titulo = document.getElementById('titulo').value;
    var description = document.getElementById('description').value;

    
    var categories = document.getElementById("categorias")
    var seleccionado = categories.options[categories.selectedIndex].value;
    
    console.log(autor + titulo + seleccionado + description);
    alert(`Su formulario ha sido enviado con los siguientes datos autor: ${autor}, titulo: ${titulo}, descripcion: ${description}, categoria ${seleccionado}... Redireccionando a la pagina principal` );
    setTimeout(function(){
        window.location.href = "index.html";
    }, 10);
    document.querySelector('form').reset();

})