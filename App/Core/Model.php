<?php

namespace App\Core;

class Model
{
    protected static $tb_name;
    protected static $tb_abbr;
    protected static $tb_primary_key = 'id';
    
    protected static $primary_key;

    static function select(array $param = null)
    {
        return Database::buildQuery()->table(static::$tb_name.' as '.static::$tb_abbr)->select($param);
    }

    public function add()
    {
        return Database::buildQuery()
            ->table(static::$tb_name.' as '.static::$tb_abbr)
            ->insert($this->get())
            ->execute();
    }

    /**
     * @param callable|null $where Receive callback with queryBuilder as parameter
     */
    public function update(callable $where = null)
    {
        $h = Database::buildQuery()->table(static::$tb_name.' as '.static::$tb_abbr)
            ->update($this->get());
        if (is_callable($where)) {
            $where($h);
        } else {
            $h->where(static::$tb_abbr.'.'.static::$tb_primary_key, $this->id);
        }
        return $h->execute();
    }

    /**
     * @param string|int|callable $param Receive value of table's primary key or callback with queryBuilder as parameter
     */
    static function destroy($param)
    {
        $h = Database::buildQuery()
            ->table(static::$tb_name)
            ->delete();
        if (is_callable($param)) {
            $param($h);
        } else {
            $h->where(static::$tb_primary_key, $param);
        }
        $h->execute();
    }

    public function get()
    {
        $output = [];
        foreach ($this as $key => $data) {
            if (!is_null($data)) $output[$key] = $data;
            else continue;
        }
        return $output;
    }
}