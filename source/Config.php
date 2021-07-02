<?php

/**
 * DATABASE
 */

    define("CONF_DB_HOST", "www.s3blindagem.com.br");
    define("CONF_DB_USER", "s3blinda_dflix");
    define("CONF_DB_PASS", "dflix7778");
    define("CONF_DB_NAME", "s3blinda_dflix");


/**
 * PROJECT URLs
 */
define("CONF_URL_BASE", "https://www.s3blindagem.com.br");
define("CONF_URL_BASE_DELIVERY", "https://www.s3blindagem.com.br/delivery");
define("CONF_URL_APP", "https://www.s3blindagem.com.br/admin");
define("CONF_URL_TEST", "https://www.s3blindagem.com.br");
define("CONF_URL_ADMIN", "/admin");
define("LINK_ASSETS_APP", "https://www.s3blindagem.com.br/admin");

/**
 * SITE
 */
define("CONF_SITE_NAME", "S3 Blindagem");
define("CONF_SITE_TITLE", "S3 Blindagem Solução Web");
define("CONF_SITE_DESC",
        "S3 Blindagem Automotiva a numero um em blindagem de veiculos");
define("CONF_SITE_LANG", "pt_BR");
define("CONF_SITE_DOMAIN", "s3blindagem.com.br");
define("CONF_SITE_ADDR_STREET", "Sílvio Rodini, 13 ");
define("CONF_SITE_ADDR_NUMBER", "13");
define("CONF_SITE_ADDR_COMPLEMENT", "");
define("CONF_SITE_ADDR_CITY", "Parada Inglesa");
define("CONF_SITE_ADDR_STATE", "SP");
define("CONF_SITE_ADDR_ZIPCODE", "02241-000");
define("CONF_SITE_ADDR_TELEFONE", "(11)9 4700-4525");



/**
 * DATES
 */
define("CONF_DATE_BR", "d/m/Y H:i:s");
define("CONF_DATE_APP", "Y-m-d H:i:s");

/**
 * PASSWORD
 */
define("CONF_PASSWD_MIN_LEN", 8);
define("CONF_PASSWD_MAX_LEN", 40);
define("CONF_PASSWD_ALGO", PASSWORD_DEFAULT);
define("CONF_PASSWD_OPTION", ["cost" => 10]);

/**
 * VIEW
 */
define("CONF_VIEW_PATH", __DIR__ . "/../../shared/views");
define("CONF_VIEW_EXT", "php");
define("CONF_VIEW_THEME", "default");
define("CONF_VIEW_APP", "http://www.dflixcontrol.com.br/themes/admin");
//define("CONF_VIEW_APP", "cafeapp");

/**
 * UPLOAD
 */
define("CONF_UPLOAD_DIR", "storage");
define("CONF_UPLOAD_IMAGE_DIR", "images");
define("CONF_UPLOAD_FILE_DIR", "files");
define("CONF_UPLOAD_MEDIA_DIR", "medias");

/**
 * IMAGES
 */
define("CONF_IMAGE_CACHE", CONF_UPLOAD_DIR . "/" . CONF_UPLOAD_IMAGE_DIR . "/cache");
define("CONF_IMAGE_SIZE", 2000);
define("CONF_IMAGE_QUALITY", ["jpg" => 75, "png" => 5]);

/**
 * MAIL
 */
define("CONF_MAIL_HOST", "mail.bembomdelivery.com.br");
define("CONF_MAIL_PORT", "587");
define("CONF_MAIL_USER", "contato@bembomdelivery.com.br");
define("CONF_MAIL_PASS", "dflix7778");
define("CONF_MAIL_SENDER", ["name" => "Dflix Control", "address" => "suporte@dflixcontrol.com.br"]);
define("CONF_MAIL_SUPPORT", "suporte@dflixcontrol.com.br");
define("CONF_MAIL_OPTION_LANG", "br");
define("CONF_MAIL_OPTION_HTML", true);
define("CONF_MAIL_OPTION_AUTH", true);
define("CONF_MAIL_OPTION_SECURE", "tls");
define("CONF_MAIL_OPTION_CHARSET", "utf-8");

/**
 * PAGAR.ME
 */
define("CONF_PAGARME_MODE", "test");
define("CONF_PAGARME_LIVE", "ak_live_7wFTUfIRHFUuG0LDYI2VZ9BkeQ6XrR");
define("CONF_PAGARME_TEST", "ak_test_7wFTUfIRHFUuG0LDYI2VZ9BkeQ6XrR");
define("CONF_PAGARME_BACK", CONF_URL_BASE) . "/pay/callback";

/**
 * PAGSEGURO
 */

