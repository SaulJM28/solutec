create database solutec;

create table empleados(
    id_emp int(4) primary key auto_increment not null,
    nom varchar(50) not null,
    ap1 varchar(50) not null,
    ap2 varchar(50) not null,
    correo varchar(100) not null,
    fecha_nac date,
    id_are int(4)
);


create table areas(
    id_are int(4) primary key auto_increment not null,
    nom_are varchar(50) not null,
    num_emp int(4) not null,
);

CREATE TRIGGER aumento_empleados_trigger
AFTER INSERT ON empleados
FOR EACH ROW
BEGIN
    -- Actualizar el número de empleados en el área correspondiente
    UPDATE areas
    SET num_emp = num_emp + 1
    WHERE id_are = NEW.id_are;
END;


DELIMITER //

CREATE TRIGGER actualizar_areas_trigger
AFTER UPDATE ON empleados
FOR EACH ROW
BEGIN
    -- Verificar si el área ha sido modificada
    IF NEW.id_are <> OLD.id_are THEN
        -- Eliminar al empleado de la antigua área
        UPDATE areas
        SET num_emp = num_emp - 1
        WHERE id_are = OLD.id_are;

        -- Agregar al empleado a la nueva área
        UPDATE areas
        SET num_emp = num_emp + 1
        WHERE id_are = NEW.id_are;
    END IF;
END //

DELIMITER ;
