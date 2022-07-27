DROP DATABASE punto_venta;
CREATE DATABASE punto_venta;
USE punto_venta;

CREATE TABLE roles(
    id_rol INT NOT NULL AUTO_INCREMENT,
    rol VARCHAR(255) NOT NULL,
    PRIMARY KEY (id_rol)
);

CREATE TABLE usuarios(
    id_user INT AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    pass VARCHAR(255) NOT NULL,
    correo VARCHAR(255) NULL,
    telefono VARCHAR(15) NULL,
    id_rol INT NULL,
    CONSTRAINT  FOREIGN KEY (id_rol) REFERENCES roles(id_rol),
    PRIMARY KEY (id_user)

);

CREATE TABLE proveedor(
    id INT AUTO_INCREMENT,
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
CREATE TABLE compras(
    id INT AUTO_INCREMENT,
    nombre_prov VARCHAR(255) NOT NULL,
    producto_prov VARCHAR(255) NOT NULL,
    cantidad_prov VARCHAR(255) NOT NULL,
    pcompra_prov VARCHAR(255) NOT NULL,
    pventa_prov VARCHAR(255) NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);



INSERT INTO roles(rol) VALUES ('Administrador'),('Vendedor');
INSERT INTO configuracion(razon_social, rfc, domicilio, cpostal, telefono, imagen) VALUES ('Tech', 'VECJ88032685', 'Av. Lopez Mateos #587 Playa ensenada', '25758', '2582582582', 'icono.png');