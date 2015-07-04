<?php

/**
 * Тестирование Пользователей
 * @author Vitaly Serov
 */
class UsersTest extends TestCase
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
        $response = $this->call('POST', '/auth/register', [
            '_token' => csrf_token(),
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password_confirmation
        ]);

        $this->assertEquals(200, $response->status());
    }

    public function getUsersListData()
    {
        $list = [];

        for($u = 1; $u <= 3; $u++){

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