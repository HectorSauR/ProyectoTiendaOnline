CREATE VIEW INFO_COTIZACION AS 
	SELECT
	    cot.ID_COTIZACION AS COTIZACION,
	    p.ID_PRODUCTO AS ID,
	    p.NOMBRE AS NOMBRE,
	    cot.PRECIO_VENTA AS PRECIO,
	    cot.CANTIDAD AS CANTIDAD
	FROM detalle_cotizacion as cot
	    INNER JOIN productos AS p on p.ID_PRODUCTO = cot.ID_PRODUCTO
	WHERE cot.ID_COTIZACION = 40
; 

DROP VIEW CONSULTA_VENTA;

CREATE VIEW CONSULTA_VENTA AS 
	SELECT
	    venta.ID_VENTA,
	    usuario.NOMBRE,
	    venta.ID_FORMA_PAGO,
	    venta.FECHA,
	    estatus.DESCRIPCION,
	    SUM(
	        detalle_venta.PRECIO * detalle_venta.CANTIDAD
	    ) AS Total_Venta
	FROM venta
	    INNER JOIN detalle_venta ON venta.ID_VENTA = detalle_venta.ID_VENTA
		INNER JOIN usuario on venta.ID_USUARIO = usuario.ID_USUARIO
		INNER JOIN estatus on venta.ID_ESTATUS = estatus.ID_ESTATUS
	GROUP BY venta.ID_VENTA
	ORDER BY venta.ID_VENTA
DESC; 

SELECT * FROM CONSULTA_VENTA;