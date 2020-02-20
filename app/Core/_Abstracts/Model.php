<?php
/**
 * Created by PhpStorm.
 * User: ראהטךüÿםנ
 * Date: 18.02.2020
 * Time: 18:01
 */

namespace Core\_Abstracts;


use Core\Db;

/**
 *@method static selectContext($table, &$map, $join, &$columns = null, $where = null, $column_fn = null)
 *@method static select($join, $columns = null, $where = null)
 *@method static replace($table, $columns, $where = null)
 *@method static insert($table, $datas)
 * */

abstract class Model
{
    protected static $table;

    public static function getTable(){
        return static::$table;
    }

    public static function __callStatic($name, $arguments){
        array_unshift($arguments, static::$table);
        return call_user_func_array([Db::inst(), $name], $arguments);
    }

}