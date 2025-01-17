<?php

namespace App\Entity;

use App\Repository\GamificationRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass=GamificationRepository::class)
 * @ORM\Table(name="gamification", uniqueConstraints={
 *  @ORM\UniqueConstraint(name="user_achievement",
 *            columns={"user_id", "achievement"})
 *     })
 */
class Gamification
{
    use TimestampableEntity;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="gamifications")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $achievement;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $achievement_needs;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $achievement_count;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $achievementUnicity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?Utilisateur
    {
        return $this->user;
    }

    public function setUser(?Utilisateur $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getAchievement(): ?string
    {
        return $this->achievement;
    }

    public function setAchievement(string $achievement): self
    {
        $this->achievement = $achievement;

        return $this;
    }

    public function getAchievementNeeds(): ?int
    {
        return $this->achievement_needs;
    }

    public function setAchievementNeeds(?int $achievement_needs): self
    {
        $this->achievement_needs = $achievement_needs;

        return $this;
    }

    public function getAchievementCount(): ?int
    {
        return $this->achievement_count;
    }

    public function setAchievementCount(?int $achievement_count): self
    {
        $this->achievement_count = $achievement_count;

        return $this;
    }

    public function getAchievementUnicity(): ?string
    {
        return $this->achievementUnicity;
    }

    public function setAchievementUnicity(string $achievementUnicity): self
    {
        $this->achievementUnicity = $achievementUnicity;

        return $this;
    }
}
