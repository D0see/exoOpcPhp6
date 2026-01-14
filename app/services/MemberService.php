<?php

class MemberService
{
    private MemberRepository $memberRepository;

    public function __construct() 
    {
        $this->memberRepository = new MemberRepository();
    }

    public function getMemberByPseudo($pseudo) {
        $this->memberRepository->getMemberByPseudo($pseudo);
    }
}