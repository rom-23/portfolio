<?php

namespace App\Entity;

use App\Repository\PicturesRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
/**
 * @ORM\Entity(repositoryClass=PicturesRepository::class)
 * @Vich\Uploadable()
 */
class Pictures
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\ManyToMany(targetEntity=Portfolio::class, mappedBy="pictures", cascade={"persist"})
     */
    private $portfolios;

  /**
   * @Vich\UploadableField(mapping="portfolio_images", fileNameProperty="name")
   */
  private $imageFile;

  public function __construct()
  {
    $this->createdAt = new DateTime();
    $this->updatedAt = new DateTime();
    $this->portfolios = new ArrayCollection();
  }

  /**
   * @param File|null $imageFile
   * @return Pictures
   * @throws Exception
   */
  public function setImageFile( ?File $imageFile = null)
  {
    $this -> imageFile = $imageFile;
    if ($this -> imageFile instanceof UploadedFile) {
      $this->updatedAt = new \DateTime('now');
    }
    return $this;
  }

  public function getImageFile()
  {
    return $this -> imageFile;
  }

  public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
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
     * @return Collection|Portfolio[]
     */
    public function getPortfolios(): Collection
    {
        return $this->portfolios;
    }

    public function addPortfolio(Portfolio $portfolio): self
    {
        if (!$this->portfolios->contains($portfolio)) {
            $this->portfolios[] = $portfolio;
            $portfolio->addPicture($this);
        }

        return $this;
    }

    public function removePortfolio(Portfolio $portfolio): self
    {
        if ($this->portfolios->contains($portfolio)) {
            $this->portfolios->removeElement($portfolio);
            $portfolio->removePicture($this);
        }

        return $this;
    }
  public function __toString()
  {
    return $this->name;
  }
}
