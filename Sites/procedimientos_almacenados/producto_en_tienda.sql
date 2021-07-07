CREATE OR REPLACE FUNCTION

producto_en_tienda(idproducto int, idtienda int)

RETURNS integer AS $$

BEGIN

IF EXISTS (select productos.id from productos, stock, tienda where productos.id = stock.id_producto and tienda.id = sotck.id_tienda) THEN
    RETURN 1;

ELSE
    RETURN 0;

END IF;


END;



$$ language plpgsql