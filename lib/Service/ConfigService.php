<?php declare(strict_types=1);


/**
 * Files_FromMail - Recover your email attachments from your cloud.
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Maxence Lange <maxence@artificial-owl.com>
 * @copyright 2017
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 *  You should have received a copy of the GNU Affero General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */


namespace OCA\Files_FromMail\Service;

use OCP\IAppConfig;


/**
 * Class ConfigService
 *
 * @package OCA\Files_FromMail\Service
 */
class ConfigService {

	const FROMMAIL_ADDRESSES = 'frommail_addresses';
	const FROMMAIL_FILENAMEID = 'filename_id';

	private $defaults = [
		self::FROMMAIL_ADDRESSES  => '',
		self::FROMMAIL_FILENAMEID => 'Y-m-d H:i:s',
	];


	/** @var string */
	private $appName;

	/** @var IAppConfig */
	private $appConfig;

	/** @var MiscService */
	private $miscService;


	public function __construct(string $appName, IAppConfig $appConfig, MiscService $miscService) {
		$this->appName = $appName;
		$this->appConfig = $appConfig;
		$this->miscService = $miscService;
	}


	/**
	 * Get a value by key
	 *
	 * @param string $key
	 *
	 * @return string
	 */
	public function getAppValue(string $key): string {
		$default = $this->defaults[$key] ?? '';
		return $this->appConfig->getValueString($this->appName, $key, $default);
	}

	public function setAppValue(string $key, string $value): void {
		$this->appConfig->setValueString($this->appName, $key, $value);
	}

	public function deleteAppValue(string $key): void {
		$this->appConfig->deleteKey($this->appName, $key);
	}

}

