CREATE OR REPLACE FUNCTION

producto_en_tienda(idproducto int, idtienda int)

RETURNS integer AS $$

BEGIN

IF idproducto IN (select distinct productos.id from productos, stock, tienda where productos.id = stock.id_producto and tienda.id = stock.id_tienda and tienda.id = idtienda) THEN
    RETURN 1;

ELSE
    RETURN 0;

END IF;


END;




$$ language plpgsql