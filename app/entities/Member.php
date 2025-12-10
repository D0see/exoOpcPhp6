<?php

class Member extends AbstractEntity
{
    private string $pseudo;
    private string $password;

    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    public function getPassword(): string
    {
        return $this->password;
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
}