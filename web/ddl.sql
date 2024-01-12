CREATE TABLE "session" (
    id char(128) NOT NULL PRIMARY KEY,
    expire int(11),
    "data" BYTEA
);
CREATE TABLE "cache" (
    id char(128) NOT NULL PRIMARY KEY,
    expire int(11),
    "data" BYTEA
);
CREATE TABLE master_akses_unit (
	id_akses_unit bigserial NOT NULL,
	is_active int2 not null default 1,
	created_by int4 not NULL,
	created_at timestamp not NULL,
	updated_by int4 NULL,
	updated_at timestamp NULL,
	is_deleted int2 not null default 0,
	deleted_by int4 NULL,
	deleted_at timestamp NULL,
	id_user int4 NOT NULL,
	id_unit int4 NOT NULL,
	CONSTRAINT master_akses_unit_pk PRIMARY KEY (id_akses_unit)
);