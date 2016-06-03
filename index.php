<html>
<head>
<script type="text/javascript" src="prototype_1.7_rc2.js"></script>
<script type="text/javascript">


function checkUploadSpeed( iterations, update ) {
    var average = 0,
        index = 0,
        timer = window.setInterval( check, 5000 ); //check every 5 seconds
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

														        prog.innerHTML   = "Su velocidad de conexión es de: "+connSpeed+" Kbps, \n";
														        prog.innerHTML  += "Se enviarón: "+tamano_KB+" Kb, \n";
														        prog.innerHTML  += "Tiempo utilizado: "+time+" Segundos, \n";
														        prog.innerHTML  += "Ping a: "+document.getElementById('my-ip').innerHTML+"\n";

														        checkUploadSpeed( 5, function ( speed, average ) {
																    document.getElementById( 'speed' ).textContent = 'speed: ' + speed + 'kbs';
																    document.getElementById( 'average' ).textContent = 'average: ' + average + 'kbs';
																} );

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

		<div id="speed">speed: 0kbs</div>
		<div id="average">average: 0kbs</div>

		<div id="resultado" style="display:none"></div>
	    <div id="ip" style="display:none"><strong id="my-ip"></strong></div>
		<script type="text/javascript">
		    function get_ip(obj)
		    {
		        document.getElementById('my-ip').innerHTML = obj.ip;
		    }
		</script>
		<script type="text/javascript" src="https://api.ipify.org/?format=jsonp&callback=get_ip"></script>
	</body>
</html>