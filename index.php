<html>
<head>
<script type="text/javascript" src="prototype_1.7_rc2.js"></script>
<script type="text/javascript">
function medir_velocidad(url_cargar,id_cargar,parametro_extra){
   new Ajax.Updater(
    				id_cargar,
    				url_cargar,
    						  {asynchronous:true,
    						   evalScripts:true,
    						   onLoading:function(request){
								    						   	var d = new Date;
								   							    time1 = d.getTime();
    						   							  },
    					       onComplete:function(request){
								   							    contenido = request.responseText;
								   							    tamano_KB = eval(contenido.length/1000);
								   							    var d = new Date;
								   							    var time      = Math.round((d.getTime()-time1)/10)/100;
														        var connSpeed = Math.round(tamano_KB/time);
														        var prog        = document.getElementById('progress');
														        prog.innerHTML  = "Total time: \t\t\t"+time+" second"+
																				  "\nTotal Kbps: \t\t\t"+tamano_KB+" Kb"+
																				  "\Velocidad conexion: \t"+connSpeed+" kBps";
    					       							   },
    			    		   requestHeaders:['X-Update', id_cargar]
    			     		   }
    			     );
}
</script>
</head>
	<body>
		<button onclick="medir_velocidad('cargar_bytes.php','resultado',this.value);">Test 1</button>
		<div id="progress" style="width:400px; border:thin solid black; overflow:scroll; height:200px;"></div>
		<div id="resultado" style="display:none"></div>
	</body>
</html>