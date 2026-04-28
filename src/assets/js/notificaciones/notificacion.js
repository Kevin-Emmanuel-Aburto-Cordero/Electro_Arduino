let destino ="";

function abrirModal(boton){
    destino = boton.dataset.url;
    document.getElementById("modal").style.display="flex";
}

function cerrarModal(){
    document.getElementById("modal").style.display="none";
}

function aceptar(){
    window.location.href=destino;
}

window.addEventListener("pageshow", function(){
    cerrarModal();
    destino = "";
});