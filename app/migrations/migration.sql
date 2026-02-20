CREATE TABLE member (
    `id` int NOT NULL AUTO_INCREMENT,
    `pseudo` VARCHAR(255) NOT NULL,
    `password`VARCHAR(255) NOT NULL, 
    `mail` VARCHAR(255) NOT NULL UNIQUE,
    `image` TEXT DEFAULT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
);

CREATE TABLE book (
    `id` int NOT NULL AUTO_INCREMENT,
    `author` VARCHAR(255) NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `image` TEXT DEFAULT NULL,
    `description` TEXT NOT NULL,
    `owner_id` INT NOT NULL,
    `borrower_id` INT DEFAULT NULL,
    `borrowed_at` DATETIME DEFAULT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT book_member
    FOREIGN KEY (owner_id)
    references member(id),
    CONSTRAINT book_member_borrower
    FOREIGN KEY (borrower_id)
    references member(id),
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

INSERT INTO member (pseudo, password, mail, image) values
('Bob', '$2y$10$yRrLQZNUfJfc1v0DFZBd7em9srd42yjOq5XmeH5mfvjLlO1G8YwFm', 'aaa', 'uploads/spongebob.png'),
('Patric',   '$2y$10$yRrLQZNUfJfc1v0DFZBd7em9srd42yjOq5XmeH5mfvjLlO1G8YwFm', 'bbb', 'uploads/patrick.jpg');

-- mdp is ccc

INSERT INTO book (author, title, image, description, owner_id) VALUES
(
  'Frank Herbert',
  'Dune',
  'uploads/dunebookcover.jpg',
  'Epic tale of politics, religion and giant sandworms on the desert planet Arrakis.',
  1  
),
(
  'Isaac Asimov',
  'Foundation',
  'uploads/fondationbookcover.jpg',
  'The first volume of the landmark series about the collapse and rebirth of a galactic empire.',
  1   
),
(
  'George Orwell',
  '1984',
  'uploads/1984bookcover.jpg',
  'A chilling dystopia where Big Brother watches your every move and the truth is whatever the Party says it is.',
  1
),
(
  'J.R.R. Tolkien',
  'The Lord of the Rings',
  'uploads/lotrbookcover.jpg',
  'A hobbit, a ring, and the fate of Middle-earth hang in the balance in this defining work of high fantasy.',
  2
);

INSERT INTO message (content, created_at, sender_id, receiver_id) VALUES
(
  'Hi Patrick! Could I borrow your copy of Dune next week?',
  '2025-12-09 09:15:00',
  2,   -- Bob
  1    -- Patrick
),
(
  'Hi Bob! Sure, you can borrow it anytime next week 😊',
  '2025-12-09 09:22:00',
  1,   -- Patrick
  2    -- Bob
),
(
  'Awesome, thanks! Is Wednesday okay for you?',
  '2025-12-09 09:25:00',
  2,   -- Bob
  1    -- Patrick
),
(
  'Wednesday works perfectly. Want to grab it after work?',
  '2025-12-09 09:30:00',
  1,   -- Patrick
  2    -- Bob
),
(
  'Yes, that would be great. I’ll swing by around 6pm.',
  '2025-12-09 09:34:00',
  2,   -- Bob
  1    -- Patrick
),
(
  'Perfect! See you then.',
  '2025-12-09 09:36:00',
  1,   -- Patrick
  2    -- Bob
);
