CREATE TABLE member (
    `id` int NOT NULL AUTO_INCREMENT,
    `pseudo` VARCHAR(255) NOT NULL,
    `password`VARCHAR(255) NOT NULL, -- todo : if i have time handle encryption
    PRIMARY KEY (`id`)
);

CREATE TABLE book_state (
    `id` INT NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE book (
    `id` int NOT NULL AUTO_INCREMENT,
    `author` VARCHAR(255) NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `image` TEXT,
    `description` TEXT NOT NULL,
    `owner_id` INT NOT NULL,
    `borrower_id` INT DEFAULT NULL,
    `state_id` INT NOT NULL,
    CONSTRAINT book_member_owner
    FOREIGN KEY (owner_id)
    references member(id),
    CONSTRAINT book_member_borrower
    FOREIGN KEY (borrower_id)
    references member(id),
    CONSTRAINT book_book_state 
    FOREIGN KEY (state_id)
    REFERENCES book_state(id),
    PRIMARY KEY (`id`)
);

CREATE TABLE message (
    `id` INT NOT NULL AUTO_INCREMENT,
    `content` VARCHAR(255) NOT NULL,
    `created_at` DATETIME NOT NULL,
    `sender_id` INT NOT NULL,
    `receiver_id` INT NOT NULL,
    CONSTRAINT message_sender
    FOREIGN KEY (`sender_id`)
    REFERENCES `member`(`id`),
    CONSTRAINT message_receiver 
    FOREIGN KEY (`receiver_id`)
    REFERENCES `member`(`id`),
    PRIMARY KEY (`id`)
);

INSERT INTO book_state (title) VALUES
('free'),
('lent');   -- = already loaned out