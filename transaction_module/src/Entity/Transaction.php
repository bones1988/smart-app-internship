<?php

namespace Drupal\transaction_module\Entity;

use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityPublishedTrait;
use Drupal\Core\Entity\EntityTypeInterface;

/**
 * Defines the Transaction entity.
 *
 * @ingroup transaction_module
 *
 * @ContentEntityType(
 *   id = "transaction",
 *   label = @Translation("Transaction"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\transaction_module\TransactionListBuilder",
 *     "views_data" = "Drupal\transaction_module\Entity\TransactionViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\transaction_module\Form\TransactionForm",
 *       "add" = "Drupal\transaction_module\Form\TransactionForm",
 *       "edit" = "Drupal\transaction_module\Form\TransactionForm",
 *       "delete" = "Drupal\transaction_module\Form\TransactionDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\transaction_module\TransactionHtmlRouteProvider",
 *     },
 *     "access" = "Drupal\transaction_module\TransactionAccessControlHandler",
 *   },
 *   base_table = "transaction",
 *   translatable = FALSE,
 *   admin_permission = "administer transaction entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "langcode" = "langcode",
 *     "published" = "status",
 *     "date" = "date",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/transaction/{transaction}",
 *     "add-form" = "/admin/structure/transaction/add",
 *     "edit-form" = "/admin/structure/transaction/{transaction}/edit",
 *     "delete-form" = "/admin/structure/transaction/{transaction}/delete",
 *     "collection" = "/admin/structure/transaction",
 *   },
 *   field_ui_base_route = "transaction.settings"
 * )
 */
class Transaction extends ContentEntityBase implements TransactionInterface {

  use EntityChangedTrait;
  use EntityPublishedTrait;

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->get('name')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setName($name) {
    $this->set('name', $name);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    // Add the published field.
    $fields += static::publishedBaseFieldDefinitions($entity_type);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the transaction.'))
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(TRUE);

    $fields['date'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Date'))
      ->setDescription(t('The date of the transaction.'))
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(TRUE);

    $fields['sum'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Sum'))
      ->setDescription(t('The sum of the transaction.'))
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(TRUE);

    $fields['sender'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Sender'))
      ->setDescription(t('The sender of the transaction.'))
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(TRUE);

    $fields['recipient'] = BaseFieldDefinition::create('string')
      ->setLabel(t('recipient'))
      ->setDescription(t('The recipient of the transaction.'))
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(TRUE);

    $fields['status']->setDescription(t('A boolean indicating whether the transaction is published.'))
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
        'weight' => -3,
      ]);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }
}
