INSERT INTO `patient` (`id`, `nom`, `prenom`, `adresse`, `ville`, `cp`, `telephone`, `date_naissance`) VALUES
(1, 'Mercado', 'Basile', NULL, NULL, NULL, NULL, '2001-04-12'),
(2, 'Lang', 'Olivia', NULL, NULL, NULL, NULL, '2000-12-28'),
(3, 'Miroux', 'Julien', NULL, NULL, NULL, NULL, '2001-03-10'),
(4, 'Oudshoorn', 'Gaetan', NULL, NULL, NULL, NULL, '2001-12-14'),
(5, 'NomTest', 'PrenomTest', NULL, NULL, NULL, NULL, '1991-05-10');

INSERT INTO `consultation` (`id`, `patient_id`, `date`) VALUES
(1, 1, '2022-09-10'),
(2, 2, '2022-09-11'),
(3, 3, '2022-09-12'),
(4, 3, '2022-09-20'),
(5, 4, '2022-09-01'),
(6, 5, '2022-09-30');

INSERT INTO `medicament` (`id`, `libelle`) VALUES
(1, 'doliprane'),
(2, 'spasfon'),
(3, 'ventoline'),
(4, 'ibufène'),
(5, 'innovair'),
(6, 'moxylar'),
(7, 'gascon'),
(8, 'toplexil'),
(9, 'paracétamol'),
(10, 'bandage');

INSERT INTO `traitement` (`id`, `consultation_id`, `duree`, `date_deb`) VALUES
(1, 1, 14, '2022-09-11'),
(2, 2, 7, '2022-09-13'),
(3, 3, 21, '2022-09-15'),
(4, 4, 7, '2022-09-20'),
(5, 5, 10, '2022-09-05'),
(6, 6, 10, '2022-09-30');

INSERT INTO `indication` (`id`, `traitement_id`, `medicament_id`, `posologie`) VALUES
(1, 1, 7, '3 fois par jour'),
(2, 2, 8, '1 fois par jour'),
(3, 3, 1, '2 fois par jour'),
(4, 4, 9, '1 fois par jour'),
(5, 5, 6, '1 fois par jour'),
(6, 6, 10, '4 fois par jour');