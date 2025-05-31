<?php

namespace App\Entity\Cms;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\OpenApi\Model\Operation as OpenApiOperation;
use ApiPlatform\OpenApi\Model\RequestBody;
use App\Repository\Cms\MediaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ApiResource(
    shortName: "media_file",
    description: "App media",
    operations: [
        new GetCollection(
            openapi: new OpenApiOperation(
                summary : "Get list of all media",
            ),
            normalizationContext: [
                'groups' => [
                    'media:list_read'
                ]
            ]

        ),
        new Post(
            openapi: new OpenApiOperation(
                summary: "Upload a media file",
                description: "Upload a media file. The file will be stored in the configured media directory.",
                requestBody: new RequestBody(
                    content: new \ArrayObject([
                       'multipart/form-data' => [
                           'schema' => [
                               'type' => 'object',
                               'properties'=> [
                                   'file' => [
                                       'type' => 'string',
                                       'format' => 'binary',
                                   ]
                               ]
                           ]
                       ]
                    ])
                )
            ),
            normalizationContext: [
                'groups' => [
                    'media:item_read',
                ]
            ],
            denormalizationContext: [
                'groups' => [
                    'media:item_write',
                ]
            ]
        ),
        new Get(
            openapi: new OpenApiOperation(
                summary: "Get media by id",
            ),
            normalizationContext: [
                'groups' => [
                    'media:item_read',
                ]
            ]
        ),
        new Post(
            uriTemplate: '/media_files/{id}',
            openapi: new OpenApiOperation(
                summary: "Update a media file",
                description: "Update a media file. The file will be stored in the configured media directory.",
                requestBody: new RequestBody(
                    content: new \ArrayObject([
                        'multipart/form-data' => [
                            'schema' => [
                                'type' => 'object',
                                'properties'=> [
                                    'file' => [
                                        'type' => 'string',
                                        'format' => 'binary',
                                    ]
                                ]
                            ]
                        ]
                    ])
                )
            ),
            normalizationContext: [
                'groups' => [
                    'media:item_read',
                ]
            ],
            denormalizationContext: [
                'groups' => [
                    'media:item_write',
                ]
            ]
        ),
    ],
    paginationClientItemsPerPage: true,
    paginationEnabled: true,
    paginationItemsPerPage: 25,
    security: "is_granted('ROLE_USER')"
)]
#[ORM\Entity(repositoryClass: MediaRepository::class)]
#[ORM\Table(name: 'app_cms_media')]
#[Vich\Uploadable]
class Media
{
    #[ApiProperty(identifier: true)]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Vich\UploadableField(mapping: "media_files", fileNameProperty: "filePath", size: "size", mimeType: "mimeType", originalName: "originalName")]
    private ?File $file = null;
    #[ORM\Column(length: 255)]
    private ?string $filePath = null;

    #[ORM\Column(nullable: true)]
    private ?int $size = null;
    #[ORM\Column(length: 255)]
    private ?string $mimeType = null;

    #[ORM\Column(length: 255)]
    private ?string $originalName = null;

    #[ORM\Column(length: 255)]
    private ?string $extension = null;

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $liipPaths = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getFile(): ?File
    {
        return $this->file;
    }

    public function setFile(?File $file): void
    {
        $this->file = $file;
    }

    public function getFilePath(): ?string
    {
        return $this->filePath;
    }

    public function setFilePath(?string $filePath): void
    {
        $this->filePath = $filePath;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(?int $size): void
    {
        $this->size = $size;
    }

    public function getMimeType(): ?string
    {
        return $this->mimeType;
    }

    public function setMimeType(?string $mimeType): void
    {
        $this->mimeType = $mimeType;
    }

    public function getOriginalName(): ?string
    {
        return $this->originalName;
    }

    public function setOriginalName(?string $originalName): void
    {
        $this->originalName = $originalName;
    }

    public function getExtension(): ?string
    {
        return $this->extension;
    }

    public function setExtension(?string $extension): void
    {
        $this->extension = $extension;
    }

    public function getLiipPaths(): ?array
    {
        return $this->liipPaths;
    }

    public function setLiipPaths(?array $liipPaths): void
    {
        $this->liipPaths = $liipPaths;
    }


}
