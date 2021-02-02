<?php
// Проверяем нужны ли стрелки вперед и назад
if ($currentPage != 1) $prevPage = '<a href= ><<</a>
                               <a href= ./' . ($currentPage - 1) . '><</a> ';
if ($currentPage != $pagesCount) $nextPage = ' <a href= ./' . ($currentPage + 1) . '>></a>
                                   <a href= ./' . $pagesCount . '>>></a>';

// Находим две ближайшие страницы
if ($currentPage - 2 > 0) $currentPage2left = ' <a href= ./' . ($currentPage - 2) . '>' . ($currentPage - 2) . '</a> | ';
if ($currentPage - 1 > 0) $currentPage1left = '<a href= ./' . ($currentPage - 1) . '>' . ($currentPage - 1) . '</a> | ';
if ($currentPage + 2 <= $pagesCount) $currentPage2Right = ' | <a href= ./' . ($currentPage + 2) . '>' . ($currentPage + 2) . '</a>';
if ($currentPage + 1 <= $pagesCount) $currentPage1Right = ' | <a href= ./' . ($currentPage + 1) . '>' . ($currentPage + 1) . '</a>';

// Выводим меню
echo $prevPage . $currentPage2left . $currentPage1left . '<b>' . $currentPage . '</b>' . $currentPage1Right . $currentPage2Right . $nextPage;
