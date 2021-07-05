CREATE OR REPLACE FUNCTION

mover_administrativos_dblink()

RETURNS void AS $$


DECLARE 
idmax int;
idmax2 int;
tupla_adm RECORD ;

BEGIN

    SELECT INTO idmax
    MAX(usuario.id)
    FROM usuario;

    SELECT INTO idmax2
    MAX(direccion.id)
    FROM direccion;

END

BEGIN
    FOR tupla_adm IN (SELECT * FROM
    public.dblink('dbname=grupo24e3
    port=5432
    password=familiaperez24
    user=grupo24', 'select distinct personal.id, personal.rut, personal.nombre, personal.sexo, personal.edad, unidades.direccion, direcciones.comuna from personal, unidades, direcciones where personal.clasificacion = ''administracion'' and unidades.id = personal.unidad and direcciones.id = unidades.direccion')
    as f(id int, rut varchar, nombre varchar, sexo varchar, edad int, direccion varchar, comuna varchar))

    LOOP
        IF NOT EXISTS (select usuario.rut from usuario where usuario.rut = tupla_adm.rut)
        BEGIN
            INSERT INTO Usuario VALUES(idmax + 1, tupla_adm.nombre, tupla_adm.rut, tupla_adm.edad, tupla_adm.sexo);
            IF NOT EXISTS (select direccion.nombre from direccion where direccion.nombre = tupla_adm.direccion)
            BEGIN
                INSERT INTO Direccion VALUES(idmax2 + 1, direccion, comuna);
                SET @counter = @counter + 1
            END
        END 


    END LOOP;


END
$$ language plpgsql