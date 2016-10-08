-- Electronics
INSERT INTO store_chain (store_chain_pk, name, img_url) VALUES (10000,'Mediamarkt','mediamarkt.png');
INSERT INTO store_chain VALUES (10001,'BCC');

-- Sports/recreation/play
INSERT INTO store_chain VALUES (11000,'Intersport');
INSERT INTO store_chain VALUES (11001,'Run2Day');
INSERT INTO store_chain VALUES (11002,'Runnersworld');
INSERT INTO store_chain VALUES (11003,'Intertoys');

-- building
INSERT INTO store_chain VALUES (12000,'Gamma');
INSERT INTO store_chain VALUES (12001,'Karwij');

-- wooninrichting/keukens etc.
INSERT INTO store_chain (store_chain_pk, name, img_url) VALUES (13000,'Ikea', 'ikea.png');
INSERT INTO store_chain VALUES (13001,'Carpetland');
INSERT INTO store_chain VALUES (13002,'Keuken Kampioen');


INSERT INTO store (store_chain_fk, address, zip_code, city) VALUES (10000, 'Het Plein 130', '7559', 'Hengelo');
INSERT INTO store (store_chain_fk, address, zip_code, city) VALUES (10000, 'Boulevard 1', null, 'Enschede');


INSERT INTO ocr_task_status VALUES (1, 'queued');
INSERT INTO ocr_task_status VALUES (2, 'pending');
INSERT INTO ocr_task_status VALUES (3, 'finished');
INSERT INTO ocr_task_status VALUES (4, 'cancelled');
INSERT INTO ocr_task_status VALUES (5, 'failed');
