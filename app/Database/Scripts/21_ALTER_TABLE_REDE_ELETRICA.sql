ALTER TABLE REDE_ELETRICA
ADD COLUMN TOTAL_APARELHOS INTEGER DEFAULT 0 AFTER PERCENTUAL_SUSTENTABILIDADE,
ADD COLUMN GASTO_TOTAL FLOAT(6,2) DEFAULT 0 AFTER TOTAL_APARELHOS,
ADD COLUMN GASTO_ABATIDO FLOAT(6,2) DEFAULT 0 AFTER GASTO_TOTAL;