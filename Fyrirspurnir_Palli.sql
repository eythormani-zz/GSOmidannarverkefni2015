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

/*----- 8 -----*/
SELECT notendur.nafn, bokanir.hallo, bokanir.bless FROM notendur
JOIN bokanir ON notendur.ID = bokanir.notandiID
WHERE bokanir.hallo LIKE '%-08-%' OR bokanir.bless LIKE '%-08-%'