<?php

class MemberRepository
{
    public function createMember(Member $member): void
    {
        $sql = "
            INSERT INTO member (
                pseudo, password
            ) VALUES (
                :pseudo, :password
            )
        ";

        $pdo = DBManager::getInstance()->getPDO();
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'pseudo'   => $member->getPseudo(),
            'password' => $member->getPassword(),
        ]);
    }

    public function getMemberById(int $id): ?Member
    {
        $sql = 'SELECT * FROM member WHERE id = :id';

        $stmt = DBManager::getInstance()->getPDO()->prepare($sql);
        $stmt->execute(['id' => $id]);

        $row = $stmt->fetch();
        return new Member($row);
    }
}