--
-- Структура таблицы `Booking`
--

CREATE TABLE `Booking` (
  `Id` int NOT NULL,
  `Date_start` varchar(35) NOT NULL,
  `Date_end` varchar(35) NOT NULL,
  `Client_came` int NOT NULL,
  `Active` int NOT NULL,
  `Price` int NOT NULL,
  `Сomputer_Id` int NOT NULL,
  `User_Id` int NOT NULL
);

-- --------------------------------------------------------

--
-- Структура таблицы `Computer`
--

CREATE TABLE `Computer` (
  `Id` int NOT NULL,
  `Rate` int NOT NULL
);

-- --------------------------------------------------------

--
-- Структура таблицы `Post`
--

CREATE TABLE `Post` (
  `Id` int NOT NULL,
  `Title` varchar(75) NOT NULL,
  `Body` varchar(300) NOT NULL,
  `Img` varchar(100) NOT NULL,
  `User_Id` int NOT NULL
);

-- --------------------------------------------------------

--
-- Структура таблицы `Roles`
--

CREATE TABLE `Roles` (
  `Id` int NOT NULL,
  `Role` varchar(50) DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Структура таблицы `User`
--

CREATE TABLE `User` (
  `Id` int NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Telephone` varchar(30) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Role_id` int NOT NULL
);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Booking`
--
ALTER TABLE `Booking`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `User_Id` (`User_Id`),
  ADD KEY `Сomputer_Id` (`Сomputer_Id`);

--
-- Индексы таблицы `Computer`
--
ALTER TABLE `Computer`
  ADD PRIMARY KEY (`Id`);

--
-- Индексы таблицы `Post`
--
ALTER TABLE `Post`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `User_Id` (`User_Id`);

--
-- Индексы таблицы `Roles`
--
ALTER TABLE `Roles`
  ADD PRIMARY KEY (`Id`);

--
-- Индексы таблицы `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Role_id` (`Role_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Booking`
--
ALTER TABLE `Booking`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `Computer`
--
ALTER TABLE `Computer`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `Post`
--
ALTER TABLE `Post`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `Roles`
--
ALTER TABLE `Roles`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `User`
--
ALTER TABLE `User`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Booking`
--
ALTER TABLE `Booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`User_Id`) REFERENCES `User` (`Id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`Сomputer_Id`) REFERENCES `Computer` (`Id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `Post`
--
ALTER TABLE `Post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`User_Id`) REFERENCES `User` (`Id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `User`
--
ALTER TABLE `User`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`Role_id`) REFERENCES `Roles` (`Id`) ON DELETE RESTRICT ON UPDATE RESTRICT;






-- Сущность роли
INSERT INTO Roles(Role)
VALUES
    ("Клиент"),
    ("Сотрудник");

-- Сущность пользователи
INSERT INTO User(Name,Email,Telephone,Password,Role_id)
VALUES
    ("Кирилл","Kirill@gmail.com","89630558905","qwerty123",1);

-- Сущность Пост
INSERT INTO Post(Title,Body,Img,User_Id)
VALUES
    ("Мы открыты!", "Задача организации, в особенности же сложившаяся структура организации позволяет оценить значение соответствующий условий активизации", "img/photo_post.jpg", 1),
    ("Задача", "Задача организации, в особенности же новая модель организационной деятельности позволяет оценить значение форм развития", NULL, 1);

-- Сущность компьютер
INSERT INTO Computer(Rate)
VALUES
    (70),(70),(70),(70),(70),
    (70),(70),(70),(70),(70),
    (70),(70),(70),(70),(70),
    (70),(70),(70),(70),(70);

