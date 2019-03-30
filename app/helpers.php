<?php
// 根据环境不同配置数据库
function get_db_config()
{
    if (getenv('IS_IN_HEROKU')){
        $url = parse_url(getenv('DATABASE_URL'));
        return $db_config = [
            'connection' => 'pgsql',
            'host' => $url["host"],
            'database'  => substr($url["path"], 1),
            'username'  => $url["user"],
            'password'  => $url["pass"],
        ];
    } else {
        return $db_config = [
            'connection'    => env('DB_CONNECTION', 'mysql'),
            'host'          => env('DB_HOST', '127.0.0.1'),
            'database'      => env('DB_DATABASE', 'forge'),
            'username'      => env('DB_USERNAME', 'forge'),
            'password'      => env('DB_PASSWORD', ''),
        ];
    }
}