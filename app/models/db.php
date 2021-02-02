<?php

class Db
{
    private const HOST = 'mysql';
    private const USERNAME = 'root';
    private const PASSWORD = 'Testpassword123';
    private const DBNAME = 'testdb';

    private function connect()
    {
        return $link = mysqli_connect(self::HOST, self::USERNAME, self::PASSWORD,
            self::DBNAME, 3306);
    }

    private function doQuery(string $sql)
    {
        $link = self::connect();
        $result = mysqli_query($link, $sql);
        return $result;
    }

    public function getAll(string $table_name)
    {
        $sql = 'SELECT * FROM' . $table_name;
        $result = self::doQuery($sql);
        return $result;
    }

    public function getOne($select, string $table_name)
    {
        $filter = '';
        foreach ($select as $key => $value) {
            $filter = $filter . $key . '=' . $value;
        }
        $sql = 'SELECT * FROM' . $table_name . 'WHERE ' . $filter;
        $result = self::doQuery($sql);
        return $result;
    }

    public function getWithLimit(int $start, int $offset, string $table_name)
    {
        $sql = "SELECT * FROM " . $table_name . " WHERE car_id > 0 LIMIT " . $start . ', ' . $offset;
        $result = self::doQuery($sql);
        return $result;
    }

    public function getCarsForPage(int $start, int $offset)
    {
        $sql = "SELECT car_id, car_name, role, brand_name
        FROM cars join users ON cars.user_id = users.user_id
        join brands ON cars.brand_id = brands.brand_id LIMIT " . $start . ", " . $offset;
        $result = self::doQuery($sql);
        return $result;
    }

    public function countRows(string $table_name)
    {
        $sql = 'SELECT COUNT(*) FROM ' . $table_name;
        $result = self::doQuery($sql);
        $row = $result->fetch_row();
        return $row[0];
    }

    public function insert(array $insert, string $table_name)
    {
        $sql = 'INSERT INTO' . $table_name . 'SET ';

        foreach ($insert as $key => $value) {
            $string = $key . ' = ' . $value;
            $sql = $sql . $string;
        }

        $result = self::doQuery($sql);
        return $result;
    }

    public function update(array $update, array $filter, string $table_name)
    {
        $sql = 'UPDATE ' . $table_name . ' SET ';

        foreach ($update as $key => $value) {
            $string = $key . " = ' " . $value . "'";
            $sql = $sql . $string;
        }

        $sql = $sql . ' WHERE ';

        foreach ($filter as $key => $value) {
            $string = $key . ' = ' . $value;
            $sql = $sql . $string;
        }

        $result = self::doQuery($sql);
        return $result;
    }

    public function delete(array $delete, string $table_name)
    {
        $sql = 'DELETE FROM ' . $table_name . ' WHERE ';

        foreach ($delete as $key => $value) {
            $string = $key . " = ' " . $value . "'";
            $sql = $sql . $string;
        }

        $result = self::doQuery($sql);
        return $result;
    }
}