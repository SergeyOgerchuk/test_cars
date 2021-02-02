<?php

class Cars
{
    private const TABLE_NAME = 'cars';
    private const CARS_ON_PAGE = 5;


    public function getCarsForCurrentPage(int $pageNumber)
    {
        $db = new Db;
        // получаем оффсет для нужной страницы
        $firstCarOnPage = ($pageNumber * self::CARS_ON_PAGE) - self::CARS_ON_PAGE;

        // получаем записи для нужной страницы
        $result = $db->getCarsForPage($firstCarOnPage, self::CARS_ON_PAGE);
        $response = array();
        $i = 0;
        while ($row = $result->fetch_row()) {
            $response[$i]['car_id'] = $row[0];
            $response[$i]['car_name'] = $row[1];
            $response[$i]['user_role'] = $row[2];
            $response[$i]['brand_name'] = $row[3];
            $i++;
        }

        return $response;
    }

    public function countPages()
    {
        $db = new Db;

        $carsQuantity = $db->countRows(self::TABLE_NAME);

        // количество страниц
        $pagesQuantity = $carsQuantity / self::CARS_ON_PAGE;
        return $pagesQuantity;
    }

    public function addCar(int $user_id, string $car_name, int $brand_id)
    {
        $db = new Db;

        $insert = array(
            'user_id' => $user_id,
            'car_name' => $car_name,
            'brand_id' => $brand_id
        );
        $db->insert($insert, self::TABLE_NAME);
    }

    public function editCar(int $car_id, string $car_name)
    {
        $db = new Db;

        $update = array(
            'car_name' => $car_name,
        );

        $filter = array(
            'car_id' => $car_id,
        );

        $db->update($update, $filter, self::TABLE_NAME);
    }

    public function deleteCar(int $car_id)
    {
        $db = new Db;

        $delete = array(
            'car_id' => $car_id,
        );
        $db->delete($delete, self::TABLE_NAME);
    }


    // SQL запрос на получение списка авто для 2-й страницы (учитывая что на странице выводится по 5 авто)
    public function getListForPageTwo()
    {
        $db = new Db;

        // получаем оффсет для нужной страницы
        $firstCarOnPage = (2 * self::CARS_ON_PAGE) - self::CARS_ON_PAGE;

        // получаем записи для нужной страницы
        $result = $db->getCarsForPage($firstCarOnPage, self::CARS_ON_PAGE);

        while ($row = $result->fetch_row()) {
            $rows[] = $row;
        }

        return $rows;
    }
}