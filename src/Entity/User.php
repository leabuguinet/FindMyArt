<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 * @Vich\Uploadable
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="integer")
     */
    private $postcode;

    /**
     * @ORM\Column(type="integer")
     */
    private $phone;

    /**
     * @ORM\OneToMany(targetEntity=Renting::class, mappedBy="user")
     */
    private $rentings;

    /**
     * @ORM\Column(type="boolean")
     */
    private $DocValidated;

    ///UPLOAD Carte d'identité

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $identityCard;

    /**
     * @Vich\UploadableField(mapping="user_documents", fileNameProperty="identityCard")
     * @var File
     */
    private $identityCardFile;


    ///UPLOAD Justificatif de domicile

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $residenceCertificate;

    /**
     * @Vich\UploadableField(mapping="user_documents", fileNameProperty="residenceCertificate")
     * @var File
     */
    private $residenceCertificateFile;

    ///UPLOAD Attestation d'assurance domicile

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $insuranceCertificate;

    /**
     * @Vich\UploadableField(mapping="user_documents", fileNameProperty="insuranceCertificate")
     * @var File
     */
    private $insuranceCertificateFile;


    ///UPLOAD updated at


    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    public $updatedAt;






    public function __construct()
    {
        $this->rentings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPostcode(): ?int
    {
        return $this->postcode;
    }

    public function setPostcode(int $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return Collection|Renting[]
     */
    public function getRentings(): Collection
    {
        return $this->rentings;
    }

    public function addRenting(Renting $renting): self
    {
        if (!$this->rentings->contains($renting)) {
            $this->rentings[] = $renting;
            $renting->setUser($this);
        }

        return $this;
    }

    public function removeRenting(Renting $renting): self
    {
        if ($this->rentings->removeElement($renting)) {
            // set the owning side to null (unless already changed)
            if ($renting->getUser() === $this) {
                $renting->setUser(null);
            }
        }

        return $this;
    }

    public function getDocValidated(): ?bool
    {
        return $this->DocValidated;
    }

    public function setDocValidated(bool $DocValidated): self
    {
        $this->DocValidated = $DocValidated;

        return $this;
    }
    ////UPLOAD 3 documents 

    public function setImageFile(File $identityCard = null, File $residenceCertificate = null, File $insuranceCertificate = null )
    {
        $this->identityCardFile = $identityCard;
        $this->identityCardFile = $residenceCertificate;
        $this->insuranceCertificateFile = $insuranceCertificate;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($identityCard) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }

        if ($residenceCertificate) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }

        if ($insuranceCertificate) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->identityCardFile;
        return $this->residenceCertificateFile;
        return $this->insuranceCertificateFile;
    }

    public function setImage($identityCard, $residenceCertificate, $insuranceCertificate)
    {
        $this->identityCard = $identityCard;
        $this->residenceCertificate = $residenceCertificate;
        $this->insuranceCertificate = $insuranceCertificate;
    }

    public function getImage()
    {
        return $this->identityCard;
        return $this->residenceCertificate;
        return $this->insuranceCertificate;
    }

}
