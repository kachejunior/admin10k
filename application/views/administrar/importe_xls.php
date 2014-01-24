<table id="tabla" class="table table-hover table-bordered table-striped" >
		<thead>
			<tr style="background:#802c59; color: #FFF ">
				<th>Cedula</th>
				<th>Nombre y Apellido</th>
				<th>F. Nacimiento</th>
				<th>Sexo</th>
				<th>Evento</th>
				<th>Categoria</th>
				<th>Validado</th>	
				<th>Correo</th>	
				<th>Telefono</th>	
				
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($atletas as $row)
			{
				$str = '<tr style="text-transform: uppercase">'.
					'<td class="centrado">'.$row->cedula.'</td>'.
					'<td>'.ucwords(strtolower($row->nombre)).' '.ucwords(strtolower($row->apellido)).'</td>'.	
					'<td class="centrado">'.$row->fecha_nacimiento.'</td>'.
					'<td class="centrado">'.$row->sexo.'</td>'.
					'<td class="centrado">'.$row->evento_nombre.'</td>'.		
					'<td class="centrado">'.$row->categoria_nombre.'</td>'.
					'<td class="centrado">'.$row->validado.'</td>'.	
					'<td class="centrado">'.$row->correo.'</td>'.	
					'<td class="centrado">'.$row->telefono.'</td>'.	
					'</tr>';
				echo $str;
			}
			?>
		</tbody>
	</table>


<?php 
	header("Content-type: application/vnd-ms-excel; charset=iso-8859-1");
	header("Content-Disposition: attachment; filename=Atletas10k5k_".date('d-m-Y').".xls");
?>