function wipebericht(id){
document.getElementById(id).innerHTML = '';
document.getElementById(id).style.display = 'none';
}

function bericht(id, setText){
document.getElementById(id).innerHTML = setText;
document.getElementById(id).style.display = 'block'
}

function visibility(id) {
var e = document.getElementById(id);
		e.style.display = 'block';
}

function geen_visibility(id) {
var e = document.getElementById(id);
		e.style.display = 'none';
}

function wachtwoordcheck(){
    var ww1 = document.getElementById("wachtwoord1").value;
    var ww2 = document.getElementById("wachtwoord2").value;
    
    if (ww1 != ww2) {
        bericht('wwerror','<fieldset> <legend>Error</legend>De wachtwoorden moeten gelijk zijn')
        }
    else{ wipebericht('wwerror')
    }
}

function emailcheck(){
    var email = document.getElementById("e-mail").value;
    if( /(.+)@(.+){2,}\.(.+){2,}/.test(email) ){
        wipebericht('emailerror')
    } else {
        bericht('emailerror','<fieldset> <legend>Error</legend>Het opgegeven e-mail adres is niet geldig')
}}

function kamercheck(){
    var kamer = document.getElementById("kamer").value;
    if(kamer == 3){
        bericht('kamererror','<fieldset> <legend>Error</legend>U moet een keuze voor accomodaties aangeven')
    } else {
        wipebericht('kamererror')
}}

function titelcheck(){
    var spreker = document.getElementById("spreekt").value;
    if (spreker == 1) {
        var titel = document.getElementById("onderwerp").value;
        if (titel == '') { 
            bericht('titelerror','<fieldset> <legend>Error</legend>U moet een titel invoeren van uw lezing')
        
    
	} else {wipebericht('titelerror');

}}}