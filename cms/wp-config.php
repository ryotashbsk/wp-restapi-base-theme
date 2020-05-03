<?php
/**
 * WordPress の基本設定
 *
 * このファイルは、インストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さずにこのファイルを "wp-config.php" という名前でコピーして
 * 直接編集して値を入力してもかまいません。
 *
 * このファイルは、以下の設定を含みます。
 *
 * * MySQL 設定
 * * 秘密鍵
 * * データベーステーブル接頭辞
 * * ABSPATH
 *
 * @link http://wpdocs.osdn.jp/wp-config.php_%E3%81%AE%E7%B7%A8%E9%9B%86
 *
 * @package WordPress
 */

// 注意:
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.osdn.jp/%E7%94%A8%E8%AA%9E%E9%9B%86#.E3.83.86.E3.82.AD.E3.82.B9.E3.83.88.E3.82.A8.E3.83.87.E3.82.A3.E3.82.BF 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** MySQL 設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define( 'DB_NAME', 'wp-rest' );

/** MySQL データベースのユーザー名 */
define( 'DB_USER', 'root' );

/** MySQL データベースのパスワード */
define( 'DB_PASSWORD', 'root' );

/** MySQL のホスト名 */
define( 'DB_HOST', 'localhost' );

/** データベースのテーブルを作成する際のデータベースの文字セット */
define( 'DB_CHARSET', 'utf8mb4' );

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define('DB_COLLATE', '');

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '$3 DL^$kkx9f(S8S8%!7kCRsIg~o<yE[dQnIz-M9zdujq9]?2%#]-izw7/7Sy%Vz' );
define( 'SECURE_AUTH_KEY',  '-sv-V_VHO3 J</XyRu>Mwr<56gpIp$E0On[kE$EPtwL])/n(YpUp/V?4z&:$srJ!' );
define( 'LOGGED_IN_KEY',    'Pfor?0_hZ5/m}B:s~?r)&H!GR4C]*lY,UVKgu;^fo!fB2(<US0O^[jp@T0^t&o/m' );
define( 'NONCE_KEY',        '!i&[^ddW`HOQ3}=C@7jbu<hyG&~MdhZ;10__7%q-~0.X/fD&cceiXp93a:.:vcq}' );
define( 'AUTH_SALT',        'tLsy~;lj?4S|=6gGTG0H()>?(=|IA!9[/8dKw~r~1s#r%t-ZG:D8b%zjb_y/x4+_' );
define( 'SECURE_AUTH_SALT', '2v^6$iiJ[Xm8B1:Eg3!sL7w(d<<((K9|9/2JKFNNy5*Ax|b,#L]&iX,]p215&# G' );
define( 'LOGGED_IN_SALT',   'n)_VR%F2/}WEshrIGy]>u0e#$*}lwV%sY2qcf.fV|Xj5xl/-g Sk*EB`#R~AM 5>' );
define( 'NONCE_SALT',       '9FKU2+>NBB8LHsH5Q`uh>=,WqYN.oM_]tGOI{&A[s~#Y%pC,I=2{)MU#(9/<Ep@B' );

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix = 'wp_';

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 *
 * その他のデバッグに利用できる定数については Codex をご覧ください。
 *
 * @link http://wpdocs.osdn.jp/WordPress%E3%81%A7%E3%81%AE%E3%83%87%E3%83%90%E3%83%83%E3%82%B0
 */
define('WP_DEBUG', false);

/* 編集が必要なのはここまでです ! WordPress でのパブリッシングをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');


/** Disbable Revisions */
define('WP_POST_REVISIONS', false);


/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
