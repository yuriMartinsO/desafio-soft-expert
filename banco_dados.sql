PGDMP     ;    8                z         
   softexpert    13.8    13.8     ?           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            ?           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            ?           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            ?           1262    16563 
   softexpert    DATABASE     j   CREATE DATABASE softexpert WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'Portuguese_Brazil.1252';
    DROP DATABASE softexpert;
                postgres    false            ?            1259    16564    order_products    TABLE     e  CREATE TABLE public.order_products (
    product_id integer NOT NULL,
    type_id integer NOT NULL,
    product_total numeric DEFAULT 0 NOT NULL,
    tax_total numeric DEFAULT 0 NOT NULL,
    quantity integer DEFAULT 0 NOT NULL,
    total numeric DEFAULT 0 NOT NULL,
    updated_at date,
    created_at date,
    "order" integer,
    id integer NOT NULL
);
 "   DROP TABLE public.order_products;
       public         heap    postgres    false            ?            1259    16574    order_products_id_seq    SEQUENCE     ?   ALTER TABLE public.order_products ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.order_products_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    200            ?            1259    16576    orders    TABLE     ?   CREATE TABLE public.orders (
    id integer NOT NULL,
    total_tax numeric,
    total_product numeric,
    total numeric,
    updated_at date,
    created_at date
);
    DROP TABLE public.orders;
       public         heap    postgres    false            ?            1259    16582    orders_id_seq    SEQUENCE     ?   ALTER TABLE public.orders ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.orders_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    202            ?            1259    16584    products    TABLE     ?   CREATE TABLE public.products (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    type_id integer NOT NULL,
    price numeric,
    updated_at timestamp with time zone,
    created_at date
);
    DROP TABLE public.products;
       public         heap    postgres    false            ?            1259    16590    products_id_seq    SEQUENCE     ?   CREATE SEQUENCE public.products_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.products_id_seq;
       public          postgres    false    204            ?           0    0    products_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.products_id_seq OWNED BY public.products.id;
          public          postgres    false    205            ?            1259    16592    types    TABLE     ?   CREATE TABLE public.types (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    tax_value numeric(10,3),
    updated_at timestamp with time zone,
    created_at date
);
    DROP TABLE public.types;
       public         heap    postgres    false            ?            1259    16595    types_id_seq    SEQUENCE     ?   CREATE SEQUENCE public.types_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.types_id_seq;
       public          postgres    false    206            ?           0    0    types_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.types_id_seq OWNED BY public.types.id;
          public          postgres    false    207            ;           2604    16630    products id    DEFAULT     j   ALTER TABLE ONLY public.products ALTER COLUMN id SET DEFAULT nextval('public.products_id_seq'::regclass);
 :   ALTER TABLE public.products ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    205    204            <           2604    16631    types id    DEFAULT     d   ALTER TABLE ONLY public.types ALTER COLUMN id SET DEFAULT nextval('public.types_id_seq'::regclass);
 7   ALTER TABLE public.types ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    207    206            ?          0    16564    order_products 
   TABLE DATA           ?   COPY public.order_products (product_id, type_id, product_total, tax_total, quantity, total, updated_at, created_at, "order", id) FROM stdin;
    public          postgres    false    200   ?"       ?          0    16576    orders 
   TABLE DATA           ]   COPY public.orders (id, total_tax, total_product, total, updated_at, created_at) FROM stdin;
    public          postgres    false    202   ?"       ?          0    16584    products 
   TABLE DATA           T   COPY public.products (id, name, type_id, price, updated_at, created_at) FROM stdin;
    public          postgres    false    204   ?"       ?          0    16592    types 
   TABLE DATA           L   COPY public.types (id, name, tax_value, updated_at, created_at) FROM stdin;
    public          postgres    false    206   #       ?           0    0    order_products_id_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.order_products_id_seq', 6, true);
          public          postgres    false    201            ?           0    0    orders_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.orders_id_seq', 24, true);
          public          postgres    false    203            ?           0    0    products_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.products_id_seq', 2, true);
          public          postgres    false    205            ?           0    0    types_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.types_id_seq', 17, true);
          public          postgres    false    207            @           2606    16600 	   orders id 
   CONSTRAINT     G   ALTER TABLE ONLY public.orders
    ADD CONSTRAINT id PRIMARY KEY (id);
 3   ALTER TABLE ONLY public.orders DROP CONSTRAINT id;
       public            postgres    false    202            >           2606    16602 "   order_products order_products_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.order_products
    ADD CONSTRAINT order_products_pkey PRIMARY KEY (id);
 L   ALTER TABLE ONLY public.order_products DROP CONSTRAINT order_products_pkey;
       public            postgres    false    200            B           2606    16604    products products_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.products DROP CONSTRAINT products_pkey;
       public            postgres    false    204            D           2606    16606    types types_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.types
    ADD CONSTRAINT types_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.types DROP CONSTRAINT types_pkey;
       public            postgres    false    206            E           2606    16607    order_products product_id    FK CONSTRAINT     ~   ALTER TABLE ONLY public.order_products
    ADD CONSTRAINT product_id FOREIGN KEY (product_id) REFERENCES public.products(id);
 C   ALTER TABLE ONLY public.order_products DROP CONSTRAINT product_id;
       public          postgres    false    200    2882    204            G           2606    16612    products products_type_id_fkey    FK CONSTRAINT     }   ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_type_id_fkey FOREIGN KEY (type_id) REFERENCES public.types(id);
 H   ALTER TABLE ONLY public.products DROP CONSTRAINT products_type_id_fkey;
       public          postgres    false    204    2884    206            F           2606    16617    order_products type_id    FK CONSTRAINT     u   ALTER TABLE ONLY public.order_products
    ADD CONSTRAINT type_id FOREIGN KEY (type_id) REFERENCES public.types(id);
 @   ALTER TABLE ONLY public.order_products DROP CONSTRAINT type_id;
       public          postgres    false    200    2884    206            ?      x?????? ? ?      ?      x?????? ? ?      ?      x?????? ? ?      ?      x?????? ? ?     