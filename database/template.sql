CREATE TABLE `login_data` (
  `id` varchar(7) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`),
  UNIQUE KEY `email` (`email`)
)

CREATE TABLE `user_data` (
  `id` varchar(7) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `idade` int(3) NOT NULL,
  `hobby` varchar(255) NOT NULL,
  `cargo` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `user_data_ibfk_1` FOREIGN KEY (`id`) REFERENCES `login_data` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
)