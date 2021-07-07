CREATE OR REPLACE FUNCTION

create_password(contra varchar(15))

RETURNS void AS $$


BEGIN

UPDATE usuario SET contraseña = contra;


END



$$ language plpgsql