USE praktikum_web_2401020076;

INSERT INTO program_studi (nama_prodi) VALUES
    ('Teknik Perkapalan'),
    ('Teknik Kelautan');

INSERT INTO mahasiswa
    (nim, nama, email, usia, program_studi_id)
VALUES
    ('2401010001', 'Rina Wulandari',
     'rina@contoh.ac.id', 20, 1),
    ('2401010002', 'Dimas Prakoso',
     'dimas@contoh.ac.id', 21, 1),
    ('2401020001', 'Maya Anggraini',
     'maya@contoh.ac.id', 19, 2),
    ('2401020099', 'Data Sementara',
     'temp@contoh.ac.id', 18, 2);

UPDATE mahasiswa
SET email = 'rina.wulandari@contoh.ac.id'
WHERE nim = '2401010001';

DELETE FROM mahasiswa
WHERE nim = '2401020099';

SELECT m.nim, m.nama, m.email, m.usia,
       p.nama_prodi
FROM mahasiswa AS m
JOIN program_studi AS p
    ON p.id = m.program_studi_id
ORDER BY m.nim;