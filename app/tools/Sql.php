<?php
/**
 * Created by PhpStorm.
 * User: zhanghe
 * Date: 15-6-9
 * Time: 上午9:43
 */

namespace wl\tools;


class Sql
{
    /**
     * 获取插入sql语句
     * @param $tableName
     * @param array $insertData
     * @return string
     */
    public static function insertSql($tableName, $insertData = array())
    {
        $fieldsArray = array();
        $valuesArray = array();
        $sql = '';
        foreach ($insertData as $key => $item) {
            $fieldsArray[] = $key;
            $valuesArray[] = '\'' . $item . '\'';
        }
        $insertFields = implode(', ', $fieldsArray);
        $insertValues = implode(', ', $valuesArray);
        if ($insertFields) {
            $sql = 'insert into ' . $tableName . ' (' . $insertFields . ')  values (' . $insertValues . ')';
        }
        return $sql;
    }

    /**
     * 获取更新sql语句
     * @param $tableName
     * @param array $updateData
     * @param array $conditionDate
     * @return string
     */
    public static function updateSql($tableName, $updateData = array(), $conditionDate = array())
    {
        $updateArray = array();
        $conditionArray = array();
        $sql = '';
        //更新字段信息
        foreach ($updateData as $key => $item) {
            $updateArray[] = $key . '=\'' . $item . '\'';
        }
        $updateFields = implode(', ', $updateArray);
        //条件
        foreach ($conditionDate as $key => $item) {
            $conditionArray[] = $key . '=\'' . $item . '\'';
        }
        $updateConditions = implode(' and ', $conditionArray);
        if ($updateFields && $updateConditions) {
            $sql = 'update ' . $tableName . ' set ' . $updateFields . ' where ' . $updateConditions;
        }
        return $sql;
    }
} 
