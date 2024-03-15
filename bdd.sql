

CREATE TABLE `utilisateurs` (
  `idUtilisateur` int NOT NULL,
  `nomUtilisateur` varchar(50) NOT NULL,
  `prenomUtilisateur` varchar(50) NOT NULL,
  `pseudoUtilisateur` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `mdpUtilisateur` varchar(50) NOT NULL,
  `roleUtilisateur` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateurs`
--


-- UTILISATEURS
INSERT INTO `utilisateurs` (`nomUtilisateur`, `prenomUtilisateur`, `pseudoUtilisateur`, `mdpUtilisateur`, `roleUtilisateur`) VALUES
('Tarten', 'Pion', 'tartenpion', '123456', 1),
('Nemar', 'Jean', 'jeannemar', '123456', 2),
('Position', 'Paul', 'paulposition', '123456', 2),
('Terrieur', 'Alex', 'alexterrieur', '123456', 2),
('Iron', 'Man', 'ironman', '123456', 3),
('Spider', 'Man', 'spiderman', '123456', 3),
('Arrya', 'Stark', 'arryastark', '123456', 3);


-- CLIENTS
INSERT INTO `client`(`nomClient`, `prenomClient`, `codePostalClient`, `villeClient`) VALUES 
('Troijour','Adam','69000','Lyon'),
('Hénette','Claire','13000','Marseille'),
('Stourne','Henri','75000','Paris');


-- ARTICLE
INSERT INTO `article`(`libelleArticle`, `garantieArticle`, `qteStockPrincipal`, `qteStockSAV`, `qteStockRebus`) VALUES 
('Portail','10','5','0','0'),
('Portillon','2','5','1','0'),
('Grillage','1','20','2','2');

-- KIT
INSERT INTO `kit`(`nomKit`) VALUES 
('Portail et Portillon'),
('Grillage et Portillon');

-- CREATION DES KITS
INSERT INTO `composer`(`codeArticle`, `codeKit`) VALUES 
('1','1'),
('2','1'),
('2','2'),
('3','2');