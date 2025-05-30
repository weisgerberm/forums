CREATE TABLE tx_forums_domain_model_thread
(
	title                varchar(255) NOT NULL DEFAULT '',
	closed               smallint(1) unsigned NOT NULL DEFAULT '0',
	cached_counter_posts int(11)              NOT NULL DEFAULT '0',
	cached_counter_views int(11)              NOT NULL DEFAULT '0',
	sticky               smallint(1) unsigned NOT NULL DEFAULT '0',
	posts                int(11) unsigned     NOT NULL DEFAULT '0',
	tags                 int(11) unsigned     NOT NULL DEFAULT '0',
	last_posted_on       int(11)              NOT NULL DEFAULT '0',
	subscribers          int(11) unsigned              DEFAULT '0'
);

CREATE TABLE tx_forums_domain_model_post
(
	thread                  int(11) unsigned              DEFAULT '0' NOT NULL,
	frontenduser            int(11) unsigned              DEFAULT '0' NOT NULL,
	quote                   int(11) unsigned              DEFAULT '0' NOT NULL,
	spam                    smallint(1) unsigned NOT NULL DEFAULT '0',
	soft_deleted            smallint(1) unsigned NOT NULL DEFAULT '0',
	awaiting_admin_approval smallint(1) unsigned NOT NULL DEFAULT '0',
	allow_html              smallint(1) unsigned NOT NULL DEFAULT '0',
	admin_comment           text,
	post_content            int(11) unsigned     NOT NULL DEFAULT '0',
	likes                   int(11) unsigned     NOT NULL DEFAULT '0',
	poll                    int(11) unsigned              DEFAULT '0'
);

CREATE TABLE tx_news_domain_model_news
(
	forums_thread int(11) unsigned     NOT NULL DEFAULT '0'
);

CREATE TABLE fe_users
(
	subscribe_to_thread_after_reply smallint(1) unsigned NOT NULL DEFAULT '1',
	thread_subscriptions            int(11) unsigned     NOT NULL DEFAULT '0',
	post_likes                      int(11) unsigned     NOT NULL DEFAULT '0',
	poll_votes                      int(11) unsigned     NOT NULL DEFAULT '0',
	threads_per_page                int(11) unsigned     NOT NULL DEFAULT '10',
	posts_per_page                int(11) unsigned     NOT NULL DEFAULT '20'
);

CREATE TABLE tx_forums_domain_model_threadsubscription
(
	frontenduser     int(11) unsigned DEFAULT '0' NOT NULL,
	thread_reference int(11) unsigned DEFAULT '0'
);

CREATE TABLE tx_forums_domain_model_postcontent
(
	post        int(11) unsigned DEFAULT '0' NOT NULL,
	description text
);

CREATE TABLE tx_forums_domain_model_postreport
(
	description    text NOT NULL DEFAULT '',
	post_reference int(11) unsigned DEFAULT '0',
	frontend_user  int(11) unsigned DEFAULT '0'
);

CREATE TABLE tx_forums_domain_model_postlike
(
	post          int(11) unsigned DEFAULT '0' NOT NULL,
	frontenduser int(11) unsigned DEFAULT '0'
);

CREATE TABLE tx_forums_domain_model_tag
(
	title varchar(255) NOT NULL DEFAULT ''
);

CREATE TABLE tx_forums_domain_model_poll
(
	title        varchar(255) NOT NULL DEFAULT '',
	poll_votes   int(11) unsigned NOT NULL DEFAULT '0',
	poll_options int(11) unsigned NOT NULL DEFAULT '0'
);

CREATE TABLE tx_forums_domain_model_pollvote
(
	frontenduser    int(11) unsigned DEFAULT '0' NOT NULL,
	poll            int(11) unsigned DEFAULT '0' NOT NULL,
	selected_choice int(11) unsigned             NOT NULL DEFAULT '0'
);

CREATE TABLE tx_forums_domain_model_polloption
(
	poll     int(11) unsigned DEFAULT '0' NOT NULL,
	pollvote int(11) unsigned DEFAULT '0' NOT NULL,
	title    varchar(255) NOT NULL DEFAULT ''
);

CREATE TABLE tx_forums_domain_model_privatemessage
(
	frontenduser int(11) unsigned      DEFAULT '0' NOT NULL,
	subject      varchar(255) NOT NULL DEFAULT '',
	content      text,
	sender       int(11) unsigned      DEFAULT '0',
	receiver     int(11) unsigned      DEFAULT '0'
);

CREATE TABLE tx_forums_domain_model_threadstate
(
	last_visit    int(11) NOT NULL DEFAULT '0',
	frontend_user int(11) unsigned DEFAULT '0',
	thread        int(11) unsigned DEFAULT '0'
);

CREATE TABLE tx_forums_domain_model_thread
(
	categories int(11) unsigned DEFAULT '0' NOT NULL
);

CREATE TABLE pages
(
	tx_forums_moderators varchar(255) DEFAULT '' NOT NULL
);
