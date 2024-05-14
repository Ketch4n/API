-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 26, 2024 at 03:58 AM
-- Server version: 10.11.7-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u880981518_attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `absent`
--

CREATE TABLE `absent` (
  `id` int(11) NOT NULL,
  `student_id` int(255) NOT NULL,
  `section_id` int(255) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `reason` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `accomplishment`
--

CREATE TABLE `accomplishment` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `section_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accomplishment`
--

INSERT INTO `accomplishment` (`id`, `email`, `section_id`, `comment`, `date`, `time`) VALUES
(1, 'fevelyn.daypuyat@nmsc.edu.ph', 23, 'write your comment', '2024-04-25', '10:12:31');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `fname`, `lname`, `role`, `password`) VALUES
(16, 'superadmin@gmail.com', 'Super Administrator', 'Account', 'NMSCST', '$2y$10$6VeRuVMV7K5ROEcF9LGljOYe8vshtWVg6nGy1tMaP0pdr0Cso3hy6'),
(25, 'jorenaisa.maestrado@nmsc.edu.ph', 'Jorenaisa', 'Maestrado', 'Administrator', '$2y$10$/xq.q7p742rUYzaGIguLP.ywA2r5BbIbQy5tzD09RHheXJqqWQi3.');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(255) NOT NULL,
  `section_id` int(255) NOT NULL,
  `student_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dtr`
--

CREATE TABLE `dtr` (
  `id` int(255) NOT NULL,
  `student_id` int(255) NOT NULL,
  `estab_id` int(255) NOT NULL,
  `time_in_am` time NOT NULL,
  `in_am_lat` varchar(255) NOT NULL,
  `in_am_long` varchar(255) NOT NULL,
  `time_out_am` time NOT NULL,
  `out_am_lat` varchar(255) NOT NULL,
  `out_am_long` varchar(255) NOT NULL,
  `time_in_pm` time NOT NULL,
  `in_pm_lat` varchar(255) NOT NULL,
  `in_pm_long` varchar(255) NOT NULL,
  `time_out_pm` time NOT NULL,
  `out_pm_lat` varchar(255) NOT NULL,
  `out_pm_long` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `establishment`
--

CREATE TABLE `establishment` (
  `id` int(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `establishment_name` varchar(255) NOT NULL,
  `creator_email` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `hours_required` time NOT NULL,
  `radius` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `establishment`
--

INSERT INTO `establishment` (`id`, `code`, `establishment_name`, `creator_email`, `latitude`, `longitude`, `location`, `hours_required`, `radius`, `status`) VALUES
(23, 'Ik3Vr7', 'CICT', 'jorenaisa.maestrado@nmsc.edu.ph', '8.057665737869296', '123.72178316116333', 'Tangub City, Misamis Occidental', '345:00:00', '5', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `face_id`
--

CREATE TABLE `face_id` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `model_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `face_id`
--

INSERT INTO `face_id` (`id`, `user`, `password`, `model_data`) VALUES
(15, 'fevelyn.daypuyat@nmsc.edu.ph', '2019-80188', '[-0.007943704724311829,-0.00224033510312438,0.003390462603420019,0.007249616552144289,-0.0068046459928154945,0.05854419618844986,-0.07669948041439056,-0.16212347149848938,0.009930386207997799,0.15913748741149902,0.0009141007321886718,-0.0017872058087959886,0.004211737774312496,-0.019626250490546227,-0.005798970349133015,-0.09303045272827148,-0.006867796648293734,0.001949888188391924,0.008006279356777668,0.002685065846890211,-0.07719504088163376,0.08271154761314392,-0.0432673878967762,0.003496589371934533,-0.04519660770893097,0.0007391452672891319,-0.0030366491992026567,0.10813523828983307,0.037733081728219986,-0.35371193289756775,0.00600222684442997,-0.033326175063848495,-0.05053113400936127,-0.004095828160643578,-0.03041299246251583,-0.041814714670181274,-0.0838225856423378,-0.011233090423047543,-0.006140397861599922,0.20820704102516174,0.0013480734778568149,0.0008696220465935767,-0.002209935337305069,-0.0029519323725253344,0.0026895056944340467,-0.01634262688457966,-0.13721983134746552,0.02308805100619793,-0.010634451173245907,0.014049847610294819,-0.06251252442598343,-0.0035386316012591124,-0.13348537683486938,-0.001108373748138547,-0.0765429437160492,0.0028076153248548508,0.11787997931241989,0.002215079963207245,-0.008890482597053051,-0.000422969285864383,0.019108781591057777,0.008577696979045868,-0.03963983803987503,0.23724029958248138,-0.010190488770604134,0.17630574107170105,-0.0007569955778308213,-0.017174163833260536,0.0010484574595466256,-0.0023928883019834757,-0.007356158923357725,-0.312259703874588,-0.056737493723630905,-0.00793448556214571,0.04578534513711929,0.0027357805520296097,-0.00867658481001854,-0.0032942229881882668,-0.10813723504543304,-0.06741950660943985,0.0016223265556618571,-0.11584436893463135,-0.007152003701776266,0.07294046878814697,0.011088482104241848,0.002688406500965357,0.004725657403469086,-0.06887927651405334,0.00808481965214014,0.07942543178796768,-0.24407711625099182,0.015490788966417313,-0.002145615639165044,-0.008964995853602886,0.14649765193462372,-0.018743710592389107,-0.13255392014980316,0.13354399800300598,0.0022731400094926357,-0.007619771640747786,0.006106102839112282,-0.0006370818591676652,-0.010880115441977978,0.0047487677074968815,-0.004495782312005758,-0.0001796252909116447,-0.02345244027674198,0.0019556451588869095,0.012229464948177338,0.012771854177117348,0.03974483907222748,-0.003464252222329378,-0.0028254950884729624,0.12792539596557617,-0.004508781246840954,-0.14745169878005981,0.023464495316147804,0.0007451580604538321,0.19078415632247925,-0.0465255007147789,-0.17022110521793365,0.03854743018746376,0.17980363965034485,-0.0036355790216475725,-0.0016284818993881345,0.0001314835826633498,0.008644022978842258,-0.002955779666081071,0.004773493856191635,0.14541879296302795,0.0040113008581101894,0.00455796904861927,0.0026788446120917797,0.04725877195596695,-0.000702346209436655,-0.0007402910268865526,-0.04934971034526825,0.05536351725459099,-0.012884448282420635,-0.008532734587788582,0.0022827116772532463,0.0057595595717430115,0.0035811036359518766,-0.18927156925201416,-0.07616251707077026,0.1198858991265297,-0.008826000615954399,-0.0005650541861541569,0.002364019863307476,0.003793977666646242,-0.00819593109190464,0.12956248223781586,0.006125866435468197,-0.015430230647325516,0.005908063612878323,0.009192245081067085,-0.004720618017017841,-0.0014579420676454902,0.00685453973710537,0.00022837799042463303,0.008562986738979816,0.008753951638936996,-0.0017537317471578717,-0.007592353038489819,0.003095407271757722,0.0025077415630221367,0.005989355500787497,0.07039760798215866,0.001601007767021656,0.006402233149856329,0.0653165802359581,0.025788577273488045,-0.0013298295671120286,0.02350441738963127,0.03275278955698013,-0.004687987733632326,0.11277943104505539,-0.027444396167993546,0.0018829108448699117,-0.0026834586169570684,-0.07172678411006927,0.06669600307941437,0.012498220428824425,-0.003588962135836482,0.008734367787837982,-0.02563694305717945,0.12467282265424728,-0.006028690841048956,0.04683921858668327,0.025290898978710175,-0.011856122873723507,-0.0041251289658248425]');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(255) NOT NULL,
  `establishment_id` int(255) NOT NULL,
  `student_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `establishment_id`, `student_id`) VALUES
(9, 23, 15);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` int(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `section_name` varchar(255) NOT NULL,
  `admin_id` int(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `bday` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `fname`, `lname`, `uid`, `bday`, `address`, `section`, `role`, `password`) VALUES
(15, 'fevelyn.daypuyat@nmsc.edu.ph', 'Fevelyn', 'Daypuyat', '12', '2023-12-19', 'Gumbil,Tudela', 'A', 'Intern', '$2y$10$VT9HtAKU1vAEqfkvPtD3ReZJbvLMLFdJaR/QKGZhilv84F42HzXD2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absent`
--
ALTER TABLE `absent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accomplishment`
--
ALTER TABLE `accomplishment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dtr`
--
ALTER TABLE `dtr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `establishment`
--
ALTER TABLE `establishment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `face_id`
--
ALTER TABLE `face_id`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absent`
--
ALTER TABLE `absent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `accomplishment`
--
ALTER TABLE `accomplishment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dtr`
--
ALTER TABLE `dtr`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `establishment`
--
ALTER TABLE `establishment`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `face_id`
--
ALTER TABLE `face_id`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
