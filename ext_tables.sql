CREATE TABLE tx_forums_domain_model_thread
(
	headline             varchar(255) NOT NULL DEFAULT '',
	closed               smallint(1) unsigned NOT NULL DEFAULT '0',
	cached_counter_posts int(11) NOT NULL DEFAULT '0',
	cached_counter_views int(11) NOT NULL DEFAULT '0',
	sticky               smallint(1) unsigned NOT NULL DEFAULT '0',
	slug                 varchar(255) NOT NULL DEFAULT '',
	files                int(11) unsigned NOT NULL DEFAULT '0',
	posts                int(11) unsigned NOT NULL DEFAULT '0',
	tags                 int(11) unsigned NOT NULL DEFAULT '0',
	active_users         int(11) unsigned DEFAULT '0'
);

CREATE TABLE tx_forums_domain_model_post
(
	thread                  int(11) unsigned DEFAULT '0' NOT NULL,
	frontenduser            int(11) unsigned DEFAULT '0' NOT NULL,
	spam                    smallint(1) unsigned NOT NULL DEFAULT '0',
	awaiting_admin_approval smallint(1) unsigned NOT NULL DEFAULT '0',
	admin_comment           text,
	post_content            int(11) unsigned NOT NULL DEFAULT '0',
	likes                   int(11) unsigned NOT NULL DEFAULT '0',
	poll                    int(11) unsigned DEFAULT '0'
);

CREATE TABLE fe_users
(
	self_description                text,
	frontenduser7                   int(11) unsigned DEFAULT '0' NOT NULL,
	last_activity                   datetime              DEFAULT NULL,
	profile_visits                  int(11) NOT NULL DEFAULT '0',
	social_facebook                 varchar(255) NOT NULL DEFAULT '',
	social_instagram                varchar(255) NOT NULL DEFAULT '',
	social_pinterest                varchar(255) NOT NULL DEFAULT '',
	social_twitter                  varchar(255) NOT NULL DEFAULT '',
	social_youtube                  varchar(255) NOT NULL DEFAULT '',
	prefered_timezone               varchar(255) NOT NULL DEFAULT '',
	allow_email_news                smallint(1) unsigned NOT NULL DEFAULT '0',
	allow_show_online_status        smallint(1) unsigned NOT NULL DEFAULT '0',
	social_steam                    varchar(255) NOT NULL DEFAULT '',
	social_xbox                     varchar(255) NOT NULL DEFAULT '',
	social_psn                      varchar(255) NOT NULL DEFAULT '',
	social_nintendo                 varchar(255) NOT NULL DEFAULT '',
	social_xing                     varchar(255) NOT NULL DEFAULT '',
	threads_per_page                int(11) DEFAULT '0' NOT NULL,
	posts_per_page                  int(11) DEFAULT '0' NOT NULL,
	subscribe_to_thread_after_reply smallint(1) unsigned NOT NULL DEFAULT '0',
	allow_display_email             smallint(1) unsigned NOT NULL DEFAULT '0',
	cached_counter_posts            int(11) NOT NULL DEFAULT '0',
	posts                           int(11) unsigned NOT NULL DEFAULT '0',
	thread_subscriptions            int(11) unsigned NOT NULL DEFAULT '0',
	signatures                      int(11) unsigned NOT NULL DEFAULT '0',
	post_likes                      int(11) unsigned NOT NULL DEFAULT '0',
	poll_votes                      int(11) unsigned NOT NULL DEFAULT '0',
	friends                         int(11) unsigned NOT NULL DEFAULT '0',
	private_messages                int(11) unsigned NOT NULL DEFAULT '0',
	blacklisted_users               int(11) unsigned NOT NULL DEFAULT '0',
	avatar                          int(11) unsigned DEFAULT '0',
	tx_extbase_type                 varchar(255)          DEFAULT '' NOT NULL
);

CREATE TABLE tx_forums_domain_model_threadsubscription
(
	frontenduser     int(11) unsigned DEFAULT '0' NOT NULL,
	thread_reference int(11) unsigned DEFAULT '0'
);

CREATE TABLE tx_forums_domain_model_signature
(
	frontenduser int(11) unsigned DEFAULT '0' NOT NULL,
	activated    smallint(1) unsigned NOT NULL DEFAULT '0',
	content      text
);

CREATE TABLE tx_forums_domain_model_postcontent
(
	post     int(11) unsigned DEFAULT '0' NOT NULL,
	headline varchar(255) NOT NULL DEFAULT '',
	content  text
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
	frontenduser  int(11) unsigned DEFAULT '0' NOT NULL,
	frontend_user int(11) unsigned DEFAULT '0'
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
	selected_choice int(11) unsigned NOT NULL DEFAULT '0'
);

CREATE TABLE tx_forums_domain_model_polloption
(
	poll     int(11) unsigned DEFAULT '0' NOT NULL,
	pollvote int(11) unsigned DEFAULT '0' NOT NULL,
	title    varchar(255) NOT NULL DEFAULT ''
);

CREATE TABLE tx_forums_domain_model_privatemessage
(
	frontenduser int(11) unsigned DEFAULT '0' NOT NULL,
	subject      varchar(255) NOT NULL DEFAULT '',
	content      text,
	sender       int(11) unsigned DEFAULT '0',
	receiver     int(11) unsigned DEFAULT '0'
);

CREATE TABLE tx_forums_domain_model_threadstate
(
	last_visit    int(11) NOT NULL DEFAULT '0',
	frontend_user int(11) unsigned DEFAULT '0',
	thread        int(11) unsigned DEFAULT '0'
);

CREATE TABLE tx_forums_domain_model_avatar
(
	image  int(11) unsigned NOT NULL DEFAULT '0',
	custom smallint(1) unsigned NOT NULL DEFAULT '0'
);

CREATE TABLE tx_forums_domain_model_thread
(
	categories int(11) unsigned DEFAULT '0' NOT NULL
);

##
EXTENSION BUILDER DEFAULTS
END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder

CREATE TABLE pages
(
	tx_forums_moderators varchar(255) DEFAULT '' NOT NULL
);
