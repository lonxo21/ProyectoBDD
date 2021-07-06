CREATE OR REPLACE FUNCTION

create_password()

RETURNS void AS $$


BEGIN

UPDATE usuario SET password = 'gen12345';


END



$$ language plpgsql