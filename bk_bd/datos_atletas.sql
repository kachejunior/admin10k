CREATE OR REPLACE VIEW datos_atletas AS 
 SELECT a.id, a.cedula, a.nombre, a.apellido, a.sexo, a.fecha_nacimiento, a.direccion, a.telefono, a.correo, a.clave, a.grupo_sanguineo, a.evento, a.categoria, a.validado, a.fh_registro, b.nombre AS grupo_sanguineo_nombre, c.nombre AS evento_nombre, d.nombre AS categoria_nombre
   FROM atletas a
   JOIN grupo_sanguineo b ON a.grupo_sanguineo = b.id
   JOIN eventos c ON a.evento = c.id
   JOIN categorias d ON a.evento = d.evento AND a.categoria = d.id;
