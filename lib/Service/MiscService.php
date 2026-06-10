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

use OCA\Files_FromMail\AppInfo\Application;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;


/**
 * Class MiscService
 *
 * @package OCA\Files_FromMail\Service
 */
class MiscService {


	/** @var LoggerInterface */
	private $logger;


	public function __construct(LoggerInterface $logger) {
		$this->logger = $logger;
	}


	/**
	 * @param string $message
	 * @param int $level ILogger level constant (0=debug … 4=fatal)
	 */
	public function log(string $message, int $level = 2): void {
		$psrLevel = match ($level) {
			0       => LogLevel::DEBUG,
			1       => LogLevel::INFO,
			3       => LogLevel::ERROR,
			4       => LogLevel::CRITICAL,
			default => LogLevel::WARNING,
		};
		$this->logger->log($psrLevel, $message, ['app' => Application::APP_NAME]);
	}

}

