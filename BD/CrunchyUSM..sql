-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2022 at 04:41 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crunchyusm`
--

-- --------------------------------------------------------

--
-- Table structure for table `animes`
--

CREATE TABLE `animes` (
  `Id_anime` int(11) NOT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `Capitulos` int(11) DEFAULT NULL,
  `Descripcion` varchar(500) DEFAULT NULL,
  `Imagen` varchar(1000) NOT NULL,
  `puntuacion` float NOT NULL DEFAULT 0,
  `aux` int(100) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `animes`
--

INSERT INTO `animes` (`Id_anime`, `Nombre`, `Capitulos`, `Descripcion`, `Imagen`, `puntuacion`, `aux`) VALUES
(6, 'The Promised Neverland', 23, 'The Promised Neverland is a Japanese manga series written by Kaiu Shirai and illustrated by Posuka Demizu. It was serialized in Shueisha\'s Weekly Shōnen Jump from August 2016 to June 2020, with its chapters collected in twenty tankōbon volumes.', '1656981346_The-Promised-Neverland.jpg', 3.5, 2),
(7, 'Demon Slayer', 25, 'A youth begins a quest to fight demons and save his sister after finding his family slaughtered and his sister turned into a demon.', '1657654543_Demon-Slayer-Kimetsu-no-Yaiba.jpg', 4, 2),
(8, 'Blue Period', 12, 'Bored with life, popular teenager Yatora Yaguchi jumps into the beautiful yet unrelenting world of art after finding inspiration in a painting.', '1657654623_blue_period_1r_1024x1024.png', 1.5, 2),
(9, 'High-Rise Invasion', 12, 'As Yuri finds herself in a bizarre world of endless buildings and masked killers, she\'ll do whatever it takes to find her brother and escape.', '1657654688_MV5BNTU0ZGYzMjktMWQ2MC00NmRlLTk1YWItZmJkZmRiYzQ1NDE5XkEyXkFqcGdeQXVyMjIwNTI1MTM@._V1_.jpg', 3, 2),
(10, 'Komi Can\'t Communicate', 24, 'At a high school full of unique characters, Tadano helps his shy and unsociable classmate Komi reach her goal of making friends with 100 people.', '1657654789_MV5BZmQzNTdjYjctYzM5OS00ZjFmLWJjYmYtZDYwZGYyYjkwODRhXkEyXkFqcGdeQXVyMTQ3MjMyMTYz._V1_FMjpg_UX1000_.jpg', 1, 1),
(11, 'Vampire in the Garden', 5, 'After humanity loses its battle with vampires, a young survivor named Momo has a fateful encounter with Fine, a vampire queen, and together they embark on a quest to find harmony.', '1657654865_5DNUN56EJRCBHKIFQJVV67R42Q.jpg', 3, 1),
(12, 'Castlevania', 32, 'Inspired by the popular video game series, this anime series is a dark medieval fantasy. It follows the last surviving member of the disgraced Belmont clan, Trevor Belmont, trying to save Eastern Europe from extinction at the hands of Vlad Dracula Tepes. As Dracula and his legion of vampires prepare to rid the world of humanity\'s stain, Belmont is no longer alone, and he and his misfit comrades race to find a way to save mankind from the grief-maddened Dracula.', '1657654963_maxresdefault.jpg', 4, 1),
(13, 'PSYCHO-PASS', 22, 'The adventures of Inspector Akane Tsunemori.', '1657655068_psycho-pass.jpg', 1, 1),
(14, 'Dororo', 24, 'A mysterious warrior with prosthetic limbs and a young orphan thief travel across Japan fighting demons who threaten humanity.', '1657655125_1639915.jpg', 2, 1),
(16, 'One Piece', 1023, 'One Piece is a Japanese manga series written and illustrated by Eiichiro Oda. It has been serialized in Shueisha\'s shōnen manga magazine Weekly Shōnen Jump since July 1997, with its individual chapters compiled into 102 tankōbon volumes as of April 2022.', '1657761730_op.jpg', 5, 1),
(147, 'Spy x Family', 25, 'Spy × Family is a Japanese manga series written and illustrated by Tatsuya Endo. The story follows a spy who has to \"build a family\" to execute a mission, not realizing that the girl he adopts as his daughter is a telepath, and the woman he agrees to be in a marriage with is a skilled assassin.', '1658278970_wp7868567.jpg', 5, 1);

--
-- Triggers `animes`
--
DELIMITER $$
CREATE TRIGGER `agregar_generoA` AFTER INSERT ON `animes` FOR EACH ROW insert into generos_anime(Id_anime) VALUES (new.Id_anime)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `delete_generoA` BEFORE DELETE ON `animes` FOR EACH ROW DELETE FROM generos_anime WHERE Id_anime=old.Id_anime
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `favs_anime`
--

CREATE TABLE `favs_anime` (
  `Id_favs_a` int(11) NOT NULL,
  `Rol_user` varchar(15) DEFAULT NULL,
  `Id_anime` int(11) DEFAULT NULL,
  `Nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `favs_anime`
--

INSERT INTO `favs_anime` (`Id_favs_a`, `Rol_user`, `Id_anime`, `Nombre`) VALUES
(15, '202030548-k', 16, 'One Piece'),
(17, '202030548-k', 9, 'High-Rise Invasion'),
(18, '202030548-k', 12, 'Castlevania');

-- --------------------------------------------------------

--
-- Table structure for table `favs_pelicula`
--

CREATE TABLE `favs_pelicula` (
  `Id_favs_p` int(11) NOT NULL,
  `Rol_user` varchar(15) DEFAULT NULL,
  `Id_pelicula` int(11) DEFAULT NULL,
  `Nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `favs_pelicula`
--

INSERT INTO `favs_pelicula` (`Id_favs_p`, `Rol_user`, `Id_pelicula`, `Nombre`) VALUES
(4, '202030548-k', 9, 'Pokémon the Movie: I Choose You!'),
(5, '202030548-k', 3, 'Belle');

-- --------------------------------------------------------

--
-- Table structure for table `generos_anime`
--

CREATE TABLE `generos_anime` (
  `Id_genero` int(11) NOT NULL,
  `Id_anime` int(11) DEFAULT NULL,
  `Accion` tinyint(1) NOT NULL,
  `Aventura` tinyint(1) NOT NULL,
  `Comedia` tinyint(1) NOT NULL,
  `Drama` tinyint(1) NOT NULL,
  `Fantasia` tinyint(1) NOT NULL,
  `Musical` tinyint(1) NOT NULL,
  `Romance` tinyint(1) NOT NULL,
  `Ciencia_ficcion` tinyint(1) NOT NULL,
  `Seinen` tinyint(1) NOT NULL,
  `Shoujo` tinyint(1) NOT NULL,
  `Shounen` tinyint(1) NOT NULL,
  `Recuentos_de_la_vida` tinyint(1) NOT NULL,
  `Deportes` tinyint(1) NOT NULL,
  `Sobrenatural` tinyint(1) NOT NULL,
  `Thriller` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `generos_anime`
--

INSERT INTO `generos_anime` (`Id_genero`, `Id_anime`, `Accion`, `Aventura`, `Comedia`, `Drama`, `Fantasia`, `Musical`, `Romance`, `Ciencia_ficcion`, `Seinen`, `Shoujo`, `Shounen`, `Recuentos_de_la_vida`, `Deportes`, `Sobrenatural`, `Thriller`) VALUES
(7, 6, 1, 0, 0, 1, 1, 0, 0, 1, 0, 0, 1, 0, 0, 0, 1),
(8, 7, 1, 1, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(9, 8, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0),
(10, 9, 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0),
(11, 10, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0),
(12, 11, 0, 0, 0, 0, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(13, 12, 1, 1, 0, 1, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 1),
(14, 13, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(15, 14, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(16, 16, 1, 1, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(18, 147, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `generos_pelicula`
--

CREATE TABLE `generos_pelicula` (
  `Id_genero` int(11) NOT NULL,
  `Id_pelicula` int(11) DEFAULT NULL,
  `Accion` tinyint(1) NOT NULL,
  `Aventura` tinyint(1) NOT NULL,
  `Comedia` tinyint(1) NOT NULL,
  `Drama` tinyint(1) NOT NULL,
  `Fantasia` tinyint(1) NOT NULL,
  `Musical` tinyint(1) NOT NULL,
  `Romance` tinyint(1) NOT NULL,
  `Ciencia_ficcion` tinyint(1) NOT NULL,
  `Seinen` tinyint(1) NOT NULL,
  `Shoujo` tinyint(1) NOT NULL,
  `Shounen` tinyint(1) NOT NULL,
  `Recuentos_de_la_vida` tinyint(1) NOT NULL,
  `Deportes` tinyint(1) NOT NULL,
  `Sobrenatural` tinyint(1) NOT NULL,
  `Thriller` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `generos_pelicula`
--

INSERT INTO `generos_pelicula` (`Id_genero`, `Id_pelicula`, `Accion`, `Aventura`, `Comedia`, `Drama`, `Fantasia`, `Musical`, `Romance`, `Ciencia_ficcion`, `Seinen`, `Shoujo`, `Shounen`, `Recuentos_de_la_vida`, `Deportes`, `Sobrenatural`, `Thriller`) VALUES
(2, 1, 1, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 2, 1, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 3, 1, 0, 0, 1, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0),
(5, 4, 0, 0, 0, 1, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 5, 0, 0, 0, 1, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0),
(7, 6, 0, 0, 1, 1, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0),
(8, 7, 0, 0, 0, 0, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(9, 8, 1, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0),
(10, 9, 1, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(11, 10, 0, 0, 0, 1, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(13, 15, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `historial_anime`
--

CREATE TABLE `historial_anime` (
  `Id_historial_a` int(11) NOT NULL,
  `Rol_user` varchar(15) DEFAULT NULL,
  `Id_anime` int(11) DEFAULT NULL,
  `Nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `historial_anime`
--

INSERT INTO `historial_anime` (`Id_historial_a`, `Rol_user`, `Id_anime`, `Nombre`) VALUES
(16, '202030548-k', 6, 'The Promised Neverland'),
(17, '202030548-k', 7, 'Demon Slayer');

-- --------------------------------------------------------

--
-- Table structure for table `historial_pelicula`
--

CREATE TABLE `historial_pelicula` (
  `Id_historial_p` int(11) NOT NULL,
  `Rol_user` varchar(15) DEFAULT NULL,
  `Id_pelicula` int(11) DEFAULT NULL,
  `Nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `historial_pelicula`
--

INSERT INTO `historial_pelicula` (`Id_historial_p`, `Rol_user`, `Id_pelicula`, `Nombre`) VALUES
(5, '202030548-k', 1, 'One Piece Film: Z'),
(6, '202030548-k', 2, 'One Piece Film: Gold');

-- --------------------------------------------------------

--
-- Table structure for table `opiniones_anime`
--

CREATE TABLE `opiniones_anime` (
  `Id_opinion` int(11) NOT NULL,
  `Rol_user` varchar(15) DEFAULT NULL,
  `Id_anime` int(11) DEFAULT NULL,
  `Comentario` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `opiniones_anime`
--

INSERT INTO `opiniones_anime` (`Id_opinion`, `Rol_user`, `Id_anime`, `Comentario`) VALUES
(31, '202030548-k', 16, 'muy bueno.'),
(32, '202030548-k', 6, 'fome el anime'),
(33, '202030548-k', 7, 'La vida de un crítico es sencilla en muchos aspectos. Arriesgamos poco y tenemos poder sobre aquellos que ofrecen su trabajo y su servicio a nuestro juicio. Preferimos las críticas negativas, que es divertida de escribir y de leer. Pero la triste verdad que debemos afrontar es que en el gran orden de las cosas, cualquier basura tiene más significado que lo que deja ver nuestra crítica. ');

-- --------------------------------------------------------

--
-- Table structure for table `opiniones_pelicula`
--

CREATE TABLE `opiniones_pelicula` (
  `Id_opinion` int(11) NOT NULL,
  `Rol_user` varchar(15) DEFAULT NULL,
  `Id_pelicula` int(11) DEFAULT NULL,
  `Comentario` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `opiniones_pelicula`
--

INSERT INTO `opiniones_pelicula` (`Id_opinion`, `Rol_user`, `Id_pelicula`, `Comentario`) VALUES
(7, '202030548-k', 5, 'entrete.'),
(8, '202030548-k', 8, 'deja mucho que desear');

-- --------------------------------------------------------

--
-- Table structure for table `peliculas`
--

CREATE TABLE `peliculas` (
  `Id_pelicula` int(11) NOT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `Duracion` int(11) DEFAULT NULL,
  `Descripcion` varchar(500) DEFAULT NULL,
  `Imagen` varchar(1000) NOT NULL,
  `puntuacion` float NOT NULL DEFAULT 0,
  `aux` int(255) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peliculas`
--

INSERT INTO `peliculas` (`Id_pelicula`, `Nombre`, `Duracion`, `Descripcion`, `Imagen`, `puntuacion`, `aux`) VALUES
(1, 'One Piece Film: Z', 108, 'When the Dyna Stones are stolen by the diabolical former marine admiral Zephyr, now known as `Z\', it\'s up to the Straw Hat Pirates to save the new world.', '1656982564_AAAABbb3FW_06eTikyqUK-UCUtI_8L7UwQtZZpGjvqOc6bbu29-jzBBjdDo_8DEaOXOjd0qnHbnA0v9yGf5mZ0k8gHYlLYROyB2YnvUl.jpg', 4.5, 2),
(2, 'One Piece Film: Gold', 120, 'Luffy and the Straw Hat Pirates take on the wealthy and ambitious Gild Tesoro, captain of a massive ship labelled the moving country of dreams.', '1656982730_375533.jpg', 2.5, 2),
(3, 'Belle', 162, 'A high school student becomes a globally beloved singer after entering a fantastic virtual world. She soon embarks on an emotional and epic quest to uncover the identity of a mysterious beast who\'s on the run from ruthless vigilantes.', '1657656794_Belle-615291149-large.jpg', 1, 2),
(4, 'Weathering with You', 114, 'Set during a period of exceptionally rainy weather, high-school boy Hodaka Morishima runs away from his troubled rural home to Tokyo and befriends an orphan girl who can manipulate the weather.', '1657656843_MV5BOTJlNTQ4OGUtODhlMy00NmNkLWI0NjctMWE0ZTc5N2EyZTA4XkEyXkFqcGdeQXVyMTM2ODk1OTQ@._V1_.jpg', 2.5, 2),
(5, 'Bubble', 100, 'Gravity-defying bubbles rain down, cutting off Tokyo from the rest of the world. The city skyline becomes a playground for young people competing in parkour team battles. Hibiki plummets into the sea but is saved by a girl with mysterious powers.', '1657656881_Bubble_film_poster.jpg', 2, 1),
(6, 'Words Bubble Up Like Soda Pop', 87, 'Love blooms between two introverted individuals, who have trouble communicating with people, after they meet on a bright sunny day.', '1657656951_52_1A_1B_gue0-o1.jpg', 1, 1),
(7, 'A Whisker Away', 104, 'Secretly in love with her classmate Kento, Miyo takes the help of a mysterious mask and transforms into a cat to get closer to him. However, trouble ensues when she begins to lose herself.', '1657656987_Nakitai_Watashi_wa_Neko_o_Kaburu_poster.png', 5, 1),
(8, 'Evangelion: 3.0+1.0 Thrice Upon a Time', 155, 'Shinji Ikari is still adrift after losing his will to live, but the place he arrives at teaches him what it means to hope. Finally, the Instrumentality Project is set in motion and Wille make one last gruelling stand to prevent the Final Impact.', '1657657073_Shin_Evangerion_Gekijoban-998717656-large.jpg', 4, 1),
(9, 'Pokémon the Movie: I Choose You!', 112, 'Ash Ketchum from Pallet Town is 10 years old today. This means he is now old enough to become a Pokémon Trainer. Ash dreams big about the adventures he will experience after receiving his first Pokémonfrom Professor Oak.', '1657657111_81aA3VFhfqL.jpg', 2, 1),
(10, 'Fireworks', 90, 'Norimichi and Yusuke are both infatuated with their classmate Nazuna. But when Nazuna decides to run away from home, it\'s Norimichi she asks to join her. After their plans go awry, Norimichi discovers a magical ball that has the power to manipulate time and give them a second chance, but each reset brings new complications.', '1657657159_81Ig+7mvNOL._RI_.jpg', 1, 1),
(15, 'Lupin the Third: The Blood Spray of Goemon Ishikaw', 54, 'Lupin helps his friend track down a brutal assassin who\'s been targeting yakuza bosses.', '1658279126_lupin_the_iiird_chikemuri_no_ishikawa_goemon-173198626-large.jpg', 3, 1);

--
-- Triggers `peliculas`
--
DELIMITER $$
CREATE TRIGGER `agregar_generoP` AFTER INSERT ON `peliculas` FOR EACH ROW insert into generos_pelicula(Id_pelicula) VALUES (new.Id_pelicula)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `delete_generoP` BEFORE DELETE ON `peliculas` FOR EACH ROW DELETE FROM generos_pelicula WHERE Id_pelicula=old.Id_pelicula
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `seguidores`
--

CREATE TABLE `seguidores` (
  `Id_seguidor` int(11) NOT NULL,
  `Rol_user` varchar(15) DEFAULT NULL,
  `Rol_seguidor` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seguidores`
--

INSERT INTO `seguidores` (`Id_seguidor`, `Rol_user`, `Rol_seguidor`) VALUES
(1, '202030548-k', '201828334-9'),
(2, '202030548-k', '201930501-4');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `Rol_user` varchar(15) NOT NULL,
  `Nombre` varchar(30) DEFAULT NULL,
  `Correo` varchar(50) DEFAULT NULL,
  `F_nacimiento` date DEFAULT NULL,
  `Pass` varchar(30) DEFAULT NULL,
  `Cant_Seguidores` int(11) DEFAULT NULL,
  `Suser` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`Rol_user`, `Nombre`, `Correo`, `F_nacimiento`, `Pass`, `Cant_Seguidores`, `Suser`) VALUES
('201828334-9', 'user2', 'user2@usm.cl', '1998-10-10', 'user2', 0, NULL),
('201930501-4', 'user1', 'user1@usm.cl', '2013-07-17', 'user1', 0, NULL),
('202030548-k', 'admin', 'admin@usm.cl', '2022-07-28', 'admin', 0, 0),
('204230578-9', 'user4', 'user4@usm.cl', '2022-07-04', 'user4', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `valo_anime`
--

CREATE TABLE `valo_anime` (
  `Id_valo` int(11) NOT NULL,
  `Rol_user` varchar(15) DEFAULT NULL,
  `Id_anime` int(11) DEFAULT NULL,
  `puntuacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `valo_anime`
--

INSERT INTO `valo_anime` (`Id_valo`, `Rol_user`, `Id_anime`, `puntuacion`) VALUES
(49, '202030548-k', 6, 4),
(50, '202030548-k', 7, 3),
(51, '202030548-k', 8, 1),
(52, '202030548-k', 9, 2),
(53, '201828334-9', 6, 3),
(54, '201828334-9', 7, 5),
(55, '201828334-9', 8, 2),
(56, '201828334-9', 9, 4),
(57, '202030548-k', 10, 1),
(58, '202030548-k', 11, 3),
(59, '202030548-k', 12, 4),
(60, '202030548-k', 13, 1),
(61, '202030548-k', 147, 5),
(62, '202030548-k', 16, 5),
(63, '202030548-k', 14, 2);

-- --------------------------------------------------------

--
-- Table structure for table `valo_pelicula`
--

CREATE TABLE `valo_pelicula` (
  `Id_valo` int(11) NOT NULL,
  `Rol_user` varchar(15) DEFAULT NULL,
  `Id_pelicula` int(11) DEFAULT NULL,
  `puntuacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `valo_pelicula`
--

INSERT INTO `valo_pelicula` (`Id_valo`, `Rol_user`, `Id_pelicula`, `puntuacion`) VALUES
(5, '202030548-k', 1, 4),
(6, '202030548-k', 2, 2),
(7, '202030548-k', 3, 1),
(8, '202030548-k', 4, 2),
(9, '201828334-9', 1, 5),
(10, '201828334-9', 2, 3),
(11, '201828334-9', 3, 1),
(12, '201828334-9', 4, 3),
(13, '202030548-k', 5, 2),
(14, '202030548-k', 6, 1),
(15, '202030548-k', 7, 5),
(16, '202030548-k', 8, 4),
(17, '202030548-k', 15, 3),
(18, '202030548-k', 10, 1),
(19, '202030548-k', 9, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animes`
--
ALTER TABLE `animes`
  ADD PRIMARY KEY (`Id_anime`);

--
-- Indexes for table `favs_anime`
--
ALTER TABLE `favs_anime`
  ADD PRIMARY KEY (`Id_favs_a`),
  ADD KEY `Rol_user` (`Rol_user`),
  ADD KEY `Id_anime` (`Id_anime`);

--
-- Indexes for table `favs_pelicula`
--
ALTER TABLE `favs_pelicula`
  ADD PRIMARY KEY (`Id_favs_p`),
  ADD KEY `Rol_user` (`Rol_user`),
  ADD KEY `Id_pelicula` (`Id_pelicula`);

--
-- Indexes for table `generos_anime`
--
ALTER TABLE `generos_anime`
  ADD PRIMARY KEY (`Id_genero`),
  ADD KEY `Id_anime` (`Id_anime`);

--
-- Indexes for table `generos_pelicula`
--
ALTER TABLE `generos_pelicula`
  ADD PRIMARY KEY (`Id_genero`),
  ADD KEY `Id_pelicula` (`Id_pelicula`);

--
-- Indexes for table `historial_anime`
--
ALTER TABLE `historial_anime`
  ADD PRIMARY KEY (`Id_historial_a`),
  ADD KEY `Rol_user` (`Rol_user`),
  ADD KEY `Id_anime` (`Id_anime`);

--
-- Indexes for table `historial_pelicula`
--
ALTER TABLE `historial_pelicula`
  ADD PRIMARY KEY (`Id_historial_p`),
  ADD KEY `Rol_user` (`Rol_user`),
  ADD KEY `Id_pelicula` (`Id_pelicula`);

--
-- Indexes for table `opiniones_anime`
--
ALTER TABLE `opiniones_anime`
  ADD PRIMARY KEY (`Id_opinion`),
  ADD KEY `Rol_user` (`Rol_user`),
  ADD KEY `Id_anime` (`Id_anime`);

--
-- Indexes for table `opiniones_pelicula`
--
ALTER TABLE `opiniones_pelicula`
  ADD PRIMARY KEY (`Id_opinion`),
  ADD KEY `Rol_user` (`Rol_user`),
  ADD KEY `Id_pelicula` (`Id_pelicula`);

--
-- Indexes for table `peliculas`
--
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`Id_pelicula`);

--
-- Indexes for table `seguidores`
--
ALTER TABLE `seguidores`
  ADD PRIMARY KEY (`Id_seguidor`),
  ADD KEY `Rol_user` (`Rol_user`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Rol_user`);

--
-- Indexes for table `valo_anime`
--
ALTER TABLE `valo_anime`
  ADD PRIMARY KEY (`Id_valo`),
  ADD KEY `Rol_user` (`Rol_user`),
  ADD KEY `Id_anime` (`Id_anime`);

--
-- Indexes for table `valo_pelicula`
--
ALTER TABLE `valo_pelicula`
  ADD PRIMARY KEY (`Id_valo`),
  ADD KEY `Rol_user` (`Rol_user`),
  ADD KEY `Id_pelicula` (`Id_pelicula`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animes`
--
ALTER TABLE `animes`
  MODIFY `Id_anime` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `favs_anime`
--
ALTER TABLE `favs_anime`
  MODIFY `Id_favs_a` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `favs_pelicula`
--
ALTER TABLE `favs_pelicula`
  MODIFY `Id_favs_p` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `generos_anime`
--
ALTER TABLE `generos_anime`
  MODIFY `Id_genero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `generos_pelicula`
--
ALTER TABLE `generos_pelicula`
  MODIFY `Id_genero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `historial_anime`
--
ALTER TABLE `historial_anime`
  MODIFY `Id_historial_a` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `historial_pelicula`
--
ALTER TABLE `historial_pelicula`
  MODIFY `Id_historial_p` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `opiniones_anime`
--
ALTER TABLE `opiniones_anime`
  MODIFY `Id_opinion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `opiniones_pelicula`
--
ALTER TABLE `opiniones_pelicula`
  MODIFY `Id_opinion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `Id_pelicula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `seguidores`
--
ALTER TABLE `seguidores`
  MODIFY `Id_seguidor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `valo_anime`
--
ALTER TABLE `valo_anime`
  MODIFY `Id_valo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `valo_pelicula`
--
ALTER TABLE `valo_pelicula`
  MODIFY `Id_valo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favs_anime`
--
ALTER TABLE `favs_anime`
  ADD CONSTRAINT `favs_anime_ibfk_1` FOREIGN KEY (`Rol_user`) REFERENCES `usuarios` (`Rol_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favs_anime_ibfk_2` FOREIGN KEY (`Id_anime`) REFERENCES `animes` (`Id_anime`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `favs_pelicula`
--
ALTER TABLE `favs_pelicula`
  ADD CONSTRAINT `favs_pelicula_ibfk_1` FOREIGN KEY (`Rol_user`) REFERENCES `usuarios` (`Rol_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favs_pelicula_ibfk_2` FOREIGN KEY (`Id_pelicula`) REFERENCES `peliculas` (`Id_pelicula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `generos_anime`
--
ALTER TABLE `generos_anime`
  ADD CONSTRAINT `generos_anime_ibfk_1` FOREIGN KEY (`Id_anime`) REFERENCES `animes` (`Id_anime`);

--
-- Constraints for table `generos_pelicula`
--
ALTER TABLE `generos_pelicula`
  ADD CONSTRAINT `generos_pelicula_ibfk_1` FOREIGN KEY (`Id_pelicula`) REFERENCES `peliculas` (`Id_pelicula`);

--
-- Constraints for table `historial_anime`
--
ALTER TABLE `historial_anime`
  ADD CONSTRAINT `historial_anime_ibfk_1` FOREIGN KEY (`Rol_user`) REFERENCES `usuarios` (`Rol_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `historial_anime_ibfk_2` FOREIGN KEY (`Id_anime`) REFERENCES `animes` (`Id_anime`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `historial_pelicula`
--
ALTER TABLE `historial_pelicula`
  ADD CONSTRAINT `historial_pelicula_ibfk_1` FOREIGN KEY (`Rol_user`) REFERENCES `usuarios` (`Rol_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `historial_pelicula_ibfk_2` FOREIGN KEY (`Id_pelicula`) REFERENCES `peliculas` (`Id_pelicula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `opiniones_anime`
--
ALTER TABLE `opiniones_anime`
  ADD CONSTRAINT `opiniones_anime_ibfk_1` FOREIGN KEY (`Rol_user`) REFERENCES `usuarios` (`Rol_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `opiniones_anime_ibfk_2` FOREIGN KEY (`Id_anime`) REFERENCES `animes` (`Id_anime`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `opiniones_pelicula`
--
ALTER TABLE `opiniones_pelicula`
  ADD CONSTRAINT `opiniones_pelicula_ibfk_1` FOREIGN KEY (`Rol_user`) REFERENCES `usuarios` (`Rol_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `opiniones_pelicula_ibfk_2` FOREIGN KEY (`Id_pelicula`) REFERENCES `peliculas` (`Id_pelicula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `seguidores`
--
ALTER TABLE `seguidores`
  ADD CONSTRAINT `seguidores_ibfk_1` FOREIGN KEY (`Rol_user`) REFERENCES `usuarios` (`Rol_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `valo_anime`
--
ALTER TABLE `valo_anime`
  ADD CONSTRAINT `valo_anime_ibfk_1` FOREIGN KEY (`Rol_user`) REFERENCES `usuarios` (`Rol_user`),
  ADD CONSTRAINT `valo_anime_ibfk_2` FOREIGN KEY (`Id_anime`) REFERENCES `animes` (`Id_anime`);

--
-- Constraints for table `valo_pelicula`
--
ALTER TABLE `valo_pelicula`
  ADD CONSTRAINT `valo_pelicula_ibfk_1` FOREIGN KEY (`Rol_user`) REFERENCES `usuarios` (`Rol_user`),
  ADD CONSTRAINT `valo_pelicula_ibfk_2` FOREIGN KEY (`Id_pelicula`) REFERENCES `peliculas` (`Id_pelicula`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
