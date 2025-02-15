<?php

require_once "pdoModel.php";
require_once "entities/user.php";

class UsersModel extends PDOServer
{

    public function addUser(
        string $usersName,
        string $usersFirstName,
        string $usersMail,
        string $usersPassword
    ) {
        $user = $this->pdo->prepare(
            'INSERT INTO users (users_name, users_first_Name, users_mail, users_password) 
            VALUES (:usersName, :usersFirstName, :usersMail, :usersPassword)'
        );

        $user->bindValue(':usersName', $usersName, PDO::PARAM_STR);
        $user->bindValue(':usersFirstName', $usersFirstName, PDO::PARAM_STR);
        $user->bindValue(':usersMail', $usersMail, PDO::PARAM_STR);
        $user->bindValue(':usersPassword', password_hash($usersPassword, PASSWORD_BCRYPT));
        return $user->execute();
    }

    public function connectUser(string $usersMail, string $usersPassword)
    {
        $user = $this->pdo->prepare('SELECT * FROM users WHERE users_mail = :email');
        $user->bindValue(':email', $usersMail, PDO::PARAM_STR);
        if ($user->execute()) {
            $userConnect = $user->fetch(PDO::FETCH_ASSOC);
            if ($userConnect === false) {
                echo "Identifiants invalides";
            } else {
                if (password_verify($usersPassword, $userConnect['users_password'])) {
                    echo "Bonjour" . ' ' . $userConnect['users_first_name'] . ' ' . $userConnect['users_name'] . ', votre statut est ' . $userConnect['users_role'] . '.';
                    if ($userConnect['users_role'] === 'admin') {
                        $_SESSION['admin'] = true;
                        setcookie('admin', 'admin', time() + 3600, '/');
                    } else if ($userConnect['users_role'] === 'user') {
                        $_SESSION['user'] = true;
                        $_SESSION['admin'] = false;
                        setcookie('user', 'user', time() + 3600, '/');
                    }
                } else {
                    echo "C'est pas le bon mot de passe, CONNARD.";
                }
            }
        }
        return $user->execute();
    }

    public function deleteUser($usersMail)
    {
        $user = $this->pdo->prepare('DELETE * FROM users WHERE users_mail = :email');
        $user->bindValue(':email', $usersMail, PDO::PARAM_STR);
        return $user->execute();
    }
}
