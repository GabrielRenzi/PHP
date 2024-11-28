-- Tabela de Avaliações
CREATE TABLE avaliacao (
    avaliacao_id SERIAL PRIMARY KEY,
    setor_id INTEGER NOT NULL REFERENCES setor(setor_id),
    pergunta_id INTEGER NOT NULL REFERENCES pergunta(pergunta_id),
    dispositivo_id INTEGER NOT NULL REFERENCES dispositivo(dispositivo_id),
    resposta INTEGER NOT NULL CHECK (resposta BETWEEN 0 AND 10),
    feedback_textual TEXT,
    data_hora_avaliacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL
);

-- Tabela de Dispositivos
CREATE TABLE dispositivo (
    dispositivo_id SERIAL PRIMARY KEY,
    nome_dispositivo VARCHAR(255) NOT NULL,
    status VARCHAR(10) CHECK (status IN ('ativo', 'inativo'))
);

-- Tabela de Perguntas
CREATE TABLE pergunta (
    pergunta_id SERIAL PRIMARY KEY,
    texto_pergunta TEXT NOT NULL,
    status VARCHAR(10) CHECK (status IN ('ativa', 'inativa'))
);

-- Tabela de Usuários Administrativos
CREATE TABLE usuario_administrativo (
    usuario_id SERIAL PRIMARY KEY,
    login VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

CREATE TABLE setor (
    setor_id SERIAL PRIMARY KEY,      
    nome_setor VARCHAR(100) NOT NULL,
    descricao TEXT,               
    data_criacao TIMESTAMP DEFAULT NOW()
);
