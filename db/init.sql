-- Create Users and Sessions
CREATE TABLE users (
    id INTEGER NOT NULL UNIQUE,
    username TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,

    PRIMARY KEY(id AUTOINCREMENT)
);

CREATE TABLE sessions (
    id INTEGER NOT NULL UNIQUE,
    user_id INTEGER NOT NULL,
    session TEXT NOT NULL UNIQUE,
    last_login TEXT NOT NULL,

    PRIMARY KEY(id AUTOINCREMENT) FOREIGN KEY(user_id) REFERENCES users(id)

);

--Admins only
INSERT INTO
    users (username, password)
VALUES
    ("admin", "$2y$10$QtCybkpkzh7x5VN11APHned4J8fu78.eFXlyAMmahuAaNcbwZ7FH.");

INSERT INTO
    users (username, password)
VALUES
    ("admin2", "$2y$10$QtCybkpkzh7x5VN11APHned4J8fu78.eFXlyAMmahuAaNcbwZ7FH.");



CREATE TABLE artists (
    id INTEGER NOT NULL UNIQUE,
    bio TEXT NOT NULL,
    name TEXT NOT NULL,

    file_ext TEXT NOT NULL,

    embedded_album_url TEXT NOT NULL,
    review_content TEXT NOT NULL,

    citation TEXT,

    PRIMARY KEY (id AUTOINCREMENT)
);
-- Create artists table
INSERT INTO
    artists (id, bio, name, file_ext, embedded_album_url, review_content, citation)
VALUES
    (0, "Taylor Alison Swift (born December 13, 1989) is an American singer-songwriter. Her genre-spanning discography, songwriting, and artistic reinventions have received critical praise and wide media coverage. Born in West Reading, Pennsylvania, Swift moved to Nashville at age 14 to become a country artist. She signed a songwriting deal with Sony/ATV Music Publishing in 2004 and a recording contract with Big Machine Records in 2005. Her 2006 self-titled debut album made her the first female country artist to write a U.S. platinum-certified album.", "Taylor Swift", "jpg", "https://open.spotify.com/embed/album/2QJmrSgbdM35R67eoGQo4j?utm_source=generator" , "Not that mid?", "https://en.wikipedia.org/wiki/Taylor_Swift");

INSERT INTO
    artists (id, bio, name, file_ext, embedded_album_url, review_content, citation)
VALUES
    (1, "Aubrey Drake Graham[4] (/ɔːˈbriː/ aw-BREE; born October 24, 1986) is a Canadian rapper, singer, and songwriter.[5] An influential figure in contemporary popular music, Drake has been credited for popularizing singing and R&B sensibilities in hip hop. Gaining recognition by starring as Jimmy Brooks in the CTV teen drama series Degrassi: The Next Generation (2001–08), he pursued a career in music releasing his debut mixtape Room for Improvement in 2006. He followed this with the mixtapes Comeback Season (2007) and So Far Gone (2009) before signing with Young Money Entertainment.[6]", "Drake", "jpg", "https://open.spotify.com/embed/album/40GMAhriYJRO1rsY4YdrZb?utm_source=generator" , "Not that mid?", "https://en.wikipedia.org/wiki/Drake_(musician)");

INSERT INTO
    artists (id, bio, name, file_ext, embedded_album_url, review_content, citation)
VALUES
    (2, "Michael Joseph Jackson (August 29, 1958 – June 25, 2009) was an American singer, songwriter, dancer, and philanthropist. Dubbed the 'King of Pop', he is regarded as one of the most significant cultural figures of the 20th century. Over a four-decade career, his contributions to music, dance, and fashion, along with his publicized personal life, made him a global figure in popular culture. Jackson influenced artists across many music genres; through stage and video performances, he popularized complicated dance moves such as the moonwalk, to which he gave the name, as well as the robot.", "Michael Jackson", "jpg", "https://open.spotify.com/embed/album/2ANVost0y2y52ema1E9xAZ?utm_source=generator" , "Good Artist", "https://en.wikipedia.org/wiki/Michael_Jackson");

INSERT INTO
    artists (id, bio, name, file_ext, embedded_album_url, review_content, citation)
VALUES
    (3, "Abel Makkonen Tesfaye (Amharic: አበል መኮነን ተስፋዬ; born February 16, 1990), known professionally as the Weeknd, is a Canadian singer and songwriter.[2] His music explores escapism, romance, and melancholia, and is often inspired by personal experiences.[3] His accolades include four Grammy Awards, twenty Billboard Music Awards, twenty-two Juno Awards, six American Music Awards, two MTV Video Music Awards, a Latin Grammy Award, and nominations for an Academy Award and a Primetime Emmy Award.", "The Weeknd", "jpg", "https://open.spotify.com/embed/album/0P3oVJBFOv3TDXlYRhGL7s?utm_source=generator" , "Good Artist", "https://en.wikipedia.org/wiki/The_Weeknd");

INSERT INTO
    artists (id, bio, name, file_ext, embedded_album_url, review_content, citation)
VALUES
    (4, "Beyoncé Giselle Knowles-Carter (née Knowles; /biˈɒnseɪ/ (listen) bee-ON-say;[4] born September 4, 1981)[5] is an American singer, songwriter, record producer, and dancer. Regarded as one of the greatest entertainers of all time, she is known for her boundary-pushing artistry and vocal abilities.[6][7] Her success earned her the nickname 'Queen Bey', and have led her to become a cultural icon of the 21st century.", "Beyonce", "jpg", "https://open.spotify.com/embed/album/7dK54iZuOxXFarGhXwEXfF?utm_source=generator" , "Good Artist", "https://en.wikipedia.org/wiki/Beyonc%C3%A9");

INSERT INTO
    artists (id, bio, name, file_ext, embedded_album_url, review_content, citation)
VALUES
    (5, "Christopher Francis Ocean (born Christopher Edwin Breaux; October 28, 1987), is an American singer, songwriter, photographer, fashion designer, and rapper. His works are noted by music critics for featuring avant-garde styles and introspective, elliptical lyrics.[2][3] Ocean has won two Grammy Awards and a Brit Award for International Male Solo Artist among other accolades, and his two studio albums have been listed on Rolling Stone's 500 Greatest Albums of All Time (2020).", "Frank Ocean", "jpg", "https://open.spotify.com/embed/album/392p3shh2jkxUxY2VHvlH8?utm_source=generator" , "Good Artist, probably shouldn't have done Coachella though", "https://en.wikipedia.org/wiki/Frank_Ocean");

INSERT INTO
    artists (id, bio, name, file_ext, embedded_album_url, review_content, citation)
VALUES
    (6, "Onika Tanya Maraj-Petty (née Maraj; born December 8, 1982), known professionally as Nicki Minaj (/nɪki ˈmɪˈnɑːʒ/ nick-EE min-AHZH), is a Trinidadian-born[a] rapper, singer and songwriter based in the United States. She is known for her musical versatility, animated flow in her rapping, alter egos and accents. Minaj first gained recognition after releasing three mixtapes between 2007 and 2009. Her debut album, Pink Friday (2010), topped the U.S. Billboard 200 chart. Its fifth single, 'Super Bass', reached number three on the U.S. Billboard Hot 100 chart and was certified diamond by the RIAA. Minaj's follow-up album, Pink Friday: Roman Reloaded (2012) explored dance-pop. The lead single, 'Starships', peaked in the top five worldwide.", "Nicki Minaj", "jpg", "https://open.spotify.com/embed/album/5ooCuPIk58IwSo6DRr1JCu?utm_source=generator" , "Good Artist", "https://en.wikipedia.org/wiki/Nicki_Minaj");

INSERT INTO
    artists (id, bio, name, file_ext, embedded_album_url, review_content, citation)
VALUES
    (7, "Tyler Gregory Okonma (born March 6, 1991), known professionally as Tyler, the Creator, is an American rapper and record producer.[2] He is one of the founding members of the music collective Odd Future. Okonma has won two Grammy Awards,[3] three BET Hip Hop Awards, a BRIT Award, and a MTV Video Music Award. Okonma is considered one of the most influential and greatest Hip-Hop music artists of all time.", "Tyler the Creator", "jpg", "https://open.spotify.com/embed/album/2nkto6YNI4rUYTLqEwWJ3o?utm_source=generator" , "Good Artist", "https://en.wikipedia.org/wiki/Tyler,_the_Creator");

INSERT INTO
    artists (id, bio, name, file_ext, embedded_album_url, review_content, citation)
VALUES
    (8, "Nasir bin Olu Dara Jones (/nɑːˈsɪər/; born September 14, 1973), better known by his stage name Nas (/nɑːz/), is an American rapper. Rooted in East Coast hip hop, he is regarded as one of the greatest rappers of all time.[1][2][3] The son of jazz musician Olu Dara, Jones began his musical career in 1989 as he adopted the moniker of 'Nasty Nas' and recorded demos for Large Professor. He was later featured on the 1991 song 'Live at the Barbeque' by Main Source.", "Nas", "jpg", "https://open.spotify.com/embed/album/3kEtdS2pH6hKcMU9Wioob1?utm_source=generator" , "Good Artist", "https://en.wikipedia.org/wiki/Nas");

INSERT INTO
    artists (id, bio, name, file_ext, embedded_album_url, review_content, citation)
VALUES
    (9, "Deftones is an American alternative metal band formed in Sacramento, California in 1988. They were formed by Chino Moreno (vocals, guitar), Stephen Carpenter (guitar), Abe Cunningham (drums), and Dominic Garcia (bass). During their first five years, the band's lineup changed several times, but stabilized in 1993 when Cunningham rejoined after his departure in 1990; by this time, Chi Cheng was bassist. The lineup remained stable for fifteen years, with the exception of keyboardist and turntablist Frank Delgado being added in 1999. The band's experimental nature has led some critics to describe them as 'the Radiohead of metal'.[1][2]", "Deftones", "jpg", "https://open.spotify.com/embed/album/7o4UsmV37Sg5It2Eb7vHzu?utm_source=generator" , "Good Artist", "https://en.wikipedia.org/wiki/Deftones");

INSERT INTO
    artists (id, bio, name, file_ext, embedded_album_url, review_content, citation)
VALUES
    (10, "Her's were an indie rock band from Liverpool, England, composed of Stephen Fitzpatrick and Audun Laading. The band's debut full-length LP Invitation to Her's was released in August 2018, following the compilation LP Songs of Her's which had been released in May 2017. The duo were killed in the early hours of 27 March 2019 in a road traffic collision in Arizona, while on tour in the United States.", "Her's", "jpg", "https://open.spotify.com/embed/album/03gwRG5IvkStFnjPmgjElw?utm_source=generator", "Good Artist","https://en.wikipedia.org/wiki/Her's");

INSERT INTO
    artists (id, bio, name, file_ext, embedded_album_url, review_content, citation)
VALUES
    (11, "Francis Albert Sinatra (/sɪˈnɑːtrə/; December 12, 1915 – May 14, 1998) was an American singer and actor. Nicknamed the 'Chairman of the Board' and later called 'Ol' Blue Eyes', Sinatra was one of the most popular entertainers of the 1940s, 1950s, and 1960s. He is among the world's best-selling music artists with an estimated 150 million record sales.", "Frank Sinatra", "jpg", "https://open.spotify.com/embed/album/3IdNQBn7De23AVyv2V67wn?utm_source=generator", "Good Artist", "https://en.wikipedia.org/wiki/Frank_Sinatra");

INSERT INTO
    artists (id, bio, name, file_ext, embedded_album_url, review_content, citation)
VALUES
    (12, "Adele Laurie Blue Adkins MBE (/əˈdɛl/;[3] born 5 May 1988) is an English singer-songwriter. After graduating in arts from the BRIT School in 2006, Adele signed a record deal with XL Recordings. Her debut album, 19, was released in 2008 and spawned the UK top-five singles 'Chasing Pavements' and 'Make You Feel My Love'. 19 has sold over 2.5 million copies in the UK and was named in the top 20 best-selling debut albums of all time in the UK.[4][5] Adele was honoured with the Brit Award for Rising Star as well as the Grammy Award for Best New Artist.", "Adele", "jpg", "https://open.spotify.com/embed/album/0Lg1uZvI312TPqxNWShFXL?utm_source=generator", "Good Artist", "https://en.wikipedia.org/wiki/Adele");

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

INSERT INTO
    tags (id, title)
VALUES
    (2, "United Kingdom");


--Rating Tags

-- 3
INSERT INTO
    tags(id, title)
VALUES
    (3, "Rating: 1");

INSERT INTO
    tags(id, title)
VALUES
    (4, "Rating: 2");

INSERT INTO
    tags(id, title)
VALUES
    (5, "Rating: 3");

INSERT INTO
    tags(id, title)
VALUES
    (6, "Rating: 4");

INSERT INTO
    tags(id, title)
VALUES
    (7, "Rating: 5");


--Misc
INSERT INTO
    tags(id, title)
VALUES
    (8, "Before 2000");

-- Stores relationships between artists and tags
CREATE TABLE artist_tags (
    artist_id INTEGER NOT NULL,
    tag_id INTEGER NOT NULL,

    FOREIGN KEY (artist_id) REFERENCES artists(id),
    FOREIGN KEY (tag_id) REFERENCES tags(id)
);

--Taylor Swift 0 (Country, Rating)
INSERT INTO
    artist_tags (artist_id, tag_id)
VALUES
    (0, 0);

INSERT INTO
    artist_tags (artist_id, tag_id)
VALUES
     (0, 6);

--Drake 1
INSERT INTO
    artist_tags (artist_id, tag_id)
VALUES
    (1, 1);

INSERT INTO
    artist_tags (artist_id, tag_id)
VALUES
    (1, 5);

--Michael Jackson 2
INSERT INTO
    artist_tags (artist_id, tag_id)
VALUES
    (2, 0);

INSERT INTO
    artist_tags (artist_id, tag_id)
VALUES
    (2, 6);

--The Weeknd 3
INSERT INTO
    artist_tags (artist_id, tag_id)
VALUES
    (3, 1);

INSERT INTO
    artist_tags (artist_id, tag_id)
VALUES
    (3, 6);

--Beyonce 4
INSERT INTO
    artist_tags (artist_id, tag_id)
VALUES
    (4, 0);

INSERT INTO
    artist_tags (artist_id, tag_id)
VALUES
    (4, 6);

--Frank Ocean 5
INSERT INTO
    artist_tags (artist_id, tag_id)
VALUES
    (5, 0);

INSERT INTO
    artist_tags (artist_id, tag_id)
VALUES
    (5, 6);

--Nicki Minaj 6
INSERT INTO
    artist_tags (artist_id, tag_id)
VALUES
    (6, 0);

INSERT INTO
    artist_tags (artist_id, tag_id)
VALUES
    (6, 6);

--Tyler the Creator 7
INSERT INTO
    artist_tags (artist_id, tag_id)
VALUES
    (7, 0);

INSERT INTO
    artist_tags (artist_id, tag_id)
VALUES
    (7, 6);

--Nas 8
INSERT INTO
    artist_tags (artist_id, tag_id)
VALUES
    (8, 0);

INSERT INTO
    artist_tags (artist_id, tag_id)
VALUES
    (8, 6);

--Deftones 9
INSERT INTO
    artist_tags (artist_id, tag_id)
VALUES
    (9, 0);

INSERT INTO
    artist_tags (artist_id, tag_id)
VALUES
    (9, 6);

-- Her's 10
INSERT INTO
    artist_tags (artist_id, tag_id)
VALUES
    (10, 2);

INSERT INTO
    artist_tags (artist_id, tag_id)
VALUES
    (10, 6);

-- Frank Sinatra 11
INSERT INTO
    artist_tags (artist_id, tag_id)
VALUES
    (11, 0);

INSERT INTO
    artist_tags (artist_id, tag_id)
VALUES
    (11, 6);

-- Adele 12
INSERT INTO
    artist_tags (artist_id, tag_id)
VALUES
    (12, 7);

INSERT INTO
    artist_tags (artist_id, tag_id)
VALUES
    (12, 2);


--Before 2000 tags
INSERT INTO
    artist_tags (artist_id, tag_id)
VALUES
    (2, 8);

INSERT INTO
    artist_tags (artist_id, tag_id)
VALUES
    (8, 8);

INSERT INTO
    artist_tags (artist_id, tag_id)
VALUES
    (9, 8);

INSERT INTO
    artist_tags (artist_id, tag_id)
VALUES
    (11, 8);
