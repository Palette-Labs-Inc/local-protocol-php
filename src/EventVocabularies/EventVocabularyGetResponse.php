<?php

declare(strict_types=1);

namespace LocalProtocol\EventVocabularies;

use LocalProtocol\Core\Attributes\Optional;
use LocalProtocol\Core\Attributes\Required;
use LocalProtocol\Core\Concerns\SdkModel;
use LocalProtocol\Core\Contracts\BaseModel;
use LocalProtocol\EventVocabularies\EventVocabularyGetResponse\Event;

/**
 * Schema for delivery event vocabularies.
 *
 * @phpstan-import-type EventShape from \LocalProtocol\EventVocabularies\EventVocabularyGetResponse\Event
 *
 * @phpstan-type EventVocabularyGetResponseShape = array{
 *   description: string,
 *   events: array<string,Event|EventShape>,
 *   name: string,
 *   title: string,
 *   version: string,
 *   extends?: list<string>|null,
 *   spec?: string|null,
 * }
 */
final class EventVocabularyGetResponse implements BaseModel
{
    /** @use SdkModel<EventVocabularyGetResponseShape> */
    use SdkModel;

    /**
     * Human-readable description of the standard.
     */
    #[Required]
    public string $description;

    /**
     * Map of all event IDs supported by this standard, including inherited events.
     *
     * @var array<string,Event> $events
     */
    #[Required(map: Event::class)]
    public array $events;

    /**
     * Standard identifier in reverse-domain notation (e.g., xyz.localprotocol.delivery.courier).
     */
    #[Required]
    public string $name;

    /**
     * Human-readable title for the standard.
     */
    #[Required]
    public string $title;

    /**
     * Version in YYYY-MM-DD format.
     */
    #[Required]
    public string $version;

    /**
     * Parent standard this standard extends (optional). Only one parent is allowed; the reference must include a version date. Used for lineage and discovery.
     *
     * @var list<string>|null $extends
     */
    #[Optional(list: 'string')]
    public ?array $extends;

    /**
     * URL to human-readable specification document.
     */
    #[Optional]
    public ?string $spec;

    /**
     * `new EventVocabularyGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EventVocabularyGetResponse::with(
     *   description: ..., events: ..., name: ..., title: ..., version: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EventVocabularyGetResponse)
     *   ->withDescription(...)
     *   ->withEvents(...)
     *   ->withName(...)
     *   ->withTitle(...)
     *   ->withVersion(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string,Event|EventShape> $events
     * @param list<string>|null $extends
     */
    public static function with(
        string $description,
        array $events,
        string $name,
        string $title,
        string $version,
        ?array $extends = null,
        ?string $spec = null,
    ): self {
        $self = new self;

        $self['description'] = $description;
        $self['events'] = $events;
        $self['name'] = $name;
        $self['title'] = $title;
        $self['version'] = $version;

        null !== $extends && $self['extends'] = $extends;
        null !== $spec && $self['spec'] = $spec;

        return $self;
    }

    /**
     * Human-readable description of the standard.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Map of all event IDs supported by this standard, including inherited events.
     *
     * @param array<string,Event|EventShape> $events
     */
    public function withEvents(array $events): self
    {
        $self = clone $this;
        $self['events'] = $events;

        return $self;
    }

    /**
     * Standard identifier in reverse-domain notation (e.g., xyz.localprotocol.delivery.courier).
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Human-readable title for the standard.
     */
    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }

    /**
     * Version in YYYY-MM-DD format.
     */
    public function withVersion(string $version): self
    {
        $self = clone $this;
        $self['version'] = $version;

        return $self;
    }

    /**
     * Parent standard this standard extends (optional). Only one parent is allowed; the reference must include a version date. Used for lineage and discovery.
     *
     * @param list<string> $extends
     */
    public function withExtends(array $extends): self
    {
        $self = clone $this;
        $self['extends'] = $extends;

        return $self;
    }

    /**
     * URL to human-readable specification document.
     */
    public function withSpec(string $spec): self
    {
        $self = clone $this;
        $self['spec'] = $spec;

        return $self;
    }
}
