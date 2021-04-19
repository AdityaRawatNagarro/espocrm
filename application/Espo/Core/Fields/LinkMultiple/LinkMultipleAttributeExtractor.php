<?php
/************************************************************************
 * This file is part of EspoCRM.
 *
 * EspoCRM - Open Source CRM application.
 * Copyright (C) 2014-2021 Yurii Kuznietsov, Taras Machyshyn, Oleksii Avramenko
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

namespace Espo\Core\Fields\LinkMultiple;

use Espo\ORM\Value\AttributeExtractor;

use Espo\Core\Fields\LinkMultiple;

use StdClass;
use InvalidArgumentException;

/**
 * @implements AttributeExtractor<LinkMultiple>
 */
class LinkMultipleAttributeExtractor implements AttributeExtractor
{
    /**
     * @param LinkMultiple $value
     */
    public function extract(object $value, string $field): StdClass
    {
        if (!$value instanceof LinkMultiple) {
            throw new InvalidArgumentException();
        }

        $nameMap = (object) [];
        $columnData = (object) [];

        foreach ($value->getList() as $item) {
            $id = $item->getId();

            $nameMap->$id = $item->getName();

            $columnItemData = (object) [];

            foreach ($item->getColumnList() as $column) {
                $columnItemData->$column = $item->getColumnValue($column);
            }

            $columnData->$id = $columnItemData;
        }

        return (object) [
            $field . 'Ids' => $value->getIdList(),
            $field . 'Names' => $nameMap,
            $field . 'Columns' => $columnData,
        ];
    }

    public function extractFromNull(string $field): StdClass
    {
        return (object) [
            $field . 'Ids' => [],
            $field . 'Names' => (object) [],
            $field . 'Columns' => (object) [],
        ];
    }
}
