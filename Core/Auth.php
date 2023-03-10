<?php

declare(strict_types=1);

namespace Core;

use App\Model\User;

class Auth
{
    private static $instance;
    private $currentUser;

    private function __construct()
    {
        if ($userId = $_SESSION['user_id'] ?? null) {
            $user = User::getOne('id', $userId);
            $this->currentUser = $user->getid() ? $user : null;
        }
    }

    private function __clone()
    {
    }

    public static function getInstance(): self
    {
        if (static::$instance === null) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    public function login(User $user): void
    {
        if ($user->getid()) {
            $_SESSION['user_id'] = $user->getid();
            $this->currentUser = $user;
        }
    }

    public function logout(): void
    {
        unset($_SESSION['user_id'], $this->currentUser);
	    // Remove cookie
	    setcookie('email', '', 0, "/");
	    setcookie('password', '', 0, "/");
    }

    public function isLoggedIn(): bool
    {
        return isset($this->currentUser);
    }

    public function getCurrentUser(): ?User
    {
        return $this->currentUser ?? null;
    }
}