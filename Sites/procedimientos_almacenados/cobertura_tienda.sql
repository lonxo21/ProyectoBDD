CREATE OR REPLACE FUNCTION

cobertura_tienda(idusuario int, idtienda int)

RETURNS integer AS $$

BEGIN

IF idtienda IN (select distinct tienda.id from tienda, usuario, despacha, comuna, residencia, direcciones_e3 where tienda.id = idtienda and usuario.id = idusuario and despacha.id_tienda = idtienda and comuna.id = despacha.id_comuna and direcciones_e3.comuna = comuna.nombre and residencia.id_usuario = idusuario and direcciones_e3.id = residencia.id_direccion) THEN
    RETURN 1;

ELSE
    RETURN 0;

END IF;


END;


$$ language plpgsql