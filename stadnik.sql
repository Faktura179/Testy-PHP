-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2019 at 07:28 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stadnik`
--

-- --------------------------------------------------------

--
-- Table structure for table `pytania`
--

CREATE TABLE `pytania` (
  `ID` int(11) NOT NULL,
  `pytanie` varchar(600) COLLATE utf8mb4_polish_ci NOT NULL,
  `A` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `B` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `C` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `D` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `dobra` varchar(5) COLLATE utf8mb4_polish_ci NOT NULL,
  `poprawne` int(11) NOT NULL,
  `niepoprawne` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `pytania`
--

INSERT INTO `pytania` (`ID`, `pytanie`, `A`, `B`, `C`, `D`, `dobra`, `poprawne`, `niepoprawne`) VALUES
(1, 'Do grupowania obszarów na poziomie bloków, które będą formatowane za pośrednictwem znaczników, należy użyć', '<p>', '<div>', '<span>', '<param>', 'B', 6, 2),
(2, 'W MS SQL Server predefiniowana rola o nazwie dbcreator pozwala użytkownikowi na', 'zarządzanie plikami na dysku', 'zarządzanie bezpieczeństwem systemu', 'tworzenie, modyfikowanie, usuwanie i odzyskiwanie bazy danych', 'wykonywanie każdej operacji na serwerze i posiadanie prawa własności każdej bazy', 'C', 5, 1),
(3, 'W JavaScript wywołanie zdarzenia onKeydown nastąpi wtedy, gdy klawisz', 'myszki został naciśnięty', 'myszki został zwolniony', 'klawiatury został naciśnięty', 'klawiatury został zwolniony', 'C', 7, 2),
(4, 'Formularze do obsługi baz danych tworzy się w celu', 'raportowania danych', 'wyszukiwania wierszy spełniających dane kryteria', 'wprowadzenia powiązań w relacyjnych bazach danych', 'wygodniejszego wprowadzania, edytowania i usuwania danych', 'D', 5, 3),
(5, 'W programowaniu obiektowym mechanizm współdzielenia pól i metod klasy w taki sposób, że klasa pochodna zawiera metody zdefiniowane w klasie bazowej nazywa się', 'hermetyzacją', 'wirtualizacją', 'polimorfizmem', 'dziedziczeniem', 'D', 6, 2),
(6, 'Projektowanie logicznego układu witryny polega na', 'rozmieszczeniu elementów w konkretnych miejscach witryny', 'opracowaniu zestawu grafik dla witryny', 'zdefiniowaniu treści witryny', 'ustaleniu adresów URL dla podstron witryny', 'A', 4, 4),
(7, 'Język JavaScrypt ma obsługę', 'obiektów DOM', 'funkcji wirtualnych', 'klas abstrakcyjnych', 'wysyłania ciastek z tą samą informacją do wielu klientów strony', 'A', 2, 2),
(8, 'Aby stronę WWW można było przesłać do przeglądarki internetowej w postaci zaszyfrowanej, należy użyć protokołu', 'HTTPS', 'HTTP', 'SFTP', 'SSH', 'A', 6, 2),
(9, 'W językach programowania zmienna typu integer służy do przechowywania', 'znaku', 'liczby całkowitej', 'liczby rzeczywistej', 'wartości logicznej', 'B', 5, 3),
(10, 'Źródłem rekordów dla raportu może być', 'Tabela', 'Inny raport', 'Makropolecenie', 'Zapytanie INSERT INTO', 'A', 6, 2),
(11, 'Do reprezentacji liczb zmiennoprzecinkowych w języku C stosowany jest typ', 'int', 'bool', 'char', 'double', 'D', 3, 4),
(12, 'Przy użyciu którego znacznika w języku HTML nie można umieścić na stronie grafiki dynamicznej?', '<img>', '<strike>', '<embed>', '<object>', 'B', 5, 1),
(13, 'Kwerenda pozwalająca na wprowadzenie zmian w wielu rekordach lub przeniesienie wielu rekordów przy użyciu pojedynczej operacji, nosi nazwę kwerendy', 'krzyżowej', 'funkcjonalnej', 'wybierającej', 'parametrycznej', 'B', 4, 1),
(14, 'Językami programowania działającymi po stronie serwera są:', 'Java, C#, AJAX, Ruby, PHP', 'C#, Python, Ruby, PHP, JavaScript', 'Java, C#, Python, Ruby, PHP', 'Java, C#, Python, ActionScript, PHP', 'C', 4, 3),
(15, 'W bazie danych sklepu komputerowego istnieje tabela komputery. Aby zdefiniować raport wyświetlający dla dowolnego zbioru danych tabeli, jedynie pola tabeli dla komputerów, w których jest nie mniej niż 8 GB pamięci, a procesor to Intel, można posłużyć sie kwerendą', 'SELECT * FROM komputery WHERE procesor = \"Intel\" OR pamiec < 8;', 'SELECT * FROM komputery WHERE procesor = \"Intel\" OR pamiec >= 8;', 'SELECT * FROM komputery WHERE procesor = \"Intel\" AND pamiec < 8;', 'SELECT * FROM komputery WHERE procesor = \"Intel\" AND pamiec >= 8;', 'D', 4, 1),
(16, 'Wskaż prawidłową kolejność tworzenia aplikacji', 'Specyfikacja wymagań, analiza wymagań klienta, tworzenie, wdrażanie,testy', 'Analiza wymagań klienta, specyfikacja wymagań, tworzenie, testy, wdrażanie', 'Tworzenie, analiza wymagań klienta, specyfikacja wymagań, wdrażanie, testy', 'Analiza wymagań klienta, specyfikacja wymagań, tworzenie, wdrażanie, testy', 'B', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(50) COLLATE utf8mb4_polish_ci NOT NULL,
  `hash` varchar(80) COLLATE utf8mb4_polish_ci NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `poprawne` int(11) NOT NULL,
  `niepoprawne` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `hash`, `admin`, `poprawne`, `niepoprawne`) VALUES
('admin', '$2y$06$A3T9K67ABegoMRnfQqFHDeZIHTQhROMoIcwrmfZT8.G/1xX/mc97O', 1, 0, 0),
('user01', '$2y$06$oaA2lIbdGe83ReCERFP80.8O4yc3xSIj.2TFeS68FToSSin52dZLq', 0, 56, 14),
('user02', '$2y$06$MK6fshOYva2TfBltV3ExH.pvNG5RSwZMoRoXjwUqXrt02hr6M1J12', 0, 10, 20);

-- --------------------------------------------------------

--
-- Table structure for table `wyniki`
--

CREATE TABLE `wyniki` (
  `ID` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_polish_ci NOT NULL,
  `wynik` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `wyniki`
--

INSERT INTO `wyniki` (`ID`, `username`, `wynik`) VALUES
(1, 'user01', 6),
(2, 'user01', 9),
(3, 'user01', 10),
(4, 'user01', 8),
(5, 'user01', 8),
(6, 'user01', 9),
(7, 'user01', 7),
(8, 'user01', 10),
(9, 'user01', 4),
(10, 'user02', 10),
(11, 'user02', 0),
(12, 'user02', 0),
(13, 'user02', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pytania`
--
ALTER TABLE `pytania`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `wyniki`
--
ALTER TABLE `wyniki`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pytania`
--
ALTER TABLE `pytania`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `wyniki`
--
ALTER TABLE `wyniki`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
