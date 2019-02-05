/*Declaración adelantada botón deslizado.*/
$(".dropdown-button").dropdown();


/*Función de autocompletar formulario con datos de matrícula de avioneta.*/
function autocom() {
	$('input.autocomplete').autocomplete({
      	data: {
      		//WARRIOR PA28
        	"QB": null,
        	"BV": null,
        	"HF": null,
        	"DV": null,
        	"MQ": null,
        	"IK": null,
        	"OS": null,
        	"MA": null,
        	"KG": null,
        	"QL": null,
        	"IL": null,
        	"YU": null,
        	"MR": null,
        	"KH": null,
        	"QM": null,
        	"QN": null,
        	"QO": null,
        	"OT": null,
        	"BR": null,
        	"KI": null,

        	//DIAMOND DA42
        	"TY": null,
        	"TZ": null,
        	"UE": null,
        	"UF": null,
        	"CO": null,
            "NP": null,

        	//SLINGSBY T67
        	"MH": null,

        	//ROBIN R2160i
        	"JL": null,

        	//SENECA PA34
        	"DY": null,
        	"HG": null,
        	"YX": null,	

            //WorkShop
            "WS": null
      	},
    });
}


/*Función de carga de calendario a partir de la hora local del sistema.*/
function calend() {
	const Calender = document.querySelector('.datepicker');
    M.Datepicker.init(Calender, {});
}


/*
Función de control código de avioneta o WorkShop existe en hangar.
*/
function validorder() {
    var order = document.getElementById('orden').value; 

    if(order == "QB" || order == "BV" || order == "HF" || order == "DV" || order == "MQ" || order == "IK" || 
    order == "OS" || order == "MA" || order == "KG" || order == "QL" || order == "IL" || order == "YU" || 
    order == "MR" || order == "KH" || order == "QM" || order == "QN" || order == "QO" || order == "OT" || 
    order == "BR" || order == "KI" || order == "TY" || order == "TZ" || order == "UE" || order == "UF" || 
    order == "CO" || order == "NP" || order == "MH" || order == "JL" || order == "DY" || order == "HG" || 
    order == "YX" || order == "WS") {
        document.getElementById('newo').disabled = false;
    }
    else {
        document.getElementById('newo').disabled = true;
    }
}


/*
Función de control de hora inicial < hora final en cada turno.
*/
function bighourtest2(h1, h2, h3, h4, h5, h6, h7, h8, h9, h10, m1, m2, m3, m4, m5, m6, m7, m8, m9, m10) {
    var hs1 = document.getElementById( h1 ).value; 
    var he1 = document.getElementById( h2 ).value; 
    var hs2 = document.getElementById( h3 ).value; 
    var he2 = document.getElementById( h4 ).value; 
    var hs3 = document.getElementById( h5 ).value; 
    var he3 = document.getElementById( h6 ).value; 
    var hs4 = document.getElementById( h7 ).value; 
    var he4 = document.getElementById( h8 ).value; 
    var hs5 = document.getElementById( h9 ).value; 
    var he5 = document.getElementById( h10 ).value; 

    var ms1 = document.getElementById( m1 ).value; 
    var me1 = document.getElementById( m2 ).value; 
    var ms2 = document.getElementById( m3 ).value; 
    var me2 = document.getElementById( m4 ).value; 
    var ms3 = document.getElementById( m5 ).value; 
    var me3 = document.getElementById( m6 ).value; 
    var ms4 = document.getElementById( m7 ).value; 
    var me4 = document.getElementById( m8 ).value; 
    var ms5 = document.getElementById( m9 ).value; 
    var me5 = document.getElementById( m10 ).value; 

    /*La hora fin < hora inicio OR hora fin 1 vacía OR hora inicio 1 vacía.*/
    if (he1 < hs1 || he2 < hs2 || he3 < hs3 || he4 < hs4 || he5 < hs5 || hs1 == "00" || he1 == "00" ||
        /*La hora inicio siguiente turno < hora fin turno anterior, ambas distinas de 0.*/
        hs2 != "00" && he1 != "00" && hs2 < he1 || 
        hs3 != "00" && he2 != "00" && hs3 < he2 || 
        hs4 != "00" && he3 != "00" && hs4 < he3 || 
        hs5 != "00" && he4 != "00" && hs5 < he4 ||
        /*La hora inicio turno es == a hora fin turno pero los minutos fin < minutos inicio.*/
        he1 == hs1 && me1 < ms1 || he2 == hs2 && me2 < ms2 || he3 == hs3 && me3 < ms3 || 
        he4 == hs4 && me4 < ms4 || he5 == hs5 && me5 < ms5 ||
        /*La hora inicio siguiente turno == hora fin turno anterior, ambas distinas de 0, 
        pero minutos inicio siguiente turno < minutos fin turno anterior.*/
        hs2 != "00" && he1 != "00" && hs2 == he1 && ms2 < me1 || 
        hs3 != "00" && he2 != "00" && hs3 == he2 && ms3 < me2 || 
        hs4 != "00" && he3 != "00" && hs4 == he3 && ms4 < me3 || 
        hs5 != "00" && he4 != "00" && hs5 == he4 && ms5 < me4 ||
        /*Una hora está vacía pero la otra no en un turno.*/
        hs2 == "00" && he2 != "00" || hs2 != "00" && he2 == "00" ||
        hs3 == "00" && he3 != "00" || hs3 != "00" && he3 == "00" || 
        hs4 == "00" && he4 != "00" || hs4 != "00" && he4 == "00" ||
        hs5 == "00" && he5 != "00" || hs5 != "00" && he5 == "00" ||
        /*Las horas están vacías pero los minutos no.*/
        hs2 == "00" && he2 == "00" && ms2 != "00" && me2 == "00" ||
        hs3 == "00" && he3 == "00" && ms3 != "00" && me3 == "00" || 
        hs4 == "00" && he4 == "00" && ms4 != "00" && me4 == "00" ||
        hs5 == "00" && he5 == "00" && ms5 != "00" && me5 == "00" ||
        hs2 == "00" && he2 == "00" && ms2 == "00" && me2 != "00" ||
        hs3 == "00" && he3 == "00" && ms3 == "00" && me3 != "00" || 
        hs4 == "00" && he4 == "00" && ms4 == "00" && me4 != "00" ||
        hs5 == "00" && he5 == "00" && ms5 == "00" && me5 != "00") {
            document.getElementById('submitBtn').disabled = true;
    }
    else {
        document.getElementById('submitBtn').disabled = false;   
    }    
}

