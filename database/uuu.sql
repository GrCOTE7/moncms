PRAGMA foreign_keys = off;
BEGIN TRANSACTION;
-- Tableau : categories
CREATE TABLE "categories" (
    "id" integer primary key autoincrement not null,
    "title" varchar not null,
    "slug" varchar not null,
    "created_at" datetime,
    "updated_at" datetime
);
-- Tableau : posts
CREATE TABLE "posts" (
    "id" integer primary key autoincrement not null,
    "title" varchar not null,
    "slug" varchar not null,
    "body" text not null,
    "active" tinyint(1) not null default '0',
    "image" varchar,
    "seo_title" varchar not null,
    "meta_description" text not null,
    "meta_keywords" text not null,
    "pinned" tinyint(1) not null default '0',
    "created_at" datetime,
    "updated_at" datetime,
    "user_id" integer not null,
    "category_id" integer not null,
    foreign key("user_id") references "users"("id") on delete cascade on update cascade,
    foreign key("category_id") references "categories"("id") on delete cascade on update cascade
);
-- Tableau : users
CREATE TABLE "users" (
    "id" integer primary key autoincrement not null,
    "name" varchar not null,
    "email" varchar not null,
    "password" varchar not null,
    "role" varchar check ("role" in ('user', 'redac', 'admin')) not null default 'user',
    "valid" tinyint(1) not null default '0',
    "remember_token" varchar,
    "created_at" datetime,
    "updated_at" datetime
);
INSERT INTO users (
        id,
        name,
        email,
        password,
        role,
        valid,
        remember_token,
        created_at,
        updated_at
    )
VALUES (
        1,
        'Test User',
        'test@example.com',
        '$2y$12$.P/u3W224gF48hR1.jYzjOa28EtqdyuBkPNRbiva7ZCQzoLfadtMq',
        'user',
        1,
        'vHul5CoRN9',
        '2024-09-04 16:30:32',
        '2024-09-04 16:30:32'
    );
-- Index : users_email_unique
CREATE UNIQUE INDEX "users_email_unique" on "users" ("email");
COMMIT TRANSACTION;
PRAGMA foreign_keys = on;
