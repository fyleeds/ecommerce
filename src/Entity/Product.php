<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\ProductRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[Vich\Uploadable]
class Product
{
    public function __toString(): string
    {
        // Return the ID as a string
        return (string) $this->id;
    }

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank]
    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[Assert\NotBlank]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[Assert\NotBlank]
    #[ORM\Column]
    private ?int $price = null;

    #[Assert\NotBlank]
    #[ORM\Column (type:"datetime")]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(length: 255,type: 'string')]
    private ?string $attachment = null;

    // NOTE: This is not a mapped field of entity metadata, just a simple property.
    #[Assert\File(maxSize: '1024k')]
    #[Assert\File(mimeTypes: ["image/png", "image/jpeg", "image/jpg"])]
    #[Assert\File(mimeTypesMessage: "Please upload a valid image (PNG or JPEG")]
    #[Vich\UploadableField(mapping: 'products', fileNameProperty: 'attachment')]
    private ?File $attachmentFile = null;

    #[Assert\NotBlank]
    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CategoryShop $category = null;

    #[Assert\NotBlank]
    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[Assert\NotBlank]
    #[ORM\Column(length: 255)]
    private ?string $game_character = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $author = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $releaseDate = null;

    #[ORM\OneToOne(mappedBy: 'product', cascade: ['persist', 'remove'])]
    private ?Stock $stock = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface{
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getAttachment(): ?string
    {
        return $this->attachment;
    }

    public function setAttachment(string $attachment): static
    {
        $this->attachment = $attachment;

        return $this;
    }

    public function setAttachmentFile(?File $attachmentFile = null): void
    {
        $this->attachmentFile = $attachmentFile;

        if (null !== $attachmentFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->createdAt = new \DateTimeImmutable();
        }
    }

    public function getAttachmentFile(): ?File
    {
        return $this->attachmentFile;
    }

    public function getCategory(): ?CategoryShop
    {
        return $this->category;
    }

    public function setCategory(?CategoryShop $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getGameCharacter(): ?string
    {
        return $this->game_character;
    }

    public function setGameCharacter(string $game_character): static
    {
        $this->game_character = $game_character;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): static
    {
        $this->author = $author;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(\DateTimeInterface $releaseDate): static
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getStock(): ?Stock
    {
        return $this->stock;
    }

    public function setStock(Stock $stock): static
    {

        $this->stock = $stock;

        return $this;
    }


}
