<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class GuestbookEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id;

    #[ORM\Column(type: "datetime_immutable", options:["default" => "CURRENT_TIMESTAMP"])]
    private \DateTimeImmutable $createAt;

    #[Assert\NotBlank]
    #[Assert\Length(max:255)]
    #[ORM\Column(type: "string")]
    private string $username;

    #[Assert\NotBlank]
    #[Assert\Length(max:255)]
    #[ORM\Column(type: "string")]
    private string $subtitle;

    #[Assert\NotBlank]
    #[ORM\Column(type: "text")]
    private string $body;
    
    #[Assert\Email]
    #[ORM\Column(type: "string", nullable: true)]
    #[Assert\Length(max:255)]
    private ?string $email;

    public function __construct(){
        $this->createAt = new \DateTimeImmutable();
    }

    public function getSubtitle(): string 
    {
        return $this->subtitle;
    }

    public function setSubtitle(string $subtitle): void
    {
        $this->subtitle = $subtitle;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getCreateAt(): \DateTimeImmutable
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeImmutable $createAt): void
    {
        $this->createAt = $createAt;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

  
    public function getBody()
    {
        return $this->body;
    }

    public function setBody($body): void
    {
        $this->body = $body;
    }
}