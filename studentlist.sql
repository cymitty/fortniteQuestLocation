-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Май 01 2018 г., 10:02
-- Версия сервера: 10.1.31-MariaDB-1~trusty
-- Версия PHP: 7.0.28-1+ubuntu14.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `studentlist`
--

-- --------------------------------------------------------

--
-- Структура таблицы `abiturient`
--

CREATE TABLE `abiturient` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `groupNumber` varchar(5) NOT NULL,
  `points` int(3) NOT NULL,
  `birthYear` varchar(4) NOT NULL,
  `password` char(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `abiturient`
--

INSERT INTO `abiturient` (`id`, `name`, `lastName`, `email`, `groupNumber`, `points`, `birthYear`, `password`) VALUES
(19, 'Berenice', 'Mills', 'hokeefe@cole.org', '298', 103, '1988', '$2y$10$ckOW4uw/WvbFoZekStDC5.AG0FPiPayiuM50LfR5TRa6YrVpvdDdC'),
(20, 'Mark', 'Abernathy', 'tod56@kessler.com', '237', 102, '1980', '$2y$10$LDAxWVlRf..Q08Oq7.0fuuTlWGsx9IEWw195Lihlnq0HvaF4T.RHu'),
(21, 'Evert', 'Pfannerstill', 'elizabeth26@hotmail.com', '246', 254, '1990', '$2y$10$uQMdhlNLr2ZF7pAmvHUdy.iHS9Dz2f3HmOT3pFyBdABCCzOu7FAGO'),
(22, 'Jazlyn', 'Wintheiser', 'hyatt.liana@glover.com', '177', 189, '2006', '$2y$10$InIbWv3FyQ3g78GMvwzdh.kagDl8/hS/02hdcLBJwkeW2kBVvZexe'),
(23, 'Marcelo', 'Will', 'helena20@gerhold.info', '162', 47, '1993', '$2y$10$OzjcVxAD9AeQpL/T53TqyOUA8jMr7Oi.24kY4KT7fLLCz8Hc5ciDy'),
(24, 'Kristofer', 'Hayes', 'reginald.rippin@hotmail.com', '143', 138, '2012', '$2y$10$WUeP7bCm/wqwYGx7q.Y3UOV0PYjT6kQ0gcKqLCqYLPQSooWp093Aq'),
(25, 'Rowan', 'Mueller', 'derrick18@hotmail.com', '234', 230, '1986', '$2y$10$tz4DAIFMVuM7e9UOhb2jBuKUElyKIbLvg2PtvDTNECyJDsuVi6yTS'),
(26, 'Rogelio', 'Harber', 'mokon@gmail.com', '113', 121, '2000', '$2y$10$joPss.ctdMVYaPH4SQIzz.5Fi5wodi0/wcxBI72nEQ2BsiJlR.rWa'),
(27, 'Crystal', 'Boyer', 'kelton.hauck@yahoo.com', '164', 11, '2013', '$2y$10$SsnaUvOMBfVN61TxtcYo6.lRJzRky1Uw8y.itQtJhPLkG1qnvBNQS'),
(28, 'Opal', 'Goyette', 'mante.felicia@yahoo.com', '293', 158, '2006', '$2y$10$wxA65zRQOCQf/1PHU1vbHuiyOUbshb7uuoMcxTli5M3/iaxdFloEq'),
(29, 'Salvador', 'Hodkiewicz', 'alek05@sawayn.info', '227', 53, '1996', '$2y$10$OaM4Id/jJTO9q2DYg6pMOu7ZIPykkjDivA4yuXb5t8bf2g9/iKflS'),
(30, 'Mae', 'Hansen', 'bins.marco@kassulke.com', '223', 214, '2007', '$2y$10$8DpESpNlixumB43moiWjCO8B7.qBPICFNiYdTUX6V8Z9XDNrqXBiC'),
(31, 'Sage', 'Schuppe', 'reva.bode@turner.net', '172', 188, '2004', '$2y$10$UA1d.OnDc.6S4ssGk0DjbeQFcXIYVfacLMp1HREA0jQQ4RnBa0gCe'),
(32, 'Dianna', 'Emard', 'kayli.rutherford@hotmail.com', '177', 287, '1991', '$2y$10$/LnElUl77zkab9Yf9KE52eQz9O1QqBs4m/Ets8mbx4zHkuqSzMv3S'),
(33, 'Elisha', 'Ryan', 'sam80@bernier.com', '111', 48, '2010', '$2y$10$5BPHO9oDtSxX2LwuZ2hHHug.PyfYbdlPOhqwfIF7oOoxsWvle1lUu'),
(34, 'Ari', 'Okuneva', 'mossie72@hotmail.com', '296', 149, '1987', '$2y$10$qulIEABQuU35a820OpSl8ub/I/MBqSH5W5Jm0BHc5LJ9nDiGomvX6'),
(35, 'Myrna', 'Predovic', 'bkulas@howell.info', '292', 177, '1983', '$2y$10$/pmx9Z4WBPNBd/m.dO8CcOakMP4TIT4DxCpYNQkHV4/novwTccIAe'),
(36, 'Clint', 'Gerlach', 'heller.ignacio@hotmail.com', '199', 180, '2005', '$2y$10$HMXEjN0nO0woh1ac0xdpeePhmiavTjOOXWe4nG8LbDWk83p.5j/YG'),
(37, 'Houston', 'McLaughlin', 'sheridan12@altenwerth.biz', '252', 251, '2009', '$2y$10$EP8/PM6V/sPc.lH4lW2ldOi2RC1lNen2k9s6AuA.6TB5vYSKz3FG2'),
(38, 'Isadore', 'Anderson', 'zwunsch@hotmail.com', '100', 216, '1986', '$2y$10$0WC91rH9gNdJC0sMsspP4e6wM49el6/9NsE9/98BXdOYzOnwMoRPq'),
(39, 'Brennon', 'Kohler', 'fdoyle@welch.com', '263', 26, '1975', '$2y$10$sT.VZ.K6rUxL2CGmSQjJaeGe/jMw/RNDmDarZJ7vNerlEUfqjcauK'),
(40, 'Fritz', 'Wiza', 'ashleigh.goyette@hotmail.com', '299', 254, '1991', '$2y$10$MpZxD0zmXc0IVG1cBGabRe1rlo9JtJiTaxX1xHA2uu6OxqxgNpOUO'),
(41, 'Freda', 'Kessler', 'guy76@rempel.com', '113', 177, '1975', '$2y$10$fyZkG7AgWO4d2xjVXQnPDetysnOXfp.87Vk7ahpSW8..5dCbYbxJi'),
(42, 'Dora', 'Marks', 'mayert.frank@hotmail.com', '106', 179, '1980', '$2y$10$hC/37Kenym0in9RdJox0k.ijHoEn71d1tc/GR8Zde9E8CFlzYXUqy'),
(43, 'Jermain', 'Beier', 'doyle28@miller.com', '170', 53, '1978', '$2y$10$CTm.VIVHtoOI7C1QQQTY..Wm3G6aABZw4yEWV8KMKi9x91roKtAN2'),
(44, 'Yasmin', 'Lynch', 'adah.bayer@hotmail.com', '245', 86, '2014', '$2y$10$0qx.z8Dm1/R.mMOgdHvsoObUKYnqxql/U9BZTc5TIyx6qGLHLonua'),
(45, 'Dereck', 'Johns', 'heloise53@yahoo.com', '180', 32, '1982', '$2y$10$Vh.1BfLclAFWWT27o3SMO.U3pQeiw73As816y6VzluJKpq.tCeIna'),
(46, 'Lisette', 'Bergstrom', 'huels.anthony@gmail.com', '272', 71, '1996', '$2y$10$KDZ/RaXUa.CqyCTncLWdtucUD826PcTdVNGftbGPbhXLmi10.TZhW'),
(47, 'Evie', 'Pfeffer', 'krystina.anderson@gmail.com', '124', 42, '1987', '$2y$10$LMTqruYsxK.x9w9gkdjtceTYcmUPEIGLomvsiGmSlJpdGPYYor8OC'),
(48, 'Mustafa', 'Hammes', 'yokeefe@smitham.biz', '293', 7, '2008', '$2y$10$4eDJUiBR83S2SR8dESGrl.4g7wJbJXVRGVu92O.R9GuD1YOM.lJcO'),
(49, 'Bret', 'Mueller', 'abbigail.bailey@graham.info', '138', 272, '1988', '$2y$10$4jrUcImJKHHC0MFgYenwqO/3PJdZWBRjyH1khsPBR12m8T3JQ6VWa'),
(50, 'Kurtis', 'Douglas', 'karlee.russel@schultz.biz', '133', 78, '1994', '$2y$10$3IKqbc/7mFhQT3ZT8QZdgehu6T.XdqvjgWsm6KS6dPfqPLQgpawES'),
(51, 'Emely', 'Kulas', 'bhoeger@hotmail.com', '100', 243, '1992', '$2y$10$l7HrXz6AVbUN/5iG4X/qFey5rncppnLYDZxcW3l7qhjbkdGgGHXQW'),
(52, 'Clemens', 'Muller', 'cielo.murazik@price.com', '250', 16, '1978', '$2y$10$swHEP/j9UZTemPkw24XdV.8AB5gL1E.FY4HOTEO6SYeQPV6QsTpLe'),
(53, 'Schuyler', 'Halvorson', 'jaquan01@gmail.com', '259', 97, '1996', '$2y$10$KEHvGfTG4ARGPDN0RayWyeiqq4suu.UyxHnktTz89i1l355wlm6um'),
(54, 'Woodrow', 'Runolfsdottir', 'german86@yahoo.com', '127', 181, '1988', '$2y$10$Tl3NxB/k2jxL/dxIBC8lJujT1f0nBdpr2cpri3Cnuje..XcToW9my'),
(55, 'Matt', 'Dibbert', 'delpha53@yahoo.com', '269', 181, '1989', '$2y$10$bqN1TxhD8kKVkO7YCY21D.JgC43FysEXIcW4JD9KKJkQYj532jjce'),
(56, 'Edmond', 'Auer', 'ksanford@gmail.com', '218', 181, '1983', '$2y$10$slqDwn/Lw5RgM.l81vVqQecYW2mMKmkPQkxlPOTPjgKx0fn8M21Au'),
(57, 'Coralie', 'Hilpert', 'everette05@padberg.com', '162', 165, '1983', '$2y$10$b2kJZYfh.QcYNtRIRLgFx.EHoDBjsR5xs/S9gzk5IofEvZcLbMury'),
(58, 'Destin', 'Murray', 'ignatius.sipes@hotmail.com', '128', 247, '2008', '$2y$10$q.o/DRVAdof.eoLrEDTHOORP94SugJlkE1pgAy3iQWhPwmUZqHorO');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `abiturient`
--
ALTER TABLE `abiturient`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `abiturient`
--
ALTER TABLE `abiturient`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
