/*
After you create your database, you must run the following
SQL statements to create the tables.
 */

CREATE TABLE [catalogue] (
[catalogue_pk] INTEGER  NOT NULL PRIMARY KEY AUTOINCREMENT,
[name] VARCHAR(255)  UNIQUE NOT NULL,
[date_created] TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL
);

CREATE TABLE [catalogue_message] (
[catalogue_fk] INTEGER  NOT NULL,
[message_fk] INTEGER  NOT NULL,
PRIMARY KEY ([catalogue_fk],[message_fk])
);

CREATE TABLE [context] (
[context_pk] INTEGER  NOT NULL PRIMARY KEY AUTOINCREMENT,
[text] TEXT  NOT NULL,
[date_created] TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL
);

CREATE TABLE [message] (
[message_pk] INTEGER  NOT NULL PRIMARY KEY AUTOINCREMENT,
[identifier] VARCHAR(255)  NOT NULL,
[text] TEXT  NOT NULL,
[date_created] TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
[date_modified] TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL
);

CREATE UNIQUE INDEX [IDX_CATALOGUE_MESSAGE_] ON [catalogue_message](
[catalogue_fk]  ASC,
[message_fk]  ASC
);
