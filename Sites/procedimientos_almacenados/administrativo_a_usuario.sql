CREATE OR REPLACE FUNCTION

mover_administrativos_dblink()

RETURNS void AS $$


DECLARE 
idmax int;
idmax2 int;
iddirec int;
idadmin int;
tupla_adm RECORD ;

BEGIN
    FOR tupla_adm IN (SELECT * FROM
    public.dblink('dbname=grupo24e3
    port=5432
    password=familiaperez24
    user=grupo24', 'select distinct personal.id, personal.rut, personal.nombre, personal.sexo, personal.edad, direcciones.nombre_direccion, direcciones.comuna, direcciones.id from personal, unidades, direcciones where (personal.clasificacion = ''administracion'' OR personal.clasificacion = ''ti'' OR personal.clasificacion = ''asistente de aseo'' OR personal.clasificacion = ''vendedor'') and unidades.id = personal.unidad and direcciones.id = unidades.direccion')
    as f(id int, rut varchar, nombre varchar, sexo varchar, edad int, direccion varchar, comuna varchar, id_direccion int))

    LOOP

        SELECT INTO idmax
        MAX(usuario.id)
        FROM usuario;

        SELECT INTO idmax2
        MAX(direcciones_e3.id)
        FROM direcciones_e3;
        
        IF NOT EXISTS (select usuario.rut from usuario where usuario.rut = tupla_adm.rut) THEN
            INSERT INTO Usuario VALUES(idmax + 1, tupla_adm.nombre, tupla_adm.rut, tupla_adm.edad, tupla_adm.sexo);

            IF NOT EXISTS (select direcciones_e3.nombre from direcciones_e3 where direcciones_e3.nombre = tupla_adm.direccion) THEN
                INSERT INTO Direcciones_e3 VALUES(idmax2 + 1, tupla_adm.direccion, tupla_adm.comuna);
            END IF;

            SELECT INTO iddirec
            direcciones_e3.id FROM direcciones_e3 WHERE direcciones_e3.nombre = tupla_adm.direccion;

            SELECT INTO idadmin
            usuario.id FROM usuario WHERE usuario.rut = tupla_adm.rut;


            INSERT INTO Residencia VALUES(idadmin, iddirec);

        END IF;


    END LOOP;


END
$$ language plpgsql