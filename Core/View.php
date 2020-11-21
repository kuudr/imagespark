<?php
namespace View;

class viewHomePage{

    public $homePage = 'Домашняя страница';

    /**
     * @return mixed
     */
    public function getHomePage()
    {
        echo $this->homePage;
    }
}
class viewUsers{

    public $usersPage;

    /**
     * @return mixed
     */
    public function getUsersPage()
    {
        $this->usersPage = 'Страница пользователей';
        return $this->usersPage;
    }
}