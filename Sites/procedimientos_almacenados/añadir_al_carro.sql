CREATE OR REPLACE FUNCTION

añadir(idproducto int, nompro varchar(250), idtienda int, nomtienda varchar(250), ccantidad int, precio int)

RETURNS void AS $$


BEGIN

IF NOT EXISTS (SELECT * from carrito where id_producto = idproducto and cantidad = ccantidad) THEN
INSERT INTO carrito VALUES(idproducto, nompro, idtienda, nomtienda, ccantidad, precio);

END IF;



END;



$$ language plpgsql