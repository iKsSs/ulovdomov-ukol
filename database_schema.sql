CREATE TABLE IF NOT EXISTS `user` (
    `id` int(6) NOT NULL,
    `name` varchar(50) COLLATE utf8_czech_ci DEFAULT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

ALTER TABLE `user`
    ADD PRIMARY KEY (`id`);

######################################################################

CREATE TABLE IF NOT EXISTS `village` (
    `id` int(6) NOT NULL ,
    `name` varchar(50) COLLATE utf8_czech_ci DEFAULT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

ALTER TABLE `village`
    ADD PRIMARY KEY (`id`);

######################################################################

CREATE TABLE IF NOT EXISTS `user_permission` (
    `user_id` int(6) NOT NULL,
    `village_id` int(6) NOT NULL,
    `addressbook` int(1) NOT NULL,
    `search` int(1) NOT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

ALTER TABLE `user_permission`
    ADD PRIMARY KEY (`user_id`, `village_id`);

######################################################################

CREATE TABLE IF NOT EXISTS `user_admin` (
    `id` int(6) NOT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

ALTER TABLE `user_admin`
    ADD PRIMARY KEY (`id`);

######################################################################

ALTER TABLE `user`
    MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE `village`
    MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
