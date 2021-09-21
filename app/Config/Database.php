<?php

namespace Config;

use CodeIgniter\Database\Config;

/**
 * Database Configuration
 */
class Database extends Config
{
    /**
     * The directory that holds the Migrations
     * and Seeds directories.
     *
     * @var string
     */
    public $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;

    /**
     * Lets you choose which connection group to
     * use if no other is specified.
     *
     * @var string
     */
    public $defaultGroup = 'default';

    /**
     * The default database connection.
     *
     * @var array
     */

    //  Mysql
    // public $default = [
    //     'DSN'      => '',
    //     'hostname' => 'localhost',
    //     'username' => 'root',
    //     'password' => '',
    //     'database' => '',
    //     'DBDriver' => 'MySQLi',
    //     'DBPrefix' => '',
    //     'pConnect' => false,
    //     'DBDebug'  => (ENVIRONMENT !== 'production'),
    //     'charset'  => 'utf8',
    //     'DBCollat' => 'utf8_general_ci',
    //     'swapPre'  => '',
    //     'encrypt'  => false,
    //     'compress' => false,
    //     'strictOn' => false,
    //     'failover' => [],
    //     'port'     => 3306,
    // ];

    // Postgresql local
    // public $default = [
    //     'DSN'      => 'Postgre://banksampah:banksampah@localhost:5432/banksampah?charset=utf8&connect_timeout=5',
    //     'hostname' => 'localhost',
    //     'username' => 'banksampah',
    //     'password' => 'banksampah',
    //     'database' => 'banksampah',
    //     'DBDriver' => 'Postgre',
    //     'DBPrefix' => '',
    //     'pConnect' => false,
    //     'DBDebug'  => (ENVIRONMENT !== 'production'),
    //     'charset'  => 'utf8',
    //     'DBCollat' => 'utf8_general_ci',
    //     'swapPre'  => '',
    //     'encrypt'  => false,
    //     'compress' => false,
    //     'strictOn' => false,
    //     'failover' => [],
    //     'port'     => 3306,
    // ];

    // Postgresql heroku
    public $default = [
        'DSN'      => 'Postgre://eaxzuarmydxosq:d954bef2bfff907b334e42c56281241a363d925a52f7863bc8092b09da443e01@ec2-35-171-250-21.compute-1.amazonaws.com:5432/d3njo8irs6ur6?charset=utf8&connect_timeout=100',
        'hostname' => 'ec2-35-171-250-21.compute-1.amazonaws.com',
        'username' => 'eaxzuarmydxosq',
        'password' => 'd954bef2bfff907b334e42c56281241a363d925a52f7863bc8092b09da443e01',
        'database' => 'd3njo8irs6ur6',
        'DBDriver' => 'Postgre',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => (ENVIRONMENT !== 'production'),
        'charset'  => 'utf8',
        'DBCollat' => 'utf8_general_ci',
        'swapPre'  => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'port'     => 5432,
    ];

    /**
     * This database connection is used when
     * running PHPUnit database tests.
     *
     * @var array
     */
    public $tests = [
        'DSN'      => '',
        'hostname' => '127.0.0.1',
        'username' => '',
        'password' => '',
        'database' => ':memory:',
        'DBDriver' => 'SQLite3',
        'DBPrefix' => 'db_',  // Needed to ensure we're working correctly with prefixes live. DO NOT REMOVE FOR CI DEVS
        'pConnect' => false,
        'DBDebug'  => (ENVIRONMENT !== 'production'),
        'charset'  => 'utf8',
        'DBCollat' => 'utf8_general_ci',
        'swapPre'  => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'port'     => 3306,
    ];

    public function __construct()
    {
        parent::__construct();

        // Ensure that we always set the database group to 'tests' if
        // we are currently running an automated test suite, so that
        // we don't overwrite live data on accident.
        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }
    }
}
