DROP DATABASE punto_venta;
CREATE DATABASE punto_venta;
USE punto_venta;

CREATE TABLE tipo_negocio(
  id_tipo INT NOT NULL AUTO_INCREMENT,
  tipo VARCHAR(255) NOT NULL,
  PRIMARY KEY (id_tipo)
);
CREATE TABLE negocio(
  id_negocio INT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(255) NOT NULL,
  telefono VARCHAR(15) NOT NULL,
  correo VARCHAR(255) NOT NULL,
  logo VARCHAR(255) NOT NULL,
  id_tipo INT NOT NULL,
  CONSTRAINT FOREIGN KEY (id_tipo) REFERENCES tipo_negocio(id_tipo),
  PRIMARY KEY (id_negocio)
);

CREATE TABLE datos_fiscales(
  id_datos INT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(255) NOT NULL,
  rfc VARCHAR(20) NOT NULL,
  rFiscal VARCHAR(255) NOT NULL,
  id_negocio INT NOT NULL,
  CONSTRAINT FOREIGN KEY (id_negocio) REFERENCES negocio(id_negocio),
  PRIMARY KEY (id_datos)
);

CREATE TABLE sucursal(
  id_sucursal INT NOT NULL AUTO_INCREMENT,
  estado VARCHAR(255) NOT NULL,
  ciudad VARCHAR(2550) NOT NULL,
  colonia VARCHAR(255) NOT NULL,
  direccion VARCHAR(255) NOT NULL,
  codigo_postal INT NOT NULL,
  telefono VARCHAR(15) NOT NULL,
  correo VARCHAR(255) NOT NULL,
  id_negocio INT NOT NULL,
  PRIMARY KEY (id_sucursal),
  CONSTRAINT FOREIGN KEY (id_negocio) REFERENCES negocio(id_negocio)
);
CREATE TABLE administrador(
  id_admin INT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(255) NOT NULL,
  pass VARCHAR(255) NOT NULL,
  correo VARCHAR(255) NULL,
  telefono VARCHAR(15) NULL,
  id_negocio INT NOT NULL,
  PRIMARY KEY (id_admin),
  CONSTRAINT FOREIGN KEY (id_negocio) REFERENCES negocio(id_negocio)
);
CREATE TABLE cliente(
  id_cliente INT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(255) NOT NULL,
  direccion VARCHAR(255) NOT NULL,
  telefono VARCHAR(15) NULL,
  id_sucursal INT NULL,
  PRIMARY KEY(id_cliente),
  CONSTRAINT FOREIGN KEY (id_sucursal) REFERENCES sucursal(id_sucursal)
);
CREATE TABLE caja(
  id_caja INT NOT NULL AUTO_INCREMENT,
  caja VARCHAR(255) NOT NULL,
  total INT NOT NULL,
  PRIMARY KEY (id_caja)
);
CREATE TABLE rol(
    id_rol INT NOT NULL AUTO_INCREMENT,
    rol VARCHAR(255) NOT NULL,
    PRIMARY KEY (id_rol)
);

CREATE TABLE personal(
  id_personal INT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(255) NOT NULL,
  pass VARCHAR(255) NOT NULL,
  correo VARCHAR(255) NULL,
  telefono VARCHAR(15) NULL,
  ciudad VARCHAR(255) NULL,
  domicilio VARCHAR(255) NULL,
  id_sucursal INT NOT NULL,
  id_caja INT NULL,
  id_rol INT NOT NULL,
  PRIMARY KEY (id_personal),
  CONSTRAINT FOREIGN KEY (id_sucursal) REFERENCES sucursal(id_sucursal),
  CONSTRAINT FOREIGN KEY (id_caja) REFERENCES caja(id_caja),
  CONSTRAINT FOREIGN KEY (id_rol) REFERENCES rol(id_rol)
);

CREATE TABLE proveedor(
    id_proveedor INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    telefono VARCHAR(15) NOT NULL,
    correo VARCHAR(255) NOT NULL,
    contacto VARCHAR(255) NOT NULL,
    cargo VARCHAR(255) NOT NULL,
    PRIMARY KEY (id_proveedor)
);

CREATE TABLE unidad(
    id_unidad INT NOT NULL AUTO_INCREMENT,
    unidad VARCHAR(100) NOT NULL,
    descripcion VARCHAR(255) NOT NULL,
    PRIMARY KEY (id_unidad)
);
CREATE TABLE producto(
    id_producto INT NOT NULL AUTO_INCREMENT,
    codigo VARCHAR(255) NULL,
    nombre VARCHAR(255) NOT NULL,
    cantidad VARCHAR(255) NOT NULL,
    pcompra VARCHAR(255) NOT NULL,
    pventa VARCHAR(255) NOT NULL,
    id_unidad INT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT  FOREIGN KEY (id_unidad) REFERENCES unidad(id_unidad),
    PRIMARY KEY (id_producto)
);

CREATE TABLE venta_producto(
  id_venta INT NOT NULL  AUTO_INCREMENT,
  id_sucursal INT NOT NULL,
  id_personal INT NOT NULL,
  id_producto INT NOT NULL,
  cantidad INT NOT NULL,
  total INT NOT NULL,
  fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT FOREIGN KEY (id_sucursal) REFERENCES sucursal(id_sucursal),
  CONSTRAINT FOREIGN KEY (id_personal) REFERENCES personal(id_personal),
  CONSTRAINT FOREIGN KEY (id_producto) REFERENCES producto(id_producto),
  PRIMARY KEY (id_venta)
);
CREATE TABLE compra_producto(
  id_compra INT NOT NULL AUTO_INCREMENT,
  id_sucursal INT NOT NULL,
  id_producto INT NOT NULL,
  cantidad INT NOT NULL,
  total INT NOT NULL,
  fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT  FOREIGN KEY (id_sucursal) REFERENCES sucursal(id_sucursal),
  CONSTRAINT  FOREIGN KEY (id_producto) REFERENCES producto(id_producto),
  PRIMARY KEY (id_compra)
);

INSERT INTO tipo_negocio(tipo) VALUES ('Tienditas'),('Abarrotes'),('Papelerías'), ('Zapaterías');
INSERT INTO caja(caja, total) VALUES (01,10000), (02,5000), (03,20000);
INSERT INTO rol(rol) VALUES ('Gerente'),('Ventas');
