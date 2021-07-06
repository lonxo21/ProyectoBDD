CREATE OR REPLACE FUNCTION

create_password()

RETURNS void AS $$


BEGIN

UPDATE usuario SET usuario.password = 'soygenerico123';


END



$$ language plpgsql