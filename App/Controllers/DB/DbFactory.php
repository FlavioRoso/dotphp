<?

namespace App\Controllers\DB;

use App\Config;

class DbFactory
{
    private static $db_instance = null;



    public static function getInstance() : MysqlDb
    {
        if(self::$db_instance == null)
        {
            self::$db_instance = new MysqlDb("mysql:host=".Config::DB_HOST.";dbname=".Config::DB_NAME."", Config::DB_USER,Config::DB_PASS);
            self::$db_instance->exec("SET NAMES utf8");
            //self::$db_instance->exec("SET character_set='utf8'"); 
            self::$db_instance->exec("SET collation_connection='utf8_general_ci'");
            self::$db_instance->exec("SET character_set_connection='utf8'");
            self::$db_instance->exec("SET character_set_client='utf8'");
            self::$db_instance->exec("SET character_set_results='utf8'");
          
        }
            

        return self::$db_instance;
    }

}