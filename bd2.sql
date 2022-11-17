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
  nombre VARCHAR(255) NOT NULL,
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
  direccion VARCHAR(255) NULL,
  telefono VARCHAR(15) NULL,
  id_sucursal INT NULL,
  PRIMARY KEY(id_cliente),
  CONSTRAINT FOREIGN KEY (id_sucursal) REFERENCES sucursal(id_sucursal)
);
CREATE TABLE caja(
  id_caja INT NOT NULL AUTO_INCREMENT,
  caja VARCHAR(255) NOT NULL,
  base INT NOT NULL,
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
    telefono VARCHAR(15) NULL,
    correo VARCHAR(255) NULL,
    contacto VARCHAR(255) NULL,
    cargo VARCHAR(255) NULL,
    PRIMARY KEY (id_proveedor)
);

CREATE TABLE unidad(
    id_unidad INT NOT NULL AUTO_INCREMENT,
    unidad VARCHAR(100) NOT NULL,
    descripcion VARCHAR(255) NOT NULL,
    PRIMARY KEY (id_unidad)
);
CREATE TABLE categoria(
  id_categoria INT NOT NULL AUTO_INCREMENT,
  categoria VARCHAR(100) NOT NULL,
  descripcion VARCHAR(255) NULL,
  PRIMARY KEY (id_categoria)
);
CREATE TABLE producto(
    id_producto INT NOT NULL AUTO_INCREMENT,
    codigo VARCHAR(255) NULL,
    nombre VARCHAR(255) NOT NULL,
    cantidad VARCHAR(255) NOT NULL,
    pcompra VARCHAR(255) NOT NULL,
    pventa VARCHAR(255) NOT NULL,
    id_unidad INT NOT NULL,
    id_categoria INT NOT NULL,
    CONSTRAINT  FOREIGN KEY (id_unidad) REFERENCES unidad(id_unidad),
    CONSTRAINT  FOREIGN KEY (id_categoria) REFERENCES categoria(id_categoria),
    PRIMARY KEY (id_producto)
);

CREATE TABLE venta_producto(
  id_venta INT NOT NULL  AUTO_INCREMENT,
  id_sucursal INT NOT NULL,
  id_personal INT NOT NULL,
  id_producto VARCHAR(500) NOT NULL,
  id_cliente INT NOT NULL,
  total INT NOT NULL,
  efectivo INT NOT NULL,
  cambio INT NOT NULL,
  detalles TEXT NOT NULL,
  fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente),
  CONSTRAINT FOREIGN KEY (id_sucursal) REFERENCES sucursal(id_sucursal),
  CONSTRAINT FOREIGN KEY (id_personal) REFERENCES personal(id_personal),
  PRIMARY KEY (id_venta)
);
CREATE TABLE compra_producto(
  id_compra INT NOT NULL AUTO_INCREMENT,
  id_sucursal INT NOT NULL,
  id_proveedor VARCHAR(500) NOT NULL,
  productos VARCHAR(500) NOT NULL,
  detalles TEXT NOT NULL,
  total INT NOT NULL,
  fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT  FOREIGN KEY (id_sucursal) REFERENCES sucursal(id_sucursal),
  PRIMARY KEY (id_compra)
);

INSERT INTO tipo_negocio(tipo) VALUES ('Tienditas'),('Abarrotes'),('Papelerías'), ('Zapaterías');
INSERT INTO caja(caja, base, total) VALUES (01,2000, 2000), (02,1000,1000), (03,3000,3000);
INSERT INTO rol(rol) VALUES ('Gerente'),('Ventas');
INSERT INTO unidad(unidad, descripcion) VALUES ('Kilogramo', "Un kilogramo"),('Tara', "30 Kilogramos");
INSERT INTO proveedor(nombre) VALUES ('Proveedor en general');
INSERT INTO cliente(nombre) VALUES ('Cliente en general');
INSERT INTO categoria(categoria) VALUES ('Productos enlatados'), ('Botanas'), ('Bebidas'), ('Dulces');

-- Para agilizar el desarrollo xd: La contraseña es 12345
INSERT INTO negocio(nombre, telefono, correo, logo, id_tipo) VALUES("Nova Tech", "1234567890", "prueba@gmail.com", "logo.png", 1);
INSERT INTO sucursal(nombre, estado, ciudad, colonia, direccion, codigo_postal, telefono, correo, id_negocio) VALUES("Tienda grande", "Puebla", "Tehuacan", "Centro", "20 Sur", "12345", "9876543210", "gd@gmail.com", 1);
INSERT INTO sucursal(nombre, estado, ciudad, colonia, direccion, codigo_postal, telefono, correo, id_negocio) VALUES("Tienda mediana", "Veracruz", "Orizaba", "Centro", "10 Sur", "54321", "0123456789", "md@gmail.com", 1);
INSERT INTO administrador(nombre, pass, correo, telefono, id_negocio) VALUES("User", "$2y$10$gcB4Xy7.7C5L4d0FLHojJeKxVZM2q0ozqgvpB64WJT74l8pdOUFJG", "name@gmail.com", "5461237890", 1);
