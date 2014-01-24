CREATE TABLE grupos_usuarios
(
  id serial NOT NULL,
  nombre character varying(100) NOT NULL,
  CONSTRAINT grupos_usuarios_pk PRIMARY KEY (id )
);

CREATE TABLE sedes
(
  id serial NOT NULL,
  nombre character varying(100) NOT NULL,
  CONSTRAINT sedes_pk PRIMARY KEY (id )
);

CREATE TABLE status_usuarios
(
  id serial NOT NULL,
  nombre character varying(100) NOT NULL,
  CONSTRAINT status_usuarios_pk PRIMARY KEY (id )
);

CREATE TABLE usuarios
(
  cedula character varying(15) NOT NULL,
  nombre character varying(60) NOT NULL,
  apellido character varying(60) NOT NULL,
  telefono character varying(15),
  correo character varying(255),
  grupo_usuario integer,
  status_usuario integer,
  sede integer,
  clave character varying(255),
  CONSTRAINT usuarios_pk PRIMARY KEY (cedula ),
  CONSTRAINT usuarios_grupo_fk FOREIGN KEY (grupo_usuario)
      REFERENCES grupos_usuarios (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT usuarios_sede_fk FOREIGN KEY (sede)
      REFERENCES sedes (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT usuarios_status_fk FOREIGN KEY (status_usuario)
      REFERENCES status_usuarios (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)