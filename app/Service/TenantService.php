<?php
namespace App\Service;

use App\Models\Tenant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
class TenantService
{
    private static $tenant;
    private static $domain;
    private static $database;

    public static function switchToTenant(Tenant $tenant)
    {
        if(!$tenant instanceof Tenant) {
            throw new \Exception('Tenant not found');
        }
        DB::purge('system');
        DB::purge('tenant');
        Config::set('database.connections.tenant.database', $tenant->database);

        self::$tenant   = $tenant;
        self::$domain   = $tenant->domain;
        self::$database = $tenant->database;

        DB::connection('tenant')->reconnect();
        DB::setDefaultConnection('tenant');
    }

    public static function switchToDefault()
    {
        DB::purge('system');
        DB::purge('tenant');
        DB::connection('system')->reconnect();
        DB::setDefaultConnection('system');
    }

    public static function getTenant()
    {
        return self::$tenant;
    }

    public static function getDomain()
    {
        return self::$domain;
    }

    public static function getDatabase()
    {
        return self::$database;
    }
}
