-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2025 at 12:58 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projekat`
--

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `user_id` int(40) NOT NULL,
  `user_name` varchar(40) NOT NULL,
  `user_email` varchar(40) NOT NULL,
  `subject` varchar(40) NOT NULL,
  `message` varchar(40) NOT NULL,
  `message_id` int(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`user_id`, `user_name`, `user_email`, `subject`, `message`, `message_id`) VALUES
(9, 'laki', '', 'dasdas', 'dasdas', 1),
(9, 'laki', 'laki@gmail.com', 'dasdas', 'dasdasdasdasdasdasdasdasdasdasdasdasdasd', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_cost` decimal(8,2) NOT NULL,
  `order_status` varchar(100) NOT NULL DEFAULT 'on_hold',
  `user_id` int(11) NOT NULL,
  `user_phone` int(11) NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_cost`, `order_status`, `user_id`, `user_phone`, `user_city`, `user_address`, `order_date`) VALUES
(31, 16500.00, 'Pouzecem', 9, 567567, 'aadsads', 'dasdas', '2025-02-12 12:39:52'),
(32, 21166.00, 'Pouzecem', 9, 756567, 'adsdas', 'adsads', '2025-02-13 12:31:18');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_price` decimal(8,2) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `product_name`, `product_image`, `product_price`, `product_quantity`, `user_id`, `order_date`) VALUES
(12, 18, '2', 'Skije rossignol', 'rossignolS.webp', 155.00, 1, 9, '2024-12-26 12:25:52'),
(13, 19, '2', 'Skije rossignol', 'rossignolS.webp', 155.00, 1, 9, '2024-12-26 12:28:58'),
(14, 20, '2', 'Skije rossignol', 'rossignolS.webp', 155.00, 1, 9, '2024-12-29 02:52:01'),
(15, 20, '3', 'Pacerice head', 'headP.avif', 155.00, 1, 9, '2024-12-29 02:52:01'),
(16, 20, '7', 'Skije atomic', 'atomiS.jpg', 155.00, 1, 9, '2024-12-29 02:52:01'),
(17, 21, '3', 'Pacerice head', 'headP.avif', 155.00, 1, 13, '2024-12-30 13:45:22'),
(18, 22, '4', 'Pacerice fischer', 'fischerP.jpg', 155.00, 1, 14, '2024-12-30 13:46:45'),
(19, 23, '3', 'Pacerice head', 'headP.avif', 155.00, 1, 15, '2024-12-30 13:49:00'),
(20, 24, '3', 'Pacerice head', 'headP.avif', 155.00, 1, 9, '2025-01-05 11:15:36'),
(21, 25, '4', 'Pacerice fischer', 'fischerP.jpg', 155.00, 1, 9, '2025-01-05 11:15:55'),
(22, 26, '3', 'Pacerice head', 'headP.avif', 155.00, 1, 9, '2025-01-05 12:12:31'),
(23, 0, '2', 'Skije rossignol', 'rossignolS.webp', 155.00, 1, 9, '2025-01-13 15:33:47'),
(24, 27, '3', 'Pacerice head', 'headP.avif', 155.00, 1, 9, '2025-01-13 15:34:12'),
(25, 28, '42', 'Skije Nordica Doberman', 'SKIA3524KB001_4_1_1.jpg', 7500.00, 1, 9, '2025-02-12 12:37:52'),
(26, 29, '41', 'Nordica pancerice', 'SKI50P34004R3_1_1.jpg', 9000.00, 1, 9, '2025-02-12 12:38:12'),
(27, 29, '42', 'Skije Nordica Doberman', 'SKIA3524KB001_4_1_1.jpg', 7500.00, 1, 9, '2025-02-12 12:38:12'),
(28, 30, '41', 'Nordica pancerice', 'SKI50P34004R3_1_1.jpg', 9000.00, 1, 9, '2025-02-12 12:38:54'),
(29, 30, '42', 'Skije Nordica Doberman', 'SKIA3524KB001_4_1_1.jpg', 7500.00, 1, 9, '2025-02-12 12:38:54'),
(30, 31, '41', 'Nordica pancerice', 'SKI50P34004R3_1_1.jpg', 9000.00, 1, 9, '2025-02-12 12:39:52'),
(31, 31, '42', 'Skije Nordica Doberman', 'SKIA3524KB001_4_1_1.jpg', 7500.00, 1, 9, '2025-02-12 12:39:52'),
(32, 32, '42', 'Skije Nordica Doberman', 'SKIA3524KB001_4_1_1.jpg', 7500.00, 1, 9, '2025-02-13 12:31:18'),
(33, 32, '44', 'NGN Bruri rukavice', '14024_BLK-02_1.jpg', 4666.00, 1, 9, '2025-02-13 12:31:18'),
(34, 32, '41', 'Nordica pancerice', 'SKI50P34004R3_1_1.jpg', 9000.00, 1, 9, '2025-02-13 12:31:18'),
(35, 33, '44', 'NGN Bruri rukavice', '14024_BLK-02_1.jpg', 4666.00, 5, 9, '2025-02-13 12:31:33'),
(36, 34, '41', 'Nordica pancerice', 'SKI50P34004R3_1_1.jpg', 9000.00, 1, 23, '2025-02-15 16:54:48'),
(37, 34, '44', 'NGN Bruri rukavice', '14024_BLK-02_1.jpg', 4666.00, 1, 23, '2025-02-15 16:54:48'),
(38, 34, '49', 'Atomic Hawx Prime Xtd 120 Gw', 'AE5029160-01_1.jpg', 6300.00, 1, 23, '2025-02-15 16:54:48');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `product_category` varchar(108) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `product_description` varchar(10000) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `product_image` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `product_image2` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `product_image3` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `product_image4` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_special_offer` int(2) DEFAULT NULL,
  `product_color` varchar(108) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_category`, `product_description`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_price`, `product_special_offer`, `product_color`) VALUES
(41, 'Nordica pancerice', 'Pancerice', 'UNLIMITED\r\nWhere Boundaries Don?t Exist\r\n\r\nManje Te?ine. Vi?e Zabave.\r\n\r\nMo?ete uzeti svoju tortu i pojesti je. Za dokaz, ne tra?ite dalje od Nordicine Unlimited ski cipele. Bez kompromisa, ove all-mountain cipele su podjednako pogodne za skijanje, hiking i skinning. Njihova Tri Force man?etna pru?a izuzetnu kontrolu i odgovor. Aluminijumski ski-walk mehanizam poja?ava prenos snage pri spu?tanju, a istovremeno nudi ogroman raspon pokreta prilikom penjanja. Sistem ?i?anog zatvaranja cipele obavija konture va?eg stopala za precizno i udobno pristajanje, dok vam donja kop?a omoguc?ava da lako olabavite ceo sistem prilikom hiking ili skinning-a. Nudec?i neverovatni grip i performanse, ?on cipele je kompatibilan i sa standardnim i sa touring vezovima. A u slu?aju da ?on iz sezone u sezonu izla?ete na kamenitom terenu, lako se mo?e zameniti zahvaljujuc?i dizajnu na ?rafovima. Zagrlite avanturu uz Nordicinu Unlimited cipelu.\r\n\r\nUNLIMITED 130 DYN\r\n\r\nGde granice ne postoje ...\r\n\r\nBilo da se va?e avanture vrte oko napornog treninga u odmarali?tu, celodnevnih obilazaka ili patrola u zoru sa prijateljima, Nordica Unlimited 130 DYN deli va?u strast. Uzgajan da pru?i izuzetne performanse i na prilazu i na spu?tanju, postavlja novi standard u all-mountain touring cipelama. Umesto klasi?nih kop?i, prikazuje aerodinami?an sistem ?i?anog zatvaranja koji dr?i va?e stopalo i nudi precizno pristajanje koje maksimizira udobnost i kontrolu. A kada do?e vreme za hike, skin, ili samo da olabavite cipele, mo?ete jednostavno da otkop?ate quick-release power strap i okrenite toe buckle da biste oslobodili sistem zatvaranja za vec?u udobnost i mobilnost. Sofisticirana man?etna koristi mek?u plastiku da bezbedno obavija va?e stopalo, a super kruta ki?ma poja?ava prenos energije za bolji odziv i samopouzdanje. Da bi dodatno pobolj?ao udobnost i efikasnost, Unlimited 130 DYN ima ski-walk mehanizam koji nudi izuzetan opseg kretanja od 65 stepeni. A da biste bolje zadovoljili svoje potrebe i povec?ali kontrolu, mo?ete lako da prilagodite forward lean - naginjanje napred. Ukorenjena u udobnosti i izvanrednim performansama pri spu?tanju, 3D Corkfit PrimaLoft Light ulo?ak grli konture va?eg stopala i mo?e da se termo oblikuje za zaista prilago?eno pristajanje. Za ogromnu svestranost, ?on cipele ima DYN umetke i kompatibilan je sa GripWalk sistemima vezova. A zahvaljujuc?i dizajnu sa ?rafovima, ?on se mo?e lako zameniti kako bi se maksimizirao ?ivotni vek cipele.\r\n?ivite punim pluc?ima uz Nordica Unlimited 130 DYN.', 'SKI50P34004R3_1_1.jpg', 'SKI50P34004R3_2_1_1.jpg', 'SKI50P34004R3_3_1_1.jpg', 'SKI50P34004R3_5_1_1.jpg', 9000.00, 0, 'Crna'),
(42, 'Skije Nordica Doberman', 'Skije', 'Race / On Piste\r\nDobermann DC\r\nRace Instinct\r\n\r\nFAST. FORWARD.\r\nCela Doberman linija dizajnirana je za skija?e koji zahtevaju visoke performanse, on-piste preciznost. Izgra?ene koriste?i tri godine studija i testiranja na snegu, skije su fluidnije u luku, glatke su i br?e zahvaljuju?i nizu novih tehnologija. To uklju?uje novi Recoil Power Plate koji omogu?ava skijama da se prirodno savijaju, pru?aju?i tako ?ivahniju vo?nju. Sve skije u liniji modelirane su posle Nordica World Cup race skija, ali Dobermann linija izgra?ena je da dominira u rekreativnim race ligama sa nivoom izvrsnosti kojem nijedna druga skija ne mo?e da parira. Dodajte ?vrstoc?u titanijuma i ?ivahno drveno jezgro, i imate najzabavniji ski na?in da idete brzo.\r\n\r\n \r\n\r\nDobermann Multigara DC FDT\r\nNordica Dobermann Multigara DC je spremna da glumi u va?im snovima. Naoru?an neverovatnom svestrano?c?u, podjednako je kao kod kuc?e kada pravi brze zaokrete i velike, te?ne rezove. Nije ni ?udo ?to je omiljen me?u puristima na stazi. Dobermann Mulitgare DC Double Core integri?e Pulse Core izme?u dva postavljena drvena jezgra, koja su ugra?ena u dva sloja Titanala. Ovo pru?a izuzetnu snagu i preciznost, a istovremeno stvara neverovatno glatku i stabilnu vo?nju. A da bi dodatno povec?ao va?e samopouzdanje i kontrolu, poseduje novu plo?u iz dva dela napravljenu od cinka i aluminijuma. Ova plo?a maksimizira prenos energije pri pokretanju zavoja, dok omoguc?ava skiji da se prirodno savija za izuzetne performanse. Nordica Dobermann Multigara DC krade predstavu ? i nikad ne gleda unazad.', 'SKIA3524KB001_4_1_1.jpg', 'SKIA3524KB001_3_1_1.jpg', 'SKIA3524KB001_2_1_1.jpg', 'SKIA3524KB001_1_1.jpg', 7500.00, 0, 'Crna'),
(44, 'NGN Bruri rukavice', 'Rukavice', 'Rukavice', '14024_BLK-02_1.jpg', '14024_BLK-01_1.jpg', NULL, NULL, 4666.00, 0, 'Crna'),
(45, 'Kaciga Dainese scarabeo', 'Kaciga', 'Dainese SCARABEO ELEMENTO juniorska ski kaciga.\r\n\r\nDainese SCARABEO Skikaciga je dizajnirana za glavu mladog skijasa,okruzuje je i nudi maksimalnu zastitu,lakocu i udobnost,neprimetnu zastitu kako bi se mali skijas mogao bezbedno zabavljati.\r\n\r\nSCARABEO ELEMTNO postavlja standarde za svoju kategoriju u pogledu lakoce i zastite. Njene izdrzljiva i lagana polikarbonatna skoljka i EPS unutrasnja skoljka su u stanju da apsorbuju najnasilnije udare i prevazilazi najstroze evropske i severnoamericke standarde serifikacije ? CE EN 1077 tip B i ASTM F-2040. Zbog kompaktnog dizajna, garantuju izuzetno malu tezinu kacige (samo 380 g u veli?ini JS-JM).\r\n\r\nSistem za pričvršćivanje naočara\r\nITW kopča\r\nJastučići za uši koji se mogu ukloniti\r\nMikro podešavanja veličine - rotorom\r\nObloga, termoformirana, uklonjiva i periva\r\nMaterijali: 100% EPS Inner shell / 100% Polycarbonate\r\nHomologation: ASTM F-2040 CE EN 1077 type B', 'SKI484040160H_3_1.jpg', 'SKI484040160H_1.jpg', 'SKI484040160H_2_1.jpg', 'SKI484040160H_4_1.jpg', 6700.00, 0, 'Sivo-crvena'),
(46, 'Aktivni ves pantalone SCOTT DEFINED MERINO', 'Aktivni ves', 'Scott Defined Merino pant... toplina i udobnost.\r\n\r\nMerino osnovni sloj za sve vaše aktivnosti na otvorenom. Termička regulacija i velika prozračnost deluju kao druga koža, tokom zime ili leta i podupiru vas od prve vožnje liftom do poslednjeg poziva. Odlično upravljanje vlagom, pojačano upravljanje mirisom i mekan osećaj.\r\n\r\n \r\n\r\nSpecifikacija & Tehnologije\r\n\r\nMaterijal: 100% Merino Wool\r\nMerino knit with 18.9 and 19.3 Micron\r\nFit: Slim\r\nTežina: 0.28kg\r\nRe-Source product\r\nZQ™ Merino fiber\r\nMerino Advanced Performance Promise (MaPP®)\r\nNaturally performing Merino\r\nMulesing-free Merino', 'SC277773-dark_blue_5_1.jpg', 'SC277773-dark_blue_3_3_1.jpg', 'SC277773-dark_blue_2_3_1.jpg', NULL, 2000.00, 0, 'Crna'),
(47, 'Aktivni ves pantalone POIVRE BLANC', 'Aktivni ves', 'Active Line Woman Collection\r\n\r\nSporty, Energetic, Visual, Color Block\r\n\r\n \r\n\r\nModel W22-1920-WO/A Base layer Pants\r\nBase layer pantalone slim fit kroja koje obezbeđuju ležeran izgled. Sa svojom mekom mešavinom materijala, garantuje najveći komfor, zaokružen podesivim elastičnim pojasom.\r\n\r\nJedna od ključnih karakteristika ovog base layer-a je tkanina koja se brzo suši, koja osigurava da ostanete suvi čak i tokom intenzivnog dana skijanja. Materijal rastezljiv u 4 smera omogućava neograničeno kretanje, tako da možete sa lakoćom kliziti niz padine.\r\n\r\nNapravljen prvenstveno od poliamida, base layer nudi odličnu prozračnost. Omogućava da vlaga i znoj pobegnu iznutra dok vas održavaju toplim zadržavajući telesnu toplotu.\r\n\r\n \r\n\r\nSpecifikacija & Tehnologije\r\n\r\nTehnologije: technical 4-way stretch nylon knit\r\nSastav: Shell 1 - 88% polyamide 12% elastane\r\nFit: Slim Fit\r\nKarakteristike\r\n\r\n4-smerni rastezljivi materijal\r\nProzračan, brzo se suši, gladak na dodir\r\nŠiroka elastična traka oko struka\r\nMetallic print log', 'SKI295518-black_1_1.jpg', NULL, NULL, NULL, 2500.00, 0, 'Crna'),
(48, 'Atomic Redster Q7 Rvsk C + Mi 12 Gw', 'Skije', 'Atomic Redster K7 Revoshock C uparuje Revoshock tehnologiju sa Atomic-ovim All-Condition Piste Shape u skijašima za srednje i napredne skijaše. Revoshock C apsorbuje vibracije i skijaško brbljanje, stvarajući glatku i odzivnu skiju koja se ističe na groomerima u svim uslovima. Multi Radius Sidecut vas podstiče da napravite sve što se oseća ispravno. Kratki radijus skretanja osećaju prirodno kao i duži GS lukovi da li je staza čvrsta jutarnji somot ili popodnevna bljuzgavica. Snaga Voodcore, Dura Cap Sideva', 'AASS03438-01_1.jpg', 'AASS03438-02_1.jpg', 'AASS03438-06_1.jpg', 'AASS03438-05_1.jpg', 7000.00, 0, 'Crna'),
(49, 'Atomic Hawx Prime Xtd 120 Gw', 'Pancerice', 'Atomic Havk Prime KSTD 120 GV je hard-flexing crossover čizma koja spaja all-mountain i freeride touring za neograničene performanse. Legendarni Havk Feel, lagana prohodnost i skijanje visokih performansi spajaju se u ovoj čizmi od 100 mm koja je trajala srednje čvrsto. Napravljen je sa sledećom generacijom Prolite Construction, koja počinje sa najlakšim mogućim profilom, a zatim dodaje pojačanje kritičnim energetskim zonama kako bi stvorila super robusnu čizmu za snažne skijaške performanse. Školjka i obloga mogu se prilagoditi pomoću Memori Fit-a i specijalne toplotno oblikovane Mimic Platinum obloge koja se oblikuje u tačan oblik vašeg stopala. Manžetna sa opsegom pokreta od 54 ° pruža epsko prirodno kretanje za lako hodanje i više udobnosti kada stojite uspravno. Visoko prilagodljiv GripValk đon je kompatibilan sa svim GripValk, MN, MNC i Pin vezovima. Izuzetno moćan, ovo je idealna čizma za one koji su uzbuđeni da skijaju i istražuju izvan odmarališta.', 'AE5029160-01_1.jpg', 'AE5029160-02_1.jpg', 'AE5029160-03_1.jpg', NULL, 6300.00, 0, 'Siva'),
(50, 'Leki Racing', 'Stapovi', 'Elegantan i brz – sa ProG-om, Neolite Airfoil kombinuje Speed Segment grip sa LEKI-jevom jedinstvenom osovinom profila od 14 mm.\r\n\r\nPro G PAS grip garantuje posebno čvrst kontakt između ruke i motke. Traka se može beskonačno podesiti na željenu dužinu.\r\n\r\nAerodinamički profil suza vratila čine ovaj lagani traka stub i čvrst i aerodinamičan u isto vreme.', '65344301-02_1.jpg', '65344301-01_1.jpg', '65344301-03_1.jpg', '65344301-04_1.jpg', 3500.00, 0, 'Crvena'),
(51, 'Leki WCR Lite SL 3D', 'Stapovi', 'Stubovi, sa svojim 16 mm aluminijumske osovine visoke čvrstoće, savršeni su za juniorske slalomske trkače. Dizajn Airfoil obezbeđuje optimalnu aerodinamiku. Ovo je dopunjeno novorazvijenim Trigger 3D Pro G gripom. Novi Trigger 3D sistem nudi veću kontrolu kroz direktnu vezu između rukavice i motke, poboljšanu jednostavnost korišćenja kroz brzo klikanje i otpuštanje, i veću marginu sigurnosti kroz inteligentno trodimenzionalno okidanje koje proširuje opseg okidača četiri puta.', '65265852-02_1.jpg', '65265852-01_1.jpg', '65265852-04_1.jpg', '65265852-03_1.jpg', 4500.00, 0, 'Roze'),
(52, 'NGN Windproof Multifunctional Balaclava Leopard', 'Fantomka', 'OSTANITE TOPLI I UDOBNI: Napravljena od ultra-meke podstave od flisa i 4-smernog rastezljivog materijala, ova skimaska za balaklave obezbeđuje udobno prianjanje, a istovremeno vas održava toplim i udobnim, čak i na niskim temperaturama.\r\nBREATH LAKO: Sa prozračnim mrežastim oblogama, naša skijaška maska za muškarce i žene poboljšava protok vazduha i sprečava nakupljanje vlage, održavajući vas svežim i udobnim tokom aktivnosti visokog intenziteta kao što su skijanje ili trčanje.\r\nZAŠTITA OD SVIH VREMENSKIH PRILIKA: Ovaj pokrivač za lice ima vodootpornu školjku i proširenu pokrivenost vrata kako bi vas zaštitio od jakog vetra, kiše i snega, što ga čini idealnim za avanture na otvorenom, putovanje na posao ili industrijski rad.\r\nSTRETCHI HELMET-FRIENDLI FIT: Dizajniran sa ravnim šavovima za zaključavanje i fleksibilnom šarkom, neprimetno se uklapa ispod kaciga, obezbeđujući maksimalnu udobnost za skijaše, motocikliste i taktičke korisnike.\r\nNEMA VIŠE MAGLE: Dizajniran da spreči zamagljivanje na naočarima ili naočarima, ova balaclava vam omogućava da ostanete fokusirani i sigurni da li udarate na padine ili biciklizam kroz grad.', '17038_BLKWH-01_1.jpg', NULL, NULL, NULL, 1500.00, 0, 'Crno-Bela'),
(53, 'Giro Essence Mips', 'Kaciga', 'Postoji mnogo velikih razloga da se posegne za Essence™ Mips® kacigu, uključujući formu, uklapanje, i funkcija.\r\nPametan i moderan dizajn štita će vas zaštititi od vremenskih nepogoda bez ometanja vaših omiljenih naočara i bez razmazivanja šminke. Takođe ćete ceniti i druge važne detalje kao što su podesivi In Form Fit sistem, ventilacija koja se može podesiti i jastučići za uši koji su kompatibilni sa rezervnim Giro audio sistemima od strane Outdoor Tech-a. Essence Mips® je takođe opremljen višesmernim sistemom zaštite od uticaja koji može da pruži veću zaštitu u određenim uticajima.', '713452MIPS_BLK-01_1.jpg', '713452MIPS_BLK-04_1.jpg', '713452MIPS_BLK-03_1.jpg', '713452MIPS_BLK-05_1.jpg', 8500.00, 0, 'Crna'),
(54, ' Preskoči na početak galerije slika Salomon S/Lab Shift Mnc 10 Blac Sh100', 'Vezovi', 'SHIFT je ultimativni ski vez koji ne pravi nikakve kompromise. Moćićete da agrsivno skijate nizbrdo kao na ski stazama ali i da imate apsolutnu efikasnost pin vezova pri usponima uz potpunu sigurnost pri skijanju kao sa alpskim vezovima\r\n\r\nPerformanse pri spuštanju\r\n\r\nS/LAB SHIFT MNC 10 je ultimativno oruđe kako za spuštanje tako i za penjanje namenjeno skijašima koji žele da osvoje celu planinu.\r\n\r\nTurno mod\r\n\r\nPIN konstrukcija prednje glave daje mogućnost punoj pokretljivosti pete koja omogućava efikasno turiranje i kick okrete. Laki prelazak sa ski na turno mod omogućava lakši pristup novim terenima za skijanje.\r\n\r\nMala težina\r\n\r\nKonstruisan od novih materijala  Carbon-infused PA  S/LAB SHIFT MNC 10 je lak ali čvrst sa težinom od 1750g za par.\r\n\r\nPrimarna namena: Alpsko skijanje', '4113050020-01_1.jpg', NULL, NULL, NULL, 7500.00, 0, 'Crna'),
(55, 'Salomon S/Lab Shift Mnc 13 Blac Sh110', 'Vezovi', 'Novi S/LAB SHIFT MNC 13 vez je predstavnik nove generacije freeride vezova koji kombinuje turno efikasnost pin (low-tech) vezova sa performansama alpskih freeride vezova. Ovaj model je za skijaše koji žele da pomere granice svog skijanja. SHIFT je prvi pravi vez koji ne pravi kompromise.\r\n\r\nPerformanse pri spuštanju\r\n\r\nSHIFT-ovi dugi produžetci na prednjoj glavi veza omogućavaju maksimalnu šok-apsorpciju ( sa 47mm elstic travel) dok istovremeno omogućavaju poboljšani prenos sile i efikasnost. \r\n\r\nPerformanse u turno modu\r\n\r\nSHIFT ima PIN sistem bravljenja na prednjoj glavi uz punu rotaciju zadnje glave koja omogućava efikasno turiranje. Laki prelazak sa ski na turno mod omogućava lakši pristup novim terenima za skijanje.\r\n\r\nMala težina\r\n\r\nKonstruisan od novih materijala  Carbon-infused PA, u kombinaciji sa aluminijumom i čelikom S/LAB SHIFT MNC 13 je lak ali čvrst sa težinom od 1,7kg za par.\r\n\r\nPrimarna namena: Alpsko skijanje', '4113030023-01_1.jpg', NULL, NULL, NULL, 7500.00, 0, 'Plava'),
(56, 'NGN Neo', 'Naocare', 'NGN Neo je evolucija prethodnog NGN modela i ultra su lagane naočare sa minimalnim performansama koje karakteriše prisustvo sočiva pričvršćenog direktno na sljepoočnice i jastučić za nos. Jeste...', '30012_BLKGRY-02_1.jpg', '30012_BLKGRY-03_1.jpg', '30012_BLKGRY-01_1.jpg', NULL, 3000.00, 0, 'Siva'),
(57, 'Salomon S/View', 'Naocare', 'Dizajnirane za skijaše koji traže stil i udobnost, Salomonove naočare S / Viev kombinuju visok kvalitet sočiva sa elegantnim dizajnom bliskim licem. Minimalistički, moderan okvir u kombinaciji sa višeslojnim objektivom pruža široko vidno polje sa smanjenim odsjajem i zamorom očiju u većini svetlosnih uslova', 'L47641100-04_1.jpg', 'L47641100-01_1.jpg', 'L47641100-05_1.jpg', 'L47641100-03_1.jpg', 3000.00, 0, 'Narandzasta');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(108) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `admin` varchar(10) NOT NULL DEFAULT 'ne'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `admin`) VALUES
(9, 'laki', 'laki@gmail.com', 'laki12345', 'da');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `UX_Constraint` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
