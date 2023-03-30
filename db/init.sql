-- TODO: create tables

-- CREATE TABLE `examples` (
-- 	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
-- 	`name`	TEXT NOT NULL
-- );


-- TODO: initial seed data

-- INSERT INTO `examples` (name) VALUES ('example-1');
-- INSERT INTO `examples` (name) VALUES ('example-2');
CREATE TABLE reviews (
    id INTEGER NOT NULL UNIQUE,
    content TEXT NOT NULL,
    embedded_album_url TEXT NOT NULL,
    rating INT NOT NULL,
    PRIMARY KEY (id AUTOINCREMENT)
);

INSERT INTO
    reviews (id, content, embedded_album_url, rating)
VALUES
    (0, "Also mid", "https://open.spotify.com/embed/album/0hs7vyPmE5xc5unosGzrSd?utm_source=generator", 3);


CREATE TABLE artists (
    id INTEGER NOT NULL UNIQUE,
    bio TEXT NOT NULL,
    title TEXT NOT NULL,
    review_content TEXT,
    country TEXT NOT NULL,
    PRIMARY KEY (id AUTOINCREMENT),
    FOREIGN KEY (review_content) REFERENCES reviews(content)
);

INSERT INTO
    artists (id, bio, title, review_content, country)
VALUES
    (0, "Mid", "Taylor Swift", "also mid", "United States");


INSERT INTO
    artists (id, bio, title, review_content, country)
VALUES
    (1, "Kinda MId", "Taylor Swift 2", "also mid", "Russia");

INSERT INTO
    artists (id, bio, title, review_content, country)
VALUES
    (2, "Somewhat mid tbh", "Taylor Swift 3", "also mid", "United States");

INSERT INTO
    artists (id, bio, title, review_content, country)
VALUES
    (3, "Good and things and stuff and placement text", "Taylor Swift 4", "also mid", "United States");
