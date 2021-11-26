DROP DATABASE IF EXISTS library;
CREATE DATABASE library;
USE library;

CREATE TABLE users (
    id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    name_first VARCHAR(255) NOT NULL,
    name_last VARCHAR(255) NOT NULL,
    password BINARY(60) NOT NULL,
    role TINYINT UNSIGNED NOT NULL DEFAULT 1, # 1: client, 2: researcher, 3: librarian, 4: administrator
    created_at DATETIME NOT NULL DEFAULT NOW(),
    updated_at DATETIME NOT NULL DEFAULT NOW() ON UPDATE NOW()
);

CREATE TABLE publishers (
    id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE authors (
    id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name_first VARCHAR(100) NOT NULL, 
    name_middle VARCHAR(50), 
    name_last VARCHAR(100)
);

CREATE TABLE genres (
    id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL, 
    parent_id INTEGER UNSIGNED REFERENCES genres(id)
);

CREATE TABLE books (
    id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL, 
    pages INTEGER UNSIGNED, 
    slug VARCHAR(255),
    rating DECIMAL(4, 2), 
    isbn VARCHAR(13), 
    published_at DATE, 
    publisher_id INTEGER UNSIGNED REFERENCES publishers(id)
);

CREATE TABLE book_authors (
    book_id INTEGER UNSIGNED NOT NULL REFERENCES books(id), 
    author_id INTEGER UNSIGNED NOT NULL REFERENCES authors(id), 
    PRIMARY KEY(book_id, author_id)
);

CREATE TABLE book_genres (
    book_id INTEGER UNSIGNED NOT NULL REFERENCES books(id), 
    genre_id INTEGER UNSIGNED NOT NULL REFERENCES genres(id), 
    PRIMARY KEY(book_id, genre_id)
);

CREATE TABLE clients (
    id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INTEGER UNSIGNED REFERENCES users(id),
    name_first VARCHAR(255),
    name_last VARCHAR(255),
    email VARCHAR(255),
    phone VARCHAR(255),
    address VARCHAR(255),
    postal_code VARCHAR(10),
    province VARCHAR(50),
    country VARCHAR(100),
    card VARCHAR(16) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT NOW(),
    updated_at DATETIME NOT NULL DEFAULT NOW() ON UPDATE NOW()
);

INSERT INTO users (email, name_first, name_last, role, password) VALUES 
    ('admin@ontariotechu.net', 'Ontario', 'Tech', 4, '$2y$10$ShhmLiA0isK.9UBzeAp16.6aJmynQn0Wan/J72J1Um8XAVdUrtfN6'), # password is 'password'
    ('librarian@ontariotechu.net', 'Vanessa', 'Baker', 3, '$2y$10$ShhmLiA0isK.9UBzeAp16.6aJmynQn0Wan/J72J1Um8XAVdUrtfN6'), # password is 'password'
    ('researcher@ontariotechu.net', 'Chloe', 'McLean', 2, '$2y$10$ShhmLiA0isK.9UBzeAp16.6aJmynQn0Wan/J72J1Um8XAVdUrtfN6'), # password is 'password'
    ('student@ontariotechu.net', 'Austin', 'Kerr', 1, '$2y$10$ShhmLiA0isK.9UBzeAp16.6aJmynQn0Wan/J72J1Um8XAVdUrtfN6'); # password is 'password'

INSERT INTO `clients` (`name_first`,`name_last`,`phone`,`email`,`address`,`postal_code`,`province`,`country`,`card`) VALUES
  ("Kaye","Grant","(316) 410-8659","g.kaye@yahoo.com","Ap #965-6166 Enim. St.","R1J 6T7","Manitoba","Canada","2934100378673852"),
  ("Winifred","James","(226) 723-4345","jameswinifred8118@yahoo.com","Ap #186-3475 Ante. Ave","34W 7X8","Northwest Territories","Canada","2934100308114302"),
  ("Leila","Rodriquez","(425) 364-6776","rodriquez.leila8094@yahoo.com","Ap #386-9162 Metus. Ave","J2H 3N4","Quebec","Canada","2934100313607640"),
  ("Jade","King","(202) 486-2193","jking7430@gmail.com","851-1451 Lorem Road","78B 7J2","Nunavut","Canada","2934100350630935"),
  ("Maggy","Combs","(434) 236-9858","combs-maggy@yahoo.com","P.O. Box 908, 3077 Vestibulum Road","T1X 0R2","Alberta","Canada","2934100340081616"),
  ("Regan","Alexander","(895) 426-5110","aregan3449@yahoo.com","657-5572 Feugiat Av.","N5N 0T2","Ontario","Canada","2934100306704588"),
  ("Flavia","Collins","(375) 873-7481","flavia-collins@gmail.com","Ap #204-3369 Odio, St.","P6H 2T8","Prince Edward Island","Canada","2934100315333123"),
  ("Renee","Duke","(876) 882-8675","d_renee@yahoo.com","Ap #547-2544 Nullam Street","Y2G 2C5","Yukon","Canada","2934100343374421"),
  ("Yvette","Stone","(394) 498-7077","stone-yvette@gmail.com","P.O. Box 384, 4332 Et Avenue","33R 2C5","Northwest Territories","Canada","2934100343536788"),
  ("Ariel","Gaines","(131) 832-9983","ariel-gaines5450@ontariotechu.net","Ap #113-6080 Vulputate, Ave","53Y 4Y7","Northwest Territories","Canada","2934100351960602"),
  ("Sophia","Smith","(475) 732-2593","s.sophia9270@gmail.com","7179 Interdum Road","H8R 2H3","Quebec","Canada","2934100361639126"),
  ("Bevis","Golden","(412) 848-8410","g.bevis5109@gmail.com","712-8326 Donec Street","A4M 4Y7","Newfoundland and Labrador","Canada","2934100304947318"),
  ("Cleo","Allison","(428) 478-4765","allison.cleo@gmail.com","361-5348 Nibh. Street","L2X 5B6","Ontario","Canada","2934100383478505"),
  ("Yuli","Kane","(476) 225-9222","y.kane1496@ontariotechu.net","P.O. Box 651, 9850 Velit. Av.","54K 2G3","Northwest Territories","Canada","2934100392017722"),
  ("Marah","Chavez","(121) 485-5665","chavez.marah@ontariotechu.net","P.O. Box 656, 4883 Vitae Rd.","66K 5N3","Northwest Territories","Canada","2934100323467808"),
  ("Bevis","Cooper","(348) 447-6382","cooper.bevis9867@gmail.com","Ap #572-2868 Ligula. Av.","B3S 3J3","Nova Scotia","Canada","2934100373664870"),
  ("Davis","Baird","(389) 177-5040","b-davis1438@gmail.com","3709 Sociis Street","A2K 1Y1","Newfoundland and Labrador","Canada","2934100357739174"),
  ("Simone","Glover","(585) 270-0472","glover.simone5645@gmail.com","181-4887 Cursus Rd.","B6B 3J4","Nova Scotia","Canada","2934100389637988"),
  ("Alvin","Hines","(758) 757-7232","hines_alvin2227@yahoo.com","3555 Leo. Ave","44X 7S3","Nunavut","Canada","2934100355812093"),
  ("Virginia","Franks","(687) 628-0598","vfranks@yahoo.com","413-5154 Vel, Road","92P 4T3","Northwest Territories","Canada","2934100327507171"),
  ("Lucian","Paul","(442) 436-3471","lpaul@gmail.com","442-9034 Id, Street","H4R 7G8","Quebec","Canada","2934100323390924"),
  ("Myra","Conrad","(477) 734-0921","m_conrad@ontariotechu.net","Ap #630-5563 Vulputate Rd.","T7P 6W7","Alberta","Canada","2934100348810784"),
  ("Noah","Sweeney","(875) 396-3171","s_noah4110@ontariotechu.net","9268 Nunc. Street","39L 6N9","Northwest Territories","Canada","2934100302108942"),
  ("Nita","Finley","(883) 693-4491","f_nita1574@yahoo.com","Ap #874-7499 Non, Av.","80T 8V4","Nunavut","Canada","2934100346394329"),
  ("TaShya","Roach","(714) 798-2481","t.roach@yahoo.com","576-6202 Malesuada Ave","58T 1C7","Nunavut","Canada","2934100362725460"),
  ("Clark","Barnett","(711) 638-4285","c-barnett9819@gmail.com","181-4580 Vestibulum Street","65S 3N6","Northwest Territories","Canada","2934100383590595"),
  ("Tate","Cherry","(741) 787-6541","c.tate7638@ontariotechu.net","221-3683 Sem St.","I4B 8H4","British Columbia","Canada","2934100306280532"),
  ("Gil","Morrow","(331) 174-6829","mgil8906@yahoo.com","353-8216 Sagittis Ave","Y7P 1J2","Yukon","Canada","2934100345514222"),
  ("Armand","Good","(415) 277-6412","a.good@yahoo.com","823-9345 Ut, Street","28L 7C6","Northwest Territories","Canada","2934100336000863"),
  ("Hedley","Dennis","(274) 582-7139","h_dennis9646@gmail.com","Ap #753-1637 Donec St.","S2N 0P3","Saskatchewan","Canada","2934100390266719"),
  ("Hop","Yates","(854) 476-4494","yates-hop@ontariotechu.net","740-3502 Fusce Av.","S1S 2K3","Saskatchewan","Canada","2934100344616432"),
  ("Sandra","Vargas","(603) 283-7607","s_vargas@yahoo.com","142-4899 Fringilla Street","T7P 7E3","Alberta","Canada","2934100317431500"),
  ("Josiah","Knowles","(922) 628-4752","knowles.josiah7096@gmail.com","P.O. Box 176, 1725 Nec Road","40Z 8X0","Northwest Territories","Canada","2934100317510708"),
  ("Mason","Whitney","(556) 328-1392","whitney-mason@gmail.com","Ap #156-6406 Sodales Street","Y8J 7K5","Yukon","Canada","2934100346593474"),
  ("Hollee","Ward","(163) 124-7412","h-ward@ontariotechu.net","Ap #457-6409 Elit St.","B7N 5E7","Nova Scotia","Canada","2934100364707042"),
  ("Henry","Miles","(535) 819-7539","m.henry@ontariotechu.net","P.O. Box 500, 9358 Arcu. Rd.","G2V 1W7","Quebec","Canada","2934100307928180"),
  ("Rashad","Norton","(264) 232-5413","rashad-norton9323@gmail.com","Ap #731-411 Nisi St.","S6X 7W1","Saskatchewan","Canada","2934100371439043"),
  ("Alvin","Robles","(859) 452-9785","a_robles3424@yahoo.com","7287 Pede, Rd.","B5E 0E2","Nova Scotia","Canada","2934100359142472"),
  ("Brody","Holloway","(403) 604-5117","b-holloway2886@gmail.com","540-2599 Adipiscing Ave","T8Y 2J6","Prince Edward Island","Canada","2934100382833898"),
  ("Nasim","Landry","(270) 838-7374","landry_nasim7773@yahoo.com","9220 Libero St.","S6C 3G8","Saskatchewan","Canada","2934100347810353"),
  ("Deacon","Lindsay","(643) 462-6663","l_deacon9730@yahoo.com","458-5704 Fermentum Ave","S5S 3X7","Saskatchewan","Canada","2934100385015958"),
  ("Sydney","Walter","(176) 398-3045","s-walter9355@gmail.com","243-1791 Enim. St.","R2V 1H8","Manitoba","Canada","2934100384936168"),
  ("Illiana","Heath","(847) 426-2694","illiana.heath3098@gmail.com","493-4713 Lectus. Av.","20G 4C7","Northwest Territories","Canada","2934100389142464"),
  ("Morgan","Harrison","(851) 386-1971","harrison_morgan9968@yahoo.com","231-9812 Neque Street","76M 5G4","Nunavut","Canada","2934100371929054"),
  ("Garrison","Page","(476) 463-1359","garrison.page@yahoo.com","501-9093 Conubia Av.","H4J 7J8","Quebec","Canada","2934100326143476"),
  ("Clark","Skinner","(913) 511-4645","c-skinner@gmail.com","Ap #417-7225 Nullam Street","B1J 7K3","Nova Scotia","Canada","2934100365514361"),
  ("Ulla","Buck","(605) 816-1432","u_buck8013@yahoo.com","Ap #990-8447 Sem. Street","N4C 3Z3","Ontario","Canada","2934100349278394"),
  ("Leandra","Guerra","(741) 184-1554","g_leandra4254@ontariotechu.net","Ap #411-3384 Donec Road","B2S 4C4","Nova Scotia","Canada","2934100390122884"),
  ("Clark","Mathews","(522) 668-7761","clark.mathews@gmail.com","5716 Nulla. Street","S5N 3W9","Saskatchewan","Canada","2934100395588960"),
  ("Bradley","Witt","(447) 546-8958","b_witt@yahoo.com","P.O. Box 743, 6176 Integer Street","A2K 2S5","Newfoundland and Labrador","Canada","2934100350436664"),
  ("Kiayada","Stevenson","(776) 551-8444","kstevenson@gmail.com","Ap #876-9825 Eu St.","E8R 3P2","British Columbia","Canada","2934100347683176"),
  ("Stuart","Collins","(868) 165-5282","stuart.collins8592@gmail.com","Ap #510-357 Sit St.","T5L 4Y8","Alberta","Canada","2934100339935039"),
  ("Lee","Barton","(703) 331-9044","leebarton340@yahoo.com","9627 Nunc Ave","L7K 9R4","Prince Edward Island","Canada","2934100339567334"),
  ("Gregory","Martin","(434) 634-8645","m_gregory5485@ontariotechu.net","8769 Neque. St.","H5E 0H4","Quebec","Canada","2934100376188478"),
  ("Brynn","Hickman","(238) 789-0522","b-hickman4779@gmail.com","Ap #144-3116 Curabitur Rd.","T2M 7T0","Alberta","Canada","2934100349525106"),
  ("Risa","Berger","(603) 793-5459","brisa@gmail.com","402-6431 Mauris St.","L6X 1V0","Ontario","Canada","2934100394424305"),
  ("Blake","Tyler","(688) 801-5164","tyler.blake@yahoo.com","551-1622 Massa. Street","K5E 1S0","Ontario","Canada","2934100384924766"),
  ("Aquila","Mcfarland","(307) 227-5038","mcfarlandaquila8787@gmail.com","Ap #699-3579 Velit St.","R3N 4J9","Manitoba","Canada","2934100341110407"),
  ("Richard","Foreman","(590) 563-1118","foremanrichard@yahoo.com","486-7721 Luctus Road","88K 1Y7","Nunavut","Canada","2934100384215667"),
  ("Chantale","Parker","(963) 658-6266","chantale-parker@ontariotechu.net","P.O. Box 126, 9458 Nonummy Av.","A7M 5A1","Newfoundland and Labrador","Canada","2934100347522755"),
  ("Aquila","Sellers","(593) 433-4712","sellers.aquila3686@ontariotechu.net","Ap #872-3035 At Street","D1V 8Y3","Prince Edward Island","Canada","2934100340319729"),
  ("Kelsey","O'connor","(897) 858-2641","oconnor-kelsey@ontariotechu.net","107-2507 Lobortis Street","H2S 7M1","Quebec","Canada","2934100392131828"),
  ("Cairo","Rush","(435) 627-6117","rush-cairo@yahoo.com","7796 Ipsum Street","S0H 4C8","Saskatchewan","Canada","2934100303063471"),
  ("Iris","Best","(604) 278-3023","b.iris3117@yahoo.com","369-5484 Nibh. Ave","Y6Z 8M7","Yukon","Canada","2934100339501005"),
  ("Julian","Caldwell","(393) 614-8803","c-julian369@gmail.com","Ap #982-7654 Tempus Avenue","B7C 0Y3","Nova Scotia","Canada","2934100395494870"),
  ("Hedda","Mendoza","(918) 856-8402","hedda_mendoza@ontariotechu.net","P.O. Box 755, 5306 Tellus Road","Y1P 2H8","Yukon","Canada","2934100368009028"),
  ("Germaine","Campbell","(742) 446-9201","campbellgermaine7614@yahoo.com","Ap #267-2802 Luctus St.","J3K 8X5","Quebec","Canada","2934100396011273"),
  ("Hermione","Becker","(364) 655-6613","hermione.becker@gmail.com","Ap #188-1404 Maecenas Av.","B2P 2V4","Nova Scotia","Canada","2934100348507022"),
  ("Alvin","Madden","(376) 827-2830","m.alvin5162@yahoo.com","Ap #925-2521 Accumsan St.","f3X 8B8","New Brunswick","Canada","2934100317557886"),
  ("Ishmael","Meyer","(331) 583-9182","meyer-ishmael@ontariotechu.net","P.O. Box 479, 9928 Sed Rd.","T2R 2L8","Alberta","Canada","2934100329754295"),
  ("Quentin","Villarreal","(116) 773-1543","quentin-villarreal5079@gmail.com","293-6556 Et Rd.","Y4J 1P5","Yukon","Canada","2934100380948458"),
  ("Whitney","Mueller","(463) 672-9334","mwhitney7337@ontariotechu.net","207-7381 Dolor. Av.","Y6W 2P1","Yukon","Canada","2934100307779252"),
  ("Orli","Pierce","(735) 146-7423","o-pierce6659@gmail.com","211-5258 Purus Street","A7P 8J8","British Columbia","Canada","2934100314511063"),
  ("Mason","Sweeney","(136) 520-7577","sweeney-mason@gmail.com","P.O. Box 406, 4836 Faucibus Rd.","B4C 9C4","Nova Scotia","Canada","2934100314997982"),
  ("Caryn","Daniels","(582) 413-7637","c-daniels6256@gmail.com","743 Vehicula St.","H3R 4X7","Quebec","Canada","2934100338478030"),
  ("Natalie","Mcpherson","(793) 797-1497","m.natalie8526@gmail.com","P.O. Box 438, 404 Fermentum Rd.","N6N 8J6","Ontario","Canada","2934100305018122"),
  ("Tobias","Tanner","(811) 525-6527","tanner-tobias@yahoo.com","Ap #332-7888 Scelerisque Rd.","28P 2E1","Northwest Territories","Canada","2934100392875485"),
  ("Tatiana","Hahn","(552) 963-5449","t-hahn5906@yahoo.com","434-7295 Dignissim Street","B3M 1K6","Nova Scotia","Canada","2934100385740513"),
  ("Shay","Hopkins","(178) 743-6271","s-hopkins5409@yahoo.com","124-1733 Velit Ave","46V 1R4","Northwest Territories","Canada","2934100361073057"),
  ("Cathleen","Wooten","(863) 528-6042","cathleen_wooten3632@yahoo.com","P.O. Box 494, 5756 Metus. Rd.","S8B 6V3","Saskatchewan","Canada","2934100398685998"),
  ("Giacomo","Munoz","(977) 429-2428","giacomo-munoz6442@yahoo.com","249-7086 Nullam Av.","B8X 9W3","Nova Scotia","Canada","2934100353424861"),
  ("Hayes","Reese","(630) 613-9633","h-reese@yahoo.com","Ap #894-9962 Dolor. Road","P2H 0W2","Prince Edward Island","Canada","2934100352809712"),
  ("Jaquelyn","Bush","(824) 872-4247","jaquelyn.bush@yahoo.com","Ap #832-5138 Pellentesque Rd.","L2X 3X6","Ontario","Canada","2934100369858700"),
  ("Simone","Howell","(535) 269-5302","howell_simone@ontariotechu.net","Ap #640-8650 Bibendum. Street","52M 3B4","Nunavut","Canada","2934100345987986"),
  ("Harrison","Thomas","(642) 726-1185","t_harrison5838@ontariotechu.net","7986 Fermentum St.","N6V 7A5","Ontario","Canada","2934100360429295"),
  ("Phyllis","Gould","(881) 711-6972","p.gould@yahoo.com","821-732 Ullamcorper. Rd.","73G 2B1","Northwest Territories","Canada","2934100370494323"),
  ("Kyra","William","(261) 484-6485","william.kyra@ontariotechu.net","505-4481 Nibh. Avenue","H6B 5E2","Quebec","Canada","2934100396147667"),
  ("Simon","Welch","(917) 889-1291","w-simon@yahoo.com","P.O. Box 707, 3175 Fermentum Ave","I3P 6L2","British Columbia","Canada","2934100390341646"),
  ("Sage","Johns","(400) 349-9321","johnssage@gmail.com","P.O. Box 590, 4634 Adipiscing Rd.","R7M 3V3","Manitoba","Canada","2934100361023081"),
  ("Azalia","Hodges","(637) 943-8342","a.hodges@yahoo.com","P.O. Box 919, 2793 Sed Street","F5L 4P3","Prince Edward Island","Canada","2934100377786632"),
  ("Calvin","Ewing","(937) 883-3226","ewing-calvin4957@gmail.com","161-9236 Ullamcorper Ave","B4T 4M8","Nova Scotia","Canada","2934100320295277"),
  ("Rina","Whitehead","(824) 763-0802","whitehead.rina@gmail.com","5473 Mauris Av.","T5P 7H3","Alberta","Canada","2934100329002207"),
  ("Samuel","Bartlett","(432) 900-6652","samuel-bartlett@gmail.com","P.O. Box 553, 1346 Sapien. St.","R3T 2B8","Manitoba","Canada","2934100347107987"),
  ("Carl","Mcintyre","(691) 480-4661","c_mcintyre2869@ontariotechu.net","P.O. Box 595, 8220 Mauris, Street","B5Z 4N7","Nova Scotia","Canada","2934100379623643"),
  ("Rigel","Finley","(752) 575-1465","rfinley315@yahoo.com","Ap #265-9423 Quam St.","B6T 2V2","Nova Scotia","Canada","2934100323299201"),
  ("Cade","Dunn","(482) 512-2731","c_dunn4606@ontariotechu.net","7641 Hendrerit Avenue","M1K 1X7","Ontario","Canada","2934100369879609"),
  ("Brooke","Harvey","(683) 571-1237","hbrooke4059@gmail.com","613-5699 Dictum Avenue","B3Y 5W2","Nova Scotia","Canada","2934100389061725"),
  ("Jordan","Park","(984) 892-5514","j.park@yahoo.com","Ap #653-7173 Arcu. St.","S1G 2Y5","Saskatchewan","Canada","2934100311782400"),
  ("Xaviera","Poole","(750) 205-3385","poole_xaviera1052@yahoo.com","Ap #227-8653 Vestibulum. Avenue","R3C 4W6","Manitoba","Canada","2934100367272341"),
  ("Keelie","Shaw","(450) 285-7189","shaw-keelie@yahoo.com","313-9260 Placerat, Rd.","Y7A 8C5","Yukon","Canada","2934100350795748");