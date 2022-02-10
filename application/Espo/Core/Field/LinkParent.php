<?php
/************************************************************************
 * This file is part of EspoCRM.
 *
 * EspoCRM - Open Source CRM application.
 * Copyright (C) 2014-2022 Yurii Kuznietsov, Taras Machyshyn, Oleksii Avramenko
 * Website: https://www.espocrm.com
 *
 * EspoCRM is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * EspoCRM is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with EspoCRM. If not, see http://www.gnu.org/licenses/.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "EspoCRM" word.
 ************************************************************************/

namespace Espo\Core\Field;

use RuntimeException;

/**
 * A link-parent value object. Immutable.
 */
class LinkParent
{
    private $entityType;

    private $id;

    private $name = null;

    public function __construct(string $entityType, string $id)
    {
        if (!$entityType) {
            throw new RuntimeException("Empty entity type.");
        }

        if (!$id) {
            throw new RuntimeException("Empty ID.");
        }

        $this->entityType = $entityType;
        $this->id = $id;
    }

    /**
     * Get an ID.
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Get an entity type.
     */
    public function getEntityType(): string
    {
        return $this->entityType;
    }

    /**
     * Get a name.
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Clone with a name.
     */
    public function withName(?string $name): self
    {
        $obj = new self($this->entityType, $this->id);

        $obj->name = $name;

        return $obj;
    }

    /**
     * Create.
     */
    public static function create(string $entityType, string $id): self
    {
        return new self($entityType, $id);
    }
}
