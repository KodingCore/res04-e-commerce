<?php
class UserManager extends AbstractManager {
    
    public function getAllUsers() : array
    {
        $query = $this->db->prepare("SELECT * FROM users");
        $query->execute();
        $array = $query->fetchAll(PDO::FETCH_ASSOC);
        return $array;
    }
    
    public function getUserById(int $id) : User
    {
        $query = $this->db->prepare("SELECT * FROM users WHERE users.id = :id");
        $parameters = ["id" => $id];
        $query->execute($parameters);
        $user = $query->fetch(PDO::FETCH_ASSOC);
        return $user;
    }
    
    public function getUserByEmail(string $email) : User
    {
        $query = $this->db->prepare("SELECT * FROM users WHERE users.email = :email");
        $parameters = ['email' => $email];
        $query->execute($parameters);
        $user = $query->fetch(PDO::FETCH_ASSOC);
        return $user;
    }
    
    public function insertUser(User $user)
    {
        $query = $this->db->prepare("INSERT INTO users (first_name, last_name, email, password)
                               VALUES (:first_name, :last_name, :email, :password)");
        $parameters = [
            "first_name" => $user->getFirstName(),
            "last_name" => $user->getLastName(),
            "email" => $user->getEmail(),
            "password" => $user->getPassword()
        ];
        $query->execute($parameters);
    }
    
    public function editUser(User $user) : void
    {
        $query = $this->db->prepare("UPDATE users SET users.username = :username, users.email = :email, users.password = :password WHERE users.id = :id");
        $parameters = [
            // 'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'id' => $user->getId()
        ];
        $query->execute($parameters);
    }
}

?>