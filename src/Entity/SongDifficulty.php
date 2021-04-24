<?php

namespace App\Entity;

use App\Repository\SongDifficultyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SongDifficultyRepository::class)
 */
class SongDifficulty
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $difficulty;

    /**
     * @ORM\Column(type="integer")
     */
    private $noteJumpMovementSpeed;

    /**
     * @ORM\Column(type="integer")
     */
    private $noteJumpStartBeatOffset;

    /**
     * @ORM\ManyToOne(targetEntity=DifficultyRank::class, inversedBy="songDifficulties")
     */
    private $difficultyRank;

    /**
     * @ORM\ManyToOne(targetEntity=Song::class, inversedBy="songDifficulties")
     */
    private $song;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $notesCount;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $NotePerSecond;

    /**
     * @ORM\OneToMany(targetEntity=Score::class, mappedBy="songDifficulty", orphanRemoval=true)
     * @ORM\OrderBy({"score"="DESC"})
     */
    private $scores;

    public function __construct()
    {
        $this->scores = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDifficulty(): ?string
    {
        return $this->difficulty;
    }

    public function setDifficulty(string $difficulty): self
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function getNoteJumpMovementSpeed(): ?int
    {
        return $this->noteJumpMovementSpeed;
    }

    public function setNoteJumpMovementSpeed(int $noteJumpMovementSpeed): self
    {
        $this->noteJumpMovementSpeed = $noteJumpMovementSpeed;

        return $this;
    }

    public function getNoteJumpStartBeatOffset(): ?int
    {
        return $this->noteJumpStartBeatOffset;
    }

    public function setNoteJumpStartBeatOffset(int $noteJumpStartBeatOffset): self
    {
        $this->noteJumpStartBeatOffset = $noteJumpStartBeatOffset;

        return $this;
    }

    public function getDifficultyRank(): ?DifficultyRank
    {
        return $this->difficultyRank;
    }

    public function setDifficultyRank(?DifficultyRank $difficultyRank): self
    {
        $this->difficultyRank = $difficultyRank;

        return $this;
    }

    public function getSong(): ?Song
    {
        return $this->song;
    }

    public function setSong(?Song $song): self
    {
        $this->song = $song;

        return $this;
    }

    public function getNotesCount(): ?int
    {
        return $this->notesCount;
    }

    public function setNotesCount(?int $notesCount): self
    {
        $this->notesCount = $notesCount;

        return $this;
    }

    public function getNotePerSecond(): ?float
    {
        return $this->NotePerSecond;
    }

    public function setNotePerSecond(?float $NotePerSecond): self
    {
        $this->NotePerSecond = $NotePerSecond;

        return $this;
    }

    /**
     * @return Collection|Score[]
     */
    public function getScores(): Collection
    {
        return $this->scores;
    }

    /**
     * @return Score[]
     */
    public function getScoresTop()
    {
        return $this->scores->slice(0, 3);
    }


    public function addScore(Score $score): self
    {
        if (!$this->scores->contains($score)) {
            $this->scores[] = $score;
            $score->setSongDifficulty($this);
        }

        return $this;
    }

    public function removeScore(Score $score): self
    {
        if ($this->scores->removeElement($score)) {
            // set the owning side to null (unless already changed)
            if ($score->getSongDifficulty() === $this) {
                $score->setSongDifficulty(null);
            }
        }

        return $this;
    }
}
