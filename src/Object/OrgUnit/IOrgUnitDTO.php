<?php

namespace SRAG\Plugins\Hub2\Object\OrgUnit;

use SRAG\Plugins\Hub2\Object\DTO\IDataTransferObject;

/**
 * Interface IOrgUnitDTO
 *
 * @package SRAG\Plugins\Hub2\Object\OrgUnit
 * @author  Fabian Schmid <fs@studer-raimann.ch>
 */
interface IOrgUnitDTO extends IDataTransferObject {

	const PARENT_ID_TYPE_REF_ID = 1;
	const PARENT_ID_TYPE_EXTERNAL_EXT_ID = 2;


	/**
	 * @return string
	 */
	public function getTitle(): string;


	/**
	 * @param string $title
	 *
	 * @return IOrgUnitDTO
	 */
	public function setTitle(string $title): IOrgUnitDTO;


	/**
	 * @return string
	 */
	public function getDescription(): string;


	/**
	 * @param string $description
	 *
	 * @return IOrgUnitDTO
	 */
	public function setDescription(string $description): IOrgUnitDTO;


	/**
	 * @return int
	 */
	public function getOwner(): int;


	/**
	 * @param int $owner
	 *
	 * @return IOrgUnitDTO
	 */
	public function setOwner(int $owner): IOrgUnitDTO;


	/**
	 * @return int
	 */
	public function getParentId(): int;


	/**
	 * @param int $parentId
	 *
	 * @return IOrgUnitDTO
	 */
	public function setParentId(int $parentId): IOrgUnitDTO;


	/**
	 * @return int
	 */
	public function getParentIdType(): int;


	/**
	 * @param int $parentIdType
	 *
	 * @return IOrgUnitDTO
	 */
	public function setParentIdType(int $parentIdType): IOrgUnitDTO;


	/**
	 * @return string
	 */
	public function getOrguType(): string;


	/**
	 * @param string $orguType
	 *
	 * @return IOrgUnitDTO
	 */
	public function setOrguType(string $orguType): IOrgUnitDTO;


	/**
	 * @return string
	 */
	public function getExtId(): string;


	/**
	 * @param string $extId
	 *
	 * @return IOrgUnitDTO
	 */
	public function setExtId(string $extId): IOrgUnitDTO;
}
