document.getElementById("boton1").addEventListener("click", () => enviar());
function enviar() {
    const data = new FormData(document.getElementById('formulario'));
fetch('/importarDiario', {
method: 'POST',
body: data
})
.then(function(response) {
if(response.ok) {
    return response.text()
} else {
    throw "Error en la llamada Ajax";
}

})
.then(function(texto) {
console.log(texto);
})
.catch(function(err) {
console.log(err);
});
}
