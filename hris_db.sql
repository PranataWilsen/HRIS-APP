-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Waktu pembuatan: 17 Sep 2025 pada 04.56
-- Versi server: 8.0.40
-- Versi PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hris_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `answers`
--

CREATE TABLE `answers` (
  `id` int NOT NULL,
  `questionid` int NOT NULL,
  `text` varchar(300) NOT NULL,
  `isanswer` int DEFAULT '0' COMMENT '1=Yes, 0=No',
  `active` int DEFAULT '1' COMMENT '1=Aktif, 2=Non Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `answers`
--

INSERT INTO `answers` (`id`, `questionid`, `text`, `isanswer`, `active`) VALUES
(1, 1, '2', 0, 1),
(2, 1, '3', 0, 1),
(3, 1, '1', 1, 1),
(4, 1, '4', 0, 1),
(5, 2, 'Sendok', 1, 1),
(6, 2, 'Garpu', 1, 1),
(7, 2, 'Keyboard', 0, 1),
(8, 2, 'Piring', 1, 1),
(9, 2, 'Dompet', 0, 1),
(10, 2, 'Mouse', 0, 1),
(11, 4, 'Sendok', 0, 1),
(12, 4, 'Garpu', 0, 1),
(13, 4, 'Keyboard', 1, 1),
(14, 4, 'Piring', 0, 1),
(15, 4, 'Dompet', 0, 1),
(16, 4, 'Mouse', 1, 1),
(17, 3, 'Kulkas', 0, 1),
(18, 3, 'Pensil', 1, 1),
(19, 3, 'Piring', 0, 1),
(20, 3, 'Penghapus', 1, 1),
(21, 3, 'Bolpoin', 1, 1),
(22, 5, 'Motor', 1, 1),
(23, 5, 'Kapal', 0, 1),
(24, 5, 'Pesawat', 0, 1),
(25, 5, 'Mobil', 1, 1),
(26, 5, 'Jetski', 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `departemen`
--

CREATE TABLE `departemen` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `active` int DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `departemen`
--

INSERT INTO `departemen` (`id`, `name`, `active`) VALUES
(1, 'HR', 1),
(2, 'IT', 1),
(3, 'FACTORY', 1),
(4, 'AUDIT', 1),
(5, 'SALES', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_jawaban_pegawai`
--

CREATE TABLE `detail_jawaban_pegawai` (
  `id` int NOT NULL,
  `jawabanpegawaiid` int NOT NULL,
  `questionid` int NOT NULL,
  `answer` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `detail_jawaban_pegawai`
--

INSERT INTO `detail_jawaban_pegawai` (`id`, `jawabanpegawaiid`, `questionid`, `answer`) VALUES
(1, 1, 1, '3'),
(2, 1, 2, '5,6,7'),
(3, 1, 3, '18,20,21'),
(4, 1, 4, '13,16'),
(5, 1, 5, '22'),
(6, 2, 1, '3'),
(7, 2, 2, '5,6,8'),
(8, 2, 3, '18,20,21'),
(9, 2, 4, '13,16'),
(10, 2, 5, '22,25'),
(11, 3, 1, '3'),
(12, 3, 2, '5,6,7'),
(13, 3, 3, '18,20,21'),
(14, 3, 4, '13,16'),
(15, 3, 5, '22'),
(16, 4, 1, '3'),
(17, 4, 2, '5,6,7'),
(18, 4, 3, '18,20,21'),
(19, 4, 4, '13,16'),
(20, 4, 5, '22'),
(21, 5, 1, '3'),
(22, 5, 2, '5,6,8'),
(23, 5, 3, '18,20,21'),
(24, 5, 4, '13,16'),
(25, 5, 5, '22,25'),
(26, 6, 1, '4'),
(27, 6, 2, '6,8'),
(28, 6, 3, '18,20,21'),
(29, 6, 4, '14,15'),
(30, 6, 5, '22,25'),
(31, 7, 1, '3'),
(32, 7, 2, '5,6,7'),
(33, 7, 3, '18,20,21'),
(34, 7, 4, '13,16'),
(35, 7, 5, '22'),
(36, 8, 1, '3'),
(37, 8, 2, '5,6,8'),
(38, 8, 3, '18,20,21'),
(39, 8, 4, '13,16'),
(40, 8, 5, '22,25'),
(41, 9, 1, '4'),
(42, 9, 2, '6,8'),
(43, 9, 3, '18,20,21'),
(44, 9, 4, '14,15'),
(45, 9, 5, '22,25'),
(46, 10, 1, '3'),
(47, 10, 2, '5,6,8'),
(48, 10, 3, '18,20,21'),
(49, 10, 4, '13,16'),
(50, 10, 5, '22,25'),
(51, 11, 1, '3'),
(52, 11, 2, '5,6,7'),
(53, 11, 3, '18,20,21'),
(54, 11, 4, '13,16'),
(55, 11, 5, '22'),
(56, 12, 1, '3'),
(57, 12, 2, '5,6,8'),
(58, 12, 3, '18,20,21'),
(59, 12, 4, '13,16'),
(60, 12, 5, '22,25'),
(61, 13, 1, '3'),
(62, 13, 2, '5,6,7'),
(63, 13, 3, '18,20,21'),
(64, 13, 4, '13,16'),
(65, 13, 5, '22'),
(66, 14, 1, '3'),
(67, 14, 2, '5,6,8'),
(68, 14, 3, '18,20,21'),
(69, 14, 4, '13,16'),
(70, 14, 5, '22,25'),
(71, 15, 1, '3'),
(72, 15, 2, '5,6,7'),
(73, 15, 3, '18,20,21'),
(74, 15, 4, '13,16'),
(75, 15, 5, '22'),
(76, 16, 1, '3'),
(77, 16, 2, '5,6,7'),
(78, 16, 3, '18,20,21'),
(79, 16, 4, '13,16'),
(80, 16, 5, '22'),
(81, 17, 1, '3'),
(82, 17, 2, '5,6,8'),
(83, 17, 3, '18,20,21'),
(84, 17, 4, '13,16'),
(85, 17, 5, '22,25'),
(86, 18, 1, '1'),
(87, 18, 2, '5,6,8'),
(88, 18, 3, '18,20,21'),
(89, 18, 4, '13,16'),
(90, 18, 5, '23,26'),
(91, 19, 1, '3'),
(92, 19, 2, '5,6,8'),
(93, 19, 3, '18,20,21'),
(94, 19, 4, '13,16'),
(95, 19, 5, '22,25'),
(96, 20, 1, '3'),
(97, 20, 2, '5,6,8'),
(98, 20, 3, '18,20,21'),
(99, 20, 4, '13,16'),
(100, 20, 5, '22,25'),
(101, 21, 1, '3'),
(102, 21, 2, '5,6,8'),
(103, 21, 3, '18,20,21'),
(104, 21, 4, '13,16'),
(105, 21, 5, '22,25'),
(106, 22, 1, '3'),
(107, 22, 2, '5,6,8'),
(108, 22, 3, '18,20,21'),
(109, 22, 4, '13,16'),
(110, 22, 5, '22,25'),
(111, 23, 1, '3'),
(112, 23, 2, '5,6,7'),
(113, 23, 3, '18,20,21'),
(114, 23, 4, '13,16'),
(115, 23, 5, '22'),
(116, 24, 1, '3'),
(117, 24, 2, '5,6,8'),
(118, 24, 3, '18,20,21'),
(119, 24, 4, '13,16'),
(120, 24, 5, '22,25'),
(121, 25, 1, '1'),
(122, 25, 2, '5,6,8'),
(123, 25, 3, '18,20,21'),
(124, 25, 4, '13,16'),
(125, 25, 5, '23,26'),
(126, 26, 1, '3'),
(127, 26, 2, '5,6,8'),
(128, 26, 3, '18,20,21'),
(129, 26, 4, '13,16'),
(130, 26, 5, '22,25'),
(131, 27, 1, '1'),
(132, 27, 2, '5,6,8'),
(133, 27, 3, '18,20,21'),
(134, 27, 4, '13,16'),
(135, 27, 5, '23,26'),
(136, 28, 1, '3'),
(137, 28, 2, '5,6,7'),
(138, 28, 3, '18,20,21'),
(139, 28, 4, '13,16'),
(140, 28, 5, '22'),
(141, 29, 1, '3'),
(142, 29, 2, '5,6,8'),
(143, 29, 3, '18,20,21'),
(144, 29, 4, '13,16'),
(145, 29, 5, '22,25'),
(146, 30, 1, '3'),
(147, 30, 2, '5,6,7'),
(148, 30, 3, '18,20,21'),
(149, 30, 4, '13,16'),
(150, 30, 5, '22'),
(151, 31, 1, '1'),
(152, 31, 2, '5,6,8'),
(153, 31, 3, '18,20,21'),
(154, 31, 4, '13,16'),
(155, 31, 5, '23,26'),
(156, 32, 1, '3'),
(157, 32, 2, '5,6,8'),
(158, 32, 3, '18,20,21'),
(159, 32, 4, '13,16'),
(160, 32, 5, '22,25'),
(161, 33, 1, '3'),
(162, 33, 2, '5,6,7'),
(163, 33, 3, '18,20,21'),
(164, 33, 4, '13,16'),
(165, 33, 5, '22'),
(166, 34, 1, '3'),
(167, 34, 2, '5,6,7'),
(168, 34, 3, '18,20,21'),
(169, 34, 4, '13,16'),
(170, 34, 5, '22'),
(171, 35, 1, '3'),
(172, 35, 2, '5,6,8'),
(173, 35, 3, '18,20,21'),
(174, 35, 4, '13,16'),
(175, 35, 5, '22,25'),
(176, 36, 1, '3'),
(177, 36, 2, '5,6,7'),
(178, 36, 3, '18,20,21'),
(179, 36, 4, '13,16'),
(180, 36, 5, '22'),
(181, 37, 1, '3'),
(182, 37, 2, '5,6,8'),
(183, 37, 3, '18,20,21'),
(184, 37, 4, '13,16'),
(185, 37, 5, '22,25'),
(186, 38, 1, '4'),
(187, 38, 2, '6,8'),
(188, 38, 3, '18,20,21'),
(189, 38, 4, '14,15'),
(190, 38, 5, '22,25'),
(191, 39, 1, '3'),
(192, 39, 2, '5,6,8'),
(193, 39, 3, '18,20,21'),
(194, 39, 4, '13,16'),
(195, 39, 5, '22,25'),
(196, 40, 1, '3'),
(197, 40, 2, '5,6,7'),
(198, 40, 3, '18,20,21'),
(199, 40, 4, '13,16'),
(200, 40, 5, '22'),
(201, 41, 1, '3'),
(202, 41, 2, '5,6,7'),
(203, 41, 3, '18,20,21'),
(204, 41, 4, '13,16'),
(205, 41, 5, '22'),
(206, 42, 1, '3'),
(207, 42, 2, '5,6,8'),
(208, 42, 3, '18,20,21'),
(209, 42, 4, '13,16'),
(210, 42, 5, '22,25'),
(211, 43, 1, '3'),
(212, 43, 2, '5,6,7'),
(213, 43, 3, '18,20,21'),
(214, 43, 4, '13,16'),
(215, 43, 5, '22'),
(216, 44, 1, '3'),
(217, 44, 2, '5,6,7'),
(218, 44, 3, '18,20,21'),
(219, 44, 4, '13,16'),
(220, 44, 5, '22'),
(221, 45, 1, '3'),
(222, 45, 2, '5,6,8'),
(223, 45, 3, '18,20,21'),
(224, 45, 4, '13,16'),
(225, 45, 5, '22,25'),
(226, 46, 1, '3'),
(227, 46, 2, '5,6,7'),
(228, 46, 3, '18,20,21'),
(229, 46, 4, '13,16'),
(230, 46, 5, '22'),
(231, 47, 1, '4'),
(232, 47, 2, '6,8'),
(233, 47, 3, '18,20,21'),
(234, 47, 4, '14,15'),
(235, 47, 5, '22,25'),
(236, 48, 1, '3'),
(237, 48, 2, '5,6,8'),
(238, 48, 3, '18,20,21'),
(239, 48, 4, '13,16'),
(240, 48, 5, '22,25'),
(241, 49, 1, '3'),
(242, 49, 2, '5,6,7'),
(243, 49, 3, '18,20,21'),
(244, 49, 4, '13,16'),
(245, 49, 5, '22'),
(246, 50, 1, '3'),
(247, 50, 2, '5,6,7'),
(248, 50, 3, '18,20,21'),
(249, 50, 4, '13,16'),
(250, 50, 5, '22'),
(251, 51, 1, '3'),
(252, 51, 2, '5,6,8'),
(253, 51, 3, '18,20,21'),
(254, 51, 4, '13,16'),
(255, 51, 5, '22,25'),
(256, 52, 1, '3'),
(257, 52, 2, '5,6,7'),
(258, 52, 3, '18,20,21'),
(259, 52, 4, '13,16'),
(260, 52, 5, '22'),
(261, 53, 1, '3'),
(262, 53, 2, '5,6,8'),
(263, 53, 3, '18,20,21'),
(264, 53, 4, '13,16'),
(265, 53, 5, '22,25'),
(266, 54, 1, '1'),
(267, 54, 2, '5,6,8'),
(268, 54, 3, '18,20,21'),
(269, 54, 4, '13,16'),
(270, 54, 5, '23,26'),
(271, 55, 1, '3'),
(272, 55, 2, '5,6,8'),
(273, 55, 3, '18,20,21'),
(274, 55, 4, '13,16'),
(275, 55, 5, '22,25'),
(276, 56, 1, '3'),
(277, 56, 2, '5,6,7'),
(278, 56, 3, '18,20,21'),
(279, 56, 4, '13,16'),
(280, 56, 5, '22'),
(281, 57, 1, '3'),
(282, 57, 2, '5,6,8'),
(283, 57, 3, '18,20,21'),
(284, 57, 4, '13,16'),
(285, 57, 5, '22,25'),
(286, 58, 1, '1'),
(287, 58, 2, '5,6,8'),
(288, 58, 3, '18,20,21'),
(289, 58, 4, '13,16'),
(290, 58, 5, '23,26'),
(291, 59, 1, '1'),
(292, 59, 2, '5,6,8'),
(293, 59, 3, '18,20,21'),
(294, 59, 4, '13,16'),
(295, 59, 5, '23,26'),
(296, 60, 1, '3'),
(297, 60, 2, '5,6,8'),
(298, 60, 3, '18,20,21'),
(299, 60, 4, '13,16'),
(300, 60, 5, '22,25'),
(301, 61, 1, '3'),
(302, 61, 2, '5,6,7'),
(303, 61, 3, '18,20,21'),
(304, 61, 4, '13,16'),
(305, 61, 5, '22'),
(306, 62, 1, '3'),
(307, 62, 2, '5,6,8'),
(308, 62, 3, '18,20,21'),
(309, 62, 4, '13,16'),
(310, 62, 5, '22,25'),
(311, 63, 1, '3'),
(312, 63, 2, '5,6,8'),
(313, 63, 3, '18,20,21'),
(314, 63, 4, '13,16'),
(315, 63, 5, '22,25'),
(316, 64, 1, '3'),
(317, 64, 2, '5,6,8'),
(318, 64, 3, '18,20,21'),
(319, 64, 4, '13,16'),
(320, 64, 5, '22,25'),
(321, 65, 1, '3'),
(322, 65, 2, '5,6,8'),
(323, 65, 3, '18,20,21'),
(324, 65, 4, '13,16'),
(325, 65, 5, '22,25'),
(326, 66, 1, '3'),
(327, 66, 2, '5,6,7'),
(328, 66, 3, '18,20,21'),
(329, 66, 4, '13,16'),
(330, 66, 5, '22'),
(331, 67, 1, '3'),
(332, 67, 2, '5,6,8'),
(333, 67, 3, '18,20,21'),
(334, 67, 4, '13,16'),
(335, 67, 5, '22,25'),
(336, 68, 1, '3'),
(337, 68, 2, '5,6,7'),
(338, 68, 3, '18,20,21'),
(339, 68, 4, '13,16'),
(340, 68, 5, '22'),
(341, 69, 1, '3'),
(342, 69, 2, '5,6,7'),
(343, 69, 3, '18,20,21'),
(344, 69, 4, '13,16'),
(345, 69, 5, '22'),
(346, 70, 1, '3'),
(347, 70, 2, '5,6,8'),
(348, 70, 3, '18,20,21'),
(349, 70, 4, '13,16'),
(350, 70, 5, '22,25'),
(351, 71, 1, '4'),
(352, 71, 2, '6,8'),
(353, 71, 3, '18,20,21'),
(354, 71, 4, '14,15'),
(355, 71, 5, '22,25'),
(356, 72, 1, '3'),
(357, 72, 2, '5,6,7'),
(358, 72, 3, '18,20,21'),
(359, 72, 4, '13,16'),
(360, 72, 5, '22'),
(361, 73, 1, '3'),
(362, 73, 2, '5,6,8'),
(363, 73, 3, '18,20,21'),
(364, 73, 4, '13,16'),
(365, 73, 5, '22,25'),
(366, 74, 1, '3'),
(367, 74, 2, '5,6,7'),
(368, 74, 3, '18,20,21'),
(369, 74, 4, '13,16'),
(370, 74, 5, '22'),
(371, 75, 1, '4'),
(372, 75, 2, '6,8'),
(373, 75, 3, '18,20,21'),
(374, 75, 4, '14,15'),
(375, 75, 5, '22,25'),
(376, 76, 1, '3'),
(377, 76, 2, '5,6,8'),
(378, 76, 3, '18,20,21'),
(379, 76, 4, '13,16'),
(380, 76, 5, '22,25'),
(381, 77, 1, '3'),
(382, 77, 2, '5,6,7'),
(383, 77, 3, '18,20,21'),
(384, 77, 4, '13,16'),
(385, 77, 5, '22'),
(386, 78, 1, '3'),
(387, 78, 2, '5,6,8'),
(388, 78, 3, '18,20,21'),
(389, 78, 4, '13,16'),
(390, 78, 5, '22,25'),
(391, 79, 1, '4'),
(392, 79, 2, '6,8'),
(393, 79, 3, '18,20,21'),
(394, 79, 4, '14,15'),
(395, 79, 5, '22,25'),
(396, 80, 1, '3'),
(397, 80, 2, '5,6,8'),
(398, 80, 3, '18,20,21'),
(399, 80, 4, '13,16'),
(400, 80, 5, '22,25'),
(401, 81, 1, '3'),
(402, 81, 2, '5,6,8'),
(403, 81, 3, '18,20,21'),
(404, 81, 4, '13,16'),
(405, 81, 5, '22,25'),
(406, 82, 1, '3'),
(407, 82, 2, '5,6,8'),
(408, 82, 3, '18,20,21'),
(409, 82, 4, '13,16'),
(410, 82, 5, '22,25'),
(411, 83, 1, '4'),
(412, 83, 2, '6,8'),
(413, 83, 3, '18,20,21'),
(414, 83, 4, '14,15'),
(415, 83, 5, '22,25'),
(416, 84, 1, '3'),
(417, 84, 2, '5,6,7'),
(418, 84, 3, '18,20,21'),
(419, 84, 4, '13,16'),
(420, 84, 5, '22'),
(421, 85, 1, '3'),
(422, 85, 2, '5,6,8'),
(423, 85, 3, '18,20,21'),
(424, 85, 4, '13,16'),
(425, 85, 5, '22,25'),
(426, 86, 1, '3'),
(427, 86, 2, '5,6,7'),
(428, 86, 3, '18,20,21'),
(429, 86, 4, '13,16'),
(430, 86, 5, '22'),
(431, 87, 1, '3'),
(432, 87, 2, '5,6,8'),
(433, 87, 3, '18,20,21'),
(434, 87, 4, '13,16'),
(435, 87, 5, '22,25'),
(436, 88, 1, '3'),
(437, 88, 2, '5,6,8'),
(438, 88, 3, '18,20,21'),
(439, 88, 4, '13,16'),
(440, 88, 5, '22,25'),
(441, 89, 1, '3'),
(442, 89, 2, '5,6,8'),
(443, 89, 3, '18,20,21'),
(444, 89, 4, '13,16'),
(445, 89, 5, '22,25'),
(446, 90, 1, '3'),
(447, 90, 2, '5,6,8'),
(448, 90, 3, '18,20,21'),
(449, 90, 4, '13,16'),
(450, 90, 5, '22,25'),
(451, 91, 1, '4'),
(452, 91, 2, '6,8'),
(453, 91, 3, '18,20,21'),
(454, 91, 4, '14,15'),
(455, 91, 5, '22,25'),
(456, 92, 1, '3'),
(457, 92, 2, '5,6,8'),
(458, 92, 3, '18,20,21'),
(459, 92, 4, '13,16'),
(460, 92, 5, '22,25'),
(461, 93, 1, '4'),
(462, 93, 2, '6,8'),
(463, 93, 3, '18,20,21'),
(464, 93, 4, '14,15'),
(465, 93, 5, '22,25'),
(466, 94, 1, '3'),
(467, 94, 2, '5,6,8'),
(468, 94, 3, '18,20,21'),
(469, 94, 4, '13,16'),
(470, 94, 5, '22,25'),
(471, 95, 1, '3'),
(472, 95, 2, '5,6,8'),
(473, 95, 3, '18,20,21'),
(474, 95, 4, '13,16'),
(475, 95, 5, '22,25'),
(476, 96, 2, '5,6,8'),
(477, 96, 3, '18,20,21'),
(478, 96, 4, '13,16'),
(479, 96, 5, '22,25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban_pegawai`
--

CREATE TABLE `jawaban_pegawai` (
  `id` int NOT NULL,
  `pegawaiid` int NOT NULL,
  `active` int NOT NULL COMMENT '1: Active, 0: Non Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `jawaban_pegawai`
--

INSERT INTO `jawaban_pegawai` (`id`, `pegawaiid`, `active`) VALUES
(1, 52, 1),
(2, 32, 1),
(3, 12, 1),
(4, 47, 1),
(5, 11, 1),
(6, 95, 1),
(7, 81, 1),
(8, 3, 1),
(9, 63, 1),
(10, 17, 1),
(11, 77, 1),
(12, 69, 1),
(13, 83, 1),
(14, 56, 1),
(15, 22, 1),
(16, 6, 1),
(17, 5, 1),
(18, 51, 1),
(19, 54, 1),
(20, 20, 1),
(21, 13, 1),
(22, 92, 1),
(23, 40, 1),
(24, 61, 1),
(25, 24, 1),
(26, 58, 1),
(27, 33, 1),
(28, 26, 1),
(29, 82, 1),
(30, 19, 1),
(31, 1, 1),
(32, 44, 1),
(33, 28, 1),
(34, 70, 1),
(35, 53, 1),
(36, 21, 1),
(37, 50, 1),
(38, 8, 1),
(39, 86, 1),
(40, 7, 1),
(41, 67, 1),
(42, 85, 1),
(43, 59, 1),
(44, 62, 1),
(45, 90, 1),
(46, 41, 1),
(47, 43, 1),
(48, 27, 1),
(49, 18, 1),
(50, 80, 1),
(51, 37, 1),
(52, 16, 1),
(53, 66, 1),
(54, 14, 1),
(55, 76, 1),
(56, 78, 1),
(57, 46, 1),
(58, 57, 1),
(59, 87, 1),
(60, 64, 1),
(61, 91, 1),
(62, 4, 1),
(63, 79, 1),
(64, 55, 1),
(65, 88, 1),
(66, 93, 1),
(67, 94, 1),
(68, 68, 1),
(69, 42, 1),
(70, 10, 1),
(71, 72, 1),
(72, 31, 1),
(73, 2, 1),
(74, 9, 1),
(75, 84, 1),
(76, 25, 1),
(77, 34, 1),
(78, 71, 1),
(79, 39, 1),
(80, 48, 1),
(81, 45, 1),
(82, 89, 1),
(83, 30, 1),
(84, 74, 1),
(85, 65, 1),
(86, 15, 1),
(87, 75, 1),
(88, 36, 1),
(89, 60, 1),
(90, 29, 1),
(91, 96, 1),
(92, 35, 1),
(93, 38, 1),
(94, 23, 1),
(95, 73, 1),
(96, 49, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `keahlian`
--

CREATE TABLE `keahlian` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `active` int DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `keahlian`
--

INSERT INTO `keahlian` (`id`, `name`, `active`) VALUES
(1, 'Excel', 1),
(2, 'PHP', 1),
(3, 'Mysql', 1),
(4, 'Oracle', 1),
(5, 'Node js', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2025-09-16-033332', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1757993705, 1),
(2, '2025-09-16-100000', 'App\\Database\\Migrations\\CreateDepartments', 'default', 'App', 1758007659, 2),
(3, '2025-09-16-100100', 'App\\Database\\Migrations\\CreatePositions', 'default', 'App', 1758007659, 2),
(4, '2025-09-16-100200', 'App\\Database\\Migrations\\CreateEmployees', 'default', 'App', 1758007659, 2),
(5, '2025-09-16-100300', 'App\\Database\\Migrations\\CreateDetailJawabanPegawai', 'default', 'App', 1758007659, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` varchar(1) NOT NULL COMMENT 'W=Wanita, P=Pria',
  `departemenid` int NOT NULL,
  `address` varchar(200) NOT NULL,
  `keahlian` varchar(100) NOT NULL COMMENT 'Simpan ID keahlian, misalnya 1,2,3',
  `active` int DEFAULT '1' COMMENT '1=Aktif, 0=Non Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id`, `name`, `gender`, `departemenid`, `address`, `keahlian`, `active`) VALUES
(1, 'Agus', 'P', 1, 'Jl mana saja 1', '1,3,5', 1),
(2, 'Bambang', 'P', 2, 'Jl mana saja 2', '2,1,5', 1),
(3, 'Bayu', 'P', 3, 'Jl mana saja 3', '1,4,5', 1),
(4, 'Budi', 'P', 4, 'Jl mana saja 4', '3,1', 1),
(5, 'Basuki', 'P', 5, 'Jl mana saja 5', '1,4', 1),
(6, 'Dani', 'P', 1, 'Jl mana saja 6', '1,4', 1),
(7, 'Dedi', 'P', 3, 'Jl mana saja 7', '1,3', 1),
(8, 'Eko', 'P', 4, 'Jl mana saja 8', '2,5,5', 1),
(9, 'Faisal', 'P', 1, 'Jl mana saja 9', '2,3', 1),
(10, 'Guntur', 'P', 4, 'Jl mana saja 10', '2,3', 1),
(11, 'Heri', 'P', 4, 'Jl mana saja 11', '2,3,5', 1),
(12, 'Hendra', 'P', 3, 'Jl mana saja 12', '5,3', 1),
(13, 'Irfan', 'P', 3, 'Jl mana saja 13', '2,3', 1),
(14, 'Ivan', 'P', 3, 'Jl mana saja 14', '4,2', 1),
(15, 'Joko', 'P', 5, 'Jl mana saja 15', '2,3', 1),
(16, 'Joni', 'P', 2, 'Jl mana saja 16', '5,3,5', 1),
(17, 'Kemal', 'P', 3, 'Jl mana saja 17', '2,4', 1),
(18, 'Kevin', 'P', 3, 'Jl mana saja 18', '3,1,5', 1),
(19, 'Lukman', 'P', 4, 'Jl mana saja 19', '2,4,5', 1),
(20, 'Mochammad', 'P', 2, 'Jl mana saja 20', '5,2,5', 1),
(21, 'Panji', 'P', 1, 'Jl mana saja 21', '2,4,5', 1),
(22, 'Putra', 'P', 4, 'Jl mana saja 22', '4,2,5', 1),
(23, 'Rafi', 'P', 3, 'Jl mana saja 23', '2,3,5', 1),
(24, 'Rahmat', 'P', 3, 'Jl mana saja 24', '5,3,5', 1),
(25, 'Rian', 'P', 5, 'Jl mana saja 25', '1,4', 1),
(26, 'Rizal', 'P', 5, 'Jl mana saja 26', '3,3', 1),
(27, 'Rio', 'P', 3, 'Jl mana saja 27', '2,4', 1),
(28, 'Sandi', 'P', 1, 'Jl mana saja 28', '5,2', 1),
(29, 'Toni', 'P', 2, 'Jl mana saja 29', '2,4', 1),
(30, 'Surya', 'P', 4, 'Jl mana saja 30', '1,5', 1),
(31, 'Wahyu', 'P', 1, 'Jl mana saja 31', '2,4', 1),
(32, 'Wawan', 'P', 5, 'Jl mana saja 32', '3,1,5', 1),
(33, 'Yoga', 'P', 4, 'Jl mana saja 33', '1,3,5', 1),
(34, 'Yudha', 'P', 2, 'Jl mana saja 34', '1,3,5', 1),
(35, 'Zidane', 'P', 5, 'Jl mana saja 35', '1,3,5', 1),
(36, 'Aditya', 'P', 2, 'Jl mana saja 36', '1,3,5', 1),
(37, 'Ardi', 'P', 1, 'Jl mana saja 37', '1,3,5', 1),
(38, 'Doni', 'P', 1, 'Jl mana saja 38', '2,4,5', 1),
(39, 'Fahri', 'P', 2, 'Jl mana saja 39', '2,3', 1),
(40, 'Gilang', 'P', 4, 'Jl mana saja 40', '1,3', 1),
(41, 'Hadi', 'P', 4, 'Jl mana saja 41', '1,4', 1),
(42, 'Iqbal', 'P', 2, 'Jl mana saja 42', '1,3', 1),
(43, 'Joni', 'P', 5, 'Jl mana saja 43', '2,3', 1),
(44, 'Kevin', 'P', 1, 'Jl mana saja 44', '2,3', 1),
(45, 'Luthfi', 'P', 2, 'Jl mana saja 45', '1,4', 1),
(46, 'Maulana', 'P', 2, 'Jl mana saja 46', '2,3', 1),
(47, 'Prasetyo', 'P', 5, 'Jl mana saja 47', '1,4', 1),
(48, 'Ayu', 'W', 4, 'Jl mana saja 48', '2,4,5', 1),
(49, 'Bunga', 'W', 4, 'Jl mana saja 49', '5,2,5', 1),
(50, 'Citra', 'W', 4, 'Jl mana saja 50', '5,1,5', 1),
(51, 'Dewi', 'W', 2, 'Jl mana saja 51', '2,1', 1),
(52, 'Dinda', 'W', 5, 'Jl mana saja 52', '2,3', 1),
(53, 'Fitri', 'W', 3, 'Jl mana saja 53', '4,4', 1),
(54, 'Gina', 'W', 5, 'Jl mana saja 54', '3,1', 1),
(55, 'Hana', 'W', 4, 'Jl mana saja 55', '1,4,5', 1),
(56, 'Indah', 'W', 3, 'Jl mana saja 56', '2,1', 1),
(57, 'Irma', 'W', 5, 'Jl mana saja 57', '1,2', 1),
(58, 'Intan', 'W', 3, 'Jl mana saja 58', '2,5,5', 1),
(59, 'Julia', 'W', 3, 'Jl mana saja 59', '4,2', 1),
(60, 'Kartika', 'W', 5, 'Jl mana saja 60', '3,1', 1),
(61, 'Laras', 'W', 4, 'Jl mana saja 61', '1,3', 1),
(62, 'Melati', 'W', 5, 'Jl mana saja 62', '2,4', 1),
(63, 'Nabila', 'W', 2, 'Jl mana saja 63', '3,2,5', 1),
(64, 'Nadia', 'W', 1, 'Jl mana saja 64', '4,1', 1),
(65, 'Nia', 'W', 4, 'Jl mana saja 65', '2,4,5', 1),
(66, 'Permata', 'W', 1, 'Jl mana saja 66', '1,4,5', 1),
(67, 'Putri', 'W', 5, 'Jl mana saja 67', '2,5,5', 1),
(68, 'Ratna', 'W', 2, 'Jl mana saja 68', '1,2,5', 1),
(69, 'Santi', 'W', 2, 'Jl mana saja 69', '3,3,5', 1),
(70, 'Sari', 'W', 3, 'Jl mana saja 70', '1,2,5', 1),
(71, 'Sinta', 'W', 4, 'Jl mana saja 71', '2,2,5', 1),
(72, 'Tania', 'W', 5, 'Jl mana saja 72', '3,5', 1),
(73, 'Tiara', 'W', 4, 'Jl mana saja 73', '4,2', 1),
(74, 'Vivi', 'W', 5, 'Jl mana saja 74', '5,1', 1),
(75, 'Wina', 'W', 3, 'Jl mana saja 75', '5,3', 1),
(76, 'Yanti', 'W', 4, 'Jl mana saja 76', '2,3', 1),
(77, 'Zahra', 'W', 5, 'Jl mana saja 77', '3,5,5', 1),
(78, 'Adelia', 'W', 2, 'Jl mana saja 78', '5,2,5', 1),
(79, 'Aurel', 'W', 2, 'Jl mana saja 79', '2,2', 1),
(80, 'Bella', 'W', 5, 'Jl mana saja 80', '3,4', 1),
(81, 'Cinta', 'W', 2, 'Jl mana saja 81', '3,4', 1),
(82, 'Diana', 'W', 3, 'Jl mana saja 82', '2,5', 1),
(83, 'Erika', 'W', 2, 'Jl mana saja 83', '2,5', 1),
(84, 'Fani', 'W', 2, 'Jl mana saja 84', '3,2,5', 1),
(85, 'Gaby', 'W', 1, 'Jl mana saja 85', '4,5,5', 1),
(86, 'Happy', 'W', 4, 'Jl mana saja 86', '4,4', 1),
(87, 'Jessica', 'W', 5, 'Jl mana saja 87', '3,3', 1),
(88, 'Karina', 'W', 2, 'Jl mana saja 88', '4,4', 1),
(89, 'Lestari', 'W', 1, 'Jl mana saja 89', '1,5,5', 1),
(90, 'Mega', 'W', 4, 'Jl mana saja 90', '4,3,5', 1),
(91, 'Olivia', 'W', 3, 'Jl mana saja 91', '1,3,5', 1),
(92, 'Renata', 'W', 4, 'Jl mana saja 92', '2,1', 1),
(93, 'Salma', 'W', 4, 'Jl mana saja 93', '1,5', 1),
(94, 'Vina', 'W', 5, 'Jl mana saja 94', '1,3', 1),
(95, 'Yuli', 'W', 2, 'Jl mana saja 95', '5,4', 1),
(96, 'Zaskia', 'W', 4, 'Jl mana saja 96', '3,2,1', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `questions`
--

CREATE TABLE `questions` (
  `id` int NOT NULL,
  `question` varchar(100) NOT NULL,
  `active` int DEFAULT '1' COMMENT '1=Aktif, 2=Non Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `questions`
--

INSERT INTO `questions` (`id`, `question`, `active`) VALUES
(1, 'Berapa jumlah satelit bumi', 1),
(2, 'Pilih benda yang merupakan alat makan', 1),
(3, 'Pilih benda yang merupakan alat tulis', 1),
(4, 'Pilih benda yang merupaka bagian komputer', 1),
(5, 'Pilih kendaraan transportasi darat', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_answers_questions` (`questionid`);

--
-- Indeks untuk tabel `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_jawaban_pegawai`
--
ALTER TABLE `detail_jawaban_pegawai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detailjawaban_jawabanpegawai` (`jawabanpegawaiid`),
  ADD KEY `fk_detailjawaban_questions` (`questionid`);

--
-- Indeks untuk tabel `jawaban_pegawai`
--
ALTER TABLE `jawaban_pegawai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_jawabanpegawai_pegawai` (`pegawaiid`);

--
-- Indeks untuk tabel `keahlian`
--
ALTER TABLE `keahlian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pegawai_departemen` (`departemenid`);

--
-- Indeks untuk tabel `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `departemen`
--
ALTER TABLE `departemen`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `detail_jawaban_pegawai`
--
ALTER TABLE `detail_jawaban_pegawai`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=480;

--
-- AUTO_INCREMENT untuk tabel `jawaban_pegawai`
--
ALTER TABLE `jawaban_pegawai`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT untuk tabel `keahlian`
--
ALTER TABLE `keahlian`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT untuk tabel `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `fk_answers_question` FOREIGN KEY (`questionid`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_answers_questions` FOREIGN KEY (`questionid`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_jawaban_pegawai`
--
ALTER TABLE `detail_jawaban_pegawai`
  ADD CONSTRAINT `fk_detailjawaban_jawabanpegawai` FOREIGN KEY (`jawabanpegawaiid`) REFERENCES `jawaban_pegawai` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detailjawaban_questions` FOREIGN KEY (`questionid`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jawaban_pegawai`
--
ALTER TABLE `jawaban_pegawai`
  ADD CONSTRAINT `fk_jawabanpegawai_pegawai` FOREIGN KEY (`pegawaiid`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `fk_pegawai_departemen` FOREIGN KEY (`departemenid`) REFERENCES `departemen` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
