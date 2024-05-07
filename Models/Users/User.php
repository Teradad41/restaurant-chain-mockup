<?php

namespace Models\Users;

use Interfaces\FileConvertible;
use DateTime;

class User implements FileConvertible
{
    protected int $id;
    protected string $firstName;
    protected string $lastName;
    protected string $email;
    protected string $hashedPassword;
    protected string $phoneNumber;
    protected string $address;
    protected DateTime $birthDate;
    protected DateTime $membershipExpirationDate;
    protected string $role;
    protected bool $isActive;

    public function __construct(
        int $id, string $firstName, string $lastName, string $email,
        string $password, string $phoneNumber, string $address,
        DateTime $birthDate, DateTime $membershipExpirationDate, string $role, bool $isActive = true
    )
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $this->phoneNumber = $phoneNumber;
        $this->address = $address;
        $this->birthDate = $birthDate;
        $this->membershipExpirationDate = $membershipExpirationDate;
        $this->role = $role;
        $this->isActive = $isActive;
    }

    public function login(string $password): bool
    {
        // Validate password with the hashed password
        return password_verify($password, $this->hashedPassword);
    }

    public function updateProfile(string $address, string $phoneNumber): void
    {
        $this->address = $address;
        $this->phoneNumber = $phoneNumber;
    }

    public function renewMembership(DateTime $expirationDate): void
    {
        $this->membershipExpirationDate = $expirationDate;
    }

    public function changePassword(string $newPassword): void
    {
        $this->hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    }

    public function hasMembershipExpired(): bool
    {
        $currentDate = new DateTime();
        return $currentDate > $this->membershipExpirationDate;
    }

    public function toString(): string
    {
        return sprintf(
            "User ID: %d\nName: %s %s\nEmail: %s\nPhone Number: %s\nAddress: %s\nBirth Date: %s\nMembership Expiration Date: %s\nRole: %s\n",
            $this->id,
            $this->firstName,
            $this->lastName,
            $this->email,
            $this->phoneNumber,
            $this->address,
            $this->birthDate->format('Y-m-d'),
            $this->membershipExpirationDate->format('Y-m-d'),
            $this->role
        );
    }

    public function toHTML(): string
    {
        return sprintf("
            <div class='user-card'>
                <div class='avatar'>SAMPLE</div>
                <h2>%s %s</h2>
                <p>%s</p>
                <p>%s</p>
                <p>%s</p>
                <p>Birth Date: %s</p>
                <p>Membership Expiration Date: %s</p>
                <p>Role: %s</p>
            </div>",
            $this->firstName,
            $this->lastName,
            $this->email,
            $this->phoneNumber,
            $this->address,
            $this->birthDate->format('Y-m-d'),
            $this->membershipExpirationDate->format('Y-m-d'),
            $this->role
        );
    }

    public function toMarkdown(): string
    {
        return "## User: {$this->firstName} {$this->lastName}\n" .
                "- Email: {$this->email}\n" .
                "- Phone Number: {$this->phoneNumber}\n" .
                "- Address: {$this->address}\n" .
                "- Birth Date: {$this->birthDate->format('Y-m-d')}\n" .
                "- Membership Expiration: {$this->membershipExpirationDate->format('Y-m-d')}\n" .
                "- Role: {$this->role}\n" .
                "- Active: " . ($this->isActive ? 'Yes' : 'No');
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'email' => $this->email,
            'hashedPassword' => $this->hashedPassword,
            'phoneNumber' => $this->phoneNumber,
            'address' => $this->address,
            'birthDate' => $this->birthDate,
            'membershipExpirationDate' => $this->membershipExpirationDate,
            'role' => $this->role,
            'isActive' => $this->isActive,
        ];
    }
}