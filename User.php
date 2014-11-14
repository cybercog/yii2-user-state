<?php

/**
 * @copyright Copyright (c) 2008 CyberCog LLC
 * @license http://opensource.org/licenses/BSD-3-Clause The BSD 3-Clause License
 */

namespace common\components;

/**
 * User is the class for the "user" application component that manages the user authentication state.
 *
 * User states are storing in session with prefix 'user'.
 *
 * You can modify its configuration by adding an array to your application config under `components`
 * as it is shown in the following example:
 *
 * ~~~
 * 'user' => [
 *     'class' => 'common\components\User',
 * ]
 * ~~~
 *
 * Usage examples:
 *
 * ~~~
 * // Save state in \Yii::$app->session['user.email']
 * \Yii::$app->user->email = "a.komarev@cybercog.su";
 *
 * // Retrieve state from \Yii::$app->session['user.email']
 * echo \Yii::$app->user->email;
 *
 * // If state key isn't defined in $this->_stateKeys - an exception will be thrown
 * echo \Yii::$app->user->password_hash;
 * ~~~
 *
 * @author Anton Komarev <a.komarev@cybercog.su>
 * @since 2.0
 * @todo Add composer support
 */

class User extends \yii\web\User
{
    private $_stateKeys = [
        'username',
        'email',
        'status'
    ];

    public function __get($name)
    {
        try {
            return parent::__get($name);
        } catch (\yii\base\UnknownPropertyException $e) {
            if (in_array($name, $this->_stateKeys)) {
                return \Yii::$app->session->get("user.$name");
            } else {
                throw $e;
            }
        }
    }

    public function __set($name, $value)
    {
        try {
            parent::__set($name, $value);
        } catch (\yii\base\UnknownPropertyException $e) {
            if (in_array($name, $this->_stateKeys)) {
                \Yii::$app->session->set("user.$name", $value);
            } else {
                throw $e;
            }
        }
    }
}