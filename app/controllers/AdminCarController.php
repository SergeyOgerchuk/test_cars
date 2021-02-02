<?php

class AdminCarController
{
    public function createView($params)
    {
        $cars = new Cars;
        if (is_numeric($params)) {
            $result = $cars->getCarsForCurrentPage($params);
            $currentPage = $params;
        } else {
            $result = $cars->getCarsForCurrentPage(1);
            $currentPage = 1;
        }
        $pagesCount = $cars->countPages();
        include "{$_SERVER['DOCUMENT_ROOT']}/app/views/admin.php";
    }
}