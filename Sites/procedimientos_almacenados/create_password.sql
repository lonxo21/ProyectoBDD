CREATE OR REPLACE FUNCTION

create_password()

RETURNS void AS $$


BEGIN

UPDATE usuario SET password = 'soygenerico123';


END



$$ language plpgsql