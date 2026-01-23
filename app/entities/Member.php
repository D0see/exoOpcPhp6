<?php

class Member extends AbstractEntity
{
    private string $pseudo;
    private string $password;
    private ?string $image = null;
    private string $mail;

    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getImage(): string|null
    {
        return $this->image;
    }

    public function getMail(): string
    {
        return $this->mail;
    }


    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;
        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function setImage(string|null $image): self
    {
        $this->image = $image;
        return $this;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;
        return $this;
    }
}