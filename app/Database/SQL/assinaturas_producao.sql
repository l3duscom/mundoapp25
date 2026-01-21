-- =====================================================
-- SQL PARA PRODUÇÃO - SISTEMA DE ASSINATURAS PREMIUM
-- Execute na ordem apresentada
-- =====================================================

-- =====================================================
-- 1. ADICIONAR CAMPOS PREMIUM NA TABELA USUARIOS
-- =====================================================
ALTER TABLE `usuarios` 
ADD COLUMN `is_premium` TINYINT(1) NOT NULL DEFAULT 0 AFTER `pontos`,
ADD COLUMN `premium_ate` DATETIME NULL AFTER `is_premium`,
ADD COLUMN `asaas_subscription_id` VARCHAR(100) NULL AFTER `premium_ate`;

CREATE INDEX idx_usuarios_premium ON usuarios(is_premium, premium_ate);


-- =====================================================
-- 2. CRIAR TABELA PLANOS
-- =====================================================
CREATE TABLE `planos` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(100) NOT NULL,
    `slug` VARCHAR(100) NOT NULL,
    `descricao` TEXT NULL,
    `preco` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    `ciclo` ENUM('MONTHLY', 'YEARLY') NOT NULL DEFAULT 'MONTHLY',
    `beneficios` TEXT NULL COMMENT 'JSON com lista de benefícios',
    `ativo` TINYINT(1) NOT NULL DEFAULT 1,
    `created_at` DATETIME NULL,
    `updated_at` DATETIME NULL,
    `deleted_at` DATETIME NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- =====================================================
-- 3. CRIAR TABELA ASSINATURAS
-- =====================================================
CREATE TABLE `assinaturas` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `usuario_id` INT(11) UNSIGNED NOT NULL,
    `plano_id` INT(11) UNSIGNED NOT NULL,
    `asaas_subscription_id` VARCHAR(100) NULL,
    `asaas_customer_id` VARCHAR(100) NULL,
    `status` ENUM('PENDING', 'ACTIVE', 'OVERDUE', 'CANCELLED', 'EXPIRED') NOT NULL DEFAULT 'PENDING',
    `data_inicio` DATETIME NULL,
    `data_fim` DATETIME NULL,
    `proximo_vencimento` DATE NULL,
    `valor_pago` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    `forma_pagamento` VARCHAR(50) NULL,
    `created_at` DATETIME NULL,
    `updated_at` DATETIME NULL,
    `deleted_at` DATETIME NULL,
    PRIMARY KEY (`id`),
    KEY `usuario_id` (`usuario_id`),
    KEY `plano_id` (`plano_id`),
    KEY `status` (`status`),
    KEY `asaas_subscription_id` (`asaas_subscription_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- =====================================================
-- 4. CRIAR TABELA ASSINATURA_HISTORICOS
-- =====================================================
CREATE TABLE `assinatura_historicos` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `assinatura_id` INT(11) UNSIGNED NOT NULL,
    `evento` ENUM('CREATED', 'PAYMENT_CONFIRMED', 'PAYMENT_FAILED', 'RENEWED', 'CANCELLED', 'EXPIRED', 'REACTIVATED') NOT NULL DEFAULT 'CREATED',
    `descricao` VARCHAR(255) NULL,
    `dados_json` TEXT NULL COMMENT 'Dados adicionais em JSON',
    `created_at` DATETIME NULL,
    PRIMARY KEY (`id`),
    KEY `assinatura_id` (`assinatura_id`),
    KEY `evento` (`evento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- =====================================================
-- 5. INSERIR PLANO PREMIUM INICIAL
-- =====================================================
INSERT INTO `planos` (`nome`, `slug`, `descricao`, `preco`, `ciclo`, `beneficios`, `ativo`, `created_at`) VALUES
('Premium', 'premium', 'Acesso completo a todos os recursos premium da plataforma', 29.90, 'MONTHLY', 
'["Acesso antecipado a ingressos","Descontos exclusivos","Sem taxa de conveniência","Suporte prioritário","Cashback em compras"]', 
1, NOW());

-- Plano anual com desconto (opcional)
INSERT INTO `planos` (`nome`, `slug`, `descricao`, `preco`, `ciclo`, `beneficios`, `ativo`, `created_at`) VALUES
('Premium Anual', 'premium-anual', 'Acesso completo por 1 ano com desconto de 20%', 287.00, 'YEARLY', 
'["Acesso antecipado a ingressos","Descontos exclusivos","Sem taxa de conveniência","Suporte prioritário","Cashback em compras","Economia de 20%"]', 
1, NOW());


-- =====================================================
-- 6. CRIAR TABELA RESGATES_PREMIUM (Ingresso Gratuito)
-- =====================================================
-- Controla os ingressos gratuitos resgatados por usuários premium
-- 1 ingresso grátis (comum ou cosplay) por evento ativo

CREATE TABLE `resgates_premium` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `usuario_id` INT(11) UNSIGNED NOT NULL,
    `evento_id` INT(11) UNSIGNED NOT NULL,
    `ticket_id` INT(11) UNSIGNED NOT NULL,
    `ingresso_id` INT(11) UNSIGNED NOT NULL,
    `created_at` DATETIME NULL,
    `updated_at` DATETIME NULL,
    PRIMARY KEY (`id`),
    KEY `idx_usuario_id` (`usuario_id`),
    KEY `idx_evento_id` (`evento_id`),
    UNIQUE KEY `uk_usuario_evento` (`usuario_id`, `evento_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

