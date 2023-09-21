/*
Created: 21/09/2023
Modified: 21/09/2023
Model: PostgreSQL 10
Database: PostgreSQL 10
*/


-- Create tables section -------------------------------------------------

-- Table drzave

CREATE TABLE "drzave"(
 "id_d" Serial NOT NULL,
 "ime" Character varying(60) NOT NULL,
 "kratica" Character varying(10) NOT NULL
)
WITH (
 autovacuum_enabled=true)
;

-- Add keys for table drzave

ALTER TABLE "drzave" ADD CONSTRAINT "PK_drzave" PRIMARY KEY ("id_d")
;

-- Table kraji

CREATE TABLE "kraji"(
 "id_k" Serial NOT NULL,
 "ime" Character varying(60) NOT NULL,
 "postna_st" Integer NOT NULL,
 "drzava_id" Integer NOT NULL
)
WITH (
 autovacuum_enabled=true)
;

-- Create indexes for table kraji

CREATE INDEX "IX_Relationship1" ON "kraji" ("drzava_id")
;

-- Add keys for table kraji

ALTER TABLE "kraji" ADD CONSTRAINT "PK_kraji" PRIMARY KEY ("id_k")
;

-- Table lokacije

CREATE TABLE "lokacije"(
 "id_l" Serial NOT NULL,
 "ime" Character varying(60) NOT NULL,
 "naslov" Character varying(50) NOT NULL,
 "kraj_id" Integer NOT NULL
)
WITH (
 autovacuum_enabled=true)
;

-- Create indexes for table lokacije

CREATE INDEX "IX_Relationship2" ON "lokacije" ("kraj_id")
;

-- Add keys for table lokacije

ALTER TABLE "lokacije" ADD CONSTRAINT "PK_lokacije" PRIMARY KEY ("id_l")
;

-- Table admini

CREATE TABLE "admini"(
 "id_a" Serial NOT NULL,
 "ime" Character varying(40) NOT NULL,
 "priimek" Character varying(50) NOT NULL,
 "geslo" Character varying(350) NOT NULL,
 "email" Character varying(200) NOT NULL
)
WITH (
 autovacuum_enabled=true)
;

-- Add keys for table admini

ALTER TABLE "admini" ADD CONSTRAINT "PK_admini" PRIMARY KEY ("id_a")
;

-- Table dogodki

CREATE TABLE "dogodki"(
 "id_do" Serial NOT NULL,
 "ime" Character varying(40) NOT NULL,
 "lokacija_id" Integer NOT NULL,
 "opis" Text,
 "cena_vstopnic" Real NOT NULL,
 "limit_vstopnic" Integer NOT NULL,
 "datum" Timestamp NOT NULL,
 "admin_id" Integer NOT NULL
)
WITH (
 autovacuum_enabled=true)
;

-- Create indexes for table dogodki

CREATE INDEX "IX_Relationship3" ON "dogodki" ("lokacija_id")
;

CREATE INDEX "IX_Relationship7" ON "dogodki" ("admin_id")
;

-- Add keys for table dogodki

ALTER TABLE "dogodki" ADD CONSTRAINT "PK_dogodki" PRIMARY KEY ("id_do")
;

-- Table vstopnice

CREATE TABLE "vstopnice"(
 "id_v" Serial NOT NULL,
 "koda" Integer NOT NULL,
 "dogodek_id" Integer NOT NULL,
 "email" Character varying(200) NOT NULL
)
WITH (
 autovacuum_enabled=true)
;

-- Create indexes for table vstopnice

CREATE INDEX "IX_Relationship5" ON "vstopnice" ("dogodek_id")
;

-- Add keys for table vstopnice

ALTER TABLE "vstopnice" ADD CONSTRAINT "PK_vstopnice" PRIMARY KEY ("id_v")
;

ALTER TABLE "vstopnice" ADD CONSTRAINT "koda" UNIQUE ("koda")
;

-- Table slike

CREATE TABLE "slike"(
 "id_s" Serial NOT NULL,
 "url" Character varying(500) NOT NULL,
 "opis" Text,
 "dat_objave" Timestamp NOT NULL,
 "dogodek_id" Integer NOT NULL,
 "is_arhivirano" Integer NOT NULL
)
WITH (
 autovacuum_enabled=true)
;

-- Create indexes for table slike

CREATE INDEX "IX_Relationship6" ON "slike" ("dogodek_id")
;

-- Add keys for table slike

ALTER TABLE "slike" ADD CONSTRAINT "PK_slike" PRIMARY KEY ("id_s")
;
-- Create foreign keys (relationships) section ------------------------------------------------- 

ALTER TABLE "kraji" ADD CONSTRAINT "Relationship1" FOREIGN KEY ("drzava_id") REFERENCES "drzave" ("id_d") ON DELETE NO ACTION ON UPDATE NO ACTION
;

ALTER TABLE "lokacije" ADD CONSTRAINT "Relationship2" FOREIGN KEY ("kraj_id") REFERENCES "kraji" ("id_k") ON DELETE NO ACTION ON UPDATE NO ACTION
;

ALTER TABLE "dogodki" ADD CONSTRAINT "Relationship3" FOREIGN KEY ("lokacija_id") REFERENCES "lokacije" ("id_l") ON DELETE NO ACTION ON UPDATE NO ACTION
;

ALTER TABLE "vstopnice" ADD CONSTRAINT "Relationship5" FOREIGN KEY ("dogodek_id") REFERENCES "dogodki" ("id_do") ON DELETE NO ACTION ON UPDATE NO ACTION
;

ALTER TABLE "slike" ADD CONSTRAINT "Relationship6" FOREIGN KEY ("dogodek_id") REFERENCES "dogodki" ("id_do") ON DELETE NO ACTION ON UPDATE NO ACTION
;

ALTER TABLE "dogodki" ADD CONSTRAINT "Relationship7" FOREIGN KEY ("admin_id") REFERENCES "admini" ("id_a") ON DELETE NO ACTION ON UPDATE NO ACTION
;




