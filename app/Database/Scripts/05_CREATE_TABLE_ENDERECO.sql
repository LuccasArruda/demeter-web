CREATE TABLE ENDERECO (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    RUA VARCHAR(100) NOT NULL,
    NUMERO VARCHAR(10) NOT NULL,
    ID_BAIRRO INT NOT NULL
);

ALTER TABLE ENDERECO ADD FOREIGN KEY (ID_BAIRRO) REFERENCES BAIRRO(ID);