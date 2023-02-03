CREATE DATABASE testdb;

CREATE TABLE cities
(
    id   BIGSERIAL,
    name TEXT
);

INSERT INTO cities (name)
VALUES ('San Francisco'),
       ('New York'),
       ('York'),
       ('Warsaw'),
       ('Boston');
