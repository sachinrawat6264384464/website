-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2024 at 05:07 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";                   


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mp_ajjaks`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`name`, `email`, `password`, `role`) VALUES
('Dr. Raj Shivhare', 'rajshivhare42@gmail.com', '$2b$12$MZMaN7/UCuSLJ.vtAbHuSOzleEVbEYIictgZ6dsAOpFFRyAKx.M4S', 'admin'),
('Shailendra Satyarthi', 'satyarthigwl@gmail.com', '$2y$10$aw44ek5MY2998U7JN74pb.if/TAssY29j5vO4Nur9YeU4JD7Xn7fm', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `event_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_name`, `event_date`) VALUES
(1, 'संगोष्ठी एवं सम्मान समारोह', '2023-01-03'),
(2, 'सद्भावना सम्मान समारोह', '2023-02-05'),
(3, 'सम्मान समारोह एवं व्याख्यान', '2023-05-21'),
(4, 'संत कबीर प्रकटोत्सव समारोह एवं व्याख्यान', '2023-06-04');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `district` varchar(100) NOT NULL,
  `phone_no` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `position`, `district`, `phone_no`) VALUES
(1, 'चौ. मुकेश मौर्य', 'जनसंपर्क अधिकारी, एम. आई. टी. एस.', 'ग्वालियर', '9993549815'),
(2, 'श्री आर. वी. एस. धारिया', 'ए. व्ही. एफ. ओ., पशुपालन विभाग', 'ग्वालियर', '9926299455'),
(3, 'श्री दिनेश उमरैया', 'जिला समन्वयक, जन अभियान परिषद', 'ग्वालियर', '9425394442'),
(4, 'श्री सुरेश अम्ब', 'प्राचार्य, शा. हा. स्कूल बिजकपुर', 'ग्वालियर', '9754785967'),
(5, 'श्री झड़ा सिंह गोयल', 'मा. शिक्षक, शा. मा. वि. हुसवली', 'ग्वालियर', '9826801874'),
(6, 'श्री मुकेश अहिरवार ', 'टेक्निशियन, जीवाजी विश्वविद्यालय', 'ग्वालियर', '9977517712'),
(8, 'श्री नरेश गोयल ', 'उ. मा. शिक्षक, शा. उ. मा. वि. रनगवां ', 'ग्वालियर', '7697882731');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `email`, `password`, `role`) VALUES
('Sivam', 'shiva4523e@gmail.com', '$2y$10$v7cOOKovn8SJfUt2T4CIu.vUJAA6oefGx4Ynyh13EbRnYv/nR4Zma', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `vf`
--

CREATE TABLE `vf` (
  `email` varchar(255) NOT NULL,
  `otp` varchar(6) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone_no` (`phone_no`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `vf`
--
ALTER TABLE `vf`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;          
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE TABLE site_counter (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date DATE NOT NULL,
    click_count INT NOT NULL DEFAULT 0
);
