<?php
/**
 * @file
 * Contains \Drupal\block_module\Plugin\Block\OwnerBlock.
 */
namespace Drupal\block_module\Plugin\Block;


use Drupal;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\UseCacheBackendTrait;
use PDO;

/**
 * Provides a custom_block.
 *
 * @Block(
 *   id = "block_module",
 *   admin_label = @Translation("Owner info block"),
 *   category = @Translation("Smart app")
 * )
 */
class OwnerBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    //user id
    $user_id = Drupal::currentUser()->id();

    //user name
    $query = \Drupal::database()->select('user__field_first_name', 'fn');
    $query->addField('fn', 'field_first_name_value');
    $query->condition('fn.entity_id', $user_id);
    $user_name = $query->execute()->fetchField();

    //company names
    $query = \Drupal::database()->select('node_field_data', 'nfd');
    $query->fields('nfd', array('nid', 'title'));
    $query->condition('nfd.type', 'company');
    $query->condition('nfd.uid', $user_id);
    $companies = $query->execute()->fetchAll(PDO::FETCH_ASSOC);
    $companies_markup = '';
    foreach ($companies as $company) {
      $companies_markup = $companies_markup . '<li>' . $company['title'] . ' <a href="/node/' . $company['nid'] . '/edit">edit</a></li>';
    }
    if (empty($companies)) {
      $companies_markup = '<li> You did not create any company</li>';
    }

    //count products
    $query = \Drupal::database()->select('commerce_product_field_data', 'cpfd');
    $query->condition('cpfd.uid', $user_id);
    $products_count = $query->countQuery()->execute()->fetchField();

    return array(
      '#markup' => '<p>Your name: ' . $user_name  . '<a href="/user/' . $user_id . '/edit"> edit</a></p>' .
     '<p>Organizations:</p>' .
     '<ul>'.
      $companies_markup .
      '</ul>' .
        '<p>Count products: ' . $products_count . '</p>'
    );
  }

  public function getCacheMaxAge() {
    return 0;
  }
}
