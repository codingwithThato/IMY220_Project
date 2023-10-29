-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 27, 2023 at 09:38 PM
-- Server version: 8.0.34-0ubuntu0.20.04.1
-- PHP Version: 7.4.3-4ubuntu2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u21487279`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `summary` varchar(2000) COLLATE utf8mb4_general_ci NOT NULL,
  `date` date NOT NULL,
  `hashtags` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int NOT NULL,
  `list_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `name`, `summary`, `date`, `hashtags`, `category`, `image_path`, `user_id`, `list_id`) VALUES
(1, 'Savoring Perfection...ALMOST: Starbucks\' Finest Brews Under the Spotlight', 'Embarking on a journey through Starbucks\' coffee offerings reveals a world of diverse flavors and experiences. Beyond being a coffee destination, Starbucks crafts an immersive ambiance where coffee lovers can relish a moment of tranquility. The allure of single-origin coffees, such as the robust Sumatra blend, showcases the distinctiveness of various regions. Meanwhile, artful blends like Pike Place Roast harmonize contrasting profiles for a versatile choice. Starbucks\' innovation shines with Nitro Cold Brew, offering a velvety texture and sweet notes without added additives. Moreover, Starbucks\' dedication to sustainability via the C.A.F.E. Practices program ensures an ethical and responsible sourcing process. This review underscores how Starbucks intertwines culture, flavor, and responsibility, making each cup a journey worth savoring.', '2023-08-23', '#brewWithStarbucks #coffeelovers #starbucksForTheWin', 'Cafe Bakery', 'starbs.jpg', 3, NULL),
(2, 'Seattle Coffee Company - A Blend of Tradition and Innovation', 'The Seattle Coffee Company, established in 1971, effectively combines tradition and innovation to thrive in the competitive coffee industry. Rooted in the Pacific Northwest\'s coffee culture, the company maintains its commitment to quality by sourcing premium Arabica beans and employing meticulous roasting techniques. Innovation is evident through its seamless digital integration, offering customers personalized recommendations and convenient online ordering. The company\'s cafes are designed as inviting \"third spaces,\" fostering community and a sense of belonging. Notably, the Seattle Coffee Company prioritizes sustainability by ethically sourcing beans, promoting recyclable packaging, and reducing its carbon footprint. This blend of tradition, innovation, and responsibility establishes the company as a noteworthy player in the coffee market, delivering a holistic coffee experience that spans beyond the beverage itself.', '2023-06-14', '#seattleCoffeeForTheWin #seattleCoffeeCo #iLoveSeattle ', 'Cafe Bakery', 'seattle.jpg', 3, NULL),
(3, 'Vida e Caffè - A Taste of European Coffee Culture', 'Vida e Caffè, founded in 2001, captures the essence of European coffee culture with its inviting cafes and artisanal approach. The rustic ambiance and sidewalk seating evoke a European feel, encouraging patrons to enjoy their coffee leisurely. The brand\'s blend of traditional espresso-based drinks and unique coffee blends sourced from around the world creates a harmonious fusion of familiarity and novelty. The cafes serve as community hubs, fostering interaction, while the brand\'s artisanal approach to sourcing and preparation ensures a quality-driven experience. Vida e Caffè\'s ability to transport customers to the streets of Europe while delivering a diverse coffee journey makes it a standout in the coffee chain landscape.', '2023-06-13', '#vidaeCaffe #iLoveVida #vidaCoffeeRules', '', 'vida.jpg', 4, NULL),
(5, 'Haven: Coffee Buzz ', 'In the heart of the city, Coffee Buzz stands as a beacon for coffee aficionados seeking both quality brews and a cozy ambiance. This charming coffee shop impresses with its thoughtfully curated menu and inviting atmosphere. The moment one steps through the door, the rich aroma of freshly ground beans envelops the senses, promising a memorable experience.\r\n\r\nCoffee Buzz\'s commitment to excellence is evident in their meticulously crafted beverages. From classic espressos to creative signature lattes, each cup is a masterpiece. The baristas demonstrate their expertise by skillfully balancing flavors and textures. Pair your drink with delectable pastries sourced from local bakeries for a delightful treat.\r\n\r\nThe cozy interior, adorned with rustic wooden furniture and warm lighting, creates an ideal setting for both solitude and socializing. The staff\'s genuine passion for coffee and attentive service further elevates the visit.\r\n\r\nIn a bustling urban landscape, Coffee Buzz emerges as more than just a coffee shop – it\'s a destination where every sip tells a story of dedication and love for the art of coffee.', '2023-08-25', '#coffeeBuzz #coffeeLover', '', '', 3, NULL),
(8, 'A Disappointing Experience: The Downfall of \"10z\" Coffee Shop', '\"10z\" Coffee Shop, once held in high regard, has sadly fallen short of its former reputation. The decline in quality is evident across various aspects, leaving patrons feeling disillusioned. The coffee, once a highlight, now lacks the depth and flavor that once set this establishment apart. Bland and underwhelming, the brews served at \"10z\" fail to satisfy even the most modest of expectations.\n\nThe ambiance, too, has suffered a noticeable decline. What was once a cozy and welcoming space now feels neglected and lacking in upkeep. Dingy furniture and dim lighting contribute to a disheartening atmosphere that fails to inspire a desire to linger.\n\nMoreover, customer service has taken a hit. Staff members appear disinterested and disengaged, leading to frustrating experiences for visitors seeking assistance or information.\n\nIn its current state, \"10z\" Coffee Shop serves as a cautionary tale of how complacency can erode even the most promising establishments. It\'s a stark reminder that consistent quality and dedication are paramount in maintaining a thriving coffee haven.', '2023-08-27', '#notAFanOf10z #wouldntrecommend #badCoffee', '', '10z.jpg', 4, NULL),
(12, 'A Delightful CHATGPT Coffee Review', 'ChatGPT Coffee Shop offers an intriguing blend of technology and coffee, creating a unique virtual coffee experience. The ambiance, although minimalist, is conducive to focused work and engaging conversations. The coffee selection is extensive, with personalized recommendations based on your preferences, offering everything from classic espresso to exotic single-origin pour-overs. The coffee quality is consistently good, though it lacks the hands-on touch of a skilled barista. The standout feature is the customer interaction, with knowledgeable AI baristas providing engaging conversations on various topics. The innovation in integrating AI enhances the experience, from personalized recommendations to AI-curated music playlists. While it comes at a cost, the unique experience makes it a worthwhile indulgence for tech-savvy coffee enthusiasts. ChatGPT Coffee Shop is a fascinating glimpse into the future of coffee culture, combining AI technology with the love of coffee.', '2023-09-07', '#coffeeChat #coffeeLoverrrrr', '', '', 4, NULL),
(14, 'Aroma Coffee Lounge: A Great Experience', 'Aroma Coffee Lounge is a hidden gem nestled in the heart of our bustling city, and it\'s a true paradise for coffee enthusiasts. From the moment you step inside, you\'re enveloped in a warm and inviting atmosphere that exudes a sense of tranquility amidst the urban chaos. \r\n\r\nThe first thing that strikes you is the intoxicating scent of freshly roasted coffee beans, which wafts through the air and sets the stage for an exceptional coffee experience. The interior is tastefully decorated with earthy tones, plush seating, and rustic wooden accents, creating an ambiance that\'s both chic and cozy. \r\n\r\nThe coffee menu at Aroma Coffee Lounge is a masterpiece, offering a delightful array of options, from robust espressos to velvety cappuccinos and creative specialty drinks. Their baristas are true artisans, and every cup is crafted with precision and passion. Whether you\'re a black coffee purist or a fan of elaborate, Instagram-worthy concoctions, there\'s something for everyone.\r\n\r\nPair your coffee with their delectable pastries or sandwiches, all made with the freshest ingredients. The staff is not only knowledgeable but also incredibly friendly, making you feel right at home.\r\n\r\nAroma Coffee Lounge is not just a coffee shop; it\'s an oasis of serenity and a haven for coffee aficionados. If you\'re seeking a perfect cup of coffee in a calming, stylish setting, this is the place to be. It\'s a little piece of coffee heaven in the heart of the city.', '2023-10-06', '#GreatCoffee #coffeeLover', '', '', 3, NULL),
(15, 'A Coffee Haven at Sala Coffee Shop', 'If you\'re in search of a true coffee haven, look no further than Sala Coffee Shop. This charming little gem offers an unparalleled coffee experience in a cozy, welcoming setting. From the moment you walk in, the rich, aromatic scent of freshly ground coffee beans envelops you, promising a delightful journey for your taste buds.\r\n\r\nSala Coffee Shop boasts a diverse and thoughtfully curated menu that caters to every coffee lover\'s palate. Whether you\'re a fan of a perfectly brewed espresso, a creamy latte, or adventurous, handcrafted concoctions, Sala Coffee Shop has it all. The baristas here are not just experts; they\'re artists, meticulously crafting each cup with precision and flair.\r\n\r\nThe ambiance is equally delightful. With its warm, earthy decor and comfortable seating, it\'s a haven for those seeking solace or a cozy spot for catching up with friends. The staff is friendly, knowledgeable, and always ready to make recommendations tailored to your taste.\r\n\r\nTo sum it up, Sala Coffee Shop is a true coffee lover\'s paradise. It\'s where the love of coffee meets a warm, inviting atmosphere.', '2023-10-11', '#SalaCoffeeShop #CoffeeLovers #CozyCafe #AromaticBliss #BaristaArtistry', '', '', 5, NULL),
(16, 'A Disappointing Visit to Pure Cafe @ UP', 'My recent visit to Pure Cafe @ UP left me thoroughly unimpressed. What should have been a delightful coffee shop experience turned into a regrettable disappointment.\r\n\r\nFrom the moment I walked in, it was evident that the cafe was in need of some serious renovation and maintenance. The worn-out furniture, peeling paint, and lackluster decor didn\'t create the inviting atmosphere I expected.\r\n\r\nThe coffee, unfortunately, was equally lackluster. It tasted more like a generic instant brew than the artisanal coffee I had hoped for. It lacked the boldness and flavor that coffee enthusiasts appreciate, leaving a bitter aftertaste in more ways than one.\r\n\r\nThe menu was limited, and the service was sluggish, with disinterested staff offering minimal guidance. I found myself waiting for my order longer than I cared to, and when it finally arrived, it was lukewarm at best.\r\n\r\nIn summary, Pure Cafe @ UP fell far short of the coffee shop experience I was hoping for. The dilapidated ambiance, uninspiring coffee, and lackluster service made it a visit I won\'t be repeating. ', '2023-09-28', '#PureCafeUP #CoffeeDisappointment #LacklusterExperience #CafeRegret #UnderwhelmingService', 'Cafe Bakery', '', 5, NULL),
(23, 'A Sad Experience at McDonalds Coffee Co', 'McDonalds Coffee Co, an establishment bearing the iconic golden arches, sadly fails to live up to even the most modest expectations for a coffee shop. From the moment you enter, the atmosphere is far from inviting, more resembling a fast-food joint than a place to savor a quality cup of coffee.\r\n\r\nThe first disappointment is the aroma, or lack thereof. Instead of the delightful scent of freshly brewed coffee, you\'re greeted with the unmistakable smell of greasy fast food. It\'s an olfactory assault that sets the wrong tone for a coffee experience.\r\n\r\nThe coffee at McDonalds Coffee Co is nothing short of disappointing. Whether you opt for a basic black coffee or one of their specialty drinks, the taste is consistently underwhelming. The beans seem to lack freshness, resulting in a bland, uninspiring cup that hardly resembles what coffee enthusiasts crave. \r\n\r\nThe menu offers little in the way of variety, and the staff often appears disinterested, offering minimal assistance or recommendations. The seating arrangements are basic and often uncomfortable, making it an unsuitable place for extended stays.\r\n\r\nIn sum, McDonalds Coffee Co is a far cry from what one would expect from a dedicated coffee shop. It\'s more a place for a quick caffeine fix than an enjoyable coffee experience. For those who appreciate a well-crafted cup of coffee and a welcoming ambiance, this is not the place to visit.', '2023-10-04', '#badMaccies #badCoffee #notAFan', '', '', 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` int NOT NULL,
  `sender_id` int NOT NULL,
  `recipient_id` int NOT NULL,
  `content` text NOT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE `follows` (
  `id` int NOT NULL,
  `follower_id` int NOT NULL,
  `following_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `follows`
--

INSERT INTO `follows` (`id`, `follower_id`, `following_id`, `created_at`) VALUES
(3, 3, 4, '2023-10-25 13:27:07'),
(4, 4, 3, '2023-10-25 20:22:53');

-- --------------------------------------------------------

--
-- Table structure for table `lists`
--

CREATE TABLE `lists` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `user_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lists`
--

INSERT INTO `lists` (`id`, `name`, `description`, `user_id`, `created_at`) VALUES
(7, 'Great Coffee Shops to Try Out', 'This is a list of amaizng coffee shop articles!', 3, '2023-10-05 21:00:51'),
(8, 'Bad coffee places', 'List about bad coffees :(', 3, '2023-10-05 23:54:21'),
(9, 'Mid Coffee Shops', 'This is a list about the mid coffeee shops', 3, '2023-10-06 05:34:48'),
(10, 'More Good Coffee Shops', 'This is a new list about good coffee.', 3, '2023-10-06 05:50:34'),
(11, 'More Mid Coffee Shops', 'This is a new list abotu mid coffee', 3, '2023-10-06 05:58:05'),
(12, 'Test List Of Coffee', 'this is a test', 3, '2023-10-08 08:41:12');

-- --------------------------------------------------------

--
-- Table structure for table `list_articles`
--

CREATE TABLE `list_articles` (
  `id` int NOT NULL,
  `list_id` int NOT NULL,
  `article_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `list_articles`
--

INSERT INTO `list_articles` (`id`, `list_id`, `article_id`) VALUES
(2, 7, 3),
(4, 7, 8),
(5, 8, 12),
(7, 9, 3),
(9, 9, 5),
(10, 10, 5),
(11, 10, 3),
(13, 11, 3),
(14, 11, 2),
(15, 12, 3),
(16, 12, 2),
(18, 12, 5);

-- --------------------------------------------------------

--
-- Table structure for table `ratings_reviews`
--

CREATE TABLE `ratings_reviews` (
  `id` int NOT NULL,
  `article_id` int NOT NULL,
  `rating` int NOT NULL,
  `review` text COLLATE utf8mb4_general_ci,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratings_reviews`
--

INSERT INTO `ratings_reviews` (`id`, `article_id`, `rating`, `review`, `user_id`) VALUES
(6, 1, 80, 'it actually is pretty good!', 3),
(7, 13, 80, 'it was pretty great tbh', 3),
(8, 13, 20, 'okay nahhhhh its pretty good', 3),
(9, 13, 100, 'This was actually very good !', 3),
(10, 8, 20, 'not bad', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `contact` int NOT NULL,
  `birthday` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `username`, `email`, `password`, `contact`, `birthday`) VALUES
(3, 'Satoru', 'Gojo', 'gojosatoru', 'gojosatoru@gmail.com', '$2y$10$0YbxJtp1E3faZ73Cn9e8oucuWDVnDrjetihjxZ/V95Be1P18Rvrnm', 837332929, '1989-12-07'),
(4, 'Suguru', 'Geto', 'getosuguru', 'getosuguru@gmail.com', '$2y$10$5UXApD0IemRkRG1/KINmX.oLp/fEt1jstyyucr3dnAmSqnCitWiIW', 734562378, '1990-02-03'),
(5, 'Toji', 'Fushiguro', 'fushigurotoji', 'fushigurotoji@gmail.com', '$2y$10$JmhOeTHZsyOVCpk4AFGTVuY/K96sH/zRCoiCLFW/QL6uOJTs6Sb3q', 837332929, '1980-10-11'),
(6, 'Megumi', 'Fushiguro', 'megfushi', 'fushiguromegumi@gmail.com', 'Fushiguromegumi/10', 827382736, '2007-03-04'),
(7, 'Itadori', 'Yuuji', 'itayuji', 'itadoriyuuji@gmail.com', 'itaYuu?15', 765472839, '2007-06-07'),
(8, 'Denji', 'Pochi', 'denjiiii', 'denjipoch@gmail.com', 'denDenPoch/123', 634589603, '2001-10-03'),
(9, ' Mei', 'Mei', 'meimei', 'meimei@gmail.com', 'mei12?Mei', 827367892, '1990-03-08'),
(10, 'Todo', 'Hugo', 'todohugo', 'todohugo@gmail.com', 'TodoHugo/1283', 634588738, '2000-09-07'),
(11, 'Ryomen', 'Sukuna', 'ryosukuna', 'ryosukuna@gmail.com', 'RyoSuk@@87', 783948576, '1210-07-02'),
(12, 'Nobara', 'Kugisaki', 'nobskug', 'nobarakugisaki@gmail.com', 'NobzKugz#35', 634589603, '2008-10-09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `list_id` (`list_id`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_follow` (`follower_id`,`following_id`),
  ADD KEY `following_id` (`following_id`);

--
-- Indexes for table `lists`
--
ALTER TABLE `lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list_articles`
--
ALTER TABLE `list_articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `list_id` (`list_id`),
  ADD KEY `article_id` (`article_id`);

--
-- Indexes for table `ratings_reviews`
--
ALTER TABLE `ratings_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_id` (`article_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `follows`
--
ALTER TABLE `follows`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lists`
--
ALTER TABLE `lists`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `list_articles`
--
ALTER TABLE `list_articles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `ratings_reviews`
--
ALTER TABLE `ratings_reviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `follows_ibfk_1` FOREIGN KEY (`follower_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `follows_ibfk_2` FOREIGN KEY (`following_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `list_articles`
--
ALTER TABLE `list_articles`
  ADD CONSTRAINT `list_articles_ibfk_1` FOREIGN KEY (`list_id`) REFERENCES `lists` (`id`),
  ADD CONSTRAINT `list_articles_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
