<?php
// recuperamos los values de los inputs y definimos las constantes
	if(isset($_POST['enviar'])){
		$errores = '';	
		define("PRECIO_NOCHE",60);	
		define("PRECIO_COCHE",40);
	}	
		// echo PRECIO_NOCHE;
	try {
		
		$numNoches = $_POST['noches'];
		$vuelo = $_POST['ciudad'];
		$numCoche = $_POST['coche'];
		if (!is_numeric($numNoches)|| $numNoches<=0)  {
			$errores .= "Noches debe ser numérico y mayor que 0";#
		}
		
		if (!empty($errores)) { //que hace exactamente?
			throw new Exception($errores);			
		}		
		if ($vuelo=='') {
			$errores .= "Debe seleccionar un destino";#			
		}		
		switch ($vuelo) {
			case "Madrid":
				$vuelo = 150;
				break;
			case "Paris":
				$vuelo = 250;
				break;
			case "Los Angeles":
				$vuelo = 450;
				break;
				case "Roma":
				$vuelo = 200;
					break;
		}
		if (!empty($errores)) {
			throw new Exception($errores);			
		}
		if (!is_numeric($numCoche)|| $numCoche<=2)  {
			$alquiler = $numCoche;
		}		
		if ($numCoche>=3) {
			$alquiler =((float)$numCoche * 0.80) * PRECIO_COCHE;
        }
		if ($numCoche>=7){
			$alquiler = ($numCoche * PRECIO_COCHE)-50;
		}
		
	echo $alquiler;
		
			
		$total=calcularPrecio($numNoches,$vuelo,$alquiler);				
	
	
		if (!empty($errores)) {
			throw new Exception($errores);			
		}		
		
	} catch (Exception $e) {
		$mensajes =$e ->getMessage();
			
	}	
	  function calcularPrecio($noches,$vuelo, $coche) {            
		return (PRECIO_NOCHE * $noches) +$coche + $vuelo;  
	   }
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>PLA02</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>
<body>
	<main>
		<h1 class='centrar'>PLA02: COSTE HOTEL</h1>
		<br>
		<form method="post" action="#">
			<div class="row mb-3">
			    <label for="noches" class="col-sm-3 col-form-label">Número de noches:</label>
			    <div class="col-sm-9">
			      <input type="number" class="form-control" name="noches" id="noches">
			    </div>
			</div>
			<div class="row mb-3">
			    <label for="ciudad" class="col-sm-3 col-form-label">Destino:</label>
			    <div class="col-sm-9">
					<select class="form-select" name='ciudad'>
					  	<option selected value=''>Selecciona un destino</option>
					  	<option>Madrid</option>
						<option>Paris</option>
						<option>Los Angeles</option>
						<option>Roma</option>
					</select>
				</div>
			</div>
			<div class="row mb-3">
			    <label for="coche" class="col-sm-3 col
				-form-label">Días alquiler coche:</label>
			    <div class="col-sm-9">
			      <input type="number" class="form-control" name="coche" id="coche">
			    </div>
			</div>
			<label class="col-sm-3 col-form-label"></label>
		  	<button type="submit" class="btn btn-primary" name='enviar'>Enviar datos</button>
			  <label class="col-sm-3 col-form-label"></label>
		  	<button type="submit" class="btn btn-danger" name='limpiar'>limpiar datos</button>
		  	<br><br>
		  	<div class="row mb-3">
			    <label class="col-sm-3 col-form-label">Coste total: </label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control" name="total" id="total" disabled value="<?php echo $total ??null;?>">
			    </div>
			</div><br>
			<span class='errores'><?php echo $mensajes ??null; ?></span>
		</form>
	</main>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>