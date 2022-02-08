-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 08, 2022 at 05:08 AM
-- Server version: 5.6.41-84.1
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `likhdyco_article_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `created_at`) VALUES
(11, 'sports', '2022-02-07 16:48:01'),
(12, 'news', '2022-02-07 16:48:01'),
(13, 'food', '2022-02-07 16:48:01'),
(14, 'media', '2022-02-07 16:48:01'),
(15, 'fashion', '2022-02-07 16:48:01'),
(16, 'music', '2022-02-07 16:48:01'),
(17, 'arts', '2022-02-07 16:48:01'),
(18, 'fitness', '2022-02-07 16:48:01'),
(19, 'photography', '2022-02-07 16:48:01'),
(20, 'travel', '2022-02-07 16:48:01'),
(21, 'politics', '2022-02-07 16:49:04'),
(22, 'climate', '2022-02-07 16:49:04'),
(23, 'tutorial', '2022-02-07 18:28:29'),
(24, 'personality', '2022-02-08 05:48:04'),
(25, 'opinion', '2022-02-08 06:15:03'),
(27, 'science', '2022-02-08 11:53:23');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` bigint(20) NOT NULL,
  `text` longtext NOT NULL,
  `comment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `likes` bigint(20) NOT NULL DEFAULT '0',
  `dislikes` bigint(20) NOT NULL DEFAULT '0',
  `post_id` bigint(20) NOT NULL,
  `author` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `text`, `comment_date`, `likes`, `dislikes`, `post_id`, `author`) VALUES
(99, 'Words are straight from my heart, give it a read!', '2022-02-08 06:04:51', 0, 0, 37, '39643810e6df37f04caf9bda8799cf92'),
(100, 'Nice effort in creating such type of link which offer us the opportunity to express our creativity', '2022-02-08 06:42:24', 0, 0, 36, '8813225e29123259859c1dd729cae003'),
(101, 'Obviously, I could not trace the whole events but I hope you will find it helpful.', '2022-02-08 07:37:22', 0, 0, 39, 'b9b276c1aefc96b73fb890e185e2c97a');

-- --------------------------------------------------------

--
-- Table structure for table `comment_replies`
--

CREATE TABLE `comment_replies` (
  `reply_id` bigint(20) NOT NULL,
  `comment_id` bigint(20) NOT NULL,
  `post_id` bigint(20) NOT NULL,
  `reply_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `text` longtext NOT NULL,
  `author_id` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `drafts`
--

CREATE TABLE `drafts` (
  `id` bigint(20) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `draft_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post_content` longtext NOT NULL,
  `post_title` text NOT NULL,
  `comment_status` varchar(20) NOT NULL DEFAULT 'open',
  `post_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post_categoryID` int(11) NOT NULL,
  `post_keywords` text NOT NULL,
  `post_meta_descp` text NOT NULL,
  `post_tag` text NOT NULL,
  `post_feature_image` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`id`, `email`, `created_at`) VALUES
(1, 'joharkhan1999@gmail.com', '2022-02-07 16:36:28'),
(4, 'joharkhan1999@gmail.com', '2022-02-07 16:41:48'),
(5, 'joharkhan1999@gmail.com', '2022-02-07 16:42:44'),
(6, 'muzalfabibi500@gmail.com', '2022-02-08 02:38:35'),
(7, 'muzalfabibi500@gmail.com', '2022-02-08 03:07:57'),
(8, 'saadiabibi1999@gmail.com', '2022-02-08 05:15:26'),
(9, 'muhtasimafridi166@gmail.com', '2022-02-08 05:16:18');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post_content` longtext NOT NULL,
  `post_title` text NOT NULL,
  `post_status` varchar(20) NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) NOT NULL DEFAULT 'open',
  `post_comment_count` bigint(20) NOT NULL DEFAULT '0',
  `post_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post_categoryID` int(11) NOT NULL,
  `post_tags` text NOT NULL,
  `post_feature_image` text NOT NULL,
  `post_views` bigint(20) NOT NULL DEFAULT '0',
  `post_likes` bigint(20) NOT NULL DEFAULT '0',
  `post_dislikes` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `post_author`, `post_date`, `post_content`, `post_title`, `post_status`, `comment_status`, `post_comment_count`, `post_modified`, `post_categoryID`, `post_tags`, `post_feature_image`, `post_views`, `post_likes`, `post_dislikes`) VALUES
(36, '1a2dd1e5760d7f544909d228de3769a2', '2022-02-07 18:28:29', '<p><span style=\"font-weight: bolder;\">Hi everyone,</span></p><p><span style=\"color: rgb(8, 15, 26); font-family: euclidcircularb, sans-serif;\">Welcome To Likhdy.</span><br style=\"color: rgb(8, 15, 26); font-family: euclidcircularb, sans-serif;\"><span style=\"color: rgb(8, 15, 26); font-family: euclidcircularb, sans-serif;\">We’re so glad you’re here! You are now part of a growing community of people creating, collaborating, and connecting across the globe via Likhdy.</span><br style=\"color: rgb(8, 15, 26); font-family: euclidcircularb, sans-serif;\"><span style=\"color: rgb(8, 15, 26); font-family: euclidcircularb, sans-serif;\">Whether you’ve joined to write something or just to connect with other people or maybe you are here to read something, we’ve got something for you.</span><br style=\"color: rgb(8, 15, 26); font-family: euclidcircularb, sans-serif;\"></p><p>This Article will help you in writing your first article. So follow these easy steps and enjoy!</p><h3>Step 1:</h3><p>First of all&nbsp;<a href=\"https://likhdy.com/signup\" target=\"_blank\">create an account&nbsp;</a>or&nbsp;<a href=\"https://likhdy.com/login\" target=\"_blank\">sign in</a>.</p><h3>Step 2:</h3><p>after creating account, you will be redirected to your dashboard. click on publish an article option.</p><h3>Step 3:</h3><p>A form will open up in another page.<br>Enter these details for your article:</p><ul><li>Article title</li><li>Article Feature Image</li><li>Article Tags (atleast 3) type comma after every tag</li><li>select category or if it does not exist in list then add in the input field</li><li>after that write your article body or you can say the main purpose/content of your article</li><li>at last enter publish button and congrats!! your article is published.</li><li>you can view your published article by going to your published article from your dashboard</li></ul><p><br></p><p>So that was a really simple article to give you a little hand in writing your first article. So again thanks for joining our community and keep writing and learning.</p><p>;)</p>', 'How to write your first article on Likhdy?', 'publish', 'open', 0, '2022-02-07 18:28:29', 23, 'first article,intro to likhdy,tutorial', '1542336279620164cdb9645write-first-article.jpg', 23, 4, 0),
(37, '39643810e6df37f04caf9bda8799cf92', '2022-02-08 05:48:04', '<p style=\"text-align: justify; \"><i><span style=\"font-size: 11pt; line-height: 107%; font-family: &quot;Monotype Corsiva&quot;;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;“Service to others is the rent you pay for your room in the heaven.”\r\nMuhammad Ali&nbsp;</span></i></p><p class=\"MsoNormal\" style=\"text-align: justify; margin: 0cm 0cm 12pt -0.25pt;\">Muhammad Ali, slave name or original name was Cassius\r\nMarcellus Clay, Jr. Born January 17, 1942, Louisville, Kentucky, United States.\r\nDied June 3, 2016, Scottsdale, Arizona. American professional boxer and social\r\nactivist.&nbsp;</p><h4 style=\"margin-top:0cm;margin-right:0cm;margin-bottom:0cm;\r\nmargin-left:-.25pt;margin-bottom:.0001pt;line-height:107%\"><b><span style=\"font-size:18.0pt;mso-bidi-font-size:11.0pt;line-height:\r\n107%\">Achievements:</span></b></h4><p class=\"MsoNormal\" style=\"margin-top:0cm;margin-right:0cm;margin-bottom:0cm;\r\nmargin-left:-.25pt;margin-bottom:.0001pt;line-height:107%\"><o:p></o:p></p>\r\n\r\n<p class=\"MsoNormal\" style=\"text-align: justify; margin: 0cm 0cm 0.0001pt -0.25pt;\">First fighter to win the world\r\nheavyweight championship on three different occasions; on February 25, 1964,\r\nthen 30 October, 1974, and then on September 15, 1978. <o:p></o:p></p>\r\n\r\n<p class=\"MsoNormal\" style=\"text-align: justify; margin: 0cm 0cm 12pt -0.25pt;\"><span style=\"font-family: Calibri, sans-serif; font-size: 14pt;\">During\r\nhis boxing career, he fought 61 matches, out of which he won 56 matches, loss 5\r\nand 37 knockouts in total.</span><span style=\"font-family: Calibri, sans-serif; font-size: 14pt;\">&nbsp;</span>&nbsp;</p><p class=\"MsoNormal\" style=\"margin-top:0cm;margin-right:0cm;margin-bottom:0cm;\r\nmargin-left:-.25pt;margin-bottom:.0001pt;line-height:107%\"><b><span style=\"font-size:18.0pt;mso-bidi-font-size:11.0pt;line-height:\r\n107%\">Life and Services: </span>&nbsp;</b><o:p></o:p></p><p class=\"MsoNormal\" style=\"text-align: justify; margin-left: -0.25pt;\">Its certain that death has to\r\ncome and each one of us have to taste it, but each time when Ali comes to my\r\nmind, I think of him as if he is alive. The services and struggle he had done\r\nfor the Muslim community and the black community or the so called negroes\r\ncannot be ignored and are not forgettable. The fact that he is living in the\r\nhearts of millions today is because of his sacrifices that he made, so much and\r\nso that he would rather die to bring equality and justice to the system no\r\nmatter what is the case.&nbsp; <o:p></o:p></p><p class=\"MsoNormal\" style=\"text-align: justify; margin-left: -0.25pt;\">During Vietnam war 1967, when Ali\r\nwas asked to join US Armed forces. He refused to go, surely because after\r\nconverting to Islam back in 1964, his mind was completely changed, so it was\r\nnot the old Ali, saying “I will not go thousand miles to kill my little\r\nbrothers who never called me negro”, regardless of the consequences he had to\r\nface for these words. <o:p></o:p></p><p class=\"MsoNormal\" style=\"text-align: justify; margin-left: -0.25pt;\">Since Ali was a man of\r\nconviction, he would do what he would say. He never wavered to confront the\r\ncruelty of whites over the black. He fought for so long to bring end to racial\r\ninjustice even if he had to stand as one for his beliefs and actions. In my\r\nopinion all of his power, the physical and mental power, came to him after\r\naccepting Islam, because Islam gives you inner strength and you fear just one\r\nthing that is GOD, nothing else than that. <o:p></o:p></p><p class=\"MsoNormal\" style=\"text-align: justify; margin-left: -0.25pt;\">During his life time, he built\r\n170 mosques in the United States, which is to add something to the afterlife.\r\nIt is a miracle in today’s world because people mostly do and earn for themselves\r\nwhile our aim should be to live for others and do for others. Muhammad Ali,\r\nsometimes I think, was of another breed. He was not one of us. One can hardly\r\nfind a loyal friend which he believes in but he is living in hearts of many.\r\nEven I didn’t saw him but I believe that he was a sincere person, the one who\r\nstands for his words. <o:p></o:p></p><p class=\"MsoNormal\" style=\"text-align: justify; margin-left: -0.25pt;\">There is one thing I like most\r\nabout him, the motivation and inspiration he used to give it to the people of\r\nhis community and all over the world. He made a young man believe that he can\r\nbe anything. According to Ali, if you are not in pain, there is no growth and\r\nchange you can see in yourself. He was a gift and somehow an angel who brings\r\npeace to the people. I don’t think we can ever have a great personality like\r\nhim again.&nbsp; <o:p></o:p></p><p class=\"MsoNormal\" style=\"text-align: justify; margin: 0cm 0cm 6.75pt -0.25pt;\">Some say that, love can ignite stars. Ali is one of the\r\nexamples of it. He used to do trash talk between speeches and interviews. Even\r\nif some people were against him, they would never find him offensive and would\r\nlove to hear words from him and talk to him. Ali was like love in the form of\r\nhuman being. People say that he is dead, but he is alive, alive in our hearts.\r\nI hope that someday I see a man like Ali, when comes into view, the dogs start\r\nbarking, children’s run into the streets, windows are thrown away and down the\r\nstreet comes the figure the person.&nbsp; <o:p></o:p></p><p class=\"MsoNormal\" style=\"margin-top:0cm;margin-right:0cm;margin-bottom:16.65pt;\r\nmargin-left:0cm;text-indent:0cm;line-height:107%\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<i><span style=\"font-family:&quot;Monotype Corsiva&quot;;mso-fareast-font-family:\r\n&quot;Monotype Corsiva&quot;;mso-bidi-font-family:&quot;Monotype Corsiva&quot;\">“If you are not\r\nscared of your dreams, they are not big enough.” </span></i><o:p></o:p></p><p class=\"MsoNormal\" style=\"margin-top:0cm;margin-right:0cm;margin-bottom:12.0pt;\r\nmargin-left:-.25pt\">\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n</p><p class=\"MsoNormal\" style=\"margin-top:0cm;margin-right:0cm;margin-bottom:3.25pt;\r\nmargin-left:0cm;text-indent:0cm;line-height:107%\"><i><span style=\"font-size:26.0pt;mso-bidi-font-size:11.0pt;line-height:\r\n107%;font-family:&quot;Monotype Corsiva&quot;;mso-fareast-font-family:&quot;Monotype Corsiva&quot;;\r\nmso-bidi-font-family:&quot;Monotype Corsiva&quot;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;__Muhammad Ali The Greatest__&nbsp;</span></i><o:p></o:p></p>', 'MUHAMMAD ALI THROUGH MY EYES', 'publish', 'open', 0, '2022-02-08 05:48:04', 24, 'muhammad Ali,Muhammadali,The legend,Boxer', '212962651620204141e2b0image_2022-02-08_103344.png', 14, 2, 0),
(38, '39643810e6df37f04caf9bda8799cf92', '2022-02-08 06:15:03', '<p>The study concluded that there are many factors in finding reasons for child\r\nlabour. Human rights commission of Pakistan considers poverty, social\r\nattitudes, large family size and low literacy rate as basic reasons of child labour\r\nin Pakistan. Domestic work falls under the category of informal work, or\r\n‘invisible’ labour. There are no clear laws to guarantee their rights and no\r\nregulations to check whether they are given the minimum wage.\r\n</p><p>In Pakistan we are not even sure who comes under the category of a ‘child’ due\r\nto the prevalence of contradictory laws. However, it does not mean that we\r\nturn a blind eye to their mistreatment just because they belong to ‘invisible’\r\nworkforce. According to ILO and UNICEF, all work done by children can’t be\r\nclassified as child labour.\r\n“In Pakistan we are not even sure who comes under\r\nthe category of a ‘child’ due to prevalence of\r\ncontradictory laws”\r\nSo, there is a need to differentiate between child labour and child work. If work\r\nis not affecting the health and personal development as well as the schooling of\r\nchildren, then this type of work cannot be taken negatively and does not fall in\r\nthe category of child labour. In fact, the child work which includes, assisting the\r\nfamily business, doing part time jobs during school holidays or after school\r\nhours, not only helps children to develop themselves but also to build new skills\r\nwhich are productive and helps in the development of a society.\r\n</p><p>According to International Labour Organization, child labour is defined as the\r\nwork which has potential to deprive children of their childhood, their dignity,\r\nmoral and mental development and that which interferes in their education by\r\nnot allowing them to go to school. Following are the constitutional provisions\r\nrelating to child labour;\r\nArticle 3 of constitution of Pakistan says; The state shall ensure the elimination\r\nof all forms of exploitation and the gradual fulfilment of fundamental principle,\r\nfrom each according to his ability and to each according to his work.\r\nArticle 11(3) says; No child below the 14 years shall be engaged in any factory\r\nor mine or any other hazardous employment.\r\nArticle 25(A) says; The state shall provide free and compulsory education to all\r\nchildren of the age of five to sixteen in such manner as determined by law. &gt;\r\nArticle 37(e) says; The state shall make a provision for securing just and\r\nhumane conditions of work, ensuring that women and children are not\r\nemployed in vacations unsuited to their age or sex, and for maternity benefits\r\nfor women in unemployment.\r\n</p><p>The constitution of Pakistan contains provisions for the economic and social\r\nwell-being of the people and for the promotion of social justice. Article 11 of\r\nthe constitution of Pakistan clearly shows that children under 14 years shall not\r\nbe engaged in a factory, mine or any other hazardous employment. Because at\r\nthis stage, children learn the way of life, this is the age when they need\r\neducation and to develop themselves. On realizing the important role of\r\neducation in eradicating the child labour, Article 25-A was added to the\r\nconstitution of Pakistan under the 18th Constitutional Amendment 2010,\r\nrequiring the state to provide free and compulsory education to children of the\r\nage five to sixteen years. Similarly, Article 37(e) of constitution requires state to\r\nmake provision for securing just and humane conditions of work, and to ensure\r\nthat no child or women is employed in a place which is not suited to their age or\r\nsex.\r\n</p><p>Now, if we don’t put an end to the child labour as soon as possible, the\r\nconsequences Pakistan had to face in the future are going to be severe. Since\r\nthis is the world of science and technology, every other country is working on\r\nits people, their education, their health and their needs.\r\n“Who makes a country or state developed is its own people”\r\nThis is so saddening that nobody speaks of child labour, we don’t care about\r\nwhat is happening to the young generation which is going to be the future of\r\nPakistan. Education is a very crucial element for the development of a society.\r\nBecause, who makes a country or state developed is its own people. Every child\r\nis made for his own time. So, by educating the new generation comes new\r\nideas. Such ideas that if we implement it into our society, they can make us one\r\nof the leading and developing countries of the world.\r\nThe best way to bring change is to bring change. We need to be practical. If we\r\nchange nothing, nothing is going to change.\r\n“let’s not make it a myth, that children are future of a state”.\r\nWe have a constitution, laws and everything which is necessary for a good\r\nstate. All we need to do is to work on that laws, to implement them and say no\r\nto “Tomorrow Inshallah”, instead we shall say “Now”.&nbsp;</p><p> Every child has a right to live a life\r\nof his/her dreams and everything that he/she wants to be. In fact, we can make a\r\nbig difference by giving our own child the life that he wants not the life that we\r\nwant. It is also some kind of slavery that children do what their father wants\r\nthem to do. It can be called as the slavery of mind, which is not good just\r\nbecause children cannot think freely for themselves. Let’s build together and\r\ngrow together!&nbsp;<br></p>', 'CHILD LABOUR IN PAKISTAN', 'publish', 'open', 0, '2022-02-08 06:15:03', 25, 'childlabour,child labour,pakistan', '166719238662020a670754eimage_2022-02-08_111049.png', 6, 3, 0),
(39, 'b9b276c1aefc96b73fb890e185e2c97a', '2022-02-08 07:26:33', '<p><span style=\"font-family: Poppins;\">Introduction</span></p><p><span style=\"font-family: Poppins;\">Muhammad Ali Jinnah known as Quaid e Azam, was born in Karachi, December 25, 1876. His father name was Poonja Jinnah, a prosperous merchant of the time and Jinnah\'s mother was Mithibai Jinnah. Jinnah had a wealthy merchant background. Jinnah was trained as a barrister at Lincoln\'s Inn in London, England. He took interest in national politics. Jinnah did not knew that he will be the future founder of Pakistan.</span><span style=\"font-family: Poppins; font-size: 1rem;\">The achievement of a separate homeland for Muslims was not an easy thing to do.</span></p><p><span style=\"font-family: Poppins; font-size: 1rem;\">Ambassador of Hindu Muslim Unity</span></p><p><span style=\"font-family: Poppins; font-size: 1rem;\">He joined the Indian National Congress in 1904. Since the Britishers were ruling in the subcontinent for their own profits, Jinnah at that time laid stress on Hindu Muslim unity, so that they could get rid of the foreign rule.</span><span style=\"font-family: Poppins; font-size: 1rem;\">In order to bring both the parties together, he joined the All India Muslim League in 1913. Mrs Sarojini Naidu gave Jinnah the title \"Ambassador of Hindu Muslim Unity\", he really deserved it.&nbsp;</span></p><p><span style=\"font-family: Poppins; font-size: 1rem;\">Resignation from the Congress</span></p><p><span style=\"font-family: Poppins; font-size: 1rem;\">The Hindus never liked the Muslims. In 1916, when the Lucknow Pact was signed, the atmosphere was friendly between the Muslims and Hindus, but a hindu extremist took over the Congress and started departing from the Lucknow Pact, which made Jinnah very disappointed and he resigned from the Congress in 1920. In reality Quaid e Azam was a broad minded Muslim statesman. For a long period of time he was a strong supporter of Hindu Muslim unity. His demand for a separate homeland, was not based on Hindu antagonism, he rather put this demand as he did not see any solution of the India\'s multi-national problem. According to him the only solution was to separate both Hindus and Muslims.&nbsp;</span></p><p><span style=\"font-family: Poppins; font-size: 1rem;\">Lahore Resolution </span></p><p><span style=\"font-family: Poppins; font-size: 1rem;\">In 1940, a resolution was passed in Lahore. It was called the \"Lahore Resolution\", but later it was known as Pakistan Resolution. This name was given by the hostile Hindu Press and was readily picked by Quaid e Azam. This resolution was made the part of Muslim League\'s Manifesto. This resolution was a sole document for the formation of Pakistan in the next seven years.</span></p><p><span style=\"font-family: Poppins; font-size: 1rem;\">Gandhi Persuading Quaid&nbsp;</span></p><p><span style=\"font-family: Poppins; font-size: 1rem;\">When Gandhi was released from prison on the health grounds, he requested Jinnah to hold talk sessions on Muslim demands and future political system which has to be established in India after the British leave India. The Quaid failed to convince Gandhi on the Muslim demand for a separate homeland. While Gandhi&nbsp; insisted that the Muslim League should join hands with the Congress to get independence. Jinnah believed that the muslim problem should be solved before the British leave India.</span></p><p><span style=\"font-family: Poppins; font-size: 1rem;\">&nbsp;Elections</span></p><p><span style=\"font-family: Poppins; font-size: 1rem;\">The elections of the provincial and central assemblies were held in 1945 to 1946. The results declared a complete set back for the Congress. Muslim vote turn out in great majority, in support of Muslim League\'s demand for a separate homeland. Election results, which according to Nehru, manifested&nbsp; \"religious hysteria\", virtually divided India into two.</span></p><p><font face=\"Poppins\">Third June Plan</font></p><p><font face=\"Poppins\">The British Prime Minister declared that India will be given independence by June 1948. Viceroy Lord Mountbatten was able to work on the Partition Plan which was announced on 3rd June by the Viceroy. It was announced that British will transfer power to the newly emerging states India and Pakistan on 15th of August and not in June 1948 as fixed earlier. The British Government passed the Indian Independence Act on 15th July 1947. Mountbatten flew to Karachi to transfer power the newly created Pakistan on August 14, 1947.</font></p><p><font face=\"Poppins\">Pakistan</font></p><p><font face=\"Poppins\">Quaid e Azam Muhammad Ali Jinnah was sworn in as the first Governor General of Pakistan. Liaquat Ali Khan took over the first Prime Minister. And thats how a happy ending came into its end</font></p><p><span style=\"font-family: Poppins; font-size: 1rem;\"><br></span></p>', 'Pakistan Towards Independence', 'publish', 'open', 0, '2022-02-08 07:26:33', 21, 'Great Leader,subcontinent,British Raj,Gandhi,Quaid e Azam,Lahore Resolution,elections,Lord Mountbatten,Lucknow Pact,congress,Muslim League', '156260656362021b29b2259quaid.PNG', 13, 1, 0),
(40, '0a69f8ca55559507eb8ec56b21b55723', '2022-02-08 11:53:23', '<p>Do you know these facts?</p><p><br></p><p>Fact 1: The largest leaves are found in the Raffia Palm which grows in the islands of the Indian Ocean.</p><p>Fact 2: When a wheat seed germinates and grows into a fully mature wheat plant, it&nbsp; &nbsp;it\'s mass 325 times.</p><p>&nbsp;Fact 3: A farmer who sows 100kg of seeds per hectare in the spring will harvest 7.5 tonnes tof seeds per hectare in the next autumn.</p><p>Fact 4: Forests are also called \"Lungs of the Earth\" as they provide us with an enormous amount of oxygen for breathing. They also take in carbon dioxide.</p><p>Fact 5: Every year, over 28 million acres of tropical forests are destroyed to create land for farming. It leads to global warming.</p>', 'Do you know these too?', 'publish', 'open', 0, '2022-02-08 11:53:23', 27, 'facts,science,plants', '736303200620259b349f3a20220105_101439.jpg', 3, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL,
  `userkey` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_pic` text NOT NULL,
  `user_registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_status` int(11) NOT NULL DEFAULT '0',
  `user_description` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `userkey`, `name`, `email`, `password`, `profile_pic`, `user_registered`, `user_status`, `user_description`) VALUES
(9, '1a2dd1e5760d7f544909d228de3769a2', 'Johar Khan', 'joharkhan1999@gmail.com', '$2y$12$Wj0LsjNvfwVytDPknOcsN.D8nqmHksuY.qXp58J.Nn8RerdfgJeWG', '62014e184fc94jk3.jpg', '2022-02-07 16:51:36', 0, 'I am a software engineer and I love to write on different topics especially coding and programming!'),
(10, 'b9b276c1aefc96b73fb890e185e2c97a', 'Muzalfa Bibi', 'muzalfabibi500@gmail.com', '$2y$12$6ef4CA1yYzKb8t86hBo/jOTDye5gu2arUXQeQbj7yfYrBjG61S2ue', '6201d9040d2a016442881641807457768.jpg', '2022-02-08 02:44:20', 0, 'I am a student and I came here to type some information about various subjects. This will help the people get more knowledge and apart from this I will be able to pass my free time in it.'),
(11, '8813225e29123259859c1dd729cae003', 'Saadia Bibi', 'saadiabibi1999@gmail.com', '$2y$12$Xhd0rzlYseKEkm2ohv7Uzet/WYN2BdCsFWvIEJi.FgWRrJe9jZmI.', '6201fc7208a9bIMG_20220208_101251.jpg', '2022-02-08 05:15:30', 0, 'Mathematician. Nature loving. English writer.'),
(12, '39643810e6df37f04caf9bda8799cf92', 'Muhtasim Afridi', 'muhtasimafridi166@gmail.com', '$2y$12$M8C5Q8Lp8seIGSpR6B0tZeasUsI0YmFxfMcuPstaCim203KBjoxsy', '6201fcf2b8903INSTAGRAM.jpg', '2022-02-08 05:17:39', 0, 'I am Student of Strategic Studies department, National  Defence University, Islamabad.'),
(13, '0a69f8ca55559507eb8ec56b21b55723', 'Fatima Gul', 'gul800fatima@gmail.com', '$2y$12$B5v0yZoJM.0P92.xx8/Ape6OT9GdP8B2heu.mK57jhs/Ma7NyeCTK', '620244caf1ad520220106_121649~2.jpg', '2022-02-08 10:24:11', 0, 'I am a student who will provide information to you about various facts. So stay tuned:)');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `userkey` varchar(255) COLLATE armscii8_bin NOT NULL,
  `roleId` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `comment_replies`
--
ALTER TABLE `comment_replies`
  ADD PRIMARY KEY (`reply_id`);

--
-- Indexes for table `drafts`
--
ALTER TABLE `drafts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `comment_replies`
--
ALTER TABLE `comment_replies`
  MODIFY `reply_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `drafts`
--
ALTER TABLE `drafts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
