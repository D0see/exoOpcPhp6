<?php

class MemberService
{
    private MemberRepository $memberRepository;

    public function __construct() 
    {
        $this->memberRepository = new MemberRepository();
    }

    public function getMemberByMail($mail) {
        return $this->memberRepository->getMemberByMail($mail);
    }
}