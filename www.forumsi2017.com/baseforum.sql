-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Mar 07 Mars 2017 à 14:12
-- Version du serveur: 5.1.36
-- Version de PHP: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `baseforum`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_domaine` int(10) unsigned NOT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `contenu` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `id_dernier` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `id_domaine`, `titre`, `contenu`, `image`, `id_dernier`) VALUES
(1, 1, 'HTML/CSS', 'Une question sur la realisation de site web en HTML et CSS?', 'html.PNG', 0),
(2, 1, 'JAVASCRIPT', 'Vos question a propos de javascript', 'js.PNG', 0),
(3, 1, 'PHP', 'Un souci avec le PHP? Venez demander de l''aide!', 'php.PNG', 0),
(4, 2, 'LANGAGE C', 'Vos questions sur le langage C', 'c.PNG', 0),
(5, 2, 'LANGAGE C++', 'Vos questions sur le langage C++', 'c++.PNG', 0),
(6, 2, 'JAVA', 'Vos question sur le langage JAVA', 'java.PNG', 0),
(7, 3, 'WINDOWS', 'Un souci avec windows?Une solution', 'windows.PNG', 0),
(8, 3, 'LINUX', 'Vous avez un probleme avec LINUX?', 'linux.PNG', 0),
(9, 3, 'MAC OS X', 'Une question a propos de MAC OS X?Vous est au bon endroit.', 'mac.PNG', 0);

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sujets` int(10) unsigned NOT NULL,
  `auteur` varchar(255) NOT NULL,
  `id_auteur` int(10) unsigned NOT NULL,
  `commentaire` text NOT NULL,
  `date_commentaire` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_auteur` (`id_auteur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=93 ;

--
-- Contenu de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `id_sujets`, `auteur`, `id_auteur`, `commentaire`, `date_commentaire`) VALUES
(54, 11, 'KIMOU', 5, 'ok cest bon', '2016-12-03 00:07:07'),
(55, 11, 'anonyme', 4, 'coucou', '2016-12-03 00:10:45'),
(56, 11, 'KIMOU', 5, 'daccord', '2016-12-03 00:42:19'),
(57, 11, 'anonyme', 4, 'ok', '2016-12-03 00:43:07'),
(58, 11, 'HENRI', 7, 'ah bon', '2016-12-03 01:26:28'),
(59, 11, 'kimou', 5, 'lol', '2016-12-03 01:30:14'),
(60, 11, 'HENRI', 7, 'ah lvhkjb;nvhlivhh  gupçigjb gyoguvi  yougguiohogil oyyiuhlpugiugup pu_giooguigiu gopuiguougiiul gouiguogul oguiugi upijguçuio guppuij gupi upgij\r\npguoijlk \r\ngçuiguiouih\r\ngpçuiogy\r\ngou_yih\r\ngouihl guoiyh\r\nhuiçpgugp çupggiu pçugpui  guo_iguh yoguihogyui oyg_ugyu ygougyuih ygoiug_ui yoguhogyuhguio', '2016-12-03 01:32:50'),
(61, 11, 'anonyme', 4, 'ok ca maintenant', '2016-12-03 01:36:55'),
(62, 12, 'kimou', 5, 'ok cest comme ca', '2016-12-03 23:44:17'),
(63, 12, 'kimou', 5, 'daccord', '2016-12-03 23:45:23'),
(64, 12, 'kimou', 5, 'et pouquoi', '2016-12-03 23:45:32'),
(65, 12, 'kimou', 5, 'parce que cest ca', '2016-12-03 23:45:45'),
(66, 12, 'kimou', 5, 'donce jaimerais savoir', '2016-12-03 23:45:58'),
(67, 12, 'kimou', 5, 'ou et quand', '2016-12-03 23:46:06'),
(68, 12, 'kimou', 5, 'biensur', '2016-12-03 23:46:15'),
(69, 12, 'kimou', 5, 'va voir sur le cours du site du zero', '2016-12-03 23:46:34'),
(70, 12, 'kimou', 5, 'ah bon ', '2016-12-03 23:46:42'),
(71, 12, 'kimou', 5, 'oui oui', '2016-12-03 23:46:52'),
(72, 15, 'anonyme', 4, 'ok les gars', '2016-12-04 00:33:22'),
(73, 15, 'anonyme', 4, 'www.google.fr', '2016-12-04 00:40:55'),
(74, 17, 'kimou', 5, 'coucou', '2016-12-04 01:44:08'),
(75, 15, 'kimou', 5, 'et donc quoi', '2016-12-06 00:50:23'),
(76, 15, 'jipi', 9, 'waiwai', '2016-12-06 00:58:09'),
(77, 11, 'Jean philippe', 8, 'ippolbj', '2016-12-06 01:12:28'),
(78, 13, 'henri', 7, 'ah bon ok donc cest bien', '2016-12-08 01:40:14'),
(79, 15, 'henri', 7, 'bon ok je ne suis pas entrain de faire \r\nok ce vont \r\njej bipezvc\r\n  bhdpfqfae\r\npbjiraeuz b hiufipqegurbza upiubrfeprfriheuz upjrjeszhpuifzuprhze puuijreuzruize iufuu  ureiz iurzeurjz\r\nbrziper \r\nrbze \r\ngurçzep\r\n\r\nrhuzerhbez urzoirzor puiuoizr ur uçpirzhzup urirguzbi upir gzrz ', '2016-12-08 01:48:39'),
(80, 15, 'henri', 7, '^fosejnv^\r\nripbjsrjzse\r\ntip jsbb sr\r\njbpisfffffffffffffffffffffg jufsgdjfs ijbofsufsuoie ruibuorguzrgs uhotrigzuerir sougiszugz ossihorfs uspiuf\r\nijhsdbpb\r\nfbimljsfidm\r\nfjbibspdf\r\nsjbiodrf\r\n\r\nbjismpfgfsbdpm\r\n\r\n\r\nhfiopsfhiu \r\n\r\n\r\njfsbfjlf gsiudf sidu                  ufjsi ioug ogiusydf                 oiufgsgfsouifgsfiupsgdg\r\n\r\nisbf jsdbbj\r\n\r\n\r\n', '2016-12-08 01:55:07'),
(81, 12, 'henri', 7, 'daccord', '2016-12-08 04:36:47'),
(82, 12, 'KIMOU', 5, 'ok cest bien', '2016-12-08 04:38:02'),
(83, 17, 'KIMOU', 5, 'mais cest comment', '2016-12-08 04:38:33'),
(84, 13, 'KIMOU', 5, 'ah bon', '2016-12-08 04:57:26'),
(85, 12, 'KIMOU', 5, 'ok', '2016-12-17 19:34:45'),
(86, 17, 'Jean philippe', 8, 'ah bon hein\r\nok\r\nkkjik\r\ngybuihj\r\nhubjk\r\nhuionjk\r\nhiojk\r\niho\r\nju\r\ni\r\n\r\n\r\n\r\n\r\nuhiiuh\r\nuhihug\r\n\r\n\r\ngiuk\r\n\r\nuyhjjgub\r\nguiyguihb\r\nguij\r\n\r\n\r\ngèuyhb\r\ngyhguy\r\nyghhiugyj\r\ngy\r\n\r\n\r\nugu\r\n', '2016-12-17 19:46:38'),
(87, 17, 'Jean philippe', 8, 'mibjljk hibjoi guoihj ouhgvb oughv ouvhvu ouvh vouh uovh ouhv ovuh vouh vovu vou ovu vouv ovuho ou vh ovuh ovovu vo ov vo vpo vuhv ohuvou h uvoo v ovuh ovuvup  ovyovu ov hohu vovh uovhu h oh ovh oh oh oh  hobho b hbvuohiohb yov hh obi hoohi bh boljh obj ihio hb ihboihb ihjob hb oiji boib joih bjj biohohb  huobh o hbihib ojoihb h bioh oihbb oiibo ji obj oiji obj ioj oii oj ij jij i iubj ihojib\r\n\r\nihpj h ou\r\nou g_igyouh\r\nhu çàouhubvhhho   hu hhubyy y g youoyu  hhobo hbobhbohbbogbooobhoboboh\r\nmibjljk hibjoi guoihj ouhgvb oughv ouvhvu ouvh vouh uovh ouhv ovuh vouh vovu vou ovu vouv ovuho ou vh ovuh ovovu vo ov vo vpo vuhv ohuvou h uvoo v ovuh ovuvup  ovyovu ov hohu vovh uovhu h oh ovh oh oh oh  hobho b hbvuohiohb yov hh obi hoohi bh boljh obj ihio hb ihboihb ihjob hb oiji boib joih bjj biohohb  huobh o hbihib ojoihb h bioh oihbb oiibo ji obj oiji obj ioj oii oj ij jij i iubj ihojib\r\n\r\nihpj h ou\r\nou g_igyouh\r\nhu çàouhubvhhho   hu hhubyy y g youoyu  hhobo hbobhbohbbogbooobhoboboh\r\nmibjljk hibjoi guoihj ouhgvb oughv ouvhvu ouvh vouh uovh ouhv ovuh vouh vovu vou ovu vouv ovuho ou vh ovuh ovovu vo ov vo vpo vuhv ohuvou h uvoo v ovuh ovuvup  ovyovu ov hohu vovh uovhu h oh ovh oh oh oh  hobho b hbvuohiohb yov hh obi hoohi bh boljh obj ihio hb ihboihb ihjob hb oiji boib joih bjj biohohb  huobh o hbihib ojoihb h bioh oihbb oiibo ji obj oiji obj ioj oii oj ij jij i iubj ihojib\r\n\r\nihpj h ou\r\nou g_igyouh\r\nhu çàouhubvhhho   hu hhubyy y g youoyu  hhobo hbobhbohbbogbooobhoboboh\r\nmibjljk hibjoi guoihj ouhgvb oughv ouvhvu ouvh vouh uovh ouhv ovuh vouh vovu vou ovu vouv ovuho ou vh ovuh ovovu vo ov vo vpo vuhv ohuvou h uvoo v ovuh ovuvup  ovyovu ov hohu vovh uovhu h oh ovh oh oh oh  hobho b hbvuohiohb yov hh obi hoohi bh boljh obj ihio hb ihboihb ihjob hb oiji boib joih bjj biohohb  huobh o hbihib ojoihb h bioh oihbb oiibo ji obj oiji obj ioj oii oj ij jij i iubj ihojib\r\n\r\nihpj h ou\r\nou g_igyouh\r\nhu çàouhubvhhho   hu hhubyy y g youoyu  hhobo hbobhbohbbogbooobhoboboh', '2016-12-17 19:48:04'),
(88, 18, 'jeanphy', 10, 'hjuedoifzb iougfr e', '2017-03-07 13:56:43'),
(89, 18, 'jeanphy', 10, 'ovidfhsfdo ', '2017-03-07 13:56:53'),
(90, 12, 'gouandje', 11, 'pkw cest ca\r\n', '2017-03-07 14:03:42'),
(91, 12, 'jeanphy', 10, 'v uihkd vidf\r\n', '2017-03-07 14:04:16'),
(92, 12, 'gouandje', 11, 'pkw cest ca\r\n', '2017-03-07 14:04:36');

-- --------------------------------------------------------

--
-- Structure de la table `domaines`
--

CREATE TABLE IF NOT EXISTS `domaines` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `domaines`
--

INSERT INTO `domaines` (`id`, `titre`) VALUES
(1, 'Site Web'),
(2, 'Programmation'),
(3, 'Systeme D''exploitation');

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE IF NOT EXISTS `membres` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `motpasse` varchar(255) NOT NULL,
  `id_image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `membres`
--

INSERT INTO `membres` (`id`, `nom`, `prenom`, `email`, `motpasse`, `id_image`) VALUES
(4, 'anonyme', 'anonyme', 'anonyme', 'anonyme', 'avatar.PNG'),
(5, 'KIMOU', 'N''TAMON PHILIPPE', 'kmjeanphilippe@hotmail.fr', '2016', 'oriane.jpg'),
(7, 'HENRI', 'SYLVANUS', 'henri@hotmail.fr', '2016', 'image/sacato.jpg'),
(8, 'Jean philippe', 'ntamon', 'kmjeanphilippe@hotmail.fr', '2015', 'image/jipi.jpg'),
(9, 'jipi', 'kimou', 'kmjeanphilippe@hotmail.fr', '2014', 'image/jipi.jpg'),
(10, 'jeanphy', 'kim', 'kmjeanphiilippe@gmail.fr', 'jipijipi', 'image/2014-09-06 12.03.09.jpg'),
(11, 'gouandje', 'bi boris sylvanus', 'gboris@gmail.com', '12345678', 'image/WIN_20161104_12_25_09_Pro.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `sujets`
--

CREATE TABLE IF NOT EXISTS `sujets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_categ` int(10) unsigned NOT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `auteur` varchar(255) DEFAULT NULL,
  `id_auteur` int(10) unsigned NOT NULL,
  `contenu` text,
  `date_creation` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_categ` (`id_categ`),
  KEY `id_auteur` (`id_auteur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Contenu de la table `sujets`
--

INSERT INTO `sujets` (`id`, `id_categ`, `titre`, `auteur`, `id_auteur`, `contenu`, `date_creation`) VALUES
(12, 1, 'ACTUALISER UNE PAGE HTML AUTOMATIQUE', 'kimou', 5, 'aider moi a actualiser ma page html automatiquement', '2016-12-03 23:43:31'),
(13, 1, 'APPRENER HTML CSS', 'kimou', 5, 'un tres bon cour de html et css', '2016-12-03 23:49:02'),
(14, 1, 'LES TABLEAU EN HTML', 'kimou', 5, 'comment creer un tableau en html css', '2016-12-03 23:49:53'),
(15, 1, 'IMAGE DE FOND EN HTML CSS', 'kimou', 5, 'mettre une image de fond a l''arriere plan de mon site web', '2016-12-03 23:51:31'),
(17, 6, 'COMMENT PROGRAMMMER EN JAVA', 'kimou', 5, 'je cherche à programmer en java', '2016-12-04 01:34:52'),
(18, 1, 'CEST QUOI HTML AU JUSTE PARCE QUE EEEBIJ', 'kimou', 5, 'je veux savoir', '2016-12-06 00:35:41');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_ibfk_1` FOREIGN KEY (`id_auteur`) REFERENCES `membres` (`id`);

--
-- Contraintes pour la table `sujets`
--
ALTER TABLE `sujets`
  ADD CONSTRAINT `sujets_ibfk_1` FOREIGN KEY (`id_categ`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `sujets_ibfk_2` FOREIGN KEY (`id_auteur`) REFERENCES `membres` (`id`);
