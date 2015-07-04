<?php

/**
 * Тестирование Пользователей
 * @author Vitaly Serov
 */
class UsersTest
{
    /**
     * Регистрация пользователя
     *
     * @dataProvider getUsersListData
     *
     * @param $name
     * @param $email
     * @param $password
     * @param $password_confirmation
     */
    public function testRegistrationUser($name, $email, $password, $password_confirmation)
    {
        echo $email . "\n";
    }

    public function getUsersListData()
    {
        $list = [];

        for($u = 1; $u <= 100; $u++){

            $name = 'Новый пользователь ' . $u;

            $email = 'user' . $u . '@mail.ru';

            $list[] = [
                'name' => $name,
                'email' => $email,
                'password' => '123456',
                'password_confirmation' => '123456',
            ];
        }

        return $list;
    }
}