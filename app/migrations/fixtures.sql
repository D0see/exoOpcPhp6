-- 1.  Members ----------------------------------------------------------
INSERT INTO member (pseudo, password) VALUES
('Alice', 'alice123'),
('Bob',   'bob123');

-- 2.  Book states ------------------------------------------------------
INSERT INTO book_state (title) VALUES
('free'),
('lent');   -- = already loaned out

-- 3.  Books (Alice owns both; Dune is currently lent, Foundation is free)
INSERT INTO book (author, title, image, description, owner_id, state_id) VALUES
(
  'Frank Herbert',
  'Dune',
  'https://example.com/dune.jpg',
  'Epic tale of politics, religion and giant sandworms on the desert planet Arrakis.',
  1,   -- Alice
  2    -- lent
),
(
  'Isaac Asimov',
  'Foundation',
  'https://example.com/foundation.jpg',
  'The first volume of the landmark series about the collapse and rebirth of a galactic empire.',
  1,   -- Alice
  1    -- free
);

-- Conversation: Alice (1) ↔ Bob (2) ----------------------------------

INSERT INTO message (content, created_at, sender_id, receiver_id) VALUES
(
  'Hi Alice! Could I borrow your copy of Dune next week?',
  '2025-12-09 09:15:00',
  2,   -- Bob
  1    -- Alice
),
(
  'Hi Bob! Sure, you can borrow it anytime next week 😊',
  '2025-12-09 09:22:00',
  1,   -- Alice
  2    -- Bob
),
(
  'Awesome, thanks! Is Wednesday okay for you?',
  '2025-12-09 09:25:00',
  2,   -- Bob
  1    -- Alice
),
(
  'Wednesday works perfectly. Want to grab it after work?',
  '2025-12-09 09:30:00',
  1,   -- Alice
  2    -- Bob
),
(
  'Yes, that would be great. I’ll swing by around 6pm.',
  '2025-12-09 09:34:00',
  2,   -- Bob
  1    -- Alice
),
(
  'Perfect! See you then.',
  '2025-12-09 09:36:00',
  1,   -- Alice
  2    -- Bob
);
