<?php

// Obtenermos TODOS los usuarios(ID y Nombre) ademas incluir si ya lo estamos siguiendo o no
$usuarios = $me->getAll()

?>


<table class="table table-bordered">
	<thead>
		<tr>
			<th>Usuario</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($usuarios as $val)
			{
				$seguir = ($val->seguidor == 1) ? "btn btn-danger" : "btn btn-primary";
				$seguir2 = ($val->seguidor == 1) ? "Dejar de Seguir" : "Seguir";
				$boton = '<button class="'.$seguir.'" id="'.$val->IDUsuario.'">'.$seguir2.'</button>';
				?>
				<tr>
					<td>
						<?=$val->Nombre?>
					</td>
					<td>
						<?=$boton?>
					</td>
				</tr>
				<?php
			}
		?>
	</tbody>
</table>
<p>&nbsp;</p>
<center>
	<button type="button" class="btn btn-large btn-warning" id="salir">Salir</button>
</center>

<div class="modal"></div>

<script type="text/javascript">
$("table tbody tr td button").on('click', function (event){
	var alerta = $("body");
	var me = $(this);
	var id = me.attr('id');
	var texto = me.text();
	alerta.addClass('loading');

	$.post('./send.php', { id: id }, function (data){
		if(data == 'done')
		{
			if(texto == 'Seguir')
			{				
				me.text('Dejar de Seguir');
				me.removeClass('btn-primary').addClass('btn-danger');
			}else{
				me.text('Seguir');
				me.removeClass('btn-danger').addClass('btn-primary');
			}
			alerta.removeClass('loading');
		}
	});

	return false;
});
$("#salir").on('click', function (event){
	$.get('./salir.php', {}, function (data){
		window.location = './';
	});
});
</script>