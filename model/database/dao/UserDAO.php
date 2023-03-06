<?php

class UserDAO extends DAO
{
    private static string $table = 'user';
    public function signin(User $user): array
    {
        $sql = 'SELECT password from ' . self::$table . ' WHERE username = :username';
        $stmt = $this->getPDO()->prepare($sql);
        $stmt->bindValue(':username', $user->getUsername());
        $stmt->execute();
        $hashPassword = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($hashPassword) {
            if (password_verify($user->getPassword(), $hashPassword['password'])) {
                $sql = 'SELECT * FROM user WHERE username = :username';
                $stmt = $this->getPDO()->prepare($sql);
                $stmt->bindValue(':username', $user->getUsername());
                try {
                    $stmt->execute();
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return [1, $result];
            } else {
                return [0, 'password', $user->getUsername()];
            }
        }
        return [0, 'username', $user->getUsername()];
    }

    public function signout(): void
    {
        unset($_SESSION['user']);
    }

    public function verifyPassword(User $user, string $password): bool
    {
        $result = false;

        $sql = 'SELECT password FROM ' . self::$table . ' WHERE username = :username';
        $stmt = $this->getPDO()->prepare($sql);
        $stmt->bindValue(':username', $user->getUsername());
        $stmt->execute();
        $hashPassword = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($hashPassword) {
            if (password_verify($password, $hashPassword['password'])) {
                $result =  true;
            }
        }
        return $result;
    }
}
