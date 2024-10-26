CREATE TABLE perguntas (
    id SERIAL PRIMARY KEY,
    pergunta TEXT NOT NULL
);

CREATE TABLE respostas (
    id SERIAL PRIMARY KEY,
    pergunta_id INT REFERENCES perguntas(id) ON DELETE CASCADE,
    nota INT NOT NULL CHECK (nota BETWEEN 0 AND 10),
    comentario TEXT,
    data_resposta TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


INSERT INTO perguntas (pergunta) VALUES
('Como você avalia o atendimento da recepção?'),
('O ambiente estava limpo e organizado?'),
('A equipe médica atendeu suas necessidades de forma satisfatória?'),
('A comunicação com a equipe foi clara e eficiente?'),
('Você recomendaria nosso hospital para outras pessoas?');



