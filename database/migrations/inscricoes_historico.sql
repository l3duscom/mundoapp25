-- Migration: Criar tabela inscricoes_historico
-- Data: 2024-12-29
-- Descrição: Tabela para armazenar histórico de edições de inscrições em concursos

CREATE TABLE IF NOT EXISTS inscricoes_historico (
    id INT PRIMARY KEY AUTO_INCREMENT,
    inscricao_id INT NOT NULL,
    user_id INT NOT NULL,
    dados_anteriores JSON NOT NULL COMMENT 'Snapshot completo dos dados antes da edição',
    dados_novos JSON NOT NULL COMMENT 'Snapshot completo dos dados após a edição',
    campos_alterados TEXT COMMENT 'Lista dos campos que foram alterados',
    ip_address VARCHAR(45),
    user_agent VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (inscricao_id) REFERENCES inscricoes(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES usuarios(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Índices para performance
CREATE INDEX idx_inscricoes_historico_inscricao ON inscricoes_historico(inscricao_id);
CREATE INDEX idx_inscricoes_historico_user ON inscricoes_historico(user_id);
CREATE INDEX idx_inscricoes_historico_created ON inscricoes_historico(created_at);
