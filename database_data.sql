
INSERT INTO `user` (`id`, `name`) VALUES
(1, 'Adam'),
(2, 'Bob'),
(3, 'Cyril'),
(4, 'Derek'),
(5, 'Fred');


#################################################

INSERT INTO `village` (`id`, `name`) VALUES
(1, 'Praha'),
(2, 'Brno');


#################################################

INSERT INTO `user_permission` (`user_id`, `village_id`, `addressbook`, `search`) VALUES
(1, 1, 1, 1),
(1, 2, 0, 0),
(2, 1, 0, 1),
(2, 2, 1, 0),
(3, 1, 1, 0),
(3, 2, 1, 1);


#################################################

INSERT INTO `user_admin` (`id`) VALUES
(1),
(2),
(3),
(5);
