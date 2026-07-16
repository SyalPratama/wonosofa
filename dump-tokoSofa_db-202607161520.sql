--
-- PostgreSQL database dump
--

\restrict bsaaBjtzpxXQmfiidTswz7gtyObJO3CkrhEia5enaq0eue9lRvysqiPe9Vmb9ti

-- Dumped from database version 15.15 (Debian 15.15-1.pgdg13+1)
-- Dumped by pg_dump version 17.9

-- Started on 2026-07-16 15:20:20

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 219 (class 1259 OID 16605)
-- Name: cache; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.cache (
    key character varying(255) NOT NULL,
    value text NOT NULL,
    expiration integer NOT NULL
);


--
-- TOC entry 220 (class 1259 OID 16612)
-- Name: cache_locks; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.cache_locks (
    key character varying(255) NOT NULL,
    owner character varying(255) NOT NULL,
    expiration integer NOT NULL
);


--
-- TOC entry 228 (class 1259 OID 16674)
-- Name: colors; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.colors (
    id uuid NOT NULL,
    name character varying(255) NOT NULL,
    hex_code character varying(7),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- TOC entry 225 (class 1259 OID 16637)
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


--
-- TOC entry 224 (class 1259 OID 16636)
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3550 (class 0 OID 0)
-- Dependencies: 224
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- TOC entry 223 (class 1259 OID 16629)
-- Name: job_batches; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.job_batches (
    id character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    total_jobs integer NOT NULL,
    pending_jobs integer NOT NULL,
    failed_jobs integer NOT NULL,
    failed_job_ids text NOT NULL,
    options text,
    cancelled_at integer,
    created_at integer NOT NULL,
    finished_at integer
);


--
-- TOC entry 222 (class 1259 OID 16620)
-- Name: jobs; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.jobs (
    id bigint NOT NULL,
    queue character varying(255) NOT NULL,
    payload text NOT NULL,
    attempts smallint NOT NULL,
    reserved_at integer,
    available_at integer NOT NULL,
    created_at integer NOT NULL
);


--
-- TOC entry 221 (class 1259 OID 16619)
-- Name: jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3551 (class 0 OID 0)
-- Dependencies: 221
-- Name: jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.jobs_id_seq OWNED BY public.jobs.id;


--
-- TOC entry 215 (class 1259 OID 16574)
-- Name: migrations; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


--
-- TOC entry 214 (class 1259 OID 16573)
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3552 (class 0 OID 0)
-- Dependencies: 214
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- TOC entry 217 (class 1259 OID 16589)
-- Name: password_reset_tokens; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


--
-- TOC entry 229 (class 1259 OID 16681)
-- Name: product_color; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.product_color (
    id uuid NOT NULL,
    product_id uuid NOT NULL,
    color_id uuid NOT NULL,
    stock integer DEFAULT 0 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- TOC entry 230 (class 1259 OID 16699)
-- Name: product_dimensions; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.product_dimensions (
    id uuid NOT NULL,
    product_id uuid NOT NULL,
    general_dimensions character varying(255),
    seat_height character varying(255),
    seat_depth character varying(255),
    arm_height character varying(255),
    total_weight_lbs numeric(8,2),
    box_dimensions character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- TOC entry 227 (class 1259 OID 16661)
-- Name: product_photos; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.product_photos (
    id uuid NOT NULL,
    product_id uuid NOT NULL,
    file_name character varying(255) NOT NULL,
    is_primary boolean DEFAULT false NOT NULL,
    sort_order integer DEFAULT 0 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- TOC entry 231 (class 1259 OID 16713)
-- Name: product_shipping_and_return; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.product_shipping_and_return (
    id uuid NOT NULL,
    product_id uuid NOT NULL,
    shipping_info text,
    return_policy text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- TOC entry 226 (class 1259 OID 16648)
-- Name: products; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.products (
    id uuid NOT NULL,
    name character varying(255) NOT NULL,
    slug character varying(255) NOT NULL,
    sku character varying(255),
    description text,
    material character varying(255),
    price numeric(12,2) NOT NULL,
    stock integer DEFAULT 0 NOT NULL,
    is_active boolean DEFAULT true NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- TOC entry 218 (class 1259 OID 16596)
-- Name: sessions; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id uuid,
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);


--
-- TOC entry 216 (class 1259 OID 16580)
-- Name: users; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.users (
    id uuid NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- TOC entry 3323 (class 2604 OID 16640)
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- TOC entry 3322 (class 2604 OID 16623)
-- Name: jobs id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.jobs ALTER COLUMN id SET DEFAULT nextval('public.jobs_id_seq'::regclass);


--
-- TOC entry 3321 (class 2604 OID 16577)
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- TOC entry 3532 (class 0 OID 16605)
-- Dependencies: 219
-- Data for Name: cache; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.cache (key, value, expiration) FROM stdin;
\.


--
-- TOC entry 3533 (class 0 OID 16612)
-- Dependencies: 220
-- Data for Name: cache_locks; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.cache_locks (key, owner, expiration) FROM stdin;
\.


--
-- TOC entry 3541 (class 0 OID 16674)
-- Dependencies: 228
-- Data for Name: colors; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.colors (id, name, hex_code, created_at, updated_at) FROM stdin;
a243280a-124a-48fb-bad7-a666db9b5ed6	White	#f4f1ea	2026-07-15 05:26:22	2026-07-15 05:26:22
a243280a-7b54-4642-8b13-45832e6b69db	Camel	#c19a6b	2026-07-15 05:26:22	2026-07-15 05:26:22
a243280a-7e5e-4a52-9411-f788c35c640d	Navy	#1f2a44	2026-07-15 05:26:22	2026-07-15 05:26:22
a243280a-81af-4fda-8b7e-8fd32fd66800	Oatmel	#ddd3c0	2026-07-15 05:26:22	2026-07-15 05:26:22
a2432cab-a181-4d67-a8c2-b9da15951a18	Rush	#7a3b1b	2026-07-15 05:39:19	2026-07-15 05:39:19
a2432cab-c0c4-4e39-87f5-42579cc6ea8d	Almon	#d9c8af	2026-07-15 05:39:19	2026-07-15 05:39:19
a2454c41-c284-4aa6-8814-e4afdc88cac8	Olive	#556b2f	2026-07-16 06:59:18	2026-07-16 06:59:18
a24565c0-beed-475e-9c2d-2a2475481e8f	Onyx	#353839	2026-07-16 08:10:35	2026-07-16 08:10:35
a245686a-eef4-4918-ac91-d325ce0c080b	Sand	#c2b280	2026-07-16 08:18:02	2026-07-16 08:18:02
\.


--
-- TOC entry 3538 (class 0 OID 16637)
-- Dependencies: 225
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- TOC entry 3536 (class 0 OID 16629)
-- Dependencies: 223
-- Data for Name: job_batches; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.job_batches (id, name, total_jobs, pending_jobs, failed_jobs, failed_job_ids, options, cancelled_at, created_at, finished_at) FROM stdin;
\.


--
-- TOC entry 3535 (class 0 OID 16620)
-- Dependencies: 222
-- Data for Name: jobs; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.jobs (id, queue, payload, attempts, reserved_at, available_at, created_at) FROM stdin;
\.


--
-- TOC entry 3528 (class 0 OID 16574)
-- Dependencies: 215
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	0001_01_01_000000_create_users_table	1
2	0001_01_01_000001_create_cache_table	1
3	0001_01_01_000002_create_jobs_table	1
4	2026_07_14_095051_create_products_table	1
5	2026_07_14_095213_create_product_photos_table	1
6	2026_07_15_045852_create_colors_table	1
7	2026_07_15_050032_create_product_color_table	1
8	2026_07_15_051022_create_product_dimensions_table	1
9	2026_07_15_051047_create_product_shipping_and_return_table	1
\.


--
-- TOC entry 3530 (class 0 OID 16589)
-- Dependencies: 217
-- Data for Name: password_reset_tokens; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
\.


--
-- TOC entry 3542 (class 0 OID 16681)
-- Dependencies: 229
-- Data for Name: product_color; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.product_color (id, product_id, color_id, stock, created_at, updated_at) FROM stdin;
07674449-fd7d-4078-ad9d-b037c988d835	a2432809-bb0f-40f3-a830-4233c23fd48c	a243280a-124a-48fb-bad7-a666db9b5ed6	2	2026-07-15 05:26:22	2026-07-15 05:26:22
66eb301a-a42a-4065-b91f-386faadd3d5b	a2432809-bb0f-40f3-a830-4233c23fd48c	a243280a-7b54-4642-8b13-45832e6b69db	2	2026-07-15 05:26:22	2026-07-15 05:26:22
2edaf288-8e76-4047-87af-9d28df6ada3d	a2432809-bb0f-40f3-a830-4233c23fd48c	a243280a-7e5e-4a52-9411-f788c35c640d	2	2026-07-15 05:26:22	2026-07-15 05:26:22
9e872cae-181a-4005-9713-8621baee4b4f	a2432809-bb0f-40f3-a830-4233c23fd48c	a243280a-81af-4fda-8b7e-8fd32fd66800	2	2026-07-15 05:26:22	2026-07-15 05:26:22
a34081e9-2051-4b9e-a3bd-068ba150ee8c	a2432cab-5f7e-4ad3-a88b-440440ad08a7	a243280a-124a-48fb-bad7-a666db9b5ed6	0	2026-07-15 05:39:19	2026-07-15 05:39:52
286c765d-438f-412a-9270-ebe1c55a30ae	a2432cab-5f7e-4ad3-a88b-440440ad08a7	a2432cab-a181-4d67-a8c2-b9da15951a18	0	2026-07-15 05:39:19	2026-07-15 05:39:52
bd459930-fe81-4a3a-899c-500cc354a640	a2432cab-5f7e-4ad3-a88b-440440ad08a7	a2432cab-c0c4-4e39-87f5-42579cc6ea8d	0	2026-07-15 05:39:19	2026-07-15 05:39:52
608e8300-d884-405d-9655-eb91e28d6e25	a2454bbc-008f-4f0a-a525-91e7ac1f40a6	a243280a-7b54-4642-8b13-45832e6b69db	0	2026-07-16 06:59:18	2026-07-16 06:59:18
ee3af3c9-bfd4-4a90-b4cd-86f201a28d99	a2454bbc-008f-4f0a-a525-91e7ac1f40a6	a2432cab-c0c4-4e39-87f5-42579cc6ea8d	0	2026-07-16 06:59:18	2026-07-16 06:59:18
6a4e28bc-d414-4b7f-9772-b732597ee53a	a2454bbc-008f-4f0a-a525-91e7ac1f40a6	a2432cab-a181-4d67-a8c2-b9da15951a18	0	2026-07-16 06:59:18	2026-07-16 06:59:18
9b7d9c8e-781f-483a-93e4-97395fb1d0a6	a2454bbc-008f-4f0a-a525-91e7ac1f40a6	a2454c41-c284-4aa6-8814-e4afdc88cac8	0	2026-07-16 06:59:18	2026-07-16 06:59:18
1d87a84f-f045-4275-a62c-5b624e4a5707	a2454ddb-4660-492b-981a-e87366d6122a	a2432cab-c0c4-4e39-87f5-42579cc6ea8d	0	2026-07-16 07:03:46	2026-07-16 07:03:46
37f39a8b-8b36-47bf-ab3b-47a29998f523	a2454ddb-4660-492b-981a-e87366d6122a	a243280a-7b54-4642-8b13-45832e6b69db	0	2026-07-16 07:03:46	2026-07-16 07:03:46
96434690-6821-49ee-9513-280f2c874dd4	a2454ddb-4660-492b-981a-e87366d6122a	a2432cab-a181-4d67-a8c2-b9da15951a18	0	2026-07-16 07:03:46	2026-07-16 07:03:46
b7d5b787-c69e-49f7-8d70-0e04b6e4ecf7	a2454ddb-4660-492b-981a-e87366d6122a	a2454c41-c284-4aa6-8814-e4afdc88cac8	0	2026-07-16 07:03:46	2026-07-16 07:03:46
adb3560c-6db8-41a0-ab85-824894a8f742	a24550a0-8608-4b0f-a913-7d05a4ef0e7c	a2432cab-c0c4-4e39-87f5-42579cc6ea8d	0	2026-07-16 07:11:31	2026-07-16 07:11:31
483fe030-770c-4568-af22-addac2c353b6	a24550a0-8608-4b0f-a913-7d05a4ef0e7c	a243280a-7b54-4642-8b13-45832e6b69db	0	2026-07-16 07:11:31	2026-07-16 07:11:31
725c17ea-79e0-4035-b35f-e7bb26103612	a24550a0-8608-4b0f-a913-7d05a4ef0e7c	a2432cab-a181-4d67-a8c2-b9da15951a18	0	2026-07-16 07:11:31	2026-07-16 07:11:31
4effc775-8113-412b-b61a-e66397601ad2	a24550a0-8608-4b0f-a913-7d05a4ef0e7c	a2454c41-c284-4aa6-8814-e4afdc88cac8	0	2026-07-16 07:11:31	2026-07-16 07:11:31
09d21bbb-e348-40f6-bd11-cab20b5e0ab0	a2454f2d-b7b7-45d7-9aa5-b10da64ea40d	a2432cab-c0c4-4e39-87f5-42579cc6ea8d	0	2026-07-16 07:12:09	2026-07-16 07:12:09
8258f915-ab0a-4347-a322-4126fe33318e	a2454f2d-b7b7-45d7-9aa5-b10da64ea40d	a243280a-7b54-4642-8b13-45832e6b69db	0	2026-07-16 07:12:09	2026-07-16 07:12:09
406c5964-8fc4-48d9-9b2f-c6fe55003b14	a2454f2d-b7b7-45d7-9aa5-b10da64ea40d	a2432cab-a181-4d67-a8c2-b9da15951a18	0	2026-07-16 07:12:09	2026-07-16 07:12:09
275b2698-d0ba-498e-a1fa-c05b429d3967	a2454f2d-b7b7-45d7-9aa5-b10da64ea40d	a2454c41-c284-4aa6-8814-e4afdc88cac8	0	2026-07-16 07:12:09	2026-07-16 07:12:09
128863ec-8ba1-4aec-b56b-d456d189fefa	a245524a-1bdb-41c2-872d-c597edd0176d	a2432cab-c0c4-4e39-87f5-42579cc6ea8d	0	2026-07-16 07:16:10	2026-07-16 07:16:10
62218e4f-47ff-4fd3-82cb-df45454d7e83	a245524a-1bdb-41c2-872d-c597edd0176d	a243280a-7b54-4642-8b13-45832e6b69db	0	2026-07-16 07:16:10	2026-07-16 07:16:10
a289ba5d-fd56-437a-87a2-8f57b4b19b73	a245524a-1bdb-41c2-872d-c597edd0176d	a2432cab-a181-4d67-a8c2-b9da15951a18	0	2026-07-16 07:16:10	2026-07-16 07:16:10
8e575ecd-5f56-4325-91e8-eb5a76923d71	a245524a-1bdb-41c2-872d-c597edd0176d	a2454c41-c284-4aa6-8814-e4afdc88cac8	0	2026-07-16 07:16:10	2026-07-16 07:16:10
ffc78175-a120-49f5-8f5c-eab0f8f01cab	a24553a9-174a-4f53-89c5-95bb2d50548d	a2432cab-c0c4-4e39-87f5-42579cc6ea8d	0	2026-07-16 07:20:00	2026-07-16 07:20:00
cd8ac5a2-07cc-4d52-ad74-756646613506	a24553a9-174a-4f53-89c5-95bb2d50548d	a243280a-7b54-4642-8b13-45832e6b69db	0	2026-07-16 07:20:00	2026-07-16 07:20:00
6624b5fe-7084-4355-852a-f5c6d5737b79	a24553a9-174a-4f53-89c5-95bb2d50548d	a2432cab-a181-4d67-a8c2-b9da15951a18	0	2026-07-16 07:20:00	2026-07-16 07:20:00
b95348e2-dee0-43f6-91cc-c378a574e38d	a24553a9-174a-4f53-89c5-95bb2d50548d	a2454c41-c284-4aa6-8814-e4afdc88cac8	0	2026-07-16 07:20:00	2026-07-16 07:20:00
8ee4c49f-73d6-4dbb-8413-6c9a41f41d90	a245551c-7238-4887-b526-22ae6fe17c04	a2432cab-c0c4-4e39-87f5-42579cc6ea8d	0	2026-07-16 07:24:03	2026-07-16 07:24:03
e4ddf0a7-a402-4571-9382-9922712685f4	a245551c-7238-4887-b526-22ae6fe17c04	a243280a-7b54-4642-8b13-45832e6b69db	0	2026-07-16 07:24:03	2026-07-16 07:24:03
004b062b-baa6-4f90-885f-cae9da77a803	a245551c-7238-4887-b526-22ae6fe17c04	a2432cab-a181-4d67-a8c2-b9da15951a18	0	2026-07-16 07:24:03	2026-07-16 07:24:03
123538f2-dfa8-48d9-a4fe-10f23f6d49f8	a245551c-7238-4887-b526-22ae6fe17c04	a2454c41-c284-4aa6-8814-e4afdc88cac8	0	2026-07-16 07:24:03	2026-07-16 07:24:03
e6bbb695-4bcd-4448-985d-03404c97ccdc	a24559ce-5c00-4381-b53b-09ba738ca10d	a2432cab-c0c4-4e39-87f5-42579cc6ea8d	0	2026-07-16 07:37:11	2026-07-16 07:37:11
e86b22bc-b7de-47fe-abf8-14804072ea6f	a24559ce-5c00-4381-b53b-09ba738ca10d	a243280a-7b54-4642-8b13-45832e6b69db	0	2026-07-16 07:37:11	2026-07-16 07:37:11
f71cbde1-e354-4743-a6ca-062506dd31e1	a24559ce-5c00-4381-b53b-09ba738ca10d	a2432cab-a181-4d67-a8c2-b9da15951a18	0	2026-07-16 07:37:11	2026-07-16 07:37:11
33704074-b67d-4381-b922-02590c4480df	a24559ce-5c00-4381-b53b-09ba738ca10d	a2454c41-c284-4aa6-8814-e4afdc88cac8	0	2026-07-16 07:37:11	2026-07-16 07:37:11
ea38319c-919b-4cc8-af91-4aac47167b87	a2455b0b-9412-4eb5-ae0c-439947b2563c	a2432cab-c0c4-4e39-87f5-42579cc6ea8d	0	2026-07-16 07:40:39	2026-07-16 07:40:39
1880b6e6-bf16-4ae2-bced-a218dda16978	a2455b0b-9412-4eb5-ae0c-439947b2563c	a243280a-7b54-4642-8b13-45832e6b69db	0	2026-07-16 07:40:39	2026-07-16 07:40:39
998386ac-8560-4ab9-95ed-e597df62c8de	a2455b0b-9412-4eb5-ae0c-439947b2563c	a2432cab-a181-4d67-a8c2-b9da15951a18	0	2026-07-16 07:40:39	2026-07-16 07:40:39
f70a6452-7515-4181-8950-08c07f81fe0f	a2455b0b-9412-4eb5-ae0c-439947b2563c	a2454c41-c284-4aa6-8814-e4afdc88cac8	0	2026-07-16 07:40:39	2026-07-16 07:40:39
1f3efe03-4f93-4df8-901f-500bda418915	a2455cb6-4801-4adf-93ab-ac9d940cb03e	a2432cab-c0c4-4e39-87f5-42579cc6ea8d	0	2026-07-16 07:45:19	2026-07-16 07:45:19
47d036ef-5531-44f4-b546-64e507863ec1	a2455cb6-4801-4adf-93ab-ac9d940cb03e	a243280a-7b54-4642-8b13-45832e6b69db	0	2026-07-16 07:45:19	2026-07-16 07:45:19
95fb4886-be06-4680-ba83-1f328adff0f3	a2455cb6-4801-4adf-93ab-ac9d940cb03e	a2432cab-a181-4d67-a8c2-b9da15951a18	0	2026-07-16 07:45:19	2026-07-16 07:45:19
03b6b69f-9833-49b7-84bb-a73dc26da173	a2455cb6-4801-4adf-93ab-ac9d940cb03e	a2454c41-c284-4aa6-8814-e4afdc88cac8	0	2026-07-16 07:45:19	2026-07-16 07:45:19
7d040dfc-4ef5-4bc3-81ce-c3832a1eb651	a2455e45-86fe-4b27-af33-b393ee89a5f9	a243280a-7b54-4642-8b13-45832e6b69db	0	2026-07-16 07:50:35	2026-07-16 07:50:35
9b279720-f4ef-4d96-b2f8-6744b0321bab	a2455e45-86fe-4b27-af33-b393ee89a5f9	a2432cab-c0c4-4e39-87f5-42579cc6ea8d	0	2026-07-16 07:50:35	2026-07-16 07:50:35
60ce6b3a-289a-47ea-a9e1-7961d5516a82	a2455e45-86fe-4b27-af33-b393ee89a5f9	a2454c41-c284-4aa6-8814-e4afdc88cac8	0	2026-07-16 07:50:35	2026-07-16 07:50:35
f270d967-92a1-4b8a-ba26-fa1d77fe10e6	a2455e45-86fe-4b27-af33-b393ee89a5f9	a2432cab-a181-4d67-a8c2-b9da15951a18	0	2026-07-16 07:50:35	2026-07-16 07:50:35
1bcf520f-f935-47be-bf2f-751e2095760b	a245603c-48eb-4acd-84c2-43ff2ca9db46	a2432cab-c0c4-4e39-87f5-42579cc6ea8d	0	2026-07-16 07:55:10	2026-07-16 07:55:10
c79225c0-50d2-4e5b-a093-ae4609baa838	a245603c-48eb-4acd-84c2-43ff2ca9db46	a243280a-7b54-4642-8b13-45832e6b69db	0	2026-07-16 07:55:10	2026-07-16 07:55:10
083ad43c-354d-4e0a-83b2-6f21e3b1ae1b	a245603c-48eb-4acd-84c2-43ff2ca9db46	a2454c41-c284-4aa6-8814-e4afdc88cac8	0	2026-07-16 07:55:10	2026-07-16 07:55:10
0ff92d54-aa8e-4aaa-9c59-26c4f81d9ae5	a245603c-48eb-4acd-84c2-43ff2ca9db46	a2432cab-a181-4d67-a8c2-b9da15951a18	0	2026-07-16 07:55:10	2026-07-16 07:55:10
a38aab50-7f7f-4a30-8f23-04ca9a3131d4	a2456183-c1c0-41f6-9049-5bc97cc8fb07	a2432cab-c0c4-4e39-87f5-42579cc6ea8d	0	2026-07-16 07:58:44	2026-07-16 07:58:44
8542e3c1-784c-49a4-901e-9507016df5c9	a2456183-c1c0-41f6-9049-5bc97cc8fb07	a243280a-7b54-4642-8b13-45832e6b69db	0	2026-07-16 07:58:44	2026-07-16 07:58:44
1b13fdd1-0b61-459f-b7e5-d605fa008716	a2456183-c1c0-41f6-9049-5bc97cc8fb07	a2432cab-a181-4d67-a8c2-b9da15951a18	0	2026-07-16 07:58:44	2026-07-16 07:58:44
dd0ad84e-ac96-4655-9488-697e36b2d277	a2456183-c1c0-41f6-9049-5bc97cc8fb07	a2454c41-c284-4aa6-8814-e4afdc88cac8	0	2026-07-16 07:58:44	2026-07-16 07:58:44
8688643e-8e9a-49f3-8854-2fb70f2d87ba	a24562d9-1ee6-4e86-a75b-952d5f0d10c1	a2432cab-c0c4-4e39-87f5-42579cc6ea8d	0	2026-07-16 08:02:28	2026-07-16 08:02:28
b7470644-5c87-4580-bafe-12139d2bfb2d	a24562d9-1ee6-4e86-a75b-952d5f0d10c1	a243280a-7b54-4642-8b13-45832e6b69db	0	2026-07-16 08:02:28	2026-07-16 08:02:28
6c60ab55-84cc-46dd-9b8b-422e28f2b11e	a24562d9-1ee6-4e86-a75b-952d5f0d10c1	a2454c41-c284-4aa6-8814-e4afdc88cac8	0	2026-07-16 08:02:28	2026-07-16 08:02:28
62b32a79-2ae7-41f1-976a-94590545add2	a24562d9-1ee6-4e86-a75b-952d5f0d10c1	a2432cab-a181-4d67-a8c2-b9da15951a18	0	2026-07-16 08:02:28	2026-07-16 08:02:28
cbd690bf-670e-455f-a805-fce482c45ebd	a245643c-a99a-4448-9dc0-f20d9082fb64	a2432cab-c0c4-4e39-87f5-42579cc6ea8d	0	2026-07-16 08:06:21	2026-07-16 08:06:21
d0e136f9-0bda-4419-86c5-285b6150d072	a245643c-a99a-4448-9dc0-f20d9082fb64	a243280a-7b54-4642-8b13-45832e6b69db	0	2026-07-16 08:06:21	2026-07-16 08:06:21
06017aa7-27bf-477a-8f25-44e89a222c17	a245643c-a99a-4448-9dc0-f20d9082fb64	a2454c41-c284-4aa6-8814-e4afdc88cac8	0	2026-07-16 08:06:21	2026-07-16 08:06:21
93acad3e-2e18-4720-8d8c-22715b7390b9	a245643c-a99a-4448-9dc0-f20d9082fb64	a2432cab-a181-4d67-a8c2-b9da15951a18	0	2026-07-16 08:06:21	2026-07-16 08:06:21
475aa1b6-afa2-47ba-8fa2-b7878743f5ab	a24565c0-505d-4bf4-b550-646996c0b641	a243280a-7e5e-4a52-9411-f788c35c640d	0	2026-07-16 08:10:35	2026-07-16 08:10:35
c3594e37-33e4-4a21-9bdb-017555477010	a24565c0-505d-4bf4-b550-646996c0b641	a24565c0-beed-475e-9c2d-2a2475481e8f	0	2026-07-16 08:10:35	2026-07-16 08:10:35
1b835bb8-8a68-48a0-8ad4-6c3906ade744	a24565c0-505d-4bf4-b550-646996c0b641	a2432cab-a181-4d67-a8c2-b9da15951a18	0	2026-07-16 08:10:35	2026-07-16 08:10:35
528ed1e3-2d99-4f78-9c45-757707dd1542	a24565c0-505d-4bf4-b550-646996c0b641	a2454c41-c284-4aa6-8814-e4afdc88cac8	0	2026-07-16 08:10:35	2026-07-16 08:10:35
8c8d0ec7-b8e5-4330-8e4c-f8986a48902d	a24566f6-ae7b-4f50-bec9-69f9627fc646	a2454c41-c284-4aa6-8814-e4afdc88cac8	0	2026-07-16 08:13:59	2026-07-16 08:13:59
38100427-3a54-420a-bf0a-13870ffa04d2	a24566f6-ae7b-4f50-bec9-69f9627fc646	a243280a-7e5e-4a52-9411-f788c35c640d	0	2026-07-16 08:13:59	2026-07-16 08:13:59
856731aa-0072-448b-89c5-91c8d4545618	a24566f6-ae7b-4f50-bec9-69f9627fc646	a24565c0-beed-475e-9c2d-2a2475481e8f	0	2026-07-16 08:13:59	2026-07-16 08:13:59
5366bf1e-edfb-4d49-853e-ed2294b3f820	a24566f6-ae7b-4f50-bec9-69f9627fc646	a2432cab-a181-4d67-a8c2-b9da15951a18	0	2026-07-16 08:13:59	2026-07-16 08:13:59
674e802b-9814-46c1-8864-9be3da8b5799	a245686a-76f2-445e-a38b-0b7ff92cc91e	a243280a-7e5e-4a52-9411-f788c35c640d	0	2026-07-16 08:18:02	2026-07-16 08:18:02
d64f025e-15e0-49f1-a227-fea1057394a0	a245686a-76f2-445e-a38b-0b7ff92cc91e	a2454c41-c284-4aa6-8814-e4afdc88cac8	0	2026-07-16 08:18:02	2026-07-16 08:18:02
702debc1-b20f-450a-bc46-594cfdd0ec01	a245686a-76f2-445e-a38b-0b7ff92cc91e	a24565c0-beed-475e-9c2d-2a2475481e8f	0	2026-07-16 08:18:02	2026-07-16 08:18:02
225f4525-d23f-47ed-801b-1158547b0954	a245686a-76f2-445e-a38b-0b7ff92cc91e	a245686a-eef4-4918-ac91-d325ce0c080b	0	2026-07-16 08:18:02	2026-07-16 08:18:02
\.


--
-- TOC entry 3543 (class 0 OID 16699)
-- Dependencies: 230
-- Data for Name: product_dimensions; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.product_dimensions (id, product_id, general_dimensions, seat_height, seat_depth, arm_height, total_weight_lbs, box_dimensions, created_at, updated_at) FROM stdin;
a243280b-4e67-4b86-9bf5-c09349fe10a7	a2432809-bb0f-40f3-a830-4233c23fd48c	122"W x 39"H x 79"D	19"	24"	31"	424.00	Corner Box 1 (2): 43.5" x 43.5" x 15" Corner Box 2 (2): 43" x 17" x 7" Armless Box (1): 43.5" x 37.5" x 14.25" Ottoman Box (1): 37.5" x 37.5" x 13.25"	2026-07-15 05:26:23	2026-07-15 05:26:23
a2432cac-1a7b-4f90-8614-76e67e5cbe84	a2432cab-5f7e-4ad3-a88b-440440ad08a7	108.5"W x 33"H x 62"D	18"	37.5"-62"	23.5"	200.00	Box 1: 77.875 x 39.5625 x 16.5 (100lbs) Box 2: 77.5 x 32.25 x 13 (55lbs) Box 3: 69.75 x 23.5 x 18 (53lbs) Box 4: 32.5 x 17.5 x 11.25 (30lbs)	2026-07-15 05:39:19	2026-07-15 05:39:19
a2454bbd-88c6-4d94-b59a-19e4962774ff	a2454bbc-008f-4f0a-a525-91e7ac1f40a6	122"W x 39"H x 79"D	19"	29"	31"	511.00	Corner Box 1 (2): 43.5" x 43.5" x 15" Corner Box 2 (2): 43" x 17" x 7" Armless Box (2): 43.5" x 37.5" x 14.25" Ottoman Box (1): 37.5" x 37.5" x 13.25"	2026-07-16 06:57:51	2026-07-16 06:57:51
a2454ddc-189a-4ff1-8a64-5b2ba293c033	a2454ddb-4660-492b-981a-e87366d6122a	101"W x 30.5"H x 40"D	18"	25"	23.5"	160.00	Box 1 (Base & Seat Cushions): 88" x 32" x 17.25" Box 2 (Back, Feet, & Pillows): 88" x 24" x 18.5" Box 3 (Arms): 41" x 22.25" x 11.25"	2026-07-16 07:03:47	2026-07-16 07:03:47
a2454f2e-60f9-4c7f-a859-088b5036382a	a2454f2d-b7b7-45d7-9aa5-b10da64ea40d	86"W x 32"H x 37.5"D	18"	23.5"	23.5"	180.00	Box 1 (Base & Seat Cushions): 89" x 32.25" x 13" Box 2 (Back, Feet, & Pillows): 81.63" x 23.5" x 18" Box 3 (Arms): 32.55" x 17.5" x 11.25"	2026-07-16 07:07:28	2026-07-16 07:07:28
a24550a1-5d29-4422-b793-6fcae9073489	a24550a0-8608-4b0f-a913-7d05a4ef0e7c	75"W x 32"H x 37.5"D	18"	23.5"	23.5"	130.00	Box 1 (Base & Seat Cushions): 77.5" x 32.25" x 13" Box 2 (Back, Feet, & Pillows): 69.75" x 23.5" x 18" Box 3 (Arms): 32.55" x 17.5" x 11.25"	2026-07-16 07:11:31	2026-07-16 07:11:31
a245524a-e262-47bb-a793-53e48213fcb4	a245524a-1bdb-41c2-872d-c597edd0176d	85.5"W x 39"H x 42.5"D	19"	29"	31"	280.00	Corner Box 1 (2): 43.5" x 43.5" x 15" Corner Box 2 (2): 43" x 17" x 7"	2026-07-16 07:16:10	2026-07-16 07:16:10
a24553a9-e569-4cb3-8034-c189eac8b818	a24553a9-174a-4f53-89c5-95bb2d50548d	85.5"W x 39"H x 79"D	19"	29"	31"	381.00	Corner Box 1 (2): 43.5" x 43.5" x 15" Corner Box 2 (2): 43" x 17" x 7" Ottoman Box (1): 37.5" x 37.5" x 13.25"	2026-07-16 07:20:00	2026-07-16 07:20:00
a245551d-34ca-490d-b9e5-fad704e48a98	a245551c-7238-4887-b526-22ae6fe17c04	122"W x 39"H x 42.5"D	19"	29"	31"	323.00	Corner Box 1 (2): 43.5" x 43.5" x 15" Corner Box 2 (2): 43" x 17" x 7" Armless Box (1): 43.5" x 37.5" x 14.25"	2026-07-16 07:24:04	2026-07-16 07:24:04
a24559cf-1a07-48bb-8d45-f1b70c2d0687	a24559ce-5c00-4381-b53b-09ba738ca10d	124"W x 30.5"H x 70"D	18"	25"	23.5"	286.00	Box 1 (Chaise): 88" x 46.56" x 18" Box 2 (Settee seat): 88" x 32.25" x 17.25" Box 3 (Settee back): 88" x 24" x 18.5" Box 4 (Arms): 41" x 22.25" x 18.5"	2026-07-16 07:37:11	2026-07-16 07:37:11
a2455b0c-5ba7-4e91-8ec3-f82c83e3b6f6	a2455b0b-9412-4eb5-ae0c-439947b2563c	39"W x 30.5"H x 40"D	18"	25"	23.5"	110.00	Box 1 (Base & Seat Cushions): 31 x 28.69 x 17.75 Box 2 (Back, Feet, & Pillows): 28.69 x 22.75 x 19.25 Box 3 (Arms): 40.88 x 21.58 x 14.75	2026-07-16 07:40:39	2026-07-16 07:40:39
a2455cb7-1d96-4b54-8f40-b821b6d84875	a2455cb6-4801-4adf-93ab-ac9d940cb03e	122"W x 39"H x 79"D	19"	29"	31"	511.00	Corner Box 1 (2): 43.5" x 43.5" x 15" Corner Box 2 (2): 43" x 17" x 7" Armless Box (2): 43.5" x 37.5" x 14.25" Ottoman Box (1): 37.5" x 37.5" x 13.25"	2026-07-16 07:45:19	2026-07-16 07:45:19
a2455e46-2cbb-45c3-96ff-ac5653356664	a2455e45-86fe-4b27-af33-b393ee89a5f9	158.5"W x 39"H x 122"D	19"	29"	31"	738.00	Corner Box 1 (3): 43.5" x 43.5" x 15" Corner Box 2 (3): 43" x 17" x 7" Armless Box (3): 43.5" x 37.5" x 14.25" Ottoman Box (1): 37.5" x 37.5" x 13.25"	2026-07-16 07:49:41	2026-07-16 07:49:41
a245603d-4a90-4e0d-9309-100187243d85	a245603c-48eb-4acd-84c2-43ff2ca9db46	158.5"W x 39"H x 122"D	19"	31"	29"	738.00	Corner Box 1 (3): 43.5" x 43.5" x 15" Corner Box 2 (3): 43" x 17" x 7" Armless Box (3): 43.5" x 37.5" x 14.25" Ottoman Box (1): 37.5" x 37.5" x 13.25"	2026-07-16 07:55:10	2026-07-16 07:55:10
a2456184-94c8-4714-b526-d63863300ac5	a2456183-c1c0-41f6-9049-5bc97cc8fb07	158.5"W x 39"H x 79"D	19"	29"	31"	742.00	Corner Box 1 (2): 43.5" x 43.5" x 15" Corner Box 2 (2): 43" x 17" x 7" Armless Box (4): 43.5" x 37.5" x 14.25" Ottoman Box (2): 37.5" x 37.5" x 13.25"	2026-07-16 07:58:45	2026-07-16 07:58:45
a24562da-a3a8-4967-8e4a-f015b8699cf0	a24562d9-1ee6-4e86-a75b-952d5f0d10c1	34"W x 32"H x 37.5"D	18"	23.5"	23.5"	75.00	Box 1 (Base & Seat Cushions): 36.25" x 30.5" x 12.75" Box 2 (Back, Feet, & Pillows): 29.25" x 22.75" x 16.5" Box 3 (Arms): 32.55" x 17.5" x 11.25"	2026-07-16 08:02:29	2026-07-16 08:02:29
a245643d-8c76-436b-a69d-607c2edc9a3e	a245643c-a99a-4448-9dc0-f20d9082fb64	41"W x 18"H x 29"D	18"	29"	39"W x 7.5"H x 27"D, 4.6 cu ft	60.00	43" x 30.25" x 17"	2026-07-16 08:06:21	2026-07-16 08:06:21
a24565c1-2861-44b7-ba54-919e8444da78	a24565c0-505d-4bf4-b550-646996c0b641	36.5"W x 18.5"H x 36.5"D	19"	36"	24	57.00	Ottoman Box: 37.5" x 37.5" x 13.25"	2026-07-16 08:10:36	2026-07-16 08:10:36
a24566f7-8e0d-4b26-a401-fc1ab989de6e	a24566f6-ae7b-4f50-bec9-69f9627fc646	36.5"W x 18.5"H x 36.5"D	19"	36"	1	57.00	Ottoman Box: 37.5" x 37.5" x 13.25"	2026-07-16 08:13:59	2026-07-16 08:13:59
a245686b-5cd1-4615-963c-4055887b53dd	a245686a-76f2-445e-a38b-0b7ff92cc91e	36.5"W x 39"H x 42.5"D	19"	29"	0	87.00	Armless Box: 43.5" x 37.5" x 14.25"	2026-07-16 08:18:03	2026-07-16 08:18:03
\.


--
-- TOC entry 3540 (class 0 OID 16661)
-- Dependencies: 227
-- Data for Name: product_photos; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.product_photos (id, product_id, file_name, is_primary, sort_order, created_at, updated_at) FROM stdin;
a243280a-ca32-4391-874f-ec014f1db53a	a2432809-bb0f-40f3-a830-4233c23fd48c	assets/img/products/kova-pillow-cushion-sofa-vfzKzB.webp	f	1	2026-07-15 05:26:23	2026-07-15 05:26:23
a243280a-d46c-412f-bf3f-a53b21603e3f	a2432809-bb0f-40f3-a830-4233c23fd48c	assets/img/products/kova-pillow-cushion-sofa-c7AtGr.webp	f	2	2026-07-15 05:26:23	2026-07-15 05:26:23
a243280a-de1f-438c-ac4a-03ee41bf598f	a2432809-bb0f-40f3-a830-4233c23fd48c	assets/img/products/kova-pillow-cushion-sofa-2G4llL.webp	f	3	2026-07-15 05:26:23	2026-07-15 05:26:23
a243280a-e742-4bc1-ad9e-91a34ec926d6	a2432809-bb0f-40f3-a830-4233c23fd48c	assets/img/products/kova-pillow-cushion-sofa-IAoUZj.webp	f	4	2026-07-15 05:26:23	2026-07-15 05:26:23
a243280a-f2cf-4c5a-8beb-87ba26a5dfb8	a2432809-bb0f-40f3-a830-4233c23fd48c	assets/img/products/kova-pillow-cushion-sofa-Yu7mne.webp	t	5	2026-07-15 05:26:23	2026-07-15 05:26:23
a245551c-fa02-4077-9191-509008d660f4	a245551c-7238-4887-b526-22ae6fe17c04	assets/img/products/kova-box-cushion-sofa-122-GLEvBq.webp	t	1	2026-07-16 07:24:04	2026-07-16 07:24:04
a2432cab-f809-4912-b28b-bfebe27b3e52	a2432cab-5f7e-4ad3-a88b-440440ad08a7	assets/img/products/lido-chaise-sectional-aM9zf1.webp	f	3	2026-07-15 05:39:19	2026-07-15 05:39:52
a2432cab-eeba-405f-8225-bb77696575ff	a2432cab-5f7e-4ad3-a88b-440440ad08a7	assets/img/products/lido-chaise-sectional-THhkJW.webp	f	2	2026-07-15 05:39:19	2026-07-15 05:39:52
a2432cab-e42a-45ca-9442-ab586aefbdca	a2432cab-5f7e-4ad3-a88b-440440ad08a7	assets/img/products/lido-chaise-sectional-uTabCs.webp	t	1	2026-07-15 05:39:19	2026-07-15 05:39:52
a2454bbd-487b-45b4-88fe-f668a0d6ac94	a2454bbc-008f-4f0a-a525-91e7ac1f40a6	assets/img/products/kova-box-cushion-l-shape-ottoman-zMt2tJ.webp	t	1	2026-07-16 06:57:51	2026-07-16 06:57:51
a2454bbd-5362-438c-a280-bc17aca378e4	a2454bbc-008f-4f0a-a525-91e7ac1f40a6	assets/img/products/kova-box-cushion-l-shape-ottoman-4CX9li.webp	f	2	2026-07-16 06:57:51	2026-07-16 06:59:18
a2454bbd-5d44-4953-baf7-d420be4ac658	a2454bbc-008f-4f0a-a525-91e7ac1f40a6	assets/img/products/kova-box-cushion-l-shape-ottoman-6pAYiT.webp	f	3	2026-07-16 06:57:51	2026-07-16 06:59:18
a2454bbd-6766-4c78-b4ae-29994404dc7a	a2454bbc-008f-4f0a-a525-91e7ac1f40a6	assets/img/products/kova-box-cushion-l-shape-ottoman-2jmUEd.webp	f	4	2026-07-16 06:57:51	2026-07-16 06:59:18
a2454ddb-d526-4afd-b03f-f614bb642725	a2454ddb-4660-492b-981a-e87366d6122a	assets/img/products/barton-sofa-UebpJB.webp	f	1	2026-07-16 07:03:46	2026-07-16 07:03:47
a2454ddb-e22d-4722-9b21-2b543f9f103b	a2454ddb-4660-492b-981a-e87366d6122a	assets/img/products/barton-sofa-cpvONU.webp	f	2	2026-07-16 07:03:46	2026-07-16 07:03:47
a2454ddb-ee6d-484f-b632-782dc0a3c993	a2454ddb-4660-492b-981a-e87366d6122a	assets/img/products/barton-sofa-OmOKmK.webp	t	3	2026-07-16 07:03:47	2026-07-16 07:03:47
a2454ddb-f8d3-43ef-b42d-e016c366955d	a2454ddb-4660-492b-981a-e87366d6122a	assets/img/products/barton-sofa-cVZqK7.webp	f	4	2026-07-16 07:03:47	2026-07-16 07:03:47
a245551d-0319-4766-87b5-d3eda17aa2f1	a245551c-7238-4887-b526-22ae6fe17c04	assets/img/products/kova-box-cushion-sofa-122-zffRpp.webp	f	2	2026-07-16 07:24:04	2026-07-16 07:24:04
a2454f2e-2d28-4a4c-a0a5-79df235f8bda	a2454f2d-b7b7-45d7-9aa5-b10da64ea40d	assets/img/products/lido-sofa-86-SxROp4.webp	t	2	2026-07-16 07:07:28	2026-07-16 07:07:28
a24550a1-177b-4986-975a-687f0dff31b1	a24550a0-8608-4b0f-a913-7d05a4ef0e7c	assets/img/products/lido-sofa-75-VsUlAF.webp	f	1	2026-07-16 07:11:31	2026-07-16 07:11:31
a24550a1-2409-4f00-9012-5bb9363f4081	a24550a0-8608-4b0f-a913-7d05a4ef0e7c	assets/img/products/lido-sofa-75-bu2Bfs.webp	t	2	2026-07-16 07:11:31	2026-07-16 07:11:31
a24550a1-2e03-452a-93cd-f17dc2fb61c5	a24550a0-8608-4b0f-a913-7d05a4ef0e7c	assets/img/products/lido-sofa-75-cGvEHZ.webp	f	3	2026-07-16 07:11:31	2026-07-16 07:11:31
a24550a1-396d-4376-afed-ccde5beda175	a24550a0-8608-4b0f-a913-7d05a4ef0e7c	assets/img/products/lido-sofa-75-A0bKKI.webp	f	4	2026-07-16 07:11:31	2026-07-16 07:11:31
a2454f2e-21ff-487f-8906-7d079d3e4585	a2454f2d-b7b7-45d7-9aa5-b10da64ea40d	assets/img/products/lido-sofa-86-Y89Fps.webp	f	1	2026-07-16 07:07:28	2026-07-16 07:12:09
a2454f2e-35f3-4bde-99cc-7dee8c4f3a68	a2454f2d-b7b7-45d7-9aa5-b10da64ea40d	assets/img/products/lido-sofa-86-x86OY9.webp	f	3	2026-07-16 07:07:28	2026-07-16 07:12:09
a2454f2e-4152-4654-b253-a13aafe1eece	a2454f2d-b7b7-45d7-9aa5-b10da64ea40d	assets/img/products/lido-sofa-86-u4L5Tz.webp	f	4	2026-07-16 07:07:28	2026-07-16 07:12:09
a245524a-a437-4ee5-9516-cd00c34d76a2	a245524a-1bdb-41c2-872d-c597edd0176d	assets/img/products/kova-box-cushion-sofa-86-ooJB5a.webp	f	1	2026-07-16 07:16:10	2026-07-16 07:16:10
a245524a-adf0-4deb-89cc-e4520e2422b9	a245524a-1bdb-41c2-872d-c597edd0176d	assets/img/products/kova-box-cushion-sofa-86-9j2UNd.webp	f	2	2026-07-16 07:16:10	2026-07-16 07:16:10
a245524a-b8f8-40bb-81a2-7195320996cb	a245524a-1bdb-41c2-872d-c597edd0176d	assets/img/products/kova-box-cushion-sofa-86-oHtZNl.webp	t	3	2026-07-16 07:16:10	2026-07-16 07:16:10
a245524a-c1d2-4b64-808e-30822a66d2ff	a245524a-1bdb-41c2-872d-c597edd0176d	assets/img/products/kova-box-cushion-sofa-86-B1VWZO.webp	f	4	2026-07-16 07:16:10	2026-07-16 07:16:10
a24553a9-a580-404c-b135-1f4f95b99122	a24553a9-174a-4f53-89c5-95bb2d50548d	assets/img/products/kova-pillow-cushion-sofa-86-ottoman-vhTNtW.webp	f	1	2026-07-16 07:20:00	2026-07-16 07:20:00
a24553a9-af6f-4c9e-8605-16d86b4bd50e	a24553a9-174a-4f53-89c5-95bb2d50548d	assets/img/products/kova-pillow-cushion-sofa-86-ottoman-u5cI8R.webp	f	2	2026-07-16 07:20:00	2026-07-16 07:20:00
a24553a9-b8cd-4249-bc2a-8b6596592012	a24553a9-174a-4f53-89c5-95bb2d50548d	assets/img/products/kova-pillow-cushion-sofa-86-ottoman-oYKfYb.webp	f	3	2026-07-16 07:20:00	2026-07-16 07:20:00
a24553a9-c42f-403f-9cc0-259f293f0bb9	a24553a9-174a-4f53-89c5-95bb2d50548d	assets/img/products/kova-pillow-cushion-sofa-86-ottoman-3SYfMC.webp	t	4	2026-07-16 07:20:00	2026-07-16 07:20:00
a245551d-0bc6-4575-93dc-5bfad28ce664	a245551c-7238-4887-b526-22ae6fe17c04	assets/img/products/kova-box-cushion-sofa-122-PUhsqu.webp	f	3	2026-07-16 07:24:04	2026-07-16 07:24:04
a245551d-1625-42ba-a8ca-cc4b8c2f3d96	a245551c-7238-4887-b526-22ae6fe17c04	assets/img/products/kova-box-cushion-sofa-122-L0kY3D.webp	f	4	2026-07-16 07:24:04	2026-07-16 07:24:04
a24559ce-de63-4809-b351-f087e5b0ee2c	a24559ce-5c00-4381-b53b-09ba738ca10d	assets/img/products/barton-chaise-sectional-p2iVJQ.webp	t	1	2026-07-16 07:37:11	2026-07-16 07:37:11
a24559ce-e7a8-4ecc-9334-51f84306a981	a24559ce-5c00-4381-b53b-09ba738ca10d	assets/img/products/barton-chaise-sectional-hJ5EsJ.webp	f	2	2026-07-16 07:37:11	2026-07-16 07:37:11
a24559ce-f143-4e3d-b3ca-04da25bb3961	a24559ce-5c00-4381-b53b-09ba738ca10d	assets/img/products/barton-chaise-sectional-MPCytJ.webp	f	3	2026-07-16 07:37:11	2026-07-16 07:37:11
a24559ce-fae7-4a1a-98be-e9af9a8513ad	a24559ce-5c00-4381-b53b-09ba738ca10d	assets/img/products/barton-chaise-sectional-btVGan.webp	f	4	2026-07-16 07:37:11	2026-07-16 07:37:11
a2455b0c-1c41-4c2f-83a1-f47e73bb7a28	a2455b0b-9412-4eb5-ae0c-439947b2563c	assets/img/products/barton-armchair-e0w2QV.webp	f	1	2026-07-16 07:40:39	2026-07-16 07:40:39
a2455b0c-279d-4186-bddd-e4e43172b5f1	a2455b0b-9412-4eb5-ae0c-439947b2563c	assets/img/products/barton-armchair-vkUXfY.webp	t	2	2026-07-16 07:40:39	2026-07-16 07:40:39
a2455b0c-30bb-4e17-9f6a-2380c46e097f	a2455b0b-9412-4eb5-ae0c-439947b2563c	assets/img/products/barton-armchair-9b0Ruw.webp	f	3	2026-07-16 07:40:39	2026-07-16 07:40:39
a2455b0c-39fc-419d-959e-4d28401c2f5a	a2455b0b-9412-4eb5-ae0c-439947b2563c	assets/img/products/barton-armchair-Mmk8aT.webp	f	4	2026-07-16 07:40:39	2026-07-16 07:40:39
a2455cb6-d886-4640-96c8-e83e2e942d98	a2455cb6-4801-4adf-93ab-ac9d940cb03e	assets/img/products/kova-pillow-cushion-l-shape-ottoman-2vNQEN.webp	f	1	2026-07-16 07:45:19	2026-07-16 07:45:19
a2455cb6-e444-4911-8bb7-efccf8d76b46	a2455cb6-4801-4adf-93ab-ac9d940cb03e	assets/img/products/kova-pillow-cushion-l-shape-ottoman-KZohTi.webp	f	2	2026-07-16 07:45:19	2026-07-16 07:45:19
a2455cb6-eed7-4f42-bd78-a8aaa231edda	a2455cb6-4801-4adf-93ab-ac9d940cb03e	assets/img/products/kova-pillow-cushion-l-shape-ottoman-nhpfbs.webp	f	3	2026-07-16 07:45:19	2026-07-16 07:45:19
a2455cb6-fc33-4e74-8c87-a612eba67ccc	a2455cb6-4801-4adf-93ab-ac9d940cb03e	assets/img/products/kova-pillow-cushion-l-shape-ottoman-TvZDXl.webp	t	4	2026-07-16 07:45:19	2026-07-16 07:45:19
a2455e45-f776-4b20-aa96-be837e696cb4	a2455e45-86fe-4b27-af33-b393ee89a5f9	assets/img/products/kova-pillow-cushion-grand-corner-ottoman-yq5Ngj.webp	t	2	2026-07-16 07:49:40	2026-07-16 07:49:40
a2455e45-ec34-4594-9d21-91a61ecac9c3	a2455e45-86fe-4b27-af33-b393ee89a5f9	assets/img/products/kova-pillow-cushion-grand-corner-ottoman-gYPSUB.webp	f	1	2026-07-16 07:49:40	2026-07-16 07:50:35
a2455e46-0133-465d-8498-0d675f734304	a2455e45-86fe-4b27-af33-b393ee89a5f9	assets/img/products/kova-pillow-cushion-grand-corner-ottoman-Qlx3Ah.webp	f	3	2026-07-16 07:49:40	2026-07-16 07:50:35
a2455e46-0aaf-44ce-bbfc-a9dd38024800	a2455e45-86fe-4b27-af33-b393ee89a5f9	assets/img/products/kova-pillow-cushion-grand-corner-ottoman-tR34Zr.webp	f	4	2026-07-16 07:49:40	2026-07-16 07:50:35
a245603c-fbdf-43a7-8d46-4871178210df	a245603c-48eb-4acd-84c2-43ff2ca9db46	assets/img/products/kova-box-cushion-grand-corner-ottoman-O5vCpj.webp	f	1	2026-07-16 07:55:10	2026-07-16 07:55:10
a245603d-0739-45be-8d38-358d235d3ab2	a245603c-48eb-4acd-84c2-43ff2ca9db46	assets/img/products/kova-box-cushion-grand-corner-ottoman-xFeNAV.webp	f	2	2026-07-16 07:55:10	2026-07-16 07:55:10
a245603d-1500-4af6-bb52-fabbfe257395	a245603c-48eb-4acd-84c2-43ff2ca9db46	assets/img/products/kova-box-cushion-grand-corner-ottoman-3V3aEK.webp	t	3	2026-07-16 07:55:10	2026-07-16 07:55:10
a245603d-2173-44aa-b534-cc3f0c58ac8d	a245603c-48eb-4acd-84c2-43ff2ca9db46	assets/img/products/kova-box-cushion-grand-corner-ottoman-9tru1w.webp	f	4	2026-07-16 07:55:10	2026-07-16 07:55:10
a2456184-52bc-4518-b711-a601b82a4093	a2456183-c1c0-41f6-9049-5bc97cc8fb07	assets/img/products/kova-pillow-cushion-grand-pit-HVwecK.webp	t	1	2026-07-16 07:58:45	2026-07-16 07:58:45
a2456184-5caa-4ad4-830a-2dd9dc1a9c81	a2456183-c1c0-41f6-9049-5bc97cc8fb07	assets/img/products/kova-pillow-cushion-grand-pit-kdZzxX.webp	f	2	2026-07-16 07:58:45	2026-07-16 07:58:45
a2456184-677c-4914-8599-3dc8a3819c01	a2456183-c1c0-41f6-9049-5bc97cc8fb07	assets/img/products/kova-pillow-cushion-grand-pit-RNWe7A.webp	f	3	2026-07-16 07:58:45	2026-07-16 07:58:45
a2456184-7264-4e79-998a-6d9ffe91833f	a2456183-c1c0-41f6-9049-5bc97cc8fb07	assets/img/products/kova-pillow-cushion-grand-pit-pkIIzi.webp	f	4	2026-07-16 07:58:45	2026-07-16 07:58:45
a24562da-3424-4337-9b81-9186730df8a9	a24562d9-1ee6-4e86-a75b-952d5f0d10c1	assets/img/products/lido-armchair-pDmAyD.webp	f	1	2026-07-16 08:02:29	2026-07-16 08:02:29
a24562da-462b-40f4-95a6-77499258da76	a24562d9-1ee6-4e86-a75b-952d5f0d10c1	assets/img/products/lido-armchair-UqdqM9.webp	f	2	2026-07-16 08:02:29	2026-07-16 08:02:29
a24562da-5656-4aef-8463-90d7f5874cd5	a24562d9-1ee6-4e86-a75b-952d5f0d10c1	assets/img/products/lido-armchair-Nbi6go.webp	t	3	2026-07-16 08:02:29	2026-07-16 08:02:29
a24562da-657b-4763-9134-f3863e132ed7	a24562d9-1ee6-4e86-a75b-952d5f0d10c1	assets/img/products/lido-armchair-aidCrg.webp	f	4	2026-07-16 08:02:29	2026-07-16 08:02:29
a245643d-439f-40d8-b91a-a15b8372c612	a245643c-a99a-4448-9dc0-f20d9082fb64	assets/img/products/barton-storage-ottoman-jxofgB.webp	t	1	2026-07-16 08:06:21	2026-07-16 08:06:21
a245643d-4ef0-4c66-8536-0ec0cd414b40	a245643c-a99a-4448-9dc0-f20d9082fb64	assets/img/products/barton-storage-ottoman-BqU4Uj.webp	f	2	2026-07-16 08:06:21	2026-07-16 08:06:21
a245643d-595e-46ea-8c47-9edd8c62fb95	a245643c-a99a-4448-9dc0-f20d9082fb64	assets/img/products/barton-storage-ottoman-xxaBoc.webp	f	3	2026-07-16 08:06:21	2026-07-16 08:06:21
a245643d-650f-4872-9572-2afadcfdbd58	a245643c-a99a-4448-9dc0-f20d9082fb64	assets/img/products/barton-storage-ottoman-388gVM.webp	f	4	2026-07-16 08:06:21	2026-07-16 08:06:21
a24565c0-e5f6-4ced-b446-1dc2c0e2e4f1	a24565c0-505d-4bf4-b550-646996c0b641	assets/img/products/kova-box-cushion-ottoman-4TJJfk.webp	t	1	2026-07-16 08:10:35	2026-07-16 08:10:35
a24565c0-efc6-4a17-8558-0cabc060ecdc	a24565c0-505d-4bf4-b550-646996c0b641	assets/img/products/kova-box-cushion-ottoman-Jg2t3v.webp	f	2	2026-07-16 08:10:35	2026-07-16 08:10:35
a24565c0-fa9b-41f7-abfa-ab237a1835b5	a24565c0-505d-4bf4-b550-646996c0b641	assets/img/products/kova-box-cushion-ottoman-jpXylu.webp	f	3	2026-07-16 08:10:35	2026-07-16 08:10:35
a24565c1-05ec-41bd-aad0-153acc7a9b7b	a24565c0-505d-4bf4-b550-646996c0b641	assets/img/products/kova-box-cushion-ottoman-LXd9GX.webp	f	4	2026-07-16 08:10:35	2026-07-16 08:10:35
a24566f7-49a2-4c5e-9272-b8f5865bff63	a24566f6-ae7b-4f50-bec9-69f9627fc646	assets/img/products/kova-pillow-cushion-ottoman-KonG3g.webp	t	1	2026-07-16 08:13:59	2026-07-16 08:13:59
a24566f7-54da-43cd-b823-df033f84c3ab	a24566f6-ae7b-4f50-bec9-69f9627fc646	assets/img/products/kova-pillow-cushion-ottoman-PevjEt.webp	f	2	2026-07-16 08:13:59	2026-07-16 08:13:59
a24566f7-5ece-49e1-8461-18f230fded10	a24566f6-ae7b-4f50-bec9-69f9627fc646	assets/img/products/kova-pillow-cushion-ottoman-ytYMzB.webp	f	3	2026-07-16 08:13:59	2026-07-16 08:13:59
a24566f7-695e-46c2-9995-1c4b049740f6	a24566f6-ae7b-4f50-bec9-69f9627fc646	assets/img/products/kova-pillow-cushion-ottoman-TKwpPi.webp	f	4	2026-07-16 08:13:59	2026-07-16 08:13:59
a245686b-1630-4171-9d52-af211732201c	a245686a-76f2-445e-a38b-0b7ff92cc91e	assets/img/products/kova-pillow-cushion-armless-ljOuop.webp	t	1	2026-07-16 08:18:02	2026-07-16 08:18:02
a245686b-207c-4d35-891c-161f32f8f492	a245686a-76f2-445e-a38b-0b7ff92cc91e	assets/img/products/kova-pillow-cushion-armless-z1Ax9f.webp	f	2	2026-07-16 08:18:02	2026-07-16 08:18:02
a245686b-2be7-410f-b643-b4a6640a7a9e	a245686a-76f2-445e-a38b-0b7ff92cc91e	assets/img/products/kova-pillow-cushion-armless-Olzs1w.webp	f	3	2026-07-16 08:18:02	2026-07-16 08:18:02
a245686b-3771-41f3-9ba9-d14254cae3dd	a245686a-76f2-445e-a38b-0b7ff92cc91e	assets/img/products/kova-pillow-cushion-armless-hzoyn3.webp	f	4	2026-07-16 08:18:03	2026-07-16 08:18:03
\.


--
-- TOC entry 3544 (class 0 OID 16713)
-- Dependencies: 231
-- Data for Name: product_shipping_and_return; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.product_shipping_and_return (id, product_id, shipping_info, return_policy, created_at, updated_at) FROM stdin;
a243280b-5610-415b-b307-73cde7f93f8e	a2432809-bb0f-40f3-a830-4233c23fd48c	We offer two forms of delivery: Threshold Delivery and White Glove Delivery.\r\n\r\nWith free Threshold Delivery, your order will be delivered to the doorstep of your home or lobby of your building, no matter your order's size or value.\r\n\r\nIf you choose White Glove Delivery, for $149 your order will be delivered to your room(s) of choice, unpacked, assembled, and with all packaging removed.\r\n\r\nWe deliver to the 48 contiguous states & Washington D.C. Currently, we do not ship to Alaska, Hawaii, or US territories.	We take great pride in the quality and craftsmanship of our furniture. If you’re not completely satisfied, you may return items within 30 days of delivery for a 20% return fee.\r\n\r\nWe offer complimentary white glove pickup service for all returns. All you need to do is schedule pickup with our team and have the original items ready.\r\n\r\nAll returns must be in “like new” condition — meaning no stains, tears, damage, or signs of use, including noticeable odors. Please be sure to include all parts and hardware.	2026-07-15 05:26:23	2026-07-15 05:26:23
a2432cac-1fce-4d58-8225-d4529febf86c	a2432cab-5f7e-4ad3-a88b-440440ad08a7	We offer two forms of delivery: Threshold Delivery and White Glove Delivery.\r\n\r\nWith free Threshold Delivery, your order will be delivered to the doorstep of your home or lobby of your building, no matter your order's size or value.\r\n\r\nIf you choose White Glove Delivery, for $149 your order will be delivered to your room(s) of choice, unpacked, assembled, and with all packaging removed.\r\n\r\nWe deliver to the 48 contiguous states & Washington D.C. Currently, we do not ship to Alaska, Hawaii, or US territories.	We take great pride in the quality and craftsmanship of our furniture. If you’re not completely satisfied, you may return items within 30 days of delivery for a 20% return fee.\r\n\r\nWe offer complimentary white glove pickup service for all returns. All you need to do is schedule pickup with our team and have the original items ready.\r\n\r\nAll returns must be in “like new” condition — meaning no stains, tears, damage, or signs of use, including noticeable odors. Please be sure to include all parts and hardware.	2026-07-15 05:39:19	2026-07-15 05:39:19
a2454bbd-8ec3-4335-945e-79894457ce06	a2454bbc-008f-4f0a-a525-91e7ac1f40a6	We offer two forms of delivery: Threshold Delivery and White Glove Delivery.\r\n\r\nWith free Threshold Delivery, your order will be delivered to the doorstep of your home or lobby of your building, no matter your order's size or value.\r\n\r\nIf you choose White Glove Delivery, for $149 your order will be delivered to your room(s) of choice, unpacked, assembled, and with all packaging removed.\r\n\r\nWe deliver to the 48 contiguous states & Washington D.C. Currently, we do not ship to Alaska, Hawaii, or US territories.	We take great pride in the quality and craftsmanship of our furniture. If you’re not completely satisfied, you may return items within 30 days of delivery for a 20% return fee.\r\n\r\nWe offer complimentary white glove pickup service for all returns. All you need to do is schedule pickup with our team and have the original items ready.\r\n\r\nAll returns must be in “like new” condition — meaning no stains, tears, damage, or signs of use, including noticeable odors. Please be sure to include all parts and hardware.	2026-07-16 06:57:51	2026-07-16 06:57:51
a2454ddc-1e2e-4091-8674-5c94ce260408	a2454ddb-4660-492b-981a-e87366d6122a	We offer two forms of delivery: Threshold Delivery and White Glove Delivery.\r\n\r\nWith free Threshold Delivery, your order will be delivered to the doorstep of your home or lobby of your building, no matter your order's size or value.\r\n\r\nIf you choose White Glove Delivery, for $149 your order will be delivered to your room(s) of choice, unpacked, assembled, and with all packaging removed.\r\n\r\nWe deliver to the 48 contiguous states & Washington D.C. Currently, we do not ship to Alaska, Hawaii, or US territories.	We take great pride in the quality and craftsmanship of our furniture. If you’re not completely satisfied, you may return items within 30 days of delivery for a 20% return fee.\r\n\r\nWe offer complimentary white glove pickup service for all returns. All you need to do is schedule pickup with our team and have the original items ready.\r\n\r\nAll returns must be in “like new” condition — meaning no stains, tears, damage, or signs of use, including noticeable odors. Please be sure to include all parts and hardware.	2026-07-16 07:03:47	2026-07-16 07:03:47
a2454f2e-6612-4f50-a57f-8f8192eabc68	a2454f2d-b7b7-45d7-9aa5-b10da64ea40d	We offer two forms of delivery: Threshold Delivery and White Glove Delivery.\r\n\r\nWith free Threshold Delivery, your order will be delivered to the doorstep of your home or lobby of your building, no matter your order's size or value.\r\n\r\nIf you choose White Glove Delivery, for $149 your order will be delivered to your room(s) of choice, unpacked, assembled, and with all packaging removed.\r\n\r\nWe deliver to the 48 contiguous states & Washington D.C. Currently, we do not ship to Alaska, Hawaii, or US territories.	We take great pride in the quality and craftsmanship of our furniture. If you’re not completely satisfied, you may return items within 30 days of delivery for a 20% return fee.\r\n\r\nWe offer complimentary white glove pickup service for all returns. All you need to do is schedule pickup with our team and have the original items ready.\r\n\r\nAll returns must be in “like new” condition — meaning no stains, tears, damage, or signs of use, including noticeable odors. Please be sure to include all parts and hardware.	2026-07-16 07:07:28	2026-07-16 07:07:28
a24550a1-6380-49ad-8e62-22f23ac37286	a24550a0-8608-4b0f-a913-7d05a4ef0e7c	We offer two forms of delivery: Threshold Delivery and White Glove Delivery.\r\n\r\nWith free Threshold Delivery, your order will be delivered to the doorstep of your home or lobby of your building, no matter your order's size or value.\r\n\r\nIf you choose White Glove Delivery, for $149 your order will be delivered to your room(s) of choice, unpacked, assembled, and with all packaging removed.\r\n\r\nWe deliver to the 48 contiguous states & Washington D.C. Currently, we do not ship to Alaska, Hawaii, or US territories.	We take great pride in the quality and craftsmanship of our furniture. If you’re not completely satisfied, you may return items within 30 days of delivery for a 20% return fee.\r\n\r\nWe offer complimentary white glove pickup service for all returns. All you need to do is schedule pickup with our team and have the original items ready.\r\n\r\nAll returns must be in “like new” condition — meaning no stains, tears, damage, or signs of use, including noticeable odors. Please be sure to include all parts and hardware.	2026-07-16 07:11:31	2026-07-16 07:11:31
a245524a-e814-437c-b5d6-699d9d3ad6f7	a245524a-1bdb-41c2-872d-c597edd0176d	We offer two forms of delivery: Threshold Delivery and White Glove Delivery.\r\n\r\nWith free Threshold Delivery, your order will be delivered to the doorstep of your home or lobby of your building, no matter your order's size or value.\r\n\r\nIf you choose White Glove Delivery, for $149 your order will be delivered to your room(s) of choice, unpacked, assembled, and with all packaging removed.\r\n\r\nWe deliver to the 48 contiguous states & Washington D.C. Currently, we do not ship to Alaska, Hawaii, or US territories.	We take great pride in the quality and craftsmanship of our furniture. If you’re not completely satisfied, you may return items within 30 days of delivery for a 20% return fee.\r\n\r\nWe offer complimentary white glove pickup service for all returns. All you need to do is schedule pickup with our team and have the original items ready.\r\n\r\nAll returns must be in “like new” condition — meaning no stains, tears, damage, or signs of use, including noticeable odors. Please be sure to include all parts and hardware.	2026-07-16 07:16:10	2026-07-16 07:16:10
a24553a9-eb64-49b1-b0da-3ef01467c814	a24553a9-174a-4f53-89c5-95bb2d50548d	We offer two forms of delivery: Threshold Delivery and White Glove Delivery.\r\n\r\nWith free Threshold Delivery, your order will be delivered to the doorstep of your home or lobby of your building, no matter your order's size or value.\r\n\r\nIf you choose White Glove Delivery, for $149 your order will be delivered to your room(s) of choice, unpacked, assembled, and with all packaging removed.\r\n\r\nWe deliver to the 48 contiguous states & Washington D.C. Currently, we do not ship to Alaska, Hawaii, or US territories.	We take great pride in the quality and craftsmanship of our furniture. If you’re not completely satisfied, you may return items within 30 days of delivery for a 20% return fee.\r\n\r\nWe offer complimentary white glove pickup service for all returns. All you need to do is schedule pickup with our team and have the original items ready.\r\n\r\nAll returns must be in “like new” condition — meaning no stains, tears, damage, or signs of use, including noticeable odors. Please be sure to include all parts and hardware.	2026-07-16 07:20:00	2026-07-16 07:20:00
a245551d-39be-40ee-ae9d-d92eb311d484	a245551c-7238-4887-b526-22ae6fe17c04	We offer two forms of delivery: Threshold Delivery and White Glove Delivery.\r\n\r\nWith free Threshold Delivery, your order will be delivered to the doorstep of your home or lobby of your building, no matter your order's size or value.\r\n\r\nIf you choose White Glove Delivery, for $149 your order will be delivered to your room(s) of choice, unpacked, assembled, and with all packaging removed.\r\n\r\nWe deliver to the 48 contiguous states & Washington D.C. Currently, we do not ship to Alaska, Hawaii, or US territories.	We offer two forms of delivery: Threshold Delivery and White Glove Delivery.\r\n\r\nWith free Threshold Delivery, your order will be delivered to the doorstep of your home or lobby of your building, no matter your order's size or value.\r\n\r\nIf you choose White Glove Delivery, for $149 your order will be delivered to your room(s) of choice, unpacked, assembled, and with all packaging removed.\r\n\r\nWe deliver to the 48 contiguous states & Washington D.C. Currently, we do not ship to Alaska, Hawaii, or US territories.	2026-07-16 07:24:04	2026-07-16 07:24:04
a24559cf-1fac-4aa2-960d-2472091f6bf7	a24559ce-5c00-4381-b53b-09ba738ca10d	We offer two forms of delivery: Threshold Delivery and White Glove Delivery.\r\n\r\nWith free Threshold Delivery, your order will be delivered to the doorstep of your home or lobby of your building, no matter your order's size or value.\r\n\r\nIf you choose White Glove Delivery, for $149 your order will be delivered to your room(s) of choice, unpacked, assembled, and with all packaging removed.\r\n\r\nWe deliver to the 48 contiguous states & Washington D.C. Currently, we do not ship to Alaska, Hawaii, or US territories.	We take great pride in the quality and craftsmanship of our furniture. If you’re not completely satisfied, you may return items within 30 days of delivery for a 20% return fee.\r\n\r\nWe offer complimentary white glove pickup service for all returns. All you need to do is schedule pickup with our team and have the original items ready.\r\n\r\nAll returns must be in “like new” condition — meaning no stains, tears, damage, or signs of use, including noticeable odors. Please be sure to include all parts and hardware.	2026-07-16 07:37:11	2026-07-16 07:37:11
a2455b0c-61eb-4f20-b92b-aa3e415a6348	a2455b0b-9412-4eb5-ae0c-439947b2563c	We offer two forms of delivery: Threshold Delivery and White Glove Delivery.\r\n\r\nWith free Threshold Delivery, your order will be delivered to the doorstep of your home or lobby of your building, no matter your order's size or value.\r\n\r\nIf you choose White Glove Delivery, for $149 your order will be delivered to your room(s) of choice, unpacked, assembled, and with all packaging removed.\r\n\r\nWe deliver to the 48 contiguous states & Washington D.C. Currently, we do not ship to Alaska, Hawaii, or US territories.	We take great pride in the quality and craftsmanship of our furniture. If you’re not completely satisfied, you may return items within 30 days of delivery for a 20% return fee.\r\n\r\nWe offer complimentary white glove pickup service for all returns. All you need to do is schedule pickup with our team and have the original items ready.\r\n\r\nAll returns must be in “like new” condition — meaning no stains, tears, damage, or signs of use, including noticeable odors. Please be sure to include all parts and hardware.	2026-07-16 07:40:39	2026-07-16 07:40:39
a2455cb7-248b-4691-bc03-2b1e83449f50	a2455cb6-4801-4adf-93ab-ac9d940cb03e	We offer two forms of delivery: Threshold Delivery and White Glove Delivery.\r\n\r\nWith free Threshold Delivery, your order will be delivered to the doorstep of your home or lobby of your building, no matter your order's size or value.\r\n\r\nIf you choose White Glove Delivery, for $149 your order will be delivered to your room(s) of choice, unpacked, assembled, and with all packaging removed.\r\n\r\nWe deliver to the 48 contiguous states & Washington D.C. Currently, we do not ship to Alaska, Hawaii, or US territories.	We take great pride in the quality and craftsmanship of our furniture. If you’re not completely satisfied, you may return items within 30 days of delivery for a 20% return fee.\r\n\r\nWe offer complimentary white glove pickup service for all returns. All you need to do is schedule pickup with our team and have the original items ready.\r\n\r\nAll returns must be in “like new” condition — meaning no stains, tears, damage, or signs of use, including noticeable odors. Please be sure to include all parts and hardware.	2026-07-16 07:45:19	2026-07-16 07:45:19
a2455e46-3254-4815-8989-419b16fb3553	a2455e45-86fe-4b27-af33-b393ee89a5f9	We offer two forms of delivery: Threshold Delivery and White Glove Delivery.\r\n\r\nWith free Threshold Delivery, your order will be delivered to the doorstep of your home or lobby of your building, no matter your order's size or value.\r\n\r\nIf you choose White Glove Delivery, for $149 your order will be delivered to your room(s) of choice, unpacked, assembled, and with all packaging removed.\r\n\r\nWe deliver to the 48 contiguous states & Washington D.C. Currently, we do not ship to Alaska, Hawaii, or US territories.	We take great pride in the quality and craftsmanship of our furniture. If you’re not completely satisfied, you may return items within 30 days of delivery for a 20% return fee.\r\n\r\nWe offer complimentary white glove pickup service for all returns. All you need to do is schedule pickup with our team and have the original items ready.\r\n\r\nAll returns must be in “like new” condition — meaning no stains, tears, damage, or signs of use, including noticeable odors. Please be sure to include all parts and hardware.	2026-07-16 07:49:41	2026-07-16 07:49:41
a245603d-505a-4805-9088-954ff3c805c3	a245603c-48eb-4acd-84c2-43ff2ca9db46	We offer two forms of delivery: Threshold Delivery and White Glove Delivery.\r\n\r\nWith free Threshold Delivery, your order will be delivered to the doorstep of your home or lobby of your building, no matter your order's size or value.\r\n\r\nIf you choose White Glove Delivery, for $149 your order will be delivered to your room(s) of choice, unpacked, assembled, and with all packaging removed.\r\n\r\nWe deliver to the 48 contiguous states & Washington D.C. Currently, we do not ship to Alaska, Hawaii, or US territories.	We take great pride in the quality and craftsmanship of our furniture. If you’re not completely satisfied, you may return items within 30 days of delivery for a 20% return fee.\r\n\r\nWe offer complimentary white glove pickup service for all returns. All you need to do is schedule pickup with our team and have the original items ready.\r\n\r\nAll returns must be in “like new” condition — meaning no stains, tears, damage, or signs of use, including noticeable odors. Please be sure to include all parts and hardware.	2026-07-16 07:55:10	2026-07-16 07:55:10
a2456184-9abc-4228-80f7-e56d2683be24	a2456183-c1c0-41f6-9049-5bc97cc8fb07	We offer two forms of delivery: Threshold Delivery and White Glove Delivery.\r\n\r\nWith free Threshold Delivery, your order will be delivered to the doorstep of your home or lobby of your building, no matter your order's size or value.\r\n\r\nIf you choose White Glove Delivery, for $149 your order will be delivered to your room(s) of choice, unpacked, assembled, and with all packaging removed.\r\n\r\nWe deliver to the 48 contiguous states & Washington D.C. Currently, we do not ship to Alaska, Hawaii, or US territories.	We take great pride in the quality and craftsmanship of our furniture. If you’re not completely satisfied, you may return items within 30 days of delivery for a 20% return fee.\r\n\r\nWe offer complimentary white glove pickup service for all returns. All you need to do is schedule pickup with our team and have the original items ready.\r\n\r\nAll returns must be in “like new” condition — meaning no stains, tears, damage, or signs of use, including noticeable odors. Please be sure to include all parts and hardware.	2026-07-16 07:58:45	2026-07-16 07:58:45
a24562da-ae5a-4b65-a873-e3ae8bf711bc	a24562d9-1ee6-4e86-a75b-952d5f0d10c1	We offer two forms of delivery: Threshold Delivery and White Glove Delivery.\r\n\r\nWith free Threshold Delivery, your order will be delivered to the doorstep of your home or lobby of your building, no matter your order's size or value.\r\n\r\nIf you choose White Glove Delivery, for $149 your order will be delivered to your room(s) of choice, unpacked, assembled, and with all packaging removed.\r\n\r\nWe deliver to the 48 contiguous states & Washington D.C. Currently, we do not ship to Alaska, Hawaii, or US territories.	We take great pride in the quality and craftsmanship of our furniture. If you’re not completely satisfied, you may return items within 30 days of delivery for a 20% return fee.\r\n\r\nWe offer complimentary white glove pickup service for all returns. All you need to do is schedule pickup with our team and have the original items ready.\r\n\r\nAll returns must be in “like new” condition — meaning no stains, tears, damage, or signs of use, including noticeable odors. Please be sure to include all parts and hardware.	2026-07-16 08:02:29	2026-07-16 08:02:29
a245643d-928d-4db1-ab92-de9a45fd8932	a245643c-a99a-4448-9dc0-f20d9082fb64	We offer two forms of delivery: Threshold Delivery and White Glove Delivery.\r\n\r\nWith free Threshold Delivery, your order will be delivered to the doorstep of your home or lobby of your building, no matter your order's size or value.\r\n\r\nIf you choose White Glove Delivery, for $149 your order will be delivered to your room(s) of choice, unpacked, assembled, and with all packaging removed.\r\n\r\nWe deliver to the 48 contiguous states & Washington D.C. Currently, we do not ship to Alaska, Hawaii, or US territories.	We take great pride in the quality and craftsmanship of our furniture. If you’re not completely satisfied, you may return items within 30 days of delivery for a 20% return fee.\r\n\r\nWe offer complimentary white glove pickup service for all returns. All you need to do is schedule pickup with our team and have the original items ready.\r\n\r\nAll returns must be in “like new” condition — meaning no stains, tears, damage, or signs of use, including noticeable odors. Please be sure to include all parts and hardware.	2026-07-16 08:06:21	2026-07-16 08:06:21
a24565c1-2e00-426e-adfa-51f32ca4ac82	a24565c0-505d-4bf4-b550-646996c0b641	We offer two forms of delivery: Threshold Delivery and White Glove Delivery.\r\n\r\nWith free Threshold Delivery, your order will be delivered to the doorstep of your home or lobby of your building, no matter your order's size or value.\r\n\r\nIf you choose White Glove Delivery, for $149 your order will be delivered to your room(s) of choice, unpacked, assembled, and with all packaging removed.\r\n\r\nWe deliver to the 48 contiguous states & Washington D.C. Currently, we do not ship to Alaska, Hawaii, or US territories.	We take great pride in the quality and craftsmanship of our furniture. If you’re not completely satisfied, you may return items within 30 days of delivery for a 20% return fee.\r\n\r\nWe offer complimentary white glove pickup service for all returns. All you need to do is schedule pickup with our team and have the original items ready.\r\n\r\nAll returns must be in “like new” condition — meaning no stains, tears, damage, or signs of use, including noticeable odors. Please be sure to include all parts and hardware.	2026-07-16 08:10:36	2026-07-16 08:10:36
a24566f7-93d1-4d40-bd11-3254791a1a17	a24566f6-ae7b-4f50-bec9-69f9627fc646	We offer two forms of delivery: Threshold Delivery and White Glove Delivery.\r\n\r\nWith free Threshold Delivery, your order will be delivered to the doorstep of your home or lobby of your building, no matter your order's size or value.\r\n\r\nIf you choose White Glove Delivery, for $149 your order will be delivered to your room(s) of choice, unpacked, assembled, and with all packaging removed.\r\n\r\nWe deliver to the 48 contiguous states & Washington D.C. Currently, we do not ship to Alaska, Hawaii, or US territories.	We take great pride in the quality and craftsmanship of our furniture. If you’re not completely satisfied, you may return items within 30 days of delivery for a 20% return fee.\r\n\r\nWe offer complimentary white glove pickup service for all returns. All you need to do is schedule pickup with our team and have the original items ready.\r\n\r\nAll returns must be in “like new” condition — meaning no stains, tears, damage, or signs of use, including noticeable odors. Please be sure to include all parts and hardware.	2026-07-16 08:13:59	2026-07-16 08:13:59
a245686b-63be-4e42-9b19-1421600a2ec4	a245686a-76f2-445e-a38b-0b7ff92cc91e	We offer two forms of delivery: Threshold Delivery and White Glove Delivery.\r\n\r\nWith free Threshold Delivery, your order will be delivered to the doorstep of your home or lobby of your building, no matter your order's size or value.\r\n\r\nIf you choose White Glove Delivery, for $149 your order will be delivered to your room(s) of choice, unpacked, assembled, and with all packaging removed.\r\n\r\nWe deliver to the 48 contiguous states & Washington D.C. Currently, we do not ship to Alaska, Hawaii, or US territories.	We take great pride in the quality and craftsmanship of our furniture. If you’re not completely satisfied, you may return items within 30 days of delivery for a 20% return fee.\r\n\r\nWe offer complimentary white glove pickup service for all returns. All you need to do is schedule pickup with our team and have the original items ready.\r\n\r\nAll returns must be in “like new” condition — meaning no stains, tears, damage, or signs of use, including noticeable odors. Please be sure to include all parts and hardware.	2026-07-16 08:18:03	2026-07-16 08:18:03
\.


--
-- TOC entry 3539 (class 0 OID 16648)
-- Dependencies: 226
-- Data for Name: products; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.products (id, name, slug, sku, description, material, price, stock, is_active, created_at, updated_at) FROM stdin;
a2432809-bb0f-40f3-a830-4233c23fd48c	Kova Pillow Cushion Sofa	kova-pillow-cushion-sofa	SF-KOVA-122	Featuring a pillow seat cushion and extra-deep frame, the Kova Pillow Cushion is the perfect choice for those looking for laid-back comfort. Its modular design adapts seamlessly to any space, allowing for easy reconfiguration to suit changing layouts and needs. The plush pillow seat cushions create a relaxed, inviting feel, adding a sense of casual luxury that’s perfect for lounging. Made with hypoallergenic, vegan materials, these cushions offer exceptional sink-in comfort without sacrificing durability, making the Kova Pillow Cushion a chic choice for any home.	Kain Linen	2000000.00	10	t	2026-07-15 05:26:22	2026-07-15 05:26:22
a2432cab-5f7e-4ad3-a88b-440440ad08a7	Lido Chaise Sectional	lido-chaise-sectional	SF-LIDO-122	Rejoice in style and comfort that’s elegantly elevated. The Lido Collection lifts you up with its light, modern design and slim legs. Designed for luxe lounging, our Lido Chaise gives you all the room you need to stretch out.	Kain Linen	100000.00	19	t	2026-07-15 05:39:19	2026-07-15 05:39:19
a2454bbc-008f-4f0a-a525-91e7ac1f40a6	Kova Box Cushion L-Shape + Ottoman	kova-box-cushion-l-shape-ottoman	SF-KOVA-LSHAPE	Designed for lounging and living, the Kova Box Cushion features an extra-deep frame and box-style cushions, giving it clean, tailored lines. Offering a more structured look that complements a range of interior styles, the box cushions maintain their shape beautifully, providing lasting comfort without the need to fluff. With hypoallergenic, vegan materials and durable construction, the Kova Box Cushion perfectly blends the need for lounging while maintaining a sophisticated look for everyday living. Features a modular design that allows you to easily rearrange and add on pieces to fit your changing needs.	Kain Linen	2000000.00	10	t	2026-07-16 06:57:51	2026-07-16 06:57:51
a2454ddb-4660-492b-981a-e87366d6122a	Barton Sofa	barton-sofa	SF-BARTON	Experience the bliss of boundless comfort and exquisite design. Our Barton sofa balances deep, ultra-plush seats and cushions with a modern low-profile silhouette to give you an on-trend blend ideal for larger spaces.	Kain Linen	200000.00	5	t	2026-07-16 07:03:46	2026-07-16 07:03:46
a2454f2d-b7b7-45d7-9aa5-b10da64ea40d	Lido Sofa 86	lido-sofa-86	SF-LIDO-86	Everything you love about our Lido collection — with more room for relaxing. This wider sofa gives you all the space you need to unwind in style with modern lines, slim legs and an impeccable tailor-like attention to detail.	Kain Linen	2000000.00	13	t	2026-07-16 07:07:28	2026-07-16 07:07:28
a24550a0-8608-4b0f-a913-7d05a4ef0e7c	Lido Sofa 75	lido-sofa-75	SF-LIDO-75	Rejoice in style and comfort that’s elegantly elevated. The Lido Collection lifts you up with its light, modern design and slim legs. And while its compact size is perfect for smaller spaces, there’s still plenty of room to relax.	Kain Linen	3500000.00	10	t	2026-07-16 07:11:31	2026-07-16 07:11:31
a245524a-1bdb-41c2-872d-c597edd0176d	Kova Box Cushion Sofa 86	kova-box-cushion-sofa-86	SF-KOVA-BCS86	Designed for lounging and living, the Kova Box Cushion features an extra-deep frame and box-style cushions, giving it clean, tailored lines. Offering a more structured look that complements a range of interior styles, the box cushions maintain their shape beautifully, providing lasting comfort without the need to fluff. With hypoallergenic, vegan materials and durable construction, the Kova Box Cushion perfectly blends the need for lounging while maintaining a sophisticated look for everyday living. Features a modular design that allows you to easily rearrange and add on pieces to fit your changing needs.	Kain Linen	4500000.00	12	t	2026-07-16 07:16:10	2026-07-16 07:16:10
a24553a9-174a-4f53-89c5-95bb2d50548d	Kova Pillow Cushion Sofa 86" + Ottoman	kova-pillow-cushion-sofa-86-ottoman	SF-KOVA-PCS86	Featuring a pillow seat cushion and extra-deep frame, the Kova Pillow Cushion is the perfect choice for those looking for laid-back comfort. Its modular design adapts seamlessly to any space, allowing for easy reconfiguration to suit changing layouts and needs. The plush pillow seat cushions create a relaxed, inviting feel, adding a sense of casual luxury that’s perfect for lounging. Made with hypoallergenic, vegan materials, these cushions offer exceptional sink-in comfort without sacrificing durability, making the Kova Pillow Cushion a chic choice for any home.	Kain Linen	2000000.00	5	t	2026-07-16 07:20:00	2026-07-16 07:20:00
a245551c-7238-4887-b526-22ae6fe17c04	Kova Box Cushion Sofa 122	kova-box-cushion-sofa-122	SF-KOVA-BCS122	Designed for lounging and living, the Kova Box Cushion features an extra-deep frame and box-style cushions, giving it clean, tailored lines. Offering a more structured look that complements a range of interior styles, the box cushions maintain their shape beautifully, providing lasting comfort without the need to fluff. With hypoallergenic, vegan materials and durable construction, the Kova Box Cushion perfectly blends the need for lounging while maintaining a sophisticated look for everyday living. Features a modular design that allows you to easily rearrange and add on pieces to fit your changing needs.	Kain Linen	15000000.00	12	t	2026-07-16 07:24:03	2026-07-16 07:24:03
a24559ce-5c00-4381-b53b-09ba738ca10d	Barton Chaise Sectional	barton-chaise-sectional	SF-BARTON-CS	Experience the bliss of boundless comfort and exquisite design. Our Barton Chaise Sectional balances deep, ultra-plush seats and cushions with a modern low-profile silhouette to give you an on-trend blend ideal for larger spaces.	Kain Linen	2390000.00	13	t	2026-07-16 07:37:11	2026-07-16 07:37:11
a2455b0b-9412-4eb5-ae0c-439947b2563c	Barton Armchair	barton-armchair	SF-BARTON-BA	Experience the bliss of boundless comfort and exquisite design. Our Barton armchair balances deep, ultra-plush seats and cushions with a modern low-profile silhouette to give you an on-trend blend ideal for larger spaces.	Kain Linen	100000.00	5	t	2026-07-16 07:40:39	2026-07-16 07:40:39
a2455cb6-4801-4adf-93ab-ac9d940cb03e	Kova Pillow Cushion L-Shape + Ottoman	kova-pillow-cushion-l-shape-ottoman	SF-KOVA-PILLOW-LSHAPE	Featuring a pillow seat cushion and extra-deep frame, the Kova Pillow Cushion is the perfect choice for those looking for laid-back comfort. Its modular design adapts seamlessly to any space, allowing for easy reconfiguration to suit changing layouts and needs. The plush pillow seat cushions create a relaxed, inviting feel, adding a sense of casual luxury that’s perfect for lounging. Made with hypoallergenic, vegan materials, these cushions offer exceptional sink-in comfort without sacrificing durability, making the Kova Pillow Cushion a chic choice for any home.	Kain Linen	249000.00	5	t	2026-07-16 07:45:19	2026-07-16 07:45:19
a2455e45-86fe-4b27-af33-b393ee89a5f9	Kova Pillow Cushion Grand Corner + Ottoman	kova-pillow-cushion-grand-corner-ottoman	SF-KOVA-PCGCO	Featuring a pillow seat cushion and extra-deep frame, the Kova Pillow Cushion is the perfect choice for those looking for laid-back comfort. Its modular design adapts seamlessly to any space, allowing for easy reconfiguration to suit changing layouts and needs. The plush pillow seat cushions create a relaxed, inviting feel, adding a sense of casual luxury that’s perfect for lounging. Made with hypoallergenic, vegan materials, these cushions offer exceptional sink-in comfort without sacrificing durability, making the Kova Pillow Cushion a chic choice for any home.	Kain Linen	5000000.00	5	t	2026-07-16 07:49:40	2026-07-16 07:49:40
a245603c-48eb-4acd-84c2-43ff2ca9db46	Kova Box Cushion Grand Corner + Ottoman	kova-box-cushion-grand-corner-ottoman	SF-KOVA-BOX-CGCO	Designed for lounging and living, the Kova Box Cushion features an extra-deep frame and box-style cushions, giving it clean, tailored lines. Offering a more structured look that complements a range of interior styles, the box cushions maintain their shape beautifully, providing lasting comfort without the need to fluff. With hypoallergenic, vegan materials and durable construction, the Kova Box Cushion perfectly blends the need for lounging while maintaining a sophisticated look for everyday living. Features a modular design that allows you to easily rearrange and add on pieces to fit your changing needs.	Kain Linen	5000000.00	6	t	2026-07-16 07:55:10	2026-07-16 07:55:10
a2456183-c1c0-41f6-9049-5bc97cc8fb07	Kova Pillow Cushion Grand Pit	kova-pillow-cushion-grand-pit	SF-KOVA-PCGP	Featuring a pillow seat cushion and extra-deep frame, the Kova Pillow Cushion is the perfect choice for those looking for laid-back comfort. Its modular design adapts seamlessly to any space, allowing for easy reconfiguration to suit changing layouts and needs. The plush pillow seat cushions create a relaxed, inviting feel, adding a sense of casual luxury that’s perfect for lounging. Made with hypoallergenic, vegan materials, these cushions offer exceptional sink-in comfort without sacrificing durability, making the Kova Pillow Cushion a chic choice for any home.	Kain Linen	499000.00	5	t	2026-07-16 07:58:44	2026-07-16 07:58:44
a24562d9-1ee6-4e86-a75b-952d5f0d10c1	Lido Armchair	lido-armchair	SF-LIDO-ARMCHAIR	Sit and stay awhile with our easy-to-love Lido armchair. It’s the perfect collection complement or standalone accent, featuring a modern design and slim legs.	Kain Linen	349000.00	6	t	2026-07-16 08:02:28	2026-07-16 08:02:28
a245643c-a99a-4448-9dc0-f20d9082fb64	Barton Storage Ottoman	barton-storage-ottoman	SF-BARTON-STORAGE	Experience the bliss of boundless comfort and exquisite design. Our Barton Collection balances deep, ultra-plush seats and cushions with a modern low-profile silhouette to give you an on-trend blend ideal for larger spaces.	Kain Linen	159000.00	12	t	2026-07-16 08:06:21	2026-07-16 08:06:21
a24565c0-505d-4bf4-b550-646996c0b641	Kova Box Cushion Ottoman	kova-box-cushion-ottoman	SF-KOVA-CO	Designed for lounging and living, the Kova Box Cushion features an extra-deep frame and box-style cushions, giving it clean, tailored lines. Offering a more structured look that complements a range of interior styles, the box cushions maintain their shape beautifully, providing lasting comfort without the need to fluff. With hypoallergenic, vegan materials and durable construction, the Kova Box Cushion perfectly blends the need for lounging while maintaining a sophisticated look for everyday living. Features a modular design that allows you to easily rearrange and add on pieces to fit your changing needs.	Kain Linen	399000.00	6	t	2026-07-16 08:10:35	2026-07-16 08:10:35
a24566f6-ae7b-4f50-bec9-69f9627fc646	Kova Pillow Cushion Ottoman	kova-pillow-cushion-ottoman	SF-KOVA-PCO	Featuring a pillow seat cushion and extra-deep frame, the Kova Pillow Cushion is the perfect choice for those looking for laid-back comfort. Its modular design adapts seamlessly to any space, allowing for easy reconfiguration to suit changing layouts and needs. The plush pillow seat cushions create a relaxed, inviting feel, adding a sense of casual luxury that’s perfect for lounging. Made with hypoallergenic, vegan materials, these cushions offer exceptional sink-in comfort without sacrificing durability, making the Kova Pillow Cushion a chic choice for any home.	Kain Linen	399000.00	7	t	2026-07-16 08:13:59	2026-07-16 08:13:59
a245686a-76f2-445e-a38b-0b7ff92cc91e	Kova Pillow Cushion Armless	kova-pillow-cushion-armless	SF-KOVA-PCA	Featuring a pillow seat cushion and extra-deep frame, the Kova Pillow Cushion is the perfect choice for those looking for laid-back comfort. Its modular design adapts seamlessly to any space, allowing for easy reconfiguration to suit changing layouts and needs. The plush pillow seat cushions create a relaxed, inviting feel, adding a sense of casual luxury that’s perfect for lounging. Made with hypoallergenic, vegan materials, these cushions offer exceptional sink-in comfort without sacrificing durability, making the Kova Pillow Cushion a chic choice for any home.	Kain Linen	399000.00	5	t	2026-07-16 08:18:02	2026-07-16 08:18:02
\.


--
-- TOC entry 3531 (class 0 OID 16596)
-- Dependencies: 218
-- Data for Name: sessions; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) FROM stdin;
xDdUqAXHjfCSoFtwpFV4ojuBU6gnASyEzGegnq2X	\N	192.168.240.1	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36	YTozOntzOjY6Il90b2tlbiI7czo0MDoiODlscExDTk9QU1J4bks0cnFsS0hmdEszejIxNE1NczBUMkRBWXp6ViI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODExOC9wcm9kdWN0cyI7fX0=	1784189972
mPI3kyPsacShq31HaRgvetGbDPWiAbH69DtxN9Is	\N	192.168.240.1	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36	YTozOntzOjY6Il90b2tlbiI7czo0MDoiN2hleGdjSnZHZURNc1VFS2Y2dU94M051Nk05dGh0OEs0WUNuZUVqYyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODExOC9sb2dpbiI7fX0=	1784174737
\.


--
-- TOC entry 3529 (class 0 OID 16580)
-- Dependencies: 216
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at) FROM stdin;
a24324bf-de2a-4f80-9101-ee8a24a76920	Administrator	admin@wonosofa.my.id	\N	$2y$12$0AzIdmtZjRlHORF93j9XaOReqa/JOm2S6Uyj3DLvnyKgkjk/22PQq	\N	2026-07-15 05:17:11	2026-07-15 05:17:11
\.


--
-- TOC entry 3553 (class 0 OID 0)
-- Dependencies: 224
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- TOC entry 3554 (class 0 OID 0)
-- Dependencies: 221
-- Name: jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.jobs_id_seq', 1, false);


--
-- TOC entry 3555 (class 0 OID 0)
-- Dependencies: 214
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.migrations_id_seq', 9, true);


--
-- TOC entry 3345 (class 2606 OID 16618)
-- Name: cache_locks cache_locks_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cache_locks
    ADD CONSTRAINT cache_locks_pkey PRIMARY KEY (key);


--
-- TOC entry 3343 (class 2606 OID 16611)
-- Name: cache cache_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cache
    ADD CONSTRAINT cache_pkey PRIMARY KEY (key);


--
-- TOC entry 3365 (class 2606 OID 16680)
-- Name: colors colors_name_unique; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.colors
    ADD CONSTRAINT colors_name_unique UNIQUE (name);


--
-- TOC entry 3367 (class 2606 OID 16678)
-- Name: colors colors_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.colors
    ADD CONSTRAINT colors_pkey PRIMARY KEY (id);


--
-- TOC entry 3352 (class 2606 OID 16645)
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- TOC entry 3354 (class 2606 OID 16647)
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- TOC entry 3350 (class 2606 OID 16635)
-- Name: job_batches job_batches_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.job_batches
    ADD CONSTRAINT job_batches_pkey PRIMARY KEY (id);


--
-- TOC entry 3347 (class 2606 OID 16627)
-- Name: jobs jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.jobs
    ADD CONSTRAINT jobs_pkey PRIMARY KEY (id);


--
-- TOC entry 3331 (class 2606 OID 16579)
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- TOC entry 3337 (class 2606 OID 16595)
-- Name: password_reset_tokens password_reset_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);


--
-- TOC entry 3369 (class 2606 OID 16698)
-- Name: product_color product_color_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.product_color
    ADD CONSTRAINT product_color_pkey PRIMARY KEY (id);


--
-- TOC entry 3371 (class 2606 OID 16696)
-- Name: product_color product_color_product_id_color_id_unique; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.product_color
    ADD CONSTRAINT product_color_product_id_color_id_unique UNIQUE (product_id, color_id);


--
-- TOC entry 3373 (class 2606 OID 16710)
-- Name: product_dimensions product_dimensions_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.product_dimensions
    ADD CONSTRAINT product_dimensions_pkey PRIMARY KEY (id);


--
-- TOC entry 3375 (class 2606 OID 16712)
-- Name: product_dimensions product_dimensions_product_id_unique; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.product_dimensions
    ADD CONSTRAINT product_dimensions_product_id_unique UNIQUE (product_id);


--
-- TOC entry 3362 (class 2606 OID 16673)
-- Name: product_photos product_photos_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.product_photos
    ADD CONSTRAINT product_photos_pkey PRIMARY KEY (id);


--
-- TOC entry 3377 (class 2606 OID 16724)
-- Name: product_shipping_and_return product_shipping_and_return_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.product_shipping_and_return
    ADD CONSTRAINT product_shipping_and_return_pkey PRIMARY KEY (id);


--
-- TOC entry 3379 (class 2606 OID 16726)
-- Name: product_shipping_and_return product_shipping_and_return_product_id_unique; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.product_shipping_and_return
    ADD CONSTRAINT product_shipping_and_return_product_id_unique UNIQUE (product_id);


--
-- TOC entry 3356 (class 2606 OID 16656)
-- Name: products products_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_pkey PRIMARY KEY (id);


--
-- TOC entry 3358 (class 2606 OID 16660)
-- Name: products products_sku_unique; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_sku_unique UNIQUE (sku);


--
-- TOC entry 3360 (class 2606 OID 16658)
-- Name: products products_slug_unique; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_slug_unique UNIQUE (slug);


--
-- TOC entry 3340 (class 2606 OID 16602)
-- Name: sessions sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);


--
-- TOC entry 3333 (class 2606 OID 16588)
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- TOC entry 3335 (class 2606 OID 16586)
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- TOC entry 3348 (class 1259 OID 16628)
-- Name: jobs_queue_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX jobs_queue_index ON public.jobs USING btree (queue);


--
-- TOC entry 3363 (class 1259 OID 16671)
-- Name: product_photos_product_id_is_primary_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX product_photos_product_id_is_primary_index ON public.product_photos USING btree (product_id, is_primary);


--
-- TOC entry 3338 (class 1259 OID 16604)
-- Name: sessions_last_activity_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);


--
-- TOC entry 3341 (class 1259 OID 16603)
-- Name: sessions_user_id_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);


--
-- TOC entry 3381 (class 2606 OID 16690)
-- Name: product_color product_color_color_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.product_color
    ADD CONSTRAINT product_color_color_id_foreign FOREIGN KEY (color_id) REFERENCES public.colors(id) ON DELETE CASCADE;


--
-- TOC entry 3382 (class 2606 OID 16685)
-- Name: product_color product_color_product_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.product_color
    ADD CONSTRAINT product_color_product_id_foreign FOREIGN KEY (product_id) REFERENCES public.products(id) ON DELETE CASCADE;


--
-- TOC entry 3383 (class 2606 OID 16704)
-- Name: product_dimensions product_dimensions_product_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.product_dimensions
    ADD CONSTRAINT product_dimensions_product_id_foreign FOREIGN KEY (product_id) REFERENCES public.products(id) ON DELETE CASCADE;


--
-- TOC entry 3380 (class 2606 OID 16666)
-- Name: product_photos product_photos_product_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.product_photos
    ADD CONSTRAINT product_photos_product_id_foreign FOREIGN KEY (product_id) REFERENCES public.products(id) ON DELETE CASCADE;


--
-- TOC entry 3384 (class 2606 OID 16718)
-- Name: product_shipping_and_return product_shipping_and_return_product_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.product_shipping_and_return
    ADD CONSTRAINT product_shipping_and_return_product_id_foreign FOREIGN KEY (product_id) REFERENCES public.products(id) ON DELETE CASCADE;


-- Completed on 2026-07-16 15:20:21

--
-- PostgreSQL database dump complete
--

\unrestrict bsaaBjtzpxXQmfiidTswz7gtyObJO3CkrhEia5enaq0eue9lRvysqiPe9Vmb9ti

