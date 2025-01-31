-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.39 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para db_portal_posta
CREATE DATABASE IF NOT EXISTS `db_portal_posta` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci */;
USE `db_portal_posta`;

-- Volcando estructura para tabla db_portal_posta.articles
DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `moonshine_user_id` bigint(20) unsigned DEFAULT NULL,
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'na',
  `profession` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'na',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'na',
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'na',
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `summary` longtext COLLATE utf8mb4_unicode_ci,
  `header` longtext COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `footer` longtext COLLATE utf8mb4_unicode_ci,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `network_social` json DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_publish` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `articles_slug_unique` (`slug`),
  KEY `articles_moonshine_user_id_foreign` (`moonshine_user_id`),
  CONSTRAINT `articles_moonshine_user_id_foreign` FOREIGN KEY (`moonshine_user_id`) REFERENCES `moonshine_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla db_portal_posta.articles: ~3 rows (aproximadamente)
DELETE FROM `articles`;
INSERT INTO `articles` (`id`, `moonshine_user_id`, `cover`, `author`, `profession`, `title`, `subtitle`, `slug`, `summary`, `header`, `content`, `footer`, `tags`, `network_social`, `published_at`, `is_publish`, `created_at`, `updated_at`) VALUES
	(2, 6, NULL, 'Doloremque proident', 'Aliquam sit eius fa', 'Cillum omnis eaque q', 'Quia ducimus neque', 'cillum-omnis-eaque-q', 'Dolore consectetur e', '<p><img src="https://image.shutterstock.com/z/stock-vector-vector-graffity-tags-seamless-pattern-on-white-background-1725886969.jpg" alt="Letters" width="247" height="264"></p>\r\n<p>Lorem ipsum odor amet, consectetuer adipiscing elit. Erat vivamus a dolor ac malesuada. Cras potenti libero risus; malesuada justo netus egestas a. Ullamcorper potenti et sed euismod morbi auctor! Montes viverra dui ultricies molestie tristique vitae lorem viverra pretium. Id lectus pretium himenaeos molestie eros, massa laoreet augue. Id tristique vel duis proin eget metus. Morbi integer ligula ornare justo eget tempor dis montes nec. Non metus himenaeos primis congue nunc ridiculus massa.</p>\r\n<p>Interdum sagittis enim hac potenti habitant eleifend accumsan. Nascetur tincidunt vulputate ridiculus nisi lacinia torquent fames id. Nibh primis sodales dis sit nunc, vulputate curae. Augue iaculis arcu penatibus platea faucibus ex commodo non libero. Hendrerit etiam habitasse dolor metus litora risus finibus. Metus aptent facilisi class potenti curabitur in felis libero id. Praesent dolor magna est non curabitur euismod. Pretium ultrices ridiculus consequat tristique lacus quis rhoncus vel.</p>\r\n<p>Vehicula risus fames eleifend primis dictumst phasellus netus. Malesuada nisi primis ac ullamcorper proin ex natoque. Rhoncus vulputate metus cras sit varius. Inceptos sagittis lobortis suscipit ad nisl eleifend mi cursus. Taciti per maecenas fermentum sed blandit ridiculus tortor cras dui. Massa libero lectus ex commodo aliquet convallis elementum sit. Tristique purus duis enim torquent consectetur bibendum aptent metus. Sed gravida habitasse mus sem pulvinar urna sociosqu. Dui congue porttitor suspendisse finibus dignissim.</p>', '<p>Lorem ipsum odor amet, consectetuer adipiscing elit. Suspendisse semper placerat penatibus proin erat justo sollicitudin. Tristique tristique pharetra, habitasse sociosqu magnis porta habitant. Egestas ipsum cras sed interdum tellus elit. Dignissim nisl commodo urna primis cubilia cursus mauris class. Mollis placerat vivamus libero velit efficitur himenaeos tempor ultrices. Dictum parturient class a non sit mauris. Mauris consectetur tortor eu elit dapibus posuere enim nibh. Rhoncus bibendum tincidunt mauris in maecenas sodales adipiscing nulla. Sit sagittis sodales sagittis nulla aenean quis cursus auctor.</p>\r\n<p>At sem ridiculus congue porttitor faucibus tincidunt id placerat. Habitasse taciti eros dolor nostra ex eleifend primis velit. Tristique orci adipiscing viverra integer etiam. Ligula nunc dolor pellentesque tempor, nulla blandit condimentum elementum varius. Eu convallis facilisi sit, mollis sem congue habitant. Ante ultricies ut suscipit parturient congue risus magnis sodales. Nec nisi pharetra rutrum ultrices fringilla ut tristique odio. Elementum efficitur placerat dis congue magna. Quam ac felis ligula nam eros tincidunt, litora elementum. Pharetra imperdiet platea primis pharetra condimentum eu fermentum at ligula.</p>\r\n<p><img src="https://th.bing.com/th/id/R.f0dceb6a8e11461318baf639b5884779?rik=x1LerAjbTFrScQ&amp;pid=ImgRaw&amp;r=0" alt="Letters" width="251" height="251"></p>\r\n<p>Lacus nulla nunc feugiat phasellus, vulputate dignissim tortor malesuada. Lobortis maecenas interdum condimentum curae proin hac pharetra egestas posuere. Parturient cras vivamus mi taciti phasellus. Ante venenatis morbi cursus natoque luctus primis accumsan. Taciti curae gravida vulputate; habitant morbi aenean sollicitudin ipsum. Volutpat duis hac ad faucibus scelerisque, magna et ornare. Sed mus dignissim pellentesque ut mollis. Interdum a varius nulla porttitor morbi senectus.</p>\r\n<p>Faucibus aliquet id ex hac mattis augue cras sed sagittis. Per ultrices maecenas ac magna justo aliquam mattis ornare. Himenaeos magna aptent lacus lectus curae vulputate vel magnis. Ligula eget aenean feugiat ipsum lacus ut. Suscipit ad suscipit integer elementum facilisis. Finibus erat mollis erat parturient eros penatibus mauris. Arcu convallis lacus adipiscing iaculis dui ac ut. Iaculis sagittis lacus mattis magnis gravida? Integer scelerisque vel varius montes elementum.</p>\r\n<p>Per at eu non ipsum malesuada consectetur. Nostra senectus erat; himenaeos natoque tellus netus potenti aptent. Litora aliquet condimentum auctor faucibus in. Duis nostra etiam dui eros, aliquam mollis venenatis curae. Diam himenaeos nec cursus ornare aliquet bibendum ultrices! Purus luctus fermentum praesent, lectus posuere et. Finibus vel porttitor aliquet conubia magna consequat. Porttitor pretium sed nullam porttitor elementum posuere.</p>\r\n<p>Sodales himenaeos condimentum justo netus consequat ullamcorper. Praesent placerat taciti ipsum suscipit risus dolor. Dis per volutpat condimentum maecenas himenaeos senectus urna. Fermentum fusce posuere feugiat sagittis dictumst ad quisque. Sollicitudin elit aliquet congue habitasse natoque eros tristique ligula sapien. Ridiculus cubilia tellus nascetur ultrices est nec donec sodales. Ornare ligula sociosqu odio egestas lacinia pulvinar tristique lectus. Convallis velit natoque dignissim litora id; hendrerit consequat. Sit molestie curae consectetur lacinia et purus.</p>', '<p>Lorem ipsum odor amet, consectetuer adipiscing elit. Est at condimentum inceptos sapien viverra sed. Rhoncus accumsan porta velit erat, montes habitant. Ultricies neque etiam luctus gravida mollis faucibus cubilia condimentum. Felis vehicula inceptos vulputate consequat lectus. Porta fringilla primis vehicula venenatis erat. Potenti ante accumsan ipsum fermentum congue mi id ridiculus fringilla.</p>\r\n<p>Aliquam orci venenatis nascetur, tortor sollicitudin nullam sodales elementum ornare. Suspendisse parturient vehicula imperdiet sed ad et quisque. Posuere inceptos sollicitudin aliquam tristique; ipsum finibus. Vivamus aliquet sollicitudin eu pretium efficitur cras. Aliquet facilisi turpis accumsan lacinia fermentum, mauris massa in aliquam. Pretium faucibus scelerisque orci; molestie eget felis. Auctor lectus blandit fusce metus platea nullam. Nisl metus himenaeos mattis tempor viverra. Porttitor duis sit, feugiat auctor nam pretium.</p>', 'Elit qui sequi volu', '[{"active": "1", "social": "Twitter", "username": "@username"}, {"active": "1", "social": "LinkedIn", "username": "username"}]', '2025-01-29 16:50:00', 1, '2025-01-30 11:48:32', '2025-01-30 11:51:43'),
	(3, 6, 'posts/GqxKZB3MizahikD8XT5fH6051iTbtkSKF4MvX8Wj.png', 'The Modern Coder', 'Youtuber', 'Gitflow Explained', 'Veniam tempore cum', 'gitflow-explained', 'Eos voluptas quia i', '<p>Lorem ipsum odor amet, consectetuer adipiscing elit. Vel rutrum semper habitant habitasse neque sem cursus ligula. Ante hac libero fermentum nostra imperdiet etiam faucibus. Imperdiet magna maecenas, rutrum fermentum aptent laoreet magnis. At mauris commodo felis molestie sagittis tortor. In vestibulum nascetur urna per himenaeos. Ligula imperdiet risus nec ultricies etiam convallis eget? Maximus tristique euismod tristique hendrerit semper primis.</p>\r\n<p>Commodo semper eleifend habitant natoque tempus. Purus imperdiet et venenatis; dolor nulla semper. Iaculis elementum ipsum convallis penatibus; vulputate curabitur condimentum pellentesque habitant. Sagittis vivamus massa finibus, congue felis pellentesque. Eget lobortis interdum suscipit natoque cubilia nec auctor, urna condimentum. Augue odio ultrices scelerisque vulputate elit lacinia. Ligula fusce eget sapien; facilisis luctus iaculis volutpat tristique. Parturient nullam placerat ornare enim mi volutpat sit ipsum. Curabitur accumsan proin consequat faucibus augue fringilla.</p>\r\n<p>Magnis risus elementum scelerisque lacinia nec magnis. Mollis suspendisse feugiat; mus fermentum ullamcorper phasellus semper facilisis. Justo nascetur ut finibus nisi tellus, tristique ornare litora feugiat. Feugiat montes maximus sagittis pellentesque ac mauris viverra. Purus ante elit orci conubia curae conubia. Efficitur nascetur in ad litora conubia aliquet. Ut posuere etiam scelerisque aliquet blandit velit per.</p>\r\n<p><iframe style="width: 533px; height: 300px;" title="YouTube video player" src="https://www.youtube.com/embed/Aa8RpP0sf-Y?si=GEmMTqKJ-t-slLXB" width="457" height="257" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen="allowfullscreen" referrerpolicy="strict-origin-when-cross-origin"></iframe></p>', '<p>Lorem ipsum odor amet, consectetuer adipiscing elit. Facilisi congue feugiat non mauris, augue praesent varius mi quam. Proin leo magna ipsum platea, tempus cursus elit. Bibendum praesent suspendisse curae nunc habitant. Commodo nulla duis blandit eget eget. Venenatis pulvinar potenti sociosqu scelerisque quam. Ligula lacus netus consectetur metus nec malesuada eget suscipit. Netus viverra aptent finibus aliquam cras id massa laoreet elementum.</p>\r\n<p>Lorem ipsum odor amet, consectetuer adipiscing elit. Sem potenti potenti; convallis tellus interdum laoreet per non pretium. Dignissim varius auctor aenean ex imperdiet. Velit hac erat venenatis placerat dictum finibus donec tempus. Nunc molestie arcu tincidunt imperdiet quis. Cursus fermentum molestie scelerisque adipiscing posuere ultrices. Magna est ligula purus parturient eleifend. Dapibus aliquet blandit class blandit nunc pretium ut viverra. Porttitor ridiculus amet blandit euismod facilisi vulputate iaculis volutpat.</p>\r\n<p>Interdum sociosqu adipiscing dignissim molestie ligula pulvinar. Maecenas interdum duis primis inceptos aliquet parturient malesuada dapibus euismod. Class nunc quam felis iaculis blandit praesent urna. Quam lacinia rutrum orci, class fermentum commodo primis. Sagittis tristique dapibus nulla cubilia pharetra suscipit efficitur. Ac lobortis phasellus, potenti non mollis ut dis facilisi.</p>\r\n<p>Hac suscipit dis elementum in; morbi pretium. Ligula pharetra cursus condimentum feugiat tempus porta. Erat eget lorem amet finibus donec semper. Fames etiam vitae massa convallis odio lectus hendrerit eros. Duis sapien sociosqu adipiscing ad parturient. Semper dapibus volutpat tempor quam scelerisque pharetra nibh netus auctor. Malesuada sodales libero dictumst imperdiet venenatis urna maximus. Mollis est hendrerit ultricies nostra, auctor pharetra. Dis facilisi purus maximus aptent arcu lobortis himenaeos.</p>\r\n<p>Senectus imperdiet sociosqu ligula vivamus habitant maximus. Sit purus fermentum taciti vulputate per amet maximus pellentesque accumsan. Facilisis bibendum malesuada sit tellus platea per rhoncus. Tempus nec ex ridiculus netus; ridiculus ultrices nunc. Mi est id efficitur laoreet dictum. Purus erat facilisis aliquet elementum eleifend ex placerat lectus. Nostra venenatis massa conubia pharetra taciti sodales blandit nec. Ac condimentum bibendum fusce id ad ipsum finibus iaculis. Sit porttitor magnis finibus proin porttitor enim suspendisse sit. Penatibus adipiscing placerat vivamus dignissim at elit interdum.</p>\r\n<ul>\r\n<li>Senectus imperdiet sociosqu ligula vivamus habitant maximus.</li>\r\n<li>Purus euismod nisi natoque vehicula; donec justo sollicitudin</li>\r\n<li>Consectetur nullam elementum ante egestas posuere ridiculus.</li>\r\n<li>Lorem ipsum odor amet, consectetuer adipiscing elit.</li>\r\n<li>Interdum sociosqu adipiscing dignissim molestie ligula pulvinar.</li>\r\n<li>Hac suscipit dis elementum in; morbi pretium.</li>\r\n<li>Senectus imperdiet sociosqu ligula vivamus habitant maximus.</li>\r\n</ul>\r\n<p>Purus euismod nisi natoque vehicula; donec justo sollicitudin. Suspendisse risus penatibus vestibulum ac mus habitant iaculis tincidunt. Cubilia sit varius condimentum quam suspendisse. Dui lectus suscipit cubilia urna varius aptent lacus ac. Class massa lobortis quis nibh fusce nibh ante pulvinar. Lectus ligula ac convallis ante condimentum pharetra.</p>\r\n<p>Consectetur nullam elementum ante egestas posuere ridiculus. Ad ornare porttitor feugiat, felis feugiat sociosqu luctus nulla. Bibendum sagittis porttitor sollicitudin sollicitudin amet adipiscing adipiscing mauris. Dictum justo justo habitasse feugiat scelerisque duis nulla. Imperdiet mattis nullam arcu lobortis potenti porta nisi platea. Venenatis turpis metus euismod gravida nisl senectus nascetur eu. Ut amet fusce sapien ipsum torquent condimentum suspendisse velit. Urna commodo potenti feugiat, lectus ac mi pulvinar. Lectus elit et vulputate dignissim dignissim ultricies inceptos.</p>\r\n<table style="border-collapse: collapse; width: 100%;" border="1"><colgroup><col style="width: 33.2717%;"><col style="width: 33.2717%;"><col style="width: 33.2717%;"></colgroup>\r\n<tbody>\r\n<tr>\r\n<td>LOREM 1</td>\r\n<td>LOREM 2</td>\r\n<td>LOREM 3</td>\r\n</tr>\r\n<tr>\r\n<td>Class massa lobortis quis nibh fusce nibh ante pulvinar.</td>\r\n<td>Ac condimentum bibendum fusce id ad ipsum finibus iaculis.</td>\r\n<td>Duis sapien sociosqu adipiscing ad parturient.</td>\r\n</tr>\r\n<tr>\r\n<td>Commodo nulla duis blandit eget eget.</td>\r\n<td>Nunc molestie arcu tincidunt imperdiet quis.</td>\r\n<td>Magnis risus elementum scelerisque lacinia nec magnis.</td>\r\n</tr>\r\n</tbody>\r\n</table>', '<p>Lorem ipsum odor amet, consectetuer adipiscing elit. Lacus conubia congue odio, habitasse ornare condimentum tellus. Fringilla sociosqu semper in viverra pretium; aliquet aliquet. Phasellus neque enim accumsan vehicula eu nulla est. Commodo magnis faucibus quis himenaeos adipiscing pharetra finibus vivamus etiam. Dictum justo libero placerat velit convallis. Amet pretium libero nisl fringilla, tempor sodales tortor. Torquent cras ut lectus mi molestie maecenas neque velit mauris.</p>\r\n<p>Curae maecenas urna sociosqu mus rhoncus ante. Donec consequat est potenti sollicitudin, porttitor nam odio. Commodo euismod nullam orci maximus ultricies hendrerit. Egestas torquent mauris commodo eleifend tempor cras. Tincidunt habitasse bibendum tempor varius phasellus sodales sapien odio placerat. Fringilla sapien natoque convallis turpis felis. Magnis elementum fringilla rutrum morbi lacus nisi dolor.</p>\r\n<p>Dolor habitasse fermentum integer; leo eu iaculis finibus. Litora ut commodo id; rutrum dictumst netus enim facilisis. Elementum placerat vulputate torquent suspendisse cursus pulvinar turpis ante. Proin euismod blandit eros placerat purus venenatis malesuada. Sed iaculis ultrices semper justo diam. Curabitur ultricies per finibus; interdum nisi potenti?</p>\r\n<p><a title="cillum omnis eaque q" href="/article/cillum-omnis-eaque-q" target="_blank" rel="noopener">cillum omnis eaque q</a></p>', 'Quia blanditiis comm', '[{"active": "1", "social": "Youtube", "username": "@themoderncoder"}, {"active": "0", "social": "Twitter", "username": "@username"}, {"active": "1", "social": "LinkedIn", "username": "username"}]', '1974-07-16 06:24:00', 1, '2025-01-30 12:03:34', '2025-01-30 12:08:15'),
	(4, 6, 'posts/u03QWSINXUaya9OvJXXAA36MFY3pkIfFzFWubESQ.jpg', 'Tony Xhepa', 'Youtuber', 'Laravel 11 Full Tutorial', 'Quis aperiam dolore', 'laravel-11-full-tutorial', 'Hic animi et modi a', '<p><img src="https://i.ytimg.com/vi/l-ZwPDOTjQY/hq720.jpg?sqp=-oaymwEcCNAFEJQDSFXyq4qpAw4IARUAAIhCGAFwAcABBg==&amp;rs=AOn4CLA75egS0TSe-ETsj5cOjY1z_0Kctw" alt="Laravel 11" width="490" height="275"></p>\r\n<p>Lorem ipsum odor amet, consectetuer adipiscing elit. Rhoncus lacinia eleifend neque odio nam eu arcu. Ultricies congue nullam congue; justo tristique non amet. Fringilla dapibus urna aliquet varius tempus habitasse. Ultrices egestas feugiat fringilla cursus eu vel felis. Maecenas aliquet elit aliquet ligula vestibulum interdum pellentesque pulvinar.</p>\r\n<p>Interdum quisque taciti magnis blandit eget himenaeos est posuere vehicula. Ultrices mi nunc platea dui duis habitasse. Pretium habitasse cubilia vivamus diam nam nunc. Pretium pulvinar quam himenaeos ligula taciti. Tempor aenean maecenas efficitur mus donec placerat pellentesque. Varius non gravida velit, massa penatibus curae? Atristique fames magnis eu netus augue magnis.</p>\r\n<p>Maximus auctor malesuada massa congue nam tristique dictum pharetra tincidunt. Pharetra nunc magnis lectus ultricies pellentesque dolor non hendrerit. Lacus taciti nisl platea, hendrerit rutrum aliquam molestie. Tempor rhoncus maximus lacinia; consectetur elementum id. Gravida tellus elementum euismod dignissim aenean scelerisque quisque convallis. Ornare ornare phasellus mi et vel velit dictum. Nostra laoreet sollicitudin justo, porta efficitur felis. Congue sagittis quis phasellus, blandit aptent ipsum. Est tellus ridiculus a lectus donec, justo tortor nascetur nisl.</p>', '<p><iframe title="YouTube video player" src="https://www.youtube.com/embed/l-ZwPDOTjQY?si=4IcBmP9NjhxLFttB" width="560" height="315" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen="allowfullscreen" referrerpolicy="strict-origin-when-cross-origin"></iframe></p>\r\n<p>Lorem ipsum odor amet, consectetuer adipiscing elit. Sem potenti potenti; convallis tellus interdum laoreet per non pretium. Dignissim varius auctor aenean ex imperdiet. Velit hac erat venenatis placerat dictum finibus donec tempus. Nunc molestie arcu tincidunt imperdiet quis. Cursus fermentum molestie scelerisque adipiscing posuere ultrices. Magna est ligula purus parturient eleifend. Dapibus aliquet blandit class blandit nunc pretium ut viverra. Porttitor ridiculus amet blandit euismod facilisi vulputate iaculis volutpat.</p>\r\n<p>Interdum sociosqu adipiscing dignissim molestie ligula pulvinar. Maecenas interdum duis primis inceptos aliquet parturient malesuada dapibus euismod. Class nunc quam felis iaculis blandit praesent urna. Quam lacinia rutrum orci, class fermentum commodo primis. Sagittis tristique dapibus nulla cubilia pharetra suscipit efficitur. Ac lobortis phasellus, potenti non mollis ut dis facilisi.</p>\r\n<p>Hac suscipit dis elementum in; morbi pretium. Ligula pharetra cursus condimentum feugiat tempus porta. Erat eget lorem amet finibus donec semper. Fames etiam vitae massa convallis odio lectus hendrerit eros. Duis sapien sociosqu adipiscing ad parturient. Semper dapibus volutpat tempor quam scelerisque pharetra nibh netus auctor. Malesuada sodales libero dictumst imperdiet venenatis urna maximus. Mollis est hendrerit ultricies nostra, auctor pharetra. Dis facilisi purus maximus aptent arcu lobortis himenaeos.</p>\r\n<p>Senectus imperdiet sociosqu ligula vivamus habitant maximus. Sit purus fermentum taciti vulputate per amet maximus pellentesque accumsan. Facilisis bibendum malesuada sit tellus platea per rhoncus. Tempus nec ex ridiculus netus; ridiculus ultrices nunc. Mi est id efficitur laoreet dictum. Purus erat facilisis aliquet elementum eleifend ex placerat lectus. Nostra venenatis massa conubia pharetra taciti sodales blandit nec. Ac condimentum bibendum fusce id ad ipsum finibus iaculis. Sit porttitor magnis finibus proin porttitor enim suspendisse sit. Penatibus adipiscing placerat vivamus dignissim at elit interdum.</p>\r\n<p>Phasellus auctor leo mi sagittis finibus; commodo erat hac dictumst? Sagittis ante faucibus suspendisse ridiculus gravida sit penatibus efficitur velit. Tincidunt rutrum conubia proin risus nunc tortor; metus at luctus. Varius nunc volutpat condimentum maximus egestas feugiat. Nec himenaeos fringilla cursus himenaeos nisl odio pretium libero. Tempor cras bibendum aptent; libero egestas sem pharetra aliquet. Dui nibh vivamus natoque dictum massa dolor torquent. Interdum cras tincidunt vel suscipit elit.</p>\r\n<p>Purus euismod nisi natoque vehicula; donec justo sollicitudin. Suspendisse risus penatibus vestibulum ac mus habitant iaculis tincidunt. Cubilia sit varius condimentum quam suspendisse. Dui lectus suscipit cubilia urna varius aptent lacus ac. Class massa lobortis quis nibh fusce nibh ante pulvinar. Lectus ligula ac convallis ante condimentum pharetra.</p>\r\n<p>Consectetur nullam elementum ante egestas posuere ridiculus. Ad ornare porttitor feugiat, felis feugiat sociosqu luctus nulla. Bibendum sagittis porttitor sollicitudin sollicitudin amet adipiscing adipiscing mauris. Dictum justo justo habitasse feugiat scelerisque duis nulla. Imperdiet mattis nullam arcu lobortis potenti porta nisi platea. Venenatis turpis metus euismod gravida nisl senectus nascetur eu. Ut amet fusce sapien ipsum torquent condimentum suspendisse velit. Urna commodo potenti feugiat, lectus ac mi pulvinar. Lectus elit et vulputate dignissim dignissim ultricies inceptos.</p>', '<p>Lorem ipsum odor amet, consectetuer adipiscing elit. Elit ligula arcu massa finibus ac accumsan condimentum netus urna? Ex accumsan senectus vivamus natoque tempor quisque torquent. Per primis nec dis class aliquam litora lorem. Cubilia aptent consectetur risus quam duis ad quis? Ullamcorper eget mollis luctus dis malesuada maximus convallis nulla vitae. Laoreet quisque diam lobortis; libero penatibus rutrum. Congue mi interdum netus tempus; fringilla finibus et ridiculus. Ultrices potenti feugiat turpis primis nunc felis nascetur.</p>\r\n<p>Ante tempor curabitur porta tortor leo diam metus. Mattis posuere natoque accumsan; feugiat porttitor integer risus dis. Sociosqu mus eu maximus senectus potenti magna. Venenatis aliquet per sollicitudin molestie cras eget. Nullam vivamus vehicula in, lectus nisi conubia vitae. Venenatis ante sociosqu nulla netus mi elementum habitant. Est nulla pharetra laoreet pulvinar, nisl mattis bibendum praesent.</p>', 'Non rerum veniam nu', '[{"active": "1", "social": "Youtube", "username": "@tonyxhepaofficial"}, {"active": "0", "social": "Twitter", "username": "@username"}, {"active": "0", "social": "LinkedIn", "username": "username"}]', '2025-01-30 06:15:00', 1, '2025-01-30 12:15:48', '2025-01-30 12:17:15');

-- Volcando estructura para tabla db_portal_posta.cache
DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla db_portal_posta.cache: ~2 rows (aproximadamente)
DELETE FROM `cache`;

-- Volcando estructura para tabla db_portal_posta.cache_locks
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla db_portal_posta.cache_locks: ~0 rows (aproximadamente)
DELETE FROM `cache_locks`;

-- Volcando estructura para tabla db_portal_posta.comments
DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `moonshine_user_id` bigint(20) unsigned DEFAULT NULL,
  `article_id` bigint(20) unsigned DEFAULT NULL,
  `parent_id` bigint(20) unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'na',
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_moonshine_user_id_foreign` (`moonshine_user_id`),
  KEY `comments_article_id_foreign` (`article_id`),
  KEY `comments_parent_id_foreign` (`parent_id`),
  CONSTRAINT `comments_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `comments_moonshine_user_id_foreign` FOREIGN KEY (`moonshine_user_id`) REFERENCES `moonshine_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `comments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla db_portal_posta.comments: ~2 rows (aproximadamente)
DELETE FROM `comments`;
INSERT INTO `comments` (`id`, `moonshine_user_id`, `article_id`, `parent_id`, `title`, `tags`, `content`, `is_active`, `created_at`, `updated_at`) VALUES
	(26, 6, 3, NULL, 'na', NULL, 'Mi gusta mucho aprender sobre Git', 0, '2025-02-01 03:38:31', '2025-02-01 03:38:31'),
	(27, 6, 4, NULL, 'na', NULL, 'Laravel es mi framework favorito -♥-', 0, '2025-02-01 03:39:17', '2025-02-01 03:39:17');

-- Volcando estructura para tabla db_portal_posta.failed_jobs
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla db_portal_posta.failed_jobs: ~0 rows (aproximadamente)
DELETE FROM `failed_jobs`;

-- Volcando estructura para tabla db_portal_posta.jobs
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla db_portal_posta.jobs: ~0 rows (aproximadamente)
DELETE FROM `jobs`;

-- Volcando estructura para tabla db_portal_posta.job_batches
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla db_portal_posta.job_batches: ~0 rows (aproximadamente)
DELETE FROM `job_batches`;

-- Volcando estructura para tabla db_portal_posta.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla db_portal_posta.migrations: ~9 rows (aproximadamente)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2020_10_04_115514_create_moonshine_roles_table', 1),
	(5, '2020_10_05_173148_create_moonshine_tables', 1),
	(6, '2025_01_19_050001_create_notifications_table', 1),
	(12, '2025_01_19_223421_create_articles_table', 2),
	(15, '2025_01_31_034602_create_rating_articles_table', 3),
	(18, '2025_01_31_165154_create_comments_table', 4);

-- Volcando estructura para tabla db_portal_posta.moonshine_users
DROP TABLE IF EXISTS `moonshine_users`;
CREATE TABLE IF NOT EXISTS `moonshine_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `moonshine_user_role_id` bigint(20) unsigned NOT NULL DEFAULT '1',
  `email` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `moonshine_users_email_unique` (`email`),
  KEY `moonshine_users_moonshine_user_role_id_foreign` (`moonshine_user_role_id`),
  CONSTRAINT `moonshine_users_moonshine_user_role_id_foreign` FOREIGN KEY (`moonshine_user_role_id`) REFERENCES `moonshine_user_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla db_portal_posta.moonshine_users: ~2 rows (aproximadamente)
DELETE FROM `moonshine_users`;
INSERT INTO `moonshine_users` (`id`, `moonshine_user_role_id`, `email`, `password`, `name`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
	(5, 1, 'admin@admin.com', '$2y$12$a2l.oWgK2kvOKUNgWbyS9O/Hox9IdMWi/SF4A8Kbz9oSwH7hUww2W', 'admin', NULL, '8q76lilhKjQdAYkbUyVNf3AKWkLGcYpidw9wkYuB6IeDrLHrPZbz27FhXD31', '2025-01-30 10:41:25', '2025-01-30 10:41:25'),
	(6, 2, 'blogger@demo.com', '$2y$12$y/Tg94SXdSC38/ZNm8LYruLu4bQ00fDwUT4/3AjhIAEad1QVDGGEO', 'Blogger', NULL, 'hJR7eN73Nox7hONYXjndEtWlAqT2zUuigm54Fr02hOYyM0vSb5qgO17lUZul', '2025-01-30 06:00:00', '2025-01-30 10:45:36');

-- Volcando estructura para tabla db_portal_posta.moonshine_user_roles
DROP TABLE IF EXISTS `moonshine_user_roles`;
CREATE TABLE IF NOT EXISTS `moonshine_user_roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla db_portal_posta.moonshine_user_roles: ~0 rows (aproximadamente)
DELETE FROM `moonshine_user_roles`;
INSERT INTO `moonshine_user_roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', '2025-01-19 11:00:54', '2025-01-19 11:00:54'),
	(2, 'Blogger', '2025-01-26 12:04:24', '2025-01-26 12:06:48');

-- Volcando estructura para tabla db_portal_posta.notifications
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla db_portal_posta.notifications: ~0 rows (aproximadamente)
DELETE FROM `notifications`;

-- Volcando estructura para tabla db_portal_posta.password_reset_tokens
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla db_portal_posta.password_reset_tokens: ~0 rows (aproximadamente)
DELETE FROM `password_reset_tokens`;

-- Volcando estructura para tabla db_portal_posta.rating_articles
DROP TABLE IF EXISTS `rating_articles`;
CREATE TABLE IF NOT EXISTS `rating_articles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `moonshine_user_id` bigint(20) unsigned DEFAULT NULL,
  `article_id` bigint(20) unsigned DEFAULT NULL,
  `rating` tinyint(3) unsigned NOT NULL,
  `is_active` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rating_articles_moonshine_user_id_article_id_unique` (`moonshine_user_id`,`article_id`),
  KEY `rating_articles_article_id_foreign` (`article_id`),
  CONSTRAINT `rating_articles_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rating_articles_moonshine_user_id_foreign` FOREIGN KEY (`moonshine_user_id`) REFERENCES `moonshine_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla db_portal_posta.rating_articles: ~2 rows (aproximadamente)
DELETE FROM `rating_articles`;
INSERT INTO `rating_articles` (`id`, `moonshine_user_id`, `article_id`, `rating`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 6, 4, 5, 0, '2025-01-31 10:25:45', '2025-02-01 03:38:51'),
	(28, 6, 3, 3, 0, '2025-01-31 11:57:27', '2025-01-31 22:01:35');

-- Volcando estructura para tabla db_portal_posta.sessions
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla db_portal_posta.sessions: ~1 rows (aproximadamente)
DELETE FROM `sessions`;
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('iQZbxRiX48rKE6HlJ56t2ChJQrJqGFGglcRkSJUe', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36 Edg/132.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicGdoaDJUUTVGSU0yTUVSM3FOV3I1T09GOFFBSGdBaU5lZGJ2TEFVaCI7czo1NjoibG9naW5fbW9vbnNoaW5lXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NjtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNToiaHR0cDovL3BvcnRhbC1wb3N0YS5sb2NhbCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1738364145);

-- Volcando estructura para tabla db_portal_posta.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla db_portal_posta.users: ~0 rows (aproximadamente)
DELETE FROM `users`;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
