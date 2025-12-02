

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";




CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `descricao` varchar(30) NOT NULL,
  `ativo` enum('S','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `categoria` (`id`, `descricao`, `ativo`) VALUES
(4, 'Trator', 'S'),
(8, 'Colheitadeira', 'S');



CREATE TABLE `produto` (
  `id` int(11) NOT NULL,
  `nome` varchar(250) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `valor` double NOT NULL,
  `destaque` enum('S','N') NOT NULL,
  `ativo` enum('S','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `produto` (`id`, `nome`, `categoria_id`, `descricao`, `imagem`, `valor`, `destaque`, `ativo`) VALUES
(2, 'Abacate Verde', 8, '<p>O abacate é um fruto comestível do abacateiro, nativo do México e América do Sul, conhecido por sua polpa macia e saborosa. É um alimento rico em nutrientes, incluindo gorduras saudáveis, vitaminas, minerais e antioxidantes. Apesar de seu alto teor calórico, o abacate oferece diversos benefícios à saúde e pode ser incluído em uma dieta equilibrada</p>', 'f80dbefb2d52aede7c8e4479585fd79c1753992228.jpg', 9.5, 'S', 'S');



CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(200) NOT NULL,
  `telefone` varchar(25) NOT NULL,
  `ativo` enum('S','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `telefone`, `ativo`) VALUES
(1, 'Marcos Junior', 'markosjr@gmail.com', '$2y$10$vlKXwI9l1H42YtnKDrph0uXpV8TrtCKCyWOurwoMibSt.GsRg05qK', '(44) 99999-9999', 'S'),
(2, 'Teste', 'teste@gmail.com', '$2y$10$vlKXwI9l1H42YtnKDrph0uXpV8TrtCKCyWOurwoMibSt.GsRg05qK', '(44) 99999-1234', 'S');





ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categoria` (`descricao`);



ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`);



ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);


ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;


ALTER TABLE `produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

