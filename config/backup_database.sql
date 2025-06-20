--
-- Arquivo gerado com SQLiteStudio v3.4.4 em sáb jun 29 18:38:12 2024
--
-- Codificação de texto usada: System
--
PRAGMA foreign_keys = off;
BEGIN TRANSACTION;

-- Tabela: transacoes
CREATE TABLE IF NOT EXISTS transacoes (id_transacao integer PRIMARY KEY AUTOINCREMENT, categoria text NOT NULL, tipo text CHECK (tipo IN ('entrada', 'saida')), valor real NOT NULL, dia date, semana date NOT NULL, mes date, ano date, ano_mes_dia date, descricao text, usuario integer, FOREIGN KEY (usuario) REFERENCES usuarios (id_usuario));
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (2, 'Gastos fixos', 'entrada', 400.0, NULL, 23, NULL, NULL, NULL, 'Passagem', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (3, 'Gastos fixos', 'entrada', 400.0, NULL, 24, NULL, 2024, '2024-JunJun-Wed', 'Passagem', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (4, 'Gastos fixos', 'entrada', 400.0, 'th', 23, NULL, 2024, '24-06-05', 'Passagem', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (5, 'Gastos fixos', 'entrada', 7600.0, 'th', 23, 6, 2024, '2024-06-05', 'TV', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (6, 'Gastos fixos', 'saida', 7600.0, 'th', 23, 6, 2024, '2024-06-06', 'TV', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (7, 'Gastos variaveis', 'entrada', 10000.0, 'th', 23, 6, 2024, '2024-06-06', 'Tenis', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (8, '', 'entrada', 45.0, 'th', 23, 6, 2024, '2024-06-08', 'TV', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (9, '', 'entrada', 45.0, 'th', 23, 6, 2024, '2024-06-08', 'Passagem', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (10, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (11, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (12, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (13, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (14, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (15, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (16, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (17, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (18, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (19, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (20, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (21, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (22, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (23, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (24, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (25, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (26, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (27, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (28, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (29, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (30, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (31, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (32, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (33, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (34, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (35, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (36, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (37, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (38, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (39, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (40, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (41, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (42, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (43, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (44, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (45, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (46, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (47, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (48, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (49, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (50, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (51, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (52, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (53, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (54, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (55, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (56, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (57, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (58, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (59, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (60, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (61, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (62, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (63, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (64, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (65, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (66, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (67, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (68, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (69, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (70, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (71, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (72, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (73, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (74, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (75, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);
INSERT INTO transacoes (id_transacao, categoria, tipo, valor, dia, semana, mes, ano, ano_mes_dia, descricao, usuario) VALUES (76, 'Gastos variaveis', 'saida', 14000.0, 14, 24, 6, 2024, '2024-06-14', 'Casaco', 1);

-- Tabela: usuarios
CREATE TABLE IF NOT EXISTS usuarios(
id_usuario integer PRIMARY KEY AUTOINCREMENT,
nome text NOT NULL,
email text UNIQUE NOT NULL,
senha text NOT NULL
);
INSERT INTO usuarios (id_usuario, nome, email, senha) VALUES (1, 'João Mesquita', 'joaob.mesquita@gmailcom', '432100');
INSERT INTO usuarios (id_usuario, nome, email, senha) VALUES (2, 'Euclides', 'euclides@gmail.com', '1234');

COMMIT TRANSACTION;
PRAGMA foreign_keys = on;
