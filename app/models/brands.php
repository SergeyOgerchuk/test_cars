<?php

class Brands
{
    private const TABLE_NAME = 'brands';

    public function getAllBrands()
    {
        $db = new Db;
        $result = $db->getAll(self::TABLE_NAME);
        return $result;
    }

    public function addBrand(string $brand_name)
    {
        $db = new Db;
        $insert = array(
            'brand_name' => $brand_name,
        );
        $db->insert($insert, self::TABLE_NAME);
    }

    public function editUser(string $role, int $user_id)
    {
        $db = new Db;
        $update = array(
            'role' => $role,
        );

        $filter = array(
            'user_id' => $user_id,
        );

        $db->update($update, $filter, self::TABLE_NAME);
    }

    public function deleteUser(int $user_id)
    {
        $db = new Db;
        $delete = array(
            'user_id' => $user_id,
        );
        $db->delete($delete, self::TABLE_NAME);
    }

    // SQL запрос на получение списка пользователей которым принадлежит машина с id
    public function getUserListWithSelectedCar(int $car_id)
    {
        $db = new Db;
        $where = array(
            'car_id' => $car_id
        );
        $db->getOne($where, self::TABLE_NAME);
    }

}