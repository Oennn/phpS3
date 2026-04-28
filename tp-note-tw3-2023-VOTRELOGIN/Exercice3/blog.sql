SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
--
-- Table structure for table `blog`
--
DROP TABLE IF EXISTS `blog`;

CREATE TABLE IF NOT EXISTS `blog` (
  `article_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `article` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`article_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `blog`
--
INSERT INTO `blog` (`article_id`, `title`, `article`, `created`, `updated`) VALUES 
(1, 'Vue spectaculaire du Mont Fuji depuis le train à grande vitesse', 'L\'une des images touristiques les plus connues du Japon est celle du train à grande vitesse traversant un pont au pied du Mont Fuji enneigé. Cependant, lorsque vous prenez le train à grande vitesse de Tokyo à Kyoto, le Mont Fuji se montre souvent timide - et se cache derrière les nuages. C\'est ce qui s\'est passé lors de ma dernière visite au Japon. Il n\'y avait peu ou rien à voir lors du trajet dans les deux sens. Cependant, une semaine plus tard, je me suis dirigé vers l\'ouest de Tokyo pour un voyage qui m\'emmènerait dans le nord du Japon. Alors que le train à grande vitesse filait, il y avait le Mont Fuji dans toute sa splendeur : un soleil brillant, une légère couche de neige sur le sommet, et juste un soupçon de nuage du côté nord, formant un décor parfait. La preuve est sur la photo qui illustre chaque page de ce site. Ce n\'est pas une photo stockée, mais tout mon propre travail - et celui de Mère Nature, bien sûr.', '2014-09-10 11:56:56', '2014-09-10 11:56:56'), 
(2, 'Les apprenties Geishas font du shopping', 'Bien que Kyoto attire un grand nombre de touristes étrangers, désireux de voir ses temples et sanctuaires centenaires, c\'est en fait une ville parfaitement moderne. La première vue depuis le train à grande vitesse est un choc. Au lieu de pagodes et de toits de temples, tout ce que vous voyez, c\'est un amas de blocs de béton et de panneaux lumineux au néon. Dominant l\'horizon juste à l\'extérieur de la gare de Kyoto se trouve la hideuse tour de Kyoto, encore plus de béton qui pousse sur le toit d\'un grand magasin. Les véritables joies de Kyoto résident dans des rencontres inattendues. Shijo-dori est l\'une des principales rues commerçantes, bondée de gens du coin et de visiteurs. Juste au moment où je commençais à traverser la route, j\'ai entendu un petit bruit derrière moi et j\'ai regardé autour de moi. Il y avait deux jeunes femmes en kimonos exquis, le visage peint en blanc, et avec des lèvres rouges en forme de coeur. Le bruit venait des geta, les hauts sabots en bois qu\'elles portaient aux pieds. Tout comme tout le monde, il semblait, elles étaient sorties pour profiter d\'une matinée de vitrine. C\'est une vue que vous ne verrez rarement nulle part ailleurs au Japon, sauf à Kyoto. Les jeunes femmes étaient des maiko, des apprenties geishas, qui passent des années à étudier le chant et la danse traditionnels. C\'est un métier inhabituel qui a survécu dans un pays désormais si moderne, mais les geishas sont respectées pour avoir préservé les arts traditionnels - et d\'une manière très attrayante.', '2014-09-10 11:58:02', '2014-09-10 11:58:02'), 
(3, 'Petits restaurants entassés les uns sur les autres', 'Chaque ville a des ruelles étroites qu\'il vaut mieux éviter, même pour les habitants. Mais Kyoto a une ruelle qui vaut vraiment le détour. Pontocho est une longue rue étroite de seulement quelques mètres de large, bourrée de restaurants et de bars. Il y en a des dizaines, voire des centaines;', '2014-09-10 11:59:12', '2014-09-10 11:59:12');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
