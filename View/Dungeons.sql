--
-- Database: `Dungeons`
--

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE User
{
  User_ID int(11) PRIMARY KEY AUTO_INCREMENT,
  Email varchar(50) NOT NULL,
  Username varchar(30) NOT NULL,
  Password varchar(300) NOT NULL
}

-- --------------------------------------------------------
Create Table Race
{
  Race_ID int(11) PRIMARY KEY,
  Size varchar(10) NOT NULL,
  Speed varchar(7) NOT NULL,
  Abilities varchar(MAX),
  Languages varchar(300) NOT NULL,
  Ability_mods varchar(100),
  Proficiencies varchar(50)
}
-- --------------------------------------------------------

CREATE TABLE Class
{
  Class_ID int(11) PRIMARY KEY,
  ClassName varchar(30) NOT NULL,
  HitDice int(2) NOT NULL
}

CREATE TABLE Character

CREATE TABLE Armour
(
  Armour_ID int(11) NOT NULL,
  Name varchar(50) NOT NULL,
  Category varchar(50) NOT NULL,
  AC varchar(50) NOT NULL,
  Strength varchar(30) NOT NULL,
  Stealth varchar(30) NOT NULL,
  Weight varchar(9) NOT NULL,
  Cost varchar(9) NOT NULL
)

--
-- Dumping data for table `Armour`
--

INSERT INTO Armour
(Armour_ID, Name, Category, AC, Strength, Stealth, Weight, Cost) VALUES
(1, 'Padded', 'Light Armour', '11 + Dex Mod', 'N/A', 'Disadvantage', '8lb', '5gp'),
(2, 'Leather', 'Light Armour', '11 + Dex Mod', 'N/A', 'N/A', '10lb', '10gp'),
(3, 'Studded Leather', 'Light Armour', '12 + Dex Mod', 'N/A', 'N/A', '13lb', '45gp'),
(4, 'Hide', 'Medium Armour', '12 + Dex Mod (MAX 2)', 'N/A', 'N/A', '12lb', '10gp'),
(5, 'Chain Shirt', 'Medium Armour', '13 + Dex Mod (MAX 2)', 'N/A', 'N/A', '20lb', '50gp'),
(6, 'Scale Mail', 'Medium Armour', '14 +  Dex Mod (MAX 2)', 'N/A', 'Disadvantage', '45lb', '50gp'),
(7, 'BreastPlate', 'Medium Armour', '14 +  Dex Mod (MAX 2)', 'N/A', 'N/A', '20lb', '400gp'),
(8, 'Half Plate', 'Medium Armour', '15 + Dex Mod (MAX 2)', 'N/A', 'Disadvantage', '40lb', '750gp'),
(9, 'Ring Mail', 'Heavy Armour', '14', 'N/A', 'Disadvantage', '40lb', '30gp'),
(10, 'Chain Mail', 'Heavy Armour', '16', '13', 'Disadvantage', '55lb', '75gp'),
(11, 'Splint', 'Heavy Armour', '17', '15', 'Disadvantage', '60lb', '200gp'),
(12, 'Half Plate', 'Heavy Armour', '18', '15', 'Disadvantage', '65lb', '1,500gp'),
(13, 'Shield', 'Shield', '+2', 'N/A', 'N/A', '6lb', '10gp');

-- --------------------------------------------------------

--
-- Table structure for table `bag`
--

CREATE TABLE `bag` (
  `Bag_ID` varchar(30) NOT NULL,
  `Pp` int(11) NOT NULL,
  `Gp` int(11) NOT NULL,
  `Sp` int(11) NOT NULL,
  `Cp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bag`
--

INSERT INTO `bag` (`Bag_ID`, `Pp`, `Gp`, `Sp`, `Cp`) VALUES
('18414e1f122', 1, 18, 14, 17),
('b514d18132', 1, 2, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `Equipment_ID` varchar(30) NOT NULL,
  `Armour_ID` int(11) NOT NULL,
  `Weapon_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `Note_ID` varchar(30) NOT NULL,
  `Equipment_Note` varchar(5000) NOT NULL,
  `Bag_Note` varchar(5000) NOT NULL,
  `Spell_Note` varchar(5000) NOT NULL,
  `Notes_Note` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`Note_ID`, `Equipment_Note`, `Bag_Note`, `Spell_Note`, `Notes_Note`) VALUES
('18414e1f122', 'hsdfdfgdsafdgfdqwerg', '4x healing potion', '', ''),
('b514d18132', 'equipy note', 'baggy bag', 'spelly spells', 'notery');

-- --------------------------------------------------------

--
-- Table structure for table `player_character`
--

CREATE TABLE `player_character` (
  `Character_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Code` varchar(20) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Alignment` varchar(20) NOT NULL,
  `Exp` int(11) NOT NULL,
  `Level` int(2) NOT NULL,
  `RaceName` varchar(30) NOT NULL,
  `ClassName` varchar(30) NOT NULL,
  `AC` int(2) NOT NULL,
  `Max_HP` int(3) NOT NULL,
  `HP` int(3) NOT NULL,
  `Strength` int(2) NOT NULL,
  `Dexterity` int(2) NOT NULL,
  `Constitution` int(2) NOT NULL,
  `Intelligence` int(2) NOT NULL,
  `Wisdom` int(2) NOT NULL,
  `Charisma` int(2) NOT NULL,
  `Saving_Throws` varchar(100) NOT NULL,
  `Proficiencies` varchar(300) NOT NULL,
  `Language` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `player_character`
--

INSERT INTO `player_character` (`Character_ID`, `User_ID`, `Code`, `Name`, `Alignment`, `Exp`, `Level`, `RaceName`, `ClassName`, `AC`, `Max_HP`, `HP`, `Strength`, `Dexterity`, `Constitution`, `Intelligence`, `Wisdom`, `Charisma`, `Saving_Throws`, `Proficiencies`, `Language`) VALUES
(26, 2, '18414e1f122', 'Maze', 'Nuetral Good', 250000, 17, 'Half-Elf', 'Warlock', 12, 25, 25, 15, 17, 17, 15, 12, 12, '', ' sleightOfHand, perception, persuasion', ' common'),
(27, 2, 'b514d18132', 'bobbery', 'Lawful Good', 280, 1, 'Dragonborn', 'Warlock', 12, 36, 36, 14, 13, 12, 12, 13, 14, ' Wisdom, Charisma', ' nature, insight, medicine, perception, survival', ' common, draconic');

-- --------------------------------------------------------

--
-- Table structure for table `spellbook`
--

CREATE TABLE `spellbook` (
  `Spellbook_ID` varchar(30) NOT NULL,
  `Known` varchar(1000) NOT NULL,
  `Prepared` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `spellbook`
--

INSERT INTO `spellbook` (`Spellbook_ID`, `Known`, `Prepared`) VALUES
('18414e1f122', 'Fireball, Mirror image, wall of fire', 'None'),
('b514d18132', 'Misty step', 'None');



--
-- Table structure for table `weapon`
--

CREATE TABLE `weapon` (
  `Weapon_ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Category` varchar(30) NOT NULL,
  `Damage_Dice` varchar(9) NOT NULL,
  `Damage_Type` varchar(50) NOT NULL,
  `Properties` varchar(500) NOT NULL,
  `Weight` varchar(9) NOT NULL,
  `Cost` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `weapon`
--

INSERT INTO `weapon` (`Weapon_ID`, `Name`, `Category`, `Damage_Dice`, `Damage_Type`, `Properties`, `Weight`, `Cost`) VALUES
(1, 'Club', 'Simple Melee Weapon', '1D4', 'Bludgeoning', 'Light', '2lb', '1sp'),
(2, 'Dagger', 'Simple Melee Weapon', '1D4', 'Piercing', 'Finesse, Light, Thrown (Range 20/60)', '1lb', '2gp'),
(3, 'Greatclub', 'Simple Melee Weapon', '1D8', 'Bludgeoning', 'Two-handed', '10lb', '2sp'),
(4, 'Handaxe', 'Simple Melee Weapon', '1D6', 'Slashing', 'Light, Thrown (Range 20/60)', '2lb', '5gp'),
(5, 'Javelin', 'Simple Melee Weapon', '1D6', 'Piercing', 'Thrown (Range 30/120)', '2lb', '5sp'),
(6, 'Light Hammer', 'Simple Melee Weapon', '1D4', 'Bludgeoning', 'Light, Thrown (Range 20/60)', '2lb', '2gp'),
(7, 'Mace', 'Simple Melee Weapon', '1D6', 'Bludgeoning', 'N/A', '4lb', '5gp'),
(8, 'Quarterstaff', 'Simple Melee Weapon', '1D6', 'Bludgeoning', 'Versatile (1D8)', '4lb', '2sp'),
(9, 'Sickle', 'Simple Melee Weapon', '1D4', 'Slashing', 'Light', '2lb', '1gp'),
(10, 'Spear', 'Simple Melee Weapon', '1D6', 'Piercing', 'Thrown (Range 20/60), Versitile (1D8)', '3lb', '1gp'),
(11, 'Light-Crossbow', 'Simple Ranged Weapon', '1D8', 'Piercing', 'Ammunition (Range 80/320), Loading, Two-handed', '5lb', '25gp'),
(12, 'Dart', 'Simple Ranged Weapon', '1D4', 'Piercing', 'Finesse, Thrown (Range 20/60)', '1/4lb', '5cp'),
(13, 'Shortbow', 'Simple Ranged Weapon', '1D6', 'Piercing', 'Ammunition (Range 80/320), Two-handed', '2lb', '25gp'),
(14, 'Sling', 'Simple Ranged Weapon', '1D4', 'Bludgeoning', 'Ammunition (Range 30/120)', 'N/A', '1sp'),
(15, 'Battleaxe', 'Martial Melee Weapon', '1D8', 'Slashing', 'Versitile (1D10)', '4lb', '10gp'),
(16, 'Flail', 'Martial Melee Weapon', '1D8', 'Bludgeoning', 'N/A', '2lb', '10gp'),
(17, 'Glaive', 'Martial Melee Weapon', '1D10', 'Slashing', 'Heavy, Reach, Two-handed', '6lb', '20gp'),
(18, 'Greataxe', 'Martial Melee Weapon', '1D12', 'Slashing', 'Heavy, Two-handed', '7lb', '30gp'),
(19, 'Greatsword', 'Martial Melee Weapon', '1D12', 'Slashing', 'Heavy, Two-handed', '6lb', '50gp'),
(20, 'Halberd', 'Martial Melee Weapon', '1D10', 'Slashing', 'Heavy, Reach, Two-handed', '6lb', '20gp'),
(21, 'Lance', 'Martial Melee Weapon', '1D12', 'Slashing', 'Reach, Special', '6lb', '10gp'),
(22, 'Longsword', 'Martial Melee Weapon', '1D8', 'Slashing', 'Versitile (1D10)', '3lb', '15gp'),
(23, 'Maul', 'Martial Melee Weapon', '2D6', 'Bludgeoning', 'Heavy, Two-handed', '10lb', '10gp'),
(24, 'Morningstar', 'Martial Melee Weapon', '1D8', 'Piercing', 'N/A', '4lb', '15gp'),
(25, 'Pike', 'Martial Melee Weapon', '1D10', 'Piercing', 'Heavy, Reach, Two-handed', '18lb', '5gp'),
(26, 'Rapier', 'Martial Melee Weapon', '1D8', 'Piercing', 'Finesse', '2lb', '25gp'),
(27, 'Scimitar', 'Martial Melee Weapon', '1D6', 'Slashing', 'Finesse, Light', '3lb', '25gp'),
(28, 'Shortsword', 'Martial Melee Weapon', '1D6', 'Piercing', 'Finesse, Light', '2lb', '10gp'),
(29, 'Trident', 'Martial Melee Weapon', '1D6', 'Piercing', 'Thrown (Range 20/60), Versitile (1D8)', '4lb', '5gp'),
(30, 'War Pick', 'Martial Melee Weapon', '1D8', 'Piercing', 'N/A', '2lb', '5gp'),
(31, 'Warhammer', 'Martial Melee Weapon', '1D8', 'Bludgeoning', 'Versitile (1D8)', '2lb', '15gp'),
(32, 'Whip', 'Martial Melee Weapon', '1D4', 'Slashing', 'Finesse, Reach', '3lb', '2gp'),
(33, 'Blowgun', 'Martial Ranged Weapon', '1', 'Piercing', 'Ammunition (Range 25/100), Loading', '1lb', '10gp'),
(34, 'Hand-Crossbow', 'Martial Ranged Weapon', '1D6', 'Piercing', 'Ammunition (30/120), Light, Loading', '3lb', '75gp'),
(35, 'Heavy-Crossbow', 'Martial Ranged Weapon', '1D10', 'Piercing', 'Ammunition (Range 100/400), Heavy, Loading, Two-handed', '18lb', '50gp'),
(36, 'Longbow', 'Martial Ranged Weapon', '1D8', 'Piercing', 'Ammunition (Range 150/600), Heavy, Two-handed', '2lb', '50gp'),
(37, 'Net', 'Martial Ranged Weapon', 'N/A', 'N/A', 'Special, Thrown (Range 5/15)', '3lb', '1gp');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `armour`
--
ALTER TABLE `armour`
  ADD PRIMARY KEY (`Armour_ID`);

--
-- Indexes for table `bag`
--
ALTER TABLE `bag`
  ADD PRIMARY KEY (`Bag_ID`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`Equipment_ID`),
  ADD KEY `armour_FK` (`Armour_ID`),
  ADD KEY `weapon_FK` (`Weapon_ID`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`Note_ID`);

--
-- Indexes for table `player_character`
--
ALTER TABLE `player_character`
  ADD UNIQUE KEY `Unique` (`Code`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `spellbook`
--
ALTER TABLE `spellbook`
  ADD PRIMARY KEY (`Spellbook_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_ID`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `weapon`
--
ALTER TABLE `weapon`
  ADD PRIMARY KEY (`Weapon_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `armour`
--
ALTER TABLE `armour`
  MODIFY `Armour_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `player_character`
--
ALTER TABLE `player_character`
  MODIFY `Character_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `weapon`
--
ALTER TABLE `weapon`
  MODIFY `Weapon_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `equipment`
--
ALTER TABLE `equipment`
  ADD CONSTRAINT `armour_FK` FOREIGN KEY (`Armour_ID`) REFERENCES `armour` (`Armour_ID`),
  ADD CONSTRAINT `weapon_FK` FOREIGN KEY (`Weapon_ID`) REFERENCES `weapon` (`Weapon_ID`);

--
-- Constraints for table `player_character`
--
ALTER TABLE `player_character`
  ADD CONSTRAINT `Player_Character_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
