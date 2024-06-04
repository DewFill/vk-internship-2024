create table cities
(
    id   int unsigned auto_increment
        primary key,
    name varchar(255) not null
);

create table s3_objects
(
    id          int unsigned auto_increment
        primary key,
    file_name   varchar(255)                           not null,
    mime_type   varchar(50) collate utf8mb4_general_ci not null,
    file_size   bigint                                 not null,
    upload_date timestamp                              not null
);

create table `groups`
(
    id       int unsigned auto_increment
        primary key,
    image_id int unsigned not null,
    name    varchar(255) not null,
    constraint groups_ibfk_1
        foreign key (image_id) references s3_objects (id)
);

create table categories
(
    id       int unsigned auto_increment
        primary key,
    group_id int unsigned not null,
    image_id int unsigned not null,
    name     varchar(255) not null,
    constraint categories_ibfk_1
        foreign key (group_id) references `groups` (id),
    constraint categories_ibfk_2
        foreign key (image_id) references s3_objects (id)
);

create index group_id
    on categories (group_id);

create index image_id
    on categories (image_id);

create index image_id
    on `groups` (image_id);

create table subcategories
(
    id          int unsigned auto_increment
        primary key,
    category_id int unsigned not null,
    image_id    int unsigned not null,
    name        varchar(255) not null,
    constraint subcategories_ibfk_1
        foreign key (category_id) references categories (id),
    constraint subcategories_ibfk_2
        foreign key (image_id) references s3_objects (id)
);

create table products
(
    id             int unsigned auto_increment
        primary key,
    total_quantity int unsigned not null,
    archived       tinyint(1)   not null,
    subcategory_id int unsigned not null,
    constraint products_ibfk_1
        foreign key (subcategory_id) references subcategories (id)
);

create table prices_by_city
(
    id         int unsigned auto_increment
        primary key,
    product_id int unsigned   not null,
    city_id    int unsigned   not null,
    price      decimal(10, 2) not null,
    constraint product_id_city_id_unique
        unique (product_id, city_id),
    constraint prices_by_city_ibfk_1
        foreign key (product_id) references products (id),
    constraint prices_by_city_ibfk_2
        foreign key (city_id) references cities (id)
);

create index city_id
    on prices_by_city (city_id);

create table product_versions
(
    id         int unsigned auto_increment
        primary key,
    product_id int unsigned            not null,
    image_id   int unsigned            not null,
    name       varchar(255)            not null,
    price      decimal(10, 2) unsigned not null,
    constraint product_versions_ibfk_1
        foreign key (image_id) references s3_objects (id),
    constraint product_versions_ibfk_2
        foreign key (product_id) references products (id)
);

create table product_attributes
(
    id                 int unsigned auto_increment
        primary key,
    product_version_id int unsigned not null,
    name               varchar(255) not null,
    value              varchar(255) not null,
    constraint product_attributes_ibfk_1
        foreign key (product_version_id) references product_versions (id)
);

create fulltext index name
    on product_attributes (name, value);

create index product_id
    on product_attributes (product_version_id);

create index image_id
    on product_versions (image_id);

create fulltext index name
    on product_versions (name);

create index product_id
    on product_versions (product_id);

create index subcategory_id
    on products (subcategory_id);

create index category_id
    on subcategories (category_id);

create index image_id
    on subcategories (image_id);

create table users
(
    id            int unsigned auto_increment
        primary key,
    full_name     varchar(255)         not null,
    role          tinyint unsigned     not null,
    email         varchar(255)         not null,
    password      varchar(60)          not null,
    last_login    timestamp            null,
    force_logout  tinyint(1) default 0 not null,
    verified      tinyint(1)           not null,
    registered_at timestamp            not null
);

create table carts
(
    id         int unsigned auto_increment
        primary key,
    user_id    int unsigned not null,
    product_id int unsigned not null,
    quantity   int unsigned not null,
    constraint carts_ibfk_1
        foreign key (product_id) references products (id),
    constraint carts_ibfk_2
        foreign key (user_id) references users (id)
);

create index product_id
    on carts (product_id);

create index user_id
    on carts (user_id);

create table sales
(
    id                    int unsigned auto_increment
        primary key,
    customer_id           int unsigned            not null,
    total_quantity        int unsigned            not null,
    total_price           decimal(10, 2) unsigned not null,
    payment_method        varchar(255)            not null,
    total_delivery_status int                     not null,
    constraint sales_ibfk_1
        foreign key (customer_id) references users (id)
);

create index customer_id
    on sales (customer_id);

create table users_remembered
(
    id         int unsigned auto_increment
        primary key,
    user_id    int unsigned not null,
    selector   varchar(24)  not null,
    token      varchar(255) not null,
    expires_at timestamp    not null,
    constraint selector
        unique (selector),
    constraint users_remembered_ibfk_1
        foreign key (user_id) references users (id)
);

create index user_id
    on users_remembered (user_id);

create table users_throttling
(
    bucket         varchar(44) collate latin1_general_ci not null
        primary key,
    tokens         float                                 not null,
    replenished_at timestamp                             not null,
    expires_at     timestamp                             not null
);

create index expires_at
    on users_throttling (expires_at);

create table warehouses
(
    id       int unsigned auto_increment
        primary key,
    city_id  int unsigned not null,
    name     varchar(255) not null,
    location point        not null,
    constraint warehouses_ibfk_1
        foreign key (city_id) references cities (id)
);

create table sales_products
(
    id              int unsigned auto_increment
        primary key,
    sale_id         int unsigned            not null,
    product_id      int unsigned            not null,
    warehouse_id    int unsigned            not null,
    quantity        int unsigned            not null,
    unit_price      decimal(10, 2) unsigned not null,
    total_price     decimal(10, 2) unsigned not null,
    seller_id       int unsigned            not null,
    delivery_status int                     not null,
    constraint sales_products_ibfk_1
        foreign key (sale_id) references sales (id),
    constraint sales_products_ibfk_2
        foreign key (product_id) references products (id),
    constraint sales_products_ibfk_3
        foreign key (seller_id) references users (id),
    constraint sales_products_ibfk_4
        foreign key (warehouse_id) references warehouses (id)
);

create index product_id
    on sales_products (product_id);

create index sale_id
    on sales_products (sale_id);

create index seller_id
    on sales_products (seller_id);

create index warehouse_id
    on sales_products (warehouse_id);

create table stock
(
    id           int unsigned auto_increment
        primary key,
    product_id   int unsigned not null,
    warehouse_id int unsigned not null,
    quantity     int unsigned not null,
    constraint stock_ibfk_1
        foreign key (product_id) references products (id),
    constraint stock_ibfk_2
        foreign key (warehouse_id) references warehouses (id)
);

create index product_id
    on stock (product_id);

create index warehouse_id
    on stock (warehouse_id);

create index city_id
    on warehouses (city_id);

create definer = root@`%` view `1` as
select `database`.`product_versions`.`id` AS `id`,
       group_concat(concat_ws(' ', `database`.`product_attributes`.`name`, `database`.`product_attributes`.`value`)
                    separator ', ')       AS `combined_values`
from (`database`.`product_versions` join `database`.`product_attributes`
      on ((`database`.`product_versions`.`id` = `database`.`product_attributes`.`product_version_id`)))
group by `database`.`product_versions`.`id`;

