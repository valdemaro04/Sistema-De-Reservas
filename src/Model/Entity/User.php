<?php
namespace App\Model\Entity;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property int $category_id
 * @property string $role
 *
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\Date[] $date
 * @property \App\Model\Entity\Directory[] $directory
 * @property \App\Model\Entity\Form[] $forms
 * @property \App\Model\Entity\Profile $profile
 * @property \App\Model\Entity\Routine $routine
 * @property \App\Model\Entity\Subcategory $subcategory
 */
class User extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'username' => true,
        'password' => true,
        'category_id' => true,
        'role' => true,
        'category' => true,
        'date' => true,
        'directory' => true,
        'forms' => true,
        'profile' => true,
        'routine' => true,
        'subcategory' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
    protected function _setPassword($value)
    {
        if (strlen($value)) {
            $hasher = new DefaultPasswordHasher();

            return $hasher->hash($value);
        }
    }
}
