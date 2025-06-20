 function abrirJanela(elemento){
    document.getElementById(elemento).style.display="unset";
    document.getElementById("display-sticky").style.position="unset";

 }
function fecharJanela(elemento){
	document.getElementById(elemento).style.display="none";
	document.getElementById("display-sticky").style.position="sticky";
}
 function load(){
	//Code
}

window.addEventListener("load", load);