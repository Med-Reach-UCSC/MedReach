INSERT INTO DELIVERY (pharmacy_id, dropoff_address, cod_amount)
SELECT pharmacy_id, a.addr, a.amt
FROM PHARMACY p,
  (SELECT '12 Galle Road, Colombo 03' addr, 1850.00 amt
   UNION ALL SELECT '7 Duplication Road, Colombo 04', 920.50
   UNION ALL SELECT '44 Havelock Road, Colombo 05', 3200.00) a
WHERE p.licence_no = 'PH-2024-0192';
