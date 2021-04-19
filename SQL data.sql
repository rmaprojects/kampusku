CREATE TABLE tbl_jurusan(
    id_jurusan VARCHAR(60) PRIMARY KEY,
    jurusan TEXT
);
CREATE TABLE tbl_kelas id_kelas VARCHAR(60),
    kelas TEXT,
    id_guru VARCHAR(60),
    PRIMARY K(id_kelas, id_guru),
    FOREIGN KEY (id_guru) REFERENCES tbl_guru (id_guru)
);
CREATE TABLE tbl_guru(
    id_guru VARCHAR(60) PRIMARY KEY,
    nama_guru TEXT,
    nip TEXT
);
CREATE TABLE tbl_siswa(
    nis VARCHAR(60),
    nama_siswa TEXT,
    jenis_kelamin TEXT,
    alamat TEXT,
    nomor_telp TEXT,
    email TEXT,
    tanggal_terdaftar TIMESTAMP,
    PRIMARY KEY (nis)
);
CREATE TABLE tbl_datasiswa(
    id_datasiswa INT(11) id_kelas VARCHAR(60),
    nis VARCHAR(60),
    id_jurusan VARCHAR(60),
    tanggal_tambah VARCHAR(60),
    PRIMARY KEY (id_datasis id_kelas, nis, id_jurusan, tanggal_tambah),
    FOREIGN K(id_kelas) REFERENCES tbl_kel(id_kelas), 
    FOREIGN KEY (nis) REFERENCES tbl_siswa (nis), 
    FOREIGN KEY (id_jurusan) REFERENCES tbl_jurusan (id_jurusan)
);

INSERT INTO tbl_jurusan(id_jurusan, jurusan)
VALUES ("2","RPL");

INSERT INTO tbl_kel(id_kelas, kelas, id_guru)
VALUES ("3", "XI", 3);

INSERT INTO tbl_guru (id_guru, nama_guru, nip)
VALUES ("3", "Bapak Suhu", "023456789");

INSERT INTO tbl_siswa (nis, nama_siswa, jenis_kelamin, alamat, nomor_telp, email)
VALUES 
("120934", "Kanso", "Laki-Laki", "UBW", "000", "kanso@wakanda.forever"),
("123451", "Bakuya", "Laki-Laki", "UBW", "000", "Bakuya@wakanda.forever"),
("657483", "Mamang", "Laki-Laki", "Gerobak", "0888kapankapankitakedufan", "mamangjualan@pedagang.com"),
("432178", "Bakso", "Undefined", "Tungku Panci", "0888kapankapankitakejamban", "makanbakso@dikuali.com"),
("101010", "Laptop", "Undefined", "Lemari", "000", "laptopian@gmail.com"),
("839198", "Mouse", "Laki-Laki", "Mousepad", "111","mousebang@gmail.com"),
("876543", "Masker", "Undefined", "Muka", "23456", "maskmaster@face.com"),
("280531", "Charger", "Undefined", "Tas Laptop", "777", "charegeme@asus.com"),
("309995", "Headset", "Undefined", "Kepala", "5678", "ihavenoemail@nobody.com"),
("214444", "Jam", "Laki-Laki", "Tangan", "7654", "siomai5@xiaomi.com"),
("131672", "Tas", "Undefined", "Punggung", "34352", "asus@tas.com"),
("257940", "Enkidu", "Genderless", "Mesopotamia", "23646", "enkidu@chaldea.org"),
("322060", "Air Conditioner", "Undefined", "Tembok", "24645", "AC@contact.com"),
("321897", "Sarungman", "Laki-Laki", "Celana", "876", "wadimor@inisarungkita.com"),
("331898", "Sapu", "Undefined", "Samping tempat sampah", "215", "sapumamang@bersihbersih.com"),
("209519", "Malkist", "Undefined", "Perut pemakannya", "236423", "malkist_roma@enak.com");

INSERT INTO tbl_datasiswa (id_kelas, nis, id_jurusan)
VALUES 
("1", "120934", "1"),
("1", "123451", "1"),
("1", "657483", "2"),
("1", "432178", "2"),
("1", "101010", "1"),
("2", "839198", "2"),
("2", "280531", "2"),
("2", "309995", "1"),
("2", "214444", "1"),
("2", "131672", "1"),
("3", "257940", "2"),
("3", "322060", "1"),
("3", "321897", "2"),
("3", "331898", "1"),
("3", "209519", "2");





