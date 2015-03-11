/*----- 1 -----*/
SELECT * FROM hotel

/*----- 2 ------*/
SELECT nafn, email FROM notendur
ORDER BY 'nafn'

/*----- 3 -----*/
SELECT tegund, nott FROM tegund
WHERE nott <12000
ORDER BY 'nott'

/*----- 4 -----*/
SELECT * FROM bokanir
WHERE 'bless' IS NULL

/*----- 5 -----*/
SELECT * FROM hotel
GROUP BY('nafn')

/*----- 6 -----*/
SELECT AVG(nott) FROM tegund

/*----- 7 -----*/ Eyþór gerð þú þetta
Hvað eru "Double Rooms"?

/*----- 8 -----*/
SELECT notendur.nafn, bokanir.hallo, bokanir.bless FROM notendur
JOIN bokanir ON notendur.ID = bokanir.notandiID
WHERE bokanir.hallo LIKE '%-08-%' OR bokanir.bless LIKE '%-08-%'

/*----- 9 -----*/
SELECT tegund.tegund, tegund.nott
FROM hotel
INNER JOIN herbergi ON hotel.ID = herbergi.hotelID
INNER JOIN tegund ON herbergi.tegundID = tegund.ID
WHERE hotelID = 5
/*----- 10 -----*/
SELECT * FROM notendur
WHERE notendur.ID =
(SELECT notandiID FROM bokanir
WHERE hallo <= CURRENT_DATE AND bless >= CURRENT_DATE AND
hotelID = 5);
/*----- 11 -----*/

/*----- 12 -----*/
SELECT DISTINCT herbergiID
FROM bokanir
WHERE herbergiID NOT IN
(SELECT herbergiID
FROM bokanir
WHERE hallo <= CURRENT_DATE AND bless >= CURRENT_DATE)
AND hotelID = 7;
/*----- 13 -----*/

/*----- 14 -----*/
SELECT hotelID, count(ID)
FROM herbergi
GROUP BY hotelID
/*----- 15 -----*/
SELECT hotelID, count(ID)
FROM herbergi
GROUP BY hotelID

