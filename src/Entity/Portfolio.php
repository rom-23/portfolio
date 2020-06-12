<?php

namespace App\Entity;

use App\Repository\PortfolioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=PortfolioRepository::class)
 * @Vich\Uploadable()
 */
class Portfolio
{
  /**
   * @ORM\Id()
   * @ORM\GeneratedValue()
   * @ORM\Column(type="integer")
   */
  private $id;

  /**
   * @ORM\Column(type="string", length=255)
   */
  private $title;

  /**
   * @ORM\Column(type="text")
   */
  private $description;

  /**
   * @ORM\Column(type="datetime", nullable=false)
   */
  private $createdAt;


  /**
   * @ORM\Column(type="datetime", nullable=false)
   */
  private $updatedAt;

  /**
   * @ORM\ManyToMany(targetEntity=Pictures::class, inversedBy="portfolios", cascade={"persist"})
   */
  private $pictures;

  public function __construct()
  {
    $this->createdAt = new DateTime();
    $this->updatedAt = new DateTime();
    $this->pictures = new ArrayCollection();

  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getTitle(): ?string
  {
    return $this->title;
  }

  public function setTitle(string $title): self
  {
    $this->title = $title;

    return $this;
  }

  public function getDescription(): ?string
  {
    return $this->description;
  }

  public function setDescription(string $description): self
  {
    $this->description = $description;

    return $this;
  }

  public function getCreatedAt(): ?\DateTimeInterface
  {
    return $this->createdAt;
  }

  public function setCreatedAt(?\DateTimeInterface $createdAt): self
  {
    $this->createdAt = $createdAt;

    return $this;
  }


  public function getUpdatedAt(): ?\DateTimeInterface
  {
    return $this->updatedAt;
  }

  public function setUpdatedAt(\DateTimeInterface $updatedAt): self
  {
    $this->updatedAt = $updatedAt;

    return $this;
  }

  /**
   * @return Collection|Pictures[]
   */
  public function getPictures(): Collection
  {
      return $this->pictures;
  }

  public function addPicture(Pictures $picture): self
  {
      if (!$this->pictures->contains($picture)) {
          $this->pictures[] = $picture;
      }

      return $this;
  }

  public function removePicture(Pictures $picture): self
  {
      if ($this->pictures->contains($picture)) {
          $this->pictures->removeElement($picture);
      }

      return $this;
  }
  public function __toString()
  {
    return $this->title;
  }
}
