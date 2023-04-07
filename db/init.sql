CREATE TABLE artists (
    id INTEGER NOT NULL UNIQUE,
    bio TEXT NOT NULL,
    name TEXT NOT NULL,
    country TEXT NOT NULL,

    embedded_album_url TEXT NOT NULL,
    review_content TEXT NOT NULL,
    rating INT NOT NULL,

    PRIMARY KEY (id AUTOINCREMENT)
);

-- Create artists table
INSERT INTO
    artists (id, bio, name, country, embedded_album_url, review_content, rating)
VALUES
    (0, "Objectively, Mid", "Taylor Swift", "United States", "https://open.spotify.com/embed/album/2fenSS68JI1h4Fo296JfGr?utm_source=generator" , "Not that mid?", 4);

INSERT INTO
    artists (id, bio, name, country, embedded_album_url, review_content, rating)
VALUES
    (1, "Objectively, Mid again", "Drake", "Canada", "https://open.spotify.com/embed/album/2fenSS68JI1h4Fo296JfGr?utm_source=generator" , "Not that mid?", 5);

INSERT INTO
    artists (id, bio, name, country, embedded_album_url, review_content, rating)
VALUES
    (2, "Excellent", "Michael Jackson", "United States", "https://open.spotify.com/embed/album/2ANVost0y2y52ema1E9xAZ?utm_source=generator" , "Good Artist", 5);

INSERT INTO
    artists (id, bio, name, country, embedded_album_url, review_content, rating)
VALUES
    (3, "Abel Makkonen Tesfaye (Amharic: አበል መኮነን ተስፋዬ; born February 16, 1990), known professionally as the Weeknd, is a Canadian singer and songwriter.[2] His music explores escapism, romance, and melancholia, and is often inspired by personal experiences.[3] His accolades include four Grammy Awards, twenty Billboard Music Awards, twenty-two Juno Awards, six American Music Awards, two MTV Video Music Awards, a Latin Grammy Award, and nominations for an Academy Award and a Primetime Emmy Award.", "The Weeknd", "Canada", "https://open.spotify.com/embed/album/0P3oVJBFOv3TDXlYRhGL7s?utm_source=generator" , "Good Artist", 5);

INSERT INTO
    artists (id, bio, name, country, embedded_album_url, review_content, rating)
VALUES
    (4, "Beyoncé Giselle Knowles-Carter (née Knowles; /biˈɒnseɪ/ (listen) bee-ON-say;[4] born September 4, 1981)[5] is an American singer, songwriter, record producer, and dancer. Regarded as one of the greatest entertainers of all time, she is known for her boundary-pushing artistry and vocal abilities.[6][7] Her success earned her the nickname 'Queen Bey', and have led her to become a cultural icon of the 21st century.", "Beyonce", "United States", "https://open.spotify.com/embed/album/2ANVost0y2y52ema1E9xAZ?utm_source=generator" , "Good Artist", 5);


-- Create tags table
CREATE TABLE tags (
    id INTEGER NOT NULL UNIQUE,
    title TEXT NOT NULL,

    PRIMARY KEY (id AUTOINCREMENT)
);

-- Country Tags
INSERT INTO
    tags (id, title)
VALUES
    (0, "United States");

INSERT INTO
    tags (id, title)
VALUES
    (1, "Canada");

--Rating Tags
INSERT INTO
    tags(id, title)
VALUES
    (2, "Rating: 1");

INSERT INTO
    tags(id, title)
VALUES
    (3, "Rating: 2");

INSERT INTO
    tags(id, title)
VALUES
    (4, "Rating: 3");

INSERT INTO
    tags(id, title)
VALUES
    (5, "Rating: 4");

INSERT INTO
    tags(id, title)
VALUES
    (6, "Rating: 5");

-- Stores relationships between artists and tags
CREATE TABLE artist_tags (
    id INTEGER NOT NULL UNIQUE,
    artist_id INTEGER NOT NULL,
    tag_id INTEGER NOT NULL,

    PRIMARY KEY (id AUTOINCREMENT),
    FOREIGN KEY (artist_id) REFERENCES artists(id),
    FOREIGN KEY (tag_id) REFERENCES tags(id)
);

--Taylor Swift 0 (Country, Rating)
INSERT INTO
    artist_tags (id, artist_id, tag_id)
VALUES
    (0, 0, 0);

INSERT INTO
    artist_tags (id, artist_id, tag_id)
VALUES
    (1, 0, 5);

--Drake 1
INSERT INTO
    artist_tags (id, artist_id, tag_id)
VALUES
    (2, 1, 1);

INSERT INTO
    artist_tags (id, artist_id, tag_id)
VALUES
    (3, 1, 6);

--Michael Jackson 2
INSERT INTO
    artist_tags (id, artist_id, tag_id)
VALUES
    (4, 2, 0);

INSERT INTO
    artist_tags (id, artist_id, tag_id)
VALUES
    (5, 2, 6);

--The Weeknd 3
INSERT INTO
    artist_tags (id, artist_id, tag_id)
VALUES
    (6, 3, 1);

INSERT INTO
    artist_tags (id, artist_id, tag_id)
VALUES
    (7, 3, 5);
