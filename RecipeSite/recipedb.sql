-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2018 at 11:55 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recipedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `Rating_ID` int(32) NOT NULL,
  `Reviewer_ID` int(32) NOT NULL,
  `Rated_ID` int(32) NOT NULL,
  `Rating` double NOT NULL,
  `Rating_Desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`Rating_ID`, `Reviewer_ID`, `Rated_ID`, `Rating`, `Rating_Desc`) VALUES
(1, 1, 2, 4, 'Fantastic Cook with great recipes!');

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `Recipe_ID` int(32) NOT NULL,
  `User_ID` int(32) NOT NULL,
  `Recipe_Name` varchar(256) NOT NULL,
  `Prep_Time` time NOT NULL,
  `Cook_Time` time NOT NULL,
  `Serves` int(3) NOT NULL,
  `Description` text NOT NULL,
  `Ingredients` text NOT NULL,
  `Directions` mediumtext NOT NULL,
  `Img` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`Recipe_ID`, `User_ID`, `Recipe_Name`, `Prep_Time`, `Cook_Time`, `Serves`, `Description`, `Ingredients`, `Directions`, `Img`) VALUES
(1, 1, 'Peanut Butter & Banana', '00:03:00', '00:00:00', 1, 'A delicious peanut butter and Banana Sandwich, like Elvis used to make.', '1. Peanut Butter\r\n2. Bread\r\n3. Bacon grease', '1. Cut Banana into slices\r\n2. Spread peanut butter over the bread and place the Banana slices on\r\n3. Fry on pan with bacon grease', 'PBandB.jpg'),
(2, 1, 'Turkey', '00:30:00', '04:30:00', 8, 'A turkey, nothing speacial', 'Turkey', '1. Stuff Turkey\r\n2. Put turkey in oven', 'Turkey.jpg'),
(3, 2, 'Sweet Onion Burgers', '00:05:00', '00:20:00', 4, 'A deliciously sweet, beefy burger.', '1. 1 large sweet onion, chopped\r\n2. 1 pound lean ground beef\r\n3. salt and pepper to taste', '1. Preheat grill for high heat.\r\n2. In a large bowl mix together the onion, beef, and salt and pepper to taste. Form into patties.\r\n3. Lightly oil grate, and place burgers on grill. Cook for 3 to 5 minutes per side. Remove from grill, and serve with your favorite condiments.', 'beefBurger.jpg'),
(5, 2, 'Russian Beef Stroganoff', '00:10:00', '00:25:00', 4, 'This is an authentic Russian beef stroganoff recipe made with sour cream (in Russia we use smetana) and without mushrooms. It is very simple, but this is the original version. You can of course add onions as well if you like, but a lot of Russian recipes are quite basic. Serve over pasta or rice.', '1. 2 tablespoons all-purpose flour\r\n2. 1 pound sirloin steak, pounded to 1/4-inch thickness and cut into thin strips across the grain\r\n3. 2 tablespoons vegetable oil\r\n4. 2 tablespoons sour cream\r\n5. 1 tablespoon tomato paste\r\n6. salt and freshly ground black pepper to taste\r\n7. 1 tablespoon water, or as needed (optional)', '1. Place flour in a bowl. Toss beef strips in flour until coated on all sides.\r\n2. Heat oil in a large skillet over medium-high heat. Saute streak strips in the hot oil until browned, 3 to 5 minutes. Add sour cream, tomato paste, salt, and pepper; stir to combine. Add some water if mixture is too thick.\r\n3. Cover and simmer over low heat until meat is cooked through and soft, 20 to 25 minutes.', 'russianStrog.jpg'),
(6, 4, 'Homemade Mac and Cheese', '00:20:00', '00:30:00', 4, 'This is a nice rich mac and cheese. Serve with a salad for a great meatless dinner. Hope you enjoy it.', '1. 8 ounces uncooked elbow macaroni\r\n2. 2 cups shredded sharp Cheddar cheese\r\n3. 1/2 cup grated Parmesan cheese\r\n4. 1/4 cup butter\r\n5. 2 1/2 tablespoons all-purpose flour\r\n6. 2 tablespoons butter\r\n7. 1/2 cup bread crumbs\r\n8. 1 pinch paprika\r\n9. 3 cups milk', '1. Cook macaroni according to the package directions. Drain.\r\n2. In a saucepan, melt butter or margarine over medium heat. Stir in enough flour to make a roux. Add milk to roux slowly, stirring constantly. Stir in cheeses, and cook over low heat until cheese is melted and the sauce is a little thick. Put macaroni in large casserole dish, and pour sauce over macaroni. Stir well.\r\n3. Melt butter or margarine in a skillet over medium heat. Add breadcrumbs and brown. Spread over the macaroni and cheese to cover. Sprinkle with a little paprika.\r\n4. Bake at 350 degrees F (175 degrees C) for 30 minutes. Serve.', 'MacandCheese.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `User_ID` int(32) NOT NULL,
  `Username` varchar(64) NOT NULL,
  `Email` varchar(64) NOT NULL,
  `Password` varchar(256) NOT NULL,
  `User_Desc` text NOT NULL,
  `User_Img` varchar(256) NOT NULL,
  `Security_Q` tinytext NOT NULL,
  `Security_A` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User_ID`, `Username`, `Email`, `Password`, `User_Desc`, `User_Img`, `Security_Q`, `Security_A`) VALUES
(1, 'dropthejpeg', 'ciaranroc101@gmail.com', 'ddaf35a193617abacc417349ae20413112e6fa4e89a97ea20a9eeee64b55d39a2192992a274fc1a836ba3c23a3feebbd454d4423643ce80e2a9ac94fa54ca49f', 'A description fit for a king', 'profile-pic.png', 'Favourite animal', 'Cat'),
(2, 'Enrico Fermi', 'EnricoFermi@gmail.com', '4ec67697929241fabbda9290d0ecbc7aa1f5786c7827734635821941f66ba2e93da2d3e37793e3abdb4195bba33b984370bf0013efc50957e3378fca579710c3', 'I am a 27 year old Computer Scientist with a love of foreign cuisine.', 'Enrico.jpeg', 'Favourite animal', 'Cat'),
(3, 'Ingrid Daubechies', 'IngridDaubechies@hotmail.com', 'bb6be8afdec4df29f1a0fc214de889830833e217703bc3b3ebc548e6dbff0c14438c12dcab554c2d2bbfae148c0551c8ab9665491090af76164ccbade8a29567', 'I love Baking! 22 from Canada!', 'Ingrid.jpeg', 'Favourite animal', 'Cat'),
(4, 'Jane Goodall', 'JaneGoodall@gmail.com', 'a63c12208521ebbc4d5b536b321927867099a3ad5efacb66c0cdabcc3065c3b2700db13cf3fc32a62f8c6ce60c2feb9c61378bfa376b16c74bbc583e55b49e17', 'A sue pastry chef and full time mom.', 'jane.jpg', 'Favourite animal', 'Cat'),
(5, 'Lord Kelvin', 'LordKelvin@hotmail.com', '08d6c984b6753607354c714059e6cde7c51cc7886b1aa5c274b902a25680b3722be354690d17399064bba47c4de0c9b47de776a0e6470368321587b269a9384b', 'I have never cooked for myself', 'kelvin.jpeg', 'Favourite animal', 'Cat'),
(6, 'Paul', 'Kelly', '81ebecf2d67cff490ef46f030a661d4d9b2bd1e3947a087960dcec2387cee648d38b446f3a0648188ed18295560faf0605454025d5c9f94538fbe603443dc4a9', 'Full time Med Student, I love to cook for my friends', 'Paul.png', 'Favourite animal', 'Cat'),
(7, 'Carl', 'Marx', '47b165aeadb03e0fafa8e456b6c1ab578b18e0d05ae4ac85a950330001daf0db94cbd18a22b9e7a90e2af63a403e22e636e4e0bb08be40e1ddeed3925265368e', 'I am Carl.', 'Carl.jpg', 'Favourite animal', 'Cat'),
(8, 'test', 'test@gmail.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'abcabc', 'profile-pic.png', 'Favourite animal', 'Cat');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`Rating_ID`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`Recipe_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `Rating_ID` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `Recipe_ID` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_ID` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
