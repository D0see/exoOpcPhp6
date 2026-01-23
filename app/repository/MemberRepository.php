<?php

class MemberRepository
{
    public function createMember(Member $member): void
    {
        $sql = "
            INSERT INTO member (
                pseudo, password, mail, image
            ) VALUES (
                :pseudo, :password, :mail, :image
            )
        ";

        $pdo = DBManager::getInstance()->getPDO();
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'pseudo'   => $member->getPseudo(),
            'password' => $member->getPassword(),
            'mail' => $member->getMail(),
            'image' => $member->getImage(),
        ]);
    }

    public function getMemberById(int $id): ?Member
    {
        $sql = 'SELECT * FROM member WHERE id = :id';

        $stmt = DBManager::getInstance()->getPDO()->prepare($sql);
        $stmt->execute(['id' => $id]);
        
        $row = $stmt->fetch();

        if ($row === false) {
            return null;
        }

        return new Member($row);
    }

    public function getMemberByMail(string $mail): ?Member
    {
        $sql = 'SELECT * FROM member WHERE mail = :mail';

        $stmt = DBManager::getInstance()->getPDO()->prepare($sql);
        $stmt->execute(['mail' => $mail]);

        $row = $stmt->fetch();

        if ($row === false) {
            return null;
        }

        return new Member($row);
    }
}