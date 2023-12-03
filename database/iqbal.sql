-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Nov 2023 pada 03.50
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iqbal`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(256) NOT NULL,
  `whatsapp` varchar(56) NOT NULL,
  `type` varchar(128) NOT NULL,
  `hour` varchar(56) NOT NULL,
  `stattus` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `booking`
--

INSERT INTO `booking` (`id`, `name`, `email`, `whatsapp`, `type`, `hour`, `stattus`) VALUES
(3, 'Bagus Lestariono', 'bagus@gmail.com', '086588912347', 'oil', '09:01', 1),
(4, 'Bagus Lestariono', 'bagus@gmail.com', '086588912347', 'oil', '09:01', 1),
(6, 'Andry Firdiansyah', 'andry@gmail.com', '089809092112', 'oil', '13:00', 0),
(7, 'Nando Rahmat ', 'nando@gmail.com', '081330368827', 'spare parts', '10:45', 0),
(8, 'Nizar Fikri', 'nizar@gmail.com', '089123456543', 'spare parts', '11:15', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `uniq` varchar(256) NOT NULL,
  `upload_date` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `gallery`
--

INSERT INTO `gallery` (`id`, `uniq`, `upload_date`) VALUES
(1, '656155b95a3b7.jpg', '25 Nov 2023'),
(2, '6561560a5daed.jpg', '25 Nov 2023'),
(5, '6561a27f0fdb4.jpg', '25 Nov 2023'),
(6, '6561a28e00da4.jpg', '25 Nov 2023'),
(7, '6561a2b6f3c16.jpg', '25 Nov 2023'),
(8, '6561a94c5f2da.jpg', '25 Nov 2023');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(512) NOT NULL,
  `name` varchar(256) NOT NULL,
  `img` varchar(256) NOT NULL,
  `role_id` int(12) NOT NULL,
  `join_date` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `name`, `img`, `role_id`, `join_date`) VALUES
(12, 'admin@gmail.com', '$2y$10$qHbKaJDGud7D/1JiuUuUjegaKZCkES2OaYPNH49J4HSQNIS9/KQFu', 'Admin', '6561ade43c1ee.jpg', 3, '24 Nov 2023'),
(14, 'iqbal@gmail.com', '$2y$10$NPwN3Wg.KghGc/70DQOj6OxjvuG78Vx9hxa4jnusMa5Z5h8ICPB9u', 'Iqbal Ramadhan', 'user.png', 3, '24 Nov 2023'),
(18, 'danni@gmail.com', '$2y$10$0VCzpu2Jr/GcD8aM7dl8Iu6TZGFEeovZ0ghP.VaIyD9fQnrk2aGte', 'Moh Khamdanni', '6561f379ee7af.jpg', 2, '24 Nov 2023'),
(19, 'ibnu@gmail.com', '$2y$10$LwTO5nqw5xNbyxERiNbnj.b4Ii.ejc..uiKx46okbtxL41uhn9zkq', 'Ibnu Al-Ikrom', 'user.png', 2, '24 Nov 2023'),
(25, 'bagus@gmail.com', '$2y$10$ieJteh8MAq0pCrKNccXbwuEq1lW4kGKozIb2Kbp4JuKk4UXkpPmqW', 'Bagus Lestariono', 'user.png', 1, '25 Nov 2023'),
(26, 'andry@gmail.com', '$2y$10$HAZT07EjvCzUC1uPJYlGl.T9MDPMo6RFClqkw8I0DPvZ.ADrZhtyK', 'Andry Firdiansyah', 'user.png', 1, '25 Nov 2023'),
(27, 'nando@gmail.com', '$2y$10$SjSnH8qkZKTkShttHcptv.s226igdt3ICjau1d9OYfavdTgYxh56S', 'Nando Rahmat ', 'user.png', 1, '25 Nov 2023'),
(28, 'donni@gmail.com', '$2y$10$urUy7bKQi.FZnZBbAycfl.KqMWaVEG.VxzZRU6DXVHmg8lyiA10XC', 'Donny Firdani', 'user.png', 1, '25 Nov 2023'),
(29, 'dhavis@gmail.com', '$2y$10$x.FhXwuMJaPmbCNDbuG4m.wmRnLbWa/0iXPparyHSgeajAHmYxkNW', 'Dhavis Alvi Candra', 'user.png', 1, '26 Nov 2023'),
(30, 'een@gmail.com', '$2y$10$.RcC/el0Hf6HjvRrP4vFuOMnTG.FQ71PeFCq5x95KGPUyL6/a8LZa', 'Een Greynanda', 'user.png', 1, '26 Nov 2023'),
(32, 'alif@gmail.com', '$2y$10$vg3wYioZdkgEwCCrIqyM2.E/a7uQmHZ0/g/4dph/NogGdztRS93s6', 'Alif Muhammad Akmal', 'user.png', 1, '26 Nov 2023'),
(33, 'hendra@gmail.com', '$2y$10$wWhxJfLnX0YM6U3aiKeEp.5Q32Ie6fRvkvS6tAqyAwmruR9mMviOy', 'Hendra Ujik', 'user.png', 1, '26 Nov 2023'),
(34, 'nizar@gmail.com', '$2y$10$tfZzYfdRwe0Z2A6ILu06ZO079HoZuar2SK3OhUFWnS.J/BmXiUhki', 'Nizar Fikri', 'user.png', 1, '26 Nov 2023');

-- --------------------------------------------------------

--
-- Struktur dari tabel `web_setting`
--

CREATE TABLE `web_setting` (
  `id` int(11) NOT NULL,
  `garage_name` varchar(256) NOT NULL,
  `address` varchar(256) NOT NULL,
  `whatsapp` varchar(56) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password_security` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `web_setting`
--

INSERT INTO `web_setting` (`id`, `garage_name`, `address`, `whatsapp`, `email`, `password_security`) VALUES
(1, 'iqbal garage', 'Ds. Bodor, Pace, Nganjuk', '081234567890', 'iqbal.garage@gmail.com', '1234');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `web_setting`
--
ALTER TABLE `web_setting`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `web_setting`
--
ALTER TABLE `web_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
