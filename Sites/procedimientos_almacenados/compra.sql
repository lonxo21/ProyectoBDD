CREATE OR REPLACE FUNCTION

compra(idusuario int, iddireccion int, idtienda int, idproducto int, cantidad int)

RETURNS void AS $$

DECLARE
idmaxcompra int;





BEGIN

SELECT INTO idmaxcompra
    MAX(compras.id)
    FROM compras;


INSERT INTO compras VALUES(idmaxcompra + 1, idusuario, iddireccion, idtienda);
INSERT INTO boleta VALUES(idmaxcompra + 1, idproducto, cantidad);



END;



$$ language plpgsql