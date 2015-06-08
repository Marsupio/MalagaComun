// JavaScript Document

//----------------------------    ventana modal para una imagene    ------------------------------------------------------------
	
	function VentanaModal(valor, ruta)
	{
							
		document.getElementById("bg_ventana_modal").style.display=valor;		
		document.getElementById("ventana_modal").style.display=valor;		
		
	
		document.getElementById("ventana_modal").style.marginLeft="6%";
		document.getElementById("ventana_modal").style.marginRight="6%";
		document.getElementById("ventana_modal").style.marginTop="2%";
		document.getElementById("ventana_modal").style.marginBottom="2%";
		
		document.getElementById("ventana_modal").style.width="90%";
		document.getElementById("ventana_modal").style.height="90%";
		
		document.getElementById("ventana_modal").style.backgroundImage=ruta;
		
		
			
	}

//--------------------------- fin de la   ventana modal para las imagenes      ---------------------------------