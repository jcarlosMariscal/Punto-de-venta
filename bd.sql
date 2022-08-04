DROP DATABASE punto_venta;
CREATE DATABASE punto_venta;
USE punto_venta;

CREATE TABLE roles(
    id_rol INT NOT NULL AUTO_INCREMENT,
    rol VARCHAR(255) NOT NULL,
    PRIMARY KEY (id_rol)
);

CREATE TABLE caja(
  id_caja INT NOT NULL AUTO_INCREMENT,
  caja VARCHAR(255) NOT NULL,
  total INT NOT NULL,
  PRIMARY KEY (id_caja)
);

CREATE TABLE usuarios(
    id_user INT AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    pass VARCHAR(255) NOT NULL,
    correo VARCHAR(255) NULL,
    telefono VARCHAR(15) NULL,
    id_caja INT NULL,
    id_rol INT NULL,
    CONSTRAINT  FOREIGN KEY (id_caja) REFERENCES caja(id_caja),
    CONSTRAINT  FOREIGN KEY (id_rol) REFERENCES roles(id_rol),
    PRIMARY KEY (id_user)

);

CREATE TABLE proveedor(
    id INT NOT NULL AUTO_INCREMENT,
    identificador VARCHAR(255) NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    factura VARCHAR(255) NOT NULL,
    telefono VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);


CREATE TABLE configuracion(
    id INT AUTO_INCREMENT,
    razon_social VARCHAR(255) NOT NULL,
    rfc VARCHAR(255) NOT NULL,
    domicilio VARCHAR(255) NOT NULL,
    cpostal VARCHAR(255) NOT NULL,
    telefono VARCHAR(255) NOT NULL,
    imagen VARCHAR(255),
    PRIMARY KEY (id)
);
CREATE TABLE productos(
    id INT AUTO_INCREMENT,
    codigo VARCHAR(255) NOT NULL,
    producto VARCHAR(255) NOT NULL,
    cantidad VARCHAR(255) NOT NULL,
    pcompra VARCHAR(255) NOT NULL,
    pventa VARCHAR(255) NOT NULL,
    id_proveedor INT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT  FOREIGN KEY (id_proveedor) REFERENCES proveedor(id),
    PRIMARY KEY (id)
);

CREATE TABLE ventas(
  id_venta INT AUTO_INCREMENT,
  id_producto INT NOT NULL,
  id_user INT NOT NULL,
  cantidad INT NOT NULL,
  CONSTRAINT  FOREIGN KEY (id_producto) REFERENCES productos(id),
  CONSTRAINT  FOREIGN KEY (id_user) REFERENCES usuarios(id_user),
  PRIMARY KEY (id_venta)
);


INSERT INTO caja(caja, total) VALUES (01,10000), (02,5000), (03,20000);
INSERT INTO roles(rol) VALUES ('Administrador'),('Vendedor');
INSERT INTO configuracion(razon_social, rfc, domicilio, cpostal, telefono, imagen) VALUES ('Tech', 'JUMM420313PA9', 'Av. Lopez Mateos #587 Playa ensenada', '25758', '2582582582', 'icono.png');