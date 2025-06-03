CREATE VIEW VIEW_APARELHOS AS
	SELECT 'A' TIPO,
            ID,	
            DESCRICAO,	
            CONSUMO,	
            FABRICANTE,	
            TEMPO_DE_USO,	
            ENCE,	
            MODELO,
            NULL ENERGIA_GERADA,
            ID_REDE_ELETRICA FROM APARELHO
    UNION
    SELECT TIPO,
           ID,
           DESCRICAO,
           NULL CONSUMO,
           NULL FABRICANTE,
           NULL TEMPO_DE_USO,
           NULL ENCE,
           NULL MODELO,
           ENERGIA_GERADA,
           ID_REDE_ELETRICA 
      FROM GERADOR
END;