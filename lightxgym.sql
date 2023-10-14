-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2020 at 06:15 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lightxgym`
--

-- --------------------------------------------------------

--
-- Table structure for table `advanced_posts`
--

CREATE TABLE `advanced_posts` (
  `id` int(11) NOT NULL,
  `image` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `advanced_posts`
--

INSERT INTO `advanced_posts` (`id`, `image`, `author`, `date`, `content`) VALUES
(2, 'the-best-ab-workouts-you-can-do-anywhere-722x406.jpg', 'Jex', '2020-10-10', 'You think the old adage ‘no pain, no gain’ is totally true when it comes to your abs? Not so, says Paige Waehner, a Chicago-based personal trainer. There are plenty of ways you can engage your core all day long for fitness and weight loss — without hours of mat work at the gym or at home. With these tips, you can work your way to flatter abs while you’re on your way to work, while you’re at work, and when you’re relaxing at home. Even better, these eight moves are simple enough that they’re the perfect starter routine for any fitness level:\r\n\r\nTake five for morning fitness: Ballerinas are known for their flat stomachs, so spend five minutes copying this dance move when you get up in the morning: Stand to the left of a chair and rest your left hand on the chair’s back. Keep your legs together. Touch your heels, and point your toes out to form a triangle. Lift your right arm straight up, reaching for the ceiling. Now hinge forward at the waist, round your back, and reach your right hand toward the floor, touching it if you can. Holding the position, tighten your abs, bringing your belly button in toward your spine. Exhale and slowly lift yourself to the starting position. A complete repetition should take about 20 seconds. Do five repetitions in all, adding more reps as you feel stronger.');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `category` varchar(20) NOT NULL,
  `price` varchar(10) NOT NULL,
  `instructor` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `category`, `price`, `instructor`) VALUES
(3, '  Aerobic', ' 30$', '  Malisa'),
(5, 'Muscle Strengthening', '30$', 'Lucas'),
(14, 'Martial Art', '40$', 'John Doe');

-- --------------------------------------------------------

--
-- Table structure for table `class_apply`
--

CREATE TABLE `class_apply` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `classId` int(11) NOT NULL,
  `category` varchar(220) NOT NULL,
  `price` varchar(220) NOT NULL,
  `instructor` varchar(220) NOT NULL,
  `time` varchar(220) NOT NULL,
  `date` date NOT NULL,
  `tutorial` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_apply`
--

INSERT INTO `class_apply` (`id`, `userId`, `username`, `classId`, `category`, `price`, `instructor`, `time`, `date`, `tutorial`) VALUES
(11, 11, 'userthree', 5, 'Muscle Strengthening', '30$', 'Lucas ', '9am - 10am', '2020-11-26', 'https://youtu.be/Duo8aFOa1co?list=PLSxZphTmOpGTJIUrH1v6gadm2kLMr7Ydz'),
(12, 13, 'userfive', 3, '  Aerobic', ' 30$', '  Malisa ', '1pm - 2pm', '2020-11-27', 'https://youtu.be/Duo8aFOa1co?list=PLSxZphTmOpGTJIUrH1v6gadm2kLMr7Ydz'),
(13, 14, 'userone', 5, 'Muscle Strengthening', '30$', 'Lucas ', '9am - 10am', '2020-11-26', 'https://youtu.be/Duo8aFOa1co?list=PLSxZphTmOpGTJIUrH1v6gadm2kLMr7Ydz');

-- --------------------------------------------------------

--
-- Table structure for table `contact_info`
--

CREATE TABLE `contact_info` (
  `id` int(11) NOT NULL,
  `userId` int(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_info`
--

INSERT INTO `contact_info` (`id`, `userId`, `email`, `name`, `phone`, `message`) VALUES
(8, 11, 'userthree@gmail.com', 'userthree', '093112333', 'Contacting '),
(9, 13, 'userfive@gmail.com', 'userfive', '0942333111', 'Contact Testing'),
(10, 14, 'userone@gmail.com', 'userone', '095574122', 'I need Help about training. ');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `username`, `title`, `content`, `date`) VALUES
(21, 'akk22', 'test', 'test', '2020-11-25'),
(24, 'userthree', 'Testing2', 'Testing 2 from user three.', '2020-11-25'),
(25, 'userfive', 'Testing Feedback Title', 'Testing Feedback Message.', '2020-11-25'),
(26, 'userone', 'Feedback Title', 'Feedback Message Testing. ', '2020-11-25');

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `id` int(11) NOT NULL,
  `photo` text NOT NULL,
  `name` varchar(100) NOT NULL,
  `age` varchar(100) NOT NULL,
  `profession` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`id`, `photo`, `name`, `age`, `profession`) VALUES
(3, 'pexels-nathan-cowley-1153370.jpg', ' Ms.Tokyo', ' 26', ' Aerobic'),
(6, 'instructor_img2.jpg', 'John Doe', '26', 'Boxing');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `item_image` text NOT NULL,
  `item_title` varchar(20) NOT NULL,
  `price` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `item_image`, `item_title`, `price`) VALUES
(3, 'pexels-ivan-samkov-4164452.jpg', 'Weight 2 Kg', '60$'),
(8, 'inventory_img2.jpg', 'Machine Bicycle', '140$');

-- --------------------------------------------------------

--
-- Table structure for table `item_order`
--

CREATE TABLE `item_order` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `itemId` int(11) NOT NULL,
  `itemtitle` varchar(100) NOT NULL,
  `unit` int(11) NOT NULL,
  `price` varchar(200) NOT NULL,
  `shippingaddresss` varchar(250) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `image` text NOT NULL,
  `author` varchar(30) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `image`, `author`, `date`, `content`) VALUES
(11, 'merlin_177550992_a9a4bc0d-32c5-4cee-8e4e-f9cd11926456-superJumbo.jpg', 'David loi', '2020-10-03', 'The chief executive of Pfizer said on Friday that the company would not apply for emergency authorization of its coronavirus vaccine before the third week of November, ruling out President Trump’s assertion that a vaccine would be ready before Election Day on Nov. 3.\r\n\r\nIn a statement posted to the company website, the chief executive, Dr. Albert Bourla, said that although Pfizer could have preliminary numbers by the end of October about whether the vaccine works, it would still need to collect safety and manufacturing data that will stretch the timeline to at least the third week of November.\r\n\r\nClose watchers of the vaccine race had already known that Pfizer wouldn’t be able to meet the requirements of the Food and Drug Administration by the end of this month. But Friday’s announcement represents a shift in tone for the company and its leader, who has repeatedly emphasized the month of October in interviews and public appearances.\r\n\r\nIn doing so, the company had aligned its messaging with that of the president, who has made no secret of his desire for an approved vaccine before the election. He has even singled out the company by name and said he had talked to Dr. Bourla, whom he called a “great guy.”'),
(23, 'post_img2.jpg', 'Verkra', '2020-11-25', 'Looking for an exercise that gets your heart pumping and strengthens muscles in your legs, arms, and core? Tennis and other racquet sports can serve up all those benefits and more. In fact, several long-running studies have linked racquet sports to a lower risk of cardiovascular disease and a longer life. \"Playing tennis is an amazing workout. And no matter how good you are, you can have fun doing it,\" says Joe DiVincenzo, a physical therapist at Harvard-affiliated Spaulding Rehabilitation Hospital and former competitive tennis player. In general, racquet sports engage muscles throughout your upper and lower body, which challenges your heart. During a match, you do frequent, short bursts of high-intensity activity interspersed with less vigorous movements — a perfect example of interval training. Also known as HIIT (high-intensity interval training), this workout strategy seems to be a good way to boost cardiovascular fitness.');

-- --------------------------------------------------------

--
-- Table structure for table `request_ticket`
--

CREATE TABLE `request_ticket` (
  `id` int(11) NOT NULL,
  `classapplied_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `userid` int(11) NOT NULL,
  `category` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request_ticket`
--

INSERT INTO `request_ticket` (`id`, `classapplied_id`, `username`, `userid`, `category`) VALUES
(12, 13, 'userone', 14, 'Muscle Strengthening');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `address`, `password`, `role`) VALUES
(7, 'akk22', 'akk22@gmail.com', 'ygn', '827ccb0eea8a706c4c34a16891f84e7b', 'user'),
(9, 'Admin2', 'Admin', 'Ygn', '827ccb0eea8a706c4c34a16891f84e7b', 'admin'),
(14, 'userone', 'userone@gmail.com', 'Myanmar, Yangon', '827ccb0eea8a706c4c34a16891f84e7b', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advanced_posts`
--
ALTER TABLE `advanced_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_apply`
--
ALTER TABLE `class_apply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_info`
--
ALTER TABLE `contact_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_order`
--
ALTER TABLE `item_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_ticket`
--
ALTER TABLE `request_ticket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advanced_posts`
--
ALTER TABLE `advanced_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `class_apply`
--
ALTER TABLE `class_apply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `contact_info`
--
ALTER TABLE `contact_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `instructor`
--
ALTER TABLE `instructor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `item_order`
--
ALTER TABLE `item_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `request_ticket`
--
ALTER TABLE `request_ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
