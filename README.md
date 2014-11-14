yii2-user-state
===============

Extension of the User component for storing and retrieving user state information in session.

INSTALLATION (ADVANCED APP)
---------------------------

Copy `User.php` to `/common/components` folder.

Modify components array in configuration `/common/config/main.php`.

```
'components' => [
    'user' => [
        'class' => 'common\components\User',
    ],
],
```

Define keys allowed to store. Modify file `User.php`:

```
private $_stateKeys = [
  'username',
  'email',
  'status'
];
```
