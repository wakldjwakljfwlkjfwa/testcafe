<?php

namespace App;

class UserService
{
	public function createUser(User $user): void
	{
		$connection = Database::getConnection();
		$statement = $connection->prepare('INSERT INTO users (name, email) VALUES (:name, :email)');

		$statement->execute([
			'name' => $user->name,
			'email' => $user->email,
		]);
	}

	/**
	 * @return array<User>
	 */
	public function getUsers(): array
	{
		$connection = Database::getConnection();
		$statement = $connection->prepare('SELECT * FROM users');
		$statement->execute();
		$users = $statement->fetchAll(\PDO::FETCH_ASSOC);
		$arrat_map_callback = fn ($user) => new User(
			name: $user['name'],
			email: $user['email'],
		);
		$users = array_map($arrat_map_callback, $users);

		return $users;
	}

	public function deleteAllUsers(): void
	{
		$connection = Database::getConnection();
		$statement = $connection->prepare('DELETE FROM users');
		$statement->execute();
	}
}
