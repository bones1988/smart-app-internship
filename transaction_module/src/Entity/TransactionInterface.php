<?php

namespace Drupal\transaction_module\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;

/**
 * Provides an interface for defining Transaction entities.
 *
 * @ingroup transaction_module
 */
interface TransactionInterface extends ContentEntityInterface, EntityChangedInterface, EntityPublishedInterface {

  /**
   * Add get/set methods for your configuration properties here.
   */

  /**
   * Gets the Transaction name.
   *
   * @return string
   *   Name of the Transaction.
   */
  public function getName();

  /**
   * Sets the Transaction name.
   *
   * @param string $name
   *   The Transaction name.
   *
   * @return \Drupal\transaction_module\Entity\TransactionInterface
   *   The called Transaction entity.
   */
  public function setName($name);

  /**
   * Gets the Transaction creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Transaction.
   */
  public function getCreatedTime();

  /**
   * Sets the Transaction creation timestamp.
   *
   * @param int $timestamp
   *   The Transaction creation timestamp.
   *
   * @return \Drupal\transaction_module\Entity\TransactionInterface
   *   The called Transaction entity.
   */
  public function setCreatedTime($timestamp);

}
