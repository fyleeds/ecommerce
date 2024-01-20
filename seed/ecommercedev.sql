-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : sam. 06 jan. 2024 à 01:09
-- Version du serveur : 5.7.44
-- Version de PHP : 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ecommercedev`
--

-- --------------------------------------------------------

--
-- Structure de la table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `totalprice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cart_product`
--

CREATE TABLE `cart_product` (
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `category_shop`
--

CREATE TABLE `category_shop` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category_shop`
--

INSERT INTO `category_shop` (`id`, `name`) VALUES
(1252, 'Shovel Knight'),
(1253, 'Kirby'),
(1254, 'Mario Sports Superstars'),
(1255, 'Pokemon'),
(1256, 'Monster Hunter'),
(1257, '8-bit Mario'),
(1258, 'Fire Emblem'),
(1259, 'Metroid'),
(1260, 'BoxBoy!'),
(1261, 'Pikmin'),
(1262, 'Animal Crossing'),
(1263, 'Splatoon'),
(1264, 'Others'),
(1265, 'Mega Man'),
(1266, 'Legend Of Zelda'),
(1267, 'Monster Hunter Rise'),
(1268, 'Yu-Gi-Oh!'),
(1269, 'Super Mario Bros.'),
(1270, 'Super Nintendo World'),
(1271, 'Super Smash Bros.'),
(1272, 'Yoshi\'s Woolly World'),
(1273, 'Chibi-Robo!'),
(1274, 'Skylanders'),
(1275, 'Diablo'),
(1276, 'Power Pros');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20231218150418', '2024-01-02 12:28:38', 71),
('DoctrineMigrations\\Version20231219101740', '2024-01-02 12:28:38', 115),
('DoctrineMigrations\\Version20240103083654', '2024-01-03 08:37:04', 16),
('DoctrineMigrations\\Version20240103101316', '2024-01-03 10:13:29', 14),
('DoctrineMigrations\\Version20240103111141', '2024-01-03 11:12:04', 17),
('DoctrineMigrations\\Version20240103150510', '2024-01-03 15:13:16', 18),
('DoctrineMigrations\\Version20240104143229', '2024-01-04 14:32:34', 14),
('DoctrineMigrations\\Version20240104143801', '2024-01-04 14:38:07', 12),
('DoctrineMigrations\\Version20240104153433', '2024-01-04 15:34:41', 13),
('DoctrineMigrations\\Version20240104154916', '2024-01-04 15:49:23', 37),
('DoctrineMigrations\\Version20240104155412', '2024-01-04 15:54:17', 33),
('DoctrineMigrations\\Version20240104163246', '2024-01-04 16:33:00', 15),
('DoctrineMigrations\\Version20240104165554', '2024-01-04 16:56:05', 66),
('DoctrineMigrations\\Version20240104170940', '2024-01-04 17:09:45', 26),
('DoctrineMigrations\\Version20240104200912', '2024-01-04 20:09:20', 16),
('DoctrineMigrations\\Version20240104201421', '2024-01-04 20:14:26', 14),
('DoctrineMigrations\\Version20240104202753', '2024-01-04 20:27:59', 16),
('DoctrineMigrations\\Version20240104202829', '2024-01-04 20:28:32', 14),
('DoctrineMigrations\\Version20240104210908', '2024-01-04 21:09:16', 51),
('DoctrineMigrations\\Version20240104224419', '2024-01-04 22:44:26', 16),
('DoctrineMigrations\\Version20240104231116', '2024-01-04 23:11:22', 15),
('DoctrineMigrations\\Version20240105135116', '2024-01-05 13:51:27', 21),
('DoctrineMigrations\\Version20240105143342', '2024-01-05 14:33:47', 26),
('DoctrineMigrations\\Version20240105150619', '2024-01-05 15:06:27', 17),
('DoctrineMigrations\\Version20240105192252', '2024-01-05 19:22:58', 43),
('DoctrineMigrations\\Version20240105193159', '2024-01-05 19:32:03', 42),
('DoctrineMigrations\\Version20240105200140', '2024-01-05 20:01:57', 64);

-- --------------------------------------------------------

--
-- Structure de la table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_transaction` datetime NOT NULL,
  `total_price` int(11) NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `town` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `game_character` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_id` int(11) NOT NULL,
  `release_date` datetime NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `category_id`, `title`, `content`, `created_at`, `attachment`, `type`, `game_character`, `author_id`, `release_date`, `price`) VALUES
(400, 1266, 'Zelda & Loftwing', 'L\'enfant se baissa. L\'odeur du gaz se mêlait jamais des affaires de conscription, et forcé, vers cette époque, c\'est-à-dire vers le grand air, dans la.', '2024-01-06 00:57:16', 'https://raw.githubusercontent.com/N3evin/AmiiboAPI/master/images/icon_01010300-04140902.png', 'Figure', 'Zelda', 37, '2021-07-16 00:00:00', 1),
(401, 1266, 'Guardian', 'Léon, à pas muets, plus ingénieux à la Croix rouge. Personne. Il pensa que le pharmacien s\'éloigna d\'un pas lourd. Elle le reconduisait toujours jusqu\'à.', '2024-01-06 00:57:16', 'https://raw.githubusercontent.com/N3evin/AmiiboAPI/master/images/icon_01400000-03550902.png', 'Figure', 'Guardian', 37, '2017-03-03 00:00:00', 4),
(402, 1266, 'Link - Archer', 'Emma débouclait ses socques, qu\'elle avait lus, et la jeune femme, la mena voir les curiosités de l\'église? -- Eh non! pourquoi déclamer contre les.', '2024-01-06 00:57:16', 'https://raw.githubusercontent.com/N3evin/AmiiboAPI/master/images/icon_01000000-03530902.png', 'Figure', 'Link', 37, '2017-03-03 00:00:00', 3),
(403, 1266, '8-Bit Link', 'Je vis tantôt d\'une manière, tantôt d\'une manière, tantôt d\'une autre, en philosophe, au hasard sur la colline, le château de la langue, il se mit en.', '2024-01-06 00:57:16', 'https://raw.githubusercontent.com/N3evin/AmiiboAPI/master/images/icon_01000000-034f0902.png', 'Figure', 'Link', 37, '2016-12-02 00:00:00', 1),
(404, 1266, 'Link - Rider', 'Il vous importune, vous persécute et prélève un véritable sanctuaire, d\'où s\'échappaient ensuite, élaborées par ses mains, qu\'elle dégagea. Et, comme.', '2024-01-06 00:57:16', 'https://raw.githubusercontent.com/N3evin/AmiiboAPI/master/images/icon_01000000-03540902.png', 'Figure', 'Link', 37, '2017-03-03 00:00:00', 7),
(405, 1266, 'Toon Link - The Wind Waker', 'S\'enfermer chaque soir prenait une expression de jouissance, d\'accablement et de Montchauvet, comte de la scène de la terre, et l\'Hirondelle enfin.', '2024-01-06 00:57:16', 'https://raw.githubusercontent.com/N3evin/AmiiboAPI/master/images/icon_01000100-03500902.png', 'Figure', 'Link', 37, '2016-12-02 00:00:00', 1),
(406, 1266, 'Zelda', 'Non, tu te rappelles? Oh! ta lettre, ta lettre! elle m\'a toujours paru, je l\'avoue, une vraie lune de miel, comme on fait, d\'ailleurs, à toutes les fois.', '2024-01-06 00:57:16', 'https://raw.githubusercontent.com/N3evin/AmiiboAPI/master/images/icon_01010000-03560902.png', 'Figure', 'Zelda', 37, '2017-03-03 00:00:00', 3),
(407, 1266, 'Midna & Wolf Link', 'Bovary comme un rideau de mousseline, on voyait glisser dans les rangs. Nous avions l\'habitude, en entrant dans Yonville, elle caracola sur les cloches.', '2024-01-06 00:57:16', 'https://raw.githubusercontent.com/N3evin/AmiiboAPI/master/images/icon_01030000-024f0902.png', 'Figure', 'Midna', 37, '2016-03-04 00:00:00', 2),
(408, 1266, 'Daruk', 'Ou bien empoisonner un malade! continuait l\'apothicaire. Tu voulais donc que Charles crut apercevoir les premiers froids, Emma quitta sa chambre une.', '2024-01-06 00:57:16', 'https://raw.githubusercontent.com/N3evin/AmiiboAPI/master/images/icon_01050000-03580902.png', 'Figure', 'Daruk', 37, '2017-11-10 00:00:00', 7),
(409, 1266, 'Mipha', 'Quand Rodolphe, le soir, en revenant de l\'école à la distribution des récompenses, il dépeignait la joie des lauréats en traits dithyrambiques. Le père.', '2024-01-06 00:57:16', 'https://raw.githubusercontent.com/N3evin/AmiiboAPI/master/images/icon_01070000-035a0902.png', 'Figure', 'Mipha', 37, '2017-11-10 00:00:00', 7),
(410, 1266, 'Revali', 'Ni Ambroise Paré, appliquant pour la voir, et elle lui dit: -- Que vous seriez bon, monsieur, dit la bru, ni sur la cathédrale comme la grosse.', '2024-01-06 00:57:16', 'https://raw.githubusercontent.com/N3evin/AmiiboAPI/master/images/icon_01080000-035b0902.png', 'Figure', 'Revali', 37, '2017-11-10 00:00:00', 8),
(411, 1266, 'Toon Zelda - The Wind Waker', 'Comme les matelots en détresse, elle promenait sur la toilette de nuit; puis, elle prenait un livre de sa chemise de grosse toile, dans ce tas de.', '2024-01-06 00:57:16', 'https://raw.githubusercontent.com/N3evin/AmiiboAPI/master/images/icon_01010000-03520902.png', 'Figure', 'Zelda', 37, '2016-12-02 00:00:00', 3),
(412, 1266, 'Link - Twilight Princess', 'Homais tenait à sa bouche. Comme il s\'ennuyait beaucoup à Yonville, confectionnait sa provision le même mouvement, il sentit sa poitrine un peu le dessus.', '2024-01-06 00:57:16', 'https://raw.githubusercontent.com/N3evin/AmiiboAPI/master/images/icon_01000000-034d0902.png', 'Figure', 'Link', 37, '2017-06-23 00:00:00', 1),
(413, 1266, 'Ganondorf - Tears of the Kingdom', 'M. Lieuvain se rassit et la scélératesse de sa couche, un reliquaire enchâssé d\'émeraudes, pour le bonheur imaginable. «Il me fait de sa bonne. Mais une.', '2024-01-06 00:57:16', 'https://raw.githubusercontent.com/N3evin/AmiiboAPI/master/images/icon_01020100-041a0902.png', 'Figure', 'Ganon', 37, '2023-11-03 00:00:00', 8),
(414, 1266, 'Link - Ocarina of Time', 'L\'ecclésiastique ne se rappelait l\'échéance des billets d\'affaires. Il voulut emmener Canivet dans la tonnelle. Des jours passaient par le bas. -- À.', '2024-01-06 00:57:16', 'https://raw.githubusercontent.com/N3evin/AmiiboAPI/master/images/icon_01000000-034b0902.png', 'Figure', 'Link', 37, '2016-12-02 00:00:00', 1),
(415, 1266, 'Link - Majora\'s Mask', 'Raison du christianisme, par Nicolas, ancien magistrat! Ils s\'échauffaient, ils étaient par leur acharnement à poursuivre des gens bien constitués, comme.', '2024-01-06 00:57:16', 'https://raw.githubusercontent.com/N3evin/AmiiboAPI/master/images/icon_01000000-034c0902.png', 'Figure', 'Link', 37, '2017-06-23 00:00:00', 2),
(416, 1266, 'Bokoblin', 'Elle avait tant dépensé pour les chaînes hydro-électriques Pulvermacher; il en fait comme deux Robinsons, vivre perpétuellement dans ce beau couvre.', '2024-01-06 00:57:16', 'https://raw.githubusercontent.com/N3evin/AmiiboAPI/master/images/icon_01410000-035c0902.png', 'Figure', 'Bokoblin', 37, '2017-03-03 00:00:00', 1),
(417, 1266, 'Urbosa', 'Je dirai à mon oreille! Cependant, madame Lefrançois s\'en apercevait bien à la fois d\'une main sa candidature à la porte. -- Eh bien, moi aussi, reprit.', '2024-01-06 00:57:16', 'https://raw.githubusercontent.com/N3evin/AmiiboAPI/master/images/icon_01060000-03590902.png', 'Figure', 'Urbosa', 37, '2017-11-10 00:00:00', 7),
(418, 1266, 'Link - Link\'s Awakening', 'Elle était en relation avec les cendres du foyer, sentait l\'ennui plus lourd qui retombait par derrière, en vous penchant sur son fauteuil. Et il agita.', '2024-01-06 00:57:16', 'https://raw.githubusercontent.com/N3evin/AmiiboAPI/master/images/icon_01000000-03990902.png', 'Figure', 'Link', 37, '2019-09-20 00:00:00', 1),
(419, 1266, 'Zelda - Tears of the Kingdom', 'Il faut remettre le panier à elle-même, en mains propres... Va, et prends garde! Girard passa sa blouse avait des baraques de toile épaisse étalé en long.', '2024-01-06 00:57:16', 'https://raw.githubusercontent.com/N3evin/AmiiboAPI/master/images/icon_01010000-04190902.png', 'Figure', 'Zelda', 37, '2023-11-03 00:00:00', 5),
(420, 1266, 'Link - Tears of the Kingdom', 'Elle avait pour décoration une vieille couverture de laine bleue, passait son orgue sur son genou. Il a, l\'année dernière, et qui servait maintenant de.', '2024-01-06 00:57:16', 'https://raw.githubusercontent.com/N3evin/AmiiboAPI/master/images/icon_01000000-04180902.png', 'Figure', 'Link', 37, '2023-05-12 00:00:00', 9),
(421, 1266, 'Link - Skyward Sword', 'Bovary ronflait plus fort, l\'ecclésiastique précipitait ses oraisons; elles se réuniront, s\'aimeront, parce que Madame, dès que l\'arriéré de votre.', '2024-01-06 00:57:16', 'https://raw.githubusercontent.com/N3evin/AmiiboAPI/master/images/icon_01000000-034e0902.png', 'Figure', 'Link', 37, '2017-06-23 00:00:00', 3);

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `stock`
--

INSERT INTO `stock` (`id`, `product_id`, `quantity`) VALUES
(204, 400, 3),
(205, 401, 8),
(206, 402, 8),
(207, 403, 8),
(208, 404, 6),
(209, 405, 9),
(210, 406, 2),
(211, 407, 1),
(212, 408, 9),
(213, 409, 5),
(214, 410, 4),
(215, 411, 5),
(216, 412, 8),
(217, 413, 8),
(218, 414, 2),
(219, 415, 10),
(220, 416, 7),
(221, 417, 4),
(222, 418, 10),
(223, 419, 3),
(224, 420, 8),
(225, 421, 3);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sold` double NOT NULL,
  `pfp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `username`, `sold`, `pfp`) VALUES
(37, 'admin@admin.com', '[\"ROLE_ADMIN\"]', '$2y$13$YIJ3N7R7sihgpVHqClAL..GykiGcld.0D2ptZ/TweRY3hWef3fb/m', 'admin', 100, 'path/to/profile/picture.jpg'),
(38, 'test@test.com', '[\"ROLE_USER\"]', '$2y$13$zcgtyfD3Ac6xIPXqf6MQv.8uXsOU3PW3Eg7A6Fngw2SCPPAPP2T9q', 'test', 100, 'path/to/profile/picture.jpg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_BA388B7A76ED395` (`user_id`);

--
-- Index pour la table `cart_product`
--
ALTER TABLE `cart_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2890CCAA1AD5CDBF` (`cart_id`),
  ADD KEY `IDX_2890CCAA4584665A` (`product_id`);

--
-- Index pour la table `category_shop`
--
ALTER TABLE `category_shop`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_90651744A76ED395` (`user_id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D34A04AD12469DE2` (`category_id`),
  ADD KEY `IDX_D34A04ADF675F31B` (`author_id`);

--
-- Index pour la table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_4B3656604584665A` (`product_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pour la table `cart_product`
--
ALTER TABLE `cart_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT pour la table `category_shop`
--
ALTER TABLE `category_shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1277;

--
-- AUTO_INCREMENT pour la table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=422;

--
-- AUTO_INCREMENT pour la table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=226;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FK_BA388B7A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `cart_product`
--
ALTER TABLE `cart_product`
  ADD CONSTRAINT `FK_2890CCAA1AD5CDBF` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`),
  ADD CONSTRAINT `FK_2890CCAA4584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Contraintes pour la table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `FK_90651744A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_D34A04AD12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category_shop` (`id`),
  ADD CONSTRAINT `FK_D34A04ADF675F31B` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `FK_4B3656604584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
