
BEGIN;

-----------------------------------------------------------------------
-- account
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "account" CASCADE;

CREATE TABLE "account"
(
    "account_pk" serial NOT NULL,
    "guid" VARCHAR,
    "name" VARCHAR,
    "email" VARCHAR,
    "password" VARCHAR,
    "address" VARCHAR,
    "zipcode" VARCHAR,
    "city" VARCHAR,
    "phone" VARCHAR,
    "removed" BOOLEAN DEFAULT 'f' NOT NULL,
    PRIMARY KEY ("account_pk"),
    CONSTRAINT "idx_account_email" UNIQUE ("email")
);

-----------------------------------------------------------------------
-- dossier
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "dossier" CASCADE;

CREATE TABLE "dossier"
(
    "dossier_pk" serial NOT NULL,
    "guid" VARCHAR,
    "creation_date" DATE DEFAULT CURRENT_DATE,
    "name" VARCHAR,
    "description" VARCHAR,
    "use_ocr" BOOLEAN DEFAULT 'f' NOT NULL,
    PRIMARY KEY ("dossier_pk")
);

-----------------------------------------------------------------------
-- account_dossier_mapping
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "account_dossier_mapping" CASCADE;

CREATE TABLE "account_dossier_mapping"
(
    "account_dossier_mapping_pk" serial NOT NULL,
    "account_fk" INTEGER NOT NULL,
    "dossier_fk" INTEGER NOT NULL,
    "is_admin" BOOLEAN DEFAULT 'f' NOT NULL,
    PRIMARY KEY ("account_dossier_mapping_pk")
);

-----------------------------------------------------------------------
-- store
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "store" CASCADE;

CREATE TABLE "store"
(
    "store_pk" serial NOT NULL,
    "store_chain_fk" INTEGER,
    "name" VARCHAR,
    "address" VARCHAR,
    "zip_code" VARCHAR,
    "city" VARCHAR,
    "phone" VARCHAR,
    "email" VARCHAR,
    PRIMARY KEY ("store_pk")
);

-----------------------------------------------------------------------
-- store_chain
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "store_chain" CASCADE;

CREATE TABLE "store_chain"
(
    "store_chain_pk" serial NOT NULL,
    "name" VARCHAR,
    "phone" VARCHAR,
    "website" VARCHAR,
    "email" VARCHAR,
    "img_url" VARCHAR,
    PRIMARY KEY ("store_chain_pk")
);

-----------------------------------------------------------------------
-- product
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "product" CASCADE;

CREATE TABLE "product"
(
    "product_pk" serial NOT NULL,
    "dossier_fk" INTEGER NOT NULL,
    "store_fk" INTEGER,
    "store_chain_fk" INTEGER,
    "creation_date" DATE DEFAULT CURRENT_DATE,
    "name" VARCHAR,
    "description" VARCHAR,
    "price" NUMERIC,
    "purchase_date" DATE,
    "due_date" DATE,
    PRIMARY KEY ("product_pk")
);

-----------------------------------------------------------------------
-- product_comment
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "product_comment" CASCADE;

CREATE TABLE "product_comment"
(
    "product_comment_pk" serial NOT NULL,
    "product_fk" INTEGER NOT NULL,
    "creation_date" TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    "comment" VARCHAR,
    PRIMARY KEY ("product_comment_pk")
);

-----------------------------------------------------------------------
-- ocr_task
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "ocr_task" CASCADE;

CREATE TABLE "ocr_task"
(
    "ocr_task_pk" serial NOT NULL,
    "product_fk" INTEGER NOT NULL,
    "ocr_task_status_fk" INTEGER DEFAULT 1 NOT NULL,
    "task_id" VARCHAR,
    "creation_time" TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    "start_time" TIMESTAMP,
    "start_counter" INTEGER,
    "source_file_path" VARCHAR,
    "parsed_text" VARCHAR,
    "status_message" VARCHAR,
    PRIMARY KEY ("ocr_task_pk")
);

-----------------------------------------------------------------------
-- ocr_task_status
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "ocr_task_status" CASCADE;

CREATE TABLE "ocr_task_status"
(
    "ocr_task_status_pk" INTEGER NOT NULL,
    "status_name" VARCHAR,
    PRIMARY KEY ("ocr_task_status_pk")
);

ALTER TABLE "account_dossier_mapping" ADD CONSTRAINT "account_dossier_mapping_fk_d9d75b"
    FOREIGN KEY ("account_fk")
    REFERENCES "account" ("account_pk")
    ON DELETE CASCADE;

ALTER TABLE "account_dossier_mapping" ADD CONSTRAINT "account_dossier_mapping_fk_634902"
    FOREIGN KEY ("dossier_fk")
    REFERENCES "dossier" ("dossier_pk")
    ON DELETE CASCADE;

ALTER TABLE "store" ADD CONSTRAINT "store_fk_401b7f"
    FOREIGN KEY ("store_chain_fk")
    REFERENCES "store_chain" ("store_chain_pk")
    ON DELETE CASCADE;

ALTER TABLE "product" ADD CONSTRAINT "product_fk_634902"
    FOREIGN KEY ("dossier_fk")
    REFERENCES "dossier" ("dossier_pk")
    ON DELETE CASCADE;

ALTER TABLE "product" ADD CONSTRAINT "product_fk_b4d065"
    FOREIGN KEY ("store_fk")
    REFERENCES "store" ("store_pk");

ALTER TABLE "product" ADD CONSTRAINT "product_fk_401b7f"
    FOREIGN KEY ("store_chain_fk")
    REFERENCES "store_chain" ("store_chain_pk");

ALTER TABLE "product_comment" ADD CONSTRAINT "product_comment_fk_c77578"
    FOREIGN KEY ("product_fk")
    REFERENCES "product" ("product_pk")
    ON DELETE CASCADE;

ALTER TABLE "ocr_task" ADD CONSTRAINT "ocr_task_fk_c77578"
    FOREIGN KEY ("product_fk")
    REFERENCES "product" ("product_pk")
    ON DELETE CASCADE;

ALTER TABLE "ocr_task" ADD CONSTRAINT "ocr_task_fk_9d5d82"
    FOREIGN KEY ("ocr_task_status_fk")
    REFERENCES "ocr_task_status" ("ocr_task_status_pk");

COMMIT;
