/*
After you create your database, you must run the following
SQL statements to create the tables.
 */

CREATE TABLE [catalogue] (
[catalogue_pk] INTEGER  NOT NULL PRIMARY KEY AUTOINCREMENT,
[name] VARCHAR(255)  UNIQUE NOT NULL,
[date_created] TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL
);

CREATE TABLE [context] (
[context_pk] INTEGER  NOT NULL PRIMARY KEY AUTOINCREMENT,
[text] TEXT  NOT NULL,
[date_created] TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL
);

CREATE TABLE [message] (
[message_pk] INTEGER  PRIMARY KEY AUTOINCREMENT NOT NULL,
[identifier] VARCHAR(255)  NOT NULL,
[text] TEXT  NOT NULL,
[catalogue_fk] INTEGER  NOT NULL,
[locale] VARCHAR(16)  NOT NULL,
[date_created] TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
[date_modified] TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL
);

CREATE UNIQUE INDEX [IDX_MESSAGE_] ON [message](
[catalogue_fk]  ASC,
[identifier]  ASC,
[locale]  ASC
);

CREATE TRIGGER [ON_TBL_MESSAGE_date_modified] 
AFTER UPDATE ON [message] 
FOR EACH ROW 
BEGIN 

UPDATE message SET date_modified = NOW() WHERE message_pk = old.message_pk;

END;
