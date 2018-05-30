-- creating a db
CREATE DATABASE 'ISNetworkDB';
use ISNetworkDB;
-- creating tables etc
SET foreign_key_checks=0;
DELETE FROM users WHERE id <> 1;
DELETE FROM alerts WHERE 1;
DELETE FROM messages WHERE 1;
DELETE FROM projects WHERE 1;
DELETE FROM project_recomendations WHERE 1;
DELETE FROM researches WHERE 1;
DELETE FROM user_researches WHERE u_id <> 1;
DELETE FROM user_skills WHERE u_id <> 1;