-- SQLite 3 dump

DROP TABLE IF EXISTS "catalogue";
CREATE TABLE catalogue (name VARCHAR (255) UNIQUE NOT NULL PRIMARY KEY, date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL);


DROP TABLE IF EXISTS "language_code";
CREATE TABLE language_code (language_code VARCHAR (16) PRIMARY KEY UNIQUE NOT NULL);


DROP TABLE IF EXISTS "message";
CREATE TABLE "message" (
  "message_pk" integer NOT NULL PRIMARY KEY AUTOINCREMENT,
  "identifier" text NOT NULL,
  "text" text NOT NULL,
  "catalogue_name" text NOT NULL,
  "locale" text NOT NULL,
  "is_plural_form" integer NOT NULL DEFAULT '0',
  "date_created" numeric NOT NULL DEFAULT 'CURRENT_TIMESTAMP',
  "date_modified" numeric NOT NULL DEFAULT 'CURRENT_TIMESTAMP',
  FOREIGN KEY ("locale") REFERENCES "language_code" ("language_code") ON DELETE NO ACTION ON UPDATE NO ACTION,
  FOREIGN KEY ("catalogue_name") REFERENCES "catalogue" ("name") ON DELETE NO ACTION ON UPDATE NO ACTION
);


DELIMITER ;;
CREATE TRIGGER "message_ai" AFTER  INSERT ON "message"
BEGIN
  UPDATE message SET date_modified=CURRENT_TIMESTAMP WHERE message_pk=NEW.message_pk;
END;;

DELIMITER ;


-- 
