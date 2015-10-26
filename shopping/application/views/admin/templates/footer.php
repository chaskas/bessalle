    </div>
    
    <script src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/js/jquery.Jcrop.min.js"); ?>"></script>
    <script language="Javascript">

    	$(function(){

    		$('#image').Jcrop({
    			aspectRatio: 1,
                minSize: [180,180],
    			onSelect: updateCoords
    		});

    	});

    	function updateCoords(c)
    	{
    		$('#x').val(c.x);
    		$('#y').val(c.y);
    		$('#w').val(c.w);
    		$('#h').val(c.h);
    	};

    	function checkCoords()
    	{
    		if (parseInt($('#w').val())) return true;
    		alert('Por favor selecciona una región y luego presiona Guardar.');
    		return false;
    	};

    </script>
    </body>
</html>
