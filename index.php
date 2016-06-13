<html>
<head>
<script type="text/javascript" src="prototype_1.7_rc2.js"></script>
<script type="text/javascript">


function checkUploadSpeed( iterations, update ) {
    var average = 0,
        index = 0,
        timer = window.setInterval( check, 25000 ); //check every 15 seconds
        check();

    function check() {
        var xhr = new XMLHttpRequest(),
            url = '?cache=' + Math.floor( Math.random() * 10000 ),
            data = getRandomString( 1 ),
            startTime,
            speed = 0;
        xhr.onreadystatechange = function ( event ) {
            if( xhr.readyState == 4 ) {
                speed = Math.round( 1024 / ( ( new Date() - startTime ) / 1000 ) );
                average == 0
                    ? average = speed
                    : average = Math.round( ( average + speed ) / 2 );
                update( speed, average );
                index++;
                if( index == iterations ) {
                    window.clearInterval( timer );
                };
            };
        };
        xhr.open( 'POST', url, true );
        startTime = new Date();
        xhr.send( data );
    };

    function getRandomString( sizeInMb ) {
        var chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789~!@#$%^&*()_+`-=[]\{}|;':,./<>?",
            iterations = sizeInMb * 1024 * 1024,
            result = '';
        for( var index = 0; index < iterations; index++ ) {
            result += chars.charAt( Math.floor( Math.random() * chars.length ) );
        };
        return result;
    };
};


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
														            prog.innerHTML   = "Ping a IP: "+document.getElementById('my-ip').innerHTML+"... <br>";
																    prog.innerHTML  += "&nbsp; Su velocidad de conexion es de: "+eval(connSpeed/1000)+" Mbps, <br><br>";
															        prog.innerHTML  += "&nbsp; Calculando velocidad Upload..... <br><br>";
														        checkUploadSpeed( 1, function ( speed, average ) {
																    prog.innerHTML  += "&nbsp; Su velocidad de Upload: "+eval(speed/1000)+" Mbps, <br>";
																} );

    					       							   },
    			    		   requestHeaders:['X-Update', id_cargar]
    			     		   }
    			     );
}
</script>
</head>
	<body><script type="text/javascript">
		    function get_ip(obj)
		    {
		        document.getElementById('my-ip').innerHTML = obj.ip;
		    }
		</script>
	    <h1>TEST REALIZADO POR JUAN PACHECO FREELANCE 2 de junio del 2016 @Venezuela</h1>
	    <br>
		<button onclick="medir_velocidad('cargar_bytes.php','resultado',this.value);">Test download</button>
		<br><br>
		<div id="progress" style="width:400px; border:thin solid black; overflow:scroll; height:200px;"></div>
		<div id="resultado" style="display:none"></div>
	    <div id="ip" style="display:none"><strong id="my-ip"></strong></div>
		<script type="text/javascript" src="https://api.ipify.org/?format=jsonp&callback=get_ip"></script>
	</body>
</html>