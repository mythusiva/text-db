--
-- File generated with SQLiteStudio v3.0.7 on Sun Apr 3 11:39:55 2016
--
-- Text encoding used: UTF-8
--
PRAGMA foreign_keys = off;
BEGIN TRANSACTION;

-- Table: locale
DROP TABLE IF EXISTS locale;

CREATE TABLE locale (
    locale VARCHAR (16)  PRIMARY KEY
                         UNIQUE
                         NOT NULL,
    label  VARCHAR (255) NOT NULL
);

INSERT INTO locale (
                       locale,
                       label
                   )
                   VALUES (
                       'en-US',
                       'English (US)'
                   );


-- Table: catalogue
DROP TABLE IF EXISTS catalogue;

CREATE TABLE catalogue (
    catalogue_pk INTEGER       NOT NULL
                               PRIMARY KEY AUTOINCREMENT,
    name         VARCHAR (255) UNIQUE
                               NOT NULL,
    date_created TIMESTAMP     DEFAULT CURRENT_TIMESTAMP
                               NOT NULL
);


-- Table: context
DROP TABLE IF EXISTS context;

CREATE TABLE context (
    context_pk   INTEGER   NOT NULL
                           PRIMARY KEY AUTOINCREMENT,
    text         TEXT      NOT NULL,
    date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                           NOT NULL
);


-- Table: message
DROP TABLE IF EXISTS message;

CREATE TABLE message (
    message_pk    INTEGER       PRIMARY KEY AUTOINCREMENT
                                NOT NULL,
    identifier    VARCHAR (255) NOT NULL,
    text          TEXT          NOT NULL,
    catalogue_fk  INTEGER       NOT NULL
                                REFERENCES catalogue (catalogue_pk),
    locale        VARCHAR (16)  NOT NULL
                                REFERENCES locale (locale),
    date_created  TIMESTAMP     DEFAULT CURRENT_TIMESTAMP
                                NOT NULL,
    date_modified TIMESTAMP     DEFAULT CURRENT_TIMESTAMP
                                NOT NULL
);


-- Index: IDX_MESSAGE_
DROP INDEX IF EXISTS IDX_MESSAGE_;

CREATE UNIQUE INDEX IDX_MESSAGE_ ON message (
    catalogue_fk ASC,
    identifier ASC,
    locale ASC
);


-- Trigger: ON_TBL_MESSAGE_date_modified
DROP TRIGGER IF EXISTS ON_TBL_MESSAGE_date_modified;
CREATE TRIGGER ON_TBL_MESSAGE_date_modified
         AFTER UPDATE
            ON message
      FOR EACH ROW
BEGIN
    UPDATE message
       SET date_modified = NOW() 
     WHERE message_pk = old.message_pk;
END;


COMMIT TRANSACTION;
PRAGMA foreign_keys = on;
