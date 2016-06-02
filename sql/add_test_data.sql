-- USR Testidata
INSERT INTO Usr (name, password) VALUES ('Nico', 'Roos');


-- Category testidata
INSERT INTO Category (name, Usr_id, added, content) VALUES ('TestiCategory', 1, NOW(), 'Purjopore Mökkimakkara');


-- Topic testidata
INSERT INTO Topic (name, Usr_id, Category_id, content, added) VALUES ('TestiTopic', 1, 1, 'Nautitaan Kylmänä', NOW());  

-- Reply testidata
INSERT INTO Reply (Usr_id, added, Topic_id, content) VALUES (1, NOW(), 1, 'Serveras väl kyld'); 
