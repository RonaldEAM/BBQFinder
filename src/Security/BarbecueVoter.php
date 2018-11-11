<?php

namespace App\Security;

use App\Entity\Barbecue;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class BarbecueVoter extends Voter
{
    const RENT = 'rent';

    protected function supports($attribute, $subject)
    {
        if (!in_array($attribute, array(self::RENT))) {
            return false;
        }

        if (!$subject instanceof Barbecue) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        /** @var Post $post */
        $barbecue = $subject;

        if ($attribute === self::RENT) {
            return $this->canRent($barbecue, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canRent(Barbecue $barbecue, User $user)
    {
        return $user !== $barbecue->getOwner();
    }
}