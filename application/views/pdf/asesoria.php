<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
		<link href="<?php echo base_url();?>media/css/pdf.css" rel="stylesheet" media="all">
	</head>
	<body>
		<p style="text-align: center; line-height:150%;"><b>DEFENSORIA DEL NIÑO NIÑA Y ADOLESCENTE<br>ASESORIA</b></p>

<!--		<table class="datos_solicitud">
			<tr>
				<th colspan="3" class="titulo_tabla">DATOS DE LA ASESORIA</th>
			</tr>
			<tr>
				<th class="fecha">FECHA</th>
				<th class="defensoria">DEFENSORIA</th>
				<th class="defensor">DEFENSOR</th>
			</tr>
			<tr>
				<td class="centrado"><?php //echo date('d-m-Y',  strtotime($asesoria->fecha)); ?></td>
				<td class="centrado"><?php //echo strtoupper($asesoria->sede_nombre); ?></td>
				<td class="centrado"><?php //echo strtoupper($asesoria->defensor_nombre); ?></td>
			</tr>
		</table>-->

		<table class="datos_solicitante">
			<tr>
				<th colspan="3" class="titulo_tabla">DATOS DEL USUARIO</th>
			</tr>
			<tr>
				<th class="cedula">CEDULA</th>
				<th class="nombre">NOMBRE Y APELLIDO</th>
				<th class="sexo">SEXO</th>
			</tr>
			<tr>
				<td class="centrado"><?php echo ucfirst($asesoria->cedula); ?></td>
				<td class="centrado"><?php echo strtoupper($asesoria->nombre).' '.strtoupper($asesoria->apellido); ?></td>
				<td class="centrado"><?php echo strtoupper($asesoria->sexo_nombre); ?></td>
			</tr>
		</table>

		<table class="datos_solicitante" style="border-top:0px;">
			<tr style="border-top:0px;">
				<th style="border-top:0px;" colspan="2">DIRECCION</th>
			</tr>
			<tr>
				<td colspan="2"><?php echo strtoupper($asesoria->direccion); ?></td>
			</tr>
			<tr style="border-top:0px;">
				<th style="border-top:0px;" class="municipio">MUNICIPIO</th>
				<th style="border-top:0px;" class="parroquia">PARROQUIA</th>
			</tr>
			<tr>
				<td class="centrado"><?php echo strtoupper($asesoria->municipio_nombre); ?></td>
				<td class="centrado"><?php echo strtoupper($asesoria->parroquia_nombre); ?></td>
			</tr>
			<tr style="border-top:0px;">
				<th style="border-top:0px;">PROFESION U OFICIO</th>
				<th style="border-top:0px;">TELEFONO</th>
			</tr>
			<tr>
				<td class="centrado"><?php echo strtoupper($asesoria->profesion); ?></td>
				<td class="centrado"><?php echo $asesoria->telefono1.' '.$asesoria->telefono2; ?></td>
			</tr>
		</table>
		
		<table class="datos_solicitud" style="margin-top: 20px;">
			<tr>
				<th colspan="4" class="titulo_tabla">DATOS DE LOS AFECTADOS</th>
			</tr>
			<tr>
				<th class="nombre2">NOMBRE Y APELLIDO</th>
				<th class="edad">EDAD</th>
				<th class="sexo2">SEXO</th>
				<th class="relacion">RELACION CON EL DENUNCIANTE</th>
			</tr>
				<?php
			foreach ($afectados as $row)
			{
				$str = '<tr>'.
					'<td class="centrado">'.strtoupper($row->nombre).'</td>'.
					'<td class="centrado">'.$row->edad.'</td>'.
					'<td class="centrado">'.strtoupper($row->sexo_nombre).'</td>'.
					'<td class="centrado">'.strtoupper($row->relacion_nombre).'</td>'.
					'</tr>';
				echo $str;
			}
			?>
		</table>
		
		<table class="datos_solicitud" style="margin-top: 20px;">
			<tr>
				<th class="titulo_tabla">HECHOS QUE SE INFORMAN (RESUMEN)</th>
			</tr>
			<tr>
				<td class="direccion"><?php echo strtoupper(str_replace("\n", '<br>',$asesoria->hechos_informados)); ?></td>
			</tr>
			<tr>
				<th class="titulo_tabla">ACCION INMEDIATA</th>
			</tr>
			<tr>
				<td class="direccion"><?php echo strtoupper(str_replace("\n", '<br>',$asesoria->accion_inmediata)); ?></td>
			</tr>
		</table>

		<table class="firmas" style="margin-top: 40px; border:0px;">
			<tr>
				<td class="centrado">___________________________</td>
				<td class="centrado">___________________________</td>
			</tr>
			<tr>
				<td class="municipio centrado">FIRMA DEL DEFENSOR</td>
				<td class="municipio centrado">FIRMA DEL USUARIO</td>
			</tr>
			<tr>
				<td class="centrado">C.I. <?php echo strtoupper($asesoria->defensor); ?></td>
				<td class="centrado">C.I. <?php echo strtoupper($asesoria->cedula); ?></td>
			</tr>
		</table>

	</body>
</html>